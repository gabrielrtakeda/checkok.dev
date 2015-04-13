<?php

namespace Validator;

use Validator\ValidatorChainInterface;

class ValidatorChain
{
    /**
     * @var ValidatorChainInterface array
     */
    private $validators;

    /**
     * @return boolean
     */
    public function validate()
    {
        if ($this->hasValidators()) {
            foreach ($this->validators as $validator) {
                if (!$validator->validate()) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    /**
     * @param ValidatorChainInterface
     * @return ValidatorChain
     */
    public function append(ValidatorChainInterface $validator)
    {
        $this->validators[] = $validator;
        return $this;
    }

    protected function hasValidators()
    {
        return count($this->validators) > 0;
    }
}
