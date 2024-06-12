<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'conexion_bd.php';

// Verificar si se recibieron datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitizar y capturar los datos recibidos
    $nombre = htmlspecialchars($_POST['nombre']);
    $fecha = htmlspecialchars($_POST['fecha']);
    $hora = htmlspecialchars($_POST['hora']);
    $descripcion = htmlspecialchars($_POST['descripcion']);

    // Insertar los datos estáticos
    $query_insert_static = "INSERT INTO form_notaServicio (nombre, fecha, hora, descripcion) 
                            VALUES ('$nombre', '$fecha', '$hora', '$descripcion')";

    $ejecutar_static = mysqli_query($conexion, $query_insert_static);

    if (!$ejecutar_static) {
        echo '
            <script>
                alert("Hubo un error al registrar los datos estáticos");
                window.location = "../register.php";
            </script>';
    } else {
        // Capturar los datos dinámicos
        $servicioCompl1 = isset($_POST['servivioCompletado1']) ? htmlspecialchars($_POST['servivioCompletado1']) : null;
        $servicioCompl2 = isset($_POST['servicioCompletado2']) ? htmlspecialchars($_POST['servicioCompletado2']) : null;
        $descripcionVale = isset($_POST['descripcionVale']) ? htmlspecialchars($_POST['descripcionVale']) : null;

        // Verificar que todos los campos dinámicos están presentes
        if ($servicioCompl1 && $servicioCompl2 && $descripcionVale) {
            // Insertar los datos dinámicos en sus respectivas tablas
            $query_insert_servicios = "INSERT INTO servicios (servicioCompletado1, servicioCompletado2) 
                                       VALUES ('$servicioCompl1', '$servicioCompl2')";
            $query_insert_vale = "INSERT INTO vale_refacciones (descripcionVale) 
                                  VALUES ('$descripcionVale')";

            $ejecutar_servicios = mysqli_query($conexion, $query_insert_servicios);
            $ejecutar_vale = mysqli_query($conexion, $query_insert_vale);

            if (!$ejecutar_servicios || !$ejecutar_vale) {
                echo '
                    <script>
                        alert("Hubo un error al registrar los datos dinámicos");
                        window.location = "../register.php";
                    </script>';
            } else {
                echo '
                    <script>
                        alert("Datos registrados exitosamente");
                        window.location = "../success.php";
                    </script>';
            }
        } else {
            echo '
                <script>
                    alert("Por favor, complete todos los campos dinámicos");
                    window.location = "../form.php";
                </script>';
        }
    }

    // Cerrar la conexión
    mysqli_close($conexion);
}
?>
