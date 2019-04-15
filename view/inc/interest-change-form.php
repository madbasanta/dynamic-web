<form action="/user-interests/update" method="post">
	<h5>All categories</h5>
	<div class="row">
		<?php foreach($interests as $key => $interest): ?>
			<div class="col-12 col-sm-6 col-md-4">
				<div class="form-group">
					<label>
						<input type="checkbox" <?= in_array($interest->category, $my_interests)?'checked':'' ?> 
						name="interests[]" value="<?= $interest->category ?>">
						<span class="ml-2"><?= $interest->category ?></span>
					</label>
				</div>
			</div>
		<?php endforeach; ?>
		<div class="col-md-12 mt-4">
			<div class="clearfix">
				<button type="button" class="btn btn-login py-2 btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-login py-2 btn-success float-right px-4">Update</button>
			</div>
		</div>
	</div>
</form>