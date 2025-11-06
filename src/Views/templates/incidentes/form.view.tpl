<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Formulario de Indicente</title>

</head>
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
        <option value="Abierto" {{selectedACT}}>Abierto</option>
        <option value="Cerrado" {{selectedINA}}>Cerrado</option>
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
