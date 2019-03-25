<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>404 Page Not Found</title>
	<link rel="icon" href="assets/img/master_favicon_thumbnail.png">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/all.css">
	<link rel="stylesheet" href="assets/css/style.css?t=<?= time() ?>">
</head>
<body>
	<?php _include('inc/header'); ?>
	<!-- Contents -->
	<section>
		<div class="container">
			<div class="mt-3">
				<h3 class="text-center">
					Ooops ! The page you were looking for is not available.
				</h3>
				<div class="text-center">
					<a href="/<?= session('http_previous_uri') ?>">Go back</a>
				</div>
			</div>
		</div>
	</section>
	<!-- Scripts -->
</body>
</html>