<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();

    include 'conexion_bd.php';

    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $query_select = "SELECT * FROM usuarios WHERE correo = '$correo'";

    $ejecutar = mysqli_query($conexion, $query_select);

    if (mysqli_num_rows($ejecutar) == 0) {
        echo '
            <script>
                alert("El correo no existe, intenta con otro");
                window.location = "../account/";
            </script>
        ';
        exit;
    }

    $usuario = mysqli_fetch_assoc($ejecutar);
    
    if(!password_verify($contrasena, $usuario['contrasena'])) {
        echo '
            <script>
                alert("Contraseña incorrecta");
                window.location = "../account/";
            </script>
        ';    
    }
    
    
    $_SESSION['usuario'] = $usuario['nombre']; 
    $_SESSION['id'] = $usuario['id_usuario'];
    $_SESSION['nombre'] = $usuario['nombre'];
    $_SESSION['apellido'] = $usuario['apellido'];
    $_SESSION['correo'] = $usuario['correo'];
    $_SESSION['telefono'] = $usuario['telefono'];
    $_SESSION['tipo_cuenta'] = $usuario['tipo_cuenta'];

    header("location: ../");
    exit;   
    
?>