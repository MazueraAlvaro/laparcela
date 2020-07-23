<?php


namespace App\Repositories;


use App\Models\Order;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class OrderRepository
{

    public function getActualOrder($withException = true, $orderRelations = [])
    {
        $order = activeSession()
            ->orders()
            ->where("closed", false)
            ->with($orderRelations)
            ->first();
        if($withException and !$order)
            throw new BadRequestHttpException("Aún no se ha creado una orden a partir del carro de compras");
        return $order;
    }

    public function getNextOrderNumber()
    {
        $lastOrder = Order::orderBy("number", "DESC")->select("number")->first();
        $lastOrder = (!$lastOrder) ? 0 : $lastOrder->number;
        return ++$lastOrder;
    }
}
