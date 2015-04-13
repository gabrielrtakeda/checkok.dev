<?php

namespace Api\Validator\Parameter;

use Validator\ValidatorChainInterface;

class ValidatorController implements ValidatorChainInterface
{
    private $transmissor;

    public function __construct($transmissor)
    {
        $this->transmissor = $transmissor;
    }

    public function validate()
    {
        return isset($this->transmissor['controller']);
    }

    public function errorMessage()
    {
        return 'O índice "controller" não existe.';
    }
}
