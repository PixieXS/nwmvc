<?php

namespace Dao\Peliculas;

use Dao\Table;

class Peliculas extends Table
{
    public static function obtenerPeliculas(): array
    {
        $sqlstr = "SELECT id_pelicula, titulo, director, ano_estreno, genero, duracion_min FROM Peliculas;";
        return self::obtenerRegistros($sqlstr, []);
    }

    public static function obtenerPeliculaPorId(int $id_pelicula): array
    {
        $sqlstr = "SELECT id_pelicula, titulo, director, ano_estreno, genero, duracion_min FROM Peliculas WHERE id_pelicula = :id_pelicula;";
        return self::obtenerUnRegistro($sqlstr, ["id_pelicula" => $id_pelicula]);
    }

    public static function insertarPelicula(array $data): bool
    {
        $sqlstr = "INSERT INTO Peliculas (titulo, director, ano_estreno, genero, duracion_min)
                   VALUES (:titulo, :director, :ano_estreno, :genero, :duracion_min);";

        return self::ejecutarNonQuery($sqlstr, [
            "titulo"       => $data["titulo"],
            "director"     => $data["director"],
            "ano_estreno"  => $data["ano_estreno"],
            "genero"       => $data["genero"],
            "duracion_min" => $data["duracion_min"]
        ]);
    }

    public static function actualizarPelicula(int $id_pelicula, array $data): bool
    {
        $sqlstr = "UPDATE Peliculas
                   SET titulo = :titulo,
                       director = :director,
                       ano_estreno = :ano_estreno,
                       genero = :genero,
                       duracion_min = :duracion_min
                   WHERE id_pelicula = :id_pelicula;";

        return self::ejecutarNonQuery($sqlstr, [
            "id_pelicula"  => $id_pelicula,
            "titulo"       => $data["titulo"],
            "director"     => $data["director"],
            "ano_estreno"  => $data["ano_estreno"],
            "genero"       => $data["genero"],
            "duracion_min" => $data["duracion_min"]
        ]);
    }

    public static function eliminarPelicula(int $id_pelicula): bool
    {
        $sqlstr = "DELETE FROM Peliculas WHERE id_pelicula = :id_pelicula;";
        return self::ejecutarNonQuery($sqlstr, ["id_pelicula" => $id_pelicula]);
    }
}
