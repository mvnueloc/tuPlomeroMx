<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(dirname(__DIR__).'../../php/conexion_bd.php');

if(!isset($_SESSION['usuario'])){
    session_destroy();
    header('Location: ../');
    exit();
} else if($_SESSION['tipo_cuenta'] != 'user'){
    header('Location: ../');
    exit();
}

$id_usuario = $_POST['id_usuario'];
$calificacion = $_POST['calificacion'];
$comentario = mysqli_real_escape_string($conexion, $_POST['comentario']);

// Obtener el trabajo más reciente del usuario con status = 1
$query_trabajo = "
    SELECT t.id_trabajo 
    FROM trabajo t
    JOIN solicitudes s ON t.id_solicitud = s.id_solicitud
    WHERE s.id_cliente = $id_usuario AND t.status = 1
    ORDER BY t.id_trabajo DESC
    LIMIT 1
";
$result_trabajo = mysqli_query($conexion, $query_trabajo);

if (mysqli_num_rows($result_trabajo) > 0) {
    $trabajo = mysqli_fetch_assoc($result_trabajo);
    $id_trabajo = $trabajo['id_trabajo'];

    // Actualizar el trabajo con el comentario y la calificación
    $query_update = "
        UPDATE trabajo 
        SET calificacion = $calificacion, comentario = '$comentario' 
        WHERE id_trabajo = $id_trabajo
    ";
    if (mysqli_query($conexion, $query_update)) {
        echo '
        <script>
            alert("Gracias por tu retroalimentación.");
            window.location = "../";
        </script>';
    } else {
        echo '
        <script>
            alert("Hubo un error al guardar tu retroalimentación.");
            window.location = "../";
        </script>';
    }
} else {
    echo '
    <script>
        alert("No se encontró un trabajo reciente para este usuario.");
        window.location = "../";
    </script>';
}
?>
