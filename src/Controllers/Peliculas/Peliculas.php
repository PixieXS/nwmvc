<?php

namespace Controllers\Peliculas;

use Controllers\PublicController;
use Views\Renderer;
use Dao\Peliculas\Peliculas as DAOPelicula;

class Peliculas extends PublicController
{
   public function run(): void
{
    $viewData = [];
    $tmpPeliculas = DAOPelicula::obtenerPeliculas();
    $viewData["peliculas"] = $tmpPeliculas; 
    $viewData["total"] = count($tmpPeliculas);

    Renderer::render("peliculas/lista", $viewData);
}

}
