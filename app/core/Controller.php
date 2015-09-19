<?php

//parent controller class, used to link child controllers to appropriate models
class Controller {
    public function model($model) {
        if (file_exists('../app/models/' . $model . '.php')) {
            require_once '../app/models/' . $model . '.php';
        }
        
        return new $model();
    }
    
    //method which selects appropriate view to relating model
    public function view($view, $data = array()) {
        require_once '../app/views/' . $view . '.php';
    }
}

