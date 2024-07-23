<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Donor;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Services\ForgotPasswordService;
use DB;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    public function index(): View|Factory
    {
        return view("frontEnd.index");
    }
    public function login(): View|Factory
    {
        return view("frontEnd.login");
    }
    public function about(): View|Factory
    {
        return view("frontEnd.about");
    }
    public function authenticate(LoginRequest $request): RedirectResponse
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->with('error', 'Gagal Login!');
    }
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }


    public function student(): View|Factory
    {
        $donations = Donation::orderByDesc('created_at')->get();
        $donors = Donor::with(['donation','paymentMethod'])->orderByDesc('created_at')->get();
        return view("frontEnd.profile", ['donations' => $donations, 'donors' => $donors]);
    }

    public function storeStudent(Request $request): RedirectResponse
    {
        $user = User::find($request->id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
    
        $rules = [
            'id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
        ];
    
        if ($request->email !== $user->email) {
            $rules['email'] = [
                'required',
                'email',
                Rule::unique('users')->ignore($request->id),
            ];
        } else {
            $rules['email'] = 'required|email';
        }
    
        $validatedData = $request->validate($rules);
    
        DB::beginTransaction();
        try {
            $user->update(['email' => $validatedData['email'], 'name' => $validatedData['name']]);
            DB::commit();
            return redirect()->route('frontEnd.student')->with('success', 'User successfully updated');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function submitResetPassword(Request $request): RedirectResponse
    {
        $rules = [
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ];
        $data = $request->validate($rules);
        $userExists = [
            'email' => Auth::user()->email,
            'password' => $data['current_password'],
        ];
        if (!Auth::attempt($userExists)) {
            return redirect()->back()->with('error', 'The old password does not match our records.');
        }


        DB::beginTransaction();
        try {
            $dataUser  = [
                "password" => bcrypt($data['password']),
            ];
            $users = User::find(Auth::user()->id)->update($dataUser);
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            DB::commit();
            return redirect()->route('frontEnd.login')->with('success', 'Update Profile Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }
}
