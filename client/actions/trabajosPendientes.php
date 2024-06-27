<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include(dirname(__DIR__).'../../php/conexion_bd.php');

    $id_client = $_SESSION['id'];

    $query_check = "SELECT t.id_trabajo, t.id_solicitud, t.id_trabajador, t.status
                    FROM usuarios u
                    JOIN solicitudes s ON u.id_usuario = s.id_cliente
                    JOIN trabajo t ON s.id_solicitud = t.id_solicitud
                    WHERE u.id_usuario = $id_client
                    AND t.status = 0;
                    ";

    $result_check = mysqli_query($conexion, $query_check);

    if(mysqli_num_rows($result_check) > 0){
        echo '
            <script>
                alert("Tienes un servicio en proceso.");
                window.location = "notificacion.php";
            </script>
        ';    
    }
?>