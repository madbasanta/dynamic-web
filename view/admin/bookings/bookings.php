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
			<h4 class="float-left mb-0">Booking Table</h4>
		</div>
		<table class="table table-sm table-bordered">
			<thead>
				<tr class="thead-light">
					<th class="text-center">ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Event</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($bookings->data as $b): ?>
					<tr>
						<td class="text-center"><?= $b->id ?></td>
						<td><?= $b->full_name ?></td>
						<td><?= $b->email ?></td>
						<td><?= $b->phone ?></td>
						<td><?= $b->title ?></td>
						<td><?= $b->booking_date ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
			<tfoot>
			<tr>
				<td colspan="7">
					<ul class="pagination pagination-sm my-2 justify-content-center">
						<li class="page-item <?=!$bookings->previous_page?'disabled':''?>">
							<a data-href="/admin/bookings?page=<?=$bookings->previous_page?>" class="page-link fa fa-caret-left"></a>
						</li>
						<?php for($i = 1; $i <= $bookings->last_page; $i++): ?>
						<li class="page-item <?=$i==$bookings->current_page?'disabled':''?>">
							<a class="page-link <?=$i==$bookings->current_page?'bg-danger border-danger text-white':''?>" data-href="/admin/bookings?page=<?=$i?>"><?=$i?></a>
						</li>
						<?php endfor; ?>
						<li class="page-item <?=!$bookings->next_page?'disabled':''?>">
							<a data-href="/admin/bookings?page=<?=$bookings->next_page?>" class="page-link fa fa-caret-right"></a>
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