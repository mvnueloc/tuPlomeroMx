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
                    <a class="text-white hover:text-secundary text-sm px-3 py-2 mx-2 transition-colors duration-300" href="../almacen/almacen.php">Almacen</a>
                    <a class="text-secundary hover:text-secundary text-sm px-3 py-2 mx-2 transition-colors duration-300" href="./reportes.php">Reportes</a>
                </div>
            </div>
        </nav>

  <section class=" w-full md:bg-cover md:bg-center">
    <div class="w-full md:flex-row justify-between">

      <section class="py-1 bg-blueGray-50 w-full sm:p-10 ">
        <div class="flex justify-center item-center mb-10">
            <h2 class="text-white font-bold text-4xl">Reportes de la plataforma</h2>
        </div>

        <!-- tabla de costos -->
        <div class="bg-white rounded-2xl p-7 mb-10">
            <div class="flex flex-wrap justify-between items-center">
                <h3 class="text-lg font-bold">Costos</h3>
                <div>
                    <button class="inline-flex rounded-md border border-transparent bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-secundary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 sm:w-auto">ver mas</button>
                </div>
            </div>
            
            <div class="flex justify-center item-center">
                <div class="w-full px-4 sm:px-6 lg:px-8">
                    <div class="mt-8 flex flex-col">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 md:pl-0">#Orden</th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Cliente</th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Fecha</th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Servicio</th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Costo</th>
                            </tr>
                            </thead>
                            <tbody id="costos-tbody" class="divide-y divide-gray-200">
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0">1001</td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">Juan Pérez</td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">2023-05-12</td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">Reparación de fuga</td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">$1500 MXN</td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0">1002</td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">María López</td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">2023-05-14</td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">Instalación de lavabo</td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">$2500 MXN</td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0">1003</td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">Carlos Ruiz</td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">2023-05-18</td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">Desatasco de tuberías</td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">$1200 MXN</td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0">1004</td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">Laura Gómez</td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">2023-05-20</td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">Mantenimiento de calentador</td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">$1800 MXN</td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0">1005</td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">Pedro Jiménez</td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">2023-05-22</td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">Cambio de grifería</td>
                                <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">$2100 MXN</td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="4" class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0 text-right">Total</td>
                                <td id="total-costo" class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 font-semibold">$0 MXN</td>
                            </tr>
                            </tfoot>
                        </table>
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
                    <button class="inline-flex rounded-md border border-transparent bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-secundary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 sm:w-auto">Ver más</button>
                </div>
            </div>
            
            <div class="flex justify-center item-center">
                <div class="w-full px-4 sm:px-6 lg:px-8">
                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 md:pl-0">Técnico</th>
                                            <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Horas</th>
                                            <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Servicios</th>
                                            <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Hora inicio</th>
                                            <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Hora fin</th>
                                        </tr>
                                    </thead>
                                    <tbody id="actividad-tbody" class="divide-y divide-gray-200">
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0">Juan Pérez</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 horas">0</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">Reparación de fuga</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 hora-inicio">08:00</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 hora-fin">12:00</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0">María López</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 horas">0</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">Instalación de lavabo</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 hora-inicio">07:00</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 hora-fin">13:00</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0">Carlos Ruiz</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 horas">0</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">Desatasco de tuberías</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 hora-inicio">11:00</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 hora-fin">14:00</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0">Laura Gómez</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 horas">0</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">Mantenimiento de calentador</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 hora-inicio">11:00</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 hora-fin">17:00</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0">Pedro Jiménez</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 horas">0</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">Cambio de grifería</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 hora-inicio">12:00</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 hora-fin">16:00</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0 text-right">Horas Totales</td>
                                            <td id="total-horas" class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 font-semibold">0</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>

        
        <!-- tabla de Materiales -->
        <div class="bg-white rounded-2xl p-7 mb-10">
            <div class="flex flex-wrap justify-between items-center">
                <h3 class="text-lg font-bold">Materiales</h3>
                <div>
                    <button class="inline-flex rounded-md border border-transparent bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-secundary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 sm:w-auto">ver más</button>
                </div>
            </div>
            
            <div class="flex justify-center item-center">
                <div class="w-full px-4 sm:px-6 lg:px-8">
                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 md:pl-0">Servicio</th>
                                            <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">#Orden</th>
                                            <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Materiales</th>
                                            <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Cantidad</th>
                                            <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Costo</th>
                                        </tr>
                                    </thead>
                                    <tbody id="material-tbody" class="divide-y divide-gray-200">
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0">Reparación de fuga</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">1001</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">
                                                <p>Tubo de PVC</p>
                                                <p>Conexion de codo</p>
                                            </td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 cantidad">2</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">$500 MXN</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0">Instalación de lavabo</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">1002</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">Lavabo</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 cantidad">1</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">$2000 MXN</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0">Desatasco de tuberías</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">1003</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">Desatascador</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 cantidad">1</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">$200 MXN</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0">Mantenimiento de calentador</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">1004</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">Termostato</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 cantidad">1</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">$1800 MXN</td>
                                        </tr>
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0">Cambio de grifería</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">1005</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">Grifo</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 cantidad">3</td>
                                            <td class="whitespace-nowrap py-4 px-3 text-sm text-gray-500">$2200 MXN</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0 text-right">Total de Materiales</td>
                                            <td id="total-cantidad" class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 font-semibold">0</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>


      </section>
    </div>
  </section>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        const tbody = document.getElementById("costos-tbody");
        const totalCell = document.getElementById("total-costo");
        let total = 0;

        Array.from(tbody.rows).forEach(row => {
            const costoCell = row.cells[4];
            const costoText = costoCell.textContent.replace('$', '').replace(' MXN', '').replace(',', '');
            const costo = parseFloat(costoText);
            total += costo;
        });

        totalCell.textContent = `$${total.toLocaleString('es-MX')} MXN`;
    });

    document.addEventListener('DOMContentLoaded', function () {
        const rows = document.querySelectorAll('#actividad-tbody tr');
        let totalHoras = 0;

        rows.forEach(row => {
            const horaInicio = row.querySelector('.hora-inicio').innerText;
            const horaFin = row.querySelector('.hora-fin').innerText;

            const [inicioHoras, inicioMinutos] = horaInicio.split(':').map(Number);
            const [finHoras, finMinutos] = horaFin.split(':').map(Number);

            const horasInicio = inicioHoras + inicioMinutos / 60;
            const horasFin = finHoras + finMinutos / 60;

            const horasTrabajadas = horasFin - horasInicio;

            row.querySelector('.horas').innerText = horasTrabajadas.toFixed(2);
            totalHoras += horasTrabajadas;
        });

        document.getElementById('total-horas').innerText = totalHoras.toFixed(2);
    });

    document.addEventListener('DOMContentLoaded', function () {
        const rows = document.querySelectorAll('#material-tbody tr');
        let totalCantidad = 0;

        rows.forEach(row => {
            const cantidad = parseInt(row.querySelector('.cantidad').innerText, 10);
            totalCantidad += cantidad;
        });

        document.getElementById('total-cantidad').innerText = totalCantidad;
    });
</script>
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
