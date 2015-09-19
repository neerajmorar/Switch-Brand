<?php
session_start();

//child class used to show selected item by user
class Item extends Controller {
    public function index($prodid) {
        $product = $this->model('Product');
        $item = $product->selectedProduct($prodid);
        $price = $item["Price"];
        $desc = $item["Description"];
        $quan = $item["Quantity"];
        $model = $item["Model"];
        
        $this->view('vwItem', array(array("price" => $price, "model" => urldecode($model), "id" => $prodid, "desc" => $desc, "quan" => $quan), $product->products));
    }
}

