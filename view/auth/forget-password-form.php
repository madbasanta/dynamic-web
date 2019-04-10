<?php _include('inc/doc_head', ['title' => join(' | ', ['Forget Password', config('app_name', true)])]) ?>

	<?php _include('inc/header'); ?>

	<section>
		<div class="container my-md-3 my-lg-5">
			<div class="row justify-content-center">
				<div class="col-sm-12 col-md-6 col-lg-4">
					<form action="/forget-password" method="post">
						<div class="form-label-group">
							<input type="email" name="email" id="myEmail" class="form-control" placeholder="Email address">
							<label for="myEmail">Email address</label>
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