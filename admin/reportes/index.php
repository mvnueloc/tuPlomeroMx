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
                        primary: "rgb(30 41 59)",
                        secundary: "#0077C2",
                        third: "#F5F5F5",
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
    <nav class="shadow bg-gray-100">
        <div class="relative flex flex-col px-4 py-4 md:mx-auto md:flex-row md:items-center">
            <a href="#" class="flex items-center whitespace-nowrap text-2xl font-black">
                tuPlomeroMX
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
                        <a href="#">Empleados</a>
                    </li>
                    <li class="text-gray-600 md:mr-12 hover:text-secundary">
                        <a href="../almacen/">Almacen</a>
                    </li>
                    <li class="text-secundary md:mr-12 hover:text-secundary">
                        <a href="#">Reportes</a>
                    </li>
                    <li class="text-gray-600 md:mr-12 hover:text-secundary">
                        <button onclick="window.location.href='../../php/logout.php'" class="rounded-md border-2 border-red-500 px-3 py-1 font-medium text-red-500 transition-colors hover:bg-red-500 hover:text-white">
                            Cerrar sesión
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class=" w-full md:bg-cover md:bg-center">
        <div class="w-full md:flex-row justify-between">

            <section class="py-1 bg-blueGray-50 w-full sm:p-10 ">
                <div class="flex justify-center item-center mb-10">
                    <h2 class="text-white font-bold text-4xl">Reportes de la plataforma</h2>
                </div>



                <!-- tabla de Pagos Completados-->
                <div class="bg-white rounded-2xl p-7 mb-10">
                    <div class="flex flex-wrap justify-between items-center">
                        <h3 class="text-lg font-bold">Pagos Realizados</h3>
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
                                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 md:pl-0">id_pago</th>
                                                    <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Fecha pago</th>
                                                    <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Hora Pago</th>
                                                    <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Monto</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            ini_set('display_errors', 1);
                                            ini_set('display_startup_errors', 1);
                                            error_reporting(E_ALL);

                                            include '../../php/conexion_bd.php';

                                            $query = "SELECT * FROM pagos WHERE status = 1";

                                            $result = mysqli_query($conexion, $query);

                                            $total = 0;

                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tbody id='trabajos-tbody' class='divide-y divide-gray-200'>";
                                                    echo "<tr>";
                                                    echo "<td class='whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0'>" . $row['id_pago'] . "</td>";
                                                    echo "<td class='whitespace-nowrap py-4 px-3 text-sm text-gray-500'>" . $row['fecha_pago'] . "</td>";
                                                    echo "<td class='whitespace-nowrap py-4 px-3 text-sm text-gray-500'>" . $row['hora_pago'] . "</td>";
                                                    echo "<td class='whitespace-nowrap py-4 px-3 text-sm text-gray-500'>" . $row['monto'] . "</td>";
                                                    $total += intval($row['monto']);
                                                    // var_dump($total);
                                                    echo "</tr>";
                                                    echo "</tbody>";
                                                }
                                            }
                                            ?>

                                            <!-- <tbody id="actividad-tbody" class="divide-y divide-gray-200">
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
                                            </tbody> -->
                                            <tfoot>
                                                <tr>
                                                    <td colspan="4" class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0 text-right">Total $ <?php echo $total ?></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- tabla de Pagos NO Completados-->
                <div class="bg-white rounded-2xl p-7 mb-10">
                    <div class="flex flex-wrap justify-between items-center">
                        <h3 class="text-lg font-bold">Pagos Pendientes</h3>
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
                                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 md:pl-0">id_pago</th>
                                                    <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Fecha pago</th>
                                                    <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Hora Pago</th>
                                                    <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Monto</th>
                                                    <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Cliente</th>
                                                    <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Telefono</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $query = "SELECT 
                                            u.nombre, 
                                            u.telefono,
                                            p.id_pago,
                                            p.fecha_pago,
                                            p.hora_pago,
                                            p.monto
                                        FROM 
                                            pagos p
                                        JOIN 
                                            trabajo t ON p.id_trabajo = t.id_trabajo
                                        JOIN 
                                            solicitudes s ON t.id_solicitud = s.id_solicitud
                                        JOIN 
                                            usuarios u ON s.id_cliente = u.id_usuario
                                        WHERE 
                                            p.status = 0";;

                                            $result = mysqli_query($conexion, $query);

                                            $total = 0;

                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tbody id='trabajos-tbody' class='divide-y divide-gray-200'>";
                                                    echo "<tr>";
                                                    echo "<td class='whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0'>" . $row['id_pago'] . "</td>";
                                                    echo "<td class='whitespace-nowrap py-4 px-3 text-sm text-gray-500'>" . $row['fecha_pago'] . "</td>";
                                                    echo "<td class='whitespace-nowrap py-4 px-3 text-sm text-gray-500'>" . $row['hora_pago'] . "</td>";
                                                    echo "<td class='whitespace-nowrap py-4 px-3 text-sm text-gray-500'>" . $row['monto'] . "</td>";
                                                    echo "<td class='whitespace-nowrap py-4 px-3 text-sm text-gray-500'>" . $row['nombre'] . "</td>";
                                                    echo "<td class='whitespace-nowrap py-4 px-3 text-sm text-gray-500'>" . $row['telefono'] . "</td>";

                                                    $total += intval($row['monto']);
                                                    // var_dump($total);
                                                    echo "</tr>";
                                                    echo "</tbody>";
                                                }
                                            }
                                            ?>

                                            <tfoot>
                                                <tr>
                                                    <td colspan="6" class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-8 md:pl-0 text-right">Total $ <?php echo $total ?></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- tabla de trabajos -->
                <div class="bg-white rounded-2xl p-7 mb-10">
                    <div class="flex flex-wrap justify-between items-center">
                        <h3 class="text-lg font-bold">Trabajos</h3>
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
                                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 md:pl-0">#id</th>
                                                    <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Tecnico</th>
                                                    <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Servicio</th>
                                                    <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Status</th>
                                                    <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Zona</th>
                                                </tr>
                                            </thead>
                                            <?php


                                            $query = "SELECT 
                                                u.nombre AS nombre_trabajador, 
                                                t.id_trabajo, 
                                                s.zona,
                                                s.id_servicio,
                                                t.status AS status_trabajo
                                            FROM 
                                                trabajo t
                                            JOIN 
                                                solicitudes s ON t.id_solicitud = s.id_solicitud
                                            JOIN 
                                                usuarios u ON t.id_trabajador = u.id_usuario
                                            ORDER BY 
                                                t.id_trabajo;
                                            ";

                                            $result = mysqli_query($conexion, $query);

                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tbody id='trabajos-tbody' class='divide-y divide-gray-200'>";
                                                    echo "<tr>";
                                                    echo "<td class='whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0'>" . $row['id_trabajo'] . "</td>";
                                                    echo "<td class='whitespace-nowrap py-4 px-3 text-sm text-gray-500'>" . $row['nombre_trabajador'] . "</td>";
                                                    if ($row['id_servicio'] == 1) {
                                                        $servicio = "Mantenimiento preventivo y lavado de tinacos";
                                                    } elseif ($row['id_servicio'] == 2) {
                                                        $servicio = "Mantenimiento preventivo y lavado de tinacos";
                                                    } elseif ($row['id_servicio'] == 3) {
                                                        $servicio = "Instalación de calentador de agua";
                                                    }
                                                    echo "<td class='whitespace-nowrap py-4 px-3 text-sm text-gray-500'>" . $servicio . "</td>";
                                                    $status = ($row['status_trabajo'] == 1) ? "Terminado" : "Pendiente";
                                                    echo "<td class='whitespace-nowrap py-4 px-3 text-sm text-gray-500'>" . $status . "</td>";
                                                    echo "<td class='whitespace-nowrap py-4 px-3 text-sm text-gray-500'>" . $row['zona'] . "</td>";
                                                    echo "</tr>";
                                                    echo "</tbody>";
                                                }
                                            }

                                            ?>
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

        document.addEventListener('DOMContentLoaded', function() {
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

        document.addEventListener('DOMContentLoaded', function() {
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