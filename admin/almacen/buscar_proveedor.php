<?php
include '../../php/conexion_bd.php';

$query = isset($_GET['query']) ? mysqli_real_escape_string($conexion, $_GET['query']) : '';

$sql = "SELECT nombre FROM proveedores WHERE nombre LIKE '%$query%'";
$result = mysqli_query($conexion, $sql);

$materiales = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $materiales[] = $row;
    }
}

mysqli_close($conexion);
echo json_encode($materiales);
?>
