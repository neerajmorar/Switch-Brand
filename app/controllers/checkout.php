<?php
session_start();

//child class handling the checkout of basket
class Checkout extends Controller {
    //evaluates whether user is logged in; if so display cards to pay with
    public function index() {
        if (isset($_SESSION["user"])) {
            $cardCheck = $this->model("Cart");
            $cardCheck->cardCheck($_SESSION["email"]);

            $this->view($cardCheck->view, array($cardCheck->cards, $cardCheck->exp));
        } else {
            header("Location: index.php?url=login/index");
            exit();
        }
    }
    
    //method to add cards for user to pay with
    public function add() {
        //checks if data posted by user is valid; helps prevent SQL Injection
        $valid = true;
        
        //16 digit number needed for card
        if (preg_match("/^(\d{16})+$/", $_POST["card"]) === 0) {
            $_SESSION["cardBorder"] = "1px solid #aa0000";
            $_SESSION["cardWarn"] = true;
            $valid = false;
        }
        
        //checks if expiry date hasn't already passed
        if ($_POST["expYear"] == idate("y")) {
            if ($_POST["expMonth"] <= idate("m")) {
                $_SESSION["expBorder"] = "1px solid #aa0000";
                $_SESSION["expWarn"] = true;
                $valid = false;
            }
        }
        
        //3 digit number needed for card security number
        if (preg_match("/^(\d{3})+$/", $_POST["secNo"]) === 0) {
            $_SESSION["secBorder"] = "1px solid #aa0000";
            $_SESSION["secWarn"] = true;
            $valid = false;
        }

        if ($valid == false) {
            $this->view("vwNewCard");
        } else {
            $add = $this->model("Cart");
            $add->addCard($_POST["card"], $_POST["expMonth"] . "/" . $_POST["expYear"], $_POST["secNo"], $_SESSION["email"]);

            $this->view($add->view, $add->message);
        }
    }
    
    //method to direct user to add card page
    public function newCard() {
        $this->view("vwNewCard");
    }
    
    //handles the final part of checkout process
    public function finalise() {
        if (empty($_POST["card"])) {
            $_SESSION["selectWarn"] = true;
            header("Location: index.php?url=checkout/index");
            exit();
        } else {
            $submit = $this->model("Cart");
            $submit->finaliseCart($_SESSION["email"], $_POST["card"]);

            $this->view("vwFinal", array($submit->products, $submit->user, $submit->cards));
        }
    }
    
    //places order for user
    public function order($card, $cost) {
        $order = $this->model("Cart");
        $order->placeOrder($_SESSION["email"], $card, $cost);

        $this->view("vwThanks");
    }

}
