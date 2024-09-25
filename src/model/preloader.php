<?php

function myAutoloader($className) {
 
    $directory = MODEL . 'admin/';
    
    $file = $directory . $className . '.php';

    if (file_exists($file)) {
        include $file;
    }
}

spl_autoload_register('myAutoloader');
?>