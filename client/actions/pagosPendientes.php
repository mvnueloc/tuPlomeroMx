<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include(dirname(__DIR__).'../../php/conexion_bd.php');

    $id_client = $_SESSION['id'];

    // Consulta para verificar que hay una solicitud con status 1 y un trabajo asociado con status 1
    $query_check = "
        SELECT s.*, t.id_trabajador 
        FROM solicitudes s
        JOIN trabajo t ON s.id_solicitud = t.id_solicitud
        WHERE s.id_cliente = $id_client AND s.status = 1 AND t.status = 1
    ";

    $result_check = mysqli_query($conexion, $query_check);

    $porPagar = false;

    if (mysqli_num_rows($result_check) > 0) {
        $porPagar = true;
        $servicioPorPagar = mysqli_fetch_assoc($result_check);
        $id_solicitud = $servicioPorPagar['id_solicitud'];
        $id_servicio = $servicioPorPagar['id_servicio'];
        $id_trabajador = $servicioPorPagar['id_trabajador'];

        $query_info = "SELECT * FROM servicios WHERE id_servicio = '$id_servicio'";
        $result_info = mysqli_query($conexion, $query_info);
        $infoServicio = mysqli_fetch_assoc($result_info);

        $direccion = $servicioPorPagar['direccion'];
        $dia = $servicioPorPagar['fecha_solicitud'];
        $costo = $servicioPorPagar['costo_total'];
        $servicio = $infoServicio['nombre_servicio'];

        // Obtener el nombre del técnico desde la tabla usuarios
        $query_tecnico = "SELECT nombre, apellido FROM usuarios WHERE id_usuario = '$id_trabajador'";
        $result_tecnico = mysqli_query($conexion, $query_tecnico);
        $tecnico = mysqli_fetch_assoc($result_tecnico);
        $nombre_tecnico = $tecnico['nombre'] . ' ' . $tecnico['apellido'];

        // Mostrar los datos
        // echo "Servicio: " . $servicio . "<br>";
        // echo "Dirección: " . $direccion . "<br>";
        // echo "Fecha de Solicitud: " . $dia . "<br>";
        // echo "Costo Total: " . $costo . "<br>";
        // echo "Técnico: " . $nombre_tecnico . "<br>";
    }
?>
