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
    // Encriptacion de la contraseña
    $contrasena = password_hash($contrasena, PASSWORD_BCRYPT);


    // Verificacion de no repeticion de correo

    $query_select = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $verificar_correo = mysqli_query($conexion,  $query_select);
    if (mysqli_num_rows($verificar_correo) > 0) {
        echo ' 
            <script>
                alert("Este correo ya esta registrado, intenta con otro");
                window.location = "../register.php";
            </script>';
        exit();
    }

    // Verificacion de no repeticion de telefono

    $query_select = "SELECT * FROM usuarios WHERE telefono = '$telefono'";
    $verificar_telefono = mysqli_query($conexion,  $query_select);
    if (mysqli_num_rows($verificar_telefono) > 0) {
        echo ' 
            <script>
                alert("Este telefono ya esta registrado, intenta con otro");
                window.location = "../register.php";
            </script>';
        exit();
    }

    // Ejecucion de la consulta

    $query_insert = "INSERT INTO usuarios (nombre, apellido, correo, telefono, contrasena) 
    VALUES ('$nombre', '$apellido', '$correo', '$telefono', '$contrasena')";

    $ejecutar = mysqli_query($conexion, $query_insert);

    if (!$ejecutar) { // Si se hizo la insersion en la base de datos 
        echo ' 
            <script>
                alert("Hubo un error al registrarse");
                window.location = "../register.php";
            </script>';
    } else { //Si hubo un error al hacer la insersion en la base de datos
        echo ' 
            <script>
                alert("Usuario registrado exitosamente");
                window.location = "../login.php";
            </script>';
    }
?>