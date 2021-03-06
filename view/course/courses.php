<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= join(' | ', [config('app_name')]) ?></title>
  <link rel="icon" href="assets/img/master_favicon_thumbnail.png">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/all.css">
  <link rel="stylesheet" href="assets/css/style.css?t=<?= time() ?>">
</head>
<body>
  <?php _include('inc/header', ['courses' => 'active']); ?>
  <!-- Contents -->
  <!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->

  <section class="pricing py-5">
    <div class="container">
      <div class="row">
        <!-- Free Tier -->
        <div class="col-lg-4">
          <div class="card mb-5 mb-lg-0">
            <div class="card-body">
              <h5 class="card-title text-muted text-uppercase text-center">Javascript</h5>
              <h6 class="card-price text-center">$0<span class="period">/month</span></h6>
              <hr>
              <ul class="fa-ul">
                <li><span class="fa-li"><i class="fas fa-check"></i></span>Single User</li>
                <li><span class="fa-li"><i class="fas fa-check"></i></span>5GB Storage</li>
                <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited Public Projects</li>
                <li><span class="fa-li"><i class="fas fa-check"></i></span>Community Access</li>
                <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Unlimited Private Projects</li>
                <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Dedicated Phone Support</li>
                <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Free Subdomain</li>
                <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Monthly Status Reports</li>
              </ul>
              <a href="javascript:void(0)" class="btn btn-block btn-danger text-uppercase bookCourse">Book</a>
            </div>
          </div>
        </div>
        <!-- Plus Tier -->
        <div class="col-lg-4">
          <div class="card mb-5 mb-lg-0">
            <div class="card-body">
              <h5 class="card-title text-muted text-uppercase text-center">Python</h5>
              <h6 class="card-price text-center">$9<span class="period">/month</span></h6>
              <hr>
              <ul class="fa-ul">
                <li><span class="fa-li"><i class="fas fa-check"></i></span><strong>5 Users</strong></li>
                <li><span class="fa-li"><i class="fas fa-check"></i></span>50GB Storage</li>
                <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited Public Projects</li>
                <li><span class="fa-li"><i class="fas fa-check"></i></span>Community Access</li>
                <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited Private Projects</li>
                <li><span class="fa-li"><i class="fas fa-check"></i></span>Dedicated Phone Support</li>
                <li><span class="fa-li"><i class="fas fa-check"></i></span>Free Subdomain</li>
                <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Monthly Status Reports</li>
              </ul>
              <a href="javascript:void(0)" class="btn btn-block btn-danger text-uppercase bookCourse">Book</a>
            </div>
          </div>
        </div>
        <!-- Pro Tier -->
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-muted text-uppercase text-center">Ruby</h5>
              <h6 class="card-price text-center">$49<span class="period">/month</span></h6>
              <hr>
              <ul class="fa-ul">
                <li><span class="fa-li"><i class="fas fa-check"></i></span><strong>Unlimited Users</strong></li>
                <li><span class="fa-li"><i class="fas fa-check"></i></span>150GB Storage</li>
                <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited Public Projects</li>
                <li><span class="fa-li"><i class="fas fa-check"></i></span>Community Access</li>
                <li><span class="fa-li"><i class="fas fa-check"></i></span>Unlimited Private Projects</li>
                <li><span class="fa-li"><i class="fas fa-check"></i></span>Dedicated Phone Support</li>
                <li><span class="fa-li"><i class="fas fa-check"></i></span><strong>Unlimited</strong> Free Subdomains</li>
                <li><span class="fa-li"><i class="fas fa-check"></i></span>Monthly Status Reports</li>
              </ul>
              <a href="javascript:void(0)" class="btn btn-block btn-danger text-uppercase bookCourse">Book</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php _include('inc/footer'); ?>
  <!-- Scripts -->
</body>
</html>