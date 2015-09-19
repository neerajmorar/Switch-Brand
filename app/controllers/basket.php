<?php
session_start();

//child class retrieving items stored in basket
class Basket extends Controller {
    public function index() {
        $basket = $this->model('Cart');
        
        $this->view('vwBasket', array($basket->message, $basket->products));
    }
}

