# RasPIstatus
PHP monitor for Raspberry PI Systems

## What is?
This is a PHP Web application that gets control to the status of a Raspberry PI. To run requires that the system check the following requirements:

* Raspberry PI
* Web Server (Apache, ngix, lighttp, ...)
* PHP
* SQLite3
* Transmission download torrent (only to monitorize downloads)
* Commands: _vnstat_ | _tree_

After satisfying the requirements simply download the application, configure and start using it.

## How does it work
The application displays the information, online, about the raspberry.
According to the application screen shows data to the CPU, processor, memory, storage, network,...
In addition, if set in cron, the application collects the temperature and memory values and show graphics.

The application template is 'Harmony Admin': https://github.com/theme-struck/themestruck-harmony-admin/

## Install and Usage

1. Download or clone this repository in http server root directory and rename it:
```
	cd /var/www/
	git clone https://github.com/ruboweb/RasPIstatus.git
	mv RasPIstatus.git rpi-monitor
```

2. Move the database file to another path (out of http server).
```
	cd /var/www/rpi-monitor/php
	mv rpi-server.db.empty rpi-server.db
	
	sudo mkdir /var/rpi-server
	sudo mv rpi-server.db /var/rpi-server/rpi-server.db
	sudo chmod 777 /var/rpi-server/
	sudo chmod 777 /var/rpi-server/*
```

3. Edit correct path (database) in configuration file
```
	nano /var/www/rpi-monitor/php/cfg.php
	
	function getDataBaseLocation() {
		return "[CORRECT_PATH]";
	}
``` 

4. Edit config values in database:
```
	cd /var/rpi-server/
	sqlite3 rpi-server.db
	
	select * from conf where key like 'system_param_%';
	
	update conf set system_param_XXXX = '*******' where id = ?;
``` 

5. Review and edit control params to alert in database:
```
	cd /var/rpi-server/
	sqlite3 rpi-server.db
	
	select * from conf where key like 'control_param_%';
	
	update conf set control_param_XXXX = '*******' where id = ?;
``` 

6. Configure cron task to metrics collection. For example:

```
	sudo su
	contrab -e
	
	@reboot php /var/www/rpi-monitor/php/monitorize.php -reboot >/dev/null 2>&1

	# Monitorize all parameters (temp, memory, storage)
	0 * * * * php /var/www/rpi-monitor/php/monitorize.php >/dev/null 2>&1

	# Monitorize IP
	30 0 * * * php /var/www/rpi-monitor/php/monitorize.php -ip >/dev/null 2>&1
```

7. Downloads monitorize are manual. You can invoke command in your transmission script:
```
	php /var/www/rpi-monitor/php/monitorize.php -dwn name_of_torrent_down
```


Finally, you can access to your IP server to view the application.



## Screenshots
![alt tag](https://github.com/ruboweb/RasPIstatus/blob/master/screenshots/01.dash.png)
![alt tag](https://github.com/ruboweb/RasPIstatus/blob/master/screenshots/01.alerts.png)
![alt tag](https://github.com/ruboweb/RasPIstatus/blob/master/screenshots/02.system.png)
![alt tag](https://github.com/ruboweb/RasPIstatus/blob/master/screenshots/03.processor.png)
![alt tag](https://github.com/ruboweb/RasPIstatus/blob/master/screenshots/04.temp.png)
![alt tag](https://github.com/ruboweb/RasPIstatus/blob/master/screenshots/05.memory.png)
![alt tag](https://github.com/ruboweb/RasPIstatus/blob/master/screenshots/06.storage.png)
![alt tag](https://github.com/ruboweb/RasPIstatus/blob/master/screenshots/07.network.png)
![alt tag](https://github.com/ruboweb/RasPIstatus/blob/master/screenshots/08.software.png)

