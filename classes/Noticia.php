<?php
class Noticia
{
    private $conn;
    private $table_name = "tb_noticias";
    private $table_usu = "usuarios";




    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function registrar($tituloNoticia, $fkIdAutor, $dataNoticia, $noticia, $foto)
    {
      
        $query = "INSERT INTO " . $this->table_name . " (titulo_noticia, fk_id_autor, data_noticia, noticia, foto) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$tituloNoticia, $fkIdAutor, $dataNoticia, $noticia, $foto]);
        return $stmt;
    }

    public function criar($tituloNoticia, $fkIdAutor, $dataNoticia, $noticia, $foto)
    {
        return $this->registrar($tituloNoticia, $fkIdAutor, $dataNoticia, $noticia, $foto);
    }

    public function ler()
    {
        $query = "SELECT * FROM " . $this->table_name . " AS noti JOIN " . $this->table_usu . " AS usu ON usu.id = noti.fk_id_autor ORDER BY data_noticia desc";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    public function lerPorId($pkIdNoticia)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE pk_id_noticia = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$pkIdNoticia]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function atualizar($pkIdNoticia, $tituloNoticia, $fkIdAutor, $dataNoticia, $noticia, $foto)
    {
        $query = "UPDATE " . $this->table_name . " SET titulo_noticia = ?, fk_id_autor = ?, data_noticia = ?, noticia = ?, foto = ? WHERE pk_id_noticia = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$tituloNoticia, $fkIdAutor, $dataNoticia, $noticia, $foto]);
        return $stmt;
    }


    public function deletarNoti($idNoti)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE pk_id_noticia = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idNoti]);
        return $stmt;
    }
}

// ALTERAÇÕES NECESSÁRIAS JÁ FORAM FEITAS NO ARQUIVO

?>
