<?php
include '../../php/conexion_bd.php';
include './get_materiales.php';

$tecnico = $_GET['tecnico'];
$tecnico = mysqli_real_escape_string($conexion, $tecnico);

// Manejo de errores y depuración
function response_error($message) {
    echo "<p>Error: $message</p>";
    exit();
}

// Obtener la última jornada del técnico
$sql_jornada = "SELECT MAX(id_jornada) as ultima_jornada FROM nota_reporte WHERE id_usuario = (SELECT id_usuario FROM usuarios WHERE CONCAT(nombre, ' ', apellido) = '$tecnico')";
$result_jornada = mysqli_query($conexion, $sql_jornada);

if (!$result_jornada) {
    response_error("Error en la consulta SQL: " . mysqli_error($conexion));
}

$row_jornada = mysqli_fetch_assoc($result_jornada);
$ultima_jornada = $row_jornada['ultima_jornada'];

if (!$ultima_jornada) {
    response_error("No se encontró la última jornada para el técnico: $tecnico");
}

// Consultar los detalles de los trabajos del usuario en la última jornada que no hayan sido repuestos
$sql = "SELECT nr.id_trabajo, t.id_solicitud, sol.id_servicio, s.nombre_servicio 
        FROM nota_reporte nr 
        JOIN trabajo t ON nr.id_trabajo = t.id_trabajo
        JOIN solicitudes sol ON t.id_solicitud = sol.id_solicitud
        JOIN servicios s ON sol.id_servicio = s.id_servicio
        WHERE nr.id_usuario = (SELECT id_usuario FROM usuarios WHERE CONCAT(nombre, ' ', apellido) = '$tecnico') 
        AND nr.id_jornada = $ultima_jornada 
        AND nr.reposicion != 'repuesto'";

$result = mysqli_query($conexion, $sql);

if (!$result) {
    response_error("Error en la consulta SQL: " . mysqli_error($conexion));
}

$trabajos = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $trabajos[] = $row;
    }
}

// Generar HTML
$html = '<p>Material del tecnico ya esta repuesto</p>';
if (!empty($trabajos)) {
    $html = '<ul class="list-disc pl-5">';
    foreach ($trabajos as $trabajo) {
        $html .= "<li>ID Trabajo: {$trabajo['id_trabajo']}</li>
                <li>ID Solicitud: {$trabajo['id_solicitud']}</li>
                <li>ID Servicio: {$trabajo['id_servicio']}</li>
                <li>Nombre Servicio: {$trabajo['nombre_servicio']}</li>";

        $materiales = obtenerMaterialesPorServicio($trabajo['id_servicio']);
        if (!empty($materiales)) {
            $html .= "<ul>";
            foreach ($materiales as $material) {
                $html .= "<li>{$material['cantidad']} {$material['nombre']}</li>";
            }
            $html .= "</ul>";
        }

        $html .= "<br>";
    }
    $html .= '</ul>';
}

echo $html;

mysqli_close($conexion);
?>
