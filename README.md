# RasPIstatus
PHP monitor for Raspberry PI Systems

## What is?
This is a PHP Web application that gets control to the status of a Raspberry PI. To run requires that the system check the following requirements:

* Raspberry PI
* Apache Web Server
* PHP
* SQLite3

After satisfying the requirements simply download the application, configure and start using it.

The application template is 'Harmony Admin': http://themestruck.com/theme/harmony-admin/

## Settings
1. Download the project
2. Copy to apache root directory
2. Modify the php/cfg/services.cfg file to indicate which services you want to monitor
3. Copy the php/cfg/measuring.db file to a directory with read/write/execute, for example /var/rpimonitor
4. Configure cron task metrics collection. For example:

> crontab -e

> 0 * * * * php /media/hd/public/status/php/scripts/measuring.php -t

> 15 * * * * php /media/hd/public/status/php/scripts/measuring.php -m

Finally, you can access to your IP server to view the application.

If you can make changes in your system you can edit the netx files:
* php/scripts/measuring.php
* php/scripts/metrics.php

## Screenshots

