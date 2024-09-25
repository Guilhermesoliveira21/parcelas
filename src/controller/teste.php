<?php 

require MODEL . 'preloader.php';

$teste = new Product();

$data = [
    'nome' => 'guilherme',
    'descricao' => 'Uma descricao teste',
    'preco' => 200.00,
    'parcela' => 3,
    'user_id' => 1,
];

$res = $teste->teste();

var_dump($res);
?>