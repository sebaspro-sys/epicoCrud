
Instalación y Configuración 

1. git clone https://github.com/sebaspro-sys/epicoCrud 

2. Una vez hayas clonado el repositorio debes ingresar a la carpeta donde lo clonaste (htdocs, xampp, proyecto)

ejemplo: C:\xampp\htdocs\epicoCrud>

3. En la carpeta del proyecto debes ejecutar el comando composer install para descargar las dependencias

6. Crea una base de datos en phpMyAdmin

5. En el archivo database encontrado en la ruta app/config/Database.php configura el nombre de la base de datos que creaste

6. Inicializa el servidor con el comando php spark serve
El proyecto estará disponible en: http://localhost:8080

7. En la terminal de visual ejecuta el siguiente comando para correr las migraciones 
php spark migrate

LISTO, YA PUEDES USAR EL PROYECTO 👍
