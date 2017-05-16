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
						<h2 class="page-title">System</h2>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">General parameters</div>
					<div class="panel-body">
						<table id="t_system" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Parameter</th>
									<th>Value</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>Processor</td>
									<td><?php echo getProcessor(); ?></td>
								</tr>
								<tr>
									<td>Distribution</td>
									<td><?php echo getDistribution(); ?></td>
								</tr>
								<tr>
									<td>Kernel</td>
									<td><?php echo getKernel(); ?></td>
								</tr>
								<tr>
									<td>Firmware</td>
									<td><?php echo getFirmware(); ?></td>
								</tr>
								<tr>
									<td>Frecuency</td>
									<td><?php echo getFrecuency(); ?></td>
								</tr>
								<tr>
									<td>Scaling</td>
									<td><?php echo getScaling(); ?></td>
								</tr>
								<tr>
									<td>Users SSH</td>
									<td><?php echo getUserLogin(); ?></td>
								</tr>
								<tr>
									<td>Date</td>
									<td><?php echo getTime(); ?></td>
								</tr>
								<tr>
									<td>Uptime</td>
									<td><?php echo getUptime(); ?></td>
								</tr>
								<tr>
									<td>Last update/upgrade</td>
									<td>Since <?php echo getLastUpdate(); ?></td>
								</tr>								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php require_once('_partials/footer.php'); ?> 

</body>

</html>