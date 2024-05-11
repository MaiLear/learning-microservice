<?php
require_once './Config/Controller.php';
class HomeController extends Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        echo 'Welcome to api from sales';
    }
}