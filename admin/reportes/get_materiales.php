<?php

function obtenerMaterialesPorServicio($id_servicio) {
    include '../../php/conexion_bd.php';

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

    // Consulta para obtener los nombres y costos de los materiales
    $query = "SELECT material_id, nombre, costo_unitario FROM materiales WHERE material_id IN ($materiales_ids_str)";
    $result = mysqli_query($conexion, $query);

    // Verificar si hay resultados
    if (mysqli_num_rows($result) > 0) {
        // Crear arreglo para almacenar los materiales y sus cantidades
        $materiales = array();

        // Obtener los datos de cada fila
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['material_id'];
            $nombre = $row['nombre'];
            $costo_unitario = $row['costo_unitario'];
            $cantidad = $materiales_cantidades[array_search($id, $materiales_ids)];
            $materiales[] = array(
                'material_id' => $id,
                'nombre' => $nombre,
                'cantidad' => $cantidad,
                'costo_unitario' => $costo_unitario
            );
        }

        // Cerrar conexión
        mysqli_close($conexion);

        return $materiales;
    } else {
        // Cerrar conexión
        mysqli_close($conexion);

        return array(); // Retornar un arreglo vacío si no hay resultados
    }
}
?>