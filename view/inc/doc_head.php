<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Basanta Tajpuriya">
	<meta name="description" content="<?= config(isset($description)?$description:'description') ?>">
	<title><?= isset($title) ? $title : config('app_name', 'true') ?></title>
	<link rel="icon" href="assets/img/master_favicon_thumbnail.png">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/all.css">
	<link rel="stylesheet" href="assets/css/style.css?t=<?= time() ?>">
</head>

<body>
	<section class="page-wrap">