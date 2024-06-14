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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo_postal = intval($_POST['codigo_postal']);
    $zona_encontrada = '';

    // Buscar en qué zona se encuentra el código postal ingresado
    foreach ($regiones as $zona => $municipios) {
        foreach ($municipios as $municipio => $cp_range) {
            if (in_array($codigo_postal, $cp_range)) {
                $zona_encontrada = $zona;
                break 2; // Romper ambos bucles
            }
        }
    }

    // Mostrar resultado
    if (!empty($zona_encontrada)) {
        echo '<div class="result">';
        echo "El código postal $codigo_postal pertenece a la $zona_encontrada.";
        echo '</div>';
    } else {
        echo '<div class="result">';
        echo "El código postal $codigo_postal no se encuentra en ninguna zona definida.";
        echo '</div>';
    }
}
?>
