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
            </tr>
              {{endfor clientes}}
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="right">
                    Registros: {{total}}
                </td>
                <td colspan="6" class="right">
                    Nota Total: {{totalNota}}
                </td>
            </tr>
        </tfoot>
    </table>
</section>