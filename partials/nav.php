		<?php  
			function active($page){
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
				<li class="<?php echo active("index.php") ?>"><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li class="<?php echo active("system.php") ?>"><a href="system.php"><i class="fa fa-desktop"></i> System</a></li>
				<li class="<?php echo active("processor.php") ?>"><a href="processor.php"><i class="fa fa-cogs"></i> Processor</a></li>
				<li class="<?php echo active("temp.php") ?>"><a href="temp.php"><i class="fa fa-neuter"></i> Temperature</a></li>
				<li class="<?php echo active("memory.php") ?>"><a href="memory.php"><i class="fa fa-battery-3"></i> Memory</a></li>
				<li class="<?php echo active("storage.php") ?>"><a href="storage.php"><i class="fa fa-database"></i> Storage</a></li>
				<li class="<?php echo active("network.php") ?>"><a href="network.php"><i class="fa fa-bolt"></i> Network</a></li>
				<!--<li class="<?php echo active("security.php") ?>"><a href="#"><i class="fa fa-lock"></i> Security</a></li>-->
				<li class="<?php echo active("services.php") ?>"><a href="services.php"><i class="fa fa-cubes"></i> Services</a></li>
			</ul>
		</nav>