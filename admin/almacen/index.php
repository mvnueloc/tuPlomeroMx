<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../php/conexion_bd.php';


session_start();
if (!isset($_SESSION['usuario'])) {
  session_destroy();
  header('Location: ../');
  exit();
} else if ($_SESSION['tipo_cuenta'] != 'admin') {
  header('Location: ../');
  exit();
}

// if(!isset($_SESSION['usuario']) || $_SESSION['tipo_cuenta'] != 'admin'){
//     session_destroy();
//     header('Location: ../');
    
//     exit();
//   }

// Número de registros por página
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit; // Calcula el offset basado en la página actual

// Consulta para obtener los materiales con paginación
$sql = "SELECT material_id, nombre, descripcion,cantidad_disponible, costo_unitario, unidad_de_medida, dimensiones  FROM materiales LIMIT $limit OFFSET $offset";
$result = mysqli_query($conexion, $sql);

// Arreglo para almacenar los materiales
$materiales = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $materiales[] = $row;
    }
}

// Consulta para obtener el número total de registros
$total_sql = "SELECT COUNT(*) as total FROM materiales";
$total_result = mysqli_query($conexion, $total_sql);
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit); // Calcula el número total de páginas

mysqli_close($conexion);
?>

<?php
include '../../php/conexion_bd.php';

// Número de registros por página
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit; // Calcula el offset basado en la página actual

// Consulta para obtener los materiales con paginación
$sql = "SELECT material_id, nombre, descripcion,cantidad_disponible, costo_unitario, unidad_de_medida, dimensiones  FROM materiales LIMIT $limit OFFSET $offset";
$result = mysqli_query($conexion, $sql);

// Arreglo para almacenar los materiales
$materiales = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $materiales[] = $row;
    }
}

