<?php

use swaf\components\App;

require 'vendor/autoload.php';
require 'config.php';

$app = new App(dirname(__DIR__));
$app->start();

