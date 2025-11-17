<?php

namespace Controllers\Estudiantes;

use Controllers\PublicController;
use Utilities\Site;
use Dao\EstudiantesCC\Estudiantes as DAOEstudiantes;
use Utilities\Validators;
use Views\Renderer;
use Exception;

const EstudiantesList = "index.php?page=Estudiantes-Estudiantes";
const EstudiantesView = "estudiantes/form";

class Estudiante extends PublicController 
{
    private array $errores = []; 

    private $modes = [
        "INS" => "Nuevo Estudiante",
        "UPD" => "Editando %s",
        "DSP" => "Detalle de %s",
        "DEL" => "Eliminando %s"
    ];

    private string $mode = '';
    private int $id_estudiante = 0;
    private string $nombre = '';
    private string $apellido= '';
    private int $edad = 0;
    private string $especialidad = '';

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
                            $affectedRows = DAOEstudiantes::crearEstudiante(
                                  $this->id_estudiante,
                                  $this->nombre,
                                  $this->apellido,
                                  $this->edad,
                                  $this->especialidad
                             );
                            if($affectedRows > 0){
                                Site::redirectToWithMsg(EstudiantesList, "Nuevo Estudiante Creado Satisfactoriamente");
                            }
                            break;
                        case "UPD":
                             $affectedRows = DAOEstudiantes::actualizarEstudiante(
                                  $this->id_estudiante,
                                  $this->nombre,
                                  $this->apellido,
                                  $this->edad,
                                  $this->especialidad
                             );
                            if($affectedRows > 0){
                                Site::redirectToWithMsg(EstudiantesList, "Estudiante Actualizado Satisfactoriamente");
                            }
                            break;
                        case "DEL":
                             $affectedRows = DAOEstudiantes::eliminarEstudiante(
                                  $this->id_estudiante
                             );
                            if($affectedRows > 0){
                                Site::redirectToWithMsg(EstudiantesList, "Estudiante Eliminado Satisfactoriamente");
                            }
                            break;
                        }
                    } catch (Exception $err){
                        error_log($err, 0);
                    }
                }
            }

            Renderer::render(EstudiantesView, $this->preparar_datos_vista());

        } catch (Exception $ex) {
            error_log($ex->getMessage());
            Site::redirectToWithMsg(EstudiantesList, "Sucedió un problema. Reintente nuevamente.");
        }
    }

    private function page_init(): void
    {
        if (!isset($_GET["mode"]) || !isset($this->modes[$_GET["mode"]])) {
            throw new Exception("Valor de mode no es válido");
        }

        $this->mode = $_GET["mode"];

        if ($this->mode !== "INS") {
            if (!isset($_GET["id_estudiante"]) || empty($_GET["id_estudiante"])) {
                throw new Exception("ID no es válido");
            }

            $tmpid= $_GET["id_estudiante"];
            
            $tmpEstudiante = DAOEstudiantes::obtenerEstudiantePorCodigo($tmpid);
            if (!$tmpEstudiante) {
                throw new Exception("No se encontró registro");
            }

            $this->id_estudiante = $tmpEstudiante["id_estudiante"];
            $this->nombre = $tmpEstudiante["nombre"];
            $this->apellido  = $tmpEstudiante["apellido"];
            $this->edad = $tmpEstudiante["edad"];
            $this->especialidad = $tmpEstudiante["especialidad"];
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

        $this->id_estudiante = $_POST["id_estudiante"] ?? 0;
        $this->nombre = $_POST["nombre"] ?? '';
        $this->apellido = $_POST["apellido"] ?? '';
        $this->edad = $_POST["edad"] ?? 0;
        $this->especialidad = $_POST["especialidad"] ?? '';

        if(Validators::IsEmpty($this->nombre)) {
            $errors[] = "Nombre no puede ir vacío";
        }

        if(Validators::IsEmpty($this->apellido)) {
            $errors[] = "Apellido no puede ir vacío";
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
            $viewData["modeDsc"] = sprintf($viewData["modeDsc"], $this->nombre . ' ' . $this->apellido);
        }

        $viewData["id_estudiante"] = $this->id_estudiante;
        $viewData["nombre"] = $this->nombre;
        $viewData["apellido"] = $this->apellido;
        $viewData["edad"] = $this-> edad;
        $viewData["especialidad"] = $this->especialidad;

        $this->generarTokenDeValidacion();
        $viewData["token"]  = $this->validationToken;

        $viewData["errores"] = $this->errores;
        $viewData["hasErrores"] = count($this->errores) > 0;

        $viewData["ocultarID"] = $this->mode === "INS";
        
        $viewData["idReadonly"] = $this->mode !=="INS" ? "readonly":"";

        $viewData["readonly"] = in_array($this->mode, ["DSP","DEL"]) ? "readonly":"";

        $viewData["isDisplay"] = $this->mode === "DSP";
                
        return $viewData;
    }
}
