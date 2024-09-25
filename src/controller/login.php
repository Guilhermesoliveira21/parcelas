<?php 


$metaTitle = 'Login';
if(isset($userSession)) {
    header('location: /');
}
include_once VIEW . 'common/header.html';
include_once VIEW . 'common/topo-menu.html';
include_once VIEW . 'login/login.html';
?>