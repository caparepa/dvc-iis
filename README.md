# dvc-iis
Proyecto de Sistema de Gestión de Viáticos para DVC (servicio comunitario UCAB) - Desarrollado en Laravel PHP para IIS
# dvc-iis
Proyecto de Sistema de Gestión de Viáticos para DVC (servicio comunitario UCAB) - Desarrollado en Laravel PHP para IIS

Configuración SQL Server (no está en orden específico)
- Al momento de instalar SQL Server, crear una instancia nueva aparte de la existente por defecto
- Esta nueva instancia se puede nombrar como plazca, siempre y cuando no tenga espacion (por ejemplo, LOCALDB)
- En el .env (archivo de configuración de variables de Laravel), la variable DB_HOST tiene como valor el nombre de la instancia de la base de datos en el servidor. Por ejemplo, si el servidor se llama "DVC" y la instancia de SQL Server se llama "DB", la variable quedaría "DB_HOST=DVC\DB"
- Activar los servicios pertinentes a la instancia en el SQL Server Configuration Manager
- Conectarse a la instancia con el SQL Server Management Studio

- Para crear una nueva base de datos, hacer click derecho en "Databases" y seleccionar "Create new database". Sólo colocarle el nombre deseado (sin espacios ni caracteres especiales), y clickear Ok.
- En el Object Explorer, Abrir la pestaña Security, hacer click derecho en "Logins" y seleccionar "New Login..."
- En login name, colocar "NT AUTHORITY\IUSR". En la pestaña User Mapping, asociar la base de datos creada al usuario y mapearle todos los roles. Hacer click en Ok.
