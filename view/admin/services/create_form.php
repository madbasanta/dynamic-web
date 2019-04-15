<form action="/admin/services/save" id="service-create-form">
	<div class="row">
		<div class="col-md-12">
			<div class="form-label-group">
				<input type="text" name="title" id="service_title" placeholder="Service Title" class="form-control">
				<label for="service_title">Service Title</label>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-label-group">
				<textarea name="description" id="service_description" rows="5" class="form-control" placeholder="Service Description"></textarea>
				<label for="service_description">Service Description</label>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-label-group">
				<input type="file" name="service_file" id="service_file" class="form-control">
				<label for="service_file">Serivice File</label>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-label-group">
				<input type="file" name="service_img" id="service_img" class="form-control">
				<label for="service_img">Serivice Image</label>
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

		// service-create-form submit
		$('#service-create-form').off('submit').on('submit', function(e) {
			e.preventDefault();
			sendAjax({
				url : this.action,
				formdata : new FormData(this),
				method : 'post',
				loader : true
			}, function(resp) {
				$('.confirm_action_modal').modal('hide');
				toaster('New service created successfully.').success();
				load_page('/admin/services');
			}, err => {
				if(err.status === 422) 
					return processFormValidation(err, this);
				toaster([err.status, err.statusText].join(' ')).error();
			});
		});
	});
</script>