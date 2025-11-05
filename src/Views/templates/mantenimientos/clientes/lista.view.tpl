<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Clientes</title>
    <style>
        /* Estilo general del body */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Sección principal */
        .py-4.px-4depth-2 {
            background-color: #ffffff;
            padding: 20px 25px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-radius: 8px;
            margin: 20px auto;
            max-width: 1200px;
        }

        .py-4.px-4depth-2 h2 {
            margin: 0;
            font-size: 1.8rem;
            color: #1a202c;
            border-bottom: 2px solid #3182ce;
            padding-bottom: 8px;
        }

        /* Tabla */
        .WWList {
            max-width: 1200px;
            margin: 20px auto;
            overflow-x: auto;
        }

        .WWList table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        /* Cabecera de la tabla */
        .WWList table thead tr {
            background-color: #3182ce;
            color: #fff;
            text-align: left;
        }

        .WWList table th, 
        .WWList table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e2e8f0;
        }

        /* Filas alternas */
        .WWList table tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }

        /* Hover sobre filas */
        .WWList table tbody tr:hover {
            background-color: #e6f0fa;
        }

        /* Links de acción */
        .WWList table a {
            text-decoration: none;
            color: #3182ce;
            font-weight: 500;
            transition: 0.2s;
        }

        .WWList table a:hover {
            color: #2c5282;
            text-decoration: underline;
        }

        /* Pie de tabla */
        .WWList table tfoot tr td {
            font-weight: 600;
            background-color: #edf2f7;
        }

        /* Responsivo */
        @media screen and (max-width: 768px) {
            .WWList table th, .WWList table td {
                padding: 8px 10px;
                font-size: 0.9rem;
            }

            .py-4.px-4depth-2 h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <section class="py-4 px-4depth-2">
        <h2>Listado De Clientes</h2>
    </section>

    <section class="WWList">
        <table>
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Estado</th>
                    <th>Nota</th>
                    <th><a href="index.php?page=Mantenimientos-Cliente&mode=INS">Agregar Nuevo</a></th>
                </tr>
            </thead>
            <tbody>
                {{foreach clientes}}
                <tr>
                    <td>{{codigo}}</td>
                    <td>{{nombre}}</td>
                    <td>{{direccion}}</td>
                    <td>{{telefono}}</td>
                    <td>{{correo}}</td>
                    <td>{{estado}}</td>
                    <td>{{grade}} - {{nota}}</td>
                    <td>
                        <a href="index.php?page=Mantenimientos-Cliente&mode=UPD&codigo={{codigo}}">Editar</a>&nbsp;
                        <a href="index.php?page=Mantenimientos-Cliente&mode=DEL&codigo={{codigo}}">Eliminar</a>&nbsp;
                        <a href="index.php?page=Mantenimientos-Cliente&mode=DSP&codigo={{codigo}}">Ver</a>
                    </td>
                </tr>
                {{endfor clientes}}
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" class="right">
                        Registros: {{total}}
                    </td>
                    <td>
                        Nota Total: {{totalNota}}
                    </td>
                </tr>
            </tfoot>
        </table>
    </section>
</body>
</html>
