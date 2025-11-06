<?php

namespace Dao\Incidentes;

use Dao\Table;


class Incidentes extends Table {

    public static function obtenerIncidente(): array {

        $sqlstr = "SELECT * FROM incidentes_estudiantiles";
        return self::obtenerRegistros($sqlstr, []);

    }

    public static function obtenerIncidentePorCodigo(string $id): array 
    {

        $sqlstr = "SELECT * FROM incidentes_estudiantiles where id=:id";
        return self::obtenerUnRegistro($sqlstr,["id"=> $id]);

    }

    public static function crearIncidente(
        int $id,
        string $estudiante_nombre,
        string $fecha_incidente,
        string $tipo_incidente,
        string $descripcion,
        string $accion_tomada,
        string $estado

    ) 
    {
      $fecha_incidente = date('Y-m-d', strtotime($fecha_incidente));

      $insSql = "INSERT INTO incidentes_estudiantiles(id,estudiante_nombre,fecha_incidente,tipo_incidente,descripcion,accion_tomada,estado)
      values (:id,:estudiante_nombre,:fecha_incidente,:tipo_incidente,:descripcion,:accion_tomada,:estado);";

       $newInsertData = [
        "id" => $id,
        "estudiante_nombre" => $estudiante_nombre,
        "fecha_incidente" => $fecha_incidente,
        "tipo_incidente" => $tipo_incidente,
        "descripcion" => $descripcion,
        "accion_tomada" => $accion_tomada,
        "estado" => $estado
        ];

        return self::executeNonQuery($insSql,$newInsertData);

    }


     public static function actualizarIncidente(
        int $id,
        string $estudiante_nombre,
        string $fecha_incidente,
        string $tipo_incidente,
        string $descripcion,
        string $accion_tomada,
        string $estado
    ) 
    {
      $fecha_incidente = date('Y-m-d', strtotime($fecha_incidente));
      
      $updSql = "UPDATE incidentes_estudiantiles set estudiante_nombre=:estudiante_nombre, fecha_incidente=:fecha_incidente, tipo_incidente =:tipo_incidente , 
      descripcion=:descripcion, accion_tomada=:accion_tomada, estado=:estado
      where id = :id;";

       $newUpdateData = [
        "id" => $id,
        "estudiante_nombre" => $estudiante_nombre,
        "fecha_incidente" => $fecha_incidente,
        "tipo_incidente" => $tipo_incidente,
        "descripcion" => $descripcion,
        "accion_tomada" => $accion_tomada,
        "estado" => $estado
        ];

        return self::executeNonQuery($updSql, $newUpdateData);

    }

    public static function eliminarIncidente(string $id) 
    {
        $delSql = "DELETE from incidentes_estudiantiles where id=:id;";
        
        $delParams = [
            "id" => $id
        ];

         return self::executeNonQuery($delSql,$delParams);
    }
}