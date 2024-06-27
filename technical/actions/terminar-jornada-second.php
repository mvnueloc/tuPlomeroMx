<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    session_start();

    if(!isset($_SESSION['usuario'])){
        session_destroy();
        header('Location: ../');
        exit();
    }else if($_SESSION['tipo_cuenta'] != 'work'){
        header('Location: ../');
        exit();
    }

    if(!$_SESSION['jornada']){
        // $id_jornada = $_SESSION['jornada'];
        // $fecha_termino = date('Y-m-d H:i:s');
        // $query_update = "UPDATE jornadas SET fecha_termino = '$fecha_termino' WHERE id_jornada = $id_jornada";
        // $ejecutar = mysqli_query($conexion, $query_update);
        // unset($_SESSION['jornada']);
        header('Location: ../');
        exit();
    }

    $_SESSION['jornada'] = "terminada";
    header('Location: ../reportes.php');
?>