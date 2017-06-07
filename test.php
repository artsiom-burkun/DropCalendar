<?php
/**
 * Created by PhpStorm.
 * User: Артем
 * Date: 04.06.2017
 * Time: 22:38
 */
// Подключаем
define('MODX_API_MODE', true);
require '../index.php';

// Включаем обработку ошибок
$modx->getService('error','error.modError');
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');

echo '<pre>';
print_r($modx->config);