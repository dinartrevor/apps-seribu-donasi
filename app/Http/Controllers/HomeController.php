<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\DonationPaymentMethod;
use App\Models\Donor;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Http\Traits\ImageTrait;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Services\ForgotPasswordService;
use DB;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{

    use ImageTrait;

    public function index(): View|Factory
    {
        $paymentMethods = PaymentMethod::orderByDesc('created_at')->get(['id','name']);
        $donations = Donation::withSum('donor', 'amount')->with('user')->orderByDesc('created_at')->limit(3)->get();
        return view("frontEnd.index", ['donations'=> $donations, 'paymentMethods' => $paymentMethods]);
    }
    public function donation(): View|Factory
    {
        $donations = Donation::withSum('donor', 'amount')->with('user')->orderByDesc('created_at')->limit(3)->get();
        return view("frontEnd.donation", ['donations'=> $donations]);
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
        $paymentMethods = PaymentMethod::orderByDesc('created_at')->get(['id','name']);
        $donations = Donation::withTrashed()->orderByDesc('created_at')->get();
        $donors = Donor::with(['donation','paymentMethod'])->orderByDesc('created_at')->get();
        return view("frontEnd.profile", ['donations' => $donations, 'donors' => $donors, 'paymentMethods' => $paymentMethods]);
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

    public function storeDonation(Request $request): RedirectResponse
    {
        $rules = [
            'title' => 'required',
            'amount' => 'required',
        ];
        $data = $request->validate($rules);
        DB::beginTransaction();
        try {
            if(empty($request->payment_method_id)) {
                return redirect()->route('frontEnd.profile')->with('success', 'Payment Method Wajib Diisi');
            }
            if ($request->hasFile('image')) {
                $request->image = $this->storeImage('donation',$request->file('image'));
            }
            $donation =  Donation::create([
                'user_id'   => Auth::user()->id,
                'title'     => $request->title,
                'amount'    =>  str_replace(',', '', $request->amount),
                'image'     => $request->hasFile('image') ? $request->image : '' ,
                'notes'     => $request->notes,
            ]);
            if($donation->id){
                $dataPaymentMethod = [];
                foreach($request->payment_method_id as $key => $payment_method_id)
                {
                    $dataPaymentMethod[] = new DonationPaymentMethod([
                        'payment_method_id' => $payment_method_id,
                        'account_number' => $request->account_number[$key],
                        'account_holder_name' => $request->account_holder_name[$key],
                    ]);
                }
                $donation->donationPaymentMethod()->saveMany($dataPaymentMethod);
                DB::commit();
                return redirect()->route('frontEnd.student')->with('success', 'Berhasil Membuat Donasi');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    public function donationVerify(Donation $donation): JsonResponse
    {
        DB::beginTransaction();
        try {
           
            if(!$donation){
                return response()->json([
                    'message' => 'Data Gagal Dihapus.',
                    'data'    => [],
                    'status' => false,
                ], JsonResponse::HTTP_BAD_REQUEST);
            }
            $donation->delete();
            DB::commit();
            return response()->json([
                'message' => 'Data Berhasil Dihapus.',
                'data'    => [],
                'status' => true,
            ], JsonResponse::HTTP_OK);
         
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'data'    => [],
                'status' => false,
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
     
        }
    }
}
