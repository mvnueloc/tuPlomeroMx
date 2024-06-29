<?php
include '../../php/conexion_bd.php';

$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
$descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
$dimensiones = mysqli_real_escape_string($conexion, $_POST['dimensiones']);
$unidad_de_medida = mysqli_real_escape_string($conexion, $_POST['unidad_de_medida']);

$sql = "INSERT INTO materiales (nombre, descripcion, dimensiones, unidad_de_medida) VALUES ('$nombre', '$descripcion', '$dimensiones', '$unidad_de_medida')";

if (mysqli_query($conexion, $sql)) {
    echo "Producto añadido exitosamente";
} else {
    echo "Error al añadir el producto: " . mysqli_error($conexion);
}

mysqli_close($conexion);
header("Location: ./");
?>
