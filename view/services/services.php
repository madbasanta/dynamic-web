<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= join(' | ', ['Services', config('app_name', true)]) ?></title>
	<link rel="icon" href="assets/img/master_favicon_thumbnail.png">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/all.css">
	<link rel="stylesheet" href="assets/css/style.css?t=<?= time() ?>">
</head>
<body>
	<?php _include('inc/header', ['services' => 'active']); ?>
	<!-- Contents -->
	<section class="mt-3">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<!-- <h2>Blogs</h2> -->
					<?php foreach(range(1, 5) as $blog): ?>
					<div class="card mb-3">
						<div class="card-body">
							<div class="row">
								<div class="col-md-3">
									<img data-lazy="assets/img/product00.jpg" class="img-fluid">
								</div>
								<div class="col-md-9">
									<h5>Blog title of the current scenario</h5>
									<p class="mb-1">
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius assumenda rerum voluptate laboriosam aspernatur fuga impedit qui natus pariatur quaerat, ipsam, doloribus praesentium nesciunt id.
									</p>
									<a href="/blogs/this-is-my-first-blog-<?= $blog ?>">See more</a>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
				<div class="col-md-4">
					<div class="card">
						<div class="card-body">
							<h5 class="text-orange">
								Audio Materials
							</h5>
							<?php foreach(range(1, 3) as $i): ?>
							<div>
								<a href="/blogs/this-is-my-first-blog-<?= $i ?>">Generating special title <?= $i ?></a>
							</div>
							<?php endforeach; ?>
						</div>
						<div class="card-body">
							<h5 class="text-orange">
								Video Materials
							</h5>
							<?php foreach(range(1, 3) as $i): ?>
							<div>
								<a href="/blogs/this-is-my-first-blog-<?= $i ?>">Generating special title <?= $i ?></a>
							</div>
							<?php endforeach; ?>
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