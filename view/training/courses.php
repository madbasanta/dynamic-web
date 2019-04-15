<?php _include('inc/doc_head', ['title' => join(' | ', ['Our Approach', config('app_name', true)])]) ?>
<?php _include('inc/header', ['our_approach' => 'active']); ?>
<!-- Contents -->
<!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->
<section class="pricing py-5">
    <div class="container">
        <div class="row justify-content-center">
            <?php foreach($trainings as $course): ?>
            <!-- Free Tier -->
            <div class="col-lg-4 mb-3 mb-md-5">
                <div class="card mb-5 mb-lg-0">
                    <div class="card-body">
                        <h5 class="card-title text-muted text-uppercase text-center">
                            <?= $course->title ?>
                        </h5>
                        <h6 class="card-price text-center">
                            <span class="period"><?= date('d/m/Y', strtotime($course->start_date)) ?></span>
                        </h6>
                        <hr>
                        <?php if($addr = $course->address): ?>
                            <p>
                                <i class="fa fa-map-marker-alt mr-2"></i>
                                <?= $addr->site ?>
                            </p>
                        <?php endif; ?>
                        <p>
                            <?= limit_text($course->description, 55) ?>
                        </p>
                        <a href="javascript:void(0)" class="btn btn-block btn-danger text-uppercase course-details-approach" data-id="<?= $course->id ?>">Details</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php _include('inc/footer'); ?>
<!-- Scripts -->
<script>
    $(function() {
        $('.course-details-approach').off('click').on('click', function(e) {

        });
    });
</script>
</body>
</html>