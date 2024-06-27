<?php
// Función para obtener los materiales de un servicio por su ID, incluyendo la cantidad utilizada
function obtenerMaterialesPorServicio($id_servicio) {
    
    include(dirname(__DIR__).'../../php/conexion_bd.php');

    // Array de materiales según el ID del servicio
    $materiales_ids = [];
    $materiales_cantidades = [];

    switch ($id_servicio) {
        case 1:
            $materiales_ids = [1, 2, 3]; // IDs de los materiales para el servicio 1
            $materiales_cantidades = [1, 1, 1]; // Cantidades correspondientes
            break;
        case 2:
            $materiales_ids = [4, 5, 6, 7]; // IDs de los materiales para el servicio 2
            $materiales_cantidades = [3, 5, 2, 1]; // Cantidades correspondientes
            break;
        case 3:
            $materiales_ids = [8, 9, 10]; // IDs de los materiales para el servicio 3
            $materiales_cantidades = [1, 1, 2]; // Cantidades correspondientes
            break;
        default:
            return [];
    }

    // Convertir el array de IDs a una cadena separada por comas para la consulta SQL
    $materiales_ids_str = implode(",", $materiales_ids);

    // Consulta para obtener los nombres de los materiales
    $query = "SELECT material_id, nombre FROM materiales WHERE material_id IN ($materiales_ids_str)";
    $result = $conexion->query($query);

    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        // Crear arreglo para almacenar los materiales y sus cantidades
        $materiales = array();

        // Obtener los datos de cada fila
        while ($row = $result->fetch_assoc()) {
            $id = $row['material_id'];
            $nombre = $row['nombre'];
            $cantidad = $materiales_cantidades[array_search($id, $materiales_ids)];
            $materiales[] = array('nombre' => $nombre, 'cantidad' => $cantidad);
        }

        // Cerrar conexión
        $conexion->close();

        return $materiales;
    } else {
        // Cerrar conexión
        $conexion->close();

        return array(); // Retornar un arreglo vacío si no hay resultados
    }
}

// Ejemplo de uso de la función
// $id_servicio = 1; // ID del servicio para el cual quieres obtener los materiales
// $materiales = obtenerMaterialesPorServicio($id_servicio);

// // Imprimir los materiales obtenidos
// echo "<pre>";
// print_r($materiales);
// echo "</pre>";
?>
