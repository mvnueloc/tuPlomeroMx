<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include(dirname(__DIR__).'../../php/conexion_bd.php');

    session_start();
    
    $id_client = $_SESSION['id'];

    $query_check = "SELECT p.id_pago, p.fecha_pago, p.hora_pago, p.monto, p.status
                    FROM usuarios u
                    JOIN solicitudes s ON u.id_usuario = s.id_cliente
                    JOIN trabajo t ON s.id_solicitud = t.id_solicitud
                    JOIN pagos p ON t.id_trabajo = p.id_trabajo
                    WHERE u.id_usuario = $id_client
                    AND p.status = 0;
                    ";

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