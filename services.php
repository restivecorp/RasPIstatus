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
									$services = getServiceStatus();

									for($i = 0; $i < count($services); ++$i) {
										echo "<tr class=".$services[$i]->styleClass.">";
											echo "<td>".$services[$i]->name."</td>";
											echo "<td>".$services[$i]->status."</td>";
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