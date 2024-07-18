<?php

class Comentarios
{
    private $conn;

    private $table_name = "comentarios";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function registrar($idnot, $comentario, $data_envio)
    {
        $query = "INSERT INTO " . $this->table_name . " (idnot, comentario, data_envio) VALUES (?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idnot, $comentario, $data_envio]);
        return $stmt;
    }

    public function criar($comentario, $data_envio, $idnot)
    {
        return $this->registrar($comentario, $data_envio, $idnot);
    }

    public function ler()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function lerPorId($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE idnot=?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt;
    }

    public function atualizar($id, $comentario, $data_envio)
    {
        $query = "UPDATE " . $this->table_name . " SET comentario=?, data_envio=? WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$comentario, $data_envio, $id]);
        return $stmt;
    }

    public function deletar($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt;
    }
}