// Consulta para obtener el número total de registros
$total_sql = "SELECT COUNT(*) as total FROM materiales";
$total_result = mysqli_query($conexion, $total_sql);
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit); // Calcula el número total de páginas

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>tuPlomeroMx</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style type="text/tailwindcss">
    @layer utilities {
      .content-auto {
        content-visibility: auto;
      }
    }
  </style>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: "#13212A",
            secundary: "#0077C2",
            third: "#243f50",
          },
          height: {
            "screen-minus-16": "calc(100vh - 16rem)",
          },
        },
      },
    };
  </script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="shadow bg-gray-100">
        <div class="relative flex flex-col px-6 py-4 md:mx-auto md:flex-row md:items-center">
            <a href="#" class="flex items-center whitespace-nowrap text-2xl font-black">
                tuPlomeroMX
            </a>
            <input type="checkbox" class="peer hidden" id="navbar-open" />
            <label class="absolute top-5 right-7 cursor-pointer md:hidden" for="navbar-open">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14" />
                </svg>
            </label>
            <div aria-label="Header Navigation" class="peer-checked:mt-8 peer-checked:max-h-56 flex max-h-0 w-full flex-col items-center justify-between overflow-hidden transition-all md:ml-24 md:max-h-full md:flex-row md:items-start">
                <ul class="flex flex-col items-center space-y-2 md:ml-auto md:flex-row md:space-y-0">
                    <li class="text-gray-600 md:mr-12 hover:text-secundary">
                        <a href="../gestion_plomeros/">Empleados</a>
                    </li>
                    <li class="text-secundary md:mr-12 hover:text-secundary">
                        <a href="">Almacén</a>
                    </li>
                    <li class=" md:mr-12 hover:text-secundary">
                        <a href="../reportes">Reportes</a>
                    </li>
                    <li class="text-gray-600">
                        <button onclick="window.location.href='../../php/logout.php'" class="rounded-md border-2 border-primary px-6 py-1 font-medium text-primary transition-colors hover:bg-primary hover:text-white">
                            Cerrar Sesión
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido -->
    <section class="w-full">
        <div class="w-full md:flex-row justify-between">
            <section class="py-1 bg-blueGray-50 w-full sm:p-10">
                <div class="flex justify-center item-center mb-7">
                    <h2 class="font-bold text-4xl text-primary">Almacén</h2>
                </div>
                <div class="w-full pb-6 pt-2 bg-white xl:mb-0 sm:px-4 mx-auto rounded-lg">
                    <div class="relative flex flex-col min-w-0 break-words w-full">
                        <div class="rounded-t mb-0 px-4 py-3 border-0">
                            <div class="flex flex-wrap items-center">
                                <div class="w-full px-4 max-w-full flex flex-wrap sm:flex-row justify-between">
                                    <!-- Título -->
                                    <div class="flex items-center text-left sm:text-center sm:mb-10 md:mb-0 mb-0">
                                        <h3 class="font-semibold text-base">Lista de Materiales</h3>
                                    </div>
                                    <!-- Barra de búsqueda -->
                                    <div class="w-full sm:w-auto mt-4 sm:mt-0 flex items-center justify-center sm:mb-10 md:mb-0 mb-0">
                                        <div class="relative">
                                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 612.08 612.08" style="enable-background:new 0 0 612.08 612.08;" xml:space="preserve">
                                                    <path d="M237.927,0C106.555,0,0.035,106.52,0.035,237.893c0,131.373,106.52,237.893,237.893,237.893 c50.518,0,97.368-15.757,135.879-42.597l0.028-0.028l176.432,176.433c3.274,3.274,8.48,3.358,11.839,0l47.551-47.551 c3.274-3.274,3.106-8.703-0.028-11.838L433.223,373.8c26.84-38.539,42.597-85.39,42.597-135.907C475.82,106.52,369.3,0,237.927,0z M237.927,419.811c-100.475,0-181.918-81.443-181.918-181.918S137.453,55.975,237.927,55.975s181.918,81.443,181.918,181.918 S338.402,419.811,237.927,419.811z"/>
                                                </svg>
                                            </span>
                                            <input required id="search" type="text" name="search" placeholder="Buscar" class="pl-10 border-2 w-full sm:w-96 p-2 text-sm font-medium outline-none focus:bg-gray-100 placeholder-text-gray-700 bg-white text-gray-900 rounded-2xl"/>
                                        </div>
                                    </div>
                                    
                                    <!-- Botones de filtro y orden -->
                                    <button id="add_Product" class="mt-4 sm:mt-0 flex items-center justify-end relative">
                                        <p class="border-2 p-2 text-sm font-medium outline-none hover:bg-secundary bg-primary text-white rounded-2xl">
                                            Añadir Producto
                                        </p>
                                    </button>
                                    <button id="add_Stock" class="mt-4 sm:mt-0 flex items-center justify-end relative">
                                        <p class="border-2 p-2 text-sm font-medium outline-none hover:bg-secundary bg-primary text-white rounded-2xl">
                                            + Reponer Stock
                                        </p>
                                    </button>
                                    <button id="remove_stock" class="mt-4 sm:mt-0 flex items-center justify-end relative">
                                        <p class="border-2 p-2 text-sm font-medium outline-none hover:bg-secundary bg-primary text-white rounded-2xl">
                                            - Asignar Recursos
                                        </p>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="block w-full overflow-x-auto">
                            <div id="results">
                                <!-- Aquí se insertará la tabla actualizada -->
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
                                        <button class="mx-1 px-3 py-1 border rounded-md <?php echo $i == $page ? 'bg-primary text-white' : 'bg-white text-primary hover:bg-third hover:text-white'; ?>" onclick="fetchResults('<?php echo isset($_GET['query']) ? $_GET['query'] : ''; ?>', <?php echo $i; ?>)">
                                            <?php echo $i; ?>
                                        </button>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>

<!-- Modal Añadir Producto -->
<div id="modalProduct" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
        <h2 class="text-2xl mb-4">Añadir Producto</h2>
        <form id="addProductForm" class="grid grid-cols-4 gap-4" method="POST" action="anadir_producto.php">
            <div class="col-span-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">Nombre</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombre" name="nombre" type="text" required>
            </div>
            <div class="col-span-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="descripcion">Descripción</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="descripcion" name="descripcion" type="text" required>
            </div>
            <div class="col-span-2 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="dimensiones">Dimensiones</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="dimensiones" name="dimensiones" type="text" required>
            </div>
            <div class="col-span-2 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="unidad_de_medida">Unidad de Medida</label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="unidad_de_medida" name="unidad_de_medida" required>
                    <option value="cm">Centímetros</option>
                    <option value="m">Metros</option>
                    <option value="l">Litros</option>
                    <option value="kg">Kilogramos</option>
                </select>
            </div>
            <div class="col-span-4 flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-xl focus:outline-none focus:shadow-outline" type="submit">
                    Añadir
                </button>
                <button id="closeProductModalButton" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-xl focus:outline-none focus:shadow-outline" type="button">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Reponer Stock -->
