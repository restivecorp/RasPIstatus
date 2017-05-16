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
						<h2 class="page-title">Memory</h2>
					</div>
				</div>
				
				<?php 
					$memory = getMemory();
					$percetUsed = ($memory[2] / $memory[1]) * 100;
					$percetUsed = round($percetUsed, 2);
				?>
		
				<div class="panel panel-default">
					<div class="panel-heading">
						Memory usage
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<div class="progress">
									<div class="progress-bar progress-bar-warning" style="width: <?php echo $percetUsed; ?>%">Used</div>
									<div class="progress-bar progress-bar-success" style="width: <?php echo (100 - $percetUsed); ?>%">Free</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<ul>
									<li>
										<i class="fa fa-angle-double-right"></i>
										<strong>Total:</strong> <?php echo $memory[1]; ?>Mb
									</li>

									<li>
										<i class="fa fa-angle-double-right"></i>
										<strong>Used:</strong> <?php echo $memory[2]; ?>Mb
									</li>

									<li>
										<i class="fa fa-angle-double-right"></i>
										<strong>Free:</strong> <?php echo $memory[3]; ?>Mb
									</li>

									<li>
										<i class="fa fa-angle-double-right"></i>
										<strong>Shared:</strong> <?php echo $memory[4]; ?>Mb
									</li>

									<li>
										<i class="fa fa-angle-double-right"></i>
										<strong>Buffers:</strong> <?php echo $memory[5]; ?>Mb
									</li>

									<li>
										<i class="fa fa-angle-double-right"></i>
										<strong>Cached:</strong> <?php echo $memory[6]; ?>Mb
									</li>
								</ul>
							</div>

							<div class="col-md-9">
								<div id="legendDiv"><p class="text-center"><strong>Memory used</strong></p></div>
								<div class="chart">
									<canvas id="lineChart"></canvas>
								</div>
							</div>							
						</div>
					</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					50 Processes sorted by memory usage 
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">

							<?php 
								$ml = getMemoryLeaks();

								echo "<pre>";								
								for ($i = 0; $i < count($ml); $i++) {
									echo $ml[$i] . "</br>";
								}
								echo "</pre>";
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		window.onload = function(){

			// Line chart from swirlData
			var ctx = document.getElementById("lineChart").getContext("2d");
			window.myLine = new Chart(ctx).Line(data, {
				responsive: true,
				scaleShowVerticalLines: false,
				multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
			});
		}

		<?php 
			$memoryData = json_decode(getLastMemUsedValues());
			
			$labels = "";
			$values = "";

			foreach($memoryData as $obj){
		       $labels = $labels . "'" . $obj->x ."', ";
		       $values = $values . "'" . $obj->y ."', ";
			}

		?>

		var data = {
			<?php echo "labels: [".$labels."]" ?>,
			datasets: [
				        {
				            label: "Used",
				            fillColor: "rgba(151,187,205,0.2)",
				            strokeColor: "rgba(151,187,205,1)",
				            pointColor: "rgba(151,187,205,1)",
				            pointStrokeColor: "#fff",
				            pointHighlightFill: "#fff",
				            pointHighlightStroke: "rgba(151,187,205,1)",
				            <?php echo "data: [".$values."]" ?>
				        }
					]
			};
	</script>
	
	<?php require_once('_partials/footer.php'); ?> 

</body>

</html>
