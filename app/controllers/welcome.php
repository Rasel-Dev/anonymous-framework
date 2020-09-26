<?php

class welcome extends Controller
{

    public function __construct()
    {
        $this->helper("link");
        // $this->welcomeModel = $this->model('welcomeModel');
    }

    public function index()
    {

        $this->view("welcome");
    }
}
