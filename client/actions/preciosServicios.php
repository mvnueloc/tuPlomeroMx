<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include(dirname(__DIR__).'../../php/conexion_bd.php');

    // <-- Servicio 1 -->
    $query_1 = 'SELECT costo_base FROM servicios WHERE id_servicio = 1';

    $ejecucion = mysqli_query($conexion, $query_1);

    if (mysqli_num_rows($ejecucion) > 0) {
        $precioTinaco = mysqli_fetch_assoc($ejecucion);
        // echo 'Precio: ' . $precioTinaco['costo_base'] . '<br>';
    } else {
        echo '
            <script>
                alert("No se encontro el servicio 1 en la base de datos");
                window.location = "solicitud.php";
            </script>
        ';
    }

    // <-- Servicio 2 -->

    $query_2 = 'SELECT costo_base FROM servicios WHERE id_servicio = 2 ';

    $ejecucion = mysqli_query($conexion, $query_2);

    if (mysqli_num_rows($ejecucion) > 0) {
        $precioFuga = mysqli_fetch_assoc($ejecucion);
        // echo 'Precio: ' . $precioFuga['costo_base'] . '<br>';
    } else {
        echo '
            <script>
                alert("No se encontro el servicio 2 en la base de datos");
                window.location = "solicitud.php";
            </script>
        ';
    }

    // <-- Servicio 3 -->

    $query_3 = 'SELECT costo_base FROM servicios WHERE id_servicio = 3 ';

    $ejecucion = mysqli_query($conexion, $query_3);

    if (mysqli_num_rows($ejecucion) > 0) {
        $precioCalentador = mysqli_fetch_assoc($ejecucion);
        // echo 'Precio: ' . $precioCalentador['costo_base'] . '<br>';
    } else {
        echo '
            <script>
                alert("No se encontro el servicio 3 en la base de datos");
                window.location = "solicitud.php";
            </script>
        ';
    }
?>