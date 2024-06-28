<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../php/conexion_bd.php';

$_SESSION['jornada'] = "iniciada";

$id_tecnico = $_SESSION['id'];

$query = "INSERT INTO jornada (status, id_tecnico) VALUES (0, $id_tecnico)";

$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    header('Location: ../jornada.php');

    $_SESSION['id_jornada'] = mysqli_insert_id($conexion);
} else {
    echo '
        <script>
            alert("Error al iniciar jornada");
            window.location = "../index.php";
        </script>
    ';
}
