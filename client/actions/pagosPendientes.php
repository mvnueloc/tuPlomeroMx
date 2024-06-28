<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include(dirname(__DIR__).'../../php/conexion_bd.php');

    $id_client = $_SESSION['id'];

    $query_check = "SELECT * FROM solicitudes WHERE id_cliente = $id_client AND status = 1";
    // 0 - solicitud no tomada
    // 1 - solicitud echa pero sin pago
    // 2 - solicitud ya pagada

    $result_check = mysqli_query($conexion, $query_check);

    $porPagar = false;

    if(mysqli_num_rows($result_check) > 0){
        $porPagar = true;
        $servicioPorPagar = mysqli_fetch_assoc($result_check);
        $id_servicio = $servicioPorPagar['id_servicio'];
        // echo $id_servicio . '<br>';

        $query_info = "SELECT * FROM servicios WHERE id_servicio = '$id_servicio'";
        $result_info = mysqli_query($conexion, $query_info);
        $infoServicio = mysqli_fetch_assoc($result_info);

        $direccion = $servicioPorPagar['direccion'];
        // echo $direccion . '<br>';
        $dia = $servicioPorPagar['fecha_solicitud'];
        // echo $dia . '<br>';
        $costo = $servicioPorPagar['costo_total'];
        // echo $costo . '<br>';
        $servicio = $infoServicio['nombre_servicio'];
        // echo $servicio . '<br>';
    }

?>