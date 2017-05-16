<?php	
	// Database file
	function getDataBaseLocation() {
		return "/var/rpi-server/rpi-server.db";
	}
	
	
	/**
	 * Get parameter cfg
	 */
	function getConf($key) {
		$query = "select value as v from conf where key = '$key'";
		
		$db = new SQLite3(getDataBaseLocation());
		$results = $db->query($query);
		
		$data = $results->fetchArray(SQLITE3_ASSOC);
		$db->close();
		
		return $data['v'];
	}


	/**
	 * Get command
	 */
	function getCommand($key) {
		$query = "select command as c from command where name = '$key'";
		
		$db = new SQLite3(getDataBaseLocation());
		$results = $db->query($query);
		
		$data = $results->fetchArray(SQLITE3_ASSOC);
		$db->close();
		
		return $data['c'];
	}
	
	/**
	 * Actual date
	 */
	function today() {
		return date("Y-m-d H:i");
	}

	// Command executor
	function executeCommand($command) {
		return exec($command);
	}
	
	// Command executor
	function executeShellCommand($command) {
		return shell_exec($command);
	}
?>