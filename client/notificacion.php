<?php
  session_start();
  if(!isset($_SESSION['usuario']) || $_SESSION['tipo_cuenta'] != 'user'){
    header('Location: ../');
    exit();
  }

  include 'actions/pagosPendientes.php';
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
              <a href="./index.php">Home</a>
            </li>
            <li class="text-gray-600 md:mr-12 hover:text-secundary">
              <a href="./solicitud.php">Solicitud</a>
            </li>
            <li class="text-secundary md:mr-12 hover:text-secundary">
              <a href="./notificacion.php">Notificaciones</a>
            </li>
            <li class="text-gray-600 md:mr-12 hover:text-secundary">
              <button
                class="rounded-md border-2 border-red-500 px-3 py-1 font-medium text-red-500 transition-colors hover:bg-red-500 hover:text-white"
                onclick="window.location.href='../php/logout.php'"
              >
                Cerrar sesión
              </button>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- contenido -->
    <?php
      if ($porPagar) {
        ?>
        <div class="flex justify-center items-center">
        <div
      class="relative h-screen-minus-64 md:h-screen-minus-68 mt-20"
    >
      <div
        class=" h-auto bg-gray-100 p-6 rounded-xl shadow-lg shadow-gray-300 border-solid border-2"
      >
        <h2 class="text-xl md:text-3xl font-semibold">Servicio Terminado</h2>
        <p class="font-light mt-6">
          Tu servicio de <?php echo $servicio; ?> ubicado en <?php echo $direccion;?> ha sido
          realizado con exito el dia <?php echo $dia; ?>, por el tecnico "<?php echo $nombre_tecnico ?>",
          realiza el pago por la cantidad de <?php echo $costo; ?>.
        </p>
        <div class="mt-10 flex lg:justify-center justify-start">
          <!-- imagen del servicio -->
            <img src=<?php echo $img; ?> alt='Evidencia' class="rounded-xl shadow-lg shadow-gray-300 border-solid border-2 p-10" />
        </div>

        <div class="flex justify-end mt-6">
          <a
            href="./pago.php"
            class="bg-secundary text-white px-4 py-2 rounded-md hover:bg-gray-100 hover:text-secundary transition-colors duration-300"
          >
            Pagar
          </a>
        </div>
      </div>
    </div>
        </div>
    
    <?php
      }
      else {
        ?>
        <div class="flex justify-center items-center h-screen-minus-64 md:h-screen-minus-68">
          <h2 class="text-2xl md:text-4xl font-semibold text-gray-400">Sin notificaciones.</h2>
        </div>

        <?php
      }
    ?>


  </body>
</html>
