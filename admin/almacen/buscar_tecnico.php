<?php
include '../../php/conexion_bd.php';

$search = $_GET['query'];
$search = mysqli_real_escape_string($conexion, $search);

// Consulta para buscar técnicos
$sql = "SELECT id_usuario, CONCAT(nombre, ' ', apellido) as nombre_completo, correo 
        FROM usuarios 
        WHERE tipo_cuenta = 'work' AND 
              (nombre LIKE '%$search%' OR apellido LIKE '%$search%' OR correo LIKE '%$search%')";

$result = mysqli_query($conexion, $sql);

$tecnicos = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $tecnicos[] = $row;
    }
}

mysqli_close($conexion);

// Configurar la cabecera para devolver JSON
header('Content-Type: application/json');
echo json_encode($tecnicos);
?>
