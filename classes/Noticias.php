<?php

class Noticias
{
    private $conn;

    private $table_name = "noticias"; 


    public function __construct($db){
        $this->conn = $db;
    }

    public function registrar($idusu, $data, $titulo, $noticia){
        $query = "INSERT INTO ".$this->table_name." (idusu, data, titulo, noticia) VALUES (?,?,?,?)";
        $stmt = $this->conn->prepare($query);       
        $stmt->execute([$idusu, $data, $titulo, $noticia]);

        return $stmt; 
    }
    
   

    public function atualizar($idnot, $idusu, $titulo, $noticia ){
        $query = "UPDATE ".$this->table_name." SET titulo=?, noticia=?, idnot=? WHERE idusu=?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute ([$titulo, $noticia, $idnot, $idusu]);
        return $stmt;
    }

    public function deletar($idnot){
        $query = "DELETE FROM ".$this->table_name." WHERE idnot=?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idnot]);
        return $stmt;
    }
    
  public function ler(){
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
         return $stmt;
    }
    
    // public function ler($search = "", $order_by = "") {
    //     $query = "SELECT * FROM usuario";
    //     $conditions = [];
    //     $params = [];

    //     if ($search) {
    //        $conditions[] = "(nome LIKE :search OR email LIKE :search)";
    //         $params[':search'] = '%' . $search . '%';
    //     }

    //     if ($order_by === 'nome') {
    //         $query .= " ORDER BY nome";
    //     } elseif ($order_by === 'sexo') {
    //         $query .= " ORDER BY sexo";
    //     }

    //     if (count($conditions) > 0) {
    //         $query .= " WHERE " . implode(' AND ', $conditions);
    //     }

    //     $stmt = $this->conn->prepare($query);
    //     $stmt->execute($params);
    //     return $stmt;
    // }

    
    public function lerPorId($id){
        $query = "SELECT * FROM ".$this->table_name." WHERE idnot=?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function lerPorIdusu($idusu){
        $query = "SELECT * FROM ".$this->table_name." WHERE idusu=?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idusu]);
        return $stmt;
    }
    public function criar($idusu, $data, $titulo, $noticia){
        return $this->registrar($idusu, $data, $titulo, $noticia);
    }
    public function gerarCodigoVerificacao($email) {
        $codigo =
        substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 10);
        $query = "UPDATE " . $this->table_name . " SET
        codigo_verificacao = ? WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$codigo, $email]);
        return ($stmt->rowCount() > 0) ? $codigo : false;
        }
        public function verificarCodigo($codigo) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE
            codigo_verificacao = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$codigo]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
            }
            public function redefinirSenha($codigo, $senha) {
                $query = "UPDATE " . $this->table_name . " SET senha = ?,
                codigo_verificacao = NULL WHERE codigo_verificacao = ?";
                $stmt = $this->conn->prepare($query);
                $hashed_password = password_hash($senha, PASSWORD_BCRYPT);
                $stmt->execute([$hashed_password, $codigo]);
                return $stmt->rowCount() > 0;
                }
    
}
?>