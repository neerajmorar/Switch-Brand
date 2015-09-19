<?php

//model class for importing products from database to display
class Product {

    private $connection;
    private $result;
    public $products = array();

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

    public function selectedProduct($prodid) {
        for ($i = 0; $i < count($this->products); $i++) {
            if ($this->products[$i]["ProdID"] == $prodid) {
                return $this->products[$i];
            }
        }
    }

    //method similar to construct, adjusted query to match user's search input
    public function searchProduct($search) {
        unset($this->products);

        $this->connection = mysqli_connect('localhost', '21249593', '21249593', '21249593');

        $search = preg_replace('/[[:space:]]+/', '%', $search);

        $searchFilt = mysqli_real_escape_string($this->connection, $search);

        $query = "SELECT * FROM Products WHERE Quantity > 0 AND Active_YN = 1 AND (Model LIKE '%$searchFilt%' OR Description LIKE '%$searchFilt%')";

        $this->result = mysqli_query($this->connection, $query);

        while (($Row = mysqli_fetch_assoc($this->result)) != false) {
            $this->products[] = $Row;
        }

        if (isset($this->products[0]) == false) {
            mysqli_free_result($this->result);
            $query = "SELECT * FROM Products WHERE Quantity > 0 AND Active_YN = 1";
            $this->result = mysqli_query($this->connection, $query);
            while (($Row = mysqli_fetch_assoc($this->result)) != false) {
                $this->products[] = $Row;
            }
        }

        mysqli_free_result($this->result);
        mysqli_close($this->connection);
    }

}
