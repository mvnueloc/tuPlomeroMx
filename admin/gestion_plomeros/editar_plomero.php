<?php
include '../../php/conexion_bd.php';
include '../../regiones/regiones.php'; // Asegúrate de incluir el archivo correcto

$id_usuario = mysqli_real_escape_string($conexion, $_POST['id_usuario']);
$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
$apellidos = mysqli_real_escape_string($conexion, $_POST['apellidos']);
$correo = mysqli_real_escape_string($conexion, $_POST['correo']);
$telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);

if (isset($_POST['modificar_zona']) && $_POST['modificar_zona'] == 'si' && isset($_POST['cp'])) {
    $cp = (int) $_POST['cp'];
    $zona = obtenerZona($cp);
    echo "$zona";
    if ($zona === null) {
        echo "Código postal no válido.";
        exit;
    }
} else {
    $zona = mysqli_real_escape_string($conexion, $_POST['zona']);
}

$sql = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellidos', correo = '$correo', zona = '$zona', telefono = '$telefono' WHERE id_usuario = $id_usuario";

if (mysqli_query($conexion, $sql)) {
    echo "Usuario actualizado exitosamente";
} else {
    echo "Error al actualizar el usuario: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>
