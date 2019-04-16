<?php _include('inc/doc_head', ['title' => join(' | ', [config('app_name', true), 'Leading business company'])]) ?>

	<?php _include('inc/header', ['home' => 'active']); ?>
	<?php _include('inc/slider'); ?>
	<!-- Contents -->
	<section class="my-3 my-lg-5">
		<div class="container">
			<div class="card">
				<div class="card-body">
					<h3 class="">
						<span>Curious CyberSecurity,</span> <small>What are we?</small>
					</h3>
					<div class="">
						<p>
							<a href="javascript:void(0)">Curious Cybersecurity</a> is a research-based company founded in 2016, created by <a href="javascript:void(0)">John</a> and <a href="javascript:void(0)">Steven Yung</a>. Our ambition is to research and help companies with the human elements of cybersecurity with a view to developing anti-phishing filtering solutions. We provide training to companies with a view to strengthening cybersecurity defences.
						</p>
						<p>
							Nowadays, surfing in internet without sharing personal information is nearly impossible. Anyone can use those personal information for illegal purposes as well as for scams. That's why we provide training to companies with a view to strengthening cybersecurity defences and reduce the risk of surfing in internet. Vulnarabilities can be found anywhere so as solutions to those cybersecurity problems. 
						</p>
						<div class="mt-4">
							<form action="javascript:void(0)" id="get-started-form">
								<div class="row">
									<div class="col-sm-8 col-md-6 col-lg-4">
										<div class="form-group mb-sm-0">
											<input type="email" name="username" id="my-username" class="form-control" placeholder="Email Address" autocomplete="off">
											<input type="password" name="password" id="my-password" class="form-control" style="display: none;" placeholder="Password">
										</div>
									</div>
									<div class="col-sm-4">
										<button type="submit" class="btn btn-primary">Get Started</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end of intro section -->
	<section class=" mb-sm-3 mb-lg-5">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-3 mb-md-0">
					<div class="card">
						<div class="card-body p-0">
							<div class="bg-light" style="padding-bottom: 70%;">
							<img data-lazy="/assets/img/in_the_news.png" class="img-fluid" alt="In the news">
							</div>
							<div class="p-3">
								In the news
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-3 mb-md-0">
					<div class="card">
						<div class="card-body p-0">
							<div class="bg-light" style="padding-bottom: 70%;">
							<img data-lazy="/assets/img/awards.png" class="img-fluid" alt="Awards">
							</div>
							<div class="p-3">
								Awards
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-3 mb-md-0">
					<div class="card">
						<div class="card-body p-0">
							<div class="bg-light" style="padding-bottom: 70%;">
							<img data-lazy="/assets/img/press-release.png" class="img-fluid" alt="Press release">
							</div>
							<div class="p-3">
								Press release
							</div>
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
			$('#myImageBannerCarousel').carousel({interval: 5000});
			$('#get-started-form').off('submit').on('submit', function(e) {
				let passwordField = $('#my-password');
				let usernameField = $('#my-username');

				if(!passwordField.is(':visible')) {
					let match = usernameField.val().match(/[a-zA-Z_\.0-9]+@[a-zA-Z_0-9]+\.[a-zA-Z]+$/);
					if (!match || (typeof match === 'object' && match.length === 0)) {
						usernameField.css('border-color', 'red');
						return;
					}
					// user name valid then go for password
					usernameField.fadeOut(function() {
						passwordField.fadeIn(function() {
							$(this).focus();
						});
					});
				} 
				else 
				{
					let match = passwordField.val()
					.match(/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#\$%\^&])(?=.{6,})/);
					if(match === null) {
						let value = passwordField.val();
						let messages = [
							'The string must contain at least 1 uppercase alphabetical character',
							'The string must contain at least 1 lowercase alphabetical character',
							'The string must contain at least 1 numeric character',
							'The string must contain at least one special character such as !, @, #, $, %, ^, &',
							'The string must be six characters or longer'
						];
						let message = '';
						if(!value.match(/[A-Z]+/)) {
							message = messages[0];
						} else if(!value.match(/[a-z]+/)) {
							message = messages[1];
						} else if(!value.match(/[0-9]+/)) {
							message = messages[2];
						} else if(!value.match(/[!@#\$%\^&]+/)) {
							message = messages[3];
						} else if(!value.match(/.{6,}/)) {
							message = messages[4];
						}
						passwordField.css('border-color', 'red').attr('title', message);
						return;
					}
					passwordField.css('border-color', 'lightgreen');
					
					confirm_action({
						title: 'Terms & Condtions',
						btn: 'btn-success',
						action: 'Agree',
						width: '700px',
						get: '/terms-and-condtions',
						closable : false
					});
				}
			});

		});
	</script>
</body>
</html>