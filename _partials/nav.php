		<?php  			
			function activeMenu($page){
				$filename = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
				
				if (strpos($filename, '/') !== FALSE ){
					$path = explode('/', $filename);
					$part = array_pop($path); 
				}
				
				if ($part == ""){
					$part = "index.php";
				}
				
				if ($page == $part) {
					return "open";
				}

				return "";
			}
		?>

		<nav class="ts-sidebar">
			<ul class="ts-sidebar-menu">
				<li class="ts-label">Menu</li>
				
				<li class="<?php echo activeMenu("cm.php") ?>"><a href="cm.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				
				<li class="<?php echo activeMenu("system.php") ?>"><a href="system.php"><i class="fa fa-microchip"></i> System</a></li>
				
				<li class="<?php echo activeMenu("processor.php") ?>"><a href="processor.php"><i class="fa fa-cogs"></i> Processor</a></li>
						
				<li class="<?php echo activeMenu("temp.php") ?>"><a href="temp.php"><i class="fa fa-thermometer-half"></i> Temperature</a></li>
						
				<li class="<?php echo activeMenu("memory.php") ?>"><a href="memory.php"><i class="fa fa-battery-3"></i> Memory</a></li>
											
				<li class="<?php echo activeMenu("storage.php") ?>"><a href="storage.php"><i class="fa fa-database"></i> Storage</a></li>
				
				<li class="<?php echo activeMenu("network.php") ?>"><a href="network.php"><i class="fa fa-wifi"></i> Network</a></li>
								
				<li class="<?php echo activeMenu("software.php") ?>"><a href="software.php"><i class="fa fa-puzzle-piece"></i> Software</a></li>
			</ul>
		</nav>