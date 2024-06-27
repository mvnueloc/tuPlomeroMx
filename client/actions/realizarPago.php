<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include(dirname(__DIR__).'../../php/conexion_bd.php');

    session_start();
    
    $id_cliente = $_SESSION['id'];
    // echo  $id_cliente . '<br>' ;

    date_default_timezone_set('America/Mexico_City');

    $fecha = date('Y-m-d');
    // echo  $fecha . '<br>';

    $hora = date('H:i:s');
    // echo  $hora . '<br>';

    $query_info = "SELECT * FROM solicitudes WHERE id_cliente = $id_cliente AND terminado = 0";

    $result_info = mysqli_query($conexion, $query_info);
    $servicioPorPagar = mysqli_fetch_assoc($result_info);

    $costoTotal = $servicioPorPagar['costo_total'];
    // echo  $costoTotal . '<br>' ;

    $query_pago = "INSERT INTO pagos (fecha, hora, monto, id_cliente)
        VALUES ( '$fecha' , '$hora', '$costoTotal' , '$id_cliente' )";

    $ejecutar = mysqli_query($conexion, $query_pago);

    // cambiar el status de pagado

    $query_update = "UPDATE solicitudes SET terminado = 1 WHERE id_cliente = $id_cliente AND terminado = 0";

    $ejecutar = mysqli_query($conexion, $query_update);
?>