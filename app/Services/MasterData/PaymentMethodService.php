<?php

namespace App\Services\MasterData;

use App\Http\Requests\PaymentMethodRequest;
use App\Models\PaymentMethod;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentMethodService
{
    public function save(PaymentMethodRequest $request, ?PaymentMethod $paymentMethod = null): RedirectResponse
    {
      DB::beginTransaction();
      try {
        $data = $request->all();
        if ($paymentMethod) {
            $paymentMethod->update($data);
        } else {
            $paymentMethod = PaymentMethod::create($data);
        }

        if(!empty($paymentMethod['id'])){
            DB::commit();
            Log::channel('log-transaction')->info(($paymentMethod->wasRecentlyCreated ? 'Payment Method Created!' : 'Payment Method Updated!'), ['User' =>  Auth::user()->name]);
            return redirect()->route('payment_method.index')->with('success', 'Data berhasil ' . ($paymentMethod->wasRecentlyCreated ? 'ditambahkan!' : 'diubah!'));
        }

      } catch (\Exception $e) {
        DB::rollback();
        Log::channel('log-transaction')->info($e->getMessage(), ['User' =>  Auth::user()->name]);
        return back()->with('error', $e->getMessage());
      }
    }

    public function delete(PaymentMethod $paymentMethod): bool
    {
        DB::beginTransaction();
        try {
            $paymentMethod->delete();
            DB::commit();
            Log::channel('log-transaction')->info('Payment Method Delete Success!', ['User' =>  Auth::user()->name]);
            return TRUE;
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('log-transaction')->info($e->getMessage(), ['User' =>  Auth::user()->name]);
            return FALSE;
        }
    }
}
