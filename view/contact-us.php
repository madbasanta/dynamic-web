<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title><?= join(' | ', ['Contact us', config('app_name', true)]) ?></title>
		<link rel="icon" href="assets/img/master_favicon_thumbnail.png">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/all.css">
		<link rel="stylesheet" href="assets/css/style.css?t=<?= time() ?>">
	</head>
	<body>
		<?php _include('inc/header', ['contact_us' => 'active']); ?>
		<!-- Contents -->
		<!-- Contents -->
		<section>
			<div class="container-fluid">
				<div class="row no-gutter">
					<div class="col-md-8 col-lg-6">
						<div class="d-flex align-items-start py-3">
							<div class="container">
								<div class="row">
									<div class="col-md-9 col-lg-8 mx-auto">
										<h3 class="login-heading mb-3">Leave a message</h3>
										<form action="/enquiry/save" method="post">
											<div class="form-label-group">
												<input type="text" id="inputName" name="name" class="form-control <?= is_valid('name') ?>" placeholder="Full name" required autofocus autocomplete="off" value="<?= old('name') ?>">
												<label for="inputName">Full name</label>
												<div class="pl-4"><?= error_msg('name') ?></div>
											</div>
											<div class="form-label-group">
												<input type="email" id="inputEmail" name="email" class="form-control <?= is_valid('email') ?>" placeholder="Email address" required autocomplete="off" value="<?= old('email') ?>">
												<label for="inputEmail">Email address</label>
												<div class="pl-4"><?= error_msg('email') ?></div>
											</div>
											<div class="form-label-group">
												<input type="phone" id="inputPhone" name="phone" class="form-control <?= is_valid('phone') ?>" placeholder="Phone" required autocomplete="off" value="<?= old('phone') ?>">
												<label for="inputPhone">Phone</label>
												<div class="pl-4"><?= error_msg('phone') ?></div>
											</div>
											<div class="form-label-group">
												<textarea name="message" id="inputMessage" rows="5" required placeholder="Message" class="form-control <?= is_valid('message') ?>" value="<?= old('message') ?>"></textarea>
												<label for="inputMessage">Message</label>
												<div class="pl-4"><?= error_msg('message') ?></div>
											</div>
											<button class="btn btn-sm btn-primary btn-block btn-login text-uppercase  mb-2" type="submit">Submit</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
					</div>
				</div>
			</section>
			<?php _include('inc/footer'); ?>
			<!-- Scripts -->
		</body>
	</html>