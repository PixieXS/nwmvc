<?php

namespace Dao\EstudiantesCC;

use Dao\Table;


class Estudiantes extends Table {

    public static function obtenerEstudiante(): array {

        $sqlstr = "SELECT * FROM EstudianteCienciasComputacionales";
        return self::obtenerRegistros($sqlstr, []);

    }

    public static function obtenerEstudiantePorCodigo(string $id_estudiante): array 
    {

        $sqlstr = "SELECT * FROM EstudianteCienciasComputacionales where id_estudiante=:id_estudiante";
        return self::obtenerUnRegistro($sqlstr,["id_estudiante"=> $id_estudiante]);

    }

    public static function crearEstudiante(
        int $id_estudiante,
        string $nombre,
        string $apellido,
        int $edad,
        string $especialidad

    ) 
    {

      $insSql = "INSERT INTO EstudianteCienciasComputacionales(id_estudiante,nombre,apellido,edad,especialidad)
      values (:id_estudiante,:nombre,:apellido,:edad,:especialidad);";

       $newInsertData = [
        "id_estudiante" => $id_estudiante,
        "nombre" => $nombre,
        "apellido" => $apellido,
        "edad" => $edad,
        "especialidad" => $especialidad
        ];

        return self::executeNonQuery($insSql,$newInsertData);

    }


     public static function actualizarEstudiante(
        int $id_estudiante,
        string $nombre,
        string $apellido,
        int $edad,
        string $especialidad
    ) 
    {
      
      $updSql = "UPDATE EstudianteCienciasComputacionales set nombre=:nombre, apellido=:apellido, edad =:edad , 
      especialidad=:especialidad
      where id_estudiante = :id_estudiante;";

       $newUpdateData = [
        "id_estudiante" => $id_estudiante,
        "nombre" => $nombre,
        "apellido" => $apellido,
        "edad" => $edad,
        "especialidad" => $especialidad,
        ];

        return self::executeNonQuery($updSql, $newUpdateData);

    }

    public static function eliminarEstudiante(string $id_estudiante) 
    {
        $delSql = "DELETE from EstudianteCienciasComputacionales where id_estudiante=:id_estudiante;";
        
        $delParams = [
            "id_estudiante" => $id_estudiante
        ];

         return self::executeNonQuery($delSql,$delParams);
    }
}