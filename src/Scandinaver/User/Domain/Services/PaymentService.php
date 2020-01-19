<?php


namespace Scandinaver\User\Domain\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Scandinaver\User\Domain\Order;

/**
 * Class PaymentService
 * @package App\Services
 */
class PaymentService
{
    /**
     * @param Request $request
     * @return Order
     */
    public function make(Request $request): Order
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

        return $order;
    }
}