<?php

namespace Controllers\Mantenimientos;

use Controllers\PublicController;
use Utilities\Site;
use Dao\Clientes\Clientes as DAOClientes;
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
    private string $codigo = '';
    private string $nombre = '';
    private string $direccion = '';
    private string $telefono = '';
    private string $correo = '';
    private string $estado = 'ACT';
    private int $evaluacion = 0;

    public function run(): void
    {
        try {
            $this->page_init();
            Renderer::render(ClientView, $this->preparar_datos_vista());
        } catch (Exception $ex)  {
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

        // Si no es un modo de insertar, necesitamos un código
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

            // Mapear los datos a las propiedades del controlador
            $this->codigo = $tmpCliente["codigo"];
            $this->nombre = $tmpCliente["nombre"];
            $this->direccion = $tmpCliente["direccion"];
            $this->telefono = $tmpCliente["telefono"];
            $this->correo = $tmpCliente["correo"];
            $this->estado = $tmpCliente["estado"];
            $this->evaluacion = $tmpCliente["evaluacion"];
        }
    }

    private function preparar_datos_vista(): array
    {
        return [
            "mode" => $this->mode,
            "codigo" => $this->codigo,
            "nombre" => $this->nombre,
            "direccion" => $this->direccion,
            "telefono" => $this->telefono,
            "correo" => $this->correo,
            "estado" => $this->estado,
            "evaluacion" => $this->evaluacion
        ];
    }
}
