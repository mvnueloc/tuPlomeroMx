<?php
include '../../php/conexion_bd.php';
include './get_materiales.php';

$tecnico = $_POST['tecnico'];
$tecnico = mysqli_real_escape_string($conexion, $tecnico);

// Obtener el ID del usuario basado en el nombre del técnico
$sql_usuario = "SELECT id_usuario FROM usuarios WHERE CONCAT(nombre, ' ', apellido) = '$tecnico'";
$result_usuario = mysqli_query($conexion, $sql_usuario);

if (!$result_usuario || mysqli_num_rows($result_usuario) == 0) {
    echo "<p>Error: No se encontró el usuario: $tecnico</p>";
    exit();
}

$row_usuario = mysqli_fetch_assoc($result_usuario);
$id_usuario = $row_usuario['id_usuario'];

// Obtener la última jornada del técnico
$sql_jornada = "SELECT MAX(id_jornada) as ultima_jornada FROM nota_reporte WHERE id_usuario = $id_usuario";
$result_jornada = mysqli_query($conexion, $sql_jornada);

if (!$result_jornada) {
    echo "<p>Error: " . mysqli_error($conexion) . "</p>";
    exit();
}

$row_jornada = mysqli_fetch_assoc($result_jornada);
$ultima_jornada = $row_jornada['ultima_jornada'];

if (!$ultima_jornada) {
    echo "<p>Error: No se encontró la última jornada para el técnico: $tecnico</p>";
    exit();
}

// Obtener los trabajos y materiales utilizados en la última jornada
$query_trabajos = "
    SELECT 
        nr.id_trabajo, 
        sol.id_servicio
    FROM 
        nota_reporte nr
    JOIN 
        trabajo t ON nr.id_trabajo = t.id_trabajo
    JOIN 
        solicitudes sol ON t.id_solicitud = sol.id_solicitud
    WHERE 
        nr.id_usuario = $id_usuario 
        AND nr.id_jornada = $ultima_jornada 
        AND nr.reposicion != 'repuesto'";

$result_trabajos = mysqli_query($conexion, $query_trabajos);

if (!$result_trabajos) {
    echo "<p>Error: " . mysqli_error($conexion) . "</p>";
    exit();
}

$trabajos = [];
if (mysqli_num_rows($result_trabajos) > 0) {
    while ($row = mysqli_fetch_assoc($result_trabajos)) {
        $trabajos[] = $row;
    }
} else {
    echo '
    <script> 
        alert("No se encontraron trabajos para la última jornada del técnico:' .$tecnico. '")
        window.location.href = "./"; 
    </script>';
    exit();
}

// Depuración: Verificar datos de trabajos
// print_r($trabajos);

// Actualizar la tabla nota_reporte
$update_nota_reporte = "
    UPDATE 
        nota_reporte 
    SET 
        reposicion = 'repuesto' 
    WHERE 
        id_usuario = $id_usuario 
        AND id_jornada = $ultima_jornada 
        AND reposicion != 'repuesto'";
if (!mysqli_query($conexion, $update_nota_reporte)) {
    echo "<p>Error actualizando nota_reporte: " . mysqli_error($conexion) . "</p>";
    exit();
}

// Actualizar la cantidad de materiales en la tabla materiales
foreach ($trabajos as $trabajo) {
    $materiales = obtenerMaterialesPorServicio($trabajo['id_servicio']);
    // Depuración: Verificar datos de materiales
    print_r($materiales);
    foreach ($materiales as $material) {
        $material_id = $material['material_id'];
        $cantidad_usada = $material['cantidad'];
        $update_materiales = "
            UPDATE 
                materiales 
            SET 
                cantidad_disponible = cantidad_disponible - $cantidad_usada 
            WHERE 
                material_id = $material_id";
        // Depuración: Comprobar la consulta SQL
        echo $update_materiales;
        if (!mysqli_query($conexion, $update_materiales)) {
            echo "Error actualizando material_id $material_id: " . mysqli_error($conexion);
        }
    }
}

mysqli_close($conexion);
// echo 'tes';
echo '
<script>
    alert("Producto añadido exitosamente");
    window.location.href = "./"; // Use JavaScript for redirection
</script>
';
?>
