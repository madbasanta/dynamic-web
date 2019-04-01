<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= join(' | ', [config('app_name'), 'Dashboard']) ?></title>
	<link rel="icon" href="assets/img/master_favicon_thumbnail.png">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/all.css">
	<link rel="stylesheet" href="assets/css/style.css?t=<?= time() ?>">
</head>
<body>
	<div class="container">Welcom to dashboard</div>
	<footer id="sticky-footer" class="py-4 bg-dark text-white-50 fixed-bottom">
	    <div class="container text-center">
	      <small>Copyright &copy; <?= config('app_name') . '. ' . date('Y') ?></small>
	    </div>
	  </footer>
</body>
</html>