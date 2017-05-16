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
						<h2 class="page-title">Software</h2>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">Available software</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">

								<?php 
									$sw = getSoftware();
										
									echo "<pre>";
									for ($i = 0; $i < count($sw) -2; $i++) {
										echo $sw[$i] . "</br>";
									}
									echo "</pre>";
								?>
							</div>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php require_once('_partials/footer.php'); ?> 

</body>

</html>