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

    $query_info = "SELECT * FROM solicitudes s WHERE s.id_cliente = $id_cliente AND s.status = 1";

    $result_info = mysqli_query($conexion, $query_info);
    $servicioPorPagar = mysqli_fetch_assoc($result_info);

    $costoTotal = $servicioPorPagar['costo_total'];
    // echo  $costoTotal . '<br>' ;

    // Obtener el id_trabajo asociado a la solicitud
    $id_solicitud = $servicioPorPagar['id_solicitud'];
    $query_trabajo = "SELECT id_trabajo FROM trabajo WHERE id_solicitud = $id_solicitud";
    $result_trabajo = mysqli_query($conexion, $query_trabajo);
    $trabajo = mysqli_fetch_assoc($result_trabajo);
    $id_trabajo = $trabajo['id_trabajo'];


    $query_pago = "INSERT INTO pagos (fecha_pago, hora_pago, monto, id_usuario,status,id_trabajo)
        VALUES ( '$fecha' , '$hora', '$costoTotal' , '$id_cliente',1, $id_trabajo)";

    $ejecutar = mysqli_query($conexion, $query_pago);

    // cambiar el status de pagado

    $query_update = "UPDATE solicitudes SET status = 2 WHERE id_cliente = $id_cliente AND status = 1";

    $ejecutar = mysqli_query($conexion, $query_update);
?>