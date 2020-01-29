<?php

namespace App\Http\Controllers\Main\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Plan;
use App\Services\PaymentService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Meta;

/**
 * Created by PhpStorm.
 * User: john
 * Date: 29.06.2018
 * Time: 16:26
 *
 * Class ProfileController
 * @package Application\Controllers
 */
class PaymentController extends Controller
{
    /**
     * @var PaymentService
     */
    private $paymentService;

    /**
     * PaymentController constructor.
     * @param PaymentService $paymentService
     */
    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function index()
    {
        Meta::set('title', 'Scandinaver | Тарифы');

        return view('main.frontend.payment.index');
    }

    public function plan($name)
    {
        $plan = Plan::where('name', $name)->firstOrFail();

        Meta::set('title', 'Scandinaver | '.$plan->name);

        return view('main.frontend.payment.plan', ['plan' => $plan]);
    }

    /**
     * Start handle process from route
     * TODO: сделать нормально!
     * @param Request $request
     */
    public function handlePayment(Request $request)
    {
        $order = $this->paymentService->make($request);

        activity('admin')->withProperties($request->toArray())->log('Пришел платеж №'.$order->id);
    }
}