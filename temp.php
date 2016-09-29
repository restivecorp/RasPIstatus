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
						<h2 class="page-title">Temperature</h2>
					</div>
				</div>
				
				<?php 
					$temp = getTemp();
				?>
		
				<div class="panel panel-default">
					<div class="panel-heading">
						CPU Temperature 
						<select name="max" id="max" onChange="refreshCombo()">
							<option value="12">12</option>
							<option value="24">24</option>
							<option value="48">48</option>
							<option value="72">72</option>
						</select>
						hours
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-3">
								<ul>
									<li>
										<i class="fa fa-angle-double-right"></i>
										<strong>CPU:</strong> <?php echo $temp; ?> ?C
									</li>
								</ul>
							</div>

							<div class="col-md-9">
								<div class="chart">
									<canvas id="lineChart"></canvas>
								</div>
								<div id="legendDiv"></div>
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
			$max = 12;
			if (isset($_GET["max"])) {
			    $max = $_GET["max"];
			} 

			$temps = json_decode(getLastTempValues($max));
			
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

	<?php require_once('partials/footer.php'); ?> 

</body>

</html>
