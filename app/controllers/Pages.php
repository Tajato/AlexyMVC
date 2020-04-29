<?php

class Pages extends Controller {
public function __construct() {

    }

    public function index() 
    {
    
        $this->view('index', $data = ['title'=> 'Welcome']);

    }

    public function about() {

        $this->view('about', $data = ['id' => 'About Us']);
    }
}

?>