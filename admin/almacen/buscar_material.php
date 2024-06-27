<?php
include '../../php/conexion_bd.php';

$query = isset($_GET['query']) ? mysqli_real_escape_string($conexion, $_GET['query']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit; // Calcula el offset basado en la página actual

// Consulta para obtener los materiales con búsqueda y paginación
$sql = "SELECT material_id, nombre, descripcion, dimensiones, unidad_de_medida, costo_unitario, cantidad_disponible 
        FROM materiales 
        WHERE nombre LIKE '%$query%' OR descripcion LIKE '%$query%' OR dimensiones LIKE '%$query%'
        LIMIT $limit OFFSET $offset";
$result = mysqli_query($conexion, $sql);

// Arreglo para almacenar los materiales
$materiales = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $materiales[] = $row;
    }
}

// Consulta para obtener el número total de registros que coinciden con la búsqueda
$total_sql = "SELECT COUNT(*) as total 
              FROM materiales 
              WHERE nombre LIKE '%$query%' OR descripcion LIKE '%$query%' OR dimensiones LIKE '%$query%'";
$total_result = mysqli_query($conexion, $total_sql);
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit); // Calcula el número total de páginas

mysqli_close($conexion);
?>

<!-- Genera la tabla con los resultados -->
<table class="items-center bg-transparent w-full border-collapse">
    <thead>
        <tr>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">ID</th>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Nombre</th>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Descripcion</th>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Dimensiones</th>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Unidad de medida</th>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Costo unitario</th>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Stock</th>
        </tr>
    </thead>
    <tbody id="table-body">
        <?php foreach ($materiales as $material): ?>
            <tr>
                <td class='border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4'><?php echo htmlspecialchars($material['material_id']); ?></td>
                <td class='border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4'><?php echo htmlspecialchars($material['nombre']); ?></td>
                <td class='border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4'><?php echo htmlspecialchars($material['descripcion']); ?></td>
                <td class='border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4'><?php echo htmlspecialchars($material['dimensiones']); ?></td>
                <td class='border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4'><?php echo htmlspecialchars($material['unidad_de_medida']); ?></td>
                <td class='border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4'><?php echo htmlspecialchars($material['costo_unitario']); ?></td>
                <td class='border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4'><?php echo htmlspecialchars($material['cantidad_disponible']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Paginación -->
<div class="flex justify-center mt-4">
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <button class="mx-1 px-3 py-1 border rounded-md <?php echo $i == $page ? 'bg-primary text-white' : 'bg-white text-primary hover:bg-third hover:text-white'; ?>" onclick="fetchResults('<?php echo $query; ?>', <?php echo $i; ?>)">
            <?php echo $i; ?>
        </button>
    <?php endfor; ?>
</div>
