# Proyecto de Alan Barco
 
  Se debe clonar el repositorio con el comando git clone https://gitlab.com/pruebas-telconet-sasf/proyecto-21-03-2023.git
Y dirigirse a la rama correspondiente con el siguiente comando: git checkout AlanBarco

Los programas requeridos para el levantamiento del proyecto son: xampp, composer, symfony cli, cliente para postgressql, visual studio code

Se debe tener estas aplicaciones instaladas para continuar con el despliegue de la aplicación. Se abre la carpeta del proyecto dentro de Visual Studio Code. Se abre un terminal y se debe ejecutar el comando composer install, esto nos instala las dependencias requeridas para el programa. 
Se debe crear una base de datos en pgAdmin4, el cual contendrá las tablas de nuestra aplicación
Luego, el contenido del archivo script.sql que se encuentra dentro de la carpeta del proyecto
Se lo debe copiar y pegar en un query para poder crear las tablas.
Se debe establecer la cadena de conexión con la base de datos. Para esto, dentro del archivo .env escribimos la información necesaria para conectarse al servidor, como lo es el usuario, la contraseña, la dirección IP del local con el puerto del servidor, y por último el nombre de la base de datos.
Para levantar el proyecto, se debe posicionar dentro de la carpeta raíz y ejecutar el comando symfony serve. Con esto, al dirigirse al navegador y entrar al url http://localhost:8000 se visualiza el programa.
