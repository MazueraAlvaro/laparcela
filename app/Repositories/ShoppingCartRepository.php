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
        return activeSession(["shoppingCart"], true);
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
