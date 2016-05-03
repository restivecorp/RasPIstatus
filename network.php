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
						<h2 class="page-title">Network</h2>
					</div>
				</div>
						
				<div class="panel panel-default">
					<div class="panel-heading">
						Network Status since <?php echo getUptime(); ?>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<ul>
									<li>
										<i class="fa fa-angle-double-right"></i>
										<strong>Public IP:</strong> <?php echo getPublicIP(); ?>
									</li>

									<li>
										<i class="fa fa-angle-double-right"></i>
										<strong>Donwloaded:</strong> <?php echo getNetwork("D"); ?>
									</li>

									<li>
										<i class="fa fa-angle-double-right"></i>
										<strong>Uploaded:</strong> <?php echo getNetwork("U"); ?>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">
						Active Donwloads
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">

								<?php 
									$ad = getDownloads();

									if ($ad > 0) { 
										$dwn = getDownloadsName();
										echo "<ul>";
										for ($i = 1; $i <= count($dwn) - 2; $i++) {
    										echo "<li><i class=\"fa fa-angle-double-right\"></i>" . str_replace("-rwxrwxrwx 1 root root", "", $dwn[$i]) . "</li>";
										}
										echo "</ul>";
									}else{
										echo "No downloads in progress.";
									}
								?>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>


	<?php require_once('partials/footer.php'); ?> 

</body>

</html>
