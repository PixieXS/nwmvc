<?php

namespace Controllers\Mantenimientos;

use Controllers\PublicController;
use Utilities\Site;
use Views\Renderer;
use Exception;
const ClientesList = "index.php?page=Mantenimientos-Clientes";
const ClientView = "mantenimientos/clientes/form";

class Cliente extends PublicController 
{

    private $modes = [
    "INS" => "Nuevo Cliente",
    "UPD" => "Editando %s",
    "DSP" => "Detalle de %s",
    "DEL" => "Eliminando %s"
    ];

    private string $mode = '';

    /*
    1) Determinar cómo se llama este controlador (Modo): INS, UPD, DSP, DEL
    2) Obtener el registro desde el Modelo de Datos
    3) Si es un postback, capturar los datos del formulario:
    3.1) Validar los datos del formulario
    3.2) Aplicar el método según el modo de la acción en la base de datos
    3.3) Enviar de vuelta con mensaje a la lista
    4) Preparar los datos para la vista
    5) Renderizar la vista

    */
    public function run() :void
    {
        try {
        $this->page_init();

        Renderer::render(ClientView,$this->preparar_datos_vista());

        } catch (Exception $ex)  {
            error_log($ex->getMessage());
            Site::redirectToWithMsg(ClientesList, "Sucedio Un Problema. Reintente Nuevamente." );
    }
}

   private function page_init() {
     if (isset($_GET["mode"]) && isset($this->modes[$_GET["mode"]])) {
        $this->mode = $_GET["mode"];
    } else {
        throw new Exception("Valor De Mode No Es Valido");
        }
}

    private function preparar_datos_vista() {
        $viewData = [];
         $viewData["mode"] = $this->mode;
         return $viewData;

    }
}