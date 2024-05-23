<?php
require_once './Config/Controller.php';
require_once './Controllers/Mongodb/InfoController.php';

class PresaleController extends Controller
{
    public function __construct()
    {
        $afterRouteModel = 'Mysql';
        parent::__construct($afterRouteModel);
    }

    
    public function index(){
        $response = $this->model->getAllPreSales('presales');
        var_dump($response);
    }

    public function store()
    {
        $msg = '';
        $responseCode = '';
        $response = '';
        if (count($_POST) == 0) {
            $msg = 'not attribute found in array $_POST';
            $responseCode = 400;
            $response = json_encode(['ok' => false, 'msg' => $msg]);
        } else {
            $response = $this->model->store('presales', $_POST);
            if ($response) {
                $msg = 'presale saved sucessfull';
                $responseCode = 201;
                $response = json_encode(['ok' => true, 'msg' => $msg]);
            } else {
                $msg = 'presale dont saved, internal serve error';
                $responseCode = 500;
                $response = json_encode(['ok' => false, 'msg' => $msg]);
            }

            //Se agrega un registro a los logs
            if ($responseCode == 200 || $responseCode == 201) {
                InfoController::store(['normal_info' => $msg, 'anormal_info' => 0, 'response_code' => $responseCode]);
            } else {
                InfoController::store(['normal_info' => 0, 'anormal_info' => $msg, 'response_code' => $responseCode]);
            }

            http_response_code($responseCode);
            print_r($response);
        }
    }
}
