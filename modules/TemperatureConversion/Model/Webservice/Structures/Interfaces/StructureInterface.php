<?php

namespace TemperatureConversion\Model\Webservice\Structures\Interfaces;

interface StructureInterface
{
    /**
     * @return float
     */
    public function getTemperatureValue();

    /**
     * @param float $celsius
     * @return StructureInterface $this
     */
    public function setTemperatureValue($value);

    /**
     * @return string
     */
    public function getResultProperty();
}
