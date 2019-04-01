<footer id="sticky-footer" class="py-4 bg-dark text-white-50 <?= isset($fix_footer)?'fixed-bottom':'' ?>">
    <div class="container text-center">
    	<small>Copyright &copy; <?= config('app_name') . '. ' . date('Y') ?></small>
    </div>
</footer>
<section id="bottomMessage" class="fixed-bottom bg-dark py-3" style="display: none;">
	<span class="bottomMessageClose text-white">x</span>
	<div class="container" id="contents">
		<form action="javascript:void(0)">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Full name">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Email">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Phone">
					</div>
				</div>
				<div class="col-md-12">
					<button class="btn btn-primary btn-sm px-4">Book</button>
				</div>
			</div>
		</form>
	</div>
</section>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/master.js"></script>
