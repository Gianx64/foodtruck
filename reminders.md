## Don't forget:
update vite.config.js (host)
update .env (APP_URL)

shell:
```
sudo chown -R gian: /Applications/XAMPP/htdocs/foodtruck
```
```
find /Applications/XAMPP/htdocs/foodtruck -type d -exec chmod 755 {} \;
```
```
sudo chmod -R 777 /Applications/XAMPP/htdocs/foodtruck/storage
```
```
sudo chmod -R 775 /Applications/XAMPP/htdocs/foodtruck/bootstrap/cache
```

```
npm i
```
```
php composer update
```
```
php artisan storage:link
```
```
npm run dev (local)
```
```
npm run dev -- --host (network)
```

Check console (F12)
## Notes:
change vendor/livewire/livewire/src/TemporaryUploadedFile.php, line 23:

```
$tmpFile = fopen(Storage::path($this->path),'r');
```

## Hecho:
- Implementar correos
    - Confirmaciones por correo (conexion, documentos, aplicaciones a eventos, seleccionado o rechazado para evento)
- Asignar rol de Foodtrucker a usuarios verificados
- Documentos de foodtrucks
    - Documentación requerida por evento (variable)
- Cuenta para foodtrucks:
    - Implementar múltiples tipos de comida por foodtruck
- Actualizar HomeController y home.blade
- Documentos de foodtrucks
    - Módulo para aprovar o rechazar documentos de foodtrucks
- 404 para eventos no existentes
- Cuenta para foodtrucks:
    - Crear y editar foodtruck propio
    - Cambiar método de aplicación a eventos
    - Vista con login para ver cuántos foodtrucks están pendientes además de los aceptados
    - Implementar múltiples foodtrucks por persona
- Más links clickeables (ID, nombres)
- Mostrar cupos por eventos
- Subida de documentos legales para aplicación de foodtrucks
    - Crear Livewire Component
    - Definir reglas en el Model Foodtruck
    - Habilitar subida de archivo en el blade
    - Manejar el archivo en el Livewire Component
- Limitar postulaciones de foodtrucks
    - Cuando se llega al límite de foodtrucks por evento (vista manager)
    - Cuando ya hay un tipo de comida en el evento (vista manager)
    - Cuando el evento ya sucedió
- Limitar foodtrucks por tipo de comida
- Limitar cupos por eventos
- Alargar lista de tipos de comidas
    - Posiblemente generar CRUD
- Soporte de imágenes para eventos
    - Definir reglas en el Model Event
    - Habilitar subida de archivo en el blade
    - Manejar el archivo en el Livewire Component
    - Mostrar imágenes en páginas de eventos
- Actualización de foodtrucks
    - Generar CRUD
    - Adaptar funciones
- Actualización de roles
    - Generar CRUD
    - Adaptar funciones
- Actualizacion de perfil
    - Hacer que tome variables de Livewire
