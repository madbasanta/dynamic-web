<style>
	.event_table_max{
		max-width: 150px;
		overflow: hidden;
	}
	.event_table_ac {
		width: 80px;
	}
</style>
<div class="card rounded-0">
	<div class="card-body pt-3">
		<div class="self-card-header mb-3 clearfix">
			<h4 class="float-left mb-0">Serive Table</h4>
			<button type="button" class="btn btn-sm btn-success float-right" id="new-service-button">
				<i class="fa fa-plus mr-1"></i> New Service
			</button>
		</div>
		<table class="table table-sm table-bordered">
			<thead class="thead-light">
				<tr>
					<th class="text-center">ID</th>
					<th>Name</th>
					<th>File Path</th>
					<th>Image Path</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($services->data as $event): ?>
				<tr>
					<td class="text-center"><?= $event->id ?></td>
					<td class="event_table_max" title="<?= $event->title ?>"><?= $event->title ?></td>
					<td class="event_table_max" title="<?= $event->file_path ?>"><?= $event->file_path ?></td>
					<td><?= $event->img_path ?></td>
					<td class="text-center event_table_ac">
						<button type="button" data-ser-id="<?= $event->id ?>"
							class="btn btn-sm btn-outline-primary rounded-circle wh-btn servive_edit_action">
							<i class="fa fa-pen fa-xs"></i>
						</button> &nbsp;
						<button type="button" data-ser-id="<?= $event->id ?>"
							class="btn btn-sm btn-outline-danger rounded-circle wh-btn service_delete_action">
							<i class="fa fa-times fa-sm"></i>
						</button>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
			<tfoot>
			<tr>
				<td colspan="7">
					<ul class="pagination pagination-sm my-2 justify-content-center">
						<li class="page-item <?=!$services->previous_page?'disabled':''?>">
							<a data-href="/admin/services?page=<?=$services->previous_page?>" class="page-link fa fa-caret-left"></a>
						</li>
						<?php for($i = 1; $i <= $services->last_page; $i++): ?>
						<li class="page-item <?=$i==$services->current_page?'disabled':''?>">
							<a class="page-link <?=$i==$services->current_page?'bg-danger border-danger text-white':''?>" data-href="/admin/services?page=<?=$i?>"><?=$i?></a>
						</li>
						<?php endfor; ?>
						<li class="page-item <?=!$services->next_page?'disabled':''?>">
							<a data-href="/admin/services?page=<?=$services->next_page?>" class="page-link fa fa-caret-right"></a>
						</li>
					</ul>
				</td>
			</tr>
			</tfoot>
		</table>
	</div>
</div>

<script>
	$(function() {
		$('.pagination').off('click', 'a.page-link').on('click', 'a.page-link', function(e) {
			load_page(this.dataset.href);
		});

		// create new event pop up
		$('#new-service-button').off('click').on('click', function(e) {
			confirm_action({
				width: '750px',
				title: 'Create New Service',
				get : '/admin/services/create'
			});
		});

		// service_delete_action button click
		$('.service_delete_action').off('click').on('click', function(e) {
			let service_id = $(this).data('ser-id');
			confirm_action({
				width : '500px',
				title : 'Confirm',
				body : 'Are you sure you want to delete this service?',
				action : 'Delete',
				btn : 'btn-danger'
			}, function(e) {
				sendAjax({
					url : '/admin/services/'+ service_id +'/delete',
					method : 'post', loader : true,
					success : resp => {
						$('.confirm_action_modal').modal('hide');
						toaster('Service has been deleted successfully.').success();
						load_page('/admin/services');
					},
					error : err => {
						$('.confirm_action_modal').modal('hide');
						toaster([err.status, err.statusText].join(' ')).error();
					}
				});
			});
		});

		// servive_edit_action click
		$('.servive_edit_action').off('click').on('click', function(e) {
			let service_id = $(this).data('ser-id');
			confirm_action({
				title : 'Edit Event',
				loader : true,
				width : '750px',
				get : '/admin/services/'+ service_id +'/edit'
			});
		});
	});
</script>