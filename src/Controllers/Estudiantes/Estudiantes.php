<?php

namespace Controllers\Estudiantes;

use Controllers\PublicController;

use Dao\Dao;

use Views\Renderer;

use Dao\EstudiantesCC\Estudiantes as EstudianteDAO;

class Estudiantes extends PublicController {

    public function run() :void
    {
    $viewData = [];
    $viewData["estudiantes"] = EstudianteDAO::obtenerEstudiante();

    Renderer::render("estudiantes/lista", $viewData);
    }
}