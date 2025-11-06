<?php

namespace Controllers\Incidentes;

use Controllers\PublicController;
use Utilities\Site;
use Dao\Incidentes\Incidentes as DAOIncidentes;
use Utilities\Validators;
use Views\Renderer;
use Exception;

const IncidentesList = "index.php?page=Incidentes-Incidentes";
const IncidentesView = "incidentes/form";

class Incidente extends PublicController 
{
    private array $errores = []; 

    private $modes = [
        "INS" => "Nuevo Incidente",
        "UPD" => "Editando %s",
        "DSP" => "Detalle de %s",
        "DEL" => "Eliminando %s"
    ];

    private string $mode = '';
    private string $id = '';
    private string $estudiante_nombre = '';
    private string $fecha_incidente = '';
    private string $tipo_incidente = '';
    private string $descripcion = '';
    private string $accion_tomada = '';
    private string $estado = '';

    private string $validationToken = "";

    public function run(): void
    {
        try {
            $this->page_init();

            if($this->isPostBack()) {
                $this->errores = $this->validarPostData();

                if(count($this->errores) === 0) {
                    try {
                    switch($this->mode) {
                        case "INS":
                            // Llamar a Dao para insertar
                            $affectedRows = DAOIncidentes::crearIncidente(
                                  $this->id,
                                  $this->estudiante_nombre,
                                  $this->fecha_incidente,
                                  $this->tipo_incidente,
                                  $this->descripcion,
                                  $this->accion_tomada,
                                  $this->estado
                             );
                            if($affectedRows > 0){
                                Site::redirectToWithMsg(IncidentesList, "Nuevo Incidente Creado Satisfactoriamente");
                            }
                            break;
                        case "UPD":
                            // Llamar a Dao para actualizar
                             $affectedRows = DAOIncidentes::actualizarIncidente(
                                  $this->id,
                                  $this->estudiante_nombre,
                                  $this->fecha_incidente,
                                  $this->tipo_incidente,
                                  $this->descripcion,
                                  $this->accion_tomada,
                                  $this->estado
                             );
                            if($affectedRows > 0){
                                Site::redirectToWithMsg(IncidentesList, "Incidente Actualizado Satisfactoriamente");
                            }
                            break;
                        case "DEL":
                            // Llamar a Dao para eliminar
                             $affectedRows = DAOIncidentes::eliminarIncidente(
                                  $this->id
                             );
                            if($affectedRows > 0){
                                Site::redirectToWithMsg(IncidentesList, "Incidente Eliminado Satisfactoriamente");
                            }
                            break;
                        }
                    } catch (Exception $err){
                        error_log($err, 0);
                    }
                }
            }

            Renderer::render(IncidentesView, $this->preparar_datos_vista());

        } catch (Exception $ex) {
            error_log($ex->getMessage());
            Site::redirectToWithMsg(IncidentesList, "Sucedió un problema. Reintente nuevamente.");
        }
    }

    private function page_init(): void
    {
        // Validar que venga un modo y sea válido
        if (!isset($_GET["mode"]) || !isset($this->modes[$_GET["mode"]])) {
            throw new Exception("Valor de mode no es válido");
        }

        $this->mode = $_GET["mode"];

        if ($this->mode !== "INS") {
            if (!isset($_GET["id"]) || empty($_GET["id"])) {
                throw new Exception("ID no es válido");
            }

            $tmpid= $_GET["id"];
            
            $tmpIncidente = DAOIncidentes::obtenerIncidentePorCodigo($tmpid);
            if (!$tmpIncidente) {
                throw new Exception("No se encontró registro");
            }

            $this->id = $tmpIncidente["id"];
            $this->estudiante_nombre = $tmpIncidente["estudiante_nombre"];
            $this->fecha_incidente  = $tmpIncidente["fecha_incidente"];
            $this->tipo_incidente = $tmpIncidente["tipo_incidente"];
            $this->descripcion = $tmpIncidente["descripcion"];
            $this->accion_tomada = $tmpIncidente["accion_tomada"];
            $this->estado = $tmpIncidente["estado"];
        }
    }

    private function validarPostData(): array
    {
        $errors = [];

        $this->validationToken = $_POST["vlt"] ?? "";

        if(isset( $_SESSION[$this->name."_token"]) &&  $_SESSION[$this->name."_token"] !== $this->validationToken)
        {
            throw new Exception("Error De Validacion De Token");
        }

        $this->id = $_POST["id"] ?? 0;
        $this->estudiante_nombre = $_POST["estudiante_nombre"] ?? '';
        $this->fecha_incidente = $_POST["fecha_incidente"] ?? '';
        $this->tipo_incidente = $_POST["tipo_incidente"] ?? '';
        $this->descripcion  = $_POST["descripcion"] ?? '';
        $this->accion_tomada = ($_POST["accion_tomada"] ?? '');
        $this->estado  = $_POST["estado"] ?? 'Abierto';

        // Validaciones básicas
        if(Validators::IsEmpty($this->estudiante_nombre)) {
            $errors[] = "Nombre no puede ir vacío";
        }

        if(!in_array($this->estado, ["Abierto", "Cerrado"])) {
            $errors[] = "Estado incorrecto";
        }

        return $errors;
    }


    private function generarTokenDeValidacion()
    {
        $this->validationToken = md5(gettimeofday(true).$this->name.rand(1000, 9999));
        $_SESSION[$this->name."_token"] = $this->validationToken;
    }

    private function preparar_datos_vista(): array
    {
        $viewData = [];
        $viewData["mode"] = $this->mode;
        $viewData["modeDsc"] = $this->modes[$this->mode];

        if($this->mode !== "INS") {
            $viewData["modeDsc"] = sprintf($viewData["modeDsc"], $this->estudiante_nombre);
        }

        $viewData["id"] = $this->id;
        $viewData["estudiante_nombre"] = $this->estudiante_nombre;
        $viewData["fecha_incidente"] = $this->fecha_incidente;
        $viewData["tipo_incidente"] = $this-> tipo_incidente;
        $viewData["descripcion"] = $this->descripcion;
        $viewData["accion_tomada"] = $this->accion_tomada;
        $viewData["estado"] = $this->estado;

        $this->generarTokenDeValidacion();
        $viewData["token"]  = $this->validationToken;

        $viewData["errores"] = $this->errores;
        $viewData["hasErrores"] = count($this->errores) > 0;

        $viewData["ocultarID"] = $this->mode === "INS";
        
        $viewData["idReadonly"] = $this->mode !=="INS" ? "readonly":"";

        $viewData["readonly"] = in_array($this->mode, ["DSP","DEL"]) ? "readonly":"";

        $viewData["isDisplay"] = $this->mode === "DSP";

        $viewData["selected"][$this->estado] = "selected";
        
        
        return $viewData;
    }
}
