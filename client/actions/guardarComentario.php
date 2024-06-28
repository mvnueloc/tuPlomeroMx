<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include(dirname(__DIR__).'../../php/conexion_bd.php');

if (!isset($_SESSION['usuario'])) {
    session_destroy();
    header('Location: ../');
    exit();
} else if ($_SESSION['tipo_cuenta'] != 'user') {
    header('Location: ../');
    exit();
}

$id_cliente = $_SESSION['id'];

date_default_timezone_set('America/Mexico_City');

$fecha = date('Y-m-d');
$hora = date('H:i:s');

// Obtener información de la solicitud pendiente de pago
$query_info = "SELECT * FROM solicitudes s WHERE s.id_cliente = $id_cliente AND s.status = 1";
$result_info = mysqli_query($conexion, $query_info);

if (!$result_info || mysqli_num_rows($result_info) == 0) {
    die("No se encontraron solicitudes pendientes de pago.");
}

$servicioPorPagar = mysqli_fetch_assoc($result_info);

$costoTotal = $servicioPorPagar['costo_total'];
$id_solicitud = $servicioPorPagar['id_solicitud'];

// Obtener el id_trabajo asociado a la solicitud
$query_trabajo = "SELECT id_trabajo FROM trabajo WHERE id_solicitud = $id_solicitud";
$result_trabajo = mysqli_query($conexion, $query_trabajo);

if (!$result_trabajo || mysqli_num_rows($result_trabajo) == 0) {
    die("No se encontró un trabajo asociado a la solicitud.");
}

$trabajo = mysqli_fetch_assoc($result_trabajo);
$id_trabajo = $trabajo['id_trabajo'];

// Verificar si ya existe un pago para este trabajo con status 0
$query_pago_existente = "SELECT * FROM pagos WHERE id_trabajo = $id_trabajo AND status = 0";
$result_pago_existente = mysqli_query($conexion, $query_pago_existente);

if (mysqli_num_rows($result_pago_existente) > 0) {
    // Si el pago ya existe con status 0, actualizar su estado, fecha y hora
    $query_update_pago = "UPDATE pagos SET status = 1, fecha_pago = '$fecha', hora_pago = '$hora' WHERE id_trabajo = $id_trabajo AND status = 0";
    mysqli_query($conexion, $query_update_pago);
} else {
    // Si el pago no existe, insertar un nuevo registro
    $query_insert_pago = "INSERT INTO pagos (fecha_pago, hora_pago, monto, id_usuario, status, id_trabajo)
        VALUES ('$fecha', '$hora', $costoTotal, $id_cliente, 1, $id_trabajo)";
    mysqli_query($conexion, $query_insert_pago);
}

// Actualizar el estado de la solicitud
$query_update_solicitud = "UPDATE solicitudes SET status = 2 WHERE id_cliente = $id_cliente AND status = 1";
mysqli_query($conexion, $query_update_solicitud);

// Obtener datos del formulario
$id_usuario = $_POST['id_usuario'];
$calificacion = $_POST['calificacion'];
$comentario = mysqli_real_escape_string($conexion, $_POST['comentario']);

// Imprimir el id_trabajo para depuración
echo 'ID del Trabajo: ' . $id_trabajo . '<br>';

if (!$id_trabajo) {
    echo '
    <script>
        alert("No se encontró un id_trabajo válido.");
        window.location = "../";
    </script>';
    exit();
}

// Actualizar el trabajo con el comentario y la calificación
$query_update = "
    UPDATE trabajo 
    SET calificacion = $calificacion, comentario = '$comentario' 
    WHERE id_trabajo = $id_trabajo
";

if (mysqli_query($conexion, $query_update)) {
    echo '
    <script>
        alert("Gracias por tu retroalimentación.");
        window.location = "../";
    </script>';
} else {
    echo '
    <script>
        alert("Hubo un error al guardar tu retroalimentación.");
        window.location = "../";
    </script>';
}
?>
