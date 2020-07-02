<?php

use App\Models\Session;
use App\Models\ShoppingCart;

if (!function_exists('activeSession')) {

    /**
     * @param array $relations
     * @param bool $createShoppingCart
     * @return Session
     */
    function activeSession($relations = [], $createShoppingCart = false)
    {
        $session_id = session("session_id");
        if(!$session_id or ! $session = Session::with($relations)->find($session_id)){
            $session = Session::create(['data' => '']);
            session(["session_id" => $session->id]);
        }
        if($createShoppingCart and ! $session->shoppingCart()->exists()){
            $session->shoppingCart()->create([]);
            $session->save();
            $session->load("shoppingCart");
        }
        return $session;
    }
}
