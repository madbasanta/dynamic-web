<nav class="bg-dark" style="line-height: 30px;">
	<div class="container clearfix">
		<div class="float-left" style="color: #f5f5f5;">
			<?= join(' ', [
					config('app_email'), 
					'&nbsp;<i class="fa fa-phone small"></i>&nbsp;', 
					'(', config('app_contact'), ')'
				]) 
			?>
		</div>
		<div class="float-right socials">
			<?php foreach(config('socials') as $icon => $url): ?>
				<a href="<?= $url ?>" class="social-icon"><i class="fab fa-<?= $icon ?>"></i></a>
			<?php endforeach; ?>
		</div>
	</div>
</nav>