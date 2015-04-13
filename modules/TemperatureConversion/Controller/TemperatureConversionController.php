<?php

namespace TemperatureConversion\Controller;

use TemperatureConversion\Model\Webservice\TemperatureConversion as TemperatureConversionModel;
use TemperatureConversion\Model\DatabaseAdapter\TemperatureConversion as TemperatureConversionAdapter;

class TemperatureConversionController
{
    public function convert($data)
    {
        $temperatureConversionModel = new TemperatureConversionModel(
            new TemperatureConversionAdapter()
        );
        $temperatureConversionModel->convert($data);
    }

    public function getView()
    {
        return __DIR__ . '/../View/index.html';
    }
}
