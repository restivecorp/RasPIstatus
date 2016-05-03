<?php
	include("metrics.php");
	
	if (isset($argv)) {
		main($argv);	
	}

	function main($argv) {
		if (!isset($argv[1])) {
			print("Requiere one parameter:\n");
			print("-----------------------\n");
			print("   * -t: To measure Temperature\n");
			print("   * -m: To measure Memory\n");
			print("   * -s: To measure Storage\n");
			print("   * -n: To measure Network\n");
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

      	if ($argv[1] == "-s") {
    		print "disco\n";
			return;    	
    	}

       	if ($argv[1] == "-n") {
    		print "red\n";	
			return;    		
    	}    	
	}

	function getDataBaseLocation() {
		return "/var/rpistatus/measuring.db";
	}

	/**
	 * Save temp in database
	 */
	function measureTemp() {
		$db = new SQLite3(getDataBaseLocation());
		$db->exec("insert into temp (date, temp) values ('". today() . "'," . getTemp() . ")");		
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