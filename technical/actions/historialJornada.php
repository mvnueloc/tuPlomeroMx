<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(dirname(__DIR__) . '/../php/conexion_bd.php');

session_start();

$id_jornada = $_SESSION['id_jornada'];
// $id_jornada = 4;

$query = "SELECT s.id_servicio, s.nombre_servicio, s.costo_base
FROM servicios s
JOIN solicitudes so ON s.id_servicio = so.id_servicio
JOIN trabajo t ON so.id_solicitud = t.id_solicitud
WHERE t.id_jornada = $id_jornada";

$result = mysqli_query($conexion, $query);

$serviciosRealizados = [];
$id_servicios = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $serviciosRealizados[] = $row;
        $id_servicios[] = $row['id_servicio'];
    }
} else {
    // echo "No se encontraron serviciosRealizados.";
}

// echo '<pre>';
// var_dump($id_servicios);
// echo '</pre>';

$materiales = [
    'Filtro de tinaco' => 0,
    'litro de solución sanitizante antibacterial' => 0,
    'Cepillo con extensor' => 0,
    'metros de Tubo de cobre de 1/2 pulgada' => 0,
    'Codos de 1/2 pulgada' => 0,
    'Metros de soldadura' => 0,
    'tubo de gas butano de 1/2 litro' => 0,
    'Kit de mangueras de agua caliente, fria y gas' => 0,
    'Rollo de cinta Teflón' => 0,
    'Valvulas de presión inversa de 1/2 pulgada' => 0,
];

foreach ($id_servicios as $servicio) {
    if ($servicio == 1) {
        $materiales['Filtro de tinaco'] += 1;
        $materiales['litro de solución sanitizante antibacterial'] += 1;
        $materiales['Cepillo con extensor'] += 1;
    } else if ($servicio == 2) {
        $materiales['metros de Tubo de cobre de 1/2 pulgada'] += 3;
        $materiales['Codos de 1/2 pulgada'] += 5;
        $materiales['Metros de soldadura'] += 2;
        $materiales['tubo de gas butano de 1/2 litro'] += 1;
    } else if ($servicio == 3) {

        $materiales['Kit de mangueras de agua caliente, fria y gas'] += 1;
        $materiales['Rollo de cinta Teflón'] += 1;
        $materiales['Valvulas de presión inversa de 1/2 pulgada'] += 2;
    } else {
        // echo "No se encontraron serviciosRealizados.";
    }
}

// echo '<pre>';
// var_dump($materiales);
// echo '</pre>';
