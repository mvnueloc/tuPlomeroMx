<?php
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include(dirname(__DIR__).'../../php/conexion_bd.php');

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
        echo '
            <script>
                alert("No tienes una jornada activa");
            </script>
        ';
        header('Location: ../');
        exit();
    }

    if(!isset($_GET['id'])){
        echo '
            <script>
                alert("No se ha seleccionado una solicitud");
            </script>
        ';
        header('Location: ../');
        exit;
    }

    $id_solicitud = $_GET['id'];

    $query_valide = "SELECT * FROM solicitudes WHERE id_solicitud = $id_solicitud and status = 0";
    $ejecutar_valide = mysqli_query($conexion, $query_valide);
    
    if(mysqli_num_rows($ejecutar_valide) == 0){
        echo '
            <script>
                alert("La solicitud ya ha sido asignada");
            </script>
        ';
        header('Location: ../');
        exit;
    }

    $query_update = "UPDATE solicitudes SET status = 1 WHERE id_solicitud = $id_solicitud";
    $ejecutar_update = mysqli_query($conexion, $query_update);
    
    $query_insert = "INSERT INTO trabajo (id_solicitud, id_trabajador, status) VALUES ($id_solicitud, ".$_SESSION['id'].", 0 )";
    $ejecutar_insert = mysqli_query($conexion, $query_insert);

    if($ejecutar_update && $ejecutar_insert){
        echo '
            <script>
                alert("Solicitud asignada correctamente");
            </script>
        ';

        $_SESSION['servicio'] = "onService";
    }else{
        echo '
            <script>
                alert("Error al asignar la solicitud");
            </script>
        ';
    }

    header('Location: ../');
?>