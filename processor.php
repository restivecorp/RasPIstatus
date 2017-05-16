<!doctype html>
<html lang="en" class="no-js">

<?php require_once('_partials/header.php'); ?> 

<body>
	
	<?php require_once('_partials/brand.php'); ?> 

	<div class="ts-main-content">
		<?php require_once('_partials/nav.php'); ?> 

		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title">Processor</h2>
					</div>
				</div>
				
				<?php 
					$load = getLoad();
				?>
		
				<div class="panel panel-default">
					<div class="panel-heading">
						Load Average CPU
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-3">
								<ul>
									<li>
										<i class="fa fa-angle-double-right"></i>
										<strong>Load 1M:</strong> <?php echo $load[0]; ?>
									</li>
									<li>
										<i class="fa fa-angle-double-right"></i>
										<strong>Load 5M:</strong> <?php echo $load[1]; ?>
									</li>
									<li>
										<i class="fa fa-angle-double-right"></i>
										<strong>Load 15M:</strong> <?php echo $load[2]; ?>
									</li>
								</ul>
							</div>

							<div class="col-md-9">
								<div id="legendDiv"><p class="text-center"><strong>Load Average 15M</strong></p></div>
								<div class="chart">
									<canvas id="lineChart"></canvas>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">
						50 Processes sorted by CPU usage 
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">

								<?php 
									$cpul = getCPULeaks();

									echo "<pre>";								
									for ($i = 0; $i < count($cpul); $i++) {
										echo $cpul[$i] . "</br>";
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

			// Line chart from swirlData
			var ctx = document.getElementById("lineChart").getContext("2d");
			window.myLine = new Chart(ctx).Line(data, {
				responsive: true,
				scaleShowVerticalLines: false,
				multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
			});
		}

		<?php 		
			$load15 = json_decode(getLastLoad15Values());
			
			$labels15 = "";
			$values15 = "";

			foreach($load15 as $obj){
		       $labels15 = $labels15 . "'" . $obj->x ."', ";
		       $values15 = $values15 . "'" . $obj->y ."', ";
			}
		?>

		var data = {
			<?php echo "labels: [".$labels15."]" ?>,
			datasets: [
						{
	            			label: "Load 15M",
				            fillColor: "rgba(151,187,205,0.2)",
				            strokeColor: "rgba(151,187,205,1)",
				            pointColor: "rgba(151,187,205,1)",
				            pointStrokeColor: "#fff",
				            pointHighlightFill: "#fff",
				            pointHighlightStroke: "rgba(151,187,205,1)",
	            			<?php echo "data: [".$values15."]" ?>
	        			}
					]
			};

	</script>

	<?php require_once('_partials/footer.php'); ?> 

</body>

</html>
