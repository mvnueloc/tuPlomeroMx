<?php
include '../../php/conexion_bd.php';

// Sanitización de datos de entrada
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Validación de datos
function validateData($materiales, $cantidades, $costos_unitarios) {
    foreach ($materiales as $material) {
        if (empty($material)) return false;
    }
    foreach ($cantidades as $cantidad) {
        if (!is_numeric($cantidad) || $cantidad <= 0) return false;
    }
    foreach ($costos_unitarios as $costo_unitario) {
        if (!is_numeric($costo_unitario) || $costo_unitario <= 0) return false;
    }
    return true;
}

$materiales = array_map('sanitizeInput', $_POST['material']);
$cantidades = array_map('sanitizeInput', $_POST['cantidad']);
$costos_unitarios = array_map('sanitizeInput', $_POST['costo_unitario']);

if (!validateData($materiales, $cantidades, $costos_unitarios)) {
    die("Invalid input data.");
}

for ($i = 0; $i < count($materiales); $i++) {
    $material = mysqli_real_escape_string($conexion, $materiales[$i]);
    $cantidad = (int) $cantidades[$i];
    $costo_unitario = (float) $costos_unitarios[$i];

    // Obtener ID del material y el costo unitario actual
    $material_id_sql = "SELECT material_id, costo_unitario, cantidad_disponible FROM materiales WHERE nombre = '$material'";
    $material_id_result = mysqli_query($conexion, $material_id_sql);
    $material_id_row = mysqli_fetch_assoc($material_id_result);
    $material_id = (int) $material_id_row['material_id'];
    $costo_unitario_actual = (float) $material_id_row['costo_unitario'];
    $cantidad_disponible_actual = (int) $material_id_row['cantidad_disponible'];

    // Calcular el nuevo costo unitario promedio ponderado
    $nueva_cantidad_disponible = $cantidad_disponible_actual + $cantidad;
    $nuevo_costo_unitario = (($costo_unitario_actual * $cantidad_disponible_actual) + ($costo_unitario * $cantidad)) / $nueva_cantidad_disponible;

    // Actualizar cantidad disponible y costo unitario del material
    $update_sql = "UPDATE materiales SET cantidad_disponible = $nueva_cantidad_disponible, costo_unitario = $nuevo_costo_unitario WHERE material_id = $material_id";
    mysqli_query($conexion, $update_sql);

}

mysqli_close($conexion);
header('Location: ./');
?>
