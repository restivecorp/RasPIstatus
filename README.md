# RasPIstatus
PHP monitor for Raspberry PI Systems

## What is?
This is a PHP Web application that gets control to the status of a Raspberry PI. To run requires that the system check the following requirements:

* Raspberry PI
* Apache Web Server
* PHP
* SQLite3

After satisfying the requirements simply download the application, configure and start using it.

## How does it work
The application displays the information, online, about the raspberry.
According to the application screen shows data to the CPU, processor, memory, storage, network,...
In addition, if set in cron, the application collects the temperature and memory values and show graphics.

The application template is 'Harmony Admin': http://themestruck.com/theme/harmony-admin/

## Install and Usage

1. Download or clone this repository
2. Copy to server root directory [/var/www/RasPIstatus]
3. Copy the database 'file metrics/metrics.db' to a directory with read/write/execute permissions [/var/rpistatus/metrics.db]
4. Edit file 'metrics/metrics.php' to set the correct path:

> 	$IFACE = "eth0"; // name of network interface

> 	$DWNDIR = "/media/downloads/.incoming"; // transmission download dir

>	getDataBaseLocation() = "/var/rpistatus/metrics.db"; // database file path (step 3)

5. Edit 'index.php' and 'storage.php' files to set correctly mounted directories. In this repository there are two partitions in /sda1 and /sda2

> index.php: edit ::> $sda1 = getStorage("/dev/sda1")[3];

> index.php: edit ::> $sda2 = getStorage("/dev/sda2")[3]; 

> storage.php: edit ::> $sda1 = getStorage("/dev/sda1"); 

> storage.php: edit ::> $sda2 = getStorage("/dev/sda2"); 

6. Configure cron task to metrics collection. For example:

> crontab -e

> 0 0 * * *   php /var/www/RasPIstatus/metrics.php -ip

> 0 * * * *   php /var/www/RasPIstatus/metrics.php -t

> 15 * * * *  php /var/www/RasPIstatus/metrics.php -m

Finally, you can access to your IP server to view the application.



## Screenshots
![alt tag](https://github.com/ruboweb/RasPIstatus/blob/master/screenshots/01.dash.png)
![alt tag](https://github.com/ruboweb/RasPIstatus/blob/master/screenshots/02.system.png)
![alt tag](https://github.com/ruboweb/RasPIstatus/blob/master/screenshots/03.processor.png)
![alt tag](https://github.com/ruboweb/RasPIstatus/blob/master/screenshots/04.temp.png)
![alt tag](https://github.com/ruboweb/RasPIstatus/blob/master/screenshots/05.memory.png)
![alt tag](https://github.com/ruboweb/RasPIstatus/blob/master/screenshots/06.storage.png)
![alt tag](https://github.com/ruboweb/RasPIstatus/blob/master/screenshots/07.network.png)
![alt tag](https://github.com/ruboweb/RasPIstatus/blob/master/screenshots/08.services.png)

