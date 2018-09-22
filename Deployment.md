Deployment de Prepanet

Requisitos
Laravel Installer 1.5.0
NPM
Composer
Laravel 5.7+
Git
Cuenta en Heroku
Heroku CLI

Para descargar el proyecto, es necesario descargar el repositorio al directorio que prefiera mas en su computadora.

$ git clone https://github.com/ProyectoIntegrador2018/prepanet.git


Despues de haberlo descargado, asegurese de entrar al directorio.

$ cd prepanet
Ya dentro del directorio, se instalan todas las dependencias necesarias para el proyecto con

$ composer update

Después se instalan todas las dependencias de NPM.

$ npm install

Heroku CLI
El proyecto esta hosteado en el sitio Heroku, por lo que si se desea hacer un deploy en el mismo sitio, es necesario seguir los siguientes pasos

Para poder conectar nuestro proyecto con Heroku, es necesario descargar Heroku CLI y hacer login con nuestras credenciales

$ heroku login

Subir a Heroku
Dentro del directorio del proyecto, se crea un sitio con Heroku de la siguiente manera:

$ heroku create

Una vez creado el sitio, es hora de subir nuestra aplicación. Se utiliza el siguiente comando:

$ git push heroku master
Este comando tambien tomara un tiempo, pero despues de que termine de ejecutarse, puedes revisar que el API funciona con:

Se abre la plataforma www.heroku.com, se entra a la parte de configuraciones del sistema y se llena con las variables de entorno correspondientes para poder correr la aplicación junto con la base de datos.

Después de eso se corren las migraciones con los seeders.

$ heroku run php artisan migrate --seed

$ heroku open
