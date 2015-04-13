<?php

namespace TemperatureConversion\Model\DatabaseAdapter;

use Database\Adapter\MysqlDatabaseAdapter;
use TemperatureConversion\Model\DatabaseAdapter\TemperatureConversion as TemperatureConversionAdapter;
use TemperatureConversion\Entity\TemperatureConversion as TemperatureConversionEntity;

class TemperatureConversion extends MysqlDatabaseAdapter
{
    protected $tableDataGateway = 'checkok.pesquisa';

    public function __construct()
    {
        parent::__construct();
    }

    public function save(TemperatureConversionEntity $temperatureEntity)
    {
        $saveEntity = [
            'requisicao_temperatura' => $temperatureEntity->getRequisicaoTemperatura(),
            'requisicao_tipo'        => $temperatureEntity->getRequisicaoTipo(),
            'resposta_temperatura'   => $temperatureEntity->getRespostaTemperatura(),
            'datahora_consulta'      => $temperatureEntity->getDataHoraConsulta(),
            'ip_requisitante'        => $temperatureEntity->getIpRequisitante(),
            'xml_gerado'             => $temperatureEntity->getXmlGerado(),
        ];

        if ($id = $this->hasId($temperatureEntity)) {
            $saveEntity['id_consulta'] = $id;
            $this->update($saveEntity);

        } else {
            $this->insert($saveEntity);
        }
    }

    /**
     * @param TemperatureConversionEntity $temperatureEntity
     * @return mixed(int, boolean)
     */
    private function hasId(TemperatureConversionEntity $temperatureEntity)
    {
        $id = $temperatureEntity->getIdConsulta();
        return isset($id) && !empty($id) ? $id : false;
    }
}
