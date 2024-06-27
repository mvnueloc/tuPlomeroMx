<?php
include '../../php/conexion_bd.php';

// Función para sanitizar datos de entrada
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitización de los datos del formulario
    $nombre = sanitizeInput($_POST['nombre']);
    $correo = filter_var(sanitizeInput($_POST['correo']), FILTER_SANITIZE_EMAIL);
    $telefono = sanitizeInput($_POST['telefono']);
    $direccion = sanitizeInput($_POST['direccion']);

    // Validación de datos
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo 'Correo no válido.';
        exit;
    }

    if (!preg_match("/^[0-9]{10}$/", $telefono)) {
        echo 'Número de teléfono no válido.';
        exit;
    }

    // Preparar la consulta SQL
    $sql = "INSERT INTO proveedores (nombre, correo, telefono, direccion) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $correo, $telefono, $direccion);

    if ($stmt->execute()) {
        echo '<script>
                alert("Proveedor añadido exitosamente");
                window.location = "./almacen.php";
              </script>';
    } else {
        echo '<script>
                alert("Error al añadir el proveedor: ' . $stmt->error . '");
                window.history.back();
              </script>';
    }

    $stmt->close();
    $conexion->close();
}
?>
