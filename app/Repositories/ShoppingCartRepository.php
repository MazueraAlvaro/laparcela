<?php


namespace App\Repositories;


use App\Models\Session;
use App\Models\ShoppingCart;

class ShoppingCartRepository
{
    public function get()
    {
        $session = $this->getSession();
        return $session->shoppingCart;
    }

    private function getSession()
    {
        $session_id = session("session_id");
        if(!$session_id or ! $session = Session::with("shoppingCart")->find($session_id)){
            $session = Session::create(['data' => '']);
            session(["session_id" => $session->id]);
            $session->shoppingCart()->save(new ShoppingCart());
        }
        return $session;
    }

    public function isMyShoppingCart($shoppingCart)
    {
        if($shoppingCart instanceof ShoppingCart)
            $shoppingCartId = $shoppingCart->id;
        else
            $shoppingCartId = (int) $shoppingCart;
        $session = $this->getSession();
        return $session->shoppingCart->id === (int) $shoppingCartId;
    }
}
