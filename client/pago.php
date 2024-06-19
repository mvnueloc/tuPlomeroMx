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
            <li class="text-gray-600 md:mr-12 hover:text-secundary">
              <a href="./solicitud.html">Solicitud</a>
            </li>
            <li class="text-secundary md:mr-12 hover:text-secundary">
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
      class="bg-gray-100 grid grid-cols-1 lg:grid-cols-2 gap-y-14 justify-center items-center h-screen-minus-64 md:h-screen-minus-68"
    >
      <!-- Resumen -->
      <div class="flex flex-col justify-start items-center h-auto mt-6 md:mt-0">
        <h2 class="mb-2 text-2xl md:text-4xl font-bold">Resumen</h2>

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
      <div class="flex justify-center mb-6 md:mb-0">
        <div
          class="w-5/6 md:w-4/6 p-3 bg-gray-100 flex flex-col items-center rounded-lg shadow-lg shadow-gray-300 border-solid border-2 border-gray-300"
        >
          <h3 class="mb-2 text-lg font-bold my-5">Realiza tu pago</h3>
          <div
            class="mt-2 flex flex-col sm:flex-row w-full px-10 justify-between"
          >
            <button
              class="px-5 py-2 mb-5 sm:mb-0 rounded-lg bg-[#F5F5F5] flex items-center justify-center font-bold text-md transition-colors duration-300 hover:bg-secundary hover:text-white"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                x="0px"
                y="0px"
                width="30"
                height="30"
                viewBox="0 0 32 32"
                class="mr-3 fill-current"
              >
                <path
                  d="M 8.90625 5 L 8.71875 5.78125 L 5.03125 22.78125 L 4.75 24 L 9.625 24 L 9.03125 26.78125 L 8.75 28 L 15.71875 28 L 15.875 27.1875 L 16.90625 22.375 L 19.59375 22.375 C 23.355469 22.375 26.660156 19.929688 27.5 16 C 27.941406 13.933594 27.472656 12.183594 26.5 11 C 25.710938 10.039063 24.640625 9.460938 23.53125 9.1875 C 23.316406 8.199219 22.863281 7.359375 22.25 6.71875 C 21.113281 5.535156 19.535156 5 18.0625 5 Z M 10.53125 7 L 18.0625 7 C 19.042969 7 20.125 7.378906 20.8125 8.09375 C 21.5 8.808594 21.902344 9.828125 21.53125 11.5625 C 20.871094 14.65625 18.535156 16.375 15.59375 16.375 L 11.28125 16.375 L 11.125 17.15625 L 10.09375 22 L 7.25 22 Z M 13.0625 8.46875 L 12.875 9.25 L 11.84375 13.875 L 11.5625 15.09375 L 15.09375 15.09375 C 16.871094 15.09375 18.40625 13.800781 18.84375 12.0625 L 18.875 12.0625 C 18.878906 12.042969 18.871094 12.019531 18.875 12 C 19.09375 11.125 18.953125 10.226563 18.46875 9.5625 C 17.972656 8.882813 17.136719 8.46875 16.25 8.46875 Z M 14.65625 10.46875 L 16.25 10.46875 C 16.5625 10.46875 16.726563 10.558594 16.84375 10.71875 C 16.960938 10.878906 17.042969 11.136719 16.9375 11.53125 L 16.9375 11.5625 C 16.75 12.371094 15.792969 13.09375 15.09375 13.09375 L 14.0625 13.09375 Z M 23.59375 11.34375 C 24.121094 11.558594 24.617188 11.851563 24.96875 12.28125 C 25.550781 12.988281 25.871094 13.964844 25.53125 15.5625 C 24.871094 18.65625 22.535156 20.375 19.59375 20.375 L 15.28125 20.375 L 15.125 21.15625 L 14.09375 26 L 11.25 26 L 11.6875 24 L 11.71875 24 L 11.875 23.1875 L 12.90625 18.375 L 15.59375 18.375 C 19.355469 18.375 22.660156 15.929688 23.5 12 C 23.546875 11.773438 23.566406 11.5625 23.59375 11.34375 Z"
                ></path>
              </svg>
              <p>Pay</p>
            </button>
            <button
              class="px-5 py-2 mb-5 sm:mb-0 rounded-lg bg-[#F5F5F5] flex items-center justify-center font-bold rounded-lg text-md transition-colors duration-300 hover:bg-secundary hover:text-white"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                x="0px"
                y="0px"
                width="25"
                height="25"
                viewBox="0 0 50 50"
                class="mr-3 fill-current"
              >
                <path
                  d="M 33.375 0 C 30.539063 0.191406 27.503906 1.878906 25.625 4.15625 C 23.980469 6.160156 22.601563 9.101563 23.125 12.15625 C 22.65625 12.011719 22.230469 11.996094 21.71875 11.8125 C 20.324219 11.316406 18.730469 10.78125 16.75 10.78125 C 12.816406 10.78125 8.789063 13.121094 6.25 17.03125 C 2.554688 22.710938 3.296875 32.707031 8.90625 41.25 C 9.894531 42.75 11.046875 44.386719 12.46875 45.6875 C 13.890625 46.988281 15.609375 47.980469 17.625 48 C 19.347656 48.019531 20.546875 47.445313 21.625 46.96875 C 22.703125 46.492188 23.707031 46.070313 25.59375 46.0625 C 25.605469 46.0625 25.613281 46.0625 25.625 46.0625 C 27.503906 46.046875 28.476563 46.460938 29.53125 46.9375 C 30.585938 47.414063 31.773438 48.015625 33.5 48 C 35.554688 47.984375 37.300781 46.859375 38.75 45.46875 C 40.199219 44.078125 41.390625 42.371094 42.375 40.875 C 43.785156 38.726563 44.351563 37.554688 45.4375 35.15625 C 45.550781 34.90625 45.554688 34.617188 45.445313 34.363281 C 45.339844 34.109375 45.132813 33.910156 44.875 33.8125 C 41.320313 32.46875 39.292969 29.324219 39 26 C 38.707031 22.675781 40.113281 19.253906 43.65625 17.3125 C 43.917969 17.171875 44.101563 16.925781 44.164063 16.636719 C 44.222656 16.347656 44.152344 16.042969 43.96875 15.8125 C 41.425781 12.652344 37.847656 10.78125 34.34375 10.78125 C 32.109375 10.78125 30.46875 11.308594 29.125 11.8125 C 28.902344 11.898438 28.738281 11.890625 28.53125 11.96875 C 29.894531 11.25 31.097656 10.253906 32 9.09375 C 33.640625 6.988281 34.90625 3.992188 34.4375 0.84375 C 34.359375 0.328125 33.894531 -0.0390625 33.375 0 Z M 32.3125 2.375 C 32.246094 4.394531 31.554688 6.371094 30.40625 7.84375 C 29.203125 9.390625 27.179688 10.460938 25.21875 10.78125 C 25.253906 8.839844 26.019531 6.828125 27.1875 5.40625 C 28.414063 3.921875 30.445313 2.851563 32.3125 2.375 Z M 16.75 12.78125 C 18.363281 12.78125 19.65625 13.199219 21.03125 13.6875 C 22.40625 14.175781 23.855469 14.75 25.5625 14.75 C 27.230469 14.75 28.550781 14.171875 29.84375 13.6875 C 31.136719 13.203125 32.425781 12.78125 34.34375 12.78125 C 36.847656 12.78125 39.554688 14.082031 41.6875 16.34375 C 38.273438 18.753906 36.675781 22.511719 37 26.15625 C 37.324219 29.839844 39.542969 33.335938 43.1875 35.15625 C 42.398438 36.875 41.878906 38.011719 40.71875 39.78125 C 39.761719 41.238281 38.625 42.832031 37.375 44.03125 C 36.125 45.230469 34.800781 45.988281 33.46875 46 C 32.183594 46.011719 31.453125 45.628906 30.34375 45.125 C 29.234375 44.621094 27.800781 44.042969 25.59375 44.0625 C 23.390625 44.074219 21.9375 44.628906 20.8125 45.125 C 19.6875 45.621094 18.949219 46.011719 17.65625 46 C 16.289063 45.988281 15.019531 45.324219 13.8125 44.21875 C 12.605469 43.113281 11.515625 41.605469 10.5625 40.15625 C 5.3125 32.15625 4.890625 22.757813 7.90625 18.125 C 10.117188 14.722656 13.628906 12.78125 16.75 12.78125 Z"
                ></path>
              </svg>
              <p>Pay</p>
            </button>
            <button
              class="px-5 py-2 mb-5 sm:mb-0 rounded-lg bg-[#F5F5F5] flex items-center justify-center font-bold rounded-lg text-md transition-colors duration-300 hover:bg-secundary hover:text-white"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                x="0px"
                y="0px"
                width="25"
                height="25"
                viewBox="0 0 50 50"
                class="mr-3 fill-current"
              >
                <path
                  d="M 26 2 C 13.308594 2 3 12.308594 3 25 C 3 37.691406 13.308594 48 26 48 C 35.917969 48 41.972656 43.4375 45.125 37.78125 C 48.277344 32.125 48.675781 25.480469 47.71875 20.9375 L 47.53125 20.15625 L 46.75 20.15625 L 26 20.125 L 25 20.125 L 25 30.53125 L 36.4375 30.53125 C 34.710938 34.53125 31.195313 37.28125 26 37.28125 C 19.210938 37.28125 13.71875 31.789063 13.71875 25 C 13.71875 18.210938 19.210938 12.71875 26 12.71875 C 29.050781 12.71875 31.820313 13.847656 33.96875 15.6875 L 34.6875 16.28125 L 41.53125 9.4375 L 42.25 8.6875 L 41.5 8 C 37.414063 4.277344 31.960938 2 26 2 Z M 26 4 C 31.074219 4 35.652344 5.855469 39.28125 8.84375 L 34.46875 13.65625 C 32.089844 11.878906 29.199219 10.71875 26 10.71875 C 18.128906 10.71875 11.71875 17.128906 11.71875 25 C 11.71875 32.871094 18.128906 39.28125 26 39.28125 C 32.550781 39.28125 37.261719 35.265625 38.9375 29.8125 L 39.34375 28.53125 L 27 28.53125 L 27 22.125 L 45.84375 22.15625 C 46.507813 26.191406 46.066406 31.984375 43.375 36.8125 C 40.515625 41.9375 35.320313 46 26 46 C 14.386719 46 5 36.609375 5 25 C 5 13.390625 14.386719 4 26 4 Z"
                ></path>
              </svg>
              <p>Pay</p>
            </button>
          </div>
          <!-- divicion -->
          <div class="flex justify-center items-center gap-4 w-full my-3 px-10">
            <hr class="px-10 border-solid border-1 border-gray-400 w-full" />
            <p class="text-center text-gray-400">ó</p>
            <hr class="px-10 border-solid border-1 border-gray-400 w-full" />
          </div>
          <!-- datos de pago -->
          <article class="flex flex-col gap-4 w-4/5">
            <div class="">
              <label
                htmlFor="calle"
                class="flex mb-2 text-sm text-start text-gray-900"
                >Nombre del titular</label
              >
              <input
                required
                id="calle"
                type="text"
                name="street"
                class="bg-[#D9D9D9] w-full px-5 py-[0.7rem] text-sm font-medium outline-none focus:bg-gray-100 placeholder:text-gray-700 text-gray-900 rounded-2xl"
              />
            </div>
            <div class="">
              <label
                htmlFor="calle"
                class="flex mb-2 text-sm text-start text-gray-900"
                >Numero de tarjeta</label
              >
              <input
                required
                id="calle"
                type="text"
                name="street"
                class="bg-[#D9D9D9] w-full px-5 py-[0.7rem] text-sm font-medium outline-none focus:bg-gray-100 placeholder:text-gray-700 text-gray-900 rounded-2xl"
              />
            </div>
            <div class="flex flex-row justify-between gap-3">
              <div class="">
                <label
                  htmlFor="fecha_vencimiento"
                  class="flex mb-2 text-sm text-start text-gray-900"
                  >Fecha</label
                >
                <input
                  required
                  id="fecha_vencimiento"
                  type="text"
                  name="fecha_vencimiento"
                  placeholder="MM/YY"
                  maxlength="5"
                  class="bg-[#D9D9D9] w-full px-5 py-[0.7rem] text-sm font-medium outline-none focus:bg-gray-100 placeholder:text-gray-700 text-gray-900 rounded-2xl"
                />
              </div>
              <div class="">
                <label
                  htmlFor="contrasena"
                  class="flex mb-2 text-sm text-start text-gray-900"
                  >CVV</label
                >
                <input
                  required
                  id="contrasena"
                  type="text"
                  name="contrasena"
                  maxlength="3"
                  class="bg-[#D9D9D9] w-full px-5 py-[0.7rem] text-sm font-medium outline-none focus:bg-gray-100 placeholder:text-gray-700 text-gray-900 rounded-2xl"
                />
              </div>
            </div>
            <div class="py-[1rem] flex justify-center">
              <a
                href="./pagoExitoso.html"
                class="text-center px-2.5 py-2.5 w-full max-md:mr-5 self-end text-white font-bold bg-secundary hover:bg-gray-100 hover:text-secundary rounded-xl text-md transition-colors duration-300"
              >
                Pagar
              </a>
            </div>
          </article>
        </div>
      </div>
    </div>
  </body>
</html>
