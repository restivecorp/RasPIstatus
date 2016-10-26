<?php
	if (isset($argv)) {
		main($argv);	
	}
	
	function main($argv) {
		if (!isset($argv[1])) {
			print("Requiere one parameter:\n");
			print("-----------------------\n");
			print("   * -t: To measure Temperature\n");
			print("   * -m: To measure Memory\n");
			print("   * -ip: Public IP\n");
			return;
		}
    	if ($argv[1] == "-t") {
			measureTemp();
			return;			
    	}
       	if ($argv[1] == "-m") {
    		measureMem();
			return;
    	}
       	if ($argv[1] == "-ip") {
    		knowIP();	
			return;    		
    	}    	
	}

	/** 
		---------------------------------------------
					Configure variables 
		---------------------------------------------
	**/
	
	// nework interface to monitorice metrics
	$IFACE = "eth0";
	
	// directory to count downloads (transmission downloads)
	$DWNDIR = "/media/downloads/.incoming";
	
	// directory to list downloads finished (transmission downloads)
	$DWNFINDIR = "/media/downloads";

	// Database file
	function getDataBaseLocation() {
		return "/var/rpistatus/metrics.db";
	}
	
	
	/** 
		---------------------------------------------
					System parameters 
		---------------------------------------------
	**/
	
	
	/**
 	 * Distribution
 	 */
	function getDistribution() {
		// invoke
		$result = executeCommand("cat /etc/os-release | grep PRETTY");

		// return
		return explode('=', $result)[1];//.replace("\"", "");
	}

	
	/**
 	 * Firmware
 	 */
	function getFirmware() {
		// invoke
		$result = executeCommand("cat /proc/version | cut -c 148-151");

		// return
		return $result;
	}	
	
	
	/**
 	 * Kernel
 	 */
	function getKernel() {
		// invoke
		$result = executeCommand("uname -msr");

		// return
		return $result;
	}

	
	/**
 	 * Processor
 	 */
	function getProcessor() {
		// invoke
		$result = executeCommand("cat /proc/cpuinfo | grep model | awk ' NR == 1 '");

		// return
		return explode(':', $result)[1];
	}	
	

	/**
 	 * Time
 	 */
	function getTime() {
		// invoke
		$result = executeCommand("date");

		// return
		return $result;
	}


	/**
	 * Uptime
	 */
	function getUptime(){
		// invoke
		$result = executeCommand("cat /proc/uptime");

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
		return $dias . "d " . $hr . "h " . $mn . "m " . $sg . "s";
	}	
	
	
	
	/** 
		---------------------------------------------
					Processor parameters 
		---------------------------------------------
	**/
	
	
	/**
 	 * Frecuency
 	 */
	function getFrecuency() {
		// invoke
		$result = (float) executeCommand("cat /sys/devices/system/cpu/cpu0/cpufreq/scaling_cur_freq");

		//operations
		$result = $result / 1000;
		$result = round($result, 2);

		// return
		return $result . "Mhz";
	}
	
	/**
 	 * Load CPU
 	 */
	function getLoad() {
		// invoke
		$result = executeCommand("uptime");

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
 	 * Scaling
 	 */
	function getScaling() {
		// invoke
		$result = executeCommand("cat /sys/devices/system/cpu/cpu0/cpufreq/scaling_governor");

		// return
		return $result;
	}
	
	
	
	/** 
		---------------------------------------------
					Temperature parameters 
		---------------------------------------------
	**/
	
	
	/**
	 * CPU temp
	 */
	function getTemp(){
		// invoke
		$result = (float) executeCommand("cat /sys/class/thermal/thermal_zone0/temp");

		//operations
		$result = $result / 1000;
		$result = round($result, 2);

		// return
		return $result;
	}
	
	
	
	/** 
		---------------------------------------------
					Memory parameters 
		---------------------------------------------
	**/
	
	
	/**
	 * Mem 
	 */
	function getMemory(){
		$mem = array(); //0: title, 1 total, 2 used, 3 free , 4 shared, 5 buffers, 6 cached

		// invoke
		$memory = executeCommand("free -m | grep Mem:");

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
		$result = shell_exec("ps aux | awk '{print $2, $4, $11}' | sort -k2r | head -n 11");

		// operations
		$data = explode("\n", $result);

		// return
		return $data;
	}
	
	
	
	/** 
		---------------------------------------------
					Storage parameters 
		---------------------------------------------
	**/
	
	
	/**
	 * Storage
	 */
	function getStorage($mounted, $units = "G"){
		$store = array(); //0 name, 1 total, 2 used, 3 free, 4 percent, 5 mounted on

		// invoke
		$storage = executeCommand("df -B". $units . " " . $mounted);

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
		---------------------------------------------
					Network parameters 
		---------------------------------------------
	**/

	
	/**
 	 * Get public IP
 	 */
	function getPublicIP() {
		// get public IP
		$ip = file_get_contents("http://checkip.amazonaws.com");

		// return
		return $ip;
	}
	
	/**
 	 * Network
 	 */
	function getNetwork($k) {
		$cmd = "";
		if ($k == "D"){
			$cmd = "cat /sys/class/net/".$GLOBALS['IFACE']."/statistics/tx_bytes";
		}

		if ($k == "U"){
			$cmd = "cat /sys/class/net/".$GLOBALS['IFACE']."/statistics/rx_bytes";
		}

		if ($cmd == "") {
			return "err";
		}
		
		// invoke
		$result = executeCommand($cmd);

		// operations
		$result = ((float) $result) / 1024 / 1024; # megas
	
		if (round($result) > 1024){
			$result = $result / 1024;
			$result = round($result, 2) . "Gb";
		} else{
			$result = round($result, 2) . "Mb";
		}

		// return
		return $result;
	}	
	
	/**
	 * Transmission downloads
	 */
	function getDownloads(){
		// invoke
		$result = executeCommand("ls ".$GLOBALS['DWNDIR']." | wc -l");
		
		// return
		return $result;		
	}

	/**
	 * Transmission downloads finished
	 */
	function getDownloadsFinished(){
		// invoke
		$result = shell_exec("ls -lah " . $GLOBALS['DWNFINDIR'] . " | awk '{print $5,$9}'");
		
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
		$result = shell_exec("transmission-remote -l");
		
		// operations
		$downloads = explode("\n", $result);
		
		// return		
		return $downloads;		
	}
	
	
	
	/** 
		---------------------------------------------
					Services parameters 
		---------------------------------------------
	**/	

	/**
	 * Status services
	 */
	function getServices() {
		// invoke
		$result = shell_exec("service --status-all");
		
		// operations
		$services = explode("\n", $result);
		
		// return		
		return $services;	
	}

	

	/** 
		---------------------------------------------
					Store metrics 
		---------------------------------------------
	**/		
	
		
	/**
	 * Save IP in database
	 */
	function knowIP() {
		$db = new SQLite3(getDataBaseLocation());
		$results = $db->query("select ip from network order by id desc limit 1");
		
 		$newIP = getPublicIP();
 		$oldIP = "0.0.0.0";
 		while($row = $results->fetchArray(SQLITE3_ASSOC)) {
        	$oldIP = $row["ip"];
    	}

		$db->close();
	}

	/**
	 * Save temp in database
	 */
	function measureTemp() {
		$actualTemp = getTemp();
		
		$db = new SQLite3(getDataBaseLocation());
		$db->exec("insert into temp (date, temp) values ('". today() . "'," . $actualTemp . ")");		
		$db->close();
	}

	/**
	 * Save mem in database
	 */
	function measureMem() {
		$db = new SQLite3(getDataBaseLocation());
		$mem = getMemory();

		$db->exec("insert into memory (date, total, used, free, shared, buffers, cached) values ('". today() . "'," . $mem[1] . "," . $mem[2] . "," . $mem[3] . "," . $mem[4] . "," . $mem[5] . "," . $mem[6] . ")");		
		$db->close();
	}

	/**
	 * Last temps
	 */
	function getLastTempValues($max) {
		$query = "select substr(date, 12) x, temp y from temp where id in (select id from temp order by id desc limit ".$max.")";
		return getLastValuesXY($query);
	}

	/**
	 * Last mems used
	 */
	function getLastMemUsedValues($max) {
		$query = "select substr(date, 12) x, used y from memory where id in(select id from memory order by id desc limit ".$max.")";
		return getLastValuesXY($query);
	}

	/**
	 * Last mems free
	 */
	function getLastMemFreeValues($max) {
		$query = "select substr(date, 12) x, free y from memory where id in(select id from memory order by id desc limit ".$max.")";
		return getLastValuesXY($query);
	}

	/**
	 * Last XY
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
	
	
	
	/** 
		---------------------------------------------
					Util functions
		---------------------------------------------
	**/	
	
	/**
	 * Command executor
	 */
	function executeCommand($command) {
		return exec($command);
	}

	/**
	 * Actual date
	 */
	function today() {
		return date("Y/m/d H:i");
	}

?>
