<?php 
require MODEL . 'preloader.php';

if(!isset($_SESSION['info_user'])) {
    header('location: /login');
}

switch ($pages[1]) {
    case 'meus-dados':
        $metaTitle = 'Meus dados';
            include_once VIEW . 'common/header.html';
            include_once VIEW . 'common/topo-menu.html';
            include_once VIEW . 'painel/meus-dados.html';
        break;
    case 'produtos-cadastrados':
        $metaTitle = 'Produtos cadastrados';
        include_once VIEW . 'common/header.html';
        include_once VIEW . 'common/topo-menu.html';
            $product = new Product();
            $response = $product->findAllProductsUserCreate(true);
            include_once VIEW . 'painel/produtos-cadastrados.html';
        break;

        case 'pedidos':
            $metaTitle = 'Meus pedidos';
            $pedidos = new Product();
            $res = $pedidos->findAllPedidos();
            include_once VIEW . 'common/header.html';
            include_once VIEW . 'common/topo-menu.html';    
            include_once VIEW . 'painel/pedidos.html';
        break;
    
    default:
        # code...
        break;
}






?>