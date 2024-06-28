<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(dirname(__DIR__) . '../../php/conexion_bd.php'); // Adjust the path as necessary

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

    $query_trabajo = "SELECT * FROM trabajo WHERE id_solicitud = '$id_solicitud'";
    $trabajo_result = mysqli_query($conexion, $query_trabajo);
    $infotrabajo = mysqli_fetch_assoc($trabajo_result);
    $id_trabajo = $infotrabajo['id_trabajo'];

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

    // Consulta para recuperar la imagen
    $query_image = "SELECT evidencia FROM trabajo WHERE id_trabajo = $id_trabajo";
    $result_image = mysqli_query($conexion, $query_image);

    if (!$result_image) {
        die('Error en la consulta: ' . mysqli_error($conexion));
    }

    $evidencia = null;
    if (mysqli_num_rows($result_image) > 0) {
        $row = mysqli_fetch_assoc($result_image);
        $evidencia = $row['evidencia'];
    }

    // Convertir la imagen a base64
    $img = '';
    if ($evidencia) {
        $imageData = base64_encode($evidencia);
        $img = 'data:image/jpeg;base64,' . $imageData; // Cambia image/jpeg al tipo de imagen correcto
    } else {
        $img = 'ruta/a/imagen/por/defecto.jpg'; // Ruta a una imagen por defecto en caso de que no haya evidencia
    }

    // Mostrar los datos
    // echo "Servicio: " . $servicio . "<br>";
    // echo "Dirección: " . $direccion . "<br>";
    // echo "Fecha de Solicitud: " . $dia . "<br>";
    // echo "Costo Total: " . $costo . "<br>";
    // echo "Técnico: " . $nombre_tecnico . "<br>";
    // echo "<img src='$img' alt='Evidencia' />";
}
?>
