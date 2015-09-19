<?php

//model class for handling data relating to items already in the basket
class Cart {

    private $connection;
    private $result;
    public $user = array();
    public $products = array();
    public $message;
    public $cards = array();
    public $exp = array();
    public $view;

    //construct to import data needed in relation to products
    public function __construct() {
        $this->connection = mysqli_connect('localhost', '21249593', '21249593', '21249593');
        $query = "SELECT * FROM Products WHERE Quantity > 0 AND Active_YN = 1";

        $this->result = mysqli_query($this->connection, $query);

        while (($Row = mysqli_fetch_assoc($this->result)) != false) {
            $this->products[] = $Row;
        }

        $this->message = "<p>Your basket is empty. Click on the arrow above to return home.</p>";

        mysqli_free_result($this->result);
        mysqli_close($this->connection);
    }

    //checks if logged in user has a card to use
    public function cardCheck($email) {
        $this->connection = mysqli_connect('localhost', '21249593', '21249593', '21249593');
        $query = "SELECT * FROM ClientBankInfo WHERE ClientID = '$email'";

        $this->result = mysqli_query($this->connection, $query);

        while (($Row = mysqli_fetch_assoc($this->result)) != false) {
            $this->user[] = $Row;
        }

        if (isset($this->user[0]["CardNo"])) {
            for ($i = 0; $i < count($this->user); $i++) {
                $this->cards[] = ("XXXX-XXXX-XXXX-" . substr($this->user[$i]["CardNo"], 12));
            }

            for ($i = 0; $i < count($this->user); $i++) {
                $this->exp[] = $this->user[$i]["Exp_Date"];
            }

            $this->view = "vwCard";
        } else {
            $this->view = "vwNewCard";
        }

        mysqli_free_result($this->result);
        mysqli_close($this->connection);
    }

    //adds card to database for logged in user
    public function addCard($cardNo, $exp, $sec, $email) {
        $this->connection = mysqli_connect('localhost', '21249593', '21249593', '21249593');
        
        //filters posted data to prevent SQL Injection
        $cardFilt = mysqli_real_escape_string($this->connection, $cardNo);
        $expFilt = mysqli_real_escape_string($this->connection, $exp);
        $secFilt = mysqli_real_escape_string($this->connection, $sec);

        $query = "SELECT CardNo FROM ClientBankInfo WHERE CardNo = '$cardFilt' AND ClientID = '$email'";

        $this->result = mysqli_query($this->connection, $query);

        unset($this->user);

        while (($Row = mysqli_fetch_assoc($this->result)) != false) {
            $this->user[] = $Row;
        }

        if (isset($this->user[0]["CardNo"])) {
            $this->message = "<p style='color: #AA0000'>This card has already been registered.</p>";
            $this->view = "vwNewCard";
        } else {
            $query = "INSERT INTO ClientBankInfo VALUES ('$cardFilt', '$expFilt', '$secFilt', '$email')";
            mysqli_query($this->connection, $query);
            
            header("Location: index.php?url=checkout/index");
            exit();
        }

        mysqli_free_result($this->result);
        mysqli_close($this->connection);
    }

    //used to get info from database to produce confirmation page for checkout
    public function finaliseCart($email, $card) {
        $this->connection = mysqli_connect('localhost', '21249593', '21249593', '21249593');
        $query = "SELECT ProdID, Model, Price FROM Products WHERE Quantity > 0 AND Active_YN = 1";

        $this->result = mysqli_query($this->connection, $query);

        unset($this->products);
        unset($this->user);
        unset($this->cards);

        while (($Row = mysqli_fetch_assoc($this->result)) != false) {
            $this->products[] = $Row;
        }

        mysqli_free_result($this->result);

        $query = "SELECT * FROM Client WHERE C_Email = '$email'";

        $this->result = mysqli_query($this->connection, $query);

        while (($Row = mysqli_fetch_assoc($this->result)) != false) {
            $this->user[] = $Row;
        }

        $this->cards[] = $card;

        mysqli_free_result($this->result);
        mysqli_close($this->connection);
    }

    //places order and stores in database
    public function placeOrder($email, $card, $cost) {
        $this->connection = mysqli_connect('localhost', '21249593', '21249593', '21249593');
        $query = "SELECT CardNo FROM ClientBankInfo WHERE SUBSTRING(CardNo,13,4) = '$card' AND ClientID = '$email'";

        $this->result = mysqli_query($this->connection, $query);

        unset($this->cards);
        unset($this->user);
        unset($this->products);

        while (($Row = mysqli_fetch_assoc($this->result)) != false) {
            $this->cards[] = $Row;
        }

        mysqli_free_result($this->result);

        $query = "INSERT INTO OrderPlaced (ClientID, OrdDate, CardNo, OrderPrice) VALUES ('$email', CURDATE(), '" . $this->cards[0]["CardNo"] . "', $cost)";

        mysqli_query($this->connection, $query);

        $query = "SELECT MAX(OrderID) AS OrderID FROM OrderPlaced WHERE ClientID = '$email' AND OrdDate = CURDATE() AND CardNo = '" . $this->cards[0]["CardNo"] . "'";

        $this->result = mysqli_query($this->connection, $query);

        while (($Row = mysqli_fetch_assoc($this->result)) != false) {
            $this->user[] = $Row;
        }

        mysqli_free_result($this->result);

        foreach ($_SESSION["basket"] as $i => $i_value) {
            $query = "INSERT INTO OrderedProd VALUES (" . $this->user[0]["OrderID"] . ", $i, $i_value)";
            mysqli_query($this->connection, $query);
            
            $query = "SELECT Quantity FROM Products WHERE ProdID = $i";
            $this->result = mysqli_query($this->connection, $query);
            
            while (($Row = mysqli_fetch_assoc($this->result)) != false) {
                $this->products[] = $Row;
            }

            $query = "Update Products SET Quantity = " . ($this->products[0]["Quantity"] - $i_value) . " WHERE ProdID = $i";
            mysqli_query($this->connection, $query);
            mysqli_free_result($this->result);
        }
        
        unset($_SESSION["basket"]);
        
        mysqli_close($this->connection);
    }

}
