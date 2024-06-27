<?php
include '../../php/conexion_bd.php';

$id_usuario = mysqli_real_escape_string($conexion, $_POST['id_usuario']);

$sql = "UPDATE usuarios SET estado = 'baja' WHERE id_usuario = $id_usuario";

if (mysqli_query($conexion, $sql)) {
    echo "Usuario eliminado exitosamente";
} else {
    echo "Error al eliminar el usuario: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>
