<?php

namespace Api\Validator\Parameter;

use Validator\ValidatorChainInterface;

class ValidatorData implements ValidatorChainInterface
{
    private $transmissor;

    public function __construct($transmissor)
    {
        $this->transmissor = $transmissor;
    }

    public function validate()
    {
        return isset($this->transmissor['data']);
    }

    public function errorMessage()
    {
        return 'O índice "data" não existe.';
    }
}
