<!doctype html>
<html lang="en" class="no-js">

<?php require_once('partials/header_refresh.php'); ?> 

<body>
	
	<?php require_once('partials/brand.php'); ?> 

	<div class="ts-main-content">
		<?php require_once('partials/nav.php'); ?> 

		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Dashboard</h2>
						
						<div class="row">
							<div class="col-md-12">
								<div class="row">

									<div class="col-md-3">
										<div class="panel panel-default">
											<?php 
												$temp = getTemp();
												$color = "primary";

												if ($temp > 50) {
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

									<?php 
										$mem = getMemory()[3];
										$color = "primary";

										if ($mem < 15) {
											$color = "warning";
										} else {
											$color = "success";
										}
									?>
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-<?php echo $color; ?> text-light">
												<div class="stat-panel text-center">
													<div class="stat-panel-number h1 "><?php echo $mem; ?>M</div>
													<div class="stat-panel-title text-uppercase">Free Memory</div>
												</div>
											</div>
											<a href="memory.php" class="block-anchor panel-footer text-center">+info &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>

									<?php 
										$dwn = getDownloads();
										$color = "info";

										if ($dwn > 0) {
											$color = "info";
										} else {
											$color = "success";
										}
									?>
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-<?php echo $color; ?> text-light">
												<div class="stat-panel text-center">
													<div class="stat-panel-number h1 "><?php echo $dwn; ?></div>
													<div class="stat-panel-title text-uppercase">Downloads</div>
												</div>
											</div>
											<a href="network.php" class="block-anchor panel-footer text-center">+info &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>

									<?php 
										$frec = getFrecuency();
										$color = "primary";

										if ($frec < 800) {
											$color = "warning";
										} else {
											$color = "success";
										}
									?>
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-<?php echo $color; ?> text-light">
												<div class="stat-panel text-center">
													<div class="stat-panel-number h1 "><?php echo $frec; ?></div>
													<div class="stat-panel-title text-uppercase">Frecuency</div>
												</div>
											</div>
											<a href="processor.php" class="block-anchor panel-footer text-center">+info &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>

									<div class="col-md-3">
										<div class="panel panel-default">
											<?php 
												$root = getStorageRoot()[3];
												$color = "primary";
												
												if (eregi_replace("[a-zA-Z]", "", $root) < 5) {
													$color = "warning";
												} else {
													$color = "success";
												}
											?>
											<div class="panel-body bk-<?php echo $color; ?> text-light">
												<div class="stat-panel text-center">
													<div class="stat-panel-number h1 "><?php echo $root; ?></div>
													<div class="stat-panel-title text-uppercase">Free in /</div>
												</div>
											</div>
											<a href="storage.php" class="block-anchor panel-footer text-center">+info &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>

									<div class="col-md-3">
										<div class="panel panel-default">
											<?php 
												$boot = getStorageBoot()[3];
												$color = "primary";
												
												if (eregi_replace("[a-zA-Z]", "", $boot) < 1) {
													$color = "warning";
												} else {
													$color = "success";
												}
											?>
											<div class="panel-body bk-<?php echo $color; ?> text-light">
												<div class="stat-panel text-center">
													<div class="stat-panel-number h1 "><?php echo $boot; ?></div>
													<div class="stat-panel-title text-uppercase">Free in /boot</div>
												</div>
											</div>
											<a href="storage.php" class="block-anchor panel-footer text-center">+info &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>

									<div class="col-md-3">
										<div class="panel panel-default">
											<?php 
												$swap = getStoragePublic()[3];
												$color = "primary";
												
												if (eregi_replace("[a-zA-Z]", "", $swap) < 10) {
													$color = "warning";
												} else {
													$color = "success";
												}
											?>
											<div class="panel-body bk-<?php echo $color; ?> text-light">
												<div class="stat-panel text-center">
													<div class="stat-panel-number h1 "><?php echo $swap; ?></div>
													<div class="stat-panel-title text-uppercase">Free in /swap</div>
												</div>
											</div>
											<a href="storage.php" class="block-anchor panel-footer text-center">+info &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>

									<div class="col-md-3">
										<div class="panel panel-default">
											<?php 
												$raspi = getStoragePrivate()[3];
												$color = "primary";
												
												if (eregi_replace("[a-zA-Z]", "", $raspi) < 200) {
													$color = "warning";
												} else {
													$color = "success";
												}
											?>
											<div class="panel-body bk-<?php echo $color; ?> text-light">
												<div class="stat-panel text-center">
													<div class="stat-panel-number h1 "><?php echo $raspi; ?></div>
													<div class="stat-panel-title text-uppercase">Free in /raspi</div>
												</div>
											</div>
											<a href="storage.php" class="block-anchor panel-footer text-center">+info &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>																											
									<?php 
										$ip = getPublicIP();
									?>
									<div class="col-md-12">
										<div class="panel panel-default">
											<div class="panel-body bk-primary text-light">
												<div class="stat-panel text-center">
													<div class="stat-panel-number h1 "><?php echo $ip; ?></div>
													<div class="stat-panel-title text-uppercase">Public IP</div>
												</div>
											</div>
											<a href="network.php" class="block-anchor panel-footer text-center">+info &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>

									<?php 
										$up = getUptime();
									?>
									<div class="col-md-12">
										<div class="panel panel-default">
											<div class="panel-body bk-primary text-light">
												<div class="stat-panel text-center">
													<div class="stat-panel-number h1 "><?php echo $up; ?></div>
													<div class="stat-panel-title text-uppercase">Uptime</div>
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

	<?php require_once('partials/footer.php'); ?> 

</body>

</html>