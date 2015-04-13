<?php

namespace Validator;

interface ValidatorChainInterface
{
    public function validate();
    public function errorMessage();
}
