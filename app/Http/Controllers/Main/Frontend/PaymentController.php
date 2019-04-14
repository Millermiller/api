<?php

namespace App\Http\Controllers\Main\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Plan;
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
     * Search the order in your database and return that order
     * to paidOrder, if status of your order is 'paid'
     *
     * @param Request $request
     * @param $order_id
     * @return bool|mixed
     */
    public function searchOrder(Request $request, $order_id)
    {
        $order = Order::where('id', $order_id)->first();

        if($order) {
            $order['_orderSum'] = $order->sum;

            // If your field can be `paid` you can set them like string
            $order['_orderStatus'] = $order['status'];

            // Else your field doesn` has value like 'paid', you can change this value
            $order['_orderStatus'] = ('1' == $order['status']) ? 'paid' : false;

            return $order;
        }

        return false;
    }

    /**
     * When paymnet is check, you can paid your order
     *
     * @param Request $request
     * @param Order $order
     * @return bool
     */
    public function paidOrder(Request $request, $order)
    {
        $order->status = 'paid';
        $order->save();

        //

        return true;
    }

    /**
     * Start handle process from route
     * TODO: сделать нормально!
     * @param Request $request
     */
    public function handlePayment(Request $request)
    {
        $order = new Order();
        $order->sum = $request->post('amount');
        $order->status = 1;
        $order->plan_id = explode('|', $request->post('label'))[1];
        $order->user_id = explode('|', $request->post('label'))[0];
        $order->notification_type = $request->post('notification_type');
        $order->datetime = $request->post('datetime');
        $order->codepro = $request->post('codepro');
        $order->sender = $request->post('sender');
        $order->sha1_hash = $request->post('sha1_hash');
        $order->label = $request->post('label');
        $order->save();

        if($order->user->active_to < Carbon::now()){
            if($order->plan->name == "Medium")
                $order->user->active_to = Carbon::now()->addMonth(1)->format('D M d Y');
            else
                $order->user->active_to = Carbon::now()->addMonth(3)->format('D M d Y');
        }
        else{
            if($order->plan->name == "Medium")
                $order->user->active_to = $order->user->active_to->addMonth(1)->format('D M d Y');
            else
                $order->user->active_to = $order->user->active_to->addMonth(3)->format('D M d Y');
        }

        $order->user->plan()->associate($order->plan);
        $order->user->save();

        activity('admin')->withProperties($request->toArray())->log('Пришел платеж №'.$order->id);
    }
}