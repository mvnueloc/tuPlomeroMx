<?php
  session_start();
  
  if(isset($_SESSION['usuario'])){
    header('Location: ../');
    exit;
  }

  session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>tuPlomeroMx</title>
    <link rel="stylesheet" href="./css/style.css" />
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
              primary: "#0077C2",
              secundary: "#00619A",
            },
            height: {
              "screen-minus-16": "calc(100vh - 16rem)",
            },
          },
        },
      };
    </script>
  </head>
  <body class="bg-primary h-screen">
    <!-- title -->
    <div class="h-64 flex justify-center items-center flex-col space-y-4">
      <h2 class="text-white text-5xl font-bold">Tu plomero Mx</h2>
      <h1 class="text-white text-lg">Servicio de plomeria y fontaneria</h1>
    </div>

    <!-- contenido -->
    <div
      class="grid grid-cols-1 lg:grid-cols-2 gap-y-14 justify-center items-center h-screen-minus-16"
    >
      <!-- figura y landing page -->
      <div class="flex flex-col justify-center items-center space-y-16">
        <h2 class="mb-6 text-2xl md:text-3xl font-bold text-white">
          Bienvenido/a
        </h2>
        <img
          class="w-80"
          src="../assets/img/login.svg"
          alt="persona sosteniendo un celular"
        />
      </div>

      <!-- login -->
      <div class="flex justify-center items-center">
        <div class="bg-gray-200 p-12 rounded-xl mb-16 lg:mb-0">
          <h2 class="mb-6 text-2xl md:text-3xl font-bold">Iniciar sesion</h2>

          <form class="space-y-4 md:space-y-6" action="../php/login.php" method="POST">
            <div>
              <label for="correo" class="mb-2 text-sm font-medium text-gray-900"
                >Correo</label
              >
              <input
                type="email"
                name="correo"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                placeholder="nombre@ejemplo.com"
                required=""
              />
            </div>
            <div>
              <label
                for="contraseña"
                class="mb-2 text-sm font-medium text-gray-900"
                >Contraseña</label
              >
              <input
                type="password"
                name="contrasena"
                placeholder="••••••••"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                required=""
              />
            </div>
            <div class="flex items-center justify-between space-x-8">
              <div class="flex items-start">
                <div class="flex items-center h-5">
                  <input
                    id="recordar"
                    aria-describedby="recordar"
                    type="checkbox"
                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300"
                  />
                </div>
                <div class="ml-3 text-sm">
                  <label for="remember" class="text-gray-500">Recordar</label>
                </div>
              </div>
              <a
                href="#"
                class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500"
                >¿Olvidaste tu contraseña?</a
              >
            </div>
            <div class="flex justify-center">
              <button
                class="bg-secundary w-4/6 text-center text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
              >
                Iniciar sesion
              </button>
            </div>
            <div class="flex justify-center">
              <p class="text-sm font-light text-gray-500">
                ¿No tienes una cuenta?
                <a href="./register.php" class="font-medium text-primary-600 hover:underline"
                  >Crea una cuenta</a
                >
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
