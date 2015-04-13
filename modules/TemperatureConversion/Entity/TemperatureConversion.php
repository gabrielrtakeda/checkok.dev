<?php

namespace TemperatureConversion\Entity;

class TemperatureConversion
{

    /**
     * @var int
     */
    public $idConsulta;

    /**
     * @var float
     */
    public $requisicaoTemperatura;

    /**
     * @var string
     */
    public $requisicaoTipo;

    /**
     * @var float
     */
    public $respostaTemperatura;

    /**
     * @var timetamp
     */
    public $datahoraConsulta;

    /**
     * @var string
     */
    public $ipRequisitante;

    /**
     * @var string
     */
    public $xmlGerado;


    /**
     * @return int
     */
    public function getIdConsulta()
    {
        return $this->idConsulta;
    }

    /**
     * @param int $idConsulta
     * @return self
     */
    public function setIdConsulta($idConsulta)
    {
        $this->idConsulta = $idConsulta;
        return $this;
    }

    /**
     * @return float
     */
    public function getRequisicaoTemperatura()
    {
        return $this->requisicaoTemperatura;
    }

    /**
     * @param float $requisicaoTemperatura
     * @return self
     */
    public function setRequisicaoTemperatura($requisicaoTemperatura)
    {
        $this->requisicaoTemperatura = $requisicaoTemperatura;
        return $this;
    }

    /**
     * @return string
     */
    public function getRequisicaoTipo()
    {
        return $this->requisicaoTipo;
    }

    /**
     * @param string $requisicaoTipo
     * @return self
     */
    public function setRequisicaoTipo($requisicaoTipo)
    {
        $this->requisicaoTipo = $requisicaoTipo;
        return $this;
    }

    /**
     * @return float
     */
    public function getRespostaTemperatura()
    {
        return $this->respostaTemperatura;
    }

    /**
     * @param float $respostaTemperatura
     * @return self
     */
    public function setRespostaTemperatura($respostaTemperatura)
    {
        $this->respostaTemperatura = $respostaTemperatura;
        return $this;
    }

    /**
     * @return timestamp
     */
    public function getDatahoraConsulta()
    {
        return $this->datahoraConsulta;
    }

    /**
     * @param timestamp $datahoraConsulta
     * @return self
     */
    public function setDatahoraConsulta($datahoraConsulta)
    {
        $this->datahoraConsulta = $datahoraConsulta;
        return $this;
    }

    /**
     * @return string
     */
    public function getIpRequisitante()
    {
        return $this->ipRequisitante;
    }

    /**
     * @param string $ipRequisitante
     * @return self
     */
    public function setIpRequisitante($ipRequisitante)
    {
        $this->ipRequisitante = $ipRequisitante;
        return $this;
    }

    /**
     * @return string
     */
    public function getXmlGerado()
    {
        return $this->xmlGerado;
    }

    /**
     * @param string $xmlGerado
     * @return self
     */
    public function setXmlGerado($xmlGerado)
    {
        $this->xmlGerado = $xmlGerado;
        return $this;
    }
}
