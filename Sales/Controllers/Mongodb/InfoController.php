<?php
require_once './Config/Controller.php';

class InfoController extends Controller{
    public function __construct()
    {
        $afterRouteModel = 'Mongodb';
        parent::__construct($afterRouteModel);
    }
    public static function store(array $logs=[]){
        $infoController = new InfoController();
        if(empty($logs)) return;
        $logs['date'] = date('l jS \of F Y h:i:s A');
        $response = $infoController->model->store($logs,'info');
        if($response){
            $msg = 'logs insert successfull';
            $response = ['ok' => true, 'msg' => $msg];
        }else{
            $msg = "logs can't insert, plis check to try again";
            $response = ['ok' => true, 'msg' => $msg];
        }
        return $response;
    }
}