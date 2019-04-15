<form action="/admin/events/save" id="event-create-form">
	<div class="row">
		<div class="col-md-8">
			<div class="form-label-group">
				<input type="text" name="title" id="event_title" placeholder="Event Title" class="form-control">
				<label for="event_title">Event Title</label>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-label-group">
				<input type="text" name="category" id="event_category" placeholder="Category" class="form-control">
				<label for="event_category">Category</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-label-group">
				<textarea name="description" id="event_description" rows="5" class="form-control" placeholder="Event Description"></textarea>
				<label for="event_description">Event Description</label>
			</div>
		</div>

		<div class="col-md-8">
			<div class="form-label-group">
				<input type="text" id="event_organization" name="org" class="form-control" placeholder="Organization Name">
				<label for="event_organization">Organization Name</label>
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="form-label-group">
				<input type="text" name="start_date" id="event_start_date" placeholder="Start Date" class="form-control"
				onfocus="this.type='date'" onblur="this.type='text'">
				<label for="event_start_date">Start Date</label>
			</div>
		</div>
		
		<div class="col-md-8">
			<div class="form-label-group">
				<select name="address_id" id="event_address" class="form-control">
				</select>
				<!-- <label for="event_address">Event Location</label> -->
			</div>
		</div>

		<div class="col-sm-6 col-md-4">
			<div class="form-label-group">
				<input type="text" name="end_date" id="event_end_date" placeholder="End Date" class="form-control"
				onfocus="this.type='date'" onblur="this.type='text'">
				<label for="event_end_date">End Date</label>
			</div>
		</div>

		<div class="col-md-12 mt-4">
			<div class="clearfix">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-success float-right px-4">Save</button>
			</div>
		</div>
	</div>
</form>

<script>
	$(function() {
		$('#event_address').select2({
			width: '100%', placeholder: 'Pick a location',
			ajax : {
				url: '/addresses/list', delay: 500,
				processResults: response => ({results: JSON.parse(response)})
			}
		});

		// event-create-form submit
		$('#event-create-form').off('submit').on('submit', function(e) {
			e.preventDefault();
			sendAjax({
				url : this.action,
				formdata : new FormData(this),
				method : 'post',
				loader : true
			}, function(resp) {
				$('.confirm_action_modal').modal('hide');
				toaster('New event created successfully.').success();
				load_page('/admin/events');
			}, err => {
				if(err.status === 422) 
					return processFormValidation(err, this);
				toaster([err.status, err.statusText].join(' ')).error();
			});
		});
	});
</script>