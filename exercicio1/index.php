<?php
/**
 * Crie um script PHP que mostra o nome do país e sua capital usando uma array chamada $location. 
 * Ordene a Lista pelo nome da capital e adicione pelo menos 5 entradas no array.
 */
$location = [
    ['pais' => 'Russia',    'capital' => 'Moscow'],
    ['pais' => 'Espanha',   'capital' => 'Madrid'],
    ['pais' => 'França',    'capital' => 'Paris'],
    ['pais' => 'Alemanha',  'capital' => 'Berlim'],
    ['pais' => 'Argentina', 'capital' => 'Buenos Aires']
];

usort($location, function($a, $b) {
    return $a['capital'] <=> $b['capital'];
});

foreach ($location as $local) {
    echo 'A capital da '.$local['pais'].' é '.$local['capital'].'<br />';
}