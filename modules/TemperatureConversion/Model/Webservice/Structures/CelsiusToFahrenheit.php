<?php

namespace TemperatureConversion\Model\Webservice\Structures;

use TemperatureConversion\Model\Webservice\Structures\Interfaces\StructureInterface;

class CelsiusToFahrenheit implements StructureInterface
{
    /**
     * @var float
     */
    public $Celsius;


    /**
     * @return float
     */
    public function getTemperatureValue()
    {
        return $this->Celsius;
    }

    /**
     * @param float $celsius
     * @return StructureInterface $this
     */
    public function setTemperatureValue($celsius)
    {
        $this->Celsius = $celsius;
        return $this;
    }

    /**
     * @return string
     */
    public function getResultProperty()
    {
        return 'CelsiusToFahrenheitResult';
    }
}
