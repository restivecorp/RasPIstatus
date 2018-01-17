<!doctype html>
<html lang="es" class="no-js">

<?php require_once('_partials/header.php'); ?> 

<body>
	
	<?php require_once('_partials/brand.php'); ?> 

	<div class="ts-main-content">
		<?php require_once('_partials/nav.php'); ?> 

		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Dashboard</h2>

						<div class="panel panel-default">
							<div class="panel-heading">
								System Alerts
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12">
										<p class="text-center"><i class="fa fa-bell-o" aria-hidden="true"></i> <a href="alerts.php">Show all alerts</a></p>
										<?php 
											$alerts = getDahsBoardAlerts();
										?>
										
										<?php 
											if (sizeof($alerts) > 0) {
										?>
										<table id="t_cm" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
											<thead>
												<tr>
													<th>Date</th>
													<th>Type</th>
													<th>Message</th>
													<th>Value</th>
													<th>State</th>
												</tr>
											</thead>

											<tbody>
												<?php  
													foreach ($alerts as $a){													
														echo "<tr>";
															echo "<td>". $a['date'] ."</td>";
															echo "<td>". $a['type'] ."</td>";
															echo "<td>". $a['info'] ."</td>";
															echo "<td>". $a['value'] ."</td>";

															echo "<td><a href=\"php/web.php?o=r&id=".$a['id']."\"><i class=\"fa fa-square-o\" aria-hidden=\"true\"></i> Check</a></td>";
														echo "</tr>";
													}
												?>
											</tbody>
										</table>
										
										<p class="text-center">
											<a href="php/web.php?o=c"><i class="fa fa-recycle" aria-hidden="true"></i> Clear all</a>
										</p>
										
										<?php 
											}
										?>
									</div>
								</div>
							</div>
						</div>
				
						
						<div class="panel panel-default">
					<div class="panel-heading">
						System Controls
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-3">
												<div class="panel panel-default">
													<?php 				
														$color = "success";
													?>
													<div class="panel-body bk-<?php echo $color; ?> text-light">
														<div class="stat-panel text-center">
															<div class="stat-panel-number h1 "><?php echo getTasks(); ?></div>
															<div class="stat-panel-title text-uppercase">Tasks</div>
														</div>
													</div>	
													<a href="processor.php" class="block-anchor panel-footer text-center">+info &nbsp; <i class="fa fa-arrow-right"></i></a>													
												</div>
											</div>	
		
											
											<?php 
												$load = getLoad();
											?>
											<div class="col-md-3">
												<div class="panel panel-default">
													<?php 
														$color = "primary";

														if ($load[0] > getConf('control_param_load1')) {
															$color = "warning";
														} else {
															$color = "success";
														}
													?>
													<div class="panel-body bk-<?php echo $color; ?> text-light">
														<div class="stat-panel text-center">
															<div class="stat-panel-number h1 "><?php echo $load[0]; ?></div>
															<div class="stat-panel-title text-uppercase">Load 1m</div>
														</div>
													</div>
													<a href="processor.php" class="block-anchor panel-footer text-center">+info &nbsp; <i class="fa fa-arrow-right"></i></a>													
												</div>
											</div>


											<div class="col-md-3">
												<div class="panel panel-default">
													<?php 
														$color = "primary";

														if ($load[1] > getConf('control_param_load5')) {
															$color = "warning";
														} else {
															$color = "success";
														}
													?>
													<div class="panel-body bk-<?php echo $color; ?> text-light">
														<div class="stat-panel text-center">
															<div class="stat-panel-number h1 "><?php echo $load[1]; ?></div>
															<div class="stat-panel-title text-uppercase">Load 5m</div>
														</div>
													</div>
													<a href="processor.php" class="block-anchor panel-footer text-center">+info &nbsp; <i class="fa fa-arrow-right"></i></a>													
												</div>
											</div>
											

											<div class="col-md-3">
												<div class="panel panel-default">
													<?php 
														$color = "primary";

														if ($load[2] > getConf('control_param_load15')) {
															$color = "warning";
														} else {
															$color = "success";
														}
													?>
													<div class="panel-body bk-<?php echo $color; ?> text-light">
														<div class="stat-panel text-center">
															<div class="stat-panel-number h1 "><?php echo $load[2]; ?></div>
															<div class="stat-panel-title text-uppercase">Load 15m</div>
														</div>
													</div>
													<a href="processor.php" class="block-anchor panel-footer text-center">+info &nbsp; <i class="fa fa-arrow-right"></i></a>													
												</div>
											</div>									
											
											<div class="col-md-3">
												<div class="panel panel-default">
													<?php 
														$temp = getTemp();
														$color = "primary";

														if ($temp > getConf('control_param_temp')) {
															$color = "warning";
														} else {
															$color = "success";
														}
													?>
													<div class="panel-body bk-<?php echo $color; ?> text-light">
														<div class="stat-panel text-center">
															<div class="stat-panel-number h1 "><?php echo round($temp); ?>&#176;C</div>
															<div class="stat-panel-title text-uppercase">Temperature</div>
														</div>
													</div>
													<a href="temp.php" class="block-anchor panel-footer text-center">+info &nbsp; <i class="fa fa-arrow-right"></i></a>
												</div>
											</div>
											
											<div class="col-md-3">
												<div class="panel panel-default">
													<?php 
														$usrs = getUserLogin();
														$color = "primary";

														if ($usrs > getConf('control_param_users')) {
															$color = "info";
														} else {
															$color = "success";
														}
													?>
													<div class="panel-body bk-<?php echo $color; ?> text-light">
														<div class="stat-panel text-center">
															<div class="stat-panel-number h1 "><?php echo $usrs; ?></div>
															<div class="stat-panel-title text-uppercase">Users</div>
														</div>
													</div>	
													<a href="system.php" class="block-anchor panel-footer text-center">+info &nbsp; <i class="fa fa-arrow-right"></i></a>													
												</div>
											</div>

											<?php 
												$mem = getMemory();
											?>											
											<div class="col-md-3">
												<div class="panel panel-default">
													<?php 
														$color = "primary";

														if ($mem[3] < getConf('control_param_mem_libre')) {
															$color = "warning";
														} else {
															$color = "success";
														}
													?>
													<div class="panel-body bk-<?php echo $color; ?> text-light">
														<div class="stat-panel text-center">
															<div class="stat-panel-number h1 "><?php echo $mem[3]; ?></div>
															<div class="stat-panel-title text-uppercase">Mem. free</div>
														</div>
													</div>	
													<a href="memory.php" class="block-anchor panel-footer text-center">+info &nbsp; <i class="fa fa-arrow-right"></i></a>													
												</div>
											</div>

											
											<div class="col-md-3">
												<div class="panel panel-default">
													<?php 
														$color = "primary";

														if ($mem[5] > getConf('control_param_mem_cache')) {
															$color = "warning";
														} else {
															$color = "success";
														}
													?>
													<div class="panel-body bk-<?php echo $color; ?> text-light">
														<div class="stat-panel text-center">
															<div class="stat-panel-number h1 "><?php echo $mem[5]; ?></div>
															<div class="stat-panel-title text-uppercase">Mem. Cached</div>
														</div>
													</div>	
													<a href="memory.php" class="block-anchor panel-footer text-center">+info &nbsp; <i class="fa fa-arrow-right"></i></a>													
												</div>
											</div>

											
											<div class="col-md-3">
												<div class="panel panel-default">
													<?php 
														$dwn = getCountDownloadsTemp();
														$color = "info";

														if ($dwn > 0) {
															$color = "info";
														} else {
															$color = "success";
														}
													?>									
													<div class="panel-body bk-<?php echo $color; ?> text-light">
														<div class="stat-panel text-center">
															<div class="stat-panel-number h1 "><?php echo $dwn; ?></div>
															<div class="stat-panel-title text-uppercase">Downloads</div>
														</div>
													</div>
													<a href="network.php" class="block-anchor panel-footer text-center">+info &nbsp; <i class="fa fa-arrow-right"></i></a>
												</div>
											</div>
											
											
											<div class="col-md-3">
												<div class="panel panel-default">
													<?php 
														$boot = getStorage("/boot", "M")[3];
														$color = "primary";
														
														if (preg_replace("[M]", "", $boot) < getConf('control_param_store_boot')) {
															$color = "warning";
														} else {
															$color = "success";
														}
													?>
													<div class="panel-body bk-<?php echo $color; ?> text-light">
														<div class="stat-panel text-center">
															<div class="stat-panel-number h1 "><?php echo $boot; ?></div>
															<div class="stat-panel-title text-uppercase">Free /boot</div>
														</div>
													</div>
													<a href="storage.php" class="block-anchor panel-footer text-center">+info &nbsp; <i class="fa fa-arrow-right"></i></a>													
												</div>
											</div>
											
											
											<div class="col-md-3">
												<div class="panel panel-default">
													<?php 
														$root = getStorage("/")[3];
														$color = "primary";
														
														if (preg_replace("[G]", "", $root) < getConf('control_param_store_root')) {
															$color = "warning";
														} else {
															$color = "success";
														}
													?>
													<div class="panel-body bk-<?php echo $color; ?> text-light">
														<div class="stat-panel text-center">
															<div class="stat-panel-number h1 "><?php echo $root; ?></div>
															<div class="stat-panel-title text-uppercase">Free /</div>
														</div>
													</div>
													<a href="storage.php" class="block-anchor panel-footer text-center">+info &nbsp; <i class="fa fa-arrow-right"></i></a>													
												</div>
											</div>


											<div class="col-md-3">
												<div class="panel panel-default">
													<?php 
														$sda1 = getStorage('/dev/sda1')[3];
														$color = "primary";
														
														if (preg_replace("[G]", "", $sda1) < getConf('control_param_store_hd')) {
															$color = "warning";
														} else {
															$color = "success";
														}
													?>
													<div class="panel-body bk-<?php echo $color; ?> text-light">
														<div class="stat-panel text-center">
															<div class="stat-panel-number h1 "><?php echo $sda1; ?></div>
															<div class="stat-panel-title text-uppercase">Free /dev/sda1</div>
														</div>
													</div>
													<a href="storage.php" class="block-anchor panel-footer text-center">+info &nbsp; <i class="fa fa-arrow-right"></i></a>													
												</div>
											</div>

											<div class="col-md-6">
												<div class="panel panel-default">
													<?php 
														$color = "primary";
													?>
													<div class="panel-body bk-<?php echo $color; ?> text-light">
														<div class="stat-panel text-center">
															<div class="stat-panel-number h1 "><?php echo getUptime(); ?></div>
															<div class="stat-panel-title text-uppercase">Uptime</div>
														</div>
													</div>
													<a href="system.php" class="block-anchor panel-footer text-center">+info &nbsp; <i class="fa fa-arrow-right"></i></a>													
												</div>
											</div>

											<div class="col-md-6">
												<div class="panel panel-default">
													<?php 
														$uu = getLastUpdateDays();
														$color = "info";

														if ($uu > getConf('control_param_update')) {
															$color = "info";
														} else {
															$color = "success";
														}
													?>	
													<div class="panel-body bk-<?php echo $color; ?> text-light">
														<div class="stat-panel text-center">
															<div class="stat-panel-number h1 "><?php echo $uu; ?></div>
															<div class="stat-panel-title text-uppercase">Days whitout update/upgrade</div>
														</div>
													</div>
													<a href="system.php" class="block-anchor panel-footer text-center">+info &nbsp; <i class="fa fa-arrow-right"></i></a>
												</div>
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<?php require_once('_partials/footer.php'); ?> 
</body>

</html>