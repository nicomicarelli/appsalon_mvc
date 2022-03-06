<?php

use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';
$dotEnv = Dotenv::createImmutable(__DIR__);
$dotEnv->safeLoad();

require 'funciones.php';
require 'database.php';

// Conectarnos a la base de datos
use Model\ActiveRecord;
ActiveRecord::setDB($db);