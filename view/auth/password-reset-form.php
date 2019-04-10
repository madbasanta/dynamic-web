<?php _include('inc/doc_head', ['title' => join(' | ', ['Password Reset Form', config('app_name', true)])]) ?>

	<?php _include('inc/header'); ?>

	<section>
		<div class="container my-md-3 my-lg-5">
			<div class="row justify-content-center">
				<div class="col-sm-12 col-md-6 col-lg-4">
					<form action="/reset-password" method="post">
						<div class="form-label-group">
							<input type="email" name="email" id="myEmail" class="form-control" placeholder="Email address"
							value="<?= old('email') ?>" autocomplete="off">
							<label for="myEmail">Email address</label>
							<div class="ml-4"><?= error_msg('email') ?></div>
						</div>
						<div class="form-label-group">
							<input type="password" name="password" id="myPassword" class="form-control" placeholder="Email address">
							<label for="myPassword">New Password</label>
							<div class="ml-4"><?= error_msg('password') ?></div>
						</div>
						<div class="form-label-group">
							<input type="password" name="password_confirmation" id="myCpassword" class="form-control" placeholder="Email address">
							<label for="myCpassword">Retype Password</label>
							<div class="ml-4"><?= error_msg('password_confirmation') ?></div>
						</div>
						<div class="text-center">
							<button type="submit" class="btn btn-primary btn-login py-2">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

	<?php _include('inc/footer'); ?>
	<!-- Scripts -->
</body>
</html>