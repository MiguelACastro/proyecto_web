<?php 

$config = require __DIR__.'/../config/config.php';

define('BASE_PATH', $config['base_url']);
define('RESOURCES_PATH', $config['resources_url']);
define('SRC_PATH', $config['src_url']);

function getProductos() {
    return [
        [
            'nombre' => 'Nintendo Switch 2',
            'descripcion' => 'Ha llegado la siguiente evolución de la consola Nintendo Switch!',
            'imagen' => 'nintendo-switch-2-.jpg' 
        ],
        [
            'nombre' => 'Joy-Cons',
            'descripcion' => 'Lleva tu experiencia de juego al siguiente nivel con los Controles Azul y Rojo, diseñados para
                        ofrecerte una inmersión total y un rendimiento superior',
            'imagen' => 'joy-cons.png' 
        ],
        [
            'nombre' => 'Pro Controller',
            'descripcion' => 'El Control Pro inalámbrico está diseñado para brindar una experiencia de juego precisa, cómoda
                        y duradera en cada sesión de juego',
            'imagen' => 'pro-controller.png' 
        ],
        [
            'nombre' => 'Memoria MicroSD 256GB',
            'descripcion' => 'Expande el almacenamiento de tu Nintnendo Switch 2 con esta memoria diseñada para ofrecer
                        velocidad y rendimiento óptimo',
            'imagen' => 'sd-card.png' 
        ],
        [
            'nombre' => 'Laptop HP 245 G9',
            'descripcion' => 'La laptop HP 245 G9 ofrece funciones esenciales listas para la empresa en un diseño fino y liviano para que resulte fácil de llevar a todas partes.',
            'imagen' => 'laptop-hp-245.jpg' 
        ],
        [
            'nombre' => 'Hisense 65" QD6 Series',
            'descripcion' => 'La serie Hisense QD6 incluye QLED Quantum Dot Color para aumentar drásticamente el espacio de color y mejorar la saturación general del color para todo lo que veas',
            'imagen' => 'smart-tv.jpg' 
        ]
    ];
};