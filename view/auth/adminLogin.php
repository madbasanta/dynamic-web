<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= join(' | ', ['Admin Login', config('app_name', true)]) ?></title>
	<link rel="icon" href="/assets/img/master_favicon_thumbnail.png">
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/css/all.css">
	<link rel="stylesheet" href="/assets/css/style.css?t=<?= time() ?>">
</head>
<body>
	<?php //_include('inc/header', ['signIn' => 'active']); ?>
	<!-- Contents -->
	<section>
		<div class="container-fluid">
		  <div class="row no-gutter">
		    <div class="col-md-8 col-lg-6">
		      <div class="login d-flex align-items-center py-5">
		        <div class="container">
		          <div class="row">
		            <div class="col-md-9 col-lg-8 mx-auto">
		              <h3 class="login-heading mb-4">Welcome back!</h3>
		              <form action="/admin/sign-in?page=adminlogin" method="post">
		                <div class="form-label-group">
		                  <input type="email" id="inputEmail" name="username" class="form-control <?= is_valid('email') ?>" placeholder="Email address" required autofocus autocomplete="off">
		                  <label for="inputEmail">Email address</label>
		                  <div class="pl-4"><?= error_msg('username') ?></div>
		                </div>

		                <div class="form-label-group">
		                  <input type="password" id="inputPassword" name="pwd" class="form-control" placeholder="Password" required>
		                  <label for="inputPassword">Password</label>
		                </div>

		                <div class="custom-control custom-checkbox mb-3">
		                  <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember_me">
		                  <label class="custom-control-label" for="customCheck1">Remember password</label>
		                </div>
		                <button class="btn btn-sm btn-primary btn-block btn-login text-uppercase  mb-2" type="submit">Sign in</button>
		                <div class="text-center">
		                  <a class="" href="/forget-password">Forgot password?</a></div>
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
	<script type="text/javascript">

	</script>
</body>
</html>