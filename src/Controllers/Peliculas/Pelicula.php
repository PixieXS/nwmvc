<?php

namespace Controllers\Peliculas;

use Controllers\PublicController;
use Utilities\Site;
use Utilities\Validators;
use Views\Renderer;
use Exception;
use Dao\Peliculas\Peliculas as DAOPeliculas;

const PeliculasList = "index.php?page=Peliculas";
const PeliculaView = "peliculas/form";

class Pelicula extends PublicController
{
    private array $errores = [];

    private $modes = [
        "INS" => "Nueva Película",
        "UPD" => "Editando %s",
        "DSP" => "Detalle de %s",
        "DEL" => "Eliminando %s"
    ];

    private string $mode = '';
    private int $id_pelicula = 0;
    private string $titulo = '';
    private string $director = '';
    private int $ano_estreno = 0;
    private string $genero = '';
    private int $duracion_min = 0;

    public function run(): void
    {
        try {
            $this->page_init();

            if ($this->isPostBack()) {
                $this->errores = $this->validarPostData();

                if (count($this->errores) === 0) {
                    switch ($this->mode) {
                        case "INS":
                            DAOPeliculas::insertarPelicula([
                                "titulo" => $this->titulo,
                                "director" => $this->director,
                                "ano_estreno" => $this->ano_estreno,
                                "genero" => $this->genero,
                                "duracion_min" => $this->duracion_min
                            ]);
                            Site::redirectToWithMsg(PeliculasList, "Película agregada correctamente.");
                            break;

                        case "UPD":
                            DAOPeliculas::actualizarPelicula($this->id_pelicula, [
                                "titulo" => $this->titulo,
                                "director" => $this->director,
                                "ano_estreno" => $this->ano_estreno,
                                "genero" => $this->genero,
                                "duracion_min" => $this->duracion_min
                            ]);
                            Site::redirectToWithMsg(PeliculasList, "Película actualizada correctamente.");
                            break;

                        case "DEL":
                            DAOPeliculas::eliminarPelicula($this->id_pelicula);
                            Site::redirectToWithMsg(PeliculasList, "Película eliminada correctamente.");
                            break;
                    }
                }
            }

            Renderer::render(PeliculaView, $this->preparar_datos_vista());
        } catch (Exception $ex) {
            error_log($ex->getMessage());
            Site::redirectToWithMsg(PeliculasList, "Ocurrió un problema. Inténtelo de nuevo.");
        }
    }

    private function page_init(): void
    {
        if (!isset($_GET["mode"]) || !isset($this->modes[$_GET["mode"]])) {
            throw new Exception("Modo no válido");
        }

        $this->mode = $_GET["mode"];

        if ($this->mode !== "INS") {
            if (!isset($_GET["id_pelicula"]) || empty($_GET["id_pelicula"])) {
                throw new Exception("ID de película no válido");
            }

            $tmpId = intval($_GET["id_pelicula"]);
            $tmpPelicula = DAOPeliculas::obtenerPeliculaPorId($tmpId);

            if (!$tmpPelicula) {
                throw new Exception("Película no encontrada");
            }

            $this->id_pelicula = $tmpPelicula["id_pelicula"];
            $this->titulo = $tmpPelicula["titulo"];
            $this->director = $tmpPelicula["director"];
            $this->ano_estreno = $tmpPelicula["ano_estreno"];
            $this->genero = $tmpPelicula["genero"];
            $this->duracion_min = $tmpPelicula["duracion_min"];
        }
    }

    private function validarPostData(): array
    {
        $errors = [];

        $this->id_pelicula = intval($_POST["id_pelicula"] ?? 0);
        $this->titulo = trim($_POST["titulo"] ?? '');
        $this->director = trim($_POST["director"] ?? '');
        $this->ano_estreno = intval($_POST["ano_estreno"] ?? 0);
        $this->genero = trim($_POST["genero"] ?? '');
        $this->duracion_min = intval($_POST["duracion_min"] ?? 0);

        if (Validators::IsEmpty($this->titulo)) {
            $errors[] = "El título no puede ir vacío.";
        }

        if ($this->ano_estreno <= 1800 || $this->ano_estreno > intval(date("Y")) + 1) {
            $errors[] = "Año de estreno inválido.";
        }

        if ($this->duracion_min <= 0) {
            $errors[] = "Duración debe ser mayor que 0.";
        }

        return $errors;
    }

    private function preparar_datos_vista(): array
    {
        $viewData = [];
        $viewData["mode"] = $this->mode;
        $viewData["modeDsc"] = $this->modes[$this->mode];

        if ($this->mode !== "INS") {
            $viewData["modeDsc"] = sprintf($viewData["modeDsc"], $this->titulo);
        }

        $viewData["id_pelicula"] = $this->id_pelicula;
        $viewData["titulo"] = $this->titulo;
        $viewData["director"] = $this->director;
        $viewData["ano_estreno"] = $this->ano_estreno;
        $viewData["genero"] = $this->genero;
        $viewData["duracion_min"] = $this->duracion_min;

        $viewData["errores"] = $this->errores;
        $viewData["hasErrores"] = count($this->errores) > 0;

        return $viewData;
    }
}
