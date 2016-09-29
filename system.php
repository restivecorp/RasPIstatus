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
						<h2 class="page-title">System</h2>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">General System Parameters</div>
					<div class="panel-body">
						<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
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
									<td>Uptime</td>
									<td><?php echo getUptime(); ?></td>
								</tr>
								<tr>
									<td>Time</td>
									<td><?php echo getTime(); ?></td>
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