<?php
  include 'actions/noDeudas.php';
  include 'actions/preciosServicios.php';
  include 'actions/solicitudesPendientes.php';
  include 'actions/trabajosPendientes.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>tuPlomeroMx</title>
    <link rel="icon" href="../assets/img/icon.svg">
    <!-- <link rel="stylesheet" href="./css/style.css" /> -->
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
        class="relative flex flex-col px-6 py-4 md:mx-auto md:flex-row md:items-center"
      >
        <a
          href="#"
          class="flex items-center whitespace-nowrap text-2xl font-black"
        >
          tuPlomeroMx
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
              <a href="./index.php">Inicio</a>
            </li>
            <li class="text-secundary md:mr-12 hover:text-secundary">
              <a href="./solicitud.php">Solicitud</a>
            </li>
            <li class="text-gray-600 md:mr-10 hover:text-secundary">
              <a href="./notificacion.php">Notificaciones</a>
            </li>
            <li class="text-gray-600  hover:text-secundary">
              <button
                onclick="window.location.href='../php/logout.php'"
                class="rounded-md border-2 border-primary px-6 py-1 font-medium text-primary transition-colors hover:bg-primary hover:text-white"
              >
                Cerrar Sesión
              </button>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <form action="./datosDomicilio.php" method="POST">
      <div
        class="lg:h-screen-minus-68 mt-12 lg:mt-0 flex justify-center items-center"
      >
        <div>
          <div class="flex justify-center">
            <!-- Cards -->
            <div class="grid lg:grid-cols-3 gap-6">
              <!-- card 1 -->
              <div class="flex justify-center">
                <div
                  class="bg-gray-100 h-auto w-5/6 rounded-xl shadow-lg shadow-gray-300 p-3 border-solid border-2 border-gray-300"
                >
                  <img
                    class="h-52 w-full rounded-xl"
                    src="../assets/img/servicio1.jpeg"
                    alt="Persona lavando un tinaco"
                  />
                  <h2 class="font-semibold text-2xl mt-4 mx-4">Tinacos</h2>
                  <p class="font-light mt-2 mx-4">
                    Mantenimiento preventivo y lavado
                  </p>
                  <div class="flex items-center justify-between">
                    <p
                      class="font-extrabold text-xl mt-6 mx-4 bg-green-600 px-2 py-1 rounded-md text-white"
                    >
                    <?php echo  '$' . $precioTinaco['costo_base']; ?>
                    </p>

                    <div class="mt-6 mx-6 flex items-center">
                      <label class="text-gray-500" for="input"
                        >Seleccionar</label
                      >
                      <input class="ml-4 scale-[1.8]" type="radio" value = "1" name = "servicio" />
                    </div>
                  </div>
                </div>
              </div>
              <!-- card 2 -->
              <div class="flex justify-center">
                <div
                  class="bg-gray-100 h-auto w-5/6 rounded-xl shadow-lg shadow-gray-300 p-3 border-solid border-2 border-gray-300"
                >
                  <img
                    class="h-52 w-full rounded-xl"
                    src="../assets/img/servicio2.jpeg"
                    alt="Persona lavando un tinaco"
                  />
                  <h2 class="font-semibold text-2xl mt-4 mx-4">Fugas</h2>
                  <p class="font-light mt-2 mx-4">Reparación de fuga de agua</p>
                  <div class="flex items-center justify-between">
                    <p
                      class="font-extrabold text-xl mt-6 mx-4 bg-green-600 px-2 py-1 rounded-md text-white"
                    >
                      <?php echo  '$' . $precioFuga['costo_base']; ?>
                    </p>

                    <div class="mt-6 mx-6 flex items-center">
                      <label class="text-gray-500" for="input"
                        >Seleccionar</label
                      >
                      <input class="ml-4 scale-[1.8]" type="radio" value = "2" name = "servicio" />
                    </div>
                  </div>
                </div>
              </div>
              <!-- card 3 -->
              <div class="flex justify-center">
                <div
                  class="bg-gray-100 h-auto w-5/6 rounded-xl shadow-lg shadow-gray-300 p-3 border-solid border-2 border-gray-300"
                >
                  <img
                    class="h-52 w-full rounded-xl"
                    src="../assets/img/servicio3.jpeg"
                    alt="Persona lavando un tinaco"
                  />
                  <h2 class="font-semibold text-2xl mt-4 mx-4">Calentador</h2>
                  <p class="font-light mt-2 mx-4">
                    Instalación de calentador de agua
                  </p>
                  <div class="flex items-center justify-between">
                    <p
                      class="font-extrabold text-xl mt-6 mx-4 bg-green-600 px-2 py-1 rounded-md text-white"
                    >
                    <?php echo  '$' . $precioCalentador['costo_base']; ?>
                    </p>

                    <div class="mt-6 mx-6 flex items-center">
                      <label class="text-gray-500" for="input"
                        >Seleccionar</label
                      >
                      <input class="ml-4 scale-[1.8]" type="radio" value = "3" name = "servicio" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- submit -->
          <div class="flex justify-center my-12">
            <button
              class="py-2.5 px-14 bg-primary text-white hover:bg-gray-700 hover:text-white transition-colors rounded-lg text-base font-medium"
            >
              Continuar
            </button>
          </div>
        </div>
      </div>
    </form>
  </body>
</html>
