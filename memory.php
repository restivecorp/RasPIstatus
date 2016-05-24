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
                                        <?php if ($memory[3] < 50) { ?>
												<i class="fa fa-bomb"></i>
                                        <?php  } ?>
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
								<div class="chart">
									<canvas id="lineChart"></canvas>
								</div>
								<div id="legendDiv"></div>
							</div>
						</div>
					</div>
			</div>
			
			<div class="panel panel-default">
						<div class="panel-heading">
							Process 
						</div>
					<div class="panel-body">				
						<div class="row">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>PID</th>
										<th>% Mem</th>
										<th>Command</th>
									</tr>
								</thead>
								<tbody>
								<?php 
									$ml = getMemoryLeaks();
									
									for ($i = 1; $i <= count($ml) - 2; $i++) {
										echo "<tr>";
											$data = explode(" ", $ml[$i]);
											echo "<th scope=\"row\">" . $i . "</th>";
											echo "<td>" . $data[0] . "</td>";
											echo "<td>" . $data[1] . "</td>";
											echo "<td>" . $data[2] . "</td>";
										echo "</tr>";
									}
									?>
								</tbody>
							</table>
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

			$mu = json_decode(getLastMemUsedValues($max));
			
			$labels = "";
			$values = "";

			foreach($mu as $obj){
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

	<?php require_once('partials/footer.php'); ?> 

</body>

</html>
