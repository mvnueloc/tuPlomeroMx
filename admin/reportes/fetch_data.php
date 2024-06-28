<?php
include '../../php/conexion_bd.php';

date_default_timezone_set('America/Mexico_City');
$hoy = date('Y-m-d');

if (isset($_GET['filter']) && isset($_GET['table'])) {
    $filtro = $_GET['filter'];
    $tabla = $_GET['table'];

    switch ($filtro) {
        case 'mensual':
            $fecha_inicio = date('Y-m-01', strtotime($hoy));
            $fecha_fin = date('Y-m-t', strtotime($hoy));
            break;
        case 'trimestre':
            $mes_actual = date('m', strtotime($hoy));
            $trimestre = ceil($mes_actual / 3);
            $fecha_inicio = date('Y-m-d', strtotime(date('Y', strtotime($hoy)) . '-' . (($trimestre * 3) - 2) . '-01'));
            $fecha_fin = date('Y-m-t', strtotime("+2 month", strtotime($fecha_inicio)));
            break;
        case 'semestre':
            $mes_actual = date('m', strtotime($hoy));
            if ($mes_actual <= 6) {
                $fecha_inicio = date('Y-01-01', strtotime($hoy));
                $fecha_fin = date('Y-06-30', strtotime($hoy));
            } else {
                $fecha_inicio = date('Y-07-01', strtotime($hoy));
                $fecha_fin = date('Y-12-31', strtotime($hoy));
            }
            break;
        case 'anual':
            $fecha_inicio = date('Y-01-01', strtotime($hoy));
            $fecha_fin = date('Y-12-31', strtotime($hoy));
            break;
        default:
            $fecha_inicio = '2000-01-01';
            $fecha_fin = $hoy;
            break;
    }

    switch ($tabla) {
        case 'costos':
            $query = "SELECT s.id_solicitud, u.nombre AS cliente, s.fecha_solicitud, srv.nombre_servicio, s.costo_total 
                      FROM solicitudes s
                      JOIN usuarios u ON s.id_cliente = u.id_usuario
                      JOIN servicios srv ON s.id_servicio = srv.id_servicio
                      WHERE s.fecha_solicitud BETWEEN '$fecha_inicio' AND '$fecha_fin'";
            $result = $conexion->query($query);

            $totalCosto = 0;
            if ($result->num_rows > 0) {
                echo '<table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 md:pl-0">#Orden</th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Cliente</th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Fecha</th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Servicio</th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Costo</th>
                            </tr>
                        </thead>
                        <tbody id="costos-tbody" class="divide-y divide-gray-200">';
                while ($row = $result->fetch_assoc()) {
                    $totalCosto += $row["costo_total"];
                    echo "<tr>
                            <td class='whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0'>" . $row["id_solicitud"] . "</td>
                            <td class='whitespace-nowrap py-4 px-3 text-sm text-gray-500'>" . $row["cliente"] . "</td>
                            <td class='whitespace-nowrap py-4 px-3 text-sm text-gray-500'>" . $row["fecha_solicitud"] . "</td>
                            <td class='whitespace-nowrap py-4 px-3 text-sm text-gray-500'>" . $row["nombre_servicio"] . "</td>
                            <td class='whitespace-nowrap py-4 px-3 text-sm text-gray-500'>$" . number_format($row["costo_total"], 2) . " MXN</td>
                          </tr>";
                }
                echo '</tbody>
                      <tfoot>
                          <tr>
                              <td colspan="4" class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0 text-right">Total</td>
                              <td id="total-costo" class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 font-semibold">$' . number_format($totalCosto, 2) . ' MXN</td>
                          </tr>
                      </tfoot>
                    </table>';
            } else {
                echo "No hay datos disponibles para el filtro seleccionado.";
            }
            break;

        case 'actividad':
            $query = "SELECT j.id_jornada, u.nombre AS tecnico, j.hora_inicio, j.hora_fin
                      FROM jornadas_trabajo j
                      JOIN usuarios u ON j.id_usuario = u.id_usuario
                      WHERE j.fecha BETWEEN '$fecha_inicio' AND '$fecha_fin'";
            $result = $conexion->query($query);

            $totalHoras = 0;
            if ($result->num_rows > 0) {
                echo '<table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 md:pl-0">Técnico</th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Horas</th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Hora inicio</th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Hora fin</th>
                            </tr>
                        </thead>
                        <tbody id="actividad-tbody" class="divide-y divide-gray-200">';
                while ($row = $result->fetch_assoc()) {
                    $hora_inicio = strtotime($row["hora_inicio"]);
                    $hora_fin = strtotime($row["hora_fin"]);
                    $horas_trabajadas = ($hora_fin - $hora_inicio) / 3600;
                    $totalHoras += $horas_trabajadas;

                    echo "<tr>
                            <td class='whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0'>" . $row["tecnico"] . "</td>
                            <td class='whitespace-nowrap py-4 px-3 text-sm text-gray-500 horas'>" . number_format($horas_trabajadas, 2) . "</td>
                            <td class='whitespace-nowrap py-4 px-3 text-sm text-gray-500 hora-inicio'>" . $row["hora_inicio"] . "</td>
                            <td class='whitespace-nowrap py-4 px-3 text-sm text-gray-500 hora-fin'>" . $row["hora_fin"] . "</td>
                          </tr>";
                }
                echo '</tbody>
                      <tfoot>
                          <tr>
                              <td colspan="3" class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0 text-right">Horas Totales</td>
                              <td id="total-horas" class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 font-semibold">' . number_format($totalHoras, 2) . '</td>
                          </tr>
                      </tfoot>
                    </table>';
            } else {
                echo "No hay datos disponibles para el filtro seleccionado.";
            }
            break;

        case 'materiales':
            include 'get_materiales.php';
            $query = "SELECT s.id_solicitud, srv.id_servicio, srv.nombre_servicio
                      FROM solicitudes s
                      JOIN servicios srv ON s.id_servicio = srv.id_servicio
                      WHERE s.fecha_solicitud BETWEEN '$fecha_inicio' AND '$fecha_fin'";
            $result = $conexion->query($query);

            $totalCantidad = 0;
            $totalCostoMateriales = 0;
            if ($result->num_rows > 0) {
                echo '<table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 md:pl-0">Servicio</th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">#Orden</th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Material</th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Cantidad</th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">Costo Unitario</th>
                            </tr>
                        </thead>
                        <tbody id="materiales-tbody" class="divide-y divide-gray-200">';
                while ($row = $result->fetch_assoc()) {
                    $id_solicitud = $row["id_solicitud"];
                    $id_servicio = $row["id_servicio"];
                    $nombre_servicio = $row["nombre_servicio"];
                    $materiales = obtenerMaterialesPorServicio($id_servicio);

                    foreach ($materiales as $material) {
                        $totalCantidad += $material['cantidad'];
                        $totalCostoMateriales += $material['cantidad'] * $material['costo_unitario'];
                        echo "<tr>
                                <td class='whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0'>$nombre_servicio</td>
                                <td class='whitespace-nowrap py-4 px-3 text-sm text-gray-500'>$id_solicitud</td>
                                <td class='whitespace-nowrap py-4 px-3 text-sm text-gray-500'>{$material['nombre']}</td>
                                <td class='whitespace-nowrap py-4 px-3 text-sm text-gray-500 cantidad'>{$material['cantidad']}</td>
                                <td class='whitespace-nowrap py-4 px-3 text-sm text-gray-500'>$" . number_format($material['costo_unitario'], 2) . " MXN</td>
                              </tr>";
                    }
                }
                echo '</tbody>
                      <tfoot>
                          <tr>
                              <td colspan="3" class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 md:pl-0 text-right">Total Materiales</td>
                              <td id="total-cantidad" class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 font-semibold">' . $totalCantidad . '</td>
                              <td id="total-costo-materiales" class="whitespace-nowrap py-4 px-3 text-sm text-gray-500 font-semibold">$' . number_format($totalCostoMateriales, 2) . ' MXN</td>
                          </tr>
                      </tfoot>
                    </table>';
            } else {
                echo "No hay datos disponibles para el filtro seleccionado.";
            }
            break;

        default:
            echo "Error: Tabla no reconocida.";
            break;
    }
} else {
    echo "Error: Filtro no definido.";
}
?>
