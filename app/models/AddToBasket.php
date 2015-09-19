<?php

//model class which handles data for adding items to basket
class AddToBasket {

    private $connection;
    private $result;
    public $products = array();
    public $message;

    //construct method to import data needed for quantity change evaluation
    public function __construct() {
        $this->connection = mysqli_connect('localhost', '21249593', '21249593', '21249593');
        $query = "SELECT * FROM Products WHERE Quantity > 0 AND Active_YN = 1";

        $this->result = mysqli_query($this->connection, $query);

        while (($Row = mysqli_fetch_assoc($this->result)) != false) {
            $this->products[] = $Row;
        }

        mysqli_free_result($this->result);
        mysqli_close($this->connection);
    }

    //method which adds items to basket
    public function addToBasket($item) {
        if (isset($_SESSION["basket"]) == false) {
            $_SESSION["basket"] = array();
            $_SESSION["basket"][$item] = "1";
        } else {
            //evaluates if basket is empty or not
            if (count($_SESSION["basket"]) > 0) {
                //evaluates if item already in basket or not
                if (array_key_exists($item, $_SESSION["basket"]) == true) {
                    $this->message = "<p style='color: #AA0000;'>This has already been added to the basket, do you want to change the quantity?</p>";
                } else {
                    $_SESSION["basket"][$item] = "1";
                }
            } else {
                $_SESSION["basket"][$item] = "1"; //re-initliases basket
            }
        }
    }

    //removing from basket
    public function removeFromBasket($item) {
        unset($_SESSION["basket"][$item]);
    }

    //changing item quantity
    public function quantityChange($item, $quanChange) {
        for ($i = 0; $i < count($this->products); $i++) {
            if ($this->products[$i]["ProdID"] == $item) {
                $quantity = $this->products[$i]["Quantity"];
                break;
            }
        }

        if (($quantity - $quanChange) > -1) {
            //updates basket
            $_SESSION["basket"][$item] = $quanChange;
            print_r($quanChange);
            if ($_SESSION["file"] != "editbasket.php") {
                $_SESSION["quanWarning"] = "<p id='quanWarning'>Quantity updated; you will see this at checkout.</p>";
            }
        } else {
            $_SESSION["quanWarning"] = "<p id='quanWarning'>Not enough stock left.</p>";
        }

        if ($_SESSION["file"] == "editbasket.php") {
            unset($_SESSION["file"]);
            header("Location: index.php?url=basket/index");
            exit();
        } else {
            header("Location: index.php?url=add/index/" . $item);
            exit();
        }
    }

}
