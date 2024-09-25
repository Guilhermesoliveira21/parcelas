<?php 

require_once MODEL . 'preloader.php';
$metaTitle = 'Página Inicial';

$products = new Product();
$response = $products->findAllCategoria(SUB_PAGE);


include_once VIEW . 'common/header.html';
include_once VIEW . 'common/topo-menu.html';
include_once VIEW . 'home/produtos.html';


?>