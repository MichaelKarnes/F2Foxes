<?php
    $weather = new Weather();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>F-2 Foxes | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../css/AdminLTE.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../../plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../../plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../../plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
     <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="../../plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="../../plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="../../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../../plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../js/app.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../js/demo.js"></script>
    <!-- FLOT CHARTS -->
    <script src="../../plugins/flot/jquery.flot.min.js"></script>
    <script src="../../plugins/flot/jquery.flot.time.min.js"></script>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="../../" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">F-2</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">Fox Company</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <!-- <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-warning">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="../../images/profile-fox.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="../../images/user3-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            AdminLTE Design Team
                            <small><i class="fa fa-clock-o"></i> 2 hours</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="../../images/user4-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Developers
                            <small><i class="fa fa-clock-o"></i> Today</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="../../images/user3-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Sales Department
                            <small><i class="fa fa-clock-o"></i> Yesterday</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="../../images/user4-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Reviewers
                            <small><i class="fa fa-clock-o"></i> 2 days</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li> -->
              <!-- Notifications: style can be found in dropdown.less -->
              <!-- <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-red"></i> 5 new members joined
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-user text-red"></i> You changed your username
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li> -->
              <!-- Tasks: style can be found in dropdown.less -->
              <!-- <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-warning">9</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 9 tasks</li>
                  <li>
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <h3>
                            Create a nice theme
                            <small class="pull-right">40%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">40% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <h3>
                            Some task I need to do
                            <small class="pull-right">60%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">60% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <h3>
                            Make beautiful transitions
                            <small class="pull-right">80%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">80% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li> -->
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../../images/profile-fox.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo escape($user->data()->first." ".$user->data()->last); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../../images/profile-fox.jpg" class="img-circle" alt="User Image">
                    <p>
                      <?php echo escape($user->data()->first." ".$user->data()->last); ?>
                      <!--<small>Member since Nov. 2012</small>-->
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!--<li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>-->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <!--<div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>-->
                    <div class="pull-right">
                      <a href="../../actions/logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <!--<li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>-->
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
            <div class="pull-left image">
              <img src="../../images/profile-fox.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo escape($user->data()->first." ".$user->data()->last); ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active">
              <a href="../../">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <?php if($user->data()->role >= 3) { ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Admin</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="../../pages/users"><i class="fa fa-circle-o"></i> Users</a></li>
              </ul>
            </li>
            <?php } ?>
            <!--<li>
              <a href="../../pages/mailbox">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>-->
            <li>
              <a href="../../pages/training">
                <i class="fa fa-calendar"></i> <span>Training Schedule</span>
              </a>
            </li>
            <li>
              <a href="../../pages/grades">
                <i class="fa fa-graduation-cap"></i> <span>My Grades</span>
              </a>
            </li>
            <li>
              <a href="../../pages/signout">
                <i class="fa fa-sign-out"></i> <span>Sign Out Sheet</span>
              </a>
            </li>
            <li>
              <a href="../../pages/signal">
                <i class="fa fa-bolt"></i> <span>Signal</span>
              </a>
            </li>
            <li>
              <a href="../../pages/pt">
                <i class="fa fa-line-chart"></i> <span>PT Scores</span>
              </a>
            </li>
            <!--<li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Squad 1-1</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="#"><i class="fa fa-circle-o"></i> Squad 1-1</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Team 1-1a</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Team 1-1b</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user-plus"></i>
                <span>Recruiting</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="#"><i class="fa fa-circle-o"></i> Page 1</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Page 2</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Page 3</a></li>
              </ul>
            </li>-->
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../"><i class="fa fa-dashboard"></i> Home</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Alert feature to be implemented later
          <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="icon fa fa-ban"></i> Danger alert preview. This alert is dismissable.
                </div>
            </div>
          </div> -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                      <h3><?php echo $weather->getTempF(); ?><sup style="font-size: 19px;">°F</sup></h3>
                        <i>Feels like <?php echo $weather->getFeelsLikeF(); ?>°</i>
                    </div>
                    <div class="icon">
                      <i class="ion ion-ios-<?php echo $weather->getIcon(); ?>"></i>
                    </div>
                    <!--<a href="#" class="small-box-footer">
                      More info <i class="fa fa-arrow-circle-right"></i>
                    </a>-->
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!--<div class="small-box bg-yellow-gradient">
                    <div class="inner">
                      <h3>Vixen Run</sup></h3>
                        <i>1800 Sat Oct 31</i>
                    </div>
                    <div class="icon">
                      <i class="ion ion-android-calendar"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                      More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>-->
            </div>
            <div class="col-lg-3 col-xs-6"></div>
            <div class="col-lg-3 col-xs-6"></div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <h1 style="text-align: center;">More widgets coming soon</h1>
            </div>
          </div>
          <!--<div class="row">
            <section class="col-lg-6 connectedSortable">
                <div class="box box-warning">
                    <div class="box-header">
                      <i class="fa fa-graduation-cap"></i>

                      <h3 class="box-title">Grades</h3>

                      <select class="pull-right" onchange="linechart($(this).val());">
                          <option>Platoon</option>
                          <option>Squad 1-1</option>
                          <option>Squad 1-2</option>
                          <option>Squad 1-3</option>
                      </select>

                    </div>
                    <div class="box-body">
                      <div id="line-chart" style="height: 300px;"></div>
                    </div>
                  </div>
            </section>
            <section class="col-lg-6 connectedSortable">
            </section>
          </div>-->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 0.1.0
        </div>
        <strong>Copyright &copy; 2016 Company F-2.</strong> All rights reserved. | <b>Design: <a href="http://almsaeedstudio.com">Almsaeed Studio</a></b>
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Coming Soon</h3>
            <ul class="control-sidebar-menu">
              <!--<li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>-->
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">Coming Soon</h3>
              <!--<div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div>

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked>
                </label>
              </div>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right">
                </label>
              </div>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div>-->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
    <script>
        function gd(year, month, day) {
            return new Date(year, month - 1, day).getTime();
        }
        function gl(time) {
            var d = new Date();
            d.setTime(time);
            var monthNames = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
            return d.getDate() + '' + monthNames[d.getMonth()] + '' + d.getFullYear();
        }
        //LINE randomly generated data
        var sqd1 = [[gd(2015, 8, 16), 2.81], [gd(2015, 8, 23), 2.87], [gd(2015, 8, 30), 3.82], [gd(2015, 9, 6), 2.82], [gd(2015, 9, 13), 3.01], [gd(2015, 9, 20), 2.93], [gd(2015, 9, 27), 2.96], [gd(2015, 10, 4), 3.88], [gd(2015, 10, 11), 2.90], [gd(2015, 10, 18), 3.36], [gd(2015, 10, 25), 2.58], [gd(2015, 11, 1), 3.60], [gd(2015, 11, 8), 3.21], [gd(2015, 11, 15), 3.61], [gd(2015, 11, 22), 3.03], [gd(2015, 11, 29), 2.72], [gd(2015, 12, 6), 2.20], [gd(2015, 12, 13), 2.30]];
        var sqd2 = [[gd(2015, 8, 16), 2.98], [gd(2015, 8, 23), 3.10], [gd(2015, 8, 30), 3.74], [gd(2015, 9, 6), 3.17], [gd(2015, 9, 13), 3.98], [gd(2015, 9, 20), 2.13], [gd(2015, 9, 27), 3.07], [gd(2015, 10, 4), 3.24], [gd(2015, 10, 11), 3.30], [gd(2015, 10, 18), 3.83], [gd(2015, 10, 25), 2.89], [gd(2015, 11, 1), 2.58], [gd(2015, 11, 8), 2.91], [gd(2015, 11, 15), 2.41], [gd(2015, 11, 22), 2.33], [gd(2015, 11, 29), 2.46], [gd(2015, 12, 6), 2.58], [gd(2015, 12, 13), 3.82]];
        var sqd3 = [[gd(2015, 8, 16), 2.32], [gd(2015, 8, 23), 2.71], [gd(2015, 8, 30), 2.07], [gd(2015, 9, 6), 3.56], [gd(2015, 9, 13), 3.60], [gd(2015, 9, 20), 3.83], [gd(2015, 9, 27), 2.59], [gd(2015, 10, 4), 2.13], [gd(2015, 10, 11), 2.24], [gd(2015, 10, 18), 3.15], [gd(2015, 10, 25), 2.43], [gd(2015, 11, 1), 3.08], [gd(2015, 11, 8), 3.92], [gd(2015, 11, 15), 3.52], [gd(2015, 11, 22), 2.94], [gd(2015, 11, 29), 2.33], [gd(2015, 12, 6), 2.29], [gd(2015, 12, 13), 2.99]];
        var plat = [[gd(2015, 8, 16), 2.70], [gd(2015, 8, 23), 2.89], [gd(2015, 8, 30), 3.21], [gd(2015, 9, 6), 2.88], [gd(2015, 9, 13), 3.53], [gd(2015, 9, 20), 2.96], [gd(2015, 9, 27), 2.87], [gd(2015, 10, 4), 3.08], [gd(2015, 10, 11), 2.81], [gd(2015, 10, 18), 3.45], [gd(2015, 10, 25), 2.63], [gd(2015, 11, 1), 3.09], [gd(2015, 11, 8), 3.35], [gd(2015, 11, 15), 3.18], [gd(2015, 11, 22), 2.77], [gd(2015, 11, 29), 2.50], [gd(2015, 12, 6), 2.36], [gd(2015, 12, 13), 3.04]];
        var squad1 = {
            data: sqd1,
            color: "#ab172b",
            label: 'Squad 1-1'
        };
        var squad2 = {
            data: sqd2,
            color: "#ab172b",
            label: 'Squad 1-2'
        };
        var squad3 = {
            data: sqd3,
            color: "#ab172b",
            label: 'Squad 1-3'
        };
        var platoon = {
            data: plat,
            color: "#ab172b",
            label: 'Red Platoon'
        };

        function linechart(name) {
            var chart;
            switch (name) {
                case 'Squad 1-1':
                    chart = squad1;
                    break;
                case 'Squad 1-2':
                    chart = squad2;
                    break;
                case 'Squad 1-3':
                    chart = squad3;
                    break;
                case 'Platoon':
                default:
                    chart = platoon;
                    break;
            }
            /*
            * LINE CHART
            * ----------
            */
            $.plot("#line-chart", [chart], {
                grid: {
                    hoverable: true,
                    borderColor: "#f3f3f3",
                    borderWidth: 1,
                    tickColor: "#f3f3f3"
                },
                series: {
                    shadowSize: 0,
                    lines: {
                        show: true
                    },
                    points: {
                        show: false
                    }
                },
                lines: {
                    fill: false,
                    color: ["#3c8dbc", "#f56954"]
                },
                legend: {
                    show: false
                },
                yaxis: {
                    label: "GPA",
                    min: 0,
                    max: 4
                },
                xaxis: {
                    //ticks: [[1, "16AUG2015"], [2, "23AUG2015"], [3, "30AUG2015"], [4, "06SEP2015"], [5, "13SEP2015"], [6, "20SEP2015"], [7, "27SEP2015"], [8, "04OCT2015"], [9, "11OCT2015"], [10, "18OCT2015"], [11, "25OCT2015"], [12, "01NOV2015"], [13, "08NOV2015"], [14, "15NOV2015"], [15, "22NOV2015"], [16, "29NOV2015"], [17, "06DEC2015"], [18, "13DEC2015"]]
                    mode: "time",
                    timeformat: "%m/%d"
                }
            });
            //Initialize tooltip on hover
            $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
                position: "absolute",
                display: "none",
                opacity: 0.8
            }).appendTo("body");
            $("#line-chart").bind("plothover", function (event, pos, item) {
                if (item) {
                    var x = item.datapoint[0].toFixed(2),
                        y = item.datapoint[1].toFixed(2);
                    //item.series.label
                    $("#line-chart-tooltip").html(y + "<br>" + gl(x))
                        .css({ top: item.pageY + 5, left: item.pageX + 5 })
                        .fadeIn(200);
                } else {
                    $("#line-chart-tooltip").hide();
                }
            });
            /* END LINE CHART */
        };

        $(function () {
            linechart();
        });
    </script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../../js/pages/dashboard.js"></script>
  </body>
</html>
