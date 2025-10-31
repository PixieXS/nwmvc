<?php

namespace Controllers\Mantenimientos;

use Controllers\PublicController;
use Utilities\Site;
use Dao\Clientes\Clientes as DAOClientes;
use Utilities\Validators;
use Views\Renderer;
use Exception;

const ClientesList = "index.php?page=Mantenimientos-Clientes";
const ClientView = "mantenimientos/clientes/form";

class Cliente extends PublicController 
{
    private array $errores = []; // Inicializado para evitar Undefined property

    private $modes = [
        "INS" => "Nuevo Cliente",
        "UPD" => "Editando %s",
        "DSP" => "Detalle de %s",
        "DEL" => "Eliminando %s"
    ];

    private string $mode = '';
    private string $codigo = '';
    private string $nombre = '';
    private string $direccion = '';
    private string $telefono = '';
    private string $correo = '';
    private string $estado = '';
    private int $evaluacion = 0;

    public function run(): void
    {
        try {
            $this->page_init();

            if($this->isPostBack()) {
                $this->errores = $this->validarPostData();

                if(count($this->errores) === 0) {
                    switch($this->mode) {
                        case "INS":
                            // Llamar a Dao para insertar
                            break;
                        case "UPD":
                            // Llamar a Dao para actualizar
                            break;
                        case "DEL":
                            // Llamar a Dao para eliminar
                            break;
                    }
                }
            }

            Renderer::render(ClientView, $this->preparar_datos_vista());

        } catch (Exception $ex) {
            error_log($ex->getMessage());
            Site::redirectToWithMsg(ClientesList, "Sucedió un problema. Reintente nuevamente.");
        }
    }

    private function page_init(): void
    {
        // Validar que venga un modo y sea válido
        if (!isset($_GET["mode"]) || !isset($this->modes[$_GET["mode"]])) {
            throw new Exception("Valor de mode no es válido");
        }

        $this->mode = $_GET["mode"];

        // Si no es modo INS, necesitamos un código
        if ($this->mode !== "INS") {
            if (!isset($_GET["codigo"]) || empty($_GET["codigo"])) {
                throw new Exception("Código no es válido");
            }

            $tmpCodigo = $_GET["codigo"];
            
            // Obtener el cliente de la base de datos
            $tmpCliente = DAOClientes::obtenerClientePorCodigo($tmpCodigo);
            if (!$tmpCliente) {
                throw new Exception("No se encontró registro");
            }

            // Mapear datos a las propiedades
            $this->codigo = $tmpCliente["codigo"];
            $this->nombre = $tmpCliente["nombre"];
            $this->direccion = $tmpCliente["direccion"];
            $this->telefono = $tmpCliente["telefono"];
            $this->correo = $tmpCliente["correo"];
            $this->estado = $tmpCliente["estado"];
            $this->evaluacion = $tmpCliente["evaluacion"];
        }
    }

    private function validarPostData(): array
    {
        $errors = [];

        $this->codigo = $_POST["codigo"] ?? '';
        $this->nombre = $_POST["nombre"] ?? '';
        $this->direccion = $_POST["direccion"] ?? '';
        $this->telefono = $_POST["telefono"] ?? '';
        $this->correo = $_POST["correo"] ?? '';
        $this->estado = $_POST["estado"] ?? 'ACT';
        $this->evaluacion = intval($_POST["evaluacion"] ?? 0);

        // Validaciones básicas
        if(Validators::IsEmpty($this->nombre)) {
            $errors[] = "Nombre no puede ir vacío";
        }

        if(!in_array($this->estado, ["ACT", "INA"])) {
            $errors[] = "Estado incorrecto";
        }

        return $errors;
    }

    private function preparar_datos_vista(): array
    {
        $viewData = [];
        $viewData["mode"] = $this->mode;
        $viewData["modeDsc"] = $this->modes[$this->mode];

        if($this->mode !== "INS") {
            $viewData["modeDsc"] = sprintf($viewData["modeDsc"], $this->nombre);
        }

        $viewData["codigo"] = $this->codigo;
        $viewData["nombre"] = $this->nombre;
        $viewData["direccion"] = $this->direccion;
        $viewData["telefono"] = $this->telefono;
        $viewData["correo"] = $this->correo;
        $viewData["estado"] = $this->estado;
        $viewData["evaluacion"] = $this->evaluacion;

        $viewData["errores"] = $this->errores;
        $viewData["hasErrores"] = count($this->errores) > 0;

        return $viewData;
    }
}
