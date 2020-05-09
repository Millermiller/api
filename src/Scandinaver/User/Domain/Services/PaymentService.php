<?php


namespace Scandinaver\User\Domain\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Scandinaver\User\Domain\Order;

/**
 * Class PaymentService
 *
 * @package Scandinaver\User\Domain\Services
 */
class PaymentService
{
    /**
     * @param Request $request
     *
     * @return Order
     */
    public function make(Request $request): Order
    {
        $order = new Order();
        $order->setSum($request->post('amount'));
        $order->setStatus(1);
        $order->plan_id           = explode('|', $request->post('label'))[1];
        $order->user_id           = explode('|', $request->post('label'))[0];
        $order->notification_type = $request->post('notification_type');
        $order->setDatetime($request->post('datetime'));
        $order->setCodepro($request->post('codepro'));
        $order->setSender($request->post('sender'));
        $order->setSha1Hash($request->post('sha1_hash'));
        $order->setLabel($request->post('label'));
        // $order->save();

        if ($order->getUser()->getActiveTo() < Carbon::now()) {
            if ($order->getPlan()->getName() == "Medium")
                $order->getUser()->active_to = Carbon::now()->addMonth(1)->format('D M d Y');
            else
                $order->getUser()->active_to = Carbon::now()->addMonth(3)->format('D M d Y');
        } else {
            if ($order->getPlan()->getName() == "Medium")
                $order->getUser()->active_to = $order->getUser()->getActiveTo()->addMonth(1)->format('D M d Y');
            else
                $order->getUser()->active_to = $order->getUser()->getActiveTo()->addMonth(3)->format('D M d Y');
        }

        // $order->getUser()->getPlan()->associate($order->getPlan());
        // $order->getUser()->save();

        return $order;
    }
}