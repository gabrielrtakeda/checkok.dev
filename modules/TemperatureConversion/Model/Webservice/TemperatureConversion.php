<?php

namespace TemperatureConversion\Model\Webservice;

use Database\Connection\AbstractDatabaseConnection;
use TemperatureConversion\Model\Webservice\Structures\CelsiusToFahrenheit;
use TemperatureConversion\Model\Webservice\Structures\FahrenheitToCelsius;
use TemperatureConversion\Entity\TemperatureConversion as TemperatureConversionEntity;

class TemperatureConversion
{
    protected $location = 'http://www.w3schools.com/webservices/tempconvert.asmx';
    protected $soapClient;
    protected $databaseAdapter;

    public function __construct(AbstractDatabaseConnection $databaseAdapter) {
        $this->soapClient = $this->buildSoapClient(true);
        $this->databaseAdapter = $databaseAdapter;
    }

    public function convert($data)
    {
        $jsonResponse = [
            'response' => '',
            'error' => '',
        ];

        try {
            $payload = ucfirst($data['conversionType']);
            $structure = $this->buildStructure($data);
            $arguments = [$structure];
            $options = [
                'location' => $this->location
            ];
            $response = $this->soapClient->__soapCall($payload, $arguments, $options);
            $jsonResponse['response'] = $response->{$structure->getResultProperty()};

        } catch (\SOAPFault $exception) {
            $errorMessage  = 'Exception: ' . $exception . "\n";
            $errorMessage .= 'Soap Last Request: ' . htmlspecialchars(
                $this->soapClient->__getLastRequest()
            );
            $jsonResponse['error'] = $errorMessage;
        }

        $temperatureConversionEntity = new TemperatureConversionEntity();
        $temperatureConversionEntity->setRequisicaoTemperatura($structure->getTemperatureValue())
                                    ->setRequisicaoTipo($payload)
                                    ->setRespostaTemperatura($jsonResponse['response'])
                                    ->setDatahoraConsulta(date('Y-m-d H:i:s'))
                                    ->setIpRequisitante($this->getUserIp())
                                    ->setXmlGerado($this->soapClient->__getLastResponse());

        $this->databaseAdapter->save($temperatureConversionEntity);
        print json_encode($jsonResponse);
    }

    /**
     * @return SoapClient
     */
    private function buildSoapClient($trace)
    {
        return new \SoapClient(
            $this->location . '?WSDL',
            [ 'trace' => $trace ]
        );
    }

    private function getTemperatureType($conversionType)
    {
        return strtolower(explode('To', $conversionType)[0]);
    }

    private function buildStructure($data)
    {
        $temperatureType = $this->getTemperatureType($data['conversionType']);
        $structure = $this->structureStrategy($temperatureType);
        $structure->setTemperatureValue($data[$temperatureType]);

        return $structure;
    }

    private function structureStrategy($temperatureType)
    {
        return $temperatureType == 'celsius'
            ? new CelsiusToFahrenheit()
            : new FahrenheitToCelsius();
    }

    private function getUserIp()
    {
        $xff = isset($_SERVER['HTTP_X_FORWARDED_FOR'])
            ? $_SERVER['HTTP_X_FORWARDED_FOR']
            : null;

        return !empty($xff)
            ? $_SERVER['HTTP_X_FORWARDED_FOR']
            : $_SERVER['REMOTE_ADDR'];
    }
}