<div id="modalAdd" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-8 rounded-lg shadow-lg w-1/2 max-h-screen overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-2xl">Reponer Stock</h2>
          <button id="add_Proveedor" class="text-white bg-primary p-2 rounded-xl">
              Añadir Proveedor
          </button>
        </div>
        <form id="addStockForm" class="grid grid-cols-4 gap-4" method="POST" action="reponer_stock.php">
            <div class="col-span-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="material">Material</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline autocomplete" id="material" name="material[]" type="text" required list="material-list">
                <datalist id="material-list"></datalist>
            </div>
            <div class="col-span-2 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="cantidad">Cantidad</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cantidad" name="cantidad[]" type="number" required>
            </div>
            <div class="col-span-2 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="costo_unitario">Costo Unitario</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="costo_unitario" name="costo_unitario[]" type="number" step="0.01" min="0" max="1000" required>
            </div>
            <div class="col-span-2 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="proveedor">Proveedor</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline autocomplete" id="proveedor" name="proveedor[]" type="text" required list="proveedor-list">
                <datalist class="w-full bg-white text-gray-500" id="proveedor-list"></datalist>
            </div>
            <div id="additionalProductsContainer" class="col-span-4"></div>
            <div class="col-span-4 flex items-center justify-between">
                <button type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-xl focus:outline-none focus:shadow-outline" onclick="addProductFields()">
                    Añadir Otro Producto
                </button>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-xl focus:outline-none focus:shadow-outline" type="submit">
                    Reponer
                </button>
                <button id="closeAddModalButton" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-xl focus:outline-none focus:shadow-outline" type="button">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Asignar Recursos -->
<div id="modalRemove" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
        <h2 class="text-2xl mb-4">Reponer materiales del Tecnico</h2>
        <form id="removeStockForm" class="grid grid-cols-4 gap-4" method="POST" action="asignar_recursos.php">
            <div class="col-span-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="material">Material</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline autocomplete" id="material_remove" name="material" type="text" required list="material-remove-list">
                <datalist id="material-remove-list"></datalist>
            </div>
            <div class="col-span-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="cantidad">Cantidad</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cantidad_remove" name="cantidad" type="number" required>
            </div>
            <div class="col-span-4 flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-xl focus:outline-none focus:shadow-outline" type="submit">
                    Asignar
                </button>
                <button id="closeRemoveModalButton" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-xl focus:outline-none focus:shadow-outline" type="button">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Añadir Proveedor -->
