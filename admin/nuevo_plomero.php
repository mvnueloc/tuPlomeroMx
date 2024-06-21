<?php
include '../php/conexion_bd.php';
include '../regiones/regiones.php'; // Incluye el archivo con la función obtenerZona

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $contrasena = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $cp = $_POST['cp'];
    $telefono = $_POST['telefono'];
    $estado = 'alta';

    // Obtener la zona a partir del código postal
    $zona = obtenerZona($cp);
    if ($zona === null) {
        echo "El código postal $cp no se encuentra en ninguna zona definida.";
        exit; // Salir si no se encuentra la zona
    }

    $sql = "INSERT INTO usuarios (nombre, apellido, correo, contrasena, telefono, zona, tipo_cuenta, estado) VALUES (?, ?, ?, ?, ?, ?, 'work', ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssssss", $nombre, $apellido, $correo, $contrasena, $telefono, $zona, $estado);

    if ($stmt->execute()) {
        echo "Nuevo empleado añadido exitosamente.";
    } else {
        echo "Error al añadir el empleado: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
    
}
?>
