<?php

require_once __DIR__ . '/mysql.php';

use Web\DataModel\MySQL;

$app = array();

// parse configuration
$config = array(
  'mysql_dsn' => 'mysql:host=db;port=3306;dbname=web',
  'mysql_user' => 'web',
  'mysql_password' => 'ywuscu2017'
);

$app['config'] = $config;

$app['model'] = new MySQL(
    $config['mysql_dsn'],
    $config['mysql_user'],
    $config['mysql_password']
);

return $app;
