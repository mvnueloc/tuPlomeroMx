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
$hora_actual = date('H:i:s');

// Actualizar el registro en la tabla jornada
$id_usuario = $_SESSION['id'];
$query_update = "UPDATE jornadas_trabajo SET hora_fin = '$hora_actual' WHERE id_usuario = $id_usuario AND hora_fin IS NULL";
$result = mysqli_query($conexion, $query_update);

if ($result) {
    $_SESSION['jornada'] = "finalizada";
    header('Location: ../reportes.php');
} else {
    echo "Error al finalizar la jornada: " . mysqli_error($conexion);
}
exit();
?>
