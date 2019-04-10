<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Basanta Tajpuriya">
		<title><?= join(' | ', ['Dashboard', config('app_name', true)]) ?></title>
		<link rel="icon" href="assets/img/master_favicon_thumbnail.png">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/all.css">
		<link rel="stylesheet" href="assets/css/admin.css?t=<?= time() ?>">
	</head>
	<body>
		<div id="section-loader"></div>
		<?php _include('admin/inc/side-bar') ?>
		<article id="wrapper">
			<div class="breadcrumb btn-sm p-2 pl-3 mb-0 text-uppercase">
				<div class="breadcrumb-item"><i class="fa fa-home"></i></div>
				<div class="breadcrumb-item">Dashboard</div>
			</div>
			<section id="content-wrapper">
				<!-- <div class="card rounded-0">
					<div class="card-body">
						<h5>
							
						</h5>
					</div>
				</div> -->
			</section>
		</article>
		<footer id="sticky-footer" class="py-4 bg-dark text-white-50">
			<div class="container text-center">
				<small>Copyright &copy; <?= config('app_name') . '. ' . date('Y') ?></small>
			</div>
		</footer>

		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/master.js?t=<?= time() ?>"></script>
	</body>
</html>