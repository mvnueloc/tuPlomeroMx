<?php
    include '../../regiones/regiones.php';
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


    if (!preg_match("/^[0-9]{5}$/", $codigo_postal)) {
        echo 'Código postal no válido.';
        exit;
    }

     // Obtener la zona a partir del código postal
     $zona = obtenerZona((int)$codigo_postal);
     if ($zona === null) {
         echo 'El código postal no se encuentra en ninguna zona definida en CDMX.';
         exit; // Salir si no se encuentra la zona
     }

    $query = "INSERT INTO solicitudes (id_solicitud, id_cliente, codigo_postal, direccion, 
                            fecha_solicitud, hora_solicitud, id_servicio, status,zona,costo_total)
                VALUES (NULL, $id_cliente, $codigo_postal, '$domilicio', '$fecha', '$hora', $servicio, 0,'$zona','$costoTotal')";

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