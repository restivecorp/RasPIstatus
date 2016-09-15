<!doctype html>
<html lang="en" class="no-js">

<?php require_once('partials/header_refresh.php'); ?> 

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

				<?php
					if (isset($_GET["up"])) {
						$u = $_GET["up"];
						
						if ($u == "OK") {
				?>
							<div class="alert alert-success" role="alert">
								<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
								<span class="sr-only"></span> The file uploaded successfully
							</div>
				<?php		
					} 
						if ($u == "KO") {
				?>
							<div class="alert alert-danger" role="alert">
								<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
								<span class="sr-only"></span> The file has not uploaded
							</div>							
				<?php		
						}
					} 
				?>

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
						Upload File
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								
								<form enctype="multipart/form-data" action="webup/up.php" method="POST">
									<input type="hidden" name="MAX_FILE_SIZE" value="524288" />
									<input name="f" type="file" /> <input type="submit" value="Up" />
								</form>
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
										
										echo "<pre>";
										echo $dwn[0];
										echo "</pre>";
										
										echo "<pre>";
										for ($i = 1; $i < count($dwn) -2; $i++) {
											echo $dwn[$i] . "</br>";
										}
										echo "</pre>";
										
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
