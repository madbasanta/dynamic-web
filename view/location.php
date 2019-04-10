<?php _include('inc/doc_head', ['title' => join(' | ', ['Location', config('app_name', true)])]) ?>

	<?php _include('inc/header', ['location' => 'active']); ?>
	<!-- Contents -->
	<section class="my-5">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="mb-3">
						<h3 class="login-heading mb-3">Book Training Session</h3>
						<form action="javascript:void(0)">
							<div class="row">
								<div class="col-md-7">
									<div class="form-label-group">
										<input type="text" id="inputName" name="name" class="form-control <?= is_valid('name') ?>" placeholder="Full name" required autofocus autocomplete="off" value="<?= old('name') ?>">
										<label for="inputName">Full name</label>
										<div class="pl-4"><?= error_msg('name') ?></div>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-label-group">
										<input type="text" id="inputPhone" name="phone" class="form-control <?= is_valid('phone') ?>" placeholder="Phone" required autocomplete="off" value="<?= old('phone') ?>">
										<label for="inputPhone">Phone</label>
										<div class="pl-4"><?= error_msg('phone') ?></div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-label-group">
										<input type="email" id="inputEmail" name="email" class="form-control <?= is_valid('email') ?>" placeholder="Email" required autocomplete="off" value="<?= old('email') ?>">
										<label for="inputEmail">Email</label>
										<div class="pl-4"><?= error_msg('email') ?></div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<!-- <input type="text" id="inputCourse" name="course" class="form-control <?= is_valid('course') ?>" placeholder="Course" required autocomplete="off" value="<?= old('course') ?>"> -->
										<select name="course" id="inputCourse" class="form-control" style="border-radius: 2rem;height: 50px;">
											<option value="">Select a course</option>
											<option value="1">Ethical Hacking</option>
											<option value="2">Phising</option>
											<option value="3">Malware</option>
										</select>
										<!-- <label for="inputCourse">Course</label> -->
										<div class="pl-4"><?= error_msg('course') ?></div>
									</div>
								</div>
								<div class="col-md-7">
									<div class="form-label-group">
										<input type="text" id="inputDate" name="date" class="form-control <?= is_valid('date') ?>" placeholder="Date" required autocomplete="off" value="<?= old('date') ?>" onfocus="this.type = 'date'" onblur="this.type = 'text'">
									
										<label for="inputDate">Date</label>
										<div class="pl-4"><?= error_msg('date') ?></div>
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
					<!-- <div class="card mb-3">
						<div class="card-body">
							<address class="mb-0">
								<h3>app name</h3>
								<p class="mb-0">Chatsworth House <br> Bakewell DE45 1PP, UK</p>
							</address>
						</div>
					</div> -->
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2388.459257504604!2d-1.6136160841660185!3d53.22754327995426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487987f2c5df9d0b%3A0x2070d33d3079800f!2sChatsworth+House!5e0!3m2!1sen!2snp!4v1554431331960!5m2!1sen!2snp" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</section>
	<?php _include('inc/footer'); ?>
	<!-- Scripts -->
</body>
</html>