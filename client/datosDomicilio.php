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
      class="grid grid-cols-1 lg:grid-cols-2 gap-y-14 justify-center items-center h-screen-minus-64 md:h-screen-minus-68"
    >
      <!-- Resumen -->
      <div class="flex flex-col justify-start items-center h-auto">
        <h2 class="mb-2 text-2xl md:text-4xl font-bold mt-6 lg:mt-0">
          Resumen
        </h2>

        <!-- Servicio -->
        <div class="mt-6 mb-3">
          <div class="flex space-x-16">
            <h3 class="text-xl font-light">Servicio</h3>
            <p class="text-xl font-semibold">$500</p>
          </div>
        </div>
        <!-- Impuestos -->
        <div class="mb-3">
          <div class="flex space-x-16">
            <h3 class="text-xl font-light">Impuestos</h3>
            <p class="text-xl font-semibold">$200</p>
          </div>
        </div>
        <!-- Transporte -->
        <div class="mb-3">
          <div class="flex space-x-16">
            <h3 class="text-xl font-light">Transporte</h3>
            <p class="text-xl font-semibold">$100</p>
          </div>
        </div>
        <!-- Total -->
        <div class="">
          <div class="flex space-x-16">
            <h3 class="text-xl font-semibold">Total</h3>
            <p class="text-xl font-semibold">$800</p>
          </div>
        </div>
      </div>
      <!-- Datos -->
      <div class="flex justify-center items-center lg:mr-16">
        <div
          class="w-5/6 bg-gray-100 p-6 rounded-xl lg:mb-0 shadow-lg shadow-gray-300 border-solid border-2 border-gray-300"
        >
          <h2 class="mb-6 text-2xl md:text-3xl font-bold">Datos</h2>

          <form
            class="space-y-2 md:space-y-4"
            action="./ordenValidada.html"
            method="POST"
          >
            <div class="grid grid-cols-2 gap-x-2 md:gap-x-6">
              <!-- Nombre -->
              <div>
                <label
                  for="nombre"
                  class="mb-2 text-sm font-medium text-gray-900"
                  >Nombres</label
                >
                <input
                  type="text"
                  name="nombres"
                  class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                  placeholder="Nombre"
                  required=""
                />
              </div>
              <!-- Apellidos -->
              <div>
                <label
                  for="apellido"
                  class="mb-2 text-sm font-medium text-gray-900"
                  >Apellidos</label
                >
                <input
                  type="text"
                  name="apellidos"
                  class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                  placeholder="Apellido"
                  required=""
                />
              </div>
            </div>
            <!-- Docmicilio -->
            <div>
              <label
                for="domicilio"
                class="mb-2 text-sm font-medium text-gray-900"
                >Domicilio</label
              >
              <input
                type="text"
                name="domicilio"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                placeholder="Domicilio"
                required=""
              />
            </div>
            <!-- Codigo Postal -->
            <div class="grid grid-cols-3 gap-x-2 md:gap-x-6">
              <div>
                <label
                  for="codigoPostal"
                  class="mb-2 text-sm font-medium text-gray-900"
                  >C.P</label
                >
                <input
                  type="text"
                  name="codigoPostal"
                  class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                  placeholder="Codigo Postal"
                  required=""
                />
              </div>
              <!-- Fecha -->
              <div>
                <label
                  for="fecha"
                  class="mb-2 text-sm font-medium text-gray-900"
                  >Fecha</label
                >
                <input
                  type="date"
                  name="fecha"
                  min="2024-10-06"
                  max="2030-12-31"
                  class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                  required=""
                />
              </div>
              <!-- Hora -->
              <div>
                <label for="hora" class="mb-2 text-sm font-medium text-gray-900"
                  >Hora</label
                >
                <input
                  type="time"
                  name="hora"
                  min="7:00"
                  max="19:00"
                  class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                  required=""
                />
              </div>
            </div>

            <div class="flex justify-center">
              <button
                class="bg-secundary w-4/6 text-center text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-gray-100 hover:text-secundary transition-colors duration-300 ease-in-out mt-6"
              >
                Solicitar servicio
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
