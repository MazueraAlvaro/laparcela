<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderProduct;
use App\Models\Payment;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {

        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $orders = Order::paginate();
        return OrderResource::collection($orders);
    }

    public function storeFromCart()
    {
        $order = $this->orderRepository->getActualOrder(false);
        $session = activeSession(["shoppingCart"]);
        if(!$order){
            $number = $this->orderRepository->getNextOrderNumber();
            $order = $session->orders()->create(["date" => now(), "total" => 0, "number" => $number, "subtotal" => 0]);
        }
        if($order->products()->exists()){
            $order->products()->delete();
            $order->date = now();
        }
        $total = 0;
        if(! $session->shoppingCart()->exists())
            throw new BadRequestHttpException("No existe un carro de compras creado para la actual session");
        foreach ($session->shoppingCart->products as $product){
            $orderProduct = new OrderProduct();
            $orderProduct->fill($product->toArray());
            $orderProduct->price = $product->actual_price;
            $orderProduct->quantity = $product->cartProduct->quantity;
            $total += $orderProduct->calcSubtotal();
            $order->products()->save($orderProduct);
        }
        $order->subtotal = $total;
        $order->calcTotal();
        $order->save();
        return new OrderResource($order);
    }

    public function store(Request $request)
    {
        $order = $this->orderRepository->getActualOrder();
        if($order->detail()->exists())
            throw new BadRequestHttpException("Ya existe una orden activa con detalles");
        $request->validate([
            "first_name" => ["required", "max:100"],
            "last_name" => ["required", "max:100"],
            "city" => ["required", "max:100"],
            "address" => ["required", "max:100"],
            "address_additional" => ["sometimes", "max:100"],
            "phone" => ["required", "numeric"],
            "email" => ["required", "email:rfc"],
        ]);
        $orderDetail = OrderDetail::make($request->all());

        if(!$order)
            throw new NotFoundHttpException("Orden no iniciada aún");
        $order->detail()->save($orderDetail);
        $order->load("detail");
        return new OrderResource($order);
    }

    public function show($orderId)
    {
        $order = $this->orderRepository->getActualOrder(true, ["products", "detail"]);
        return new OrderResource($order);
    }

    public function update(Request $request, $orderId)
    {
        /** @var Order $order */
        $order = $this->orderRepository->getActualOrder(true, ["products"]);
        if(!$order->detail()->exists())
            throw new BadRequestHttpException("No existe una orden activa con detalles");
        $request->validate([
            "first_name" => ["required", "max:100"],
            "last_name" => ["required", "max:100"],
            "city" => ["required", "max:100"],
            "address" => ["required", "max:100"],
            "address_additional" => ["sometimes", "max:100"],
            "phone" => ["required", "numeric"],
            "email" => ["required", "email:rfc"],
        ]);
        $order->detail()->update($request->all());
        $order->load(["detail"]);
        return new OrderResource($order);
    }

    public function close(Request $request)
    {
        $order = $this->orderRepository->getActualOrder();
        $request->validate([
            "payment_id" => ["required", "exists:".Payment::class.",id"]
        ]);
        $cart = activeSession(["shoppingCart"])->shoppingCart->products()->sync([]);
        $order->payment()->associate($request->get("payment_id"));
        $order->closed = true;
        $order->date = now();
        $order->save();
        return response()->json(["data"=> true]);
    }
}
