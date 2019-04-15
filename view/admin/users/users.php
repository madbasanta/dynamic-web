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
			<h4 class="float-left mb-0">User Table</h4>
		</div>
		<table class="table table-sm table-bordered">
			<thead class="thead-light">
				<tr>
					<th class="text-center">ID</th>
					<th>Customer ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Role</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($users->data as $b): ?>
					<tr>
						<td class="text-center"><?= $b->id ?></td>
						<td><?= $b->cur_id ?></td>
						<td><?= $b->first_name . ' ' . $b->last_name ?></td>
						<td><?= $b->email ?></td>
						<td><?= $b->phone ?></td>
						<td><?= $b->role ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
			<tfoot>
			<tr>
				<td colspan="7">
					<ul class="pagination pagination-sm my-2 justify-content-center">
						<li class="page-item <?=!$users->previous_page?'disabled':''?>">
							<a data-href="/admin/users?page=<?=$users->previous_page?>" class="page-link fa fa-caret-left"></a>
						</li>
						<?php for($i = 1; $i <= $users->last_page; $i++): ?>
						<li class="page-item <?=$i==$users->current_page?'disabled':''?>">
							<a class="page-link <?=$i==$users->current_page?'bg-danger border-danger text-white':''?>" data-href="/admin/users?page=<?=$i?>"><?=$i?></a>
						</li>
						<?php endfor; ?>
						<li class="page-item <?=!$users->next_page?'disabled':''?>">
							<a data-href="/admin/users?page=<?=$users->next_page?>" class="page-link fa fa-caret-right"></a>
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