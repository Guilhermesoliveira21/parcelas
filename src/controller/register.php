<?php 


$metaTitle = 'Registrar';

if(isset($userSession)) {
    header('location: /');
}

include_once VIEW . 'common/header.html';
include_once VIEW . 'common/topo-menu.html';
include_once VIEW . 'register/conteudo.html';
?>