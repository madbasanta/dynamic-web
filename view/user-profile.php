<?php _include('inc/doc_head', ['title' => join(' | ', ['Contact us', config('app_name', true)])]) ?>

<?php _include('inc/header'); ?>
<!-- Contents -->
<section class="my-3">
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<div class="border-success table-bordered text-center">
					<img src="/<?= auth('profile_img')?:'assets/img/no-user.png' ?>" alt="avatar" class="img-fluid">
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-5 col-lg-6 mt-3 mt-sm-auto">
				<div class="form-group">
					<h5>
					<strong><?= $user->first_name ?></strong>
					<strong><?= $user->last_name ?></strong>
					</h5>
				</div>
				<div class="form-group">
					<span><i class="fa fa-user mr-2"></i> <?= $user->username ?></span>
				</div>
				<div class="form-group">
					<span><i class="fa fa-envelope mr-2"></i> <?= $user->email ?></span>
				</div>
				<?php if($user->phone): ?>
				<div class="form-group">
					<span><i class="fa fa-phone mr-2"></i> <?= $user->phone ?></span>
				</div>
				<?php endif; ?>
				<?php if($b_name = $user->job_title): ?>
				<div class="form-group">
					<span><i class="fa fa-briefcase mr-2"></i> <?= $b_name ?> <?= 'at '.$user->business_name ?> </span>
				</div>
				<?php endif; ?>
				<div class="form-group mb-0">
					<a class="btn btn-login btn-secondary py-1" href="/profile/edit">
						<i class="fa fa-pen"></i> Edit Info
					</a>
				</div>
			</div>
			<?php if($has_interest): ?>
			<div class="col-12 col-sm-12 col-md-3 mt-sm-3">
				<h5>You Interesets</h5>
				<?php foreach($interests as $int): ?>
				<div class="form-group mb-1">
					<label>
						<input type="checkbox" checked="" disabled="">
						<span class="ml-2"><?= $int->title ?></span>
					</label>
				</div>
				<?php endforeach; ?>
				<div class="clearfix">
					<button type="button" class="btn btn-login py-2 btn-success" id="change-interests">Change</button>
				</div>
			</div>
			<?php else: ?>
			<div class="col-12 col-sm-12 col-md-3 mt-sm-3">
				<form action="/user-interests/save" method="post">
					<h5>Choose your interesets</h5>
					<?php foreach($interests as $id => $int): ?>
					<div class="form-group mb-1">
						<label for="newinterestKey<?= $id ?>">
							<input type="checkbox" value="<?= $int->category ?>" name="interests[]" id="newinterestKey<?= $id ?>">
							<span class="ml-2"><?= $int->category ?></span>
						</label>
					</div>
					<?php endforeach; ?>
					<div class="clearfix">
						<button type="submit" class="btn btn-login py-2 btn-success">Save</button>
					</div>
				</form>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php _include('inc/footer'); ?>
<!-- Scripts -->
<script>
	$(function() {
		$('#change-interests').off('click').on('click', function(e) {
			confirm_action({
				title : 'You interests',
				width : '700px',
				get   : '/user-interests/change',
				loader: true
			});
		});
	});
</script>
</body>
</html>