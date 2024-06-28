<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(dirname(__DIR__) . 'conexion_bd.php');

$id_client = $_SESSION['id'];
