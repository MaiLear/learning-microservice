<?php

class Controller{
    protected $model;
    public function __construct(string $afterRouteModel)
    {
        $this->getModel($afterRouteModel);
    }

    public function getModel(string $afterRouteModel){
        $nameModel = str_replace('Controller','',get_class($this));
        $routeModel = "./Models/{$afterRouteModel}/$nameModel.php";
        if(file_exists($routeModel)){
            require_once $routeModel;
            $this->model = new $nameModel();
        }
    }
}