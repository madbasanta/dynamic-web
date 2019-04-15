<nav class="bg-dark" style="line-height: 30px;">
	<div class="container clearfix">
		<div class="float-left" style="color: #f5f5f5;">
			<?= config('app_email') ?>
		</div>
		<div class="float-right socials d-none d-sm-block">
			<?php foreach(config('socials') as $icon => $url): ?>
				<a href="<?= $url ?>" class="social-icon"><i class="fab fa-<?= $icon ?>"></i></a>
			<?php endforeach; ?>
		</div>
		<div class="float-right">
			<ul class="navbar-nav mr-3">
				<li class="nav-item <?= isset($signIn)?'active':'' ?> auth dropdown">
					<?php if(!auth()): ?>
						<a class="p-0 text-white" href="/sign-in">Sign&nbsp;In</a> <span class="text-white">&nbsp;/&nbsp;</span>
						<a class="p-0 text-white" href="/sign-in">Register</a> 
					<?php else: ?>
						<a href="javascript:void(0)" class="dropdown-toggle p-0 text-white" 
						data-toggle="dropdown">
							<?= join('&nbsp;', [auth('first_name'), auth('last_name')]) ?>
						</a>						
						<form action="/log-out" method="post" id="logout-form"></form>
						<ul class="dropdown-menu" style="position: absolute;top: 1.5rem;">
							<li class="dropdown-header">
								<div style="width: 100px;height: 100px;border-radius: 50%;overflow: hidden; text-align: center;margin: auto;">
									<img src="/<?= auth('profile_img')?:'assets/img/no-user.png' ?>" alt="avatar" class="img-fluid" style="height: 100%">
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
			</ul>
		</div>
	</div>
</nav>
