<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado De Estudiantes Ciencias Computacionales</title>
</head>
<style>
    body {
    font-family: Arial, Helvetica, sans-serif;
    background-color: #f4f4f9;
    color: #333;
    margin: 0;
    padding: 0;
}

.py-4 {
    padding-top: 1rem;
    padding-bottom: 1rem;
}

.px-4depth-2 {
    padding-left: 1rem;
    padding-right: 1rem;
    background-color: #ffffff;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    border-radius: 8px;
    margin: 1rem auto;
    max-width: 95%;
}

.py-4 h2 {
    margin: 0;
    font-size: 1.8rem;
    color: #1a73e8;
}

.WWList {
    overflow-x: auto;
    margin: 1rem auto;
    max-width: 95%;
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    border-radius: 8px;
    overflow: hidden;
}

thead {
    background-color: #1a73e8;
    color: #fff;
}

thead th {
    padding: 0.75rem;
    text-align: left;
    font-weight: bold;
    font-size: 0.95rem;
}

tbody tr {
    border-bottom: 1px solid #ddd;
}

tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

tbody td {
    padding: 0.65rem;
    font-size: 0.9rem;
}

tbody td a {
    color: #1a73e8;
    text-decoration: none;
    font-weight: bold;
    margin-right: 0.5rem;
}

tbody td a:hover {
    text-decoration: underline;
}

thead th a {
    display: inline-block;
    padding: 0.3rem 0.6rem;
    background-color: #28a745;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-size: 0.85rem;
}

thead th a:hover {
    background-color: #218838;
}

@media (max-width: 768px) {
    table, thead, tbody, th, td, tr {
        display: block;
    }
    thead tr {
        display: none;
    }
    tbody tr {
        margin-bottom: 1rem;
        border-bottom: 2px solid #eee;
        padding: 0.5rem;
    }
    tbody td {
        padding-left: 50%;
        position: relative;
        text-align: left;
    }
    tbody td::before {
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 45%;
        padding-left: 0.5rem;
        font-weight: bold;
        white-space: nowrap;
    }
}

</style>
<body>
    <section class="py-4 px-4depth-2">
        <h2>Listado De Estudiantes Ciencias Computacionales</h2>
    </section>
    <section class="WWList">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Edad</th>
                    <th>Especialidad</th>
                    <th><a href="index.php?page=Estudiantes-Estudiante&mode=INS">Agregar Nuevo</a></th>
                </tr>
            </thead>
            <tbody>
                {{foreach estudiantes}}
                <tr>
                    <td>{{id_estudiante}}</td>
                    <td>{{nombre}}</td>
                    <td>{{apellido}}</td>
                    <td>{{edad}}</td>
                    <td>{{especialidad}}</td>
                    <td>
                        <a href="index.php?page=Estudiantes-Estudiante&mode=UPD&id_estudiante={{id_estudiante}}">Editar</a>&nbsp;
                        <a href="index.php?page=Estudiantes-Estudiante&mode=DEL&id_estudiante={{id_estudiante}}">Eliminar</a>&nbsp;
                        <a href="index.php?page=Estudiantes-Estudiante&mode=DSP&id_estudiante={{id_estudiante}}">Ver</a>
                    </td>
                </tr>
                {{endfor estudiantes}}
            </tbody>
        </table>
    </section>
</body>
</html>
