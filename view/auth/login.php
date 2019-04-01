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
	<?php _include('inc/header', ['signIn' => 'active']); ?>
	<!-- Contents -->
	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<div class="card mt-3 box-shadow-card mb-3">
						<div class="card-body">
							<h5>Enter your log in credentials <i class="fa fa-lock text-success float-right"></i></h5> <br>
							<form action="/sign-in?page=login" method="post" id="sign-in-form">
								<div class="form-group">
									<label for="username">Email / Username</label>
									<input type="text" name="username" id="username" class="form-control <?= is_valid('username') ?>" autocomplete="off" value="<?= old('username') ?>">
									<?= error_msg('username') ?>
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" name="pwd" id="password" class="form-control">
								</div>
								<div class="form-group mb-0">
									<button class="btn btn-success py-1 px-4" id="sign-in-submit">Sign in</button>
									<a href="/forget-password" class="float-right">Forget Password?</a>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-7">
					<div class="card mt-3 box-shadow-card mb-3">
						<div class="card-body">
							<h5>Not a member ? &nbsp;<small class="text-orange">Join us now, It's Free !</small></h5> <br>
							<form action="/sign-up" method="post" id="sign-up-form">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="first_name">First Name <i class="text-danger">*</i></label>
											<input type="text" name="first_name" id="first_name" class="form-control <?= is_valid('first_name') ?>" value="<?= old('first_name') ?>" autocomplete="off">
											<?= error_msg('first_name') ?>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="last_name">Last Name <i class="text-danger">*</i></label>
											<input type="text" name="last_name" id="last_name" class="form-control <?= is_valid('last_name') ?>" value="<?= old('last_name') ?>" autocomplete="off">
											<?= error_msg('last_name') ?>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="email">Contact Email <i class="text-danger">*</i></label>
											<input type="email" name="email" id="email" class="form-control <?= is_valid('email') ?>" value="<?= old('email') ?>" autocomplete="off">
											<?= error_msg('email') ?>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="phone">Phone (Optional)</label>
											<input type="phone" name="phone" id="phone" class="form-control <?= is_valid('phone') ?>" value="<?= old('phone') ?>" autocomplete="off">
											<?= error_msg('phone') ?>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="pwd">Password <i class="text-danger">*</i></label>
											<input type="password" name="password" id="pwd" class="form-control <?= is_valid('password') ?>">
											<?= error_msg('password') ?>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="c_pwd">Confirm Password <i class="text-danger">*</i></label>
											<input type="password" name="password_confirmation" id="c_pwd" class="form-control <?= is_valid('password_confirmation') ?>">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input type="checkbox" name="term_agree" id="term_agree" checked="">
											I agree to all your terms and conditions and cookie policy.
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group mb-0">
											<button class="btn btn-danger py-1 px-4">Sign up</button>
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
	<?php _include('inc/footer', ['fix_footer' => true]); ?>
	<!-- Scripts -->
	<script type="text/javascript">

	</script>
</body>
</html>