<aside id="side-bar">
	<div class="list-group">
		<div class="list-group-item rounded-0">
			<div class="d-block py-2" style="line-height: 50px;">
				<h5 class="mb-0"><?= config('app_name') ?> <br> <small class="text-muted">Admin Panel</small></h5>
			</div>
		</div>
	</div>
	<div style="border-color:orangered;border-width: 2px 0 2px 0;border-style: solid;"></div>
	<div class="list-group left-side-bar-pages">
		<!-- <a href="/admin/dashboard" data-slug="dashboard" class="list-group-item list-group-item-action active rounded-0">
			<i class="fa fa-th w-30"></i> Dashboard
		</a> -->
		<a href="/admin/events" data-slug="events" class="list-group-item list-group-item-action rounded-0">
			<i class="fa fa-bell w-30"></i> Events
		</a>
		<a href="/admin/bookings" data-slug="bookings" class="list-group-item list-group-item-action  rounded-0">
			<i class="fa fa-ticket-alt w-30"></i> Bookings
		</a>
		<a href="/admin/users" data-slug="users" class="list-group-item list-group-item-action  rounded-0">
			<i class="fa fa-ticket-alt w-30"></i> Users
		</a>
		<a href="/admin/services" data-slug="services" class="list-group-item list-group-item-action  rounded-0">
			<i class="fa fa-user-secret w-30"></i> Services
		</a>
	</div>
</aside>
<article id="top-header">
	<div class="card rounded-0">
		<div class="card-body">
			<i class="fa fa-ellipsis-v"></i>
			<div class="right float-right d-flex">
				<div>
					<i class="fa fa-bell w-30 text-muted" id="my-notifications"></i>
					<i class="fa fa-cog w-30 text-muted" id="my-settings"></i>
				</div>
				<div>&nbsp;&nbsp;&nbsp;</div>
				<div>
					<span><?= auth('first_name').' '.auth('last_name') ?></span>
				</div>
				<div>&nbsp;&nbsp;&nbsp;</div>
				<div style="width: 50px;height: 50px;border-radius: 50%;overflow: hidden;margin: -15px 0;text-align: center;">
					<img src="/<?= auth('profile_img')?:'assets/img/no-user.png' ?>" alt="avatar" style="max-height: 100%;max-width: 100%;">
				</div>
			</div>
		</div>
	</div>
</article>
<aside id="right-side-bar">
	<div id="right-bar-contents">
		<div class="p-3 text-white">
			<span class="title"><i class="fa fa-bell w-30 text-orange"></i> Notifications</span>
			<span class="float-right btn p-0" id="close-right-side-bar">x</span>
			<hr class="bg-light mb-0">
			<div id="right-side-bar-body">
				<i class="fa fa-circle-notch fa-spin"></i>
			</div>
		</div>
	</div>
</aside>