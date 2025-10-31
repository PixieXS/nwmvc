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
                     <th><a href="index.php?page=Mantenimientos-Cliente&mode=INS">Nuevo</a></th>
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