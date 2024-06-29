<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$calificacion = $_POST['calificacion'];
$comentario = $_POST['comentario'];

include(dirname(__DIR__) . '../../php/conexion_bd.php');

session_start();

$id_client = $_SESSION['id'];
// echo  $id_cliente . '<br>' ;

date_default_timezone_set('America/Mexico_City');

$fecha = date('Y-m-d');
// echo  $fecha . '<br>';

$hora = date('H:i:s');
// echo  $hora . '<br>';

$query_info = "SELECT 
    t.id_trabajo,
    p.id_pago, 
    p.fecha_pago, 
    p.hora_pago, 
    p.monto, 
    p.status,
    s.id_solicitud, 
    s.direccion, 
    s.fecha_solicitud, 
    s.hora_solicitud,
    srv.nombre_servicio
    FROM 
        usuarios u
    JOIN 
        solicitudes s ON u.id_usuario = s.id_cliente
    JOIN 
        trabajo t ON s.id_solicitud = t.id_solicitud
    JOIN 
        pagos p ON t.id_trabajo = p.id_trabajo
    JOIN 
        servicios srv ON s.id_servicio = srv.id_servicio
    WHERE 
        u.id_usuario = $id_client
    AND 
        p.status = 0";

$result_info = mysqli_query($conexion, $query_info);
$servicioPorPagar = mysqli_fetch_assoc($result_info);

$id_pago = $servicioPorPagar['id_pago'];
$id_trabajo = $servicioPorPagar['id_trabajo'];

$query_update = "UPDATE pagos SET status = 1 WHERE id_pago =  $id_pago";

$ejecutar = mysqli_query($conexion, $query_update);

$query_calificar = "UPDATE trabajo SET calificacion = $calificacion, comentario = '$comentario' WHERE id_trabajo = $id_trabajo";

$ejecutar = mysqli_query($conexion, $query_calificar);

header('Location: ../');
