## Live demo

https://algotel.herokuapp.com/

## Requisitos de software para ambiente de desarrollo

- PHP 8.0.3
- MySQL 5.6 o superior

## Crear archivo .env para ambiente local

Estas datos son cargados como variables de ambiente en PHP y deben ser configuradas como variables de ambiente en la maquina que correra el sistema una vez se este en produccion.

```.env
DB_SERVERNAME=localhost
DB_USERNAME=root
DB_PASSWORD=root
DB_NAME=AlgoTel
DB_PORT=3306
ASSETS_VERSION=1
```

## Correr la app en modo desarrollo

- Dirigirese al folder public desde la terminal
- ejecutar `php -S localhost:8000 index.php`
  - Esto pondra a correr el app en el puerto 8000
- Dirigirese a http://localhost:8000/

## Accesos por defecto

- admin@gmail.com => 123
- papotico@gmail.com => 123
- jon.doe@gmail.com => 123
