<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include(dirname(__DIR__).'../../php/conexion_bd.php');

    // Verificar que el usuario ha iniciado sesión y es un técnico
    // if (!isset($_SESSION['id']) || $_SESSION['tipo_cuenta'] != 'tecnico') {
    //     echo 'Acceso no autorizado.';
    //     exit;
    // }

    $id_tecnico = $_SESSION['id'];

    // Consulta para verificar si el técnico tiene un trabajo activo
    $query = "SELECT id_trabajo FROM trabajo WHERE id_trabajador = $id_tecnico AND status = 0";
    $result = mysqli_query($conexion, $query);

    if (mysqli_num_rows($result) > 0) {
        // Si el técnico tiene un trabajo activo, redirigir a servicio.php
        echo ' 
        <script>
            window.location = "../technical/servicio.php";
        </script>';
        exit;
    }
?>
