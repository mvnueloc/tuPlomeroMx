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
    header('Location: ../');
    exit();
}

$_SESSION['jornada'] = "terminada";

$id_jornada = $_SESSION['id_jornada'];

$query = "UPDATE jornada SET status = 1, fecha_hora_fin = NOW() WHERE id_jornada = $id_jornada";

$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    header('Location: ../');
} else {
    echo '
        <script>
            alert("Error al terminar jornada");
            window.location = "../index.php";
        </script>
    ';
}
