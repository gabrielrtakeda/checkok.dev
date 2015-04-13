<?php

namespace TemperatureConversion\Model\Webservice\Structures;

use TemperatureConversion\Model\Webservice\Structures\Interfaces\StructureInterface;

class FahrenheitToCelsius implements StructureInterface
{
    /**
     * @var float
     */
    public $Fahrenheit;


    /**
     * @return float
     */
    public function getTemperatureValue()
    {
        return $this->Fahrenheit;
    }

    /**
     * @param float $celsius
     * @return StructureInterface $this
     */
    public function setTemperatureValue($fahrenheit)
    {
        $this->Fahrenheit = $fahrenheit;
        return $this;
    }

    /**
     * @return string
     */
    public function getResultProperty()
    {
        return 'FahrenheitToCelsiusResult';
    }
}
