<?php _include('inc/doc_head', ['title' => join(' | ', ['Sing in', config('app_name', true)])]) ?>


	<?php _include('inc/header', ['signIn' => 'active']); ?>
	<!-- Contents -->
	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<div class="card mt-3 box-shadow-card mb-3">
						<div class="card-body">
							<h5>Enter your log in credentials <i class="fa fa-lock text-success float-right"></i></h5> 
							<br>
							<form action="/sign-in?page=login" method="post" id="sign-in-form">
								<div class="form-label-group">
									<input placeholder="____" type="text" name="username" id="username" class="form-control <?= is_valid('username') ?>" autocomplete="off" value="<?= old('username') ?>">
									<label for="username">Email / Username</label>
									<div class="ml-4"><?= error_msg('username') ?></div>
								</div>
								<div class="form-label-group">
									<input placeholder="____" type="password" name="pwd" id="password" class="form-control">
									<label for="password">Password</label>
								</div>
								<div class="form-group mb-0">
									<button class="btn btn-success py-2 px-4 btn-login" id="sign-in-submit">Sign in</button>
									<a href="/forget-password" class="float-right">Forget Password?</a>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-7">
					<div class="card mt-3 box-shadow-card mb-3">
						<div class="card-body">
							<h5>Not a member ? &nbsp;<small class="text-orange">Join us now, It's Free !</small></h5> 
							<br>
							<form action="/sign-up" method="post" id="sign-up-form">
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
											<input placeholder="____" type="text" name="the_username" id="the_username" class="form-control <?= is_valid('the_username') ?>" value="<?= old('the_username') ?>" autocomplete="off">
											<label for="the_username">Username <i class="text-danger">*</i></label>
											<div class="ml-4"><?= error_msg('the_username') ?></div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-label-group">
											<input placeholder="____" type="password" name="password" id="pwd" class="form-control <?= is_valid('password') ?>">
											<label for="pwd">Password <i class="text-danger">*</i></label>
											<div class="ml-4"><?= error_msg('password') ?></div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-label-group">
											<input placeholder="____" type="password" name="password_confirmation" id="c_pwd" class="form-control <?= is_valid('password_confirmation') ?>">
											<label for="c_pwd">Confirm Password <i class="text-danger">*</i></label>
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
											<button class="btn btn-danger btn-login py-2 px-4">Sign up</button>
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
		
		/*
		    LOGIN AND REGISTRACTION FORM
		*/
		$(function() {
		    $('#sign-in-form').off('submit').on('submit', function(e) {

		        let login_attempt = getCookie('login_attempt');
		        if(!login_attempt) {
		            login_attempt = 1;
		            setCookie('login_attempt', login_attempt, 3);
		        } else {
		            login_attempt = parseInt(login_attempt);
		            setCookie('login_attempt', login_attempt + 1, 3);
		        }
		        if(login_attempt >= 3) {
		            e.preventDefault();
		            $('#sign-in-submit').prop('disabled', true);
		            alert('Please refresh the page and try again after some time.');
		        }
		    });

		    let login_attempt = getCookie('login_attempt');
		    if(login_attempt > 3) {
		        $('#sign-in-submit').prop('disabled', true);
		    }

		    $('#sign-up-form').off('submit').on('submit', function(e) {
		        if(!$('#term_agree').prop('checked'))
		            e.preventDefault();
		    });
		    
		});
	</script>
</body>
</html>