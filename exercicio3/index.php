<?php
/**
 * Escreva uma função em PHP para pegar determinar a extensão dos 3 arquivos abaixo e mostrar as extensões na tela. 
 * As saídas devem ser mostradas em uma lista em ordem alfabética.
 */

$musicas = 	['music.mp4','video.mov','imagem.jpeg'];

usort($musicas, function($a, $b) {
    $extA = pathinfo($a)['extension'];
    $extB = pathinfo($b)['extension'];
    return $extA <=> $extB;
});
$extensoes = array_map(function($value){
    return '.'.pathinfo($value)['extension'];
},$musicas);

print_r($extensoes);

