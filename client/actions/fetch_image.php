<?php
include(dirname(__DIR__) . '/php/conexion_bd.php'); // Adjust the path as necessary

if (isset($_GET['id_trabajo'])) {
    $id_trabajo = $_GET['id_trabajo'];

    $query = "SELECT evidencia FROM trabajo WHERE id_trabajo = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id_trabajo);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($evidencia);
    $stmt->fetch();
    
    if ($stmt->num_rows > 0) {
        header("Content-Type: image/jpeg"); // Adjust the content type if needed
        echo $evidencia;
    } else {
        echo 'Image not found';
    }
    $stmt->close();
    $conexion->close();
}
?>
