
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

## Api's 

### ***Usuarios***
- POST login : enviar de formulario para iniciar sesión a aplicación

##### Token required:
- GET create : Precarga de campos para formulario, combo para seleccionar Rol
- POST store : Envío de formulario y registro de Usuarios
- GET edit : Precarga de formulario con datos del registro y combo de Rol
- PUT update : Envío de formulario para actualizar datos de usuario
- POST changePass : Envío de formulario para actualizar password de usuario logueado
- POST datatable : Listado de usuarios registrados, se envía también datos de formulario para filtrar resultados
- POST logout : Cerrar sesión

&nbsp;

### ***Productos***
##### Token required:
- POST store : Envío de formulario y registro de Productos.
- GET edit : Precarga de formulario con datos del registro.
- PUT update : Envío de formulario para actualizar datos de Producto.
- POST datatable : Listado de productos registrados, se envía también datos de formulario para filtrar resultados.
- GET list : Lista de productos para ser mostrados en formulario.

&nbsp;

### ***Pedidos***
##### Token required:
- POST store : Envío de formulario y registro de Productos.
- GET edit : Precarga de formulario con datos del registro.
- PUT changeState : Envío de formulario para actualizar estado del pedido.
- POST datatable : Listado de pedidos registrados para ser mostrados en datatable. Se envía también datos de formulario para filtrar resultados.