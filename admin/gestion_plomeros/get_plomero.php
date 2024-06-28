<?php
header('Content-Type: application/json');

include '../../php/conexion_bd.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

$sql = "SELECT id_usuario, nombre, apellido, correo, telefono FROM usuarios WHERE id_usuario = $id LIMIT 1";
$result = mysqli_query($conexion, $sql);
$data = mysqli_fetch_assoc($result);

mysqli_close($conexion);

echo json_encode($data);
?>
