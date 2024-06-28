<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(dirname(__DIR__) . '/php/conexion_bd.php');

$query = "SELECT 
    u.nombre,
    p.fecha_pago, 
    t.calificacion, 
    t.comentario, 
    t.evidencia
FROM 
    usuarios u
JOIN 
    solicitudes s ON u.id_usuario = s.id_cliente
JOIN 
    trabajo t ON s.id_solicitud = t.id_solicitud
JOIN 
    pagos p ON t.id_trabajo = p.id_trabajo
WHERE 
    p.status = 1
ORDER BY 
    p.fecha_pago DESC
LIMIT 5";

$result_query = mysqli_query($conexion, $query);

// foreach ($result_query as $row) {
//   $nombre = $row['nombre'];
//   echo $nombre . '<br>';
//   $fecha_pago = $row['fecha_pago'];
//   echo $fecha_pago . '<br>';
//   $calificacion = $row['calificacion'];
//   echo $calificacion . '<br>';
//   $comentario = $row['comentario'];
//   echo $comentario . '<br>';
//   // $evidencia = $row['evidencia'];
// }
