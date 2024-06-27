<?php
// Definición de las regiones y sus respectivos municipios y códigos postales
$regiones = [
    'Zona 1' => [
        'Azcapotzalco' => range(2000, 2999),
        'Miguel Hidalgo' => range(11000, 11999),
        'Cuauhtémoc' => range(6000, 6999),
        'Benito Juárez' => range(3000, 3999),
        'Coyoacán' => range(4000, 4999)
    ],
    'Zona 2' => [
        'Gustavo A. Madero' => range(7000, 7999),
        'Venustiano Carranza' => range(15000, 15999),
        'Iztacalco' => range(8000, 8999),
        'Iztapalapa' => range(9000, 9999)
    ],
    'Zona 3' => [
        'Cuajimalpa' => range(5000, 5999),
        'Álvaro Obregón' => range(1000, 1999),
        'Magdalena Contreras' => range(10000, 10999),
        'Tlalpan' => range(14000, 14999)
    ],
    'Zona 4' => [
        'Tláhuac' => range(13000, 13999),
        'Xochimilco' => range(16000, 16999),
        'Milpa Alta' => range(12000, 12999)
    ]
];

function obtenerZona($codigo_postal) {
    global $regiones;
    foreach ($regiones as $zona => $municipios) {
        foreach ($municipios as $cp_range) {
            if (in_array($codigo_postal, $cp_range)) {
                return $zona;
            }
        }
    }
    return null; // Si no se encuentra la zona
}
?>
