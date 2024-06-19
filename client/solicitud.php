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

    <form action="./datosDomicilio.html">
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
                      $500
                    </p>

                    <div class="mt-6 mx-6 flex items-center">
                      <label class="text-gray-500" for="input"
                        >Seleccionar</label
                      >
                      <input class="ml-4 scale-[1.3]" type="checkbox" />
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
                      $500
                    </p>

                    <div class="mt-6 mx-6 flex items-center">
                      <label class="text-gray-500" for="input"
                        >Seleccionar</label
                      >
                      <input class="ml-4 scale-[1.3]" type="checkbox" />
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
                      $500
                    </p>

                    <div class="mt-6 mx-6 flex items-center">
                      <label class="text-gray-500" for="input"
                        >Seleccionar</label
                      >
                      <input class="ml-4 scale-[1.3]" type="checkbox" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- submit -->
          <div class="flex justify-center my-12">
            <button
              class="bg-secundary text-gray-100 px-4 py-2 rounded-md hover:bg-gray-100 hover:text-secundary transition-all duration-300 ease-in-out"
            >
              Continuar
            </button>
          </div>
        </div>
      </div>
    </form>
  </body>
</html>
