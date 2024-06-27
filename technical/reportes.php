<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    session_destroy();
    header('Location: ../');
    exit();
} else if ($_SESSION['tipo_cuenta'] != 'work') {
    header('Location: ../');
    exit();
}

include(dirname(__DIR__) . '../php/conexion_bd.php');
include './actions/get_materiales.php';

$id_usuario = $_SESSION['id'];

// Obtener el ID de la jornada activa
$query_jornada = "SELECT id_jornada FROM jornadas_trabajo WHERE id_usuario = $id_usuario AND hora_fin IS NULL";
$result_jornada = mysqli_query($conexion, $query_jornada);
if ($result_jornada && mysqli_num_rows($result_jornada) > 0) {
    echo '
      <script>
        alert("Tienes una jornada activa. No puedes acceder a esta vista.");
        window.location = "./";
      </script>
    ';
    exit();
} else {
    // Obtener los servicios realizados y los materiales utilizados
    $query_servicios = "
        SELECT 
            s.nombre_servicio, 
            t.id_trabajo, 
            sol.direccion, 
            sol.codigo_postal,
            s.id_servicio
        FROM 
            trabajo t
        JOIN 
            solicitudes sol ON t.id_solicitud = sol.id_solicitud
        JOIN
            servicios s ON sol.id_servicio = s.id_servicio
        WHERE 
            t.id_trabajador = $id_usuario AND t.status = 1";
    $result_servicios = mysqli_query($conexion, $query_servicios);

    $servicios = [];
    if ($result_servicios && mysqli_num_rows($result_servicios) > 0) {
        while ($row = mysqli_fetch_assoc($result_servicios)) {
            $servicios[] = $row;
        }
    }
}
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

      .min-h-screen-minus-3-5 {
        min-height: calc(
          100vh - 3.5rem
        ); /* Ajusta 3.5rem al valor que necesitas restar */
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
              "screen-minus-3.5": "calc(100vh - 3.5rem)",
            },
          },
        },
      };
    </script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="shadow bg-gray-100">
      <div
        class="relative flex flex-col px-4 py-4 md:mx-auto md:flex-row md:items-center"
      >
        <a
          href="#"
          class="flex items-center whitespace-nowrap text-2xl font-black"
        >
          Nombre
        </a>
        <input type="checkbox" class="peer hidden" id="navbar-open" />
        <label
          class="absolute top-5 right-7 cursor-pointer md:hidden"
          for="navbar-open"
        >
          <svg
            class="w-6 h-6"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            fill="none"
            viewBox="0 0 24 24"
          >
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-width="2"
              d="M5 7h14M5 12h14M5 17h14"
            />
          </svg>
        </label>
        <div
          aria-label="Header Navigation"
          class="peer-checked:mt-8 peer-checked:max-h-56 flex max-h-0 w-full flex-col items-center justify-between overflow-hidden transition-all md:ml-24 md:max-h-full md:flex-row md:items-start"
        >
          <ul
            class="flex flex-col items-center space-y-2 md:ml-auto md:flex-row md:space-y-0"
          >
            <li class="text-gray-600 md:mr-12 hover:text-secundary">
              <a href="./landing.html">Home</a>
            </li>
            <li class="text-secundary md:mr-12 hover:text-secundary">
              <a href="./solicitud.html">Solicitud</a>
            </li>
            <li class="text-gray-600 md:mr-12 hover:text-secundary">
              <a href="./notificacion.html">Notificaciones</a>
            </li>
            <li class="text-gray-600 md:mr-12 hover:text-secundary">
              <button
                class="rounded-md border-2 border-red-500 px-6 py-1 font-medium text-red-500 transition-colors hover:bg-red-500 hover:text-white"
                onclick="window.location.href = '../php/logout.php'"
              >
                Logout
              </button>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <main class="min-h-screen-minus-3-5 w-full">
      <div
        class="w-full py-10 flex flex-col items-center justify-center gap-10"
      >
        <div class="flex flex-row gap-3 w-full md:w-2/3">
          <h2 class="max-md:px-6 text-2xl font-bold">Día:
          <?php
              // Configuración de la fecha actual en español
              $formatter = new IntlDateFormatter(
                  'es_ES',
                  IntlDateFormatter::LONG,
                  IntlDateFormatter::NONE,
                  'Europe/Madrid',
                  IntlDateFormatter::GREGORIAN
              );

              echo $formatter->format(time());
            ?>
            </h2>
        </div>
        <div
          class="w-full flex flex-col md:flex-row md:justify-center gap-14 lg:gap-[10%]"
        >
          <div class="flex flex-col max-lg:px-4 gap-6 justify-center">
            <h3 class="text-2xl font-semibold">Servicios Realizados</h3>
            <div
              class="shadow-lg shadow-gray-300 border-solid border-2 border-gray-300 rounded-xl"
            >
              <table
                class="md:max-w-96 table-fixed md:table-auto text-left shadow-lg"
              >
                <tbody class="bg-white">
                  <?php foreach ($servicios as $servicio): ?>
                    <tr>
                      <td class="p-4 border-b border-gray-700 rounded-t-lg">
                        <p class="block text-sm leading-normal font-semibold">
                          <?php echo $servicio['nombre_servicio']; ?> - <?php echo $servicio['direccion']; ?>, Código Postal: <?php echo $servicio['codigo_postal']; ?>
                        </p>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="flex flex-col max-lg:px-4 gap-6 justify-center">
            <h3 class="text-2xl font-semibold">Material Utilizado</h3>
            <div
              class="shadow-lg shadow-gray-300 border-solid border-2 border-gray-300 rounded-xl"
            >
              <table class="md:max-w-96 table-fixed md:table-auto text-left">
                <tbody class="bg-white">
                  <?php foreach ($servicios as $servicio): 
                    $materiales = obtenerMaterialesPorServicio($servicio['id_servicio'], $conexion);
                  ?>
                    <tr>
                      <td class="p-4 border-b border-gray-700 rounded-t-lg">
                        <p class="block text-sm leading-normal font-semibold">
                          Materiales para <?php echo $servicio['nombre_servicio']; ?>:
                        </p>
                        <ul>
                          <?php foreach ($materiales as $material): ?>
                            <li><?php echo $material['cantidad'] . ' ' . $material['nombre']; ?></li>
                          <?php endforeach; ?>
                        </ul>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="flex flex-row gap-[7%] w-full justify-center">
          <a
            href=""
            class="w-48 text-center py-3 px-14 bg-white text-secundary rounded-lg text-base font-medium"
            >Descargar comprobante</a
          >
          <a
            href=""
            class="w-48 text-center py-3 px-14 bg-secundary text-white text-secundary rounded-lg text-base font-medium"
            >Descargar vale</a
          >
        </div>
      </div>
    </main>
    <!-- footer -->
    <footer class="bg-white border-t-2 border-gray-100">
      <div class="relative mx-auto max-w-screen-xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="lg:flex lg:items-end lg:justify-between">
          <div>
            <div class="flex justify-center text-teal-600 lg:justify-start">
              <img
                src="../assets/img/footer-logo.svg"
                alt="Logo de tuPlomeroMx"
                class="h-8"
              />
            </div>
            <p
              class="mx-auto mt-6 max-w-md text-center leading-relaxed text-gray-500 lg:text-left"
            >
              Soluciones eficientes y confiables para todas tus necesidades de
              plomería.
            </p>
          </div>

          <ul
            class="mt-12 flex flex-wrap justify-center gap-6 md:gap-8 lg:mt-0 lg:justify-end lg:gap-12"
          >
            <li>
              <a
                class="text-gray-700 transition hover:text-gray-700/75"
                href="#"
              >
                Nosotros
              </a>
            </li>
            <li>
              <a
                class="text-gray-700 transition hover:text-gray-700/75"
                href="#"
              >
                Políticas de Privacidad
              </a>
            </li>
            <li>
              <a
                class="text-gray-700 transition hover:text-gray-700/75"
                href="#"
              >
                Contacto
              </a>
            </li>
          </ul>
        </div>

        <p class="mt-12 text-center text-sm text-gray-500 lg:text-right">
          © 2024 <a href="#" class="hover:underline">TuPlomeroMx™</a>. Todos los
          derechos reservados.
        </p>
      </div>
    </footer>
</body>
</html>
