<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include(dirname(__DIR__).'../../php/conexion_bd.php');

    session_start();
    
    $id_cliente = $_SESSION['id'];
    // echo  $id_cliente . '<br>' ;

    $nombre = $_SESSION['nombre'];
    // echo  $nombre . '<br>' ;

    $apellido = $_SESSION['apellido'];
    // echo  $apellido . '<br>' ;

    $domilicio = $_POST['domicilio'];
    // echo  $domilicio . '<br>' ;

    $codigo_postal = $_POST['codigoPostal'];
    // echo  $codigo_postal . '<br>' ;

    $fecha = $_POST['fecha'];
    // echo  $fecha . '<br>';

    $hora = $_POST['hora'];
    // echo  $hora . '<br>';

    $servicio = $_POST['servicio'];
    // echo  $servicio . '<br>' ;

    $costoTotal = $_POST['costoTotal'];
    // echo  $costoTotal . '<br>' ;

    $query = "INSERT INTO solicitudes (id_cliente, nombre, apellido, 
            codigo_postal, direccion, fecha, hora, terminado, id_servicio, costo_total)
        VALUES ( '$id_cliente', '$nombre' , '$apellido', '$codigo_postal', '$domilicio' , '$fecha', '$hora',
            0,  '$servicio' , '$costoTotal' ); ";

if (mysqli_query($conexion, $query)) {
    echo ' 
    <script>
        window.location = "../ordenValidada.php";
    </script>';
    exit;    
}

echo ' 
    <script>
        alert("Hubo un error");
        window.location = "../solicitud.php";
    </script>';

?>