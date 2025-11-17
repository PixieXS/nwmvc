<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Formulario De Estudiantes Ciencias Computacionales</title>
</head>
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
    background-color: #f4f4f9;
    color: #333;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 2rem auto;
    background-color: #fff;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.container h2 {
    margin-bottom: 1.5rem;
    color: #1a73e8;
    font-size: 1.8rem;
    text-align: center;
}

.error {
    background-color: #f8d7da;
    color: #721c24;
    padding: 1rem;
    border-radius: 5px;
    list-style: none;
    margin-bottom: 1rem;
}

.error li {
    margin-bottom: 0.5rem;
}

form div {
    margin-bottom: 1rem;
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 0.3rem;
    font-weight: bold;
    font-size: 0.95rem;
}

input[type="text"],
input[type="date"],
select {
    padding: 0.5rem;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 0.95rem;
}

input[readonly] {
    background-color: #e9ecef;
    cursor: not-allowed;
}

.actions {
    display: flex;
    justify-content: flex-end;
    gap: 0.5rem;
}

button {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 5px;
    font-size: 0.95rem;
    cursor: pointer;
}

#btnCancelar {
    background-color: #6c757d;
    color: #fff;
}

#btnCancelar:hover {
    background-color: #5a6268;
}

#btnConfirmar {
    background-color: #28a745;
    color: #fff;
}

#btnConfirmar:hover {
    background-color: #218838;
}

@media (max-width: 480px) {
    .container {
        padding: 1rem;
        margin: 1rem;
    }
    
    .actions {
        flex-direction: column;
        align-items: stretch;
    }

    button {
        width: 100%;
    }
}

</style>
<body>
<section class="container">
  <h2>{{modeDsc}}</h2>

  {{if hasErrores}}
  <ul class="error">
    {{foreach errores}}
      <li>{{this}}</li>
    {{endfor errores}}
  </ul>
  {{endif hasErrores}}

  <form action="index.php?page=Estudiantes-Estudiante&mode={{mode}}&id_estudiante={{id_estudiante}}" method="post">
    <div>
      {{ifnot ocultarID}}
      <label for="id_estudiante">ID</label>
      <input type="number" name="id_estudiante" id="id_estudiante" value="{{id_estudiante}}" {{idReadonly}} />
      {{endifnot ocultarID}}
      <input type="hidden" name="vlt" value="{{token}}">
    </div>
    <div>
      <label for="nombre">Nombre</label>
      <input type="text" name="nombre" id="nombre" value="{{nombre}}" {{readonly}}/>
    </div>
    <div>
      <label for="apellido">Apellido</label>
      <input type="text" name="apellido" id="apellido" value="{{apellido}}" {{readonly}}/>
    </div>
    <div>
      <label for="edad">Edad</label>
      <input type="text" name="edad" id="edad " value="{{edad}}" {{readonly}}/>
    </div>
    <div>
      <label for="especialidad">Especialidad</label>
      <input type="text" name="especialidad" id="especialidad" value="{{especialidad}}" {{readonly}}/>
    </div>

    <div class="actions">
      <button id="btnCancelar">Cancelar</button>
      {{ifnot isDisplay}} 
      <button id="btnConfirmar" type="submit">Confirmar</button>
      {{endifnot isDisplay}}
    </div>
  </form>
</section>

<script>
document.addEventListener("DOMContentLoaded", () => {
  document.getElementById("btnCancelar").addEventListener("click", (e) => {
    e.preventDefault();
    e.stopPropagation();
    window.location.assign("index.php?page=Estudiantes-Estudiantes");
  });
});
</script>

</body>
</html>
