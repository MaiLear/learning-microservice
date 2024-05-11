<?php
require_once './Config/Controller.php';

class PresaleController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function store()
    {
        if (count($_POST) == 0) {
            http_response_code(400);
            throw new Exception('not attribute found');
        }

        if ($this->model->store('presales', $_POST)) {
            $response = json_encode(['ok' => true, 'msg' => 'presale save sucessfull']);
            http_response_code(201);
            print_r($response);
        } else {
            $response = json_encode(['ok' => false, 'msg' => 'products dont saving, internal serve error']);
            http_response_code(500);
            print_r($response);
        }
    }
}
