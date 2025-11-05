<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Formulario de Cliente</title>
</head>
<body>
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f6f8;
    color: #333;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 40px auto;
    background-color: #ffffff;
    padding: 30px 40px;
    border-radius: 10px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

.container h2 {
    margin-bottom: 20px;
    font-size: 1.8rem;
    color: #1a202c;
    border-bottom: 2px solid #3182ce;
    padding-bottom: 8px;
}

ul.error {
    list-style: none;
    background-color: #ffe5e5;
    border: 1px solid #ff4d4d;
    color: #b20000;
    padding: 10px 15px;
    border-radius: 5px;
    margin-bottom: 20px;
}

form div {
    margin-bottom: 15px;
}

form label {
    display: block;
    margin-bottom: 5px;
    font-weight: 600;
}

form input[type="text"] {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #cbd5e0;
    border-radius: 6px;
    font-size: 1rem;
    transition: 0.2s;
}

form input[type="text"]:focus {
    outline: none;
    border-color: #3182ce;
    box-shadow: 0 0 5px rgba(49,130,206,0.3);
}

.actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 20px;
}

.actions button {
    padding: 10px 20px;
    font-size: 1rem;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    transition: 0.2s;
    font-weight: 600;
}

#btnCancelar {
    background-color: #e2e8f0;
    color: #1a202c;
}

#btnCancelar:hover {
    background-color: #cbd5e0;
}

#btnConfirmar {
    background-color: #3182ce;
    color: #fff;
}

#btnConfirmar:hover {
    background-color: #2c5282;
}

@media screen and (max-width: 480px) {
    .container {
        padding: 20px 25px;
    }

    .actions {
        flex-direction: column;
    }

    .actions button {
        width: 100%;
    }
}
</style>

<section class="container">
  <h2>{{modeDsc}}</h2>

  {{if hasErrores}}
  <ul class="error">
    {{foreach errores}}
      <li>{{this}}</li>
    {{endfor errores}}
  </ul>
  {{endif hasErrores}}

  <form action="index.php?page=Mantenimientos-Cliente&mode={{mode}}&codigo={{codigo}}" method="post">
    <div>
      <label for="codigo">Código</label>
      <input type="text" name="codigo" id="codigo" value="{{codigo}}" {{codigoReadonly}}/ >
      <input type="hidden" name="vlt" value="{{token}}">
    </div>
    <div>
      <label for="nombre">Nombre</label>
      <input type="text" name="nombre" id="nombre" value="{{nombre}}" {{readonly}}/>
    </div>
    <div>
      <label for="direccion">Dirección</label>
      <input type="text" name="direccion" id="direccion" value="{{direccion}}" {{readonly}}/>
    </div>
    <div>
      <label for="telefono">Teléfono</label>
      <input type="text" name="telefono" id="telefono" value="{{telefono}}" {{readonly}}/>
    </div>
    <div>
      <label for="correo">Correo</label>
      <input type="text" name="correo" id="correo" value="{{correo}}" {{readonly}}/>
    </div>
    <div>
      <label for="estado">Estado</label>
         {{ifnot readonly}} 
         <select name="estado" id="estado">
          <option value="ACT" {{selectedACT}} >Activo</option>
          <option value="INA" {{selectedINA}}>Inactivo</option>
         </select>
         {{endifnot readonly}} 
        {{if readonly}} 
      <input type="text" name="estado" id="estado" value="{{estado}}" {{readonly}}/>
      {{endif readonly}} 
    </div>
    <div>
      <label for="evaluacion">Evaluación</label>
      <input type="text" name="evaluacion" id="evaluacion" value="{{evaluacion}}" {{readonly}}/>
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
    window.location.assign("index.php?page=Mantenimientos-Clientes");
  });
});
</script>

</body>
</html>
