<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Incidentes</title>
</head>
<body>
    <section class="py-4 px-4depth-2">
        <h2>Listado De Incidentes</h2>
    </section>

    <section class="WWList">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Estudiante</th>
                    <th>Fecha Incidente</th>
                    <th>Tipo Incidente</th>
                    <th>Descripcion</th>
                    <th>Accion Tomada </th>
                    <th>Estado</th>
                    <th><a href="index.php?page=Incidentes-Incidente&mode=INS">Agregar Nuevo</a></th>
                </tr>
            </thead>
            <tbody>
                {{foreach incidentes}}
                <tr>
                    <td>{{id}}</td>
                    <td>{{estudiante_nombre}}</td>
                    <td>{{fecha_incidente}}</td>
                    <td>{{tipo_incidente}}</td>
                    <td>{{descripcion}}</td>
                    <td>{{accion_tomada}}</td>
                    <td>{{estado}}</td>
                    <td>
                        <a href="index.php?page=Incidentes-Incidente&mode=UPD&id={{id}}">Editar</a>&nbsp;
                        <a href="index.php?page=Incidentes-Incidente&mode=DEL&id={{id}}">Eliminar</a>&nbsp;
                        <a href="index.php?page=Incidentes-Incidente&mode=DSP&id={{id}}">Ver</a>
                    </td>
                </tr>
                {{endfor incidentes}}
            </tbody>
        </table>
    </section>
</body>
</html>
