<?php

class Noticias
{
    private $conn;

    private $table_name = "noticias";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function registrar($idusu, $data, $titulo, $noticia,$caminho)
    {
        $query = "INSERT INTO " . $this->table_name . " (idusu, data, titulo, noticia, caminho) VALUES (?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idusu, $data, $titulo, $noticia, $caminho]);
        return $stmt;
    }

    public function criar($idusu, $data, $titulo, $noticia,$caminho)
    {
        return $this->registrar($idusu, $data, $titulo, $noticia, $caminho);
    }

    public function ler()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function lerPorId($idnot)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE idnot=?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idnot]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function lerPorIdusu($idusu)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE idusu=?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idusu]);
        return $stmt;
    }

    public function atualizar( $idusu, $titulo, $noticia, $caminho, $idnot)
    {
        $query = "UPDATE " . $this->table_name . " SET idusu=?, titulo=?, noticia=?, caminho=? WHERE idnot=?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idusu, $titulo, $noticia,$caminho, $idnot]);
        return $stmt;
    }

    public function deletar($idnot)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE idnot=?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idnot]);
        return $stmt;
    }
}
