<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>


<h1> Sistema RioSales </h1>

<h2> Sistema para administración de área de salud </h1>

### Este sistema contiene los siguientes modulos:

<ol>
    <li> Modulo de Login </li>
    <li> Modulo de Pacientes </li>
    <li> Modulo de Consultas </li>
    <li> Modulo de Vacunas </li>
    <li> Modulo de Donaciones </li>
    <li> Modulo de Informes </li>
</ol>

### Instalación 🔧

- Tendran que instalar los packages necesarios para funcionalidad del sistema con el comando

```
composer install
```

- Ejecutar comando para generar la key para el proyecto:

```
php artisan key:generate
```

- Modificar el archivo .env para relacionarlo con la base de datos.

- Ejecutar las migraciones (crear la estructura de la BD) y los seeders (rellanado de la BD).

```
php artisan migrate --seed
```

- Por ultimo ejecutar el comando para generar el entorno local de Laravel:

```
php artisan serve
```
