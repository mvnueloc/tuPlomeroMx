<?php
include '../../php/conexion_bd.php';

$usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
$material = mysqli_real_escape_string($conexion, $_POST['material']);
$cantidad = (int)$_POST['cantidad'];

// Primero, verificamos si hay suficiente stock disponible
$stock_check_sql = "SELECT cantidad_disponible FROM materiales WHERE nombre = '$material'";
$stock_result = mysqli_query($conexion, $stock_check_sql);
$stock_row = mysqli_fetch_assoc($stock_result);

if ($stock_row['cantidad_disponible'] < $cantidad) {
    echo "Error: No hay suficiente stock disponible.";
    exit;
}

// Si hay suficiente stock, actualizamos la cantidad disponible
$update_sql = "UPDATE materiales SET cantidad_disponible = cantidad_disponible - $cantidad WHERE nombre = '$material'";
if (!mysqli_query($conexion, $update_sql)) {
    echo "Error al actualizar el stock: " . mysqli_error($conexion);
    exit;
}

// Registrar la asignación del recurso
$asignar_sql = "INSERT INTO asignaciones (usuario, material, cantidad) VALUES ('$usuario', '$material', '$cantidad')";
if (mysqli_query($conexion, $asignar_sql)) {
    echo "Recursos asignados exitosamente";
} else {
    echo "Error al asignar recursos: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>
