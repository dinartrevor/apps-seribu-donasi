<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentMethodRequest;
use App\Models\PaymentMethod;
use App\Services\MasterData\PaymentMethodService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{

    private PaymentMethod $paymentMethod;
    private PaymentMethodService $paymentMethodService;
    public function __construct(PaymentMethod $paymentMethod, PaymentMethodService $paymentMethodService) {
        $this->paymentMethod = $paymentMethod;
        $this->paymentMethodService = $paymentMethodService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View|Factory
    {
       $paymentMethods =  $this->paymentMethod->orderBy('name')->get(['id', 'name']);
       return view("backEnd.masterData.paymentMethod.index", ['paymentMethods' => $paymentMethods]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentMethodRequest $request): RedirectResponse
    {
        return $this->paymentMethodService->save($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $paymentMethod): JsonResponse
    {
        if(!$paymentMethod){
            return response()->json([
                'message' => 'Data Tidak Ada.',
                'data'    => [],
                'status' => false,
            ], JsonResponse::HTTP_NOT_FOUND);
        }

        return response()->json([
            'message' => 'Data Tidak Ada.',
            'data'    => $paymentMethod,
            'status' => true,
        ], JsonResponse::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  PaymentMethod $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentMethodRequest $request, PaymentMethod $paymentMethod): RedirectResponse
    {
        return $this->paymentMethodService->save($request, $paymentMethod);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  PaymentMethod $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $paymentMethod): JsonResponse
    {
        $response = $this->paymentMethodService->delete($paymentMethod);
        if(!$response){
            return response()->json([
                'message' => 'Data Gagal Dihapus.',
                'data'    => [],
                'status' => false,
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'message' => 'Data Berhasil Dihapus.',
            'status' => true,
        ], JsonResponse::HTTP_OK);
    
    }
}
