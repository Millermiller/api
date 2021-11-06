<?php


namespace Scandinaver\Billing\UI\Resource;


use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use Scandinaver\Billing\Domain\Entity\Order;
use Scandinaver\User\UI\Resource\UserTransformer;

/**
 * Class OrderTransformer
 *
 * @package Scandinaver\Billing\UI\Resource
 */
class OrderTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        'user',
        'payment',
        'service'
    ];

    public function transform(Order $order): array
    {
        return [
            'id'         => $order->getId(),
            'created_at' => $order->getCreatedAt()->format("Y-m-d H:i:s"),
        ];
    }

    public function includeUser(Order $order): Item
    {
        $user = $order->getUser();

        return $this->item($user, new UserTransformer());
    }

    public function includePayment(Order $order): Item
    {
        $payment = $order->getPayment();

        return $this->item($payment, new PaymentTransformer());
    }

    public function includeService(Order $order): Item
    {
        $service = $order->getService();

        return $this->item($service, new ServiceTransformer());
    }
}