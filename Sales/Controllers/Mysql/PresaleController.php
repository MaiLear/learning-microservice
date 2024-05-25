<?php
require_once './Config/Controller.php';
require_once './Controllers/Mongodb/InfoController.php';
require_once './Responses/ControllerResponses.php';


class PresaleController extends Controller
{
    private $responses;

    public function __construct()
    {
        $this->responses = ControllerResponses::getInstace();
        $this->responses->clearResponses();
        $afterRouteModel = 'Mysql';
        parent::__construct($afterRouteModel);
    }

    
    public function index(){
        $response = $this->model->getAllPreSales('presales');
        echo json_encode($response);
    }

    public function store()
    {
        $valuesFromApi = json_decode(file_get_contents('php://input'), true);
        if (count($valuesFromApi) == 0) {
            $this->responses->setResponses('store', ['ok' => false, 'msg' => 'not attribute found in array $valuesFromApi', 'responseCode' => 401]);
        } else {
            $dataBaseResponse = $this->model->store('presales', $valuesFromApi);
            if (!is_string($dataBaseResponse)) {
                $this->responses->setResponses('store', ['ok' => true, 'msg' => 'presale saved sucessfull', 'responseCode' => 201]);
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
}
