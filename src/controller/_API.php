<?php

require MODEL . 'preloader.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");
// header('Content-Type: application/json');


$data = file_get_contents('php://input');
$json = json_decode($data, true);


if($_SERVER['REQUEST_METHOD'] === 'POST') {

    switch ($json['conteudo']) {
        case 'register_user':
            
            $userCreate = new User();
            $userCreate->setCreateUser($json);
            $userCreate->createUser();
            
            break;
        case 'login':

            $login = new User();
            $login->login($json['email'], $json['senha']);
            break;
        case 'logout':
            $sair = new User();
            $sair->logout();
            break;

        case 'create_product':

            echo json_encode(['Status'=>true]);

            break;
        default:
        
            break;
    }

}

// if($_SERVER['REQUEST_METHOD'] === 'DELETE') {

//     switch($data['conteudo']) {
//         case 'logout':
//             $sair = new User();
//             $sair->logout();
//             break;
//         default:
        
//             break;
//     }

// }

exit;

?>