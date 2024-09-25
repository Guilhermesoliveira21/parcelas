<?php 

require_once MODEL . "admin/Admin.php";
class OrmDB extends Admin {

    private $conn;
    private $table;
    private $where;

    protected function __construct() {
        $this->conn = $this->connect();
        var_dump($this->conn);
    }

    protected function setTable($table) {
        $this->table = $table;
    }

    protected function create_sql(array $data) {

        $keys = implode(', ', array_keys($data));
        $keyC = ':'.implode(', :', array_keys($data));

        $table = $this->table;

        $query = "INSERT INTO $table ($keys) VALUES($keyC)";

        $con = $this->connect();

        try {
            $stmt = $con->prepare($query);
            $this->setParams($stmt, $data);
            if($stmt->execute()) {
                return true;
            }else {
                return false;
            }
        } catch (\PDOException $err) {
            return false;
        }
    
    }
    
    protected function findAll(array $where = null, $like = false) {
        $query = "SELECT * FROM $this->table";
    
        if (isset($where)) {
            if (count($where) > 0) {
                $conditions = [];
                foreach ($where as $key => $value) {
                    if ($like) {
                        $conditions[] = "$key LIKE :$key";
                    } else {
                        $conditions[] = "$key = :$key";
                    }
                }
                $query .= " WHERE " . implode(' AND ', $conditions);
            }
        }
        
        $con = $this->connect();
        try {
            $stmt = $con->prepare($query);
            
            if (isset($where)) {
                $this->setParams($stmt, $where);
            }
    
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $erro) {
            return $erro->getMessage();
        }
    }

    protected function query($sql) {

        $query = $sql;

        $conn = $this->connect();

        try {
            $stmt = $conn->prepare($query);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    protected function deleteByUserId(int $userId) {
        $query = "DELETE FROM $this->table WHERE user_id LIKE :user_id";
    
        $conn = $this->connect();
    
        try {
            $stmt = $conn->prepare($query);
            $stmt->bindValue(':user_id', "%$userId%", \PDO::PARAM_STR); 
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $th) {
            return false;
        }
    }

    protected function update(array $data, array $where) {
        $query = "UPDATE $this->table SET ";
        $sets = [];
    
        foreach ($data as $key => $value) {
            $sets[] = "$key = :$key";
        }
        $query .= implode(', ', $sets);
    
        if (count($where) > 0) {
            $conditions = [];
            foreach ($where as $key => $value) {
                $conditions[] = "$key = :where_$key";
            }
            $query .= " WHERE " . implode(' AND ', $conditions);
        }
    
        try {
            $stmt = $this->conn->prepare($query);
    
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
    
            foreach ($where as $key => $value) {
                $stmt->bindValue(":where_$key", $value);
            }
    
            $stmt->execute();
            return true;
        } catch (\PDOException $erro) {
            return $erro->getMessage();
        }
    }


    private function setParams($stmt, array $params) {

        foreach ($params as $key => $param) {
            $stmt->bindValue(":$key", $param);
        }

    }

}

?>