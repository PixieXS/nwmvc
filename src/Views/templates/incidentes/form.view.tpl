<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Formulario de Indicente</title>
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

  <form action="index.php?page=Incidentes-Incidente&mode={{mode}}&id={{id}}" method="post">
    <div>
      {{ifnot ocultarID}}
      <label for="id">ID</label>
      <input type="text" name="id" id="id" value="{{id}}" {{idReadonly}} />
      {{endifnot ocultarID}}
      <input type="hidden" name="vlt" value="{{token}}">
    </div>
    <div>
      <label for="estudiante_nombre">Nombre Estudiante</label>
      <input type="text" name="estudiante_nombre" id="estudiante_nombre" value="{{estudiante_nombre}}" {{readonly}}/>
    </div>
    <div>
      <label for="fecha_incidente">Fecha Incidente</label>
      <input type="date" name="fecha_incidente" id="fecha_incidente" value="{{fecha_incidente}}" {{readonly}}/>
    </div>
    <div>
      <label for="tipo_incidente ">Tipo De Incidente</label>
      <input type="text" name="tipo_incidente" id="tipo_incidente " value="{{tipo_incidente}}" {{readonly}}/>
    </div>
    <div>
      <label for="descripcion">Descripcion</label>
      <input type="text" name="descripcion" id="descripcion" value="{{descripcion}}" {{readonly}}/>
    </div>

    <div>
      <label for="accion_tomada">Accion Tomada</label>
      <input type="text" name="accion_tomada" id="accion_tomada" value="{{accion_tomada}}" {{readonly}}/>
    </div>

    <div>
      <label for="estado">Estado</label>
      {{ifnot readonly}} 
      <select name="estado" id="estado">
        <option value="Abierto" {{selectedAbierto}}>Abierto</option>
        <option value="Cerrado" {{selectedCerrado}}>Cerrado</option>
      </select>
      {{endifnot readonly}} 
      {{if readonly}} 
      <input type="text" name="estado" id="estado" value="{{estado}}" {{readonly}}/>
      {{endif readonly}} 
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
    window.location.assign("index.php?page=Incidentes-Incidentes");
  });
});
</script>

</body>
</html>
