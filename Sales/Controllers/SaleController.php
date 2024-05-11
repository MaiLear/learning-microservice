<?php
require_once './Config/Controller.php';
class SaleController extends Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function store(){
        if(count($_POST) == 0) {
            http_response_code(401);
            throw new Exception('not attribute found');
        }
        if($this->model->store('sales',$_POST)){
            $response = json_encode(['ok'=>true,'msg' => 'products save sucessfull']);
            http_response_code(201);
            print_r($response);
        }
        else{
            $response = json_encode(['ok'=>false,'msg' => 'products dont saving, internal serve error']);
            http_response_code(500);
            print_r($response);
        }
    }
    
    public function update(int $id){
        if(count($_POST) == 0) {
            http_response_code(401);
            throw new Exception('not attribute found');
        }

        if($this->model->update('products',$id,$_POST)){
            http_response_code(201);
            return json_encode(['ok'=>true,'msg' => 'products update sucessfull']);
        }
        else{
            http_response_code(500);
            return json_encode(['ok'=>false,'msg' => 'products dont saving, internal serve error']);
        }
    }
}