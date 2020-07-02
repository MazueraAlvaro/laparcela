<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Mockery\Exception\BadMethodCallException;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::paginate();
        return OrderResource::collection($orders);
    }

    public function storeFromCart()
    {
        $session = activeSession(["shoppingCart"]);
        $order = $session->orders()->where("closed", false)->first();
        if(!$order){
            $lastOrder = Order::orderBy("number")->select("number")->first()->number;
            $lastOrder = (!$lastOrder) ? 0 : $lastOrder;
            $order = $session->orders()->create(["date" => now(), "total" => 0, "number" => ++$lastOrder]);
        }
        if($order->products()->exists()){
            $order->products()->delete();
            $order->date = now();
        }
        $total = 0;
        if(! $session->shoppingCart()->exists())
            throw new BadMethodCallException("No existe un carro de compras creado para la acutal session");
        foreach ($session->shoppingCart->products as $product){
            $orderProduct = new OrderProduct();
            $orderProduct->fill($product->toArray());
            $orderProduct->price = $product->actual_price;
            $orderProduct->quantity = $product->cartProduct->quantity;
            $total += $orderProduct->calcSubtotal();
            $order->products()->save($orderProduct);
        }
        $order->total = $total;
        $order->save();
        return new OrderResource($order);
    }

    public function show($orderId)
    {
        $session = activeSession();
        $order = $session->orders()->where("closed", false)->with("products")->first();
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
