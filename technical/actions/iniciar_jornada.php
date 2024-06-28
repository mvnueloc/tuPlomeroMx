<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    session_destroy();
    header('Location: ../');
    exit();
} else if ($_SESSION['tipo_cuenta'] != 'work') {
    header('Location: ../');
    exit();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(dirname(__DIR__).'../../php/conexion_bd.php');

// Establecer la zona horaria a America/Mexico_City
date_default_timezone_set('America/Mexico_City');

// Obtener la fecha y la hora actual
$fecha_actual = date('Y-m-d');
$hora_actual = date('H:i:s');

// Insertar un nuevo registro en la tabla jornada
$id_usuario = $_SESSION['id'];
$query_insert = "INSERT INTO jornadas_trabajo (id_usuario, fecha, hora_inicio) VALUES ($id_usuario, '$fecha_actual', '$hora_actual')";
$result = mysqli_query($conexion, $query_insert);

if ($result) {
    $_SESSION['jornada'] = "iniciada";
    header('Location: ../jornada.php');
} else {
    echo "Error al iniciar la jornada: " . mysqli_error($conexion);
}
exit();
?>