<div id="modalProveedor" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
        <h2 class="text-2xl mb-4">Añadir Proveedor</h2>
        <form id="addProveedorForm" class="grid grid-cols-4 gap-4" method="POST" action="anadir_proveedor.php">
            <div class="col-span-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">Nombre</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombreProveedor" name="nombre" type="text" required>
            </div>
            <div class="col-span-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="correo">Correo</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="correo" name="correo" type="email" required>
            </div>
            <div class="col-span-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="telefono">Teléfono</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="telefono" name="telefono" type="text" pattern="[0-9]{10}" title="Debe ser un número de teléfono válido de 10 dígitos" required>
            </div>
            <div class="col-span-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="direccion">Dirección</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="direccion" name="direccion" type="text" required>
            </div>
            <div class="col-span-4 flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-xl focus:outline-none focus:shadow-outline" type="submit">
                    Añadir
                </button>
                <button id="closeProveedorModalButton" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-xl focus:outline-none focus:shadow-outline" type="button">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const addProductButton = document.getElementById('add_Product');
    const addStockButton = document.getElementById('add_Stock');
    const addProveedorButton = document.getElementById('add_Proveedor');
    const removeStockButton = document.getElementById('remove_stock');
    const modalProduct = document.getElementById('modalProduct');
    const modalAdd = document.getElementById('modalAdd');
    const modalRemove = document.getElementById('modalRemove');
    const modalProveedor = document.getElementById('modalProveedor');
    const closeProductModalButton = document.getElementById('closeProductModalButton');
    const closeAddModalButton = document.getElementById('closeAddModalButton');
    const closeRemoveModalButton = document.getElementById('closeRemoveModalButton');
    const closeProveedorModalButton = document.getElementById('closeProveedorModalButton');
    const addProductForm = document.getElementById('addProductForm');
    const addStockForm = document.getElementById('addStockForm');
    const addProveedorForm = document.getElementById('addProveedorForm');

    addProductButton.addEventListener('click', () => {
        modalProduct.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    });

    closeProductModalButton.addEventListener('click', () => {
        modalProduct.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    });

    addStockButton.addEventListener('click', () => {
        modalAdd.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    });

    closeAddModalButton.addEventListener('click', () => {
        modalAdd.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        resetAddStockForm();
    });

    addProveedorButton.addEventListener('click', () => {
        modalProveedor.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    });

    closeProveedorModalButton.addEventListener('click', () => {
        modalProveedor.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    });

    removeStockButton.addEventListener('click', () => {
        modalRemove.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    });

    closeRemoveModalButton.addEventListener('click', () => {
        modalRemove.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    });

    function addProductFields() {
    const container = document.getElementById('additionalProductsContainer');
    const productFields = document.createElement('div');
    productFields.className = 'product-fields mb-4';

    productFields.innerHTML = `
        <div class="my-6 flex items-center justify-center">
            <div class="border-t border-gray-300 flex-grow"></div>
            <span class="mx-4 text-gray-500">otro producto</span>
            <div class="border-t border-gray-300 flex-grow"></div>
        </div>

        <div class="flex justify-end">
            <button class='hover:text-red-300 text-red-900 remove-product'>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                </svg>
            </button>
        </div>

        <div class="grid grid-cols-4 gap-4">
            <div class="col-span-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="material">Material</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline autocomplete" name="material[]" type="text" required list="material-list">
            </div>
            <div class="col-span-2 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="cantidad">Cantidad</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="cantidad[]" type="number" required>
            </div>
            <div class="col-span-2 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="costo_unitario">Costo Unitario</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="costo_unitario[]" type="number" required>
            </div>
            <div class="col-span-2 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="proveedor">Proveedor</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline autocomplete" name="proveedor[]" type="text" required list="proveedor-list">
            </div>
        </div>
    `;

    container.appendChild(productFields);

    const removeButton = productFields.querySelector('.remove-product');
    removeButton.addEventListener('click', function() {
        productFields.remove();
    });

    const materialInputs = productFields.querySelectorAll('.autocomplete[name="material[]"]');
    const proveedorInputs = productFields.querySelectorAll('.autocomplete[name="proveedor[]"]');
    
    materialInputs.forEach(input => {
        input.addEventListener('input', function() {
            fetchAutocompleteResults('buscar_anadir.php', this);
        });
    });

    proveedorInputs.forEach(input => {
        input.addEventListener('input', function() {
            fetchAutocompleteResults('buscar_proveedor.php', this);
        });
    });
}



    function resetAddStockForm() {
        const container = document.getElementById('additionalProductsContainer');
        container.innerHTML = '';
        addStockForm.reset();
    }

    function fetchAutocompleteResults(url, input) {
        const query = input.value;
        fetch(`${url}?query=${query}`)
            .then(response => response.json())
            .then(data => {
                let listId = input.getAttribute('list');
                let datalist = document.getElementById(listId);

                if (!datalist) {
                    datalist = document.createElement('datalist');
                    listId = `${input.name}-list`;
                    datalist.id = listId;
                    input.setAttribute('list', listId);
                    document.body.appendChild(datalist);
                }

                datalist.innerHTML = '';

                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.nombre || item.material;
                    datalist.appendChild(option);
                });
            })
            .catch(error => console.error('Error:', error));
    }
    
    function fetchResults(query, page) {
        fetch('buscar_material.php?query=' + query + '&page=' + page)
            .then(response => response.text())
            .then(data => {
                document.getElementById('results').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
    }

    document.addEventListener('DOMContentLoaded', function() {
        const materialInputs = document.querySelectorAll('.autocomplete[name="material[]"]');
        const proveedorInputs = document.querySelectorAll('.autocomplete[name="proveedor[]"]');

        materialInputs.forEach(input => {
            input.addEventListener('input', function() {
                fetchAutocompleteResults('buscar_anadir.php', this);
            });
        });

        proveedorInputs.forEach(input => {
            input.addEventListener('input', function() {
                fetchAutocompleteResults('buscar_proveedor.php', this);
            });
        });
    });
</script>
</body>
</html>
