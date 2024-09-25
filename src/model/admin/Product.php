<?php 

require_once MODEL . 'admin/Response.php';
class Product extends Response {

    public function createProduct($product, $image) {

        $dirnameImage = self::image($image);

        $insertProduct = [
            'nome' => $product['produto'],
            'descricao' => $product['descricao'],
            'categoria' => $product['categoria'],
            'preco' => $product['preco'],
            'image' => $dirnameImage,
            'user_id' => $this->user_id
        ];

        $this->setTable('tab_produto');

        if($this->create_sql($insertProduct)) {
            return self::setResponse([
                'info' => 'Produto cadastrado com sucesso!',
                'status' => 'sucesso'
            ], 201);
        }else {
            return self::setResponse([
                'info' => 'Produto cadastrado com sucesso!',
                'status' => 'erro'
            ], 401);
        }  

    }

    public function findAllProducts($debug = false) {

        $this->setTable('tab_produto');
        $response = $this->findAll();

        if($debug == true) {
            return $response;
        }else {
            return self::setResponse([
                'data' => $response
            ], 200);

        }

    }
    public function findAllProductsUserCreate($debug = false) {

        $this->setTable('tab_produto');
        $response = $this->findAll(['user_id' => $this->user_id], true);
        if($debug == true) {
            return $response;
        }else {
            return self::setResponse([
                'data' => $response
            ], 200);
        }
    }
    public function findOneProducts($debug = false, $id) {

        $this->setTable('tab_produto');
        $response = $this->findAll(['id' => $id]);

        if($debug == true) {
            return $response;
        }else {
            return self::setResponse([
                'data' => $response
            ], 200);
        }
    }

    public function addProductCard($data) {

        $add_card = [
            'user_id'=> $this->user_id,
            'product_id' => $data['product']
        ];

        $this->setTable('tab_card');
        if($this->create_sql($add_card)) {
            return self::setResponse([
                'info' => 'Produto adicionado no carrinho',
                'status' => 'sucesso'
            ], 201);
        }else {
            return self::setResponse([
                'info' => 'Erro ao adicionar produto no carrinho',
                'status' => 'erro'
            ], 401);
        }
    }

    public function findAllProductCard() {

        $query = "SELECT * FROM tab_card 
        INNER JOIN cad_user ON tab_card.user_id = cad_user.id 
        INNER JOIN tab_produto ON tab_produto.id = tab_card.product_id
        WHERE tab_card.user_id LIKE ".$this->user_id."";

        return $this->query($query);
  
    }

    public function finalizarCompra($data) {

        $parcelaValor = explode(' ', $data['parcela']);

        

        $finalizarCompra = [
            'user_id' => $this->user_id,
            'metodo_pagamento' => $data['payment'],
            'parcela' => $parcelaValor[0],
            'valor' => $parcelaValor[1],
            'pedido' => rand(1, 9999)
        ];

        $this->setTable('tab_pagamento');
        if($this->create_sql($finalizarCompra)){
            $delete = new OrmDB();
            $delete->setTable('tab_card');
            if($delete->deleteByUserId($this->user_id)){

                return self::setResponse([
                    'info' => 'Compra realizada com sucesso!',
                    'status' => 'sucesso'
                ], 201);
            }else {
                return self::setResponse([
                    'info' => 'Erro ao realizar a compra!',
                    'status' => 'erro'
                ], 401);
            }
            };

    }

    public function deleteProductCard($id) {

        $this->setTable('tab_card');
        $this->delete(['id_card' => $id]);

    }

    public function findAllPedidos() {
        $this->setTable('tab_pagamento');
        return $this->findAll(['user_id' => $this->user_id], true);
    }

    private static function image(array $image) {

        if(!is_dir(UPLOAD)) {
            mkdir(UPLOAD);
        }

        $filename = UPLOAD . $image['imagem']['name'];
        $filetmp = $image['imagem']['tmp_name'];

        if(move_uploaded_file($filetmp, $filename)) {
            $filePath = $image['imagem']['name'];
            return $filePath;
        }else {
            return false;
        }

    }

    public function findAllCategoria($data) {

        $this->setTable('tab_produto');
        return $this->findAll(['categoria'=>$data], true);

    }

    public function findOneRelatorio($data) {

        $this->setTable('tab_pagamento');
        return $this->findAll(['pedido' => $data]);

    }

}

?>