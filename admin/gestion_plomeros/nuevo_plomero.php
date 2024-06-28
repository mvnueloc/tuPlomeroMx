<?php
include '../../php/conexion_bd.php';
include '../../regiones/regiones.php';

// Función para sanitizar datos de entrada
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitización de los datos del formulario
    $nombre = sanitizeInput($_POST['nombre']);
    $apellido = sanitizeInput($_POST['apellidos']);
    $correo = filter_var(sanitizeInput($_POST['correo']), FILTER_SANITIZE_EMAIL);
    $password = sanitizeInput($_POST['password']);
    $confpassword = sanitizeInput($_POST['confpassword']);
    $telefono = sanitizeInput($_POST['telefono']);
    $estado = 'alta';

    // Validación de datos
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo 'Correo no válido.';
        exit;
    }

    if ($password !== $confpassword) {
        echo 'Las contraseñas no coinciden 1.';
        exit;
    }

    if (!preg_match("/^[0-9]{10}$/", $telefono)) {
        echo 'Número de teléfono no válido.';
        exit;
    }

    $contrasena = password_hash($password, PASSWORD_BCRYPT);

    // Preparar la consulta SQL
    $sql = "INSERT INTO usuarios (nombre, apellido, correo, contrasena, telefono, tipo_cuenta, estado, fecha_alta) VALUES (?, ?, ?, ?, ?, 'work', ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssssss", $nombre, $apellido, $correo, $contrasena, $telefono, $estado, date('Y-m-d'));

    if ($stmt->execute()) {
        echo '<script>
                alert("Usuario registrado exitosamente");
                window.location = "./registro_plomeros.php";
              </sCorreo>';
    } else {
        echo '<script>
                alert("Error al añadir el empleado: ' . $stmt->error . '");
                window.history.back();
              </script>';
    }

    $stmt->close();
    $conexion->close();
}
?>
