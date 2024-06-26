<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include(dirname(__DIR__).'../../php/conexion_bd.php');
    
    $id_client = $_SESSION['id'];

    $query_check = "SELECT s.id_solicitud, s.id_cliente, s.codigo_postal, s.direccion, s.fecha_solicitud, s.hora_solicitud, s.id_servicio, s.status
                    FROM usuarios u
                    JOIN solicitudes s ON u.id_usuario = s.id_cliente
                    WHERE u.id_usuario = $id_client
                    AND s.status = 0;
                    ";

    $result_check = mysqli_query($conexion, $query_check);

    if(mysqli_num_rows($result_check) > 0){
        echo '
            <script>
                alert("Ya tienes una solicitud en proceso.");
                window.location = "./index.php";
            </script>
        ';    
    }
?>