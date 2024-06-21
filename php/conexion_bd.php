<?php

    $conexion = mysqli_connect("localhost", "root", "", "plomero");

    if(!$conexion){
        echo '
        <script>
            alert("Error de conexión");
        </script>
        ';
    }

?>