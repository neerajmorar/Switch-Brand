<?php
session_start();


//child class of controller; handles adding items to basket
class Add extends Controller {
    //method which adds items to basket
    public function index($item) {
        $add = $this->model('AddToBasket');
        $add->addToBasket($item);
        
        $this->view('vwAdd', array($item, $add->products, $add->message));
    }
    
    //method removing items from basket
    public function remove($item) {
        $remove = $this->model('AddToBasket');
        $remove->removeFromBasket($item);
        
        header("Location: index.php?url=basket/index");
    }
    
    //method which handles changing of item quantities
    public function quantity($item) {
        $quanChange = $_POST["quanChange"];
        $quantity = $this->model('AddToBasket');
        $quantity->quantityChange($item, $quanChange);
    }
    
    //handles editing of item in basket
    public function edit($item) {
        $edit = $this->model('AddToBasket');
        
        $this->view('vwEdit', array($item, $edit->products));
    }
}

