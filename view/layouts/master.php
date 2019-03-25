<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= join(' | ', [config('app_name')]) ?></title>
	<link rel="icon" href="assets/img/master_favicon_thumbnail.png">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/all.css">
	<link rel="stylesheet" href="assets/css/style.css?t=<?= time() ?>">
</head>
<body>
	<?php _include('inc/header'); ?>
	<!-- Contents -->
	<?php _include('inc/footer'); ?>
	<!-- Scripts -->
</body>
</html>