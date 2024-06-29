<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(dirname(__DIR__) . '/php/conexion_bd.php');

session_start();

if (!isset($_SESSION['usuario'])) {
  session_destroy();
  header('Location: ../');
  exit();
} else if ($_SESSION['tipo_cuenta'] != 'work') {
  header('Location: ../');
  exit();
}

if (!isset($_SESSION['jornada'])) {
  header('Location: ./');
  exit();
}

if ($_SESSION['servicio'] != "onService") {
  header('Location: ./');
  exit();
}

$query = "SELECT trabajo.*, solicitudes.*, servicios.* 
  FROM trabajo 
  INNER JOIN solicitudes ON trabajo.id_solicitud = solicitudes.id_solicitud 
  INNER JOIN servicios ON solicitudes.id_servicio = servicios.id_servicio 
  WHERE trabajo.id_trabajador = " . $_SESSION['id'] . " AND trabajo.status = 0";

$result = mysqli_query($conexion, $query);
$detalle = mysqli_fetch_array($result);



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>tuPlomeroMx</title>
  <link rel="icon" href="../assets/img/icon.svg">
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
    <div class="relative flex flex-col px-6 py-4 md:mx-auto md:flex-row md:items-center">
      <a href="#" class="flex items-center whitespace-nowrap text-2xl font-black">
        tuPlomeroMx
      </a>
      <input type="checkbox" class="peer hidden" id="navbar-open" />
      <label class="absolute top-5 right-7 cursor-pointer md:hidden" for="navbar-open">
        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14" />
        </svg>
      </label>
      <div aria-label="Header Navigation" class="peer-checked:mt-8 peer-checked:max-h-56 flex max-h-0 w-full flex-col items-center justify-between overflow-hidden transition-all md:ml-24 md:max-h-full md:flex-row md:items-start">
        <ul class="flex flex-col items-center space-y-2 md:ml-auto md:flex-row md:space-y-0">
          <li class="text-secundary md:mr-12 hover:text-secundary">
            <a href="">Solicitud</a>
          </li>
          <li class="text-gray-600 md:mr-12 hover:text-secundary">
            <a href="./reportes.php">Reportes</a>
          </li>
          <li class="text-gray-600 hover:text-secundary">
            <button class="rounded-md border-2 border-primary px-6 py-1 font-medium text-primary transition-colors hover:bg-primary hover:text-white" onclick="window.location.href = '../php/logout.php'">
              Cerrar Sesión
            </button>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <main class="min-h-screen-minus-3-5 md:h-screen-minus-68 w-full max-md:mt-8">
    <div class="md:h-full w-full flex flex-col md:flex-row items-center md:justify-center md:gap-14 lg:gap-[14%]">
      <!-- Orden de servicio -->
      <section class="flex items-center pb-[12%]">
        <article class="flex flex-col gap-10">
          <h2 class="text-3xl font-semibold">Detalles del servicio</h2>
          <div>
            <h3 class="mb-4 font-medium text-xl">Tipo de servicio.</h3>
            <p class="">
              <?php echo $detalle['nombre_servicio']; ?>
            </p>
          </div>
          <div>
            <h3 class="mb-4 text-xl font-medium">Domicilio.</h3>
            <p class="max-w-md break-words">
              <?php echo $detalle['direccion']  ?>
            </p>
            <p>
              Código Postal: 
              <?php 
                echo   $detalle['codigo_postal'];
              ?>
            </p>
          </div>
          <div>
            <h3 class="mb-4 text-xl font-medium">Materiales.</h3>
            <ul>
              <?php
              if($detalle['id_servicio'] == 1){
              ?>
                <li class="mb-2">Filtro de tinaco</li>
                <li class="mb-2">Litro de solución sanitizante antibacterial</li>
                <li class="mb-2">Cepillo con extensor</li>
              <?php
              }else if($detalle['id_servicio'] == 2){
              ?>
                <li class="mb-2">Metros de tubo de cobre de 1/2 pulgada</li>
                <li class="mb-2">Codos de 1/2 pulgada</li>
                <li class="mb-2">Metros de soldadura</li>
                <li class="mb-2">Tubo de gas butano</li>
              <?php
              }else{
              ?>
                <li class="mb-2">Kit de mangueras de agua caliente</li>
                <li class="mb-2">Rollo de cintra teflón</li>
                <li class="mb-2">Valvulas de presión inversa de 1/2 pulgada</li>
              <?php
              }?>
            </ul>
          </div>
        </article>
      </section>

      <!-- Evidencia de trabajo -->
      <section class="h-full flex flex-col items-center justify-center pb-[11%]">
        <!-- Fotos de evidencia -->
        <form class="bg-gray-100 w-[22rem] px-6 py-6 lg:px-12 lg:py-8 flex flex-col md:w-[20rem] lg:w-[28rem] items-center rounded-lg gap-5 shadow-lg shadow-gray-300 border-solid border-2 border-gray-300" action="./actions/finalizar-trabajo.php?id_trabajo=<?php echo $detalle['id_trabajo']; ?>&monto=<?php echo $detalle['costo_base']; ?>" method="POST" enctype="multipart/form-data">
          <h2 class="mb-2 text-center text-xl font-bold">Evidencia</h2>
          <div class="bg-[#D9D9D9] w-full flex flex-col items-center rounded-lg py-7 gap-3" onclick="document.getElementById('file-upload').click();">
            <div class="flex max-h-20" id="upload-icon">
              <img src="../assets/img/images-upload.svg" class="opacity-65 max-h-14 md:max-h-24" alt="icono de subir imagen" />
            </div>
            <label for="file-upload" class="font-bold text-sm text-[#616060] opacity-65" id="upload-label">Haz click para subir una foto</label>
            <label for="file-upload" class="hidden font-bold text-sm text-[#616060] opacity-65" id="upload-label-second">Imagen lista para subir</label>
            <input type="file" id="file-upload" name="file-upload" class="hidden" accept="image/png, image/jpeg" required />
          </div>
          <button class="py-2.5 px-14 bg-primary text-gray-100 hover:bg-gray-100 hover:text-primary hover:border hover:border-primary rounded-lg text-base font-medium transition-colors">Finalizar</button>

          <script>
            document.getElementById('file-upload').addEventListener('change', function() {
              if (this.files.length > 0) {
                document.getElementById('upload-icon').innerHTML = '<img src="../assets/img/checked-icon.svg" class="max-h-14 md:max-h-24" alt="icono de archivo seleccionado" />';
                document.getElementById('upload-label').style.display = 'none';
                document.getElementById('upload-label-second').style.display = 'block';
              }
            });
          </script>
        </form>
      </section>
    </div>
  </main>
  <!-- footer -->
  <footer class="bg-white border-t-2 border-gray-100">
    <div class="relative mx-auto max-w-screen-xl px-4 py-14 sm:px-6 lg:px-8">
      <div class="lg:flex lg:items-end lg:justify-between">
        <div>
          <div class="flex justify-center text-teal-600 lg:justify-start">
            <p class="font-bold text-2xl">tuPlomeroMx</p>
          </div>
          <p class="mx-auto mt-6 max-w-md text-center leading-relaxed text-gray-500 lg:text-left">
            Soluciones eficientes y confiables para todas tus necesidades de
            plomería.
          </p>
        </div>

        <ul class="mt-12 flex flex-wrap justify-center gap-6 md:gap-8 lg:mt-0 lg:justify-end lg:gap-12">
          <li>
            <a class="text-gray-700 transition hover:text-gray-700/75" href="#">
              Nosotros
            </a>
          </li>
          <li>
            <a class="text-gray-700 transition hover:text-gray-700/75" href="#">
              Políticas de Privacidad
            </a>
          </li>
          <li>
            <a class="text-gray-700 transition hover:text-gray-700/75" href="#">
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