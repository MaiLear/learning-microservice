<?php

class ControllerResponses
{
    public static $timeClear;
    public static $instance;
    private $responses = [];




    public static function getInstace()
    {
        ControllerResponses::$instance = ControllerResponses::$instance ?? new ControllerResponses();
        return ControllerResponses::$instance;
    }

    public function setResponses(string $keyResponse, array|string $values)
    {
        $this->responses[$keyResponse] = $values;
    }


    public function getResponses(string $keyResponse): array|string
    {
        return $this->responses[$keyResponse];
    }


    public function clearResponses()
    {
        $this->responses = [];
    }

}
