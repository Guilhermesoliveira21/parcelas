<?php
require_once MODEL . 'preloader.php';

$metaTitle = 'Meu carrinho';

include_once VIEW . 'common/header.html';
include_once VIEW . 'common/topo-menu.html';
if (!isset($userSession)) {
    echo '<br><h4 class="mt-5 text-center">Entre agora e aproveite suas compras <a href="/login">aqui</a>!</h4>';
} else {
    $card = new Product();
    $cardProduct = $card->findAllProductCard();

    include_once VIEW . 'card/conteudo.html';
}
