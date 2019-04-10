<div class="card rounded-0">
	<div class="card-body pt-3">
		<h5>Event Table</h5>
		<table class="table table-sm table-bordered">
			<thead class="thead-light">
				<tr>
					<th class="text-center">ID</th>
					<th>Name</th>
					<th>Category</th>
					<th>Start Date</th>
					<th>Start Time</th>
					<th>City</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($events->data as $event): ?>
				<tr>
					<td class="text-center"><?= $event->id ?></td>
					<td><?= $event->title ?></td>
					<td><?= $event->category ?></td>
					<td><?= date('d/m/Y', $time = strtotime($event->start_date)) ?></td>
					<td><?= date('H:i A', $time) ?></td>
					<td><?= $event->city ?></td>
					<td>-</td>
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
	});
</script>