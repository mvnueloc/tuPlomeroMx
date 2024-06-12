<?php
    var_dump($_POST);

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();

    include 'conexion_bd.php';

    $contrasena = $_POST['contrasena'];
    $correo = $_POST['correo'];
    

    echo $correo . "<br>" . $contrasena . "<br>";

    //Buscar en la base de datos

    $query_select = "SELECT * FROM usuarios WHERE correo = '$correo'";

    $ejecutar = mysqli_query($conexion, $query_select);

    if (mysqli_num_rows($ejecutar) > 0) {
        $usuario = mysqli_fetch_assoc($ejecutar);
        echo $usuario['contrasena'];
        echo $contrasena;
        if (password_verify($contrasena, $usuario['contrasena'])) {
            $_SESSION['usuario'] = $usuario['correo']; 
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['apellido'] = $usuario['apellido'];
            
            header("location: ../bienvenido.php");
            exit();
        }else {
            echo "La contraseña proporcionada no coincide con la almacenada en la base de datos.<br>";
        }
    }

    echo $usuario['contrasena'];

    // echo '
    // <script>
    //     alert("El usuario no se ha localizado.");
    //     window.location = "../login.php"
    // </script>' ;
    // exit();
?>