<form action="/admin/events/<?= $event->id ?>/update" id="event-update-form">
	<div class="row">
		<div class="col-md-8">
			<div class="form-label-group">
				<input type="text" name="title" id="event_title" placeholder="Event Title" class="form-control"
				value="<?= $event->title ?>">
				<label for="event_title">Event Title</label>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-label-group">
				<input type="text" name="category" id="event_category" placeholder="Category" class="form-control"
				value="<?= $event->category ?>">
				<label for="event_category">Category</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-label-group">
				<textarea name="description" id="event_description" rows="5" class="form-control" 
				placeholder="Event Description"><?= $event->description ?></textarea>
				<label for="event_description">Event Description</label>
			</div>
		</div>

		<div class="col-md-8">
			<div class="form-label-group">
				<input type="text" id="event_organization" name="org" class="form-control" placeholder="Organization Name"
				value="<?= $event->org ?>">
				<label for="event_organization">Organization Name</label>
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="form-label-group">
				<input type="text" name="start_date" id="event_start_date" placeholder="Start Date" class="form-control"
				onfocus="this.type='date'" onblur="this.type='text'" value="<?= date('Y-m-d', strtotime($event->start_date)) ?>">
				<label for="event_start_date">Start Date</label>
			</div>
		</div>
		
		<div class="col-md-8">
			<div class="form-label-group">
				<select name="address_id" id="event_address" class="form-control">
					<?php if($loc = $event->address): ?>
						<option value="<?= $loc->id ?>" selected>
							<?= $loc->add1 .', '. $loc->city ?>
						</option>
					<?php endif; ?>
				</select>
				<!-- <label for="event_address">Event Location</label> -->
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="form-label-group">
				<input type="text" name="end_date" id="event_end_date" placeholder="End Date" class="form-control"
				onfocus="this.type='date'" onblur="this.type='text'" value="<?= date('Y-m-d', strtotime($event->end_date)) ?>">
				<label for="event_end_date">End Date</label>
			</div>
		</div>

		<div class="col-md-12 mt-4">
			<div class="clearfix">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-success float-right px-4">Update</button>
			</div>
		</div>
	</div>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script>
	$(function() {
		$('#event_address').select2({
			width: '100%', placeholder: 'Pick a location',
			ajax : {
				url: '/addresses/list', delay: 500,
				processResults: response => ({results: JSON.parse(response)})
			}
		});

		// event-update-form submit
		$('#event-update-form').off('submit').on('submit', function(e) {
			e.preventDefault();
			sendAjax({
				url : this.action,
				formdata : new FormData(this),
				method : 'post',
				loader : true
			}, function(resp) {
				$('.confirm_action_modal').modal('hide');
				toaster('Event updated successfully.').success();
				load_page('/admin/events');
			}, err => {
				if(err.status === 422) 
					return processFormValidation(err, this);
				toaster([err.status, err.statusText].join(' ')).error();
			});
		});
	});
</script>