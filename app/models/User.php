<?php

//model class to handle user related data
class User {

    private $connection;
    private $result;
    private $user = array();
    public $message;

    //method to register user
    public function register($email, $forename, $surname, $tel, $password, $addOne, $addTwo, $addThree, $city, $postCode) {
        $this->connection = mysqli_connect('localhost', '21249593', '21249593', '21249593');
        
        //filters user input to prevent SQL Injection
        $emailFilt = mysqli_real_escape_string($this->connection, $email);
        $foreFilt = mysqli_real_escape_string($this->connection, $forename);
        $surFilt = mysqli_real_escape_string($this->connection, $surname);
        $telFilt = mysqli_real_escape_string($this->connection, $tel);
        $passFilt = mysqli_real_escape_string($this->connection, $password);
        $add1Filt = mysqli_real_escape_string($this->connection, $addOne);
        $add2Filt = mysqli_real_escape_string($this->connection, $addTwo);
        $add3Filt = mysqli_real_escape_string($this->connection, $addThree);
        $cityFilt = mysqli_real_escape_string($this->connection, $city);
        $postFilt = mysqli_real_escape_string($this->connection, $postCode);

        $query = "SELECT C_Email FROM Client WHERE C_Email = '$emailFilt'";

        $this->result = mysqli_query($this->connection, $query);

        while (($Row = mysqli_fetch_assoc($this->result)) != false) {
            $this->user[] = $Row;
        }

        if ($this->user[0]["C_Email"] == $emailFilt) {
            $this->message = "<span class='commonWarning' style='color: #AA0000; display: inline;'>This email has already been registered.</span>";
        } else {
            $query = "INSERT INTO Client VALUES ('$emailFilt','$foreFilt','$surFilt','$telFilt','$passFilt','$add1Filt','.$add2Filt','$add3Filt','$cityFilt','$postFilt')";
            mysqli_query($this->connection, $query);
            $_SESSION["user"] = $foreFilt;
            $_SESSION["email"] = $emailFilt;
        }

        mysqli_free_result($this->result);
        mysqli_close($this->connection);
    }

    //finds user in database and creates session for user
    public function LogIn($email, $password) {
        $this->connection = mysqli_connect('localhost', '21249593', '21249593', '21249593');

        $emailFilt = mysqli_real_escape_string($this->connection, $email);
        $passFilt = mysqli_real_escape_string($this->connection, $password);

        $query = "SELECT C_Email, C_Forename, C_Password FROM Client WHERE C_Email = '$emailFilt' AND C_Password = '$passFilt'";

        $this->result = mysqli_query($this->connection, $query);

        while (($Row = mysqli_fetch_assoc($this->result)) != false) {
            $this->user[] = $Row;
        }
        
        if (isset($this->user[0]["C_Email"])) {
            $_SESSION["user"] = $this->user[0]["C_Forename"];
            $_SESSION["email"] = $this->user[0]["C_Email"];
        } else {
            $this->message = "<p style='color: #AA0000'>Your email or password is wrong.</p>";
        }
        
        mysqli_free_result($this->result);
        mysqli_close($this->connection);
    }

}
