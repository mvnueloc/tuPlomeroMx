<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(dirname(__DIR__) . '../../php/conexion_bd.php');

$id_client = $_SESSION['id'];

$query_check = "SELECT 
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
    Usuarios u
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

$result_check = mysqli_query($conexion, $query_check);


$porPagar = false;




if (mysqli_num_rows($result_check) > 0) {

    $porPagar = true;
    $servicioPorPagar = mysqli_fetch_assoc($result_check);
    $id_servicio = $servicioPorPagar['id_solicitud'];
    // echo $id_servicio . '<br>';

    $id_trabajo = $servicioPorPagar['id_trabajo'];

    // Consulta para recuperar la imagen
    $query_check = "SELECT evidencia FROM trabajo WHERE id_trabajo = $id_trabajo";
    $result_check = mysqli_query($conexion, $query_check);

    if (!$result_check) {
        die('Error en la consulta: ' . mysqli_error($conexion));
    }

    $evidencia = null;
    if (mysqli_num_rows($result_check) > 0) {
        $row = mysqli_fetch_assoc($result_check);
        $evidencia = $row['evidencia'];
    }

    mysqli_close($conexion);

    // Convertir la imagen a base64
    $src = '';
    if ($evidencia) {
        $imageData = base64_encode($evidencia);
        $src = 'data:image/jpeg;base64,' . $imageData; // Cambia image/jpeg al tipo de imagen correcto
    } else {
        $src = 'ruta/a/imagen/por/defecto.jpg'; // Ruta a una imagen por defecto en caso de que no haya evidencia
    }

    // $query_info = "SELECT * FROM servicios WHERE id_servicio = '$id_servicio'";
    // $result_info = mysqli_query($conexion, $query_info);
    // $infoServicio = mysqli_fetch_assoc($result_info);

    $direccion = $servicioPorPagar['direccion'];
    // echo $direccion . '<br>';
    $dia = $servicioPorPagar['fecha_solicitud'];
    // echo $dia . '<br>';
    $costo = $servicioPorPagar['monto'];
    // echo $costo . '<br>';
    $servicio = $servicioPorPagar['nombre_servicio'];
    // echo $servicio . '<br>';
}
