<?php
require_once './Config/Controller.php';

class HomeController extends Controller
{
    public function __construct()
    {
        $afterRouteModel = 'Mysql';
        parent::__construct($afterRouteModel);
    }

    public function index()
    {
        echo 'Welcome to api from products';
    }
}
