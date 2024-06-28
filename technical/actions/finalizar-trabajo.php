<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(dirname(__DIR__) . '/../php/conexion_bd.php');

session_start();

if (!isset($_SESSION['usuario'])) {
    session_destroy();
    header('Location: ../');
    exit();
} else if ($_SESSION['tipo_cuenta'] != 'work') {
    header('Location: ../');
    exit();
}

if (!$_SESSION['jornada']) {
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
}

if (!isset($_GET['id_trabajo'])) {
    echo '
            <script>
                alert("No se ha seleccionado una solicitud");
            </script>
        ';
    header('Location: ../');
    exit;
}

if (!isset($_GET['monto'])) {
    echo '
            <script>
                alert("No se ha seleccionado un monto");
            </script>
        ';
    header('Location: ../');
    exit;
}

$id_trabajo = $_GET['id_trabajo'];
$monto = $_GET['monto'];

if (!is_uploaded_file($_FILES['file-upload']['tmp_name'])) {
    echo '
            <script>
                alert("No se ha seleccionado un archivo");
            </script>
        ';
    header('Location: ../');
    exit;
}

$archivo = mysqli_real_escape_string($conexion, file_get_contents($_FILES['file-upload']['tmp_name']));
$archivo = "'$archivo'";

$query_update = "UPDATE trabajo SET status = 1, evidencia = $archivo WHERE id_trabajo = $id_trabajo";
$succes = mysqli_query($conexion, $query_update);

$_SESSION['servicio'] = "none";

$query_insert_pago = "INSERT INTO pagos (fecha_pago,hora_pago,monto,id_trabajo,status) VALUES (CURDATE(),CURTIME(),$monto,$id_trabajo,0)";
$succes = mysqli_query($conexion, $query_insert_pago);

header('Location: ../');
exit;
