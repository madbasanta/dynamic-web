<?php _include('inc/doc_head', ['title' => join(' | ', ['Services', config('app_name', true)])]) ?>

	<?php _include('inc/header', ['services' => 'active']); ?>
	<!-- Contents -->
	<section class="mt-3">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<!-- <h2>Blogs</h2> -->
					<?php foreach($services->data as $blog): ?>
					<div class="card mb-3">
						<div class="card-body">
							<div class="row">
								<div class="col-md-3">
									<img data-lazy="/<?= $blog->img_path ?>" class="img-fluid" alt="service thumbnail image">
								</div>
								<div class="col-md-9">
									<h5><?= $blog->title ?></h5>
									<p class="mb-1">
										<?= limit_text($blog->description, 50); ?>
									</p>
									<a href="/services/<?= $blog->slug ?>">See more</a>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
				<div class="col-md-4">
					<div class="card mb-3">
						<div class="card-body">
							<h5 class="text-orange">
								Audio Materials
							</h5>
							<?php foreach($audios as $ad): ?>
							<div>
								<a href="/services/<?= $ad->slug ?>"><?= $ad->title ?></a>
							</div>
							<?php endforeach; ?>
						</div>
						<div class="card-body">
							<h5 class="text-orange">
								Video Materials
							</h5>
							<?php foreach($videos as $vd): ?>
							<div>
								<a href="/services/<?= $vd->slug ?>"><?= $vd->title ?></a>
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