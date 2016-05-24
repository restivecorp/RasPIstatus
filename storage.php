<!doctype html>
<html lang="en" class="no-js">

<?php require_once('partials/header.php'); ?> 

<body>
	
	<?php require_once('partials/brand.php'); ?> 

	<div class="ts-main-content">
		<?php require_once('partials/nav.php'); ?> 

		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title">Storage</h2>
					</div>
				</div>
				
				<?php  
					$root = getStorageRoot();
					$boot = getStorageBoot();
					$public = getStoragePublic();
					$private = getStoragePrivate();
				?>

				<div class="panel panel-default">
					<div class="panel-heading">Storage Size</div>
					<div class="panel-body">
						<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
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
									<td><?php  echo $public[5];?></td>
									<td><?php  echo $public[1];?></td>
									<td><?php  echo $public[2];?></td>
									<td><?php  echo $public[3];?></td>
									<td><?php  echo $public[4];?></td>
									<td><?php  echo $public[0];?></td>
								</tr>																
								<tr>
									<td><?php  echo $private[5];?></td>
									<td><?php  echo $private[1];?></td>
									<td><?php  echo $private[2];?></td>
									<td><?php  echo $private[3];?></td>
									<td><?php  echo $private[4];?></td>
									<td><?php  echo $private[0];?></td>
								</tr>							
							</tbody>
						</table>


						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
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

									<div class="col-md-3">
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

									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-heading"><?php  echo $public[5];?></div>
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
															<canvas id="pieChartPublic" width="1200" height="900" />
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-heading"><?php  echo $private[5];?></div>
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
															<canvas id="pieChartPrivate" width="1200" height="900" />
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

		<script>
	
		window.onload = function(){
			// Pie Chart from doughutData
			var pieChartRoot = document.getElementById("pieChartRoot").getContext("2d");
			window.myDoughnut = new Chart(pieChartRoot).Pie(rootData, {responsive : true});

			var pieChartBoot = document.getElementById("pieChartBoot").getContext("2d");
			window.myDoughnut = new Chart(pieChartBoot).Pie(bootData, {responsive : true});

			var pieChartPublic = document.getElementById("pieChartPublic").getContext("2d");
			window.myDoughnut = new Chart(pieChartPublic).Pie(publicData, {responsive : true});

			var pieChartPrivate = document.getElementById("pieChartPrivate").getContext("2d");
			window.myDoughnut = new Chart(pieChartPrivate).Pie(privateData, {responsive : true});

		}
			var bootData = [
			    {
			        value: <?php  echo eregi_replace("[a-zA-Z]", "", $boot[2]);?>,
			        color:"#F7464A",
			        highlight: "#FF5A5E",
			        label: "Red"
			    },
			    {
			        value: <?php  echo eregi_replace("[a-zA-Z]", "", $boot[3]);?>,
			        color: "#46BFBD",
			        highlight: "#5AD3D1",
			        label: "Green"
			    }
			]

			var rootData = [
				    {
				        value: <?php  echo eregi_replace("[a-zA-Z]", "", $root[2]);?>,
				        color:"#F7464A",
				        highlight: "#FF5A5E",
				        label: "Red"
				    },
				    {
				        value: <?php  echo eregi_replace("[a-zA-Z]", "", $root[3]);?>,
				        color: "#46BFBD",
				        highlight: "#5AD3D1",
				        label: "Green"
				    }
				]

				var publicData = [
				    {
				        value: <?php  echo eregi_replace("[a-zA-Z]", "", $public[2]);?>,
				        color:"#F7464A",
				        highlight: "#FF5A5E",
				        label: "Red"
				    },
				    {
				        value: <?php  echo eregi_replace("[a-zA-Z]", "", $public[3]);?>,
				        color: "#46BFBD",
				        highlight: "#5AD3D1",
				        label: "Green"
				    }
				]

				var privateData = [
				    {
				        value: <?php  echo eregi_replace("[a-zA-Z]", "", $private[2]);?>,
				        color:"#F7464A",
				        highlight: "#FF5A5E",
				        label: "Red"
				    },
				    {
				        value: <?php  echo eregi_replace("[a-zA-Z]", "", $private[3]);?>,
				        color: "#46BFBD",
				        highlight: "#5AD3D1",
				        label: "Green"
				    }
				]		
	</script>

	<?php require_once('partials/footer.php'); ?> 

</body>

</html>