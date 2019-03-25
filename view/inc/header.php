<?php _include('inc/micro_header'); ?>
<header>
	<nav id="main-top-nav">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-3">
					<div class="text-white py-2">
						<h1 class="m-0 logo-text">College</h1>
					</div>
				</div>
				<div class="col-md-12 col-lg-9">
					<div>
						<ul class="list-unstyled clearfix mt-3 navLink">
							<li class="float-right <?= isset($signIn)?'active':'' ?> auth dropdown">
								<?php if(!auth()): ?>
									<a href="/sign-in" class="pl-5 pr-1 py-2" style="line-height: 40px;">Sign In</a>
								<?php else: ?>
									<a href="#" class="pl-5 pr-1 py-2 dropdown-toggle" style="line-height: 40px;" 
									data-toggle="dropdown">
										<?= join(' ', [auth('first_name'), auth('last_name')]) ?>
									</a>
									
									<form action="/log-out" method="post" id="logout-form"></form>
									<ul class="dropdown-menu">
										<li class="dropdown-header">
											<div style="width: 100px;height: 100px;border-radius: 50%;overflow: hidden; text-align: center;margin: auto;">
												<img data-lazy="/assets/img/no-user.png" alt="avatar" class="img-fluid" style="height: 100%">
											</div>
										</li>
										<li class="dropdown-item text-center">
											<a href="/profile" class="">Profile</a>
										</li>
										<li class="dropdown-item text-center">
											<a href="javascript:void(0)" class="btn-sm" onclick="$('#logout-form').submit();">Log out</a>
										</li>
									</ul>
								<?php endif; ?>	
							</li>
							<li class="float-right <?= isset($contact)?'active':''?>">
								<a href="#" class="pl-5 pr-1 py-2" style="line-height: 40px;">Contact</a>
							</li>
							<li class="float-right <?= isset($about_us)?'active':''?>">
								<a href="about-us" class="pl-5 pr-1 py-2" style="line-height: 40px;">About us</a>
							</li>
							<li class="float-right <?= isset($blogs)?'active':''?>">
								<a href="/blogs" class="pl-5 pr-1 py-2" style="line-height: 40px;">Blogs</a>
							</li>
							<li class="float-right <?= isset($courses)?'active':''?>">
								<a href="#" class="pl-5 pr-1 py-2" style="line-height: 40px;">Courses</a>
							</li>
							<li class="float-right <?= isset($home)?'active':''?>">
								<a href="/" class="pl-5 pr-1 py-2" style="line-height: 40px;">Home</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</nav>
</header>