<?php

/*
 Base controller
 Loads models and views 
 */

 class Controller {
     // Load model
     public function model($model) 
     {
         // require file from models folder
         require_once '../app/models/' . $model . '.php';
         // INstansiate the model, return is there because the function called model returns an instantiation of the model
         return new $model();
         // this is : return new Pages();
    }
    public function view($view, $data = []) 
    {
        if (file_exists('../app/views/pages/' . $view . '.php'))
        {
        //require file from views folder
        require_once '../app/views/pages/' . $view . '.php';
        } else 
        {
            die("The view does not exists");
        }

    }
 }
