<?php

require_once "./apps/views/ApiView.php";
require_once "./apps/models/MovieModel.php";

class ApiController{
    private $apiView; 
    private $movieModel;

    function __construct(){
        $this->apiView = new ApiView();
        $this->movieModel = new MovieModel();
    }

    function obtenerMovies(){
        $movies = $this->movieModel->getPeliculas();
        return $this->apiView->response($movies, 200);
    }

    function obtenerMovie($params = null){
        $id = $params[':ID'];
        $movie = $this->movieModel->getPeliculaId($id);

        if ($movie) {
            $this->apiView->response($movie, 200);
        }else{
            $this->apiView->response("La tarea con el id=$id no existe", 404);
        }
    }
}