<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= join(' | ', [config('app_name'), 'Index']) ?></title>
	<link rel="icon" href="assets/img/master_favicon_thumbnail.png">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/all.css">
	<link rel="stylesheet" href="assets/css/style.css?t=<?= time() ?>">
</head>
<body>
	<?php _include('inc/header', ['home' => 'active']); ?>
	<?php _include('inc/slider'); ?>
	<!-- Contents -->
	<section class="mt-3">
		<div class="container">
			<div class="card">
				<div class="card-body">
					<h3>
						What are we?
					</h3>
					<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis libero, animi? Natus a excepturi, soluta eum corporis neque, rerum corrupti dignissimos obcaecati suscipit, sit est, magnam temporibus veritatis sint unde. Incidunt culpa voluptates tenetur quia nam et quas provident inventore asperiores. Repellendus illo tempore itaque? Eligendi quo laboriosam molestias sunt animi, minima iste vel repellendus harum est voluptatum. Voluptatum, quibusdam cum quo aliquid alias odio, atque est ex incidunt excepturi accusamus. Ab dolorem modi quod, cupiditate unde itaque repudiandae dolores nisi deserunt voluptatibus eaque, nam soluta perferendis sit facilis! Accusantium possimus ad porro rerum modi eius! Dolores nihil recusandae inventore?
					</p>
					<p class="mb-0">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum, quasi, iusto. Vitae assumenda harum at asperiores, fuga nihil eaque voluptatem mollitia temporibus veniam voluptas eos aperiam maiores sunt atque dicta consequatur molestiae aliquam aliquid repellendus aut, dolor ipsam voluptatum obcaecati. Voluptas provident non amet nemo quidem dignissimos. Illum iste, minus pariatur eum omnis voluptates sunt quaerat, voluptate quam fuga at debitis illo nulla unde sed rem a ratione dolorum aperiam tempore magni, expedita obcaecati rerum itaque. Error tempore, veniam sit?
					</p>
				</div>
			</div>
		</div>
	</section>
	<?php _include('inc/footer'); ?>
	<!-- Scripts -->
	<script>
		$(function() {
			$('#myImageBannerCarousel').carousel({interval: 15000});
		});
	</script>
</body>
</html>