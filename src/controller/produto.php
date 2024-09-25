<?php 

require MODEL . 'preloader.php';

$produto = new Product();
$product = $produto->findOneProducts(true, SUB_PAGE)[0];



include_once VIEW . 'common/header.html';
include_once VIEW . 'common/topo-menu.html';
include_once VIEW . 'produto/produto.html';


?>