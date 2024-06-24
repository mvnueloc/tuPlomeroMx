<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include(dirname(__DIR__).'../../php/conexion_bd.php');

    session_start();
    
    $id_client = $_SESSION['id'];

    $query_check = "SELECT * FROM solicitudes WHERE id_cliente = $id_client AND terminado = 0";

    $result_check = mysqli_query($conexion, $query_check);

    if(mysqli_num_rows($result_check) > 0){
        echo '
            <script>
                alert("Tienes un servicio pendiente de pago");
                window.location = "notificacion.php";
            </script>
        ';    
    }

?>