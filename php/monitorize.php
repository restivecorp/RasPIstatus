<?php 
	include ("metrics.php"); 
	
	$task = "Task";
	$system = "System";
	$temp = "Temp";
	$memory = "Memory";
	$storage = "Storage";
	$cpu = "CPU";
	$torrent = "Torrent";
	
	
	if (isset($argv)) {
		main($argv);	
	}
	
	// Main
	function main($argv) {
		if (!isset($argv[1])) {
			temp();
			cpu();
			mem();
			store();
			usr();
			proc();
			return;
		}
    	
		if ($argv[1] == "-temp") {
			temp();
			return;			
    	}
		
		if ($argv[1] == "-cpu") {
			cpu();
			return;			
    	}
		
		if ($argv[1] == "-mem") {
			mem();
			return;			
    	}
		
		if ($argv[1] == "-store") {
			store();
			return;			
    	}		
		
		if ($argv[1] == "-usr") {
			usr();
			return;			
    	}	
		
		if ($argv[1] == "-proc") {
			proc();
			return;			
    	}
		
		if ($argv[1] == "-reboot") {
			reboot();
			return;			
    	}

		if ($argv[1] == "-mnt") {
			if (isset($argv[2])) {
				mnt($argv[2]);
			}else {
				mnt("");
			}
			return;			
    	}
		
		if ($argv[1] == "-cc") {
			echo cleanCache();
			return;
    	} 
		
		if ($argv[1] == "-ccm") {
			echo cleanCacheMessage();
			return;
    	} 
				
		if ($argv[1] == "-ip") {
			ip();
			return;			
    	}
		
		if ($argv[1] == "-dwn") {
			if (isset($argv[2])) {
				dwn($argv[2]);
			}else {
				dwn("");
			}
			return;			
    	}
		
		if ($argv[1] == "-sa") {
			showAlert($argv[2]);
			return;			
    	}
	}
	

	
	// --------------------------------------------------------------
	// Manual
	// --------------------------------------------------------------
	/**
	 * Monitorice reboot
	 */
	function reboot() {	
		$db = new SQLite3(getDataBaseLocation());
		
		$type = $GLOBALS['task'];
		$info = "System Reboot";
		$value = "";	
		$today = today();
		$show = 0;

		$db->exec("insert into alert (type, info, value, date, show) values ('$type', '$info', '$value', '$today', $show)");	
		$db->close();
	}
	
	/**
	 * Monitorice mnt
	 */
	function mnt($ops) {	
		$db = new SQLite3(getDataBaseLocation());
		
		$type = $GLOBALS['task'];
		$info = "Maintance done";
		$value = $ops;	
		$today = today();
		$show = 0;

		$db->exec("insert into alert (type, info, value, date, show) values ('$type', '$info', '$value', '$today', $show)");	
		$db->close();
	}
	
		/**
	 * Monitorice downloads
	 */
	function dwn($file_name) {	
		$db = new SQLite3(getDataBaseLocation());
		
		$file_name = str_replace("_Name:_","", $file_name);
		$file_name = str_replace("_"," ", $file_name);
		
		$type = $GLOBALS['torrent'];
		$info = "New download";
		$value = $file_name;	
		$today = today();
		$show = 1;

		$db->exec("insert into alert (type, info, value, date, show) values ('$type', '$info', '$value', '$today', $show)");	
		$db->close();
	}
	
	// --------------------------------------------------------------
	// Automatic
	// --------------------------------------------------------------
	/**
	 * Monitorice ip
	 */
	function ip() {	
		$db = new SQLite3(getDataBaseLocation());
		
		$actualIP = getPublicIP();
		$id_db = 0;
		$ip_db = "";
				
		$results = $db->query("select id, ip from ip where active = 1");
		
 		while($row = $results->fetchArray(SQLITE3_ASSOC)) {
        	$id_db = $row["id"];
			$ip_db = $row["ip"];
    	}
		
		if ($ip_db != $actualIP) {
			$type = $GLOBALS['task'];
			$info = "New IP";
			$value = getPublicIP();	
			$today = today();
			$show = 0;

			$db->exec("update ip set active = 0");
			$db->exec("insert into ip (ip, date, active) values ('$value', '$today', 1)");
			$db->exec("insert into alert (type, info, value, date, show) values ('$type', '$info', '$value', '$today', $show)");	
		}
		
		$db->close();
	}
	
	/**
	 * Monitorice users
	 */
	function usr() {	
		$db = new SQLite3(getDataBaseLocation());
		
		$type = $GLOBALS['system'];
		$info = "SSH connections";
		$value = getUserLogin();	
		$today = today();
		$show = 1;
		
		if ($value > getConf('control_param_users')) {
			$show = 0;	
		}
		
		$db->exec("insert into alert (type, info, value, date, show) values ('$type', '$info', '$value', '$today', $show)");	
		$db->close();
	}
	
	
	/**
	 * Monitorice procs
	 */
	function proc() {	
		$db = new SQLite3(getDataBaseLocation());
		
		$type = $GLOBALS['system'];
		$info = "Current tasks";
		$value = getTasks();	
		$today = today();
		$show = 1;
		
		$db->exec("insert into alert (type, info, value, date, show) values ('$type', '$info', '$value', '$today', $show)");	
		$db->close();
	}
	
	/**
	 * Monitorice temperature
	 */
	function temp() {	
		$db = new SQLite3(getDataBaseLocation());
		
		$type = $GLOBALS['temp'];
		$info = "CPU Temperature";
		$value = getTemp();	
		$today = today();
		$show = 1;
		
		if ($value > getConf('control_param_temp')) {
			$show = 0;	
		}
		
		$db->exec("insert into alert (type, info, value, date, show) values ('$type', '$info', '$value', '$today', $show)");	
		$db->close();
	}
	
	
	/**
	 * Monitorice CPU
	 */
	function cpu() {	
		$db = new SQLite3(getDataBaseLocation());
		
		$load = getLoad();

		$type = $GLOBALS['cpu'];
		$info = "Load 1";
		$value = $load[0][0] . "." . substr($load[0], 1);
		$today = today();
		$show = 1;
		
		if ($value > getConf('control_param_load1')) {
			$show = 0;	
		}
		$db->exec("insert into alert (type, info, value, date, show) values ('$type', '$info', '$value', '$today', $show)");	
		
		$type = $GLOBALS['cpu'];
		$info = "Load 5";
		$value = $load[1][0] . "." . substr($load[1], 1);
		$today = today();
		$show = 1;
		
		if ($value > getConf('control_param_load5')) {
			$show = 0;	
		}		
		$db->exec("insert into alert (type, info, value, date, show) values ('$type', '$info', '$value', '$today', $show)");	
		
		$type = $GLOBALS['cpu'];
		$info = "Load 15";
		$value = $load[2][0] . "." . substr($load[2], 1);
		$today = today();
		$show = 1;
		
		if ($value > getConf('control_param_load15')) {
			$show = 0;	
		}
		$db->exec("insert into alert (type, info, value, date, show) values ('$type', '$info', '$value', '$today', $show)");	
		
		
		$db->close();
	}
	
	
	/**
	 * Monitorice Memory
	 */
	function mem() {	
		$db = new SQLite3(getDataBaseLocation());

		$memory = getMemory();

		$type = $GLOBALS['memory'];
		$info = "Used";
		$value = $memory[2];	
		$today = today();
		$show = 1;
		$db->exec("insert into alert (type, info, value, date, show) values ('$type', '$info', '$value', '$today', $show)");	
		
		$type = $GLOBALS['memory'];
		$info = "Free";
		$value = $memory[3];	
		$today = today();
		$show = 1;
		
		if ($value < getConf('control_param_mem_libre')) {
			$show = 0;	
		}		
		$db->exec("insert into alert (type, info, value, date, show) values ('$type', '$info', '$value', '$today', $show)");	

		$type = $GLOBALS['memory'];
		$info = "Cache";
		$value = $memory[5];
		$today = today();
		$show = 1;
		
		if ($value > getConf('control_param_mem_cache')) {
			$show = 0;	
		}
		$db->exec("insert into alert (type, info, value, date, show) values ('$type', '$info', '$value', '$today', $show)");	
		
		$db->close();
	}
	
	/**
	 * Notify for clean cache
	 */
	function cleanCache() {
		$memory = getMemory();
		
		if ($memory[5] > getConf('control_param_mem_cache')) {
			return "Y";
		}
		return "N";
	}
	
	function cleanCacheMessage() {
		$db = new SQLite3(getDataBaseLocation());
		
		$memory = getMemory();
		
		$type = $GLOBALS['system'];
		$info = "Cache cleaned";
		$value = $memory[5];	
		$today = today();
		$show = 0;

		$db->exec("insert into alert (type, info, value, date, show) values ('$type', '$info', '$value', '$today', $show)");	
		$db->close();
	}
	
	
	/**
	 * Monitorice Storage
	 */
	function store() {	
		$db = new SQLite3(getDataBaseLocation());

		$root = getStorage("/")[3];
		$boot = getStorage("/boot", "M")[3];
		$sda1 = getStorage("/dev/sda1")[3];
		

		$type = $GLOBALS['storage'];
		$info = "/root";
		$value = preg_replace("[G]", "", $root);	
		$today = today();
		$show = 1;
		
		if ($value < getConf('control_param_store_root')) {
			$show = 0;	
		}
		$db->exec("insert into alert (type, info, value, date, show) values ('$type', '$info', '$value', '$today', $show)");	
		
		$type = $GLOBALS['storage'];
		$info = "/boot";
		$value = preg_replace("[M]", "", $boot);	
		$today = today();
		$show = 1;
		
		if ($value < getConf('control_param_store_boot')) {
			$show = 0;	
		}		
		$db->exec("insert into alert (type, info, value, date, show) values ('$type', '$info', '$value', '$today', $show)");	
		
		$type = $GLOBALS['storage'];
		$info = "/sda1";
		$value = preg_replace("[G]", "", $sda1);
		$today = today();
		$show = 1;
		
		if ($value < getConf('control_param_store_hd')) {
			$show = 0;	
		}
		$db->exec("insert into alert (type, info, value, date, show) values ('$type', '$info', '$value', '$today', $show)");	
		
		$db->close();
	}
	
?>