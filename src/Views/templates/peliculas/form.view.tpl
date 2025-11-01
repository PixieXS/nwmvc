<section class="container">
    <section class="depth=2">
        <h2>{{modeDsc}}</h2>
    </section>

    {{if hasErrores}}
    <ul class="error">
        {{foreach errores}}
            <li>{{this}}</li>
        {{endfor errores}}
    </ul>
    {{endif hasErrores}}

    <form action="index.php?page=Pelicula&mode={{mode}}&id_pelicula={{id_pelicula}}" method="post">
        <div>
            <label for="id_pelicula">ID Película</label>
            <input type="text" name="id_pelicula" id="id_pelicula" value="{{id_pelicula}}" />
        </div>

        <div>
            <label for="titulo">Título</label>
            <input type="text" name="titulo" id="titulo" value="{{titulo}}" required />
        </div>

        <div>
            <label for="director">Director</label>
            <input type="text" name="director" id="director" value="{{director}}" />
        </div>

        <div>
            <label for="ano_estreno">Año de Estreno</label>
            <input type="number" name="ano_estreno" id="ano_estreno" value="{{ano_estreno}}" min="1800" max="2100" />
        </div>

        <div>
            <label for="genero">Género</label>
            <input type="text" name="genero" id="genero" value="{{genero}}" />
        </div>

        <div>
            <label for="duracion_min">Duración (min)</label>
            <input type="number" name="duracion_min" id="duracion_min" value="{{duracion_min}}" min="1" />
        </div>

        <div>
            <button id="btnCancelar">Cancelar</button> 
            <button id="btnConfirmar" type="submit">Confirmar</button>
        </div>
    </form>
</section>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const btnCancelar = document.getElementById("btnCancelar");
        btnCancelar.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            window.location.assign("index.php?page=Peliculas-Peliculas");
        });
    });
</script>
