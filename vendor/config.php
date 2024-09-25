<?php 

$requestUri = trim($_SERVER['REQUEST_URI'], '/');
$isPageExist = empty($requestUri) ? 'home' : $requestUri;
$pages = explode("/", $isPageExist);


define('PAGE', $pages[0]);
if(isset($pages[1])) {

    define('SUB_PAGE', $pages[1]);
}

define('CONTROLLER', __DIR__ . '/src/controller/');
define('MODEL', __DIR__ . '/src/model/');
define('UPLOAD',  './upload/');
define('VIEW', __DIR__ . '/src/view/template/');
define('ASSETS', '/src/view/assets/');
define('IMAGES', '/images/');

define('PATH', '../../../../upload/');

?>