<?php

namespace Controllers\Incidentes;

use Controllers\PublicController;

use Dao\Dao;

use Views\Renderer;

use Dao\Incidentes\Incidentes as IncidenteDAO;

class Incidentes extends PublicController {

    public function run() :void
    {
    $viewData = [];
    $viewData["incidentes"] = IncidenteDAO::obtenerIncidente();

    Renderer::render("incidentes/lista", $viewData);
    }
}