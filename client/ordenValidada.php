<?php
  session_start();
  if(!isset($_SESSION['usuario']) || $_SESSION['tipo_cuenta'] != 'user'){
    header('Location: ../');
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>tuPlomeroMx</title>
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
              >
                Logout
              </button>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- contenido -->
    <div
      class="flex justify-center items-center h-screen-minus-64 md:h-screen-minus-68"
    >
      <div
        class="w-80 h-auto md:w-96 md:h-auto bg-gray-100 p-12 rounded-xl shadow-lg shadow-gray-300 border-solid border-2 border-gray-300"
      >
        <div class="flex justify-center">
          <div
            class="w-24 h-24 bg-green-600 flex justify-center items-center rounded-full"
          >
            <svg
              class="w-20 h-20 text-gray-800 dark:text-white"
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
                stroke-linejoin="round"
                stroke-width="2"
                d="M5 11.917 9.724 16.5 19 7.5"
              />
            </svg>
          </div>
        </div>

        <h2 class="text-center mt-6 text-2xl font-semibold text-green-600">
          Orden validada
        </h2>

        <p class="text-center text-lg font-light mt-6">
          Gracias por realizar tu orden, en unos minutos tu tecnico llegara a tu
          casa, este antento a las notificaciones.
        </p>

        <div class="flex justify-center mt-6">
          <a
            href="./landing.html"
            class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition-all duration-300"
          >
            Continuar
          </a>
        </div>
      </div>
    </div>
  </body>
</html>
