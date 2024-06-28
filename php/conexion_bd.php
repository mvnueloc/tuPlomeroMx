<?php

$conexion = mysqli_connect("localhost", "root", "", "plomero","3307");

    if(!$conexion){
        echo '
        <script>
            alert("Error de conexión");
        </script>
        ';
    }

?>