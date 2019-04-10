</section>
<!-- page wrap section end -->



<footer id="sticky-footer" class="py-4 bg-dark site-footer text-white-50 <?= isset($fix_footer)?'fixed-bottom':'' ?>">
	<div class="container text-center mb-3">
		<a href="javascript:void(0)" class="text-white px-3">Company</a> .
		<a href="javascript:void(0)" class="text-white px-3">Product</a> .
		<a href="javascript:void(0)" class="text-white px-3">Partners</a> .
		<a href="javascript:void(0)" class="text-white px-3">Policies</a> 
	</div>
	<div class="container text-center socials mb-3">
		<?php foreach(config('socials') as $icon => $url): ?>
			<a href="<?= $url ?>" class="social-icon"><i class="fab fa-<?= $icon ?>"></i></a>
		<?php endforeach; ?>
	</div>
    <div class="container text-center">
    	<small>Copyright &copy; <?= config('app_name') . '. ' . date('Y') ?></small>
    </div>
</footer>
<section id="bottomMessage" class="fixed-bottom bg-dark py-3" style="display: none;">
	<span class="bottomMessageClose text-white"><i class="fa fa-bell"></i></span>
	<div class="container" id="contents">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="text-light">
					<h5>This website uses cookies</h5>
					<p style="font-size: 13px;">
						We use cookies to personalise content and ads, to provide social media features and to analyse our traffic. We also share information about your use of our site with our social media, advertising and analytics partners who may combine it with other information that you’ve provided to them or that they’ve collected from your use of their services. You consent to our cookies if you continue to use our website.
					</p>
					<div class="clearfix">
						<button id="cookie-accept" class="btn btn-sm rounded-0 btn-success px-4 float-right">OK</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/master.js?t=<?= time() ?>"></script>
<script>
	$(function() {
		/*
			asking cookie permision
		*/
		let cookie_accepted = getCookie('cookie_accepted');
		if(!cookie_accepted) {
			// $('#bottomMessage span.bottomMessageClose').hide();
			$('#bottomMessage').show();
		}

		$('#cookie-accept').on('click', function() {
			let time = (new Date()).getTime();
			setCookie('cookie_accepted', time, 5);
			$('#bottomMessage').slideUp(400);
		});
		// setCookie('cookie_accepted', 'expire', 0);
	});
</script>