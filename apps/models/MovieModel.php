<?php

require_once "MainModel.php";

class MovieModel extends MainModel{
     
    function getPeliculas(){
        $query = $this->db->prepare('SELECT * FROM peliculas p INNER JOIN generos g
        ON p.id_genero = g.id_genero');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    } 
    function getPeliculaId($id){
        $query = $this->db->prepare('SELECT * FROM peliculas p INNER JOIN generos g
        ON p.id_genero = g.id_genero WHERE p.id=?'); 
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    function getPeliculaGen($gen){
        $query = $this->db->prepare('SELECT * FROM peliculas p INNER JOIN generos g
        ON p.id_genero = g.id_genero WHERE p.id_genero=?'); 
        $query->execute([$gen]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    //ABM;
    function insertMovie($titulo, $poster = null, $sinopsis, $año_lanzamiento, $id_genero){
        $pathImg = null;
        if ($poster) { 
            $pathImg = $this->posterPath($poster); 
        }

        $query = $this->db->prepare("INSERT INTO peliculas(titulo, poster, sinopsis, anio_lanzamiento, id_genero) VALUES(?, ?, ?, ?, ?)");
        $query->execute([$titulo, $pathImg, $sinopsis, $año_lanzamiento, $id_genero]);
    }
    function updateMovie($titulo, $poster = null, $sinopsis, $año_lanzamiento, $id_genero, $id){
        $pathImg = null;
        if ($poster) { $pathImg = $this->posterPath($poster); } 

        $query = $this->db->prepare("UPDATE peliculas SET titulo=?, poster= ?, sinopsis=?, anio_lanzamiento=?,  id_genero=? WHERE id=?");
        $query->execute([$titulo, $pathImg, $sinopsis, $año_lanzamiento, $id_genero, $id]);
    }
    function deleteMovie($id){
        $query = $this->db->prepare("DELETE FROM peliculas WHERE id=?");
        $query->execute([$id]);
    }
    private function posterPath($poster){
        $target = 'img/movies/' . uniqid() . '.jpg';
        move_uploaded_file($poster, $target);
        return $target;
    }

}
