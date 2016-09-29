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
						<h2 class="page-title">Services</h2>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">List of services</div>
					<div class="panel-body">
						<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Service</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php  
									$services = getServices();
									
									for($i = 0; $i < count($services) -1; ++$i) {
										$srv = explode("] ", $services[$i]);
										$status = "";
										$statusClass = "";
										
										if (strpos($srv[0], '+') !== false) {
											$statusClass = "success";
											$status = "Active";
										}else {
											$statusClass = "danger";
											$status = "Stopped";
										}
										
										echo "<tr class=".$statusClass.">";
											echo "<td>".$srv[1]."</td>";
											echo "<td>".$status."</td>";
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

	<?php require_once('partials/footer.php'); ?> 

</body>

</html>