<?php

require_once "MainModel.php";

class GenModel extends MainModel{
     
    function getGeneros(){
        $query = $this->db->prepare('SELECT * FROM generos'); 
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    function getGeneroId($id){
        $query = $this->db->prepare('SELECT * FROM generos WHERE id_genero=?'); 
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    function insertGenero($genero){
        $query = $this->db->prepare("INSERT INTO generos(genero) VALUES(?)");
        $query->execute([$genero]);
    }
    function updateGenero($genero, $id){
        $query = $this->db->prepare("UPDATE generos SET genero=? WHERE id_genero=?");
        $query->execute([$genero, $id]);
    }
    function deleteGenero($id){
        $query = $this->db->prepare("DELETE FROM generos WHERE id_genero=?");
        $query->execute([$id]);
    }
}