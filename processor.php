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
						<h2 class="page-title">Processor</h2>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">General Processor Parameters</div>
					<div class="panel-body">
						<?php  
							$load = getLoad();
						?>

						<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Parameter</th>
									<th>Value</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>Load 1m</td>
									<td><?php echo $load[0]; ?></td>
								</tr>
								<tr>
									<td>Load 5m</td>
									<td><?php echo $load[1]; ?></td>
								</tr>
								<tr>
									<td>Load 15m</td>
									<td><?php echo $load[2]; ?></td>
								</tr>
								<tr>
									<td>Frecuency</td>
									<td><?php echo getFrecuency(); ?></td>
								</tr>
								<tr>
									<td>Voltage</td>
									<td><?php echo getVoltage(); ?></td>
								</tr>
								<tr>
									<td>Scaling</td>
									<td><?php echo getScaling(); ?></td>
								</tr>
							</tbody>
						</table>

					</div>
				</div>
			</div>
		</div>
	</div>

	<?php require_once('partials/footer.php'); ?> 

</body>

</html>