# Extensión de la API Swapi de Star Wars

Esta API extiende el modelo de datos de starships y vehicles de la api Swapi. Agrega la propiedad "count" y permite hacerle seguimiento

## Estructura de archivos

### API
En la carpeta API se encuentra la aplicación en si. Los paquetes del framework y sus dependencias deben ser instaladas por primera vez

### db
Se creará para almacenar la información de la base de datos

## Primeros Pasos
A continuación se detallan los pasos para instalar las dependencias e iniciar la aplicación

### Pre requisitos
Es necesario tener docker instalado en tu pc con la versión >= 2.3  
[Sitio Oficial de Docker](https://www.docker.com/)
### Generar la imágen docker necesaria
Si ya tienes instalado y corriendo docker, abre una consola en el nivel del proyecto y construye la imágen necesaria para la aplicación
```
docker build -t base-image .
```
### Levantar los contenedores
Tendremos 2 contenedores uno para la aplicación y otro para la base de datos.
```
docker-compose up -d
```
### Instalar las dependencias
```
docker-compose exec api composer install
```
### Generar el archivo .env
En el archivo de ejemplo ya viene la información correcta para la conexión a la base de datos
```
docker-compose exec api cp .env.example .env
```
### Generar la Clave de la Aplicación
```
docker-compose exec api php artisan key:generate
```
### Ejecutar las migraciones
```
docker-compose exec api php artisan migrate
```
### Ejecutar el servidor web
Asegurarse que no haya nada corriendo en el puerto 8000
```
docker-compose exec api php artisan serve --host=0.0.0.0
```
### Ejecutar las pruebas funcionales
```
docker-compose exec api php artisan test
```
### URL de la Aplicación
http://localhost:8000
### Documentación de la API
Para este punto se utilizó la librería [L5 Swagger](https://github.com/DarkaOnLine/L5-Swagger)  
La ubicación de la misma: [/api/documentation](http://localhost:8000/api/documentation)