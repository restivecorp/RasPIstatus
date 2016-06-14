<?php
	
	include("clases/service.class.php");

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
	 * Transmission downloads
	 */
	function getDownloads(){
		// invoke
		$result = executeCommand("ls /media/hd/raspi/.incoming | wc -l");
		
		// return
		return $result;
	}

	/**
	 * Transmission downloads name
	 */
	function getDownloadsName(){
		// invoke
		$result = shell_exec("ls -lh /media/hd/raspi/.incoming");
		
		// operations
		$data = explode("\n", $result);

		// return
		return $data;
	}

	/**
 	 * Network
 	 */
	function getNetwork($k) {
		$cmd = "";
		if ($k == "D"){
			$cmd = "cat /sys/class/net/eth0/statistics/tx_bytes";
		}

		if ($k == "U"){
			$cmd = "cat /sys/class/net/eth0/statistics/rx_bytes";
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
	 * Authentication failed
	 */
	function getFailedAuths(){
		// invoke
		$result = 0;//executeCommand("cat /var/log/auth.* | grep -c Failed");
		
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
	
		$horas = (integer) ($uptime / 3600);
		$uptime = $uptime - ($horas * 3600);

		$minutos = (integer) ($uptime / 60);
		$uptime = $uptime - ($minutos * 60);
	
		$segundos = (integer) ($uptime / 1);
		
		// return
		return $dias . "d " . $horas . "h " . $minutos . "m " . $segundos . "s";
	}

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
 	 * Processor
 	 */
	function getProcessor() {
		// invoke
		$result = executeCommand("cat /proc/cpuinfo | grep model | awk ' NR == 1 '");

		// return
		return explode(':', $result)[1];
	}

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
 	 * Kernel
 	 */
	function getKernel() {
		// invoke
		$result = executeCommand("uname -msr");

		// return
		return $result;
	}

	/**
 	 * Kernel
 	 */
	function getFirmware() {
		// invoke
		$result = executeCommand("cat /proc/version | cut -c 148-151");

		// return
		return $result;
	}

	/**
 	 * Upgrades
 	 */
	function getUpgrades() {
		// invoke
		$result = executeCommand("apt-get upgrade -s");

		// operations
		$t = explode('\n', $result);

		// return
		return array_pop($t);
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
 	 * Voltage
 	 */
	function getVoltage() {
		// invoke
		//$result = executeCommand("vcgencmd measure_volts core");

		return "Permission denied";//$result;
		//return explode('=', $result)[1];
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
	 * Storage
	 */
	function getStorage($k){
		$store = array(); //0 name, 1 total, 2 used, 3 free, 4 percent, 5 mounted on

		// invoke
		$storage = executeCommand("df -BG " . $k);

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

	function getStorageRoot() {
		return getStorage("/");
	}
	function getStorageBoot() {
		return getStorage("/boot");	
	}
	function getStoragePublic() {
		return getStorage("/dev/sda2");
	}
	function getStoragePrivate() {
		return getStorage("/dev/sda1");	
	}

	/**
	 * Status services
	 */
	function getServiceStatus() {

		$services = array();

		$fp = fopen("php/cfg/services.cfg", "r");
		while(!feof($fp)) {
			$s = fgets($fp);
			$name = explode('#', $s)[0];
			
		//	if ($name == "apache2"){
		//		$srv = new Service($name, "active (running)"); 
		//		array_push($services, $srv);
		//	} else {
				$command = "service " . $name . " status | grep Active";
				$result = executeCommand($command);
				
				$result = str_replace('Active: ', '', $result);
					
				$srv = new Service($name, $result); 
				array_push($services, $srv);
		//	}

		}
		fclose($fp);

		// return
		return $services;
	}


	function executeCommand($command) {
		return exec($command);
	}

	function today() {
		return date("Y/m/d H:i");
	}

?>
