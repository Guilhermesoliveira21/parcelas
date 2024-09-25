<?php 

require_once MODEL . "admin/OrmDB.php";
class Response extends OrmDB{

    protected $user_id;

    public function __construct() {
        if(isset($_SESSION['info_user']['id'])) {
            $this->user_id = $_SESSION['info_user']['id'];
        }
    }

    public static function setResponse(array $response, int $code) {

        echo json_encode($response);
        http_response_code($code);

    }

}

?>