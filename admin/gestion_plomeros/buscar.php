<?php
include '../../php/conexion_bd.php';

$query = isset($_GET['query']) ? mysqli_real_escape_string($conexion, $_GET['query']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// Consulta para obtener los registros con búsqueda y paginación
$sql = "SELECT 
            u.id_usuario, 
            u.nombre, 
            u.apellido, 
            u.correo, 
            u.telefono,  
            u.zona, 
            u.fecha_alta,
            IF(j.id_jornada IS NULL, 'inactivo', 'activo') AS estado_jornada
        FROM 
            usuarios u
        LEFT JOIN 
            jornadas_trabajo j 
        ON 
            u.id_usuario = j.id_usuario 
        AND 
            j.fecha = CURDATE()
        WHERE 
            u.tipo_cuenta = 'work' 
        AND 
            u.estado = 'alta' 
        AND 
            (u.nombre LIKE '%$query%' 
            OR u.apellido LIKE '%$query%' 
            OR u.correo LIKE '%$query%' 
            OR u.telefono LIKE '%$query%')
        LIMIT $limit OFFSET $offset";

$result = mysqli_query($conexion, $sql);

// Arreglo para almacenar los plomeros
$plomeros = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $plomeros[] = $row;
    }
}

// Consulta para obtener el número total de registros
$total_sql = "SELECT COUNT(*) as total 
              FROM usuarios u 
              WHERE u.tipo_cuenta = 'work' 
              AND u.estado = 'alta' 
              AND (u.nombre LIKE '%$query%' 
              OR u.apellido LIKE '%$query%' 
              OR u.correo LIKE '%$query%' 
              OR u.telefono LIKE '%$query%')";
$total_result = mysqli_query($conexion, $total_sql);
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit); // Calcula el número total de páginas

mysqli_close($conexion);
?>

<!-- Generar tabla y paginación -->
<table class="items-center bg-transparent w-full border-collapse">
    <thead>
        <tr>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">ID</th>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Nombre</th>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Apellidos</th>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Correo Electrónico</th>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Teléfono</th>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Zona</th>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Fecha de Alta</th>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Estado Jornada</th>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Editar</th>
            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Eliminar</th>
        </tr>
    </thead>
    <tbody id="table-body">
        <?php foreach ($plomeros as $plomero): ?>
            <tr>
                <td class='border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4'><?php echo htmlspecialchars($plomero['id_usuario']); ?></td>
                <td class='border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4'><?php echo htmlspecialchars($plomero['nombre']); ?></td>
                <td class='border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4'><?php echo htmlspecialchars($plomero['apellido']); ?></td>
                <td class='border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4'><?php echo htmlspecialchars($plomero['correo']); ?></td>
                <td class='border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4'><?php echo htmlspecialchars($plomero['telefono']); ?></td>
                <td class='border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4'><?php echo htmlspecialchars($plomero['zona']); ?></td>
                <td class='border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4'><?php echo htmlspecialchars($plomero['fecha_alta']); ?></td>
                <td class='border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4'>
                    <span class='inline-flex items-center gap-1 rounded-full
                                <?php echo ($plomero['estado_jornada'] == 'activo') ? 'bg-green-50 text-green-600' : 'bg-orange-50 text-orange-600'; ?>
                                px-2 py-1 text-xs font-semibold'>
                        <span class='h-1.5 w-1.5 rounded-full
                                    <?php echo ($plomero['estado_jornada'] == 'activo') ? 'bg-green-600' : 'bg-orange-600'; ?>'>
                        </span>
                        <?php echo htmlspecialchars($plomero['estado_jornada']); ?>
                    </span>
                </td>
                <td class='border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4'>
                    <button class='hover:text-blue-300 text-blue-900' onclick="openEditModal(<?php echo $plomero['id_usuario']; ?>)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                        </svg>
                    </button>
                </td>
                <td class='border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4'>
                    <button class='hover:text-red-300 text-red-900' onclick="openDeleteModal(<?php echo $plomero['id_usuario']; ?>)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                        </svg>
                    </button>
                </td>
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

<!-- Re-attach event listeners for edit and delete buttons -->
<script>
    document.querySelectorAll('[onclick^="openEditModal"]').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('onclick').match(/\d+/)[0];
            openEditModal(id);
        });
    });

    document.querySelectorAll('[onclick^="openDeleteModal"]').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('onclick').match(/\d+/)[0];
            openDeleteModal(id);
        });
    });
</script>
