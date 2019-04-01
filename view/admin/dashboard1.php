<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
        <title><?= config('app_name') ?> | Dashboard</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="icon" type="image/png" href="favicon.png">
        
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/css/all.css">
        <!-- Ionicons -->
        <!-- <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}"> -->
        <!-- <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}"> -->
        <!-- Theme style -->
        <link rel="stylesheet" href="/assets/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
        <!-- <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}"> -->
        <!-- <link rel="stylesheet" type="text/css" href="{{ asset('plugins/iCheck/all.css') }}"> -->
        <!-- Morris chart -->
        <!-- <link rel="stylesheet" href="{{ asset('bower_components/morris.js/morris.css') }}"> -->
        <!-- jvectormap -->
        <!-- <link rel="stylesheet" href="{{ asset('bower_components/jvectormap/jquery-jvectormap.css') }}"> -->
        <!-- Date Picker -->
        <!-- <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"> -->
        <!-- Daterange picker -->
        <!-- <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}"> -->
        <!-- bootstrap wysihtml5 - text editor -->
        <!-- <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}"> -->
        <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}"> -->
        <!-- {{-- ajax page loader --}} -->
        <!-- <link rel="stylesheet" type="text/css" href="{{ asset('plugins/pace/pace.min.css') }}"> -->

        <!-- {{-- select 2 --}} -->
        <!-- <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}"> -->
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Google Font -->
        <!-- <style>img:hover{cursor: pointer;}</style> -->
        <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">

        <div class="modal" id="cModal">
            
        </div>

        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="index2.html" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">
                        <?= config('app_name') ?>
                    </span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg">
                        <?= config('app_name') ?>
                    </span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="/assets/img/no-user.png" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?= auth('first_name').' '.auth('last_name') ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="/assets/img/no-user.png" class="img-circle" alt="User Image">
                                        <p>
                                            <?= auth('first_name').' '.auth('last_name') ?>
                                            <small>Member since <?= date('M. Y', strtotime(auth('created_at'))) ?></small>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <!-- <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                                        </div> -->
                                        <div class=" text-center">
                                            <a href="javascript:void(0)" class="btn btn-default btn-flat" 
                                            onclick="document.getElementById('logout_form').submit()">Sign out</a>
                                            <form action="/logout" method="post" id="logout_form">@csrf</form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="float-left image">
                            <img src="/assets/img/no-user.png" class="img-circle" alt="User Image">
                        </div>
                        <div class="float-left info">
                            <p><?= auth('first_name').' '.auth('last_name') ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">MAIN NAVIGATION</li>
                        <li class="active">
                            <a href="admin/dashboard" id="dashboard" data-id="#dashboard">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-database"></i> <span>Models</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu" id="models-tree">
                                <li>
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-circle-o"></i>
                                        MENU 1
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div id="content-wrapper">
                    <!-- contents -->
                </div>
            </div>
            <!-- /.content-wrapper -->
            <footer id="sticky-footer" class="py-4 bg-dark text-white-50 fixed-bottom">
                <div class="container text-center">
                    <small>Copyright &copy; <?= config('app_name') . '. ' . date('Y') ?></small>
                </div>
            </footer>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- <script src="assets/js/master.js"></script> -->
    </body>
</html>