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
						<h2 class="page-title">Donwloads</h2>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">
						Network parameters
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<ul>
									<li>
										<i class="fa fa-angle-double-right"></i>
										<strong>Public IP:</strong> <?php echo getPublicIP(); ?>
									</li>
									
									<li>
										<i class="fa fa-angle-double-right"></i>
										<strong>Torrent download:</strong> <?php echo getCountTorrents(); ?>
									</li>
								</ul>								
							</div>
						</div>
					</div>
				</div>
			
				<div class="panel panel-default">
					<div class="panel-heading">
						Active donwloads
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">

								<?php 
									$ad = getCountDownloadsTemp();
									if ($ad > 0) { 
										$dwn = getDownloadsName();
										
										echo "<pre>";
										echo $dwn[0];
										echo "</pre>";
										
										echo "<pre>";
										for ($i = 1; $i < count($dwn) -2; $i++) {
											echo $dwn[$i] . "</br>";
										}
										echo "</pre>";
										
									}else{
										echo "No active donwloads.";
									}
								?>
							</div>
						</div>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">
						Downloads completed without move
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">

								<?php 
									$fd = getCountDownloadsFinished();
								
									if ($fd > 0) { 
										$ds = getDownloadsFinished();
										echo "<pre>";
									
										for ($i = 1; $i < count($ds); $i++) {
											echo $ds[$i] . "</br>";
										}
										echo "</pre>";
									}else{
										echo "No downloads completed without move.";
									}
								?>
							</div>
						</div>
					</div>
				</div>
							

				<div class="panel panel-default">
					<div class="panel-heading">
						Network usage (vnstat)
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">

								<?php 
									$nu = getNetworkUsage();

									echo "<pre>";								
									for ($i = 0; $i < count($nu); $i++) {
										echo $nu[$i] . "</br>";
									}
									echo "</pre>";
								?>
							</div>
						</div>
					</div>
				</div>

							
				<div class="panel panel-default">
					<div class="panel-heading">
						Downloads in actual year
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								
								<div id="legendDiv"><p class="text-center"><strong>Downloads by month</strong></p></div>
								<div class="chart">
									<canvas id="barChart"></canvas>
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
			var ctx = document.getElementById("barChart").getContext("2d");
			window.myBar = new Chart(ctx).Bar(barChartData, {
				responsive : true
			});
		}
		
		var barChartData = {
			labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
			datasets: [
				{
					fillColor: "rgba(151,187,205,0.5)",
						strokeColor: "rgba(151,187,205,0.8)",
						highlightFill: "rgba(151,187,205,0.75)",
						highlightStroke: "rgba(151,187,205,1)",
						data: [
							<?php echo getDownloadsMonth('01'); ?>, 
							<?php echo getDownloadsMonth('02'); ?>, 
							<?php echo getDownloadsMonth('03'); ?>, 
							<?php echo getDownloadsMonth('04'); ?>, 
							<?php echo getDownloadsMonth('05'); ?>, 
							<?php echo getDownloadsMonth('06'); ?>, 
							<?php echo getDownloadsMonth('07'); ?>, 
							<?php echo getDownloadsMonth('08'); ?>, 
							<?php echo getDownloadsMonth('09'); ?>, 
							<?php echo getDownloadsMonth('10'); ?>, 
							<?php echo getDownloadsMonth('11'); ?>, 
							<?php echo getDownloadsMonth('12'); ?>]
				}
			]
		}

	</script>

	<?php require_once('_partials/footer.php'); ?> 

</body>

</html>
