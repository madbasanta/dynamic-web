<?php _include('inc/micro_header'); ?>
<header>
	<!-- Navigation -->
	<nav class="navbar navbar-expand-md navbar-light bg-light static-top" id="main-top-nav">
		<div class="container">
			<a class="navbar-brand" href="/">
				<h3 class=""><?= config('app_name') ?></h3>
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto navLink">
					<!-- Home route -->
					<li class="nav-item <?= isset($home)?'active':'' ?>">
						<a class="nav-link" href="/">Home</a>
					</li>
					<!-- Courses route -->
					<li class="nav-item auth dropdown <?= isset($services)?'active':'' ?>">
						<a class="nav-link dropdown-toggle" style="width: 75px;" href="/services">Services</a>
						<div class="dropdown-menu">
							<div class="dropdown-item"><a href="/services/audio">Audio</a></div>
							<div class="dropdown-item"><a href="/services/video">Video</a></div>
						</div>
					</li>
					<!-- Contact route -->
					<li class="nav-item <?= isset($contact_us)?'active':'' ?>">
						<a class="nav-link" href="/contact-us">Contact&nbsp;Us</a>
					</li>
					<!-- Our approach -->
					<li class="nav-item <?= isset($our_approach)?'active':'' ?>">
						<a class="nav-link" href="/our-approach">Our&nbsp;Approach</a>
					</li>
					<!-- Location -->
					<li class="nav-item <?= isset($location)?'active':'' ?>">
						<a class="nav-link" href="/location">Location</a>
					</li>


					<li class="nav-item ">
						<a class="nav-link dropleft" href="javascript:void(0)">
							<i class="fa fa-search" data-toggle="dropdown"></i>
							<div class="dropdown-menu" style="top: 3rem;width: 500px;max-width: 350px;right: 0;">
								<div class="dropdown-item p-0 px-2">
									<input type="search" id="searchInput" class="form-control" placeholder="Type something here" value="<?= request()->input('query')?:'' ?>">
								</div>
							</div>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</header>