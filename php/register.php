<?php
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include 'conexion_bd.php';

    $nombre = $_POST['nombres'];
    $apellido = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $contrasena = $_POST['contrasena'];
    $tipo_cuenta = 'user';
    
    // Encriptacion de la contraseña
    $contrasena = password_hash($contrasena, PASSWORD_BCRYPT);


    // Verificacion de no repeticion de correo

    $query_select = "SELECT * FROM usuarios WHERE correo = '$correo' or telefono = '$telefono'";
    $verificar_correo = mysqli_query($conexion,  $query_select);
    if (mysqli_num_rows($verificar_correo) > 0) {
        echo ' 
            <script>
                alert("El correo o número de teléfono ya existe, intenta con otro");
                window.location = "../account/register.php";
            </script>';
        exit();
    }

    $query_insert = "INSERT INTO usuarios (nombre, apellido, correo, telefono, contrasena, tipo_cuenta) 
    VALUES ('$nombre', '$apellido', '$correo', '$telefono', '$contrasena', '$tipo_cuenta')";

    

    if (mysqli_query($conexion, $query_insert)) {
        echo ' 
        <script>
            alert("Usuario registrado exitosamente");
            window.location = "../account/";
        </script>';
        exit;    
    }
    
    echo ' 
        <script>
            alert("Hubo un error al registrarse");
            window.location = "../account/register.php";
        </script>';
?>