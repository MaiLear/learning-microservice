<?php
require_once './Config/Controller.php';
require_once './Controllers/Mongodb/InfoController.php';
class ProductController extends Controller
{
    public function __construct()
    {
        $afterRouteModel = 'Mysql';
        parent::__construct($afterRouteModel);
    }

    public function index()
    {
        $data = $this->model->getAllProducts('products');
        print_r($data);
    }

    public function store()
    {
        $msg = '';
        $responseCode = '';
        $response = '';
        if (count($_POST) == 0) {
            $msg = 'not attribute found in array $_POST';
            $responseCode = 401;
            $response = json_encode(['ok' => false, 'msg' => $msg]);
        } else {
            $response = $this->model->store('products', $_POST);
            if ($response) {
                $msg = 'products saved sucessfull';
                $responseCode = 201;
                $response = json_encode(['ok' => true, 'msg' => $msg]);
            } else {
                $msg = 'products dont saved, internal serve error';
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
    public function update(int $id)
    {
        $msg = '';
        $responseCode = '';
        $response = '';
        if (count($_POST) == 0) {
            $msg = 'not attribute found in array $_POST';
            $responseCode = 401;
            $response = json_encode(['ok' => false, 'msg' => $msg]);
        } else {
            $response = $this->model->update('products', $id, $_POST);
            if ($response) {
                $msg = 'products update sucessfull';
                $responseCode = 201;
                $response = json_encode(['ok' => true, 'msg' => $msg]);
            } else {
                $responseCode = 500;
                $response = json_encode(['ok' => false, 'msg' => 'products dont saving, internal serve error']);
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
