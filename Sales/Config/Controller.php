<?php

class Controller{
    protected object $model;
    public function __construct()
    {
        $this->getModel();
    }

    public function getModel(){
        $nameModel = str_replace('Controller','',get_class($this));
        $routeModel = "./Models/$nameModel.php";
        if(file_exists($routeModel)){
            require_once $routeModel;
            $this->model = new $nameModel();
        }
        
    }
}