<?php 

require 'vendor/autoload.php';
require 'config.php';

session_start();


if(isset($_SESSION['info_user'])) {
    $userSession = $_SESSION['info_user'];  
}


if(file_exists(CONTROLLER . PAGE.'.php')) {
    include_once CONTROLLER . PAGE.'.php';
    include_once VIEW . 'common/footer.html';
}else {

}

?>