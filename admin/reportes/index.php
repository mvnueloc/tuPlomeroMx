<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            third: "#F5F5F5",
          },
          height: {
            "screen-minus-16": "calc(100vh - 16rem)",
          },
        },
      },
    };
  </script>
  <script>
    function fetchData(filterType, tableId) {
      fetch(`fetch_data.php?filter=${filterType}&table=${tableId}`)
        .then(response => response.text())
        .then(data => {
          document.getElementById(`${tableId}-content`).innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
    }

    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('select').forEach(select => {
        select.addEventListener('change', function() {
          fetchData(this.value, this.dataset.table);
        });
      });

      // Initial fetch with default filter
      ['costos', 'actividad', 'materiales'].forEach(tableId => {
        fetchData('filtrar', tableId);
      });
    });
  </script>
</head>
<body class="bg-primary">
  <!-- Navbar -->
  <nav class="bg-primary border-b-2 border-white/[.3] h-14 flex items-center justify-center md:justify-between">
    <div class="mx-12 hidden md:block">
      <a class="text-white" href="#">NOMBRE</a>
    </div>
    <div class="md:mx-12">
      <div>
        <a class="text-white hover:text-secundary text-sm px-3 py-2 mx-2 transition-colors duration-300" href="../gestion_plomeros/">Empleados</a>
        <a class="text-white hover:text-secundary text-sm px-3 py-2 mx-2 transition-colors duration-300" href="../almacen/">Almacen</a>
        <a class="text-secundary hover:text-secundary text-sm px-3 py-2 mx-2 transition-colors duration-300" href="../reportes/">Reportes</a>
        <button class="rounded-md border-2 border-red-500 px-3 py-1 font-medium text-red-500 transition-colors hover:bg-red-500 hover:text-white" onclick="window.location.href='../../php/logout.php'">Cerrar sesión</button>
      </div>
    </div>
  </nav>

  <section class="w-full md:bg-cover md:bg-center">
    <div class="w-full md:flex-row justify-between">
      <section class="py-1 bg-blueGray-50 w-full sm:p-10">
        <div class="flex justify-center item-center mb-10">
          <h2 class="text-white font-bold text-4xl">Reportes de la plataforma</h2>
        </div>

        <!-- tabla de costos -->
        <div class="bg-white rounded-2xl p-7 mb-10">
          <div class="flex flex-wrap justify-between items-center">
            <h3 class="text-lg font-bold">Costos</h3>
            <div>
              <select data-table="costos" class="text-sm font-medium outline-none focus:bg-gray-100 placeholder:text-gray-700 bg-white text-gray-900">
                <option selected value="filtrar">Por Defecto</option>
                <option value="semestre">Semestre</option>
                <option value="trimestre">Trimestre</option>
                <option value="mensual">Mensual</option>
                <option value="anual">Anual</option>
              </select>
            </div>
          </div>
          <div class="flex justify-center item-center">
            <div class="w-full px-4 sm:px-6 lg:px-8">
              <div class="mt-8 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div id="costos-content">
                      <!-- Content will be loaded here from fetch_data.php -->
                    </div>
                  </div>
                </div>
              </div> 
            </div>
          </div>
        </div>

        <!-- tabla de Actividad -->
        <div class="bg-white rounded-2xl p-7 mb-10">
          <div class="flex flex-wrap justify-between items-center">
            <h3 class="text-lg font-bold">Actividad</h3>
            <div>
              <select data-table="actividad" class="text-sm font-medium outline-none focus:bg-gray-100 placeholder:text-gray-700 bg-white text-gray-900">
                <option selected value="filtrar">Por Defecto</option>
                <option value="semestre">Semestre</option>
                <option value="trimestre">Trimestre</option>
                <option value="mensual">Mensual</option>
                <option value="anual">Anual</option>
              </select>
            </div>
          </div>
          <div class="flex justify-center item-center">
            <div class="w-full px-4 sm:px-6 lg:px-8">
              <div class="mt-8 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div id="actividad-content">
                      <!-- Content will be loaded here from fetch_data.php -->
                    </div>
                  </div>
                </div>
              </div> 
            </div>
          </div>
        </div>

        <!-- tabla de Materiales -->
        <div class="bg-white rounded-2xl p-7 mb-10">
          <div class="flex flex-wrap justify-between items-center">
            <h3 class="text-lg font-bold">Materiales Utilizados</h3>
            <div>
              <select data-table="materiales" class="text-sm font-medium outline-none focus:bg-gray-100 placeholder:text-gray-700 bg-white text-gray-900">
                <option selected value="filtrar">Por Defecto</option>
                <option value="semestre">Semestre</option>
                <option value="trimestre">Trimestre</option>
                <option value="mensual">Mensual</option>
                <option value="anual">Anual</option>
              </select>
            </div>
          </div>
          <div class="flex justify-center item-center">
            <div class="w-full px-4 sm:px-6 lg:px-8">
              <div class="mt-8 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div id="materiales-content">
                      <!-- Content will be loaded here from fetch_data.php -->
                    </div>
                  </div>
                </div>
              </div> 
            </div>
          </div>
        </div>

      </section>
    </div>
  </section>
</body>
</html>
