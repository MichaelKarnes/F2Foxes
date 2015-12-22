<?php
    // initialize core database connection and import core classes
    include_once '../../core/init.php';
    // get the current user
    $user = new User();
     // kick the user out if the he's not logged in or doesn't have sufficient privileges
    if(!$user->isLoggedIn() || $user->data()->role < 3)
        Redirect::to("../../");
    // store the database connection into $db
    $db = DB::getInstance();
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
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../css/AdminLTE.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-warning">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                            <img src="../../images/rank-ssg.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li><!-- end message -->
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
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
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
              </li>
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-warning">9</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 9 tasks</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- Task item -->
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
                      </li><!-- end task item -->
                      <li><!-- Task item -->
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
                      </li><!-- end task item -->
                      <li><!-- Task item -->
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
                      </li><!-- end task item -->
                      <li><!-- Task item -->
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
                      </li><!-- end task item -->
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../../images/rank-ssg.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $user->data()->first." ".$user->data()->last; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../../images/rank-ssg.jpg" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $user->data()->first." ".$user->data()->last; ?> - Web Developer
                      <small>Member since Nov. 2012</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="../../actions/logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
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
            <div class="pull-left image">
              <img src="../../images/rank-ssg.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $user->data()->first." ".$user->data()->last; ?></p>
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
            <li class="">
              <a href="../../">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="treeview active">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Admin</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="../../pages/users"><i class="fa fa-circle-o"></i> Users</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Groups</a></li>
              </ul>
            </li>
            <li>
              <a href="../../pages/mailbox/mailbox.html">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-calendar"></i> <span>Training Schedule</span>
              </a>
            </li>
            <li>
              <a href="../../pages/grades">
                <i class="fa fa-graduation-cap"></i> <span>My Grades</span>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-sign-out"></i> <span>Sign Out Sheet</span>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-line-chart"></i> <span>PT Scores</span>
              </a>
            </li>
            <li class="treeview">
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
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Users
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Users</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Alert -->
          <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="icon fa fa-ban"></i> Danger alert preview. This alert is dismissable.
                </div>
            </div>
          </div>
          <!-- Users table -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <!-- Header -->
                <div class="box-header">
                  <h3 class="box-title">Users</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <?php
                  // get an array of every user in the system
                  $users = $db->get('users', array('1', '=', '1'))->results();
                  ?>
                  <table id="userstable" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Last Accessed</th>
                        <th>Password</th>
                        <th>Role</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($users as $iuser) { ?>
                      <tr style="height: 40px;">
                        <td><?php echo $iuser->first; ?></td>
                        <td><?php echo $iuser->last; ?></td>
                        <td><?php echo date('M d', strtotime($iuser->accessed)); ?></td>
                        <td>
                          <a href="#" data-toggle="modal" data-target="#passwordmodal">Change Password</a>
                        </td>
                        <td>
                          <?php if($iuser->role < $user->data()->role || $iuser->id == $user->data()->id) { ?>
                          <select onchange="alert('test');">
                            <option value="1" <?php if($iuser->role == 4) echo 'selected'; if($user->data()->role < 4) echo 'disabled'; ?>>Super Admin</option>
                            <option value="2" <?php if($iuser->role == 3) echo 'selected'; if($user->data()->role < 3) echo 'disabled'; ?>>Admin</option>
                            <option value="3" <?php if($iuser->role == 2) echo 'selected'; ?>>Member</option>
                            <option value="4" <?php if($iuser->role == 1) echo 'selected'; ?>>Non-Member</option>
                          </select>
                          <a href="#" id="changerole" style="margin-left: 10px; visibility: hidden;">Change</a>
                          <?php } else {
                            if($iuser->role == 4) echo 'Super Admin';
                            if($iuser->role == 3) echo 'Admin';
                            if($iuser->role == 2) echo 'Member';
                            if($iuser->role == 1) echo 'Non-Member';
                          } ?>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Last Accessed</th>
                        <th>Password</th>
                        <th>Role</th>
                      </tr>
                    </tfoot>
                  </table>
                  <div class="modal fade" id="passwordmodal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Change Password</h4>
                        </div>
                        <div class="modal-body">
                            <label style="width: 150px;">Password:</label>
                            <input id="pw-input" type="password" style="width: 200px;" />
                            <i id="pw-input-check" class="fa fa-check-circle" style="margin-left: 5px; display: none;"></i>
                            <i id="pw-input-error" class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="right" style="margin-left: 5px; display: none; color: #ab172b;"></i>
                            <br>
                            <label style="width: 150px;">Confirm Password:</label>
                            <input id="pw-check" type="password" style="width: 200px;" />
                            <i id="pw-check-check" class="fa fa-check-circle" style="margin-left: 5px; display: none;"></i>
                            <a id="pw-check-error" href="#" data-toggle="tooltip" data-placement="right" style="margin-left: 5px; display: none;"><i class="fa fa-exclamation-circle" style="color: #ab172b;"></i></a>
                            <br>
                            <label style="width: 150px;">Strength:</label>
                            <div id="pw-strength" class="progress" style="width: 200px; display: inline-block; margin: 0 0 -6px 0; position: relative;">
                            <div id="pw-strength-bar" class="progress-bar progress-bar-red" role="progressbar" style="width: 0%;"></div>
                            <div id="pw-strength-text" style="text-align: center; position: absolute; width: 100%;">Very Weak (0%)</div>
                            </div>
                            <i id="pw-strength-check" class="fa fa-check-circle" style="margin-left: 5px; display: none;"></i>
                            <i id="pw-strength-error" class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="right" style="margin-left: 5px; display: none; color: #ab172b;"></i>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button id="save" type="button" class="btn btn-primary disabled">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
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
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-warning pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked>
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right">
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- Slimscroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../js/demo.js"></script>
    <!-- page script -->
    <script>
        /*
            Users Table
        */

        $(function () { // called when the page finishes loading
            // create the Users table
            $('#userstable').DataTable({
                "paging": false, // do you want the table to be separated into pages if there are too many rows?
                "lengthChange": false, // not sure what this does...
                "searching": true, // do you want to be able to search through the table using a search box?
                "ordering": true, // do you want to be able to change whether a column is displayed in ascending or decending order?
                "info": false, // do you want the table to display info about the columns displayed (e.g. "Showing x of y entries")?
                "autoWidth": false // not sure what this does...
            });
        });

        /*
            Password Change Popup
        */

        $('#pw-input').on('keyup', function () { // called whenever the user releases a key when the Password input box is selected
            // by default, assume the user passes all minimum requirements
            // show the check icon and hide the error icon
            $('#pw-input-check').show();
            $('#pw-input-error').hide();

            /* Variables that will be used a lot */

            var str = $(this).val(); // the string from the Password input box
            var len = str.length; // length of the string from the Password input box
            var strength = 0; // strength of the password, assume 0 by default

            /* Common operations that will be used a lot */

            function upp(str) { // returns the number of upper case alphabetic characters in a string (A-Z)
                return str.replace(/[^A-Z]/g, "").length;
            }
            function low(str) { // returns the number of lower case alphabetic characters in a string (a-z)
                return str.replace(/[^a-z]/g, "").length;
            }
            function num(str) { // returns the number of numeric characters in a string (0-9)
                return str.replace(/[^0-9]/g, "").length;
            }
            function sym(str) { // returns the number of symbolic characters in a string (anything not an alphabetic or numeric character)
                return str.length - upp(str) - low(str) - num(str);
            }

            /* Bonuses to password strength */
            // source: http://askthegeek.kennyhart.com/password-meter/

            strength += len * 4; // number of characters
            strength += upp(str) > 0 ? (len - upp(str)) * 2 : 0; // uppercase letters
            strength += low(str) > 0 ? (len - low(str)) * 2 : 0; // lowercase letters
            strength += num(str) != len ? num(str) * 4 : 0; // numbers
            strength += sym(str) != len ? sym(str) * 6 : 0; // symbols
            strength += (num(str.substr(1, len - 2)) + sym(str.substr(1, len - 2))) * 2; // middle numbers or symbols
            // requirements - must pass both requirements to get bonuses
            if (len >= 8) { // minimum of 8 characters in length
                var reqnum = 0;
                if (upp(str) >= 1) reqnum++; // at least one uppercase letter
                if (low(str) >= 1) reqnum++; // at least one  lowercase letter
                if (num(str) >= 1) reqnum++; // at least one  number
                if (sym(str) >= 1) reqnum++; // at least one  symbol
                if (reqnum >= 3) strength += reqnum * 2 + 2; // if you meet at least 3 of these requirements, you get bonuses
            }

            /* Deductions to password strength */

            if (upp(str) + low(str) == len) strength -= len; // letters only
            if (num(str) == len) strength -= len; // numbers only

            // repeat characters (case insensitive)
            var nRepInc = 0;
            var nRepChar = 0;
            for (var i = 0; i < len; i++) {
                var jCharExists = false;
                for (var j = 0; j < len; j++) {
                    if (str[i] == str[j] && i != j) {
                        jCharExists = true;
                        nRepInc += Math.abs(len / (j - i));
                    }
                }
                if (jCharExists) {
                    nRepChar++;
                    var nUnqChar = len - nRepChar;
                    nRepInc = (nUnqChar) ? Math.ceil(nRepInc / nUnqChar) : Math.ceil(nRepInc);
                }
            }
            strength -= nRepInc;

            // consecutive uppercase letters
            var consecUpper = 0;
            var prevUpper = false;
            for (var i = 0; i < len; i++) {
                if (upp(str[i]) == 1) {
                    if (prevUpper)
                        consecUpper++;
                    else
                        prevUpper = true;
                } else {
                    prevUpper = false;
                }
            }
            strength -= consecUpper * 2;

            // consecutive lowercase letters
            var consecLower = 0;
            var prevLower = false;
            for (var i = 0; i < len; i++) {
                if (low(str[i]) == 1) {
                    if (prevLower)
                        consecLower++;
                    else
                        prevLower = true;
                } else {
                    prevLower = false;
                }
            }
            strength -= consecLower * 2;
            
            // consecutive numbers
            var consecNum = 0;
            var prevNum = false;
            for (var i = 0; i < len; i++) {
                if (num(str[i]) == 1) {
                    if (prevNum)
                        consecNum++;
                    else
                        prevNum = true;
                } else {
                    prevNum = false;
                }
            }
            strength -= consecNum * 2;

            // sequential letters (e.g. abc or zyx)
            var sAlphas = "abcdefghijklmnopqrstuvwxyz";
            var seqLetter = 0;
            for (var i = 0; i < sAlphas.length - 2; i++) {
                var sFwd = sAlphas.substr(i, 3);
                var sRev = sFwd.split("").reverse().join("");
                if (str.toLowerCase().indexOf(sFwd) != -1 || str.toLowerCase().indexOf(sRev) != -1)
                    seqLetter++;
            }
            strength -= seqLetter * 3;

            // sequential numbers (e.g. 123 or 654)
            var sNumerics = "01234567890";
            var seqNum = 0;
            for (var i = 0; i < sNumerics.length - 2; i++) {
                var sFwd = sNumerics.substr(i, 3);
                var sRev = sFwd.split("").reverse().join("");
                if (str.indexOf(sFwd) != -1 || str.indexOf(sRev) != -1)
                    seqNum++;
            }
            strength -= seqNum * 3;

            // sequential symbols (e.g. %^& or #@!)
            var sSymbols = ")!@#$%^&*()";
            var seqSym = 0;
            for (var i = 0; i < sSymbols.length - 2; i++) {
                var sFwd = sSymbols.substr(i, 3);
                var sRev = sFwd.split("").reverse().join("");
                if (str.indexOf(sFwd) != -1 || str.indexOf(sRev) != -1)
                    seqSym++;
            }
            strength -= seqSym * 3;

            // limit strength to between 0 and 100
            strength = Math.max(0, Math.min(strength, 100));

            /* Style updating */

            // update Strength bar length
            $('#pw-strength-bar').width(strength + '%');

            // update Strength bar color and text
            if (strength < 20) { // red zone (very week)
                $('#pw-strength-bar').removeClass();
                $('#pw-strength-bar').addClass('progress-bar progress-bar-red');
                $('#pw-strength-text').html('Very Weak (' + strength + '%)');
            } else if (strength < 40) { // red zone (weak)
                $('#pw-strength-bar').removeClass();
                $('#pw-strength-bar').addClass('progress-bar progress-bar-red');
                $('#pw-strength-text').html('Weak (' + strength + '%)');
            } else if (strength < 60) { // yellow zone (ok)
                $('#pw-strength-bar').removeClass();
                $('#pw-strength-bar').addClass('progress-bar progress-bar-yellow');
                $('#pw-strength-text').html('OK (' + strength + '%)');
            } else if (strength < 80) { // green zone (strong)
                $('#pw-strength-bar').removeClass();
                $('#pw-strength-bar').addClass('progress-bar progress-bar-green');
                $('#pw-strength-text').html('Strong (' + strength + '%)');
            } else { // green zone (very strong)
                $('#pw-strength-bar').removeClass();
                $('#pw-strength-bar').addClass('progress-bar progress-bar-green');
                $('#pw-strength-text').html('Very Strong (' + strength + '%)');
            }

            /* Error checking */

            var passed = false; // represents whether the password passes all minimum requirements

            if (len < 8) { // if the password length is < 8
                // change to the error icon and set the tooltip to 'Password must be at least 8 characters long.'
                $('#pw-input-error').attr('title', 'Password must be at least 8 characters long.').tooltip('fixTitle');
                $('#pw-input-check').hide();
                $('#pw-input-error').show();
                passed = false; // fails minimum requirements
                $('.modal-footer #save').removeClass();
                $('.modal-footer #save').addClass('btn btn-primary disabled');
            } else if (strength < 25) { // if the password strength is < 25
                // change to the error icon and set the tooltip to 'Password strength must be at least 25.'
                $('#pw-input-error').attr('title', 'Password strength must be at least 25.').tooltip('fixTitle');
                $('#pw-input-check').hide();
                $('#pw-input-error').show();
                passed = false; // fails minimum requirements
                // disable the Save Changes button
                $('.modal-footer #save').removeClass();
                $('.modal-footer #save').addClass('btn btn-primary disabled');
            } else {
                passed = true; // passes minimum requirements
                if ($(this).val() == $('#pw-check').val()) { // if the passwords match
                    // enable the Save Changes button
                    $('.modal-footer #save').removeClass();
                    $('.modal-footer #save').addClass('btn btn-primary');
                } else { // if the passwords don't match
                    // disable the Save Changes button
                    $('.modal-footer #save').removeClass();
                    $('.modal-footer #save').addClass('btn btn-primary disabled');
                }
            }
        });

        $('#pw-check').on('keyup', function () { // called whenever the user releases a key when the Confirm Password input box is selected
            // by default, assume the user passes validation
            // show the check icon and hide the error icon
            $('#pw-check-check').show();
            $('#pw-check-error').hide();

            if ($(this).val() != $('#pw-input').val()) { // if the passwords don't match
                // change to the error icon and set the tooltip to 'The passwords you entered do not match.'
                $('#pw-check-error').attr('title', 'The passwords you entered do not match.').tooltip('fixTitle');
                $('#pw-check-check').hide();
                $('#pw-check-error').show();
                // disable the Save Changes button
                $('.modal-footer #save').removeClass();
                $('.modal-footer #save').addClass('btn btn-primary disabled');
            } else if (passed) { // if the passwords match and the password meets all requirements
                // enable the Save Changes button
                $('.modal-footer #save').removeClass();
                $('.modal-footer #save').addClass('btn btn-primary');
            }
        });
    </script>
  </body>
</html>