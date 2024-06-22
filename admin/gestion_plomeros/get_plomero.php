<?php
include '../../php/conexion_bd.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "SELECT id_usuario, nombre, apellido, correo, telefono, zona FROM usuarios WHERE id_usuario = $id LIMIT 1";
$result = mysqli_query($conexion, $sql);
$data = mysqli_fetch_assoc($result);

mysqli_close($conexion);

echo json_encode($data);
?>
