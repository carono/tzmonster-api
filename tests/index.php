<?php

use carono\tzmonster\Client;

require '../vendor/autoload.php';
require '../src/ClientAbstract.php';
require '../src/Client.php';

//$client = new Client(['proxy' => 'tcp://localhost:8888']);
$client = new Client();
$client->apikey = '';
$client->login = '';

$balance = $client->getBalance();
$groupsInWork = $client->setGroupInWork('32424', ['Проверка разбора', 'Проверка разбора 2']);
$results = $client->getGroupsResult(['5a126298c46db77294010000']);
