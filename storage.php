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
						<h2 class="page-title">Storage</h2>
					</div>
				</div>
				
				<?php  
					$root = getStorage("/");
					$boot = getStorage("/boot", "M");
					
					$sda1 = getStorage("/dev/sda1");
				?>

				<div class="panel panel-default">
					<div class="panel-heading">Partitios</div>
					<div class="panel-body">
						<table id="t_store" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Mounted on</th>
									<th>Total</th>
									<th>Used</th>
									<th>Free</th>
									<th>Used (%)</th>
									<th>Name</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td><?php  echo $root[5];?></td>
									<td><?php  echo $root[1];?></td>
									<td><?php  echo $root[2];?></td>
									<td><?php  echo $root[3];?></td>
									<td><?php  echo $root[4];?></td>
									<td><?php  echo $root[0];?></td>
								</tr>
								<tr>
									<td><?php  echo $boot[5];?></td>
									<td><?php  echo $boot[1];?></td>
									<td><?php  echo $boot[2];?></td>
									<td><?php  echo $boot[3];?></td>
									<td><?php  echo $boot[4];?></td>
									<td><?php  echo $boot[0];?></td>
								</tr>
								<tr>
									<td><?php  echo $sda1[5];?></td>
									<td><?php  echo $sda1[1];?></td>
									<td><?php  echo $sda1[2];?></td>
									<td><?php  echo $sda1[3];?></td>
									<td><?php  echo $sda1[4];?></td>
									<td><?php  echo $sda1[0];?></td>
								</tr>																							
							</tbody>
						</table>
						
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4">
										<div class="panel panel-default">
											<div class="panel-heading"><?php  echo $root[5];?></div>
											<div class="panel-body">
												<div class="row">
													<div class="col-md-4">
														<ul class="chart-dot-list">
															<li class="a1">Used</li>
															<li class="a2">Free</li>
														</ul>
													</div>
													<div class="col-md-8">
														<div class="chart chart-doughnut">
															<canvas id="pieChartRoot" width="1200" height="900" />
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-4">
										<div class="panel panel-default">
											<div class="panel-heading"><?php  echo $boot[5];?></div>
											<div class="panel-body">
												<div class="row">
													<div class="col-md-4">
														<ul class="chart-dot-list">
															<li class="a1">Used</li>
															<li class="a2">Free</li>
														</ul>
													</div>
													<div class="col-md-8">
														<div class="chart chart-doughnut">
															<canvas id="pieChartBoot" width="1200" height="900" />
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-4">
										<div class="panel panel-default">
											<div class="panel-heading"><?php  echo $sda1[5];?></div>
											<div class="panel-body">
												<div class="row">
													<div class="col-md-4">
														<ul class="chart-dot-list">
															<li class="a1">Used</li>
															<li class="a2">Free</li>
														</ul>
													</div>
													<div class="col-md-8">
														<div class="chart chart-doughnut">
															<canvas id="pieChartSda1" width="1200" height="900" />
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
				
				<div class="panel panel-default">
					<div class="panel-heading">Storage Distribution</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">

								<?php 
									$st = getStorageDistribution();
										
									echo "<pre>";
									for ($i = 0; $i < count($st); $i++) {
										echo $st[$i] . "</br>";
									}
									echo "</pre>";
								?>
							</div>
						</div>						
					</div>
				</div>
				
			</div>
		</div>
	</div>

<script>
	
		window.onload = function(){
			// Pie Chart from doughutData
			var pieChartRoot = document.getElementById("pieChartRoot").getContext("2d");
			window.myDoughnut = new Chart(pieChartRoot).Pie(rootData, {responsive : true});

			var pieChartBoot = document.getElementById("pieChartBoot").getContext("2d");
			window.myDoughnut = new Chart(pieChartBoot).Pie(bootData, {responsive : true});

			var pieChartSda1 = document.getElementById("pieChartSda1").getContext("2d");
			window.myDoughnut = new Chart(pieChartSda1).Pie(sda1Data, {responsive : true});
		}
			var bootData = [
			    {
			        value: <?php  echo preg_replace("[M]", "", $boot[2]);?>,
			        color:"#F7464A",
			        highlight: "#FF5A5E",
			        label: "Used"
			    },
			    {
			        value: <?php  echo preg_replace("[M]", "", $boot[3]);?>,
			        color: "#46BFBD",
			        highlight: "#5AD3D1",
			        label: "Free"
			    }
			]

			var rootData = [
				    {
				        value: <?php  echo preg_replace("[G]", "", $root[2]);?>,
				        color:"#F7464A",
				        highlight: "#FF5A5E",
				        label: "Used"
				    },
				    {
				        value: <?php  echo preg_replace("[G]", "", $root[3]);?>,
				        color: "#46BFBD",
				        highlight: "#5AD3D1",
				        label: "Free"
				    }
				]

				var sda1Data = [
				    {
				        value: <?php  echo preg_replace("[G]", "", $sda1[2]);?>,
				        color:"#F7464A",
				        highlight: "#FF5A5E",
				        label: "Used"
				    },
				    {
				        value: <?php  echo preg_replace("[G]", "", $sda1[3]);?>,
				        color: "#46BFBD",
				        highlight: "#5AD3D1",
				        label: "Free"
				    }
				]		
	</script>


	<?php require_once('_partials/footer.php'); ?> 

</body>

</html>