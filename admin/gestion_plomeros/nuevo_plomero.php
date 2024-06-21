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
    $cp = sanitizeInput($_POST['cp']);
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

    if (!preg_match("/^[0-9]{5}$/", $cp)) {
        echo 'Código postal no válido.';
        exit;
    }

    if (!preg_match("/^[0-9]{10}$/", $telefono)) {
        echo 'Número de teléfono no válido.';
        exit;
    }

    $contrasena = password_hash($password, PASSWORD_BCRYPT);

    // Obtener la zona a partir del código postal
    $zona = obtenerZona((int)$cp);
    if ($zona === null) {
        echo 'El código postal no se encuentra en ninguna zona definida en CDMX.';
        exit; // Salir si no se encuentra la zona
    }

    // Preparar la consulta SQL
    $sql = "INSERT INTO usuarios (nombre, apellido, correo, contrasena, telefono, zona, tipo_cuenta, estado) VALUES (?, ?, ?, ?, ?, ?, 'work', ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssssss", $nombre, $apellido, $correo, $contrasena, $telefono, $zona, $estado);

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
