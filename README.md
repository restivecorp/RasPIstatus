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
2. Modify the php/cfg/services.cfg file to indicate which services you want to monitor
3. Copy the php/cfg/measuring.db file to a directory with read/write/execute, for example /var/rpimonitor
4. Configure cron task metrics collection
5. Start the services


You can make changes if your system does not have as many disk partitions for which it is intended or modify data collection commands. To do this edit the files:
* php/scripts/measuring.php
* php/scripts/metrics.php

## Screenshots

