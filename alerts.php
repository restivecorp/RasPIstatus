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
						<h2 class="page-title">Alerts</h2>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">System notifications</div>
					<div class="panel-body">
						<div class="form-group">
							Filter by type:
							
							<p class="text-center">
								| <a href="alerts.php?t=All">All</a>
								| <a href="alerts.php?t=Task">Task</a>
								| <a href="alerts.php?t=System">System</a>
								| <a href="alerts.php?t=Temp">Temperature</a>
								| <a href="alerts.php?t=Memory">Memory</a>
								| <a href="alerts.php?t=Storage">Storage</a>
								| <a href="alerts.php?t=CPU">CPU</a>
								| <a href="alerts.php?t=Torrent">Torrent</a>
								| 
							</p>
						</div>
												
						<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Date</th>
									<th>Type</th>
									<th>Message</th>
									<th>Value</th>
									<th>State</th>
								</tr>
							</thead>

							<tbody>
								<?php  
									$t = $_GET["t"];
									if (!isset ($t)) {
										$t = "All";
									}
									$alerts = getAlerts($t);
									foreach ($alerts as $a){
										echo "<tr>";
											echo "<td>". $a['date'] ."</td>";
											echo "<td>". $a['type'] ."</td>";
											echo "<td>". $a['info'] ."</td>";
											echo "<td>". $a['value'] ."</td>";
											
											if ($a['show'] == '0') {
												echo "<td><i class=\"fa fa-square-o\" aria-hidden=\"true\"></i> Pendiente</td>";	
											} else {
												echo "<td><a href=\"php/web.php?o=p&id=".$a['id']."\"><i class=\"fa fa-check-square-o\" aria-hidden=\"true\"></i> Resolved</a></td>";	
											}
																						
										echo "</tr>";
									}
								?>	
							</tbody>
						</table>
						<p class="text-right"><small>* Only show last 500 records</small></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php require_once('_partials/footer.php'); ?> 

</body>

</html>