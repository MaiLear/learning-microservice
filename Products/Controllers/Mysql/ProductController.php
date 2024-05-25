<?php
require_once './Config/Controller.php';
require_once './Controllers/Mongodb/InfoController.php';
require_once './Responses/ControllerResponses.php';
class ProductController extends Controller
{
    private $responses;
    public function __construct()
    {
        $this->responses = ControllerResponses::getInstace();
        $this->responses->clearResponses();
        $afterRouteModel = 'Mysql';
        parent::__construct($afterRouteModel);
    }

    public function index()
    {
        $data = $this->model->getAllProducts('products');
        echo json_encode($data);
    }

    public function store()
    {
        $valuesFromApi = json_decode(file_get_contents('php://input'), true);
        if (count($valuesFromApi) == 0) {
            $this->responses->setResponses('store', ['ok' => false, 'msg' => 'not attribute found in array $valuesFromApi', 'responseCode' => 401]);
        } else {
            $dataBaseResponse = $this->model->store('products', $valuesFromApi);
            if (!is_string($dataBaseResponse)) {
                $this->responses->setResponses('store', ['ok' => true, 'msg' => 'products saved sucessfull', 'responseCode' => 201]);
            } else {
                $this->responses->setResponses('store', ['ok' => false, 'msg' => $dataBaseResponse, 'responseCode' => 500]);
            }
        }
        //Se agrega un registro a los logs
        $controllerResponse = $this->responses->getResponses('store');
        $this->responses->setResponses('logs', ['info' => $controllerResponse['msg'], 'response_code' => $controllerResponse['responseCode']]);

        $logs = InfoController::store($this->responses->getResponses('logs'));

        echo json_encode([$this->responses->getResponses('store'),$logs]);
    }
    public function update(int $id)
    {
        $valuesFromApi = json_decode(file_get_contents('php://input'), true);
        if (count($valuesFromApi) == 0) {
            $this->responses->setResponses('update', ['ok' => false, 'msg' => 'not attribute found in array $valuesFromApi', 'responseCode' => 401]);
        } else {
            $dataBaseResponse = $this->model->update('products', $id, $valuesFromApi);
            if (!is_string($dataBaseResponse)) {
                $this->responses->setResponses('update', ['ok' => true, 'msg' => 'products update sucessfull', 'responseCode' => 201]);
            } else {
                $this->responses->setResponses('update', ['ok' => false, 'msg' => $dataBaseResponse, 'responseCode' => 500]);
            }
        }
        //Se agrega un registro a los logs
        $controllerResponse = $this->responses->getResponses('update');
        $this->responses->setResponses('logs', ['info' => $controllerResponse['msg'], 'response_code' => $controllerResponse['responseCode']]);

        $logs = InfoController::store($this->responses->getResponses('logs'));

        echo json_encode([$this->responses->getResponses('update'),$logs]);
    }
}
