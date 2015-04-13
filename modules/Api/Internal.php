<?php

namespace Api;

use Validator\ValidatorChain;
use Api\Validator\Parameter\ValidatorController;
use Api\Validator\Parameter\ValidatorData;
use TemperatureConversion\Controller\TemperatureConversionController;

class Internal
{
    protected $transmissor;
    protected $parameters;

    public function __construct()
    {
        $this->transmissor = $_POST;
    }

    public function request()
    {
        if ($this->validateParameters()) {
            $controller = new TemperatureConversionController();
            $controller->convert($this->transmissor['data']);
        }
    }

    protected function validateParameters()
    {
        $validator = new ValidatorChain();
        $validator->append(new ValidatorController($this->transmissor))
                  ->append(new ValidatorData($this->transmissor));

        return $validator->validate();
    }

    public function has()
    {
        return !empty($this->transmissor);
    }

    // protected function setTransmissor($transmissor)
    // {
    //     $
    // }
}

// $validator = [
//     'controller' = new ValidatorController($transmissor),
//     'data' = new ValidatorData($transmissor),
// ];
// if ($validator['controller']->exists()) {

// }

// if (file_exists(filename)) {

// }
