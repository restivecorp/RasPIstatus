<?php
	include ("metrics.php"); 
		
		
	// Parsear paramentros
	if (isset($_GET["o"]) && $_GET["o"] == "r") {
		showAlert(1);
	}

	if (isset($_GET["o"]) && $_GET["o"] == "p") {
		showAlert(0);
	}
	
	if (isset($_GET["o"]) && $_GET["o"] == "c") {
		clearAll();
	}
	
	// show alert
	function showAlert($status) {
		$id = $_GET["id"];
		
		$query = "update alert set show = $status where id = $id;";
				
		$db = new SQLite3(getDataBaseLocation());
		$db->exec($query);

		$db->close();

		if ($status == 0) {
			header("Location: ../alerts.php");
			die();			
		}
		
		if ($status == 1) {
			header("Location: ../cm.php");
			die();	
		}
	}
	
	// clear all
	function clearAll() {		
		$query = "update alert set show = 1;";
				
		$db = new SQLite3(getDataBaseLocation());
		$db->exec($query);

		$db->close();

		header("Location: ../cm.php");
		die();	
	}
?>