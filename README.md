SGEG - Instalación y despliegue

Al acceder al directorio clonado se pueden ver varios ficheros de configuración, de nginx, de Docker (Dockerfile y docker-compose.yml) y el fichero .env que usa docker-compose para crear el contenedor de Mysql, en este fichero hay que configurar las variables de conexión a BD antes de ejecutar la creación de los contenedores.
El siguiente paso es revisar y actualizar los archivos de configuración de la aplicación, en el directorio donde está el código de la aplicación se tienen que ajustar los parámetros en el archivo .env. En el Anexo I  se pueden consultar todos los parámetros relacionados con las configuraciones.

En caso de que no exista un archivo .env, se creará una copia del fichero .env.prod en .env. 
cp .env.prod .env
Es necesario comprobar las variables de entorno de la aplicación que comienzan con el prefijo APP_
APP_DEBUG=false
APP_ENV=production
APP_URL=http://127.0.0.1
También será necesario ajustar o comprobar el valor de las variables de configuración de la BD que comienzan con el prefijo DB_, tienen que coincidir con los valores que se utilizan en el fichero .env de configuración de docker-compose.
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sgeg
DB_USERNAME=usersgeg
DB_PASSWORD=XXXXXX
Además, se deben configurar las variables de configuración del sistema de correo electrónico para los envíos. Estas variables se definen también en el fichero .env y tienen el prefijo MAIL_
MAIL_MAILER=mailersend
MAIL_HOST=smtp.mailersend.net
MAIL_PORT=587
MAIL_USERNAME=XXXX
MAIL_PASSWORD=XXXXXXXXXXXX
MAIL_ENCRYPTION=TLS
MAIL_FROM_ADDRESS=XXXX
Alguna de las variables de este fichero se pueden modificar desde el panel de administración de la aplicación como se refleja en la Figura 12. Los parámetros que se pueden modificar desde el panel de administración de la aplicación son aquellos relativos a la configuración de Telegram, el remitente de correo o el número de elementos por página a mostrar en un listado.

Ejecutando docker-compose sobre la carpeta donde se encuentra SGEG, se inicia la instalación. Este comando permitirá desplegar los contenedores para la ejecución de MySQL y nginx donde se ejecuta el software de servidor de la aplicación. Con la opción –build se el contenedor de la aplicación SGEG usando el Dockerfile.
docker-compose up -d --build