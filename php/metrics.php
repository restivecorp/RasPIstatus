<?php	
	include ("cfg.php"); 
		
	//  SYSTEM METRICS :: START
	// ----------------------------------------------------------------------------
	
	/**
 	 * Processor
 	 */
	function getProcessor() {
		// invoke
		$result = executeCommand(getCommand("processor"));

		// return
		return explode(':', $result)[1];
	}	
	
	
	/**
 	 * Distribution
 	 */
	function getDistribution() {
		// invoke
		$result = executeCommand(getCommand("distribution"));

		// return
		return explode('=', $result)[1];//.replace("\"", "");
	}

	/**
 	 * Kernel
 	 */
	function getKernel() {
		// invoke
		$result = executeCommand(getCommand("kernel"));

		// return
		return $result;
	}
	
	/**
 	 * Firmware
 	 */
	function getFirmware() {
		// invoke
		$result = executeCommand(getCommand("firmware"));

		// return
		return $result;
	}	
	
	/**
	 * Uptime
	 */
	function getUptime(){
		// invoke
		$result = executeCommand(getCommand("uptime"));

		//operations
		$trozos = preg_split("/[\.]/", $result);
		$uptime = (float) $trozos[0];

		// transformar a (d h m s)
		$dias = (integer) ($uptime / 86400);
		$uptime = $uptime - ($dias * 86400);
	
		$hr = (integer) ($uptime / 3600);
		$uptime = $uptime - ($hr * 3600);

		$mn = (integer) ($uptime / 60);
		$uptime = $uptime - ($mn * 60);
	
		$sg = (integer) ($uptime / 1);
		
		// return
		return $dias."d ".$hr."h ".$mn."m ".$sg."s";
	}	
	
	/**
	 * Last System update/upgrade
	 */
	function getLastUpdate() {
		// invoke
		$result = executeCommand(getCommand("last_update"));
		
		return $result;
	}
	
	/**
	 * Last System update/upgrade
	 */
	function getLastUpdateDays() {
		// invoke
		$result = executeCommand(getCommand("last_update"));
		$today = date("Y-m-d");
				
		$datetime1 = new DateTime($result);
		$datetime2 = new DateTime($today);
		
		$interval = $datetime1->diff($datetime2);
		return $interval->format('%a');
	}

	/**
 	 * Time
 	 */
	function getTime() {
		// invoke
		$result = executeCommand(getCommand("time"));

		// return
		return $result;
	}


	/**
 	 * Load CPU
 	 */
	function getLoad() {
		// invoke
		$result = executeCommand(getCommand("load"));

		// operations
		$cpu = explode('load average: ', $result);
		$cpuLoads = explode(' ', $cpu[1]);

		$loads = array("N/A", "N/A", "N/A");

		$j = 0;
		for($i = 0; $i < count($cpuLoads); ++$i) {
			$loads[$j] = str_replace(',', '', $cpuLoads[$i]);
			$j++;
		}

		// return
		return $loads;
	}
	
	/**
	 * Mem Leaks 
	 */
	function getCPULeaks(){
		// invoke
		$result = executeShellCommand(getCommand("cpu_leaks"));

		// operations
		$data = explode("\n", $result);

		// return
		return $data;
	}
	
	/**
	 * Last load1
	 */
	function getLastLoad1Values() {
		return getLastValuesXY("select substr(date, 12) x, value y from alert where info = 'Load 1' order by date desc limit " . getConf("graph_limit_to_show"));
	}

	/**
	 * Last load5
	 */
	function getLastLoad5Values() {
		return getLastValuesXY("select substr(date, 12) x, value y from alert where info = 'Load 5' order by date desc limit " . getConf("graph_limit_to_show"));
	}

	/**
	 * Last load15
	 */
	function getLastLoad15Values() {
		return getLastValuesXY("select substr(date, 12) x, value y from alert where info = 'Load 15' order by date desc limit " . getConf("graph_limit_to_show"));
	}	
	
	/**
	 * Number of current tasks
	 */
	function getTasks() {
		$result = executeCommand(getCommand("tasks"));
		return $result;
	}

	/**
 	 * Frecuency
 	 */
	function getFrecuency() {
		// invoke
		$result = (float) executeCommand(getCommand("frecuency"));

		//operations
		$result = $result / 1000;
		$result = round($result, 2);

		// return
		return $result . "Mhz";
	}
	
	/**
 	 * Scaling
 	 */
	function getScaling() {
		// invoke
		$result = executeCommand(getCommand("scaling"));

		// return
		return $result;
	}
	

	/**
	 * CPU temp
	 */
	function getTemp(){
		// invoke
		$result = (float) executeCommand(getCommand("temp"));

		//operations
		$result = $result / 1000;
		$result = round($result, 2);

		// return
		return $result;
	}
	
	/**
	 * Last temp
	 */
	function getLastTempValues() {
		return getLastValuesXY("select substr(date, 12) x, value y from alert where type = 'Temp' order by date desc limit " . getConf("graph_limit_to_show"));
	}
	
	/**
	 * Login users
	 */
	function getUserLogin(){
		// invoke
		$result = (integer) executeCommand(getCommand("users"));

		// return
		return $result;		
	}
	
	//  SYSTEM METRICS :: END
	// ----------------------------------------------------------------------------	
	

	
	//  MEMORY :: START
	// ----------------------------------------------------------------------------	
	/**
	 * Mem 
	 */
	function getMemory(){
		$mem = array(); //0: title, 1 total, 2 used, 3 free , 4 shared, 5 buffers, 6 cached

		// invoke
		$memory = executeCommand(getCommand("memory"));

		//operations
		$m = explode(' ', $memory);

		$j = 0;
		for($i = 0; $i < count($m); ++$i) {
    		if ( $m[$i] != '' ) {
				$mem[$j] = $m[$i];
    			$j++;
    		}
		}

		// return
		return $mem;
	}	
	
	
	/**
	 * Mem Leaks 
	 */
	function getMemoryLeaks(){
		// invoke
		$result = executeShellCommand(getCommand("memory_leaks"));

		// operations
		$data = explode("\n", $result);

		// return
		return $data;
	}
	
	
	/**
	 * Last mems used
	 */
	function getLastMemUsedValues() {
		return getLastValuesXY("select substr(date, 12) x, value y from alert where type = 'Memory' and info = 'Used' order by date desc limit " . getConf("graph_limit_to_show"));
	}	

	//  MEMORY :: END
	// ----------------------------------------------------------------------------	
	
	
	
	//  STORAGE :: START
	// ----------------------------------------------------------------------------	
	
	/**
	 * Storage
	 */
	function getStorage($mounted, $units = "G"){
		$store = array(); //0 name, 1 total, 2 used, 3 free, 4 percent, 5 mounted on

		// invoke
		$storage = executeCommand(getCommand("storage"). $units . " " . $mounted);

		//operations
		$s = explode(' ', $storage);
		
		$j = 0;
		for($i = 0; $i < count($s); ++$i) {
			if ( $s[$i] != '' ) {
				$store[$j] = $s[$i];
    			$j++;
    			$a[$j] = $store;
			}
		}

		// return
		return $store;
	}
	
	/**
	 * Storage distribution
	 */
	function getStorageDistribution() {
		// invoke
		$result = executeShellCommand(getCommand("directory_size") . " " . getConf("system_param_external_mount"));

		// operations
		$data = explode("\n", $result);

		// return
		return $data;
	}
	
	//  STORAGE :: END
	// ----------------------------------------------------------------------------	
	
	
	
	//  NETWORK :: START
	// ----------------------------------------------------------------------------		

	/**
	 * Transmission downloads
	 */
	function getCountDownloadsTemp(){
		// invoke
		$result = executeCommand(getCommand("ls") . " " . getConf("system_param_dwn_dir_temp") . " " . getCommand("count"));
		
		// return
		return $result;		
	}
	
	/**
	 * Transmission downloads finished count
	 */
	function getCountDownloadsFinished(){
		// invoke
		$result = executeCommand(getCommand("ls") . " " . getConf("system_param_dwn_dir_end") . " " . getCommand("count"));
		
		// return
		return $result;		
	}

	/**
	 * Transmission downloads finished
	 */
	function getDownloadsFinished(){
		// invoke
		$result = executeShellCommand(getCommand("ls_all") . " " . getConf("system_param_dwn_dir_end") . " " . getCommand("dwn_end"));
		
		// operations
		$downloads = explode("\n", $result);
		
		// return		
		return $downloads;	
	}
	
	/**
	 * Transmission downloads name
	 */
	function getDownloadsName(){
		// invoke
		$result = executeShellCommand(getCommand("transmission_remote"));
		
		// operations
		$downloads = explode("\n", $result);
		
		// return		
		return $downloads;		
	}
	
	/**
	 * Count torrents
	 */
	function getCountTorrents() {
		$query = "select count(*) as t from alert where type = 'Torrent'";
		
		$db = new SQLite3(getDataBaseLocation());
		$results = $db->query($query);
		
		$data = $results->fetchArray(SQLITE3_ASSOC);
		$db->close();
		
		return $data['t'];
	}
	
	/**
	 * Count torrents by month and actual year
	 */
	function getDownloadsMonth($m) {
		$year = date("Y");
		$query = "select count(*) as t from alert where strftime('%m', date) = '$m' and strftime('%Y', date) = '$year' and type = 'Torrent'";
		
		$db = new SQLite3(getDataBaseLocation());
		$results = $db->query($query);
		
		$data = $results->fetchArray(SQLITE3_ASSOC);
		$db->close();
		
		return $data['t'];
	}
	
	
	/**
	 * Network Usage
	 */
	function getNetworkUsage(){
		// invoke
		$result = executeShellCommand(getCommand("vnstat"));

		// operations
		$data = explode("\n", $result);

		// return
		return $data;
	}
	
	/**
 	 * Get public IP
 	 */
	function getPublicIP() {
		// get public IP
		$ip = rtrim(file_get_contents(getConf("system_param_know_ip")));

		// return
		return $ip;
	}
	
	//  NETWORK :: END
	// ----------------------------------------------------------------------------			
	
		
	
	//  SOFTWARE :: START
	// ----------------------------------------------------------------------------			
		
	/**
	 * Directory tree with software
	 */ 
	function getSoftware(){
		// invoke
		$result = executeShellCommand(getCommand("tree") . " " . getConf("system_param_software_dir"));

		$data = explode("\n", $result);
		
		// return
		return $data;
	}
		
	//  SOFTWARE :: END
	// ----------------------------------------------------------------------------			
		
		
		
	//  ALERTS :: START
	// ----------------------------------------------------------------------------		
	/**
	 * All alerts
	 */
	 function getAlerts($type) {
		 
		if ($type == "All") {
			$query = "select id, type, info, value, date, show from alert where show = 1 order by date desc limit 500";	 
		} else {
			$query = "select id, type, info, value, date, show from alert where show = 1 and type = '$type' order by date desc limit 500"; 
		}
		
		
		$db = new SQLite3(getDataBaseLocation());
		$results = $db->query($query);
		
		$data = array();
        while($row = $results->fetchArray(SQLITE3_ASSOC)){ 
          array_push($data, $row);
        } 

		$db->close();
		return $data;
	}

	/**
	 * All alerts
	 */
	 function getDahsBoardAlerts() {
		$query = "select id, type, info, value, date, show from alert where show = 0";
		
		$db = new SQLite3(getDataBaseLocation());
		$results = $db->query($query);
		
		$data = array();
        while($row = $results->fetchArray(SQLITE3_ASSOC)){ 
          array_push($data, $row);
        } 

		$db->close();
		return $data;
	}
	
	//  ALERTS :: END
	// ----------------------------------------------------------------------------			
	
	
	/**
	 * Last XY for graphics
	 */
	function getLastValuesXY($q) {
		$db = new SQLite3(getDataBaseLocation());
		$results = $db->query($q);
		
 		$data = array(); 
		
		$i = 0; 
        while($res = $results->fetchArray(SQLITE3_ASSOC)){ 
           $data[$i]['x'] = $res['x']; 
           $data[$i]['y'] = $res['y']; 
           
           $i++; 
        } 

		$db->close();
		return json_encode($data);
	}
	

?>
