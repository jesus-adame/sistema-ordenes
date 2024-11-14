# Sistema de administración de órdenes

El sistema debe permitir hacer login, registrar un nuevo usuario y recuperar la contraseña.
El sistema debe tener una vista de lista de Ordenes
Al dar click sobre cada orden se puede ver el detalle de la orden: Cliente (catalogo), datos generales de la orden (fecha, numero, etc) y el listado de productos (catalogo)
El sistema puede crear o cancelar ordenes pero no puede eliminar.
El sistema puede agregar, editar, eliminar items a la orden y el subtotal debe ir cambiando sin refrescar la página.

## Requisitos

Linux, Mac OS, o Windows (WSL2)
Docker/Docker desktop
php 8.2 o superior

## Instalación

En la primera vez se debe hacer lo siguiente:

1. Registrar al final o al inicio de su archivo de variables de entorno (~/.zshrc o ~/.bashrc) el siguiente comando.
   `alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'`

2. Construir y levantar el contenedor.
   `vendor/bin/sail build --no-cache`
   `vendor/bin/sail up -d`

3. Correr las migraciones:
   `vendor/bin/sail artisan migrate`
   `vendor/bin/sail artisan db:seed`

Para hacer pruebas y desarrollar levantar el servidor de vite:
`vendor/bin/sail npm install `
`vendor/bin/sail npm run dev`

En el navegador abir http://localhost y listo, ya tienes el proyecto con su base de datos local.
