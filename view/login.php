<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= join(' | ', [config('app_name'), 'Sing in']) ?></title>
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
			<div class="row">
				<div class="col-md-5">
					<div class="card mt-3">
						<div class="card-body">
							<form action="/sign-in" method="post">
								<div class="form-group">
									<label for="username">Email / Username</label>
									<input type="text" name="username" id="username" class="form-control" autocomplete="off">
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" name="password" id="password" class="form-control">
								</div>
								<div class="form-group mb-0">
									<button class="btn btn-primary py-1 px-4">Sign up</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php _include('inc/footer'); ?>
	<!-- Scripts -->
</body>
</html>