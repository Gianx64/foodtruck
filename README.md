<h2>No olvidar:</h2><p>
actualizar vite.config.js (host)
actualizar .env (APP_URL)
    APP_URL=http://200.50.49.21 (Public IP)
    APP_URL=http://10.2.139.30 (Local IP)

sudo chown -R gian: /Applications/XAMPP/htdocs/foodtruck
find /Applications/XAMPP/htdocs/foodtruck -type d -exec chmod 755 {} \;
sudo chmod -R 777 /Applications/XAMPP/htdocs/foodtruck/storage
sudo chmod -R 775 /Applications/XAMPP/htdocs/foodtruck/bootstrap/cache

npm i
php composer update
php artisan storage:link
npm run dev (local)
npm run dev -- --host (network)

revisar la consola del navegador (F12)
</p>
<h2>Notas:</h2><p>
cambiar vendor/livewire/livewire/src/TemporaryUploadedFile.php, line 23:
$tmpFile = fopen(Storage::path($this->path),'r');
</p>
<h2>Por Hacer:</h2><p>
Hacer que cargue css antes que html

Limpiar postulaciones el día del evento

Editor de correos para user update

Document modal se cierra solo al apretar approve

Eliminar names de foodtrucks cuando son eliminados de la tabla

Cuenta para foodtrucks:

	El cambio de tipo de comida expira ciertos documentos e invalida las aplicaciones a eventos

Implementar correos

	Lista de foodtrucks para contactar masivamente (por zona)

	Recordatorios por correo (evento en una semana, cantidad de notificaciones, modificable)

Fechas calendarizables en eventos

Ver como portarlo a celulares
</p>
<h2>Hecho:</h2>
<ul>
    <li>Implementar correos
        <ul>
            <li>Confirmaciones por correo (conexion, documentos, aplicaciones a eventos, seleccionado o rechazado para evento)</li>
        </ul>
    </li>
    <li>Asignar rol de Foodtrucker a usuarios verificados</li>
    <li>Documentos de foodtrucks
        <ul>
            <li>Documentación requerida por evento (variable)</li>
        </ul>
    </li>
    <li>Cuenta para foodtrucks:
        <ul>
            <li>Implementar múltiples tipos de comida por foodtruck</li>
        </ul>
    </li>
    <li>Actualizar HomeController y home.blade</li>
    <li>Documentos de foodtrucks
        <ul>
            <li>Módulo para aprovar o rechazar documentos de foodtrucks</li>
        </ul>
    </li>
    <li>404 para eventos no existentes</li>
    <li>Cuenta para foodtrucks:
        <ul>
            <li>Crear y editar foodtruck propio</li>
            <li>Cambiar método de aplicación a eventos</li>
            <li>Vista con login para ver cuántos foodtrucks están pendientes además de los aceptados</li>
            <li>Implementar múltiples foodtrucks por persona</li>
        </ul>
    </li>
    <li>Más links clickeables (ID, nombres)</li>
    <li>Mostrar cupos por eventos</li>
    <li>Subida de documentos legales para aplicación de foodtrucks
        <ul>
            <li>Crear Livewire Component</li>
            <li>Definir reglas en el Model Foodtruck</li>
            <li>Habilitar subida de archivo en el blade</li>
            <li>Manejar el archivo en el Livewire Component</li>
        </ul>
    </li>
    <li>Limitar postulaciones de foodtrucks
        <ul>
            <li>Cuando se llega al límite de foodtrucks por evento (vista manager)</li>
            <li>Cuando ya hay un tipo de comida en el evento (vista manager)</li>
            <li>Cuando el evento ya sucedió</li>
        </ul>
    </li>
    <li>Limitar foodtrucks por tipo de comida</li>
    <li>Limitar cupos por eventos</li>
    <li>Alargar lista de tipos de comidas
        <ul>
            <li>Posiblemente generar CRUD</li>
        </ul>
    </li>
    <li>Soporte de imágenes para eventos
        <ul>
            <li>Definir reglas en el Model Event</li>
            <li>Habilitar subida de archivo en el blade</li>
            <li>Manejar el archivo en el Livewire Component</li>
            <li>Mostrar imágenes en páginas de eventos</li>
        </ul>
    </li>
    <li>Actualización de foodtrucks
        <ul>
            <li>Generar CRUD</li>
            <li>Adaptar funciones</li>
        </ul>
    </li>
    <li>Actualización de roles
        <ul>
            <li>Generar CRUD</li>
            <li>Adaptar funciones</li>
        </ul>
    </li>
    <li>Actualizacion de perfil
        <ul>
            <li>Hacer que tome variables de Livewire</li>
        </ul>
    </li>
</ul>