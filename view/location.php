<?php _include('inc/doc_head', ['title' => join(' | ', ['Location', config('app_name', true)])]) ?>
<?php _include('inc/header', ['location' => 'active']); ?>
<!-- Contents -->
<section class="my-5">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<div class="mb-3">
					<?php if(session('booking_success')): ?>
					<div class="alert alert-success">
						<strong><?= session('booking_success') ?></strong>
					</div>
					<?php endif; ?>
					<?php if(session('booking_error')): ?>
					<div class="alert alert-danger">
						<strong><?= session('booking_error') ?></strong>
					</div>
					<?php endif; ?>
					<h3 class="login-heading mb-3">Book Training Session</h3>
					<form method="post" action="/booking/events/n-a" id="event-booking-form">
						<div class="row">
							<div class="col-md-7">
								<div class="form-label-group">
									<input type="text" id="inputName" name="full_name" class="form-control <?= is_valid('full_name') ?>" placeholder="Full name" required autofocus autocomplete="off" value="<?= old('full_name', auth('first_name').' '.auth('last_name')) ?>">
									<label for="inputName">Full name</label>
									<div class="pl-4"><?= error_msg('full_name') ?></div>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-label-group">
									<input type="text" id="inputPhone" name="phone" class="form-control <?= is_valid('phone') ?>" placeholder="Phone" required autocomplete="off" value="<?= old('phone', auth('phone')) ?>">
									<label for="inputPhone">Phone</label>
									<div class="pl-4"><?= error_msg('phone') ?></div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-label-group">
									<input type="email" id="inputEmail" name="email" class="form-control <?= is_valid('email') ?>" placeholder="Email" required autocomplete="off" value="<?= old('email', auth('email')) ?>">
									<label for="inputEmail">Email</label>
									<div class="pl-4"><?= error_msg('email') ?></div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<!-- <input type="text" id="inputCourse" name="course" class="form-control <?= is_valid('course') ?>" placeholder="Course" required autocomplete="off" value="<?= old('course') ?>"> -->
									<select name="event" id="inputCourse" class="form-control" style="border-radius: 2rem;height: 50px;">
									</select>
									<!-- <label for="inputCourse">Course</label> -->
									<div class="pl-4"><?= error_msg('event') ?></div>
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-label-group">
									<input type="text" id="inputDate" name="booking_date" class="form-control <?= is_valid('booking_date') ?>" placeholder="Date" required autocomplete="off" value="<?= old('booking_date') ?>" onfocus="this.type = 'date'" onblur="this.type = 'text'">
									
									<label for="inputDate">Date</label>
									<div class="pl-4"><?= error_msg('booking_date') ?></div>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-label-group">
									<input type="text" id="inputSeat" name="seat" class="form-control <?= is_valid('seat') ?>" placeholder="Seat" required autocomplete="off" value="<?= old('seat') ?>" onfocus="this.type='number'" onblur="this.type='text'">
									
									<label for="inputSeat">Seat</label>
									<div class="pl-4"><?= error_msg('seat') ?></div>
								</div>
							</div>
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary btn-login   px-5" type="submit">Book</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2388.459257504604!2d-1.6136160841660185!3d53.22754327995426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487987f2c5df9d0b%3A0x2070d33d3079800f!2sChatsworth+House!5e0!3m2!1sen!2snp!4v1554431331960!5m2!1sen!2snp" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
</section>
<?php _include('inc/footer'); session()->forget('booking_success', 'booking_error'); ?>
<!-- Scripts -->
<script>
	$(function(course, booking_form) {
		course.select2({
			width : '100%', placeholder : 'Select an event',
			ajax : {
				url : '/events/list', delay : 500,
				processResults : resp => ({ results : JSON.parse(resp) })
			}
		}).on('select2:select', e => {
			booking_form.attr('action', '/booking/events/'+ e.params.data.id).data('event', e.params.data.id);
		});
	}($('#inputCourse'), $('#event-booking-form')));
</script>
</body>
</html>