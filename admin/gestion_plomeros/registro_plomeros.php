<?php
include '../../php/conexion_bd.php';

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
            u.tipo_cuenta = 'work'";

$result = mysqli_query($conexion, $sql);

$plomeros = [];
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $plomeros[] = $row;
    }
} else {
    echo "0 resultados";
}
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
          },
          height: {
            "screen-minus-16": "calc(100vh - 16rem)",
          },
        },
      },
    };
  </script>
</head>
<body class="bg-primary">

    <!-- Navbar -->
    <nav class="bg-primary border-b-2 border-white/[.3] h-14 flex items-center justify-center md:justify-between">
        <div class="mx-12 hidden md:block">
            <a class="text-white" href="#">NOMBRE</a>
        </div>

        <div class="md:mx-12">
            <div>
                <a class="text-secundary hover:text-secundary text-sm px-3 py-2 mx-2 transition-colors duration-300" href="./registro_plomeros.php">Empleados</a>
                <a class="text-white hover:text-secundary text-sm px-3 py-2 mx-2 transition-colors duration-300" href="./almacen.html">Almacen</a>
                <a class="text-white hover:text-secundary text-sm px-3 py-2 mx-2 transition-colors duration-300" href="./reportes.html">Reportes</a>
            </div>
        </div>
    </nav>

    <!-- Contenido -->
    <section class="w-full">
        <div class="w-full md:flex-row justify-between">
            <section class="py-1 bg-blueGray-50 w-full sm:p-10">
                <div class="flex justify-center item-center mb-7">
                    <h2 class="font-bold text-4xl text-white">Empleados</h2>
                </div>
                <div class="w-full pb-6 pt-2 bg-white xl:mb-0 sm:px-4 mx-auto rounded-lg">
                    <div class="relative flex flex-col min-w-0 break-words w-full">
                        <div class="rounded-t mb-0 px-4 py-3 border-0">
                            <div class="flex flex-wrap items-center">
                                <div class="w-full px-4 max-w-full flex flex-wrap sm:flex-row justify-between">
                                    <!-- Título -->
                                    <div class="flex items-center text-left sm:text-center sm:mb-10 md:mb-0 mb-0">
                                        <h3 class="font-semibold text-base">Lista de Plomeros</h3>
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
                                    <div class="mt-4 sm:mt-0 flex items-center justify-end relative">
                                        <select class="border-2 p-2 text-sm font-medium outline-none focus:bg-gray-100 placeholder:text-gray-700 bg-white text-gray-900 rounded-2xl">
                                            <option value="filtrar">Filtrar</option>
                                            <option value="opcion1">Zona</option>
                                            <option value="opcion2">Estado</option>
                                            <option value="opcion3">Fecha de Alta</option>
                                        </select>
                                    </div>
                                    <!-- Orden -->
                                    <div class="mt-4 sm:mt-0 flex items-center justify-end relative">
                                        <select class="border-2 p-2 text-sm font-medium outline-none focus:bg-gray-100 placeholder:text-gray-700 bg-white text-gray-900 rounded-2xl">
                                            <option value="filtrar">Ordenar</option>
                                            <option value="opcion1">ID</option>
                                            <option value="opcion2">Nombre</option>
                                            <option value="opcion3">Estado</option>
                                        </select>
                                    </div>

                                    <button id="add_plomer" class="mt-4 sm:mt-0 flex items-center justify-end relative">
                                        <p class="border-2 p-2 text-sm font-medium outline-none hover:bg-secundary bg-primary text-white rounded-2xl">
                                            + Añadir
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
                                                    <button class='hover:text-blue-300 text-blue-900'>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                                                        </svg>
                                                    </button>
                                                </td>
                                                <td class='border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4'>
                                                    <button class='hover:text-red-300 text-red-900'>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>

<!-- Modal -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
        <h2 class="text-2xl mb-4">Añadir Nuevo Empleado</h2>
        <!-- Formulario dentro del modal -->
        <form id="addEmployeeForm" class="p-5 grid grid-cols-4 gap-4 items-center" method="POST" action="nuevo_plomero.php">
            <div class="col-start-1 col-span-2 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">Nombre</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombre" name="nombre" type="text" placeholder="Valeria" required pattern="[A-Za-z\s]{1,50}">
            </div>
            <div class="col-start-3 col-span-2 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="apellidos">Apellidos</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="apellidos" name="apellidos" type="text" placeholder="Sanchez Jaramillo" required pattern="[A-Za-z\s]{1,50}">
            </div>
            <div class="col-start-1 col-span-4 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="correo">Correo</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="correo" name="correo" type="email" placeholder="example@gmail.com" required>
            </div>
            <div class="col-start-1 col-span-2 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Contraseña</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" name="password" type="password" placeholder="******" required minlength="6">
            </div>
            <div class="col-start-3 col-span-2 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="confpassword">Confirmar Contraseña</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="confpassword" name="confpassword" type="password" placeholder="******" required minlength="6">
            </div>
            <div class="col-start-1 col-span-2 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="cp">Código Postal</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cp" name="cp" type="number" placeholder="00000" required minlength="5" maxlength="5">
            </div>
            <div class="col-start-3 col-span-2 mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="telefono">Teléfono</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="telefono" name="telefono" type="number" placeholder="##########" required minlength="10" maxlength="10">
            </div>
            <div class="col-span-4 flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-xl focus:outline-none focus:shadow-outline" type="submit">
                    Añadir
                </button>
                <button id="closeModalButton" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-xl focus:outline-none focus:shadow-outline" type="button">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- creacion de plomero -->
<script>
    const addButton = document.getElementById('add_plomer');
    const modal = document.getElementById('modal');
    const closeModalButton = document.getElementById('closeModalButton');
    const addEmployeeForm = document.getElementById('addEmployeeForm');

    addButton.addEventListener('click', () => {
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    });

    closeModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    });

    addEmployeeForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(addEmployeeForm);

        fetch('nuevo_plomero.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            if (data.includes('Usuario registrado exitosamente')) {
                alert("Usuario registrado exitosamente");
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
                window.location.reload(); // Reload to update the table
            } else {
                alert(data);
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>

<!-- barra de busqueda -->
<script>
    document.getElementById('search').addEventListener('keyup', function() {
        let query = this.value;
        if (query.length > 0) {
            fetchResults(query);
        } else {
            fetchResults(''); // Fetch all results if the search is empty
        }
    });

    function fetchResults(query) {
        fetch('buscar.php?query=' + query)
            .then(response => response.text())
            .then(data => {
                document.getElementById('results').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
    }
</script>

</body>
</html>
