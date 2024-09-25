<?php

require MODEL . 'preloader.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    switch ($_POST['conteudo']) {
        case 'create_product':
            $createProduct = new Product();
            $createProduct->createProduct($_POST, $_FILES);
            break;
        case 'add_product_card':
            $addProductCard = new Product();
            $addProductCard->addProductCard($_POST);
            break;
        case 'finalizar_compra':
            $finalizar = new Product();
            $finalizar->finalizarCompra($_POST);

            // echo json_encode($_POST);
            break;
        case 'delete_product': 
            $deleteProductCard = new Product();
            $deleteProductCard->deleteProductCard($_POST['product_id']);
            echo json_encode(['data' => $_POST]);
            break;

        default:
            # code...
            break;
    }
}

exit;
