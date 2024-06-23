<?php
    session_start();
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
    header('Location: ../jornada.php');
?>