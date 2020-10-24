<?php


namespace App\Http\Controllers;

use Meta;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Scandinaver\User\Domain\Services\PaymentService;
use Scandinaver\User\Infrastructure\Persistence\Eloquent\Plan;

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
     * @param PaymentService $paymentService
     */
    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function index()
    {
        Meta::set('title', 'Scandinaver | Тарифы');

        return view('main.frontend.payment.index');
    }

    /**
     * @param $name
     *
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function plan($name)
    {
        $plan = Plan::where('name', $name)->firstOrFail();

        Meta::set('title', 'Scandinaver | ' . $plan->name);

        return view('main.frontend.payment.plan', ['plan' => $plan]);
    }

    /**
     * Start handle process from route
     * TODO: сделать нормально!
     *
     * @param Request $request
     */
    public function handlePayment(Request $request)
    {
        $order = $this->paymentService->make($request);

        activity('admin')->withProperties($request->toArray())->log('Пришел платеж №' . $order->id);
    }
}