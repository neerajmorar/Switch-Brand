<?php
session_start();

//child class used to handle user login
class Login extends Controller {
    //directs user to login page
    public function index() {
        $this->view('vwLogin');
    }
    
    //direct user to register page
    public function register() {
        $this->view('vwRegister');
    }
    
    //method used to evaluate user input and register them
    public function confirmReg() {
        $valid = true;
        
        //valid email needed
        if (preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $_POST["email"]) === 0) {
            $_SESSION["emailBorder"] = "1px solid #aa0000";
            $_SESSION["emailWarn"] = true;
            $valid = false;
        }
        
        //valid password needed
        if (empty($_POST["password"])) {
            $_SESSION["passBorder"] = "1px solid #aa0000";
            $_SESSION["passWarn"] = true;
            $valid = false;
        } else {
            if ($_POST["password"] != $_POST["passwordcon"]) {
                $_SESSION["passBorder"] = "1px solid #aa0000";
                $_SESSION["verWarn"] = true;
                $valid = false;
            }
        }
        
        //valid first name needed...
        if (preg_match("/^[a-zA-Z-']+$/", $_POST["fName"]) === 0) {
            $_SESSION["fBorder"] = "1px solid #aa0000";
            $_SESSION["fWarn"] = true;
            $valid = false;
        }
        
        //...and surname
        if (preg_match("/^[a-zA-Z-']+$/", $_POST["lName"]) === 0) {
            $_SESSION["sBorder"] = "1px solid #aa0000";
            $_SESSION["sWarn"] = true;
            $valid = false;
        }
        
        //valid telephone number
        if (preg_match("/^(\d{11})+$/", $_POST["tel"]) === 0) {
            $_SESSION["tBorder"] = "1px solid #aa0000";
            $_SESSION["telWarn"] = true;
            $valid = false;
        }
        
        //valid address details
        if (preg_match("/^[0-9a-zA-Z- ]+$/", $_POST["addOne"]) === 0) {
            $_SESSION["add1Border"] = "1px solid #aa0000";
            $_SESSION["add1Warn"] = true;
            $valid = false;
        }
        if (!empty($_POST["addTwo"])) {
            if (preg_match("/^[0-9a-zA-Z- ]+$/", $_POST["addTwo"]) === 0) {
                $_SESSION["add2Border"] = "1px solid #aa0000";
                $_SESSION["add2Warn"] = true;
                $valid = false;
            }
        }
        if (preg_match("/^[0-9a-zA-Z- ]+$/", $_POST["addThree"]) === 0) {
            $_SESSION["add3Border"] = "1px solid #aa0000";
            $_SESSION["add3Warn"] = true;
            $valid = false;
        }
        if (preg_match("/^[a-zA-Z- ]+$/", $_POST["city"]) === 0) {
            $_SESSION["cityBorder"] = "1px solid #aa0000";
            $_SESSION["cityWarn"] = true;
            $valid = false;
        }
        
        //valid post code
        if (preg_match("/^\w{2,4}([ ]?\w{3})$/", $_POST["postCode"]) === 0) {
            $_SESSION["postBorder"] = "1px solid #aa0000";
            $_SESSION["postWarn"] = true;
            $valid = false;
        } else if (empty($_POST["postCode"])) {
            $_SESSION["postBorder"] = "1px solid #aa0000";
            $_SESSION["postWarn"] = true;
            $valid = false;
        }

        if ($valid == false) {
            header("Location: index.php?url=login/register");
            exit();
        } else {
            $register = $this->model('User');
            $register->register($_POST["email"], $_POST["fName"], $_POST["lName"], $_POST["tel"], sha1($_POST["password"]), $_POST["addOne"], $_POST["addTwo"], $_POST["addThree"], $_POST["city"], $_POST["postCode"]);

            if (isset($register->message)) {
                $this->view('vwRegister', $register->message);
            } else {
                header("Location: index.php");
                exit();
            }
        }
    }

    //logs user out
    public function out() {
        unset($_SESSION["user"]);

        header("Location: index.php");
        exit();
    }

    //logs user in
    public function in() {
        $in = $this->model('User');
        $in->LogIn($_POST["email"], sha1($_POST["password"]));

        if (isset($in->message)) {
            $this->view('vwLogin', $in->message);
        } else {
            header("Location: index.php");
            exit();
        }
    }

}
