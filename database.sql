CREATE DATABASE `checkok`;
CREATE TABLE `checkok`.`pesquisa` (
    id_consulta INT PRIMARY KEY AUTO_INCREMENT,
    requisicao_temperatura FLOAT,
    requisicao_tipo VARCHAR(50),
    resposta_temperatura FLOAT,
    datahora_consulta TIMESTAMP,
    ip_requisitante VARCHAR(45),
    xml_gerado TEXT
);
DROP TABLE `checkok`.`pesquisa`;
SELECT * FROM `checkok`.`pesquisa`;
