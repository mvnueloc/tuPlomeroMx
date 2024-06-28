<?php
include '../../php/conexion_bd.php';

$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
$descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
$dimensiones = mysqli_real_escape_string($conexion, $_POST['dimensiones']);
$unidad_de_medida = mysqli_real_escape_string($conexion, $_POST['unidad_de_medida']);

$sql = "INSERT INTO materiales (nombre, descripcion, dimensiones, unidad_de_medida) VALUES ('$nombre', '$descripcion', '$dimensiones', '$unidad_de_medida')";

if (mysqli_query($conexion, $sql)) {
    echo '
        <script>
            alert("Producto añadido exitosamente");
            window.location.href = "./"; // Use JavaScript for redirection
        </script>
    ';
} else {
    echo '
        <script>
            alert("Error al añadir el producto: ' . mysqli_error($conexion) . '");
            window.history.back(); // Redirect to the previous page if there is an error
        </script>
    ';
}

mysqli_close($conexion);
?>
