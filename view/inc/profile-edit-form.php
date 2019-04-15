<?php _include('inc/doc_head', ['title' => join(' | ', ['Edit Profile', config('app_name', true)])]) ?>


	<?php _include('inc/header'); ?>
	<!-- Contents -->
	<section>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-7">
					<div class="card my-3 my-md-5 box-shadow-card mb-3">
						<div class="card-body">
							<h5>Edit Profile Information</h5> <br>
							<form action="/profile/save" method="post" id="profile-edit-form" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-6">
										<div class="form-label-group">
											<input placeholder="____" type="text" name="first_name" id="first_name" class="form-control <?= is_valid('first_name') ?>" value="<?= old('first_name') ?>" autocomplete="off">
											<label for="first_name">First Name <i class="text-danger">*</i></label>
											<div class="ml-4"><?= error_msg('first_name') ?></div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-label-group">
											<input placeholder="____" type="text" name="last_name" id="last_name" class="form-control <?= is_valid('last_name') ?>" value="<?= old('last_name') ?>" autocomplete="off">
											<label for="last_name">Last Name <i class="text-danger">*</i></label>
											<div class="ml-4"><?= error_msg('last_name') ?></div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-label-group">
											<input placeholder="____" type="email" name="email" id="email" class="form-control <?= is_valid('email') ?>" value="<?= old('email') ?>" autocomplete="off">
											<label for="email">Contact Email <i class="text-danger">*</i></label>
											<div class="ml-4"><?= error_msg('email') ?></div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-label-group">
											<input placeholder="____" type="phone" name="phone" id="phone" class="form-control <?= is_valid('phone') ?>" value="<?= old('phone') ?>" autocomplete="off">
											<label for="phone">Phone (Optional)</label>
											<div class="ml-4"><?= error_msg('phone') ?></div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-label-group">
											<input placeholder="____" type="text" name="business_name" id="business_name" class="form-control <?= is_valid('business_name') ?>" value="<?= old('business_name') ?>" autocomplete="off">
											<label for="business_name">Business Name</label>
											<div class="ml-4"><?= error_msg('business_name') ?></div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-label-group">
											<input placeholder="____" type="text" name="job_title" id="job_title" class="form-control <?= is_valid('job_title') ?>" value="<?= old('job_title') ?>" autocomplete="off">
											<label for="job_title">Job Title</label>
											<div class="ml-4"><?= error_msg('job_title') ?></div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-label-group">
											
											<input type="file" name="profile_img" class="form-control" id="profile_img">
											<label for="profile_img">Change Profile Image</label>
											<div class="ml-4"><?= error_msg('profile_img') ?></div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group mb-0">
											<label>
												<input type="checkbox" id="password-fields-toggler">
												<span class="ml-2">Change password ?</span>
											</label>
										</div>
									</div>
									<div class="col-md-12" id="password-fields" style="display: none;">
										<div class="row">
											<div class="col-md-6">
												<div class="form-label-group">
													<input placeholder="____" type="password" name="password" id="pwd" class="form-control <?= is_valid('password') ?>">
													<label for="pwd">New Password <i class="text-danger">*</i></label>
													<div class="ml-4"><?= error_msg('password') ?></div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-label-group">
													<input placeholder="____" type="password" name="password_confirmation" id="c_pwd" class="form-control <?= is_valid('password_confirmation') ?>">
													<label for="c_pwd">Confirm Password <i class="text-danger">*</i></label>
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<input placeholder="____" type="checkbox" name="term_agree" id="term_agree" checked="">
											<span class="ml-2">I agree to all your terms and conditions and cookie policy.</span>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group mb-0">
											<button class="btn btn-danger btn-login py-2 px-4">Update Info</button>
										</div>
									</div>
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
	<script>
		$(function() {
			$('#password-fields-toggler').off('change').on('change', function() {
				if(this.checked) {
					$('#password-fields').slideDown(function() {
						$(this).find(':input').prop('disabled', false);
					});
				} else {
					$('#password-fields').slideUp(function() {
						$(this).find(':input').prop('disabled', true);
					});
				}
			});

			// disable passwor fields at first load
			$('#password-fields :input').prop('disabled', true);

			$('#profile-edit-form').off('submit').on('submit', function(e) {
				if(!$('#term_agree').prop('checked'))
					e.preventDefault();
			});
		});
	</script>
</body>
</html>