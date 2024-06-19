<?php
  session_start();
  if(!isset($_SESSION['usuario']) || $_SESSION['tipo_cuenta'] != 'work'){
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
    <main class="h-screen-minus-64 md:h-screen-minus-68 w-full max-md:mt-8">
      <div
        class="md:h-full w-full flex flex-col md:flex-row items-center md:justify-center md:gap-14 lg:gap-[14%]"
      >
        <!-- Orden de servicio -->
        <section class="flex items-center pb-[12%]">
          <article class="flex flex-col gap-10">
            <h2 class="text-3xl font-semibold">Detalles del servicio</h2>
            <div>
              <h3 class="mb-4 font-medium text-xl">Tipo de servicio.</h3>
              <p class="">Mantenimiento preventivo y lavado de tinacos.</p>
            </div>
            <div>
              <h3 class="mb-4 text-xl font-medium">Domicilio.</h3>
              <p class="">Detalles del domicilio</p>
            </div>
            <div>
              <h3 class="mb-4 text-xl font-medium">Materiales.</h3>
              <ul>
                <li class="">Material 1</li>
                <li class="">Material 2</li>
              </ul>
            </div>
          </article>
        </section>

        <!-- Evidencia de trabajo -->
        <section
          class="h-full flex flex-col items-center justify-center pb-[11%]"
        >
          <!-- Fotos de evidencia -->
          <div
            class="bg-gray-100 w-[22rem] px-6 py-6 lg:px-12 lg:py-8 flex flex-col md:w-[20rem] lg:w-[28rem] items-center rounded-lg gap-5 shadow-lg shadow-gray-300 border-solid border-2 border-gray-300"
          >
            <h2 class="mb-2 text-center text-xl font-bold">Evidencia</h2>
            <div
              class="bg-[#D9D9D9] w-full flex flex-col items-center rounded-lg py-7 gap-3"
              onclick="document.getElementById('file-upload').click();"
            >
              <div class="flex max-h-20">
                <img
                  src="../assets/img/images-upload.svg"
                  class="opacity-65 max-h-14 md:max-h-24"
                  alt="icono de subir imagen"
                />
              </div>
              <label
                for="file-upload"
                class="font-bold text-sm text-[#616060] opacity-65"
                >Haz click para subir una foto</label
              >
              <input type="file" id="file-upload" class="hidden" />
            </div>
            <button
              class="bg-secundary py-3 px-8 rounded-lg font-semibold text-white hover:bg-gray-100 hover:text-secundary transition-colors"
            >
              Finalizar
            </button>
          </div>
        </section>
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
