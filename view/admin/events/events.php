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
			<h4 class="float-left mb-0">Event Table</h4>
			<button type="button" class="btn btn-sm btn-success float-right" id="new-event-button">
				<i class="fa fa-plus mr-1"></i> New Event
			</button>
		</div>
		<table class="table table-sm table-bordered">
			<thead class="thead-light">
				<tr>
					<th class="text-center">ID</th>
					<th>Name</th>
					<th>Organization</th>
					<th>Category</th>
					<th>Start Date</th>
					<th>City</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($events->data as $event): ?>
				<tr>
					<td class="text-center"><?= $event->id ?></td>
					<td class="event_table_max" title="<?= $event->title ?>"><?= $event->title ?></td>
					<td class="event_table_max" title="<?= $event->org ?>"><?= $event->org ?></td>
					<td><?= $event->category ?></td>
					<td><?= date('d/m/Y', $time = strtotime($event->start_date)) ?></td>
					<td class="event_table_max"><?= $event->city ?></td>
					<td class="text-center event_table_ac">
						<button type="button" data-event-id="<?= $event->id ?>"
							class="btn btn-sm btn-outline-primary rounded-circle wh-btn event_edit_action">
							<i class="fa fa-pen fa-xs"></i>
						</button> &nbsp;
						<button type="button" data-event-id="<?= $event->id ?>"
							class="btn btn-sm btn-outline-danger rounded-circle wh-btn event_delete_action">
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
						<li class="page-item <?=!$events->previous_page?'disabled':''?>">
							<a data-href="/admin/events?page=<?=$events->previous_page?>" class="page-link fa fa-caret-left"></a>
						</li>
						<?php for($i = 1; $i <= $events->last_page; $i++): ?>
						<li class="page-item <?=$i==$events->current_page?'disabled':''?>">
							<a class="page-link <?=$i==$events->current_page?'bg-danger border-danger text-white':''?>" data-href="/admin/events?page=<?=$i?>"><?=$i?></a>
						</li>
						<?php endfor; ?>
						<li class="page-item <?=!$events->next_page?'disabled':''?>">
							<a data-href="/admin/events?page=<?=$events->next_page?>" class="page-link fa fa-caret-right"></a>
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
		$('#new-event-button').off('click').on('click', function(e) {
			confirm_action({
				width: '750px',
				title: 'Create New Event',
				get : '/admin/events/create'
			});
		});

		// event_delete_action button click
		$('.event_delete_action').off('click').on('click', function(e) {
			let event_id = $(this).data('event-id');
			confirm_action({
				width : '500px',
				title : 'Confirm',
				body : 'Are you sure you want to delete this event?',
				action : 'Delete',
				btn : 'btn-danger'
			}, function(e) {
				sendAjax({
					url : '/admin/events/'+ event_id +'/delete',
					method : 'post', loader : true,
					success : resp => {
						$('.confirm_action_modal').modal('hide');
						toaster('Event has been deleted successfully.').success();
						load_page('/admin/events');
					},
					error : err => {
						$('.confirm_action_modal').modal('hide');
						toaster([err.status, err.statusText].join(' ')).error();
					}
				});
			});
		});

		// event_edit_action click
		$('.event_edit_action').off('click').on('click', function(e) {
			let event_id = $(this).data('event-id');
			confirm_action({
				title : 'Edit Event',
				loader : true,
				width : '750px',
				get : '/admin/events/'+ event_id +'/edit'
			});
		});
	});
</script>