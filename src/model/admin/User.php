<?php


require_once MODEL . "admin/Admin.php";
require_once MODEL . 'admin/Response.php';

class User extends Admin {
    private PDO $conn;
    private $user;

    public function __construct() {
        $this->conn = $this->connect();

    }

    public function setCreateUser($user) {
        $this->user = $user;
    }

    public function getUserCreate() {
        return $this->user;
    }

    public function createUser() {

        $createUser = "INSERT INTO cad_user (nome, email, telefone, cpf, data_nasc, senha) VALUES(:nome, :email, :telefone, :cpf, :data_nasc, :senha)";

        $stmt = $this->conn->prepare($createUser);

        $data = $this->getUserCreate();

        if($this->findOne('email', $data['email'])) {
            return Response::setResponse([
                'info' => 'Usuario já existente!',
                'status' => 'erro'
            ], 400);
        };

        $passwordHash = password_hash($data['senha'], PASSWORD_DEFAULT);

        try {
            $stmt->bindValue(':nome', $data['nome'], PDO::PARAM_STR);
            $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
            $stmt->bindValue(':telefone', $data['telefone'], PDO::PARAM_STR);
            $stmt->bindValue(':cpf', $data['cpf'], PDO::PARAM_STR);
            $stmt->bindValue(':data_nasc', $data['data_nasc'], PDO::PARAM_STR);
            $stmt->bindValue(':senha', $passwordHash, PDO::PARAM_STR);

            if($stmt->execute()) {
                return Response::setResponse([
                    'info' => 'Usuario criado com sucesso!',
                    'status' => 'sucesso'
                ], 201);
            }else {
                return Response::setResponse([
                    'info' => 'Erro ao criar usuario!',
                    'status' => 'erro'
                ], 400);
            }
        } catch (\PDOException $err) {
            return Response::setResponse([
                'info' => $err->getMessage(),
                'status' => 'erro'
            ], 401);
        }
    }

    public function login($email, $senha) {
        $user = $this->findOne('email', $email);
        if($user) {

            $passwordVerify = password_verify($senha, $user['senha']);

            if($passwordVerify) {

                $_SESSION['info_user'] = $user;

                return Response::setResponse([
                    'info' => 'Logando...',
                    'status' => 'sucesso',
                ], 201);
            }else {
                return Response::setResponse([
                    'info' => 'Usuario ou senha invalido',
                    'status' => 'erro'
                ], 201);
            }

        }else {
            return Response::setResponse([
                'info' => 'Usuario ou senha invalido',
                'status' => 'erro'
            ], 201);
        }
        
    }

    public function logout() {
        if(isset($_SESSION['info_user'])) {

            unset($_SESSION['info_user']);
            
            session_destroy();
            
            return Response::setResponse([
                'info' => 'Até mais',
                'status' => 'sucesso'
            ], 200);
        } else {
            return Response::setResponse([
                'info' => 'Usuário não está logado',
                'status' => 'erro'
            ], 400);
        }
    }

    public function findOne($param, $value) {

        $user = "SELECT * FROM cad_user WHERE $param = :q";

        $stmt = $this->conn->prepare($user);

        try {
            $stmt->bindValue(':q', $value);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (\PDOException $err) {
            return $err->getMessage();
        }

    }


}


?>