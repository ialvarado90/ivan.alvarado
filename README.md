
## Prueba técnica


- Clonar o descargar proyecto
- Abrir consola y ubicarse en proyecto
- Ejecutar comando " composer install "
- Actualizar el archivo .env con la conexion a la base de datos
- Ejecutar comando " php artisan config:cache " y " php artisan route:cache "
- Crear base de datos " reto_tecnico " e importar archivo .sql incluido en la raíz del proyecto
- Importar el collection en Postman, ubicado en la raíz del proyecto 

- En caso tabla "users" estuviera vacía, ejecutar comando " php artisan auth:user " para crear un usuario básico con rol "Encargado"


### Tablas

Las siguientes tablas deben tener obligatoriamente los siguientes valores y id's

***roles***

<table>
    <thead>
        <tr>
            <th>id</th>
            <th>nombre</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Encargado</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Vendedor</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Delivery</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Repartidor</td>
        </tr>
    </tbody>
</table>

&nbsp;&nbsp;

***pedido_estado***
<table>
    <thead>
        <tr>
            <th>id</th>
            <th>nombre</th>
            <th>position</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Por atender</td>
            <td>1</td>
        </tr>
        <tr>
            <td>2</td>
            <td>En proceso</td>
            <td>2</td>
        </tr>
        <tr>
            <td>3</td>
            <td>En delivery</td>
            <td>3</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Recibido</td>
            <td>4</td>
        </tr>
    </tbody>
</table>