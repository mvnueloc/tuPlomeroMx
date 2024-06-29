<?php
include 'actions/historialJornada.php';

// session_start();
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

if ($_SESSION['servicio'] == "onService") {
  header('Location: ./reportes-restriccion.php');
  exit();
} else if ($_SESSION['jornada'] == "iniciada") {
  header('Location: ./terminar-jornada.php');
  exit();
}
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
            "screen-minus-3.5": "calc(100vh - 3.5rem)",
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
          <li class="text-gray-600 md:mr-12 hover:text-secundary">
            <a href="./jornada.php">Solicitud</a>
          </li>
          <li class="text-secundary md:mr-12 hover:text-secundary">
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
  <main class="min-h-screen-minus-3-5 w-full">
    <div class="w-full py-10 flex flex-col items-center justify-center gap-10">
      <div class="flex flex-row gap-3 w-full md:w-2/3">
        <h2 class="max-md:px-6 text-2xl font-bold">
          Día: <?php
          function fechaEspanol($fecha)
          {
           $format = 'Y-m-d H:i:s';
           $d = DateTime::createFromFormat($format, $fecha);
           $anio = $d->format('Y');
           $mes = $d->format('n');
           $dia = $d->format('d');
           $diasemana = $d->format('w');
          
           $diassemanaN = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
           $mesesN = array(1 => "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
           return "{$diassemanaN[$diasemana]}, $dia de {$mesesN[$mes]} de $anio";
          }  

          echo fechaEspanol(date('Y-m-d H:i:s'));
          
          ?>
        </h2>
      </div>
      <div class="w-full flex flex-col md:flex-row md:justify-center gap-14 lg:gap-[10%]">
        <div class="flex flex-col max-lg:px-4 gap-6 justify-center">
          <!-- <h3 class="text-2xl font-semibold">Servicios Realizados</h3> -->
          <div class="shadow-lg shadow-gray-300 bg-white p-4 rounded-xl">
            <table class="md:max-w-[25rem] table-auto text-left w-full">
              <?php if (!empty($serviciosRealizados)) { ?>
                <caption class="font-bold text-lg">Servicios Realizados</caption>
                <thead>
                  <tr>
                    <th class="px-3">No.</th>
                    <th>Nombre</th>
                    <th class="px-2">costo</th>
                  </tr>
                </thead>
                <?php 
                $numero = 1;
                foreach ($serviciosRealizados as $contenido) { 
                  ?>
                  <tbody>
                    <tr>
                      <td class="text-center px-3"><?php echo 
                        $numero++;
                      ?></td>
                      <td class="" style="word-wrap: break-word;"><?php echo $contenido['nombre_servicio']; ?></td>
                      <td class="text-center px-2" style="white-space: nowrap;">$<?php echo $contenido['costo_base']; ?>.00 mxn</td>
                    </tr>
                  </tbody>
                <?php } ?>
              <?php } else { ?>
                <p>No se han realizado servicios.</p>
              <?php } ?>
            </table>
          </div>
        </div>
        <div class="flex flex-col max-lg:px-4 gap-6 justify-center">
          <div class="shadow-lg bg-white p-4 rounded-xl">
            <table class="md:max-w-96 table-auto text-left w-full">
              <?php if (!empty($serviciosRealizados)) { ?>
                <caption class="font-bold text-lg">Materiales utilizados</caption>
                <thead>
                  <tr>
                    <th>Material</th>
                    <th class="text-center md:px-2">Cantidad</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                foreach ($materiales as $clave => $valor) { 
                  if($valor != 0){
                  ?>
                  
                  <tr>
                      <td><?php echo $clave; ?></td>
                      <td class="text-center"><?php echo $valor; ?></td>
                  </tr> 
                  
                <?php 
                  }
                } ?>
                </tbody>
              <?php } else { ?>
                <p>No hay informacion de materiales.</p>
              <?php } ?>
            </table>
          </div>
        </div>
      </div>
      <div class="flex flex-row gap-[7%] w-full justify-center">
        <a href="" class="w-48 text-center py-3 px-14 bg-white text-secundary rounded-lg text-base font-medium">Descargar comprobante</a>
        <a href="" class="w-48 text-center py-3 px-14 bg-secundary text-white text-secundary rounded-lg text-base font-medium">Descargar vale</a>
      </div>
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