<section class="py-4 px-4 depth-2">
    <h2>Listado de Películas</h2>
</section>

<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Director</th>
                <th>Año</th>
                <th>Género</th>
                <th>Duración (min)</th>
                <th>
                    <a href="index.php?page=Peliculas-Pelicula&mode=INS">Nueva</a>
                </th>
            </tr>
        </thead>
        <tbody>
            {{foreach peliculas}}
            <tr>
                <td>{{id_pelicula}}</td>
                <td>{{titulo}}</td>
                <td>{{director}}</td>
                <td>{{ano_estreno}}</td>
                <td>{{genero}}</td>
                <td>{{duracion_min}}</td>
                <td>
                    <a href="index.php?page=Peliculas-Pelicula&mode=UPD&id_pelicula={{id_pelicula}}">Editar</a>&nbsp;
                    <a href="index.php?page=Peliculas-Pelicula&mode=DEL&id_pelicula={{id_pelicula}}">Eliminar</a>&nbsp;
                    <a href="index.php?page=Peliculas-Pelicula&mode=DSP&id_pelicula={{id_pelicula}}">Ver</a>
                </td>
            </tr>
            {{endfor peliculas}}
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="right">
                    Registros: {{total}}
                </td>
            </tr>
        </tfoot>
    </table>
</section>
