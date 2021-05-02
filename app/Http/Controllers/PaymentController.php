<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Scandinaver\User\Domain\Service\PaymentService;

/**
 * Class PaymentController
 *
 * @package App\Http\Controllers\Main\Frontend
 */
class PaymentController extends Controller
{
    private PaymentService $paymentService;

    /**
     * PaymentController constructor.
     *
     * @param  PaymentService  $paymentService
     */
    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Start handle process from route
     * TODO: сделать нормально!
     *
     * @param  Request  $request
     */
    public function handlePayment(Request $request)
    {
        $order = $this->paymentService->make($request);
    }
}