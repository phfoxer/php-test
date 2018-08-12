<?php 
/**
 * Joãozinho vai morder o seu dedo 50% das vezes. Esse exercício será dividido em 2 partes. 
 */
function foiMordido($key){
    return (filter_input(INPUT_GET, $key, FILTER_SANITIZE_URL)=='')? 1 : '';
}
$condition = foiMordido('inhac');
echo '<a href="?inhac='.$condition.'">Click aqui</a>'.PHP_EOL;
echo 'Joaozinho'. (($condition) ? ' não' : '') .' mordeu o seu dedo!'.PHP_EOL;