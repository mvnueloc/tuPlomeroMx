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
            third:"#F5F5F5",
          },
          height: {
            "screen-minus-16": "calc(100vh - 16rem)", // 2rem es aproximadamente igual a 32px
          },
        },
      },
    };
  </script>
  <script>
    // Datos de ejemplo
    const productos = [
  {
    "id": "001",
    "nombre": "Llave de paso",
    "modelo": "LP-100",
    "marca": "Plomex",
    "medicionesProducto": "Diámetro: 5 cm",
    "stock": "25"
  },
  {
    "id": "002",
    "nombre": "Tubería de PVC",
    "modelo": "PVC-200",
    "marca": "AquaPipe",
    "medicionesProducto": "Longitud: 2 metros",
    "stock": "50"
  },
  {
    "id": "003",
    "nombre": "Fregadero de Acero Inoxidable",
    "modelo": "FS-300",
    "marca": "Stainless",
    "medicionesProducto": "Ancho: 60 cm, Alto: 40 cm, Profundo: 20 cm",
    "stock": "10"
  },
  {
    "id": "004",
    "nombre": "Válvula de Retención",
    "modelo": "VR-150",
    "marca": "FlowMaster",
    "medicionesProducto": "Diámetro: 8 cm",
    "stock": "30"
  },
  {
    "id": "005",
    "nombre": "Codo de PVC",
    "modelo": "PVC-90",
    "marca": "AquaPipe",
    "medicionesProducto": "Diámetro: 10 cm, Ángulo: 90°",
    "stock": "20"
  },
  {
    "id": "006",
    "nombre": "Grifo de Baño",
    "modelo": "GB-500",
    "marca": "HydroFix",
    "medicionesProducto": "Largo: 20 cm",
    "stock": "15"
  },
  {
    "id": "007",
    "nombre": "Tuerca Hexagonal",
    "modelo": "TH-10",
    "marca": "BoltPro",
    "medicionesProducto": "Diámetro: 6 cm",
    "stock": "40"
  },
  {
    "id": "008",
    "nombre": "Abrazadera de Metal",
    "modelo": "AM-25",
    "marca": "ClampTech",
    "medicionesProducto": "Ancho: 5 cm, Largo: 10 cm",
    "stock": "12"
  },
  {
    "id": "009",
    "nombre": "Cinta de Teflón",
    "modelo": "CT-5",
    "marca": "SealTape",
    "medicionesProducto": "Longitud: 10 metros",
    "stock": "100"
  },
  {
    "id": "010",
    "nombre": "Lámina de Cobre",
    "modelo": "LC-20",
    "marca": "CopperCo",
    "medicionesProducto": "Ancho: 30 cm, Largo: 50 cm",
    "stock": "8"
  },
  {
    "id": "011",
    "nombre": "Regadera de Baño",
    "modelo": "RB-300",
    "marca": "RainMaker",
    "medicionesProducto": "Capacidad: 10 litros",
    "stock": "5"
  },
  {
    "id": "012",
    "nombre": "Codo de Hierro Galvanizado",
    "modelo": "HG-45",
    "marca": "IronCraft",
    "medicionesProducto": "Diámetro: 15 cm, Ángulo: 45°",
    "stock": "18"
  },
  {
    "id": "013",
    "nombre": "Adhesivo para PVC",
    "modelo": "AP-10",
    "marca": "BondPVC",
    "medicionesProducto": "Volumen: 100 ml",
    "stock": "200"
  },
  {
    "id": "014",
    "nombre": "Juego de Llaves Allen",
    "modelo": "JA-15",
    "marca": "HexSet",
    "medicionesProducto": "Cantidad: 15 piezas",
    "stock": "35"
  },
  {
    "id": "015",
    "nombre": "Tubo de Acero Galvanizado",
    "modelo": "TAG-40",
    "marca": "SteelPipe",
    "medicionesProducto": "Diámetro: 20 cm, Longitud: 1 metro",
    "stock": "22"
  },
  {
    "id": "016",
    "nombre": "Tapa para Registro",
    "modelo": "TR-200",
    "marca": "CoverTech",
    "medicionesProducto": "Diámetro: 30 cm",
    "stock": "7"
  },
  {
    "id": "017",
    "nombre": "Brida de Acero Inoxidable",
    "modelo": "BAI-25",
    "marca": "Stainless",
    "medicionesProducto": "Diámetro: 25 cm",
    "stock": "28"
  },
  {
    "id": "018",
    "nombre": "Resorte de Compresión",
    "modelo": "RC-30",
    "marca": "SpringTech",
    "medicionesProducto": "Longitud: 15 cm, Diámetro: 5 cm",
    "stock": "50"
  },
  {
    "id": "019",
    "nombre": "Destornillador Phillips",
    "modelo": "DP-3",
    "marca": "ScrewPro",
    "medicionesProducto": "Longitud: 20 cm",
    "stock": "40"
  },
  ];


    // Constantes para la paginación
    const productosPorPagina = 20;
    let paginaActual = 1;

    // Función para generar filas de la tabla
    function generarFilasProductos(productos) {
      const inicio = (paginaActual - 1) * productosPorPagina;
      const fin = inicio + productosPorPagina;
      const productosPagina = productos.slice(inicio, fin);

      return productosPagina.map(producto => `
        <tr>
          <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 ">
            ${producto.id}
          </td>
          <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 ">
            <button class="hover:text-primary">
            ${producto.nombre}
            </button>
          </td>
          <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            ${producto.modelo}
          </td>
          <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            ${producto.marca}
          </td>
          <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            ${producto.unidadDeMedida}
          </td>
          <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            ${producto.stock}
          </td>
        </tr>
      `).join('');
    }

    // Función para actualizar la tabla con los productos de la página actual
    function actualizarTabla() {
      // Obtén el elemento tbody de la tabla
      const tbody = document.querySelector('tbody');
      
      // Genera las filas de la tabla y agrégalas al tbody
      tbody.innerHTML = generarFilasProductos(productos);
    }

    // Cargar las filas de la tabla cuando el DOM esté listo
    document.addEventListener('DOMContentLoaded', function () {
      actualizarTabla();
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const sidebar = document.getElementById('sidebar');
      const sidebarToggle = document.getElementById('sidebar-toggle');

      sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('hidden');
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
            <a class="text-white hover:text-secundary text-sm px-3 py-2 mx-2 transition-colors duration-300" href="../gestion_plomeros/registro_plomeros.php">Empleados</a>
            <a class="text-secundary hover:text-secundary text-sm px-3 py-2 mx-2 transition-colors duration-300" href="../almacen/almacen.php">Almacen</a>
            <a class="text-white hover:text-secundary text-sm px-3 py-2 mx-2 transition-colors duration-300" href="../reportes/reportes.php">Reportes</a>
        </div>
    </div>
  </nav>


  <section class="w-full">
    <div class="w-full md:flex-row justify-between">
      <section class="py-1 bg-blueGray-50 w-full sm:p-10 ">
        <div class="flex justify-center item-center mb-7">
          <h2 class=" font-bold text-4xl text-white">Almacen</h2>
        </div>
        <div class="w-full pb-6 pt-2 bg-white xl:mb-0 sm:px-4 mx-auto rounded-lg">
          <div class="relative flex flex-col min-w-0 break-words  w-full ">
            
            <div class="rounded-t mb-0 px-4 py-3 border-0">
              <div class="flex flex-wrap items-center">
                <div x-data="{ dropdownOpen: true }" class="w-full px-4 max-w-full flex flex-wrap sm:flex-row justify-between">
                  <!-- Título -->
                  <div class="flex items-center text-left sm:text-center">
                    <h3 class="font-semibold text-base">Productos de Refacciones</h3>
                  </div>
                  <!-- Barra de búsqueda -->
                  <div class="w-full sm:w-auto mt-4 sm:mt-0 flex items-center justify-center">
                    <div class="relative">
                      <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                          width="15px" height="15px" viewBox="0 0 612.08 612.08" style="enable-background:new 0 0 612.08 612.08;"
                          xml:space="preserve">
                          <path d="M237.927,0C106.555,0,0.035,106.52,0.035,237.893c0,131.373,106.52,237.893,237.893,237.893
                            c50.518,0,97.368-15.757,135.879-42.597l0.028-0.028l176.432,176.433c3.274,3.274,8.48,3.358,11.839,0l47.551-47.551
                            c3.274-3.274,3.106-8.703-0.028-11.838L433.223,373.8c26.84-38.539,42.597-85.39,42.597-135.907C475.82,106.52,369.3,0,237.927,0z
                            M237.927,419.811c-100.475,0-181.918-81.443-181.918-181.918S137.453,55.975,237.927,55.975s181.918,81.443,181.918,181.918
                            S338.402,419.811,237.927,419.811z"/>
                        </svg>
                      </span>
                      <input required id="calle" type="text" name="street" placeholder="Buscar" class="pl-10 border-2 w-full sm:w-96 p-2 text-sm font-medium outline-none focus:bg-gray-100 placeholder-text-gray-700 bg-white text-gray-900 rounded-2xl"/>
                    </div>
                  </div>
                  <!-- Botones de filtro y orden -->
                  <div class="mt-4 sm:mt-0 flex items-center justify-end relative">
                    <select class="border-2 p-2 text-sm font-medium outline-none focus:bg-gray-100 placeholder:text-gray-700 bg-white text-gray-900 rounded-2xl">
                      <option value="filtrar">Filtrar</option>
                      <option value="opcion1">Servicio</option>
                      <option value="opcion2">Marcas</option>
                      <option value="opcion3">Provedor</option>
                      <option value="opcion3">Categorias</option>
                    </select>
                  </div>
                  <!-- orden -->
                  <!-- Botones de filtro y orden -->
                  <!-- <div class="mt-4 sm:mt-0 flex items-center justify-end relative">
                    <select class="border-2 p-2 text-sm font-medium outline-none focus:bg-gray-100 placeholder:text-gray-700 bg-white text-gray-900 rounded-2xl">
                      <option value="filtrar">Ordenar</option>
                      <option value="opcion1">popular</option>
                      <option value="opcion2">ID</option>
                      <option value="opcion3">Alfabetico</option>
                      <option value="opcion3">Stock</option>
                    </select>
                  </div> -->

                  <!-- botones    -->
                  <button id="add_plomer" class="mt-4 sm:mt-0 flex items-center justify-end relative">
                    <p class="border-2 p-2 text-sm font-medium outline-none hover:bg-secundary bg-primary text-white rounded-2xl">
                        + Reponer Stock
                    </p>
                  </button>

                  <button id="add_plomer" class="mt-4 sm:mt-0 flex items-center justify-end relative">
                    <p class="border-2 p-2 text-sm font-medium outline-none hover:bg-secundary bg-primary text-white rounded-2xl">
                        - Asignar Recursos
                    </p>
                  </button>

                </div>
              </div>
            </div>
            
            


            <div class="block w-full overflow-x-auto">
              <table class="items-center bg-transparent w-full border-collapse ">
                <thead>
                  <tr>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                      ID
                    </th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                      Nombre
                    </th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                      Modelo
                    </th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                      Marca
                    </th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                      Unidad de Medida
                    </th>
                    <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                      Stock
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Las filas de la tabla se generan aquí mediante JavaScript -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </div>
  </section>

  <!-- footer -->
  <footer class="bg-white border-t-2 border-gray-100">
    <div class="relative mx-auto max-w-screen-xl px-4 py-14 sm:px-6 lg:px-8">
      <div class="lg:flex lg:items-end lg:justify-between">
        <div>
          <div class="flex justify-center text-teal-600 lg:justify-start">
            <img src="../assets/img/footer-logo.svg" alt="Logo de tuPlomeroMx" class="h-8" />
          </div>
          <p class="mx-auto mt-6 max-w-md text-center leading-relaxed text-gray-500 lg:text-left">
            Soluciones eficientes y confiables para todas tus necesidades de plomería.
          </p>
        </div>

        <ul class="mt-12 flex flex-wrap justify-center gap-6 md:gap-8 lg:mt-0 lg:justify-end lg:gap-12">
          <li>
            <a class="text-gray-700 transition hover:text-gray-700/75" href="#"> Nosotros </a>
          </li>
          <li>
            <a class="text-gray-700 transition hover:text-gray-700/75" href="#"> Políticas de Privacidad </a>
          </li>
          <li>
            <a class="text-gray-700 transition hover:text-gray-700/75" href="#"> Contacto </a>
          </li>
        </ul>
      </div>

      <p class="mt-12 text-center text-sm text-gray-500 lg:text-right">
        © 2024 <a href="#" class="hover:underline">TuPlomeroMx™</a>. Todos los derechos reservados.
      </p>
    </div>
  </footer>
</body>
</html>
