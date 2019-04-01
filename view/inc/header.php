<?php _include('inc/micro_header'); ?>
<header>
	<!-- Navigation -->
	<nav class="navbar navbar-expand-md navbar-light bg-light static-top" id="main-top-nav">
		<div class="container">
			<a class="navbar-brand" href="#">
				<img data-lazy="http://placehold.it/150x50?text=Logo" alt="">
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
					<li class="nav-item <?= isset($courses)?'active':'' ?>">
						<a class="nav-link" href="/courses">Courses</a>
					</li>
					<!-- Blogs route -->
					<li class="nav-item <?= isset($blogs)?'active':'' ?>">
						<a class="nav-link" href="/blogs">Blogs</a>
					</li>
					<!-- Forum Route -->
					<li class="nav-item <?= isset($forum)?'active':'' ?>">
						<a class="nav-link" href="/forum">Forum</a>
					</li>
					<!-- About route -->
					<li class="nav-item <?= isset($about_us)?'active':'' ?>">
						<a class="nav-link" href="/about-us">About</a>
					</li>
					<!-- Contact route -->
					<li class="nav-item <?= isset($contact)?'active':'' ?>">
						<a class="nav-link" href="/contact">Contact</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</header>