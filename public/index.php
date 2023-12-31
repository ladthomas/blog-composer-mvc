<?php

// autoloader

require_once __DIR__ . '/../vendor/autoload.php';

use Carbon\Carbon;
use Dotenv\Dotenv;

// Charge le fichier .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

include('../src/controllers/root.php');
?>