<?php
  session_start();
  if(isset($_SESSION['usuario'])){

    header('Location: ../');
    exit;
  }
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
              "screen-minus-16": "calc(100vh - 16rem)", // 2rem es aproximadamente igual a 32px
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
      <!-- login -->
      <div class="flex justify-center items-center">
        <div class="bg-gray-200 p-6 rounded-xl mb-16 lg:mb-0">
          <h2 class="mb-6 text-2xl md:text-3xl font-bold">Crear una cuenta</h2>

          <form class="space-y-4 md:space-y-6" action="../php/register.php" method="POST">
            <div class="grid grid-cols-2 gap-x-6">
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

            <div class="grid grid grid-cols-2 gap-x-6">
              <div>
                <label
                  for="correo"
                  class="mb-2 text-sm font-medium text-gray-900"
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
                  for="telefono"
                  class="mb-2 text-sm font-medium text-gray-900"
                  >Telefono</label
                >
                <input
                  type="tel"
                  name="telefono"
                  class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                  placeholder="55 1234 5678"
                  required=""
                />
              </div>
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
            
            <div class="flex justify-center">
              <button
                class="bg-secundary w-4/6 text-center text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
              >
                Crear cuenta
              </button>
            </div>
            <div class="flex justify-center">
              <p class="text-sm font-light text-gray-500">
                ¿Ya tienes una cuenta?
                <a href="./" class="font-medium text-primary-600 hover:underline"
                  >Inicia sesion</a
                >
              </p>
            </div>
          </form>
        </div>
      </div>

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
    </div>
  </body>
</html>
