<?php _include('inc/doc_head', ['title' => join(' | ', ['Services', config('app_name', true)])]) ?>

	<?php _include('inc/header', ['services' => 'active']); ?>
	<!-- Contents -->
	<section class="mt-3">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<!-- <h2>Blogs</h2> -->
					<div class="card mb-3">
						<div class="card-body">
							<div class="row ">
								<div class="col-md-8 mb-3" style="padding-bottom: 50%">
									<img data-lazy="/<?= $service->img_path ?>" class="img-fluid">
								</div>
								<div class="col-md-12">
									<h4><?= $service->title ?></h4>
									<p class="mb-1">
										<?= $service->description ?>
									</p>
									<?php if(auth() && $service->file_path): ?>
										<br> <br>
										<a data-href="/<?= $service->file_path ?>" class="approach-download page-link" title="Download <?= basename($service->file_path) ?>"> Attachment : 
											<?= basename($service->file_path) ?>
											<i class="ml-2 fa fa-download"></i>
										</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
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
	<script>
		$(function() {
			$('.approach-download').off('click').on('click', function(e) {
				let href = encodeURIComponent($(this).data('href'));
				e.preventDefault();
				confirm_action({
					title: 'Privacy Policy',
					btn: 'btn-success',
					action: 'Agree',
					width: '700px',
					get: '/privacy-policies?page=service&href=' + href,
					closable : false
				});
			});
		});
	</script>
</body>
</html>