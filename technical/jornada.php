<?php
  session_start();
  if(!isset($_SESSION['usuario']) || $_SESSION['tipo_cuenta'] != 'work'){
    header('Location: ../');
    exit();
  }

  if(!isset($_SESSION['jornada'])){
    $_SESSION['jornada'] = "iniciada";
    $_SESSION['servicio'] = "none";
  }

  include '../php/conexion_bd.php';
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
              "screen-minus-68": "calc(100vh - 68px)",
              "screen-minus-64": "calc(100vh - 64px)",
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
            <li class="text-secundary md:mr-12 hover:text-secundary">
              <a href="">Solicitud</a>
            </li>
            <li class="text-gray-600 md:mr-12 hover:text-secundary">
              <a href="./reportes.php">Reportes</a>
            </li>
            <li class="text-gray-600 md:mr-12 hover:text-secundary">
              <button
                class="rounded-md border-2 border-primary px-6 py-1 font-medium text-primary transition-colors hover:bg-primary hover:text-white"
                onclick="window.location.href = '../php/logout.php'"
              >
                Cerrar Sesión
              </button>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <main class="h-screen-minus-64 md:h-screen-minus-68 w-full">
      <div
        class="w-full py-10 flex flex-col items-center justify-center gap-10"
      >
        <div class="flex flex-row gap-3 px-4 md:px-0 w-full md:w-2/3">
          <svg
            class="w-6 h-6 md:w-8 md:h-8"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            fill="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              fill-rule="evenodd"
              d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z"
              clip-rule="evenodd"
            />
          </svg>
          <h2 class="text-lg md:text-2xl font-bold">
            Ubicación: Sur de la CDMX
          </h2>
        </div>
        <!-- component -->
        <div
          class="w-full md:w-4/5 shadow-lg shadow-gray-300 border-solid border-2 border-gray-300 rounded-lg"
        >
          <table class="w-full table-auto text-left">
            <?php 
              $getAvailableRequest = "SELECT * FROM solicitudes WHERE status = 'pendiente' ORDER BY fecha_hora ASC";
              $getElements = mysqli_query($conexion, $getAvailableRequest);

              if(mysqli_num_rows($getElements) != 0 && $_SESSION['jornada'] == "iniciada"){
                
                echo'
                <thead class="bg-gray-900 text-white rounded-t-lg">
                  <tr>
                    <th
                      class="py-2 md:py-3 px-3 md:px-6 text-left border-r border-gray-300 text-base md:text-xl font-normal rounded-tl-lg"
                    >
                      Servicio
                    </th>
                    <th
                      class="py-2 md:py-3 px-3 md:px-6 text-left border-r border-gray-300 text-base md:text-xl font-normal"
                    >
                      Domicilio
                    </th>
                    <th
                      class="py-2 md:py-3 px-3 md:px-6 text-left border-r border-gray-300 text-base md:text-xl font-normal"
                    >
                      Costo
                    </th>
                    <th
                      class="py-2 md:py-3 px-3 md:px-6 text-left border-gray-300 text-base md:text-xl font-normal rounded-tr-lg"
                    >
                      Acción
                    </th>
                  </tr>
                </thead>
                ';                
                echo '<tbody class="bg-white">';

                while($request = mysqli_fetch_assoc($getElements)){
                  $getRequestServices = "SELECT 
                  s.nombre_servicio,
                  s.costo_base
                  FROM 
                      servicios_solicitudes ss
                  JOIN 
                      servicios s ON ss.id_servicio = s.id_servicio
                  JOIN 
                      solicitudes sol ON ss.id_solicitud = sol.id_solicitud
                  WHERE 
                      sol.id_solicitud = ".$request['id_solicitud']."";
                  
                  $getServices = mysqli_query($conexion, $getRequestServices);
                  
                  $title = "";
                  $cost = 0;
                  while($service = mysqli_fetch_assoc($getServices)){
                    $title .= $service['nombre_servicio'].", ";
                    $cost += $service['costo_base'];
                  }

                  echo'<tr>';
                  echo'
                    <td class="p-4 border border-gray-700">
                      <p
                        class="block text-xs md:text-sm leading-normal"
                      >
                        '.substr($title, 0, -2).'. 
                      </p>
                    </td>
                    <td class="p-4 border border-gray-700">
                      <p
                        class="block text-xs md:text-sm leading-normal "
                      >
                        '.$request['direccion'].'
                      </p>
                    </td>
                    <td class="p-4 border border-gray-700">
                      <p
                        class="block text-xs md:text-sm leading-normal"
                      >
                        $'.$cost.'.00 mxn
                      </p>
                    </td>
                    <td class="p-4 border border-gray-700">
                      <div class="flex flex-row items-center justify-center gap-3">
                        <a
                          href="../php/aceptar_solicitud.php?id='.$request['id_solicitud'].'"
                          class="bg-green-600 text-white max-md:text-sm px-3 md:px-6 py-2 rounded-lg"
                        >
                          Aceptar
                        </a>
                      </div>
                    </td>
                  ';
                  echo'</tr>';
                }

                echo '</tbody>';
              }else if($_SESSION['jornada'] == "iniciada"){
                echo '
                  <div class="bg-gray-100 text-gray-700 text-center py-10 rounded-lg">
                    No hay solicitudes disponibles
                  </div>
                ';
              }else{
                echo '
                  <div class="bg-gray-100 text-gray-700 text-center py-10 rounded-lg">
                    Jornada finalizada
                  </div>
                ';
              }
            ?>
            <!-- <thead class="bg-gray-900 text-white rounded-t-lg">
              <tr>
                <th
                  class="py-2 md:py-3 px-3 md:px-6 text-left border-r border-gray-300 text-base md:text-xl font-normal rounded-tl-lg"
                >
                  Servicio
                </th>
                <th
                  class="py-2 md:py-3 px-3 md:px-6 text-left border-r border-gray-300 text-base md:text-xl font-normal"
                >
                  Domicilio
                </th>
                <th
                  class="py-2 md:py-3 px-3 md:px-6 text-left border-r border-gray-300 text-base md:text-xl font-normal"
                >
                  Costo
                </th>
                <th
                  class="py-2 md:py-3 px-3 md:px-6 text-left border-gray-300 text-base md:text-xl font-normal rounded-tr-lg"
                >
                  Acción
                </th>
              </tr>
            </thead>
            <tbody class="bg-white">
              <tr>
                <td class="p-4 border-r border-gray-700">
                  <p
                    class="block text-xs md:text-sm leading-normal font-semibold"
                  >
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  </p>
                </td>
                <td class="p-4 border-r border-gray-700">
                  <p
                    class="block text-xs md:text-sm leading-normal font-semibold"
                  >
                    Lorem ipsum dolor sit.
                  </p>
                </td>
                <td class="p-4 border-r border-gray-700">
                  <p
                    class="block text-xs md:text-sm leading-normal font-semibold"
                  >
                    $600.00 mxn
                  </p>
                </td>
                <td class="p-4">
                  <div class="flex flex-row items-center justify-center gap-3">
                    <a
                      href=""
                      class="bg-green-600 text-white max-md:text-sm px-3 md:px-6 py-2 rounded-lg"
                    >
                      Aceptar
                    </a>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="p-4 border-r border-gray-700">
                  <p
                    class="block text-xs md:text-sm leading-normal font-semibold"
                  >
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  </p>
                </td>
                <td class="p-4 border-r border-gray-700">
                  <p
                    class="block text-xs md:text-sm leading-normal font-semibold"
                  >
                    Lorem ipsum dolor sit.
                  </p>
                </td>
                <td class="p-4 border-r border-gray-700">
                  <p
                    class="block text-xs md:text-sm leading-normal font-semibold"
                  >
                    $600.00 mxn
                  </p>
                </td>
                <td class="p-4">
                  <div class="flex flex-row items-center justify-center gap-3">
                    <a
                      href=""
                      class="bg-green-600 text-white max-md:text-sm px-3 md:px-6 py-2 rounded-lg"
                    >
                      Aceptar
                    </a>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="p-4 border-r border-gray-700">
                  <p
                    class="block text-xs md:text-sm leading-normal font-semibold"
                  >
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  </p>
                </td>
                <td class="p-4 border-r border-gray-700">
                  <p
                    class="block text-xs md:text-sm leading-normal font-semibold"
                  >
                    Lorem ipsum dolor sit.
                  </p>
                </td>
                <td class="p-4 border-r border-gray-700">
                  <p
                    class="block text-xs md:text-sm leading-normal font-semibold"
                  >
                    $600.00 mxn
                  </p>
                </td>
                <td class="p-4">
                  <div class="flex flex-row items-center justify-center gap-3">
                    <a
                      href=""
                      class="bg-green-600 text-white max-md:text-sm px-3 md:px-6 py-2 rounded-lg"
                    >
                      Aceptar
                    </a>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="p-4 border-r rounded-bl-lg border-gray-700">
                  <p
                    class="block text-xs md:text-sm leading-normal font-semibold"
                  >
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  </p>
                </td>
                <td class="p-4 border-r border-gray-700">
                  <p
                    class="block text-xs md:text-sm leading-normal font-semibold"
                  >
                    Lorem ipsum dolor sit.
                  </p>
                </td>
                <td class="p-4 border-r border-gray-700">
                  <p
                    class="block text-xs md:text-sm leading-normal font-semibold"
                  >
                    $600.00 mxn
                  </p>
                </td>
                <td class="p-4 rounded-br-lg">
                  <div class="flex flex-row items-center justify-center gap-3">
                    <a
                      href=""
                      class="bg-green-600 text-white max-md:text-sm px-3 md:px-6 py-2 rounded-lg"
                    >
                      Aceptar
                    </a>
                  </div>
                </td>
              </tr>
            </tbody> -->
          </table>
        </div>
        <?php
          if($_SESSION['jornada'] == "iniciada"){
            echo '
              <a
                href="./actions/terminar-jornada.php"
                class="py-3 px-14 bg-primary text-gray-100 hover:bg-gray-100 hover:text-primary hover:border-2 hover:border-primary transition-colors rounded-lg text-base font-medium"
                >Finalizar jornada</a
              >
            ';
          }else{
            echo'
              <a
                href="./reportes.php"
                class="py-3 px-14 bg-primary text-gray-100 hover:bg-gray-100 hover:text-primary hover:border-2 hover:border-primary transition-colors rounded-lg text-base font-medium"
                >Ver reporte</a
              >
            ';
          }
        ?>
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
