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
						<h2 class="page-title">Temperature</h2>
					</div>
				</div>
				
				<?php 
					$temp = getTemp();
				?>
		
				<div class="panel panel-default">
					<div class="panel-heading">
						CPU Temperature
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-3">
								<ul>
									<li>
										<i class="fa fa-angle-double-right"></i>
										<strong>CPU:</strong> <?php echo $temp; ?>º C
									</li>
								</ul>
							</div>

							<div class="col-md-9">
								<div id="legendDiv"><p class="text-center"><strong>Temperature</strong></p></div>
								<div class="chart">
									<canvas id="lineChart"></canvas>
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

			// Line chart from swirlData
			var ctx = document.getElementById("lineChart").getContext("2d");
			window.myLine = new Chart(ctx).Line(data, {
				responsive: true,
				scaleShowVerticalLines: false,
				multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
			});
		}

		<?php 
			$temps = json_decode(getLastTempValues());
			
			$labels = "";
			$values = "";

			foreach($temps as $obj){
		       $labels = $labels . "'" . $obj->x ."', ";
		       $values = $values . "'" . $obj->y ."', ";
			}
		?>

		var data = {
			<?php echo "labels: [".$labels."]" ?>,
			datasets: [
    					{
	            			label: "Temperature",
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
