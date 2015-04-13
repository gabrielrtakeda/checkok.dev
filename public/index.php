<?php

$basePath = dirname(__FILE__);
$config = include_once $basePath . '/../config/global.config.php';

include $basePath . '/../autoloader.php';

$api = new $config['apiInternal']();
if ($api->has()) {
    $api->request();
    exit;
}

$application = new $config['baseModule']();
include $application->getView();


// $application->append();
// var_dump($application->validate());

// require $basePath . '/../modules/' . $config['baseModule'] . '/View/index.html';

// $validator = new Api\Validator\Parameter\TemperatureConversion();

// echo '<pre>';

