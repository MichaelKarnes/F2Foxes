<?php
    // initialize core database connection and import core classes
    include_once '../../core/init.php';
    // get the current user
    $user = new User();
     // kick the user out if the he's not logged in
    if(!$user->isLoggedIn())
        Redirect::to("../../");
    // store the database connection into $db
    $db = DB::getInstance();
    // create a token to submit with all forms
    $token = Token::generate();
    // store any errors returned to the page into $error
    $error = Session::flash('error');
    // get the current user's courses
    $courses = $db->get('courses', array('user_id', '=', $user->data()->id))->results();
    // sort the courses by credits, or by abbrev if the credits are equal
    usort($courses, function ($a, $b) {
        if($a->credits == $b->credits)
            return ($a->abbrev < $b->abbrev) ? -1 : 1;
        return ($a->credits > $b->credits) ? -1 : 1;
    });
    // get the current user's gpa and number of hours
    $gpa = 0;
    $hours = 0;
    foreach($courses as $course) {
        if(empty($course->grade))
            continue;
        $gpa += (floor(max(min(decrypt($course->grade, $user->data()->salt), 90), 50) / 10) - 5) * $course->credits; // turns percentage grade into credits earned
        $hours += $course->credits;
    }
    if($hours > 0)
        $gpa /= $hours;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>F-2 Foxes | My Grades</title>
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
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../../plugins/iCheck/all.css">
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
            <li>
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
            <li class="active">
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
            My Grades
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">My Grades</li>
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
          <!-- Grades stuff -->
          <div class="row">
            <div class="col-md-6">
              <div class="box">
                <div class="box-header">
                  <h3 id="gpa" class="box-title">GPA: <?php if($hours > 0) echo number_format($gpa, 2, '.', ''); else echo '--'; ?></h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#addcoursemodal"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <table class="table">
                    <?php foreach($courses as $course) { ?>
                    <tr id="<?php echo $course->id; ?>-select" style="cursor: pointer;" onclick="change_course('<?php echo $course->id; ?>');">
                      <td>
                        <div>
                          <span style="font-size: 24pt;"><span class="cGrade"><?php if(empty($course->grade)) echo '--'; else echo number_format(decrypt($course->grade, $user->data()->salt), 1, '.', ''); ?></span><?php if(!empty($course->note)) { ?><span data-toggle="tooltip" data-placement="right" title="<?php echo $course->note; ?>">*</span><?php } ?></span>
                          <span class="pull-right"><?php echo date('M j', strtotime($course->updated)); ?></span>
                        </div>
                        <i>(<?php echo $course->credits; ?>) <?php echo strtoupper($course->abbrev); ?> <?php echo $course->num; ?>: <?php echo $course->name; ?></i>
                      </td>
                    </tr>
                    <?php } ?>
                  </table>
                </div>
              </div>
              <!-- /.box -->
            </div>
            <div class="col-md-6">
              <?php foreach($courses as $course) { ?>
              <div id="<?php echo $course->id; ?>" class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo strtoupper($course->abbrev); ?> <?php echo $course->num; ?>: <?php echo $course->name; ?></h3>
                  <div class="box-tools pull-right">
                    <!--<button type="button" class="btn btn-box-tool"><i class="fa fa-pencil" onclick="edit_course('<?php echo $course->id; ?>');"></i></button>-->
                    <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#deletecoursemodal-<?php echo $course->id; ?>"><i class="fa fa-trash"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <?php
                      $categories = $db->get('grade_categories', array('course_id', '=', $course->id))->results();
                      // sort the categories by name
                      usort($categories, function ($a, $b) {
                          return ($a->name < $b->name) ? -1 : 1;
                      });
                  ?>
                  <?php foreach($categories as $category) { ?>
                  <div class="box-group" id="accordion<?php echo $category->id; ?>">
                    <div class="panel box" style="border-top: none;">
                      <div class="box-header with-border">
                        <h4 class="box-title" style="width: 100%;">
                          <a data-toggle="collapse" data-parent="#accordion<?php echo $category->id; ?>" href="#collapse<?php echo $category->id; ?>" style="color: #444;">
                            <span style="display: block; width: 100%;">
                              <span><?php echo $category->name; ?> <small>(<?php if($course->pointsystem) echo floor(decrypt($category->total, $user->data()->salt)).' pts'; else echo decrypt($category->total, $user->data()->salt).'%'; ?>)</small></span>
                              <?php if(!empty($category->earned) && !empty($category->available)) { ?>
                              <span class="pull-right"><b><?php echo number_format(decrypt($category->earned, $user->data()->salt), 1); ?></b><small>/<?php echo number_format(decrypt($category->available, $user->data()->salt), 1); ?></small></span>
                              <?php } else { ?>
                              <span class="pull-right"><b>--</b><small>/--</small></span>
                              <?php } ?>
                            </span>
                          </a>
                        </h4>
                      </div>
                      <div id="collapse<?php echo $category->id; ?>" class="panel-collapse collapse">
                        <div class="box-body">
                          <table class="table no-border">
                            <colgroup>
                              <col style="width: 20px; text-align: center;"></col>
                              <col style="width: 20px; text-align: center;"></col>
                              <col></col>
                              <col></col>
                              <col></col>
                            </colgroup>
                            <?php
                                $grades = $db->get('grades', array('category_id', '=', $category->id))->results();
                                // sort the grades by name
                                usort($grades, function ($a, $b) {
                                    return ($a->name < $b->name) ? -1 : 1;
                                });
                            ?>
                            <?php foreach($grades as $grade) { ?>
                            <tr>
                              <td><a href="#" style="color: #333;" onclick="edit_grade('<?php echo $course->id; ?>', '<?php echo $category->id; ?>', '<?php echo $grade->id; ?>', $(this).parent().parent()); return false;"><i class="fa fa-pencil"></i></a></td>
                              <td><a href="#" style="color: #333;" onclick="delete_grade('<?php echo $course->id; ?>', '<?php echo $category->id; ?>', '<?php echo $grade->id; ?>', $(this).parent().parent()); return false;"><i class="fa fa-trash"></i></a></td>
                              <td class="gName"><?php echo $grade->name; ?></td>
                              <td class="gGrade" style="text-align: right;"><b><?php echo number_format(decrypt($grade->earned, $user->data()->salt), 1, '.', ''); ?></b><small>/<?php echo number_format(decrypt($grade->total, $user->data()->salt), 1, '.', ''); ?></small></td>
                            </tr>
                            <?php } ?>
                            <tr>
                              <td colspan="2"><button class="btn btn-primary btn-xs" onclick="create_grade('<?php echo $course->id; ?>', '<?php echo $category->id; ?>', $(this).parent().parent());"><i class="fa fa-plus"></i></button></td>
                              <td><input id="gName" type="text" style="width: 100%;" placeholder="Name" /></td>
                              <td style="text-align: right;"><input id="gEarned" type="number" placeholder="Score" style="width: 55px;" />/<input id="gTotal" type="number" value="100" placeholder="Total" style="width: 55px;" /></td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
          <div class="modal fade" id="addcoursemodal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <form class="modal-content box">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Add Course</h4>
                </div>
                <div class="modal-body">
                  <label style="width: 150px;">Course Abbreviation:</label>
                  <input id="abbrev-input" type="text" style="width: 100px;" placeholder="ex: PHYS" />
                  <i id="abbrev-input-check" class="fa fa-check-circle" style="margin-left: 5px; display: none;"></i>
                  <i id="abbrev-input-error" class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="right" style="margin-left: 5px; display: none; color: #ab172b;"></i>
                  <br>
                  <label style="width: 150px;">Course Number:</label>
                  <input id="num-input" type="number" style="width: 100px;" placeholder="ex: 218" />
                  <i id="num-input-check" class="fa fa-check-circle" style="margin-left: 5px; display: none;"></i>
                  <i id="num-input-error" class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="right" style="margin-left: 5px; display: none; color: #ab172b;"></i>
                  <br>
                  <label style="width: 150px;">Credits:</label>
                  <input id="credits-input" type="number" style="width: 100px;" placeholder="ex: 4" />
                  <i id="credits-input-check" class="fa fa-check-circle" style="margin-left: 5px; display: none;"></i>
                  <i id="credits-input-error" class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="right" style="margin-left: 5px; display: none; color: #ab172b;"></i>
                  <br>
                  <label style="width: 150px;">Course Name:</label>
                  <input id="name-input" type="text" style="width: 200px;" placeholder="ex: Mechanics (Optional)" />
                  <br>
                  <label style="width: 150px;">Note:</label>
                  <input id="note-input" type="text" style="width: 200px;" placeholder="ex: 2 quizzes dropped (Optional)" />
                  <br>
                  <label style="width: 150px;">Grade System:</label>
                  <label><input name="pointsystem-input" type="radio" value="0" checked /> Percent</label>
                  <label style="margin-left: 10px;"><input name="pointsystem-input" type="radio" value="1" /> Points</label>
                  <br>
                  <label style="width: 150px;">Grade Category:</label>
                  <input class="category-input" type="text" style="width: 110px;" placeholder="ex: Tests" onkeyup="category_input($(this), 0);" />
                  <label class="category-points-label" style="width: 35px; margin-right: 5px; text-align: right;">%:</label>
                  <input class="category-points-input" type="number" style="width: 50px;" onkeyup="category_points_input($(this), 0);" />
                  <i id="category-input-check-0" class="fa fa-check-circle" style="margin-left: 5px; display: none;"></i>
                  <i id="category-input-error-0" class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="right" style="margin-left: 5px; display: none; color: #ab172b;"></i>
                  <br>
                  <button id="remove-category" type="button" class="btn btn-default btn-xs"><i class="fa fa-minus"></i></button>
                  <button id="add-category" type="button" class="btn btn-default btn-xs"><i class="fa fa-plus"></i></button>
                  <br>
                  <input id="token" type="hidden" value="<?php echo $token; ?>" />
                </div>
                <div class="overlay" style="display: none;">
                  <i class="fa fa-refresh fa-spin"></i>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <input id="submit" type="submit" class="btn btn-primary disabled" disabled value="Add Course" />
                </div>
              </form>
            </div>
          </div>
          <?php foreach($courses as $course) { ?>
          <div class="modal fade" id="deletecoursemodal-<?php echo $course->id; ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <form class="modal-content box" onsubmit="delete_course('<?php echo $course->id; ?>'); return false;">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Delete Course</h4>
                </div>
                <div class="modal-body">
                  Are you <i>sure</i> you want to delete this course?
                  <br>
                  <br>
                  <label style="width: 150px;">Course Abbreviation:</label>
                  <span><?php echo $course->abbrev; ?></span>
                  <br>
                  <label style="width: 150px;">Course Number:</label>
                  <span><?php echo $course->num; ?></span>
                  <br>
                  <label style="width: 150px;">Credits:</label>
                  <span><?php echo $course->credits; ?></span>
                  <br>
                  <label style="width: 150px;">Course Name:</label>
                  <span><?php echo $course->name; ?></span>
                  <br>
                  <label style="width: 150px;">Note:</label>
                  <span><?php echo $course->note; ?></span>
                  <br>
                  <label style="width: 150px;">Grade System:</label>
                  <span><?php echo $course->pointsystem == 0 ? 'Percent' : 'Points'; ?></span>
                  <br>
                  <?php
                      $categories = $db->get('grade_categories', array('course_id', '=', $course->id))->results();
                      // sort the categories by name
                      usort($categories, function ($a, $b) {
                          return ($a->name < $b->name) ? -1 : 1;
                      });
                  ?>
                  <?php foreach($categories as $category) { ?>
                  <label style="width: 150px;">Grade Category:</label>
                  <span><?php echo $category->name.' ('.decrypt($category->total, $user->data()->salt).($category->pointsystem == 0 ? '%' : 'pts').')'; ?></span>
                  <br>
                  <?php } ?>
                  <input id="token" type="hidden" value="<?php echo $token; ?>" />
                </div>
                <div class="overlay" style="display: none;">
                  <i class="fa fa-refresh fa-spin"></i>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <input id="submit" type="submit" class="btn btn-primary" value="Delete Course" />
                </div>
              </form>
            </div>
          </div>
          <?php } ?>
          <div class="modal fade" id="errormodal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content box">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Error</h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                  <input type="button" class="btn btn-primary" data-dismiss="modal" value="OK" />
                </div>
              </div>
            </div>
          </div>
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
        function delete_course(course_id) {
            $.post("../../actions/delete/course.php",
            {
                id: course_id,
                token: '<?php echo $token; ?>'
            },
            function (data, status) {
                location.reload();
            });
            return false;
        }
    </script>
    <script>
        var acmodabbrev = false; // represents whether the course abbreviation from the add course modal passes all minimum requirements
        var acmodnum = false; // represents whether the course number from the add course modal passes all requirements
        var acmodcredits = false; // represents whether the credits from the add course modal passes all requirements
        var acmodcategory = [false]; // represents whether each grade category from the add course modal passes all requirements
        var acmodcategorypoints = [false]; // represents whether each grade category points from the add course modal passes all requirements
        var acmodsystem = 0; // represents which grade system is selected (0 = percent, 1 = points)

        $('#addcoursemodal #abbrev-input').on('keyup', function () { // called whenever the user releases a key when the Course Abbreviation input box is selected
            // by default, assume the abbreviation passes all minimum requirements
            // show the check icon and hide the error icon
            $('#addcoursemodal #abbrev-input-check').show();
            $('#addcoursemodal #abbrev-input-error').hide();

            /* Error checking */

            if ($(this).val().length > 5) { // if the abbreviation length is > 5
                // change to the error icon and set the tooltip to 'Course Abbreviation cannot be more than 5 characters long.'
                $('#addcoursemodal #abbrev-input-error').attr('title', 'Course Abbreviation cannot be more than 5 characters long.').tooltip('fixTitle');
                $('#addcoursemodal #abbrev-input-check').hide();
                $('#addcoursemodal #abbrev-input-error').show();
                acmodabbrev = false; // fails minimum requirements
                $('#addcoursemodal .modal-footer #submit').removeClass();
                $('#addcoursemodal .modal-footer #submit').addClass('btn btn-primary disabled');
                $('#addcoursemodal .modal-footer #submit').attr('disabled', 'disabled');
            } else if ($(this).val().length < 4) { // if the abbreviation length is < 4
                // change to the error icon and set the tooltip to 'Course Abbreviation must be at least 4 characters long.'
                $('#addcoursemodal #abbrev-input-error').attr('title', 'Course Abbreviation must be at least 4 characters long.').tooltip('fixTitle');
                $('#addcoursemodal #abbrev-input-check').hide();
                $('#addcoursemodal #abbrev-input-error').show();
                acmodabbrev = false; // fails minimum requirements
                $('#addcoursemodal .modal-footer #submit').removeClass();
                $('#addcoursemodal .modal-footer #submit').addClass('btn btn-primary disabled');
                $('#addcoursemodal .modal-footer #submit').attr('disabled', 'disabled');
            } else {
                acmodabbrev = true; // passes minimum requirements
                if (acmodnum && acmodcredits && acmodcategory.every(Boolean) && acmodcategorypoints.every(Boolean)) { // if the abbreviation, course number, and all grade categories meet all requirements
                    // enable the Save Changes button
                    $('#addcoursemodal .modal-footer #submit').removeClass();
                    $('#addcoursemodal .modal-footer #submit').addClass('btn btn-primary');
                    $('#addcoursemodal .modal-footer #submit').removeAttr('disabled');
                } else { // if something isn't right yet
                    // disable the Save Changes button
                    $('#addcoursemodal .modal-footer #submit').removeClass();
                    $('#addcoursemodal .modal-footer #submit').addClass('btn btn-primary disabled');
                    $('#addcoursemodal .modal-footer #submit').attr('disabled', 'disabled');
                }
            }
        });

        $('#addcoursemodal #num-input').on('keyup', function () { // called whenever the user releases a key when the Course Number input box is selected
            // by default, assume the course number passes all minimum requirements
            // show the check icon and hide the error icon
            $('#addcoursemodal #num-input-check').show();
            $('#addcoursemodal #num-input-error').hide();

            /* Error checking */

            if ($(this).val().length > 4) { // if the course number length is > 4
                // change to the error icon and set the tooltip to 'Course Number cannot be more than 4 characters long.'
                $('#addcoursemodal #num-input-error').attr('title', 'Course Number cannot be more than 4 characters long.').tooltip('fixTitle');
                $('#addcoursemodal #num-input-check').hide();
                $('#addcoursemodal #num-input-error').show();
                acmodnum = false; // fails minimum requirements
                $('#addcoursemodal .modal-footer #submit').removeClass();
                $('#addcoursemodal .modal-footer #submit').addClass('btn btn-primary disabled');
                $('#addcoursemodal .modal-footer #submit').attr('disabled', 'disabled');
            } else if ($(this).val().length < 3) { // if the course number length is < 3
                // change to the error icon and set the tooltip to 'Course Number must be at least 3 characters long.'
                $('#addcoursemodal #num-input-error').attr('title', 'Course Number must be at least 3 characters long.').tooltip('fixTitle');
                $('#addcoursemodal #num-input-check').hide();
                $('#addcoursemodal #num-input-error').show();
                acmodnum = false; // fails minimum requirements
                $('#addcoursemodal .modal-footer #submit').removeClass();
                $('#addcoursemodal .modal-footer #submit').addClass('btn btn-primary disabled');
                $('#addcoursemodal .modal-footer #submit').attr('disabled', 'disabled');
            } else {
                acmodnum = true; // passes minimum requirements
                if (acmodabbrev && acmodcategory.every(Boolean) && acmodcategorypoints.every(Boolean)) { // if the abbreviation, course number, and all grade categories meet all requirements
                    // enable the Save Changes button
                    $('#addcoursemodal .modal-footer #submit').removeClass();
                    $('#addcoursemodal .modal-footer #submit').addClass('btn btn-primary');
                    $('#addcoursemodal .modal-footer #submit').removeAttr('disabled');
                } else { // if something isn't right yet
                    // disable the Save Changes button
                    $('#addcoursemodal .modal-footer #submit').removeClass();
                    $('#addcoursemodal .modal-footer #submit').addClass('btn btn-primary disabled');
                    $('#addcoursemodal .modal-footer #submit').attr('disabled', 'disabled');
                }
            }
        });

        $('#addcoursemodal #credits-input').on('keyup', function () { // called whenever the user releases a key when the Credits input box is selected
            // by default, assume the credits passes all minimum requirements
            // show the check icon and hide the error icon
            $('#addcoursemodal #credits-input-check').show();
            $('#addcoursemodal #credits-input-error').hide();

            /* Error checking */

            if ($(this).val().length != 1) { // if the credits length != 1
                // change to the error icon and set the tooltip to 'Credits must be exactly one character long.'
                $('#addcoursemodal #credits-input-error').attr('title', 'Credits must be exactly one character long.').tooltip('fixTitle');
                $('#addcoursemodal #credits-input-check').hide();
                $('#addcoursemodal #credits-input-error').show();
                acmodcredits = false; // fails minimum requirements
                $('#addcoursemodal .modal-footer #submit').removeClass();
                $('#addcoursemodal .modal-footer #submit').addClass('btn btn-primary disabled');
                $('#addcoursemodal .modal-footer #submit').attr('disabled', 'disabled');
            } else {
                acmodcredits = true; // passes minimum requirements
                if (acmodabbrev && acmodnum && acmodcategory.every(Boolean) && acmodcategorypoints.every(Boolean)) { // if the abbreviation, course number, and all grade categories meet all requirements
                    // enable the Save Changes button
                    $('#addcoursemodal .modal-footer #submit').removeClass();
                    $('#addcoursemodal .modal-footer #submit').addClass('btn btn-primary');
                    $('#addcoursemodal .modal-footer #submit').removeAttr('disabled');
                } else { // if something isn't right yet
                    // disable the Save Changes button
                    $('#addcoursemodal .modal-footer #submit').removeClass();
                    $('#addcoursemodal .modal-footer #submit').addClass('btn btn-primary disabled');
                    $('#addcoursemodal .modal-footer #submit').attr('disabled', 'disabled');
                }
            }
        });

        $('#addcoursemodal input[name="pointsystem-input"]').change(function () { // called whenever the user changes the Point System radios
            acmodsystem = $(this).val();
            $('.category-points-label').each(function () {
                $(this).html((acmodsystem == 0 ? '%' : 'pts') + ':');
            });
        });

        function category_input(input, index) { // called whenever the user releases a key when any Grade Category input box is selected
            // by default, assume the grade category passes all minimum requirements
            // show the check icon and hide the error icon
            $('#addcoursemodal #category-input-check-' + index).show();
            $('#addcoursemodal #category-input-error-' + index).hide();

            /* Error checking */

            if ($(input).val().length == 0) { // if the grade category input is blank
                // change to the error icon and set the tooltip to 'Grade Category is required.'
                $('#addcoursemodal #category-input-error-' + index).attr('title', 'Grade Category is required.').tooltip('fixTitle');
                $('#addcoursemodal #category-input-check-' + index).hide();
                $('#addcoursemodal #category-input-error-' + index).show();
                acmodcategory[index] = false; // fails minimum requirements
                $('#addcoursemodal .modal-footer #submit').removeClass();
                $('#addcoursemodal .modal-footer #submit').addClass('btn btn-primary disabled');
                $('#addcoursemodal .modal-footer #submit').attr('disabled', 'disabled');
            } else if (!acmodcategorypoints[index]) { // if the grade category points input is blank
                acmodcategory[index] = true; // passes minimum requirements
                // change to the error icon and set the tooltip to 'Grade Category %/pts is required.'
                $('#addcoursemodal #category-input-error-' + index).attr('title', 'Grade Category ' + (acmodsystem == 0 ? '%' : 'pts') + ' is required.').tooltip('fixTitle');
                $('#addcoursemodal #category-input-check-' + index).hide();
                $('#addcoursemodal #category-input-error-' + index).show();
                $('#addcoursemodal .modal-footer #submit').removeClass();
                $('#addcoursemodal .modal-footer #submit').addClass('btn btn-primary disabled');
                $('#addcoursemodal .modal-footer #submit').attr('disabled', 'disabled');
            } else {
                acmodcategory[index] = true; // passes minimum requirements
                if (acmodabbrev && acmodnum && acmodcredits && acmodcategory.every(Boolean) && acmodcategorypoints.every(Boolean)) { // if the abbreviation, course number, and all grade categories meet all requirements
                    // enable the Save Changes button
                    $('#addcoursemodal .modal-footer #submit').removeClass();
                    $('#addcoursemodal .modal-footer #submit').addClass('btn btn-primary');
                    $('#addcoursemodal .modal-footer #submit').removeAttr('disabled');
                } else { // if something isn't right yet
                    // disable the Save Changes button
                    $('#addcoursemodal .modal-footer #submit').removeClass();
                    $('#addcoursemodal .modal-footer #submit').addClass('btn btn-primary disabled');
                    $('#addcoursemodal .modal-footer #submit').attr('disabled', 'disabled');
                }
            }
        }

        function category_points_input(input, index) { // called whenever the user releases a key when any Grade Category %/pts input box is selected
            // by default, assume the grade category points passes all minimum requirements
            // show the check icon and hide the error icon
            $('#addcoursemodal #category-input-check-' + index).show();
            $('#addcoursemodal #category-input-error-' + index).hide();

            /* Error checking */

            if ($(input).val().length == 0) { // if the grade category points input is blank
                // change to the error icon and set the tooltip to 'Grade Category %/pts is required.'
                $('#addcoursemodal #category-input-error-' + index).attr('title', 'Grade Category ' + (acmodsystem == 0 ? '%' : 'pts') + ' is required.').tooltip('fixTitle');
                $('#addcoursemodal #category-input-check-' + index).hide();
                $('#addcoursemodal #category-input-error-' + index).show();
                acmodcategorypoints[index] = false; // fails minimum requirements
                $('#addcoursemodal .modal-footer #submit').removeClass();
                $('#addcoursemodal .modal-footer #submit').addClass('btn btn-primary disabled');
                $('#addcoursemodal .modal-footer #submit').attr('disabled', 'disabled');
            } else if (!acmodcategory[index]) { // if the grade category input is blank
                acmodcategorypoints[index] = true; // passes minimum requirements
                // change to the error icon and set the tooltip to 'Grade Category is required.'
                $('#addcoursemodal #category-input-error-' + index).attr('title', 'Grade Category is required.').tooltip('fixTitle');
                $('#addcoursemodal #category-input-check-' + index).hide();
                $('#addcoursemodal #category-input-error-' + index).show();
                $('#addcoursemodal .modal-footer #submit').removeClass();
                $('#addcoursemodal .modal-footer #submit').addClass('btn btn-primary disabled');
                $('#addcoursemodal .modal-footer #submit').attr('disabled', 'disabled');
            } else {
                acmodcategorypoints[index] = true; // passes minimum requirements
                if (acmodabbrev && acmodnum && acmodcredits && acmodcategory.every(Boolean) && acmodcategorypoints.every(Boolean)) { // if the abbreviation, course number, and all grade categories meet all requirements
                    // enable the Save Changes button
                    $('#addcoursemodal .modal-footer #submit').removeClass();
                    $('#addcoursemodal .modal-footer #submit').addClass('btn btn-primary');
                    $('#addcoursemodal .modal-footer #submit').removeAttr('disabled');
                } else { // if something isn't right yet
                    // disable the Save Changes button
                    $('#addcoursemodal .modal-footer #submit').removeClass();
                    $('#addcoursemodal .modal-footer #submit').addClass('btn btn-primary disabled');
                    $('#addcoursemodal .modal-footer #submit').attr('disabled', 'disabled');
                }
            }
        }

        $('#addcoursemodal #add-category').click(function () { // called whenever the user presses the + button
            $(this).prev().before('\
            <label style="width: 150px;">Grade Category:</label>\
            <input class="category-input" type="text" style="width: 110px;" placeholder="ex: Tests" onkeyup="category_input($(this), ' + acmodcategory.length + ');" />\
            <label class="category-points-label" style="width: 35px; margin-right: 5px; text-align: right;">' + (acmodsystem == 0 ? '%' : 'pts') + ':</label>\
            <input class="category-points-input" type="number" style="width: 50px;" onkeyup="category_points_input($(this), ' + acmodcategory.length + ');" />\
            <i id="category-input-check-' + acmodcategory.length + '" class="fa fa-check-circle" style="margin-left: 5px; display: none;"></i>\
            <i id="category-input-error-' + acmodcategory.length + '" class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="right" style="margin-left: 5px; display: none; color: #ab172b;"></i>\
            <br>\
            ');
            acmodcategory.push(false);
            acmodcategorypoints.push(false);
            $('#addcoursemodal .modal-footer #submit').removeClass();
            $('#addcoursemodal .modal-footer #submit').addClass('btn btn-primary disabled');
            $('#addcoursemodal .modal-footer #submit').attr('disabled', 'disabled');
        });

        $('#addcoursemodal #remove-category').click(function () { // called whenever the user presses the + button
            $(this).prev().remove();
            $(this).prev().remove();
            $(this).prev().remove();
            $(this).prev().remove();
            $(this).prev().remove();
            $(this).prev().remove();
            $(this).prev().remove();
            acmodcategory.pop();
            acmodcategorypoints.pop();
            if (acmodabbrev && acmodnum && acmodcredits && acmodcategory.every(Boolean) && acmodcategorypoints.every(Boolean)) { // if the abbreviation, course number, and all grade categories meet all requirements
                // enable the Save Changes button
                $('#addcoursemodal .modal-footer #submit').removeClass();
                $('#addcoursemodal .modal-footer #submit').addClass('btn btn-primary');
                $('#addcoursemodal .modal-footer #submit').removeAttr('disabled');
            } else { // if something isn't right yet
                // disable the Save Changes button
                $('#addcoursemodal .modal-footer #submit').removeClass();
                $('#addcoursemodal .modal-footer #submit').addClass('btn btn-primary disabled');
                $('#addcoursemodal .modal-footer #submit').attr('disabled', 'disabled');
            }
        });

        $('#addcoursemodal form').on('submit', function () {
            if (acmodabbrev && acmodnum && acmodcredits && acmodcategory.every(Boolean) && acmodcategorypoints.every(Boolean)) {
                $('#addcoursemodal .overlay').show();
                var gradecategories = [];
                var gradecategorypoints = [];
                $('#addcoursemodal .category-input').each(function () {
                    gradecategories.push($(this).val());
                });
                $('#addcoursemodal .category-points-input').each(function () {
                    gradecategorypoints.push($(this).val());
                });
                $.post("../../actions/create/course.php",
                {
                    user_id: <?php echo $user->data()->id; ?>,
                    abbrev: $('#addcoursemodal #abbrev-input').val(),
                    num: $('#addcoursemodal #num-input').val(),
                    credits: $('#addcoursemodal #credits-input').val(),
                    name: $('#addcoursemodal #name-input').val(),
                    note: $('#addcoursemodal #note-input').val(),
                    pointsystem: $('#addcoursemodal input[name="pointsystem-input"]:checked').val(),
                    gradecategories: JSON.stringify(gradecategories),
                    gradecategorypoints: JSON.stringify(gradecategorypoints),
                    token: $('#addcoursemodal #token').val()
                },
                function (data, status) {
                    location.reload();
                });
            }
            return false;
        });
    </script>
    <script>
        function delete_grade(course_id, category_id, grade_id, tr) {
            var name = $(tr).find('.gName').text();
            var grade = $(tr).find('.gGrade').text().split('/');
            var earned = parseFloat(grade[0]);
            var total = parseFloat(grade[1]);
            var user_id = <?php echo $user->data()->id; ?>;
            var token = '<?php echo $token; ?>';
            $(tr).html('\
                <td colspan="2"><i class="fa fa-refresh fa-spin"></i></a></td>\
                <td class="gName">'+name+'</td>\
                <td class="gGrade" style="text-align: right;"><b>'+earned.toFixed(1)+'</b><small>/'+total.toFixed(1)+'</small></td>\
            ');
            $.post("../../actions/delete/grade.php",
            {
                id: grade_id,
                token: token
            },
            function (data, status) {
                if (data.length != 0) {
                    $(tr).html('\
                        <td><a href="#" style="color: #333;" onclick="edit_grade(\''+course_id+'\', \''+category_id+'\', \''+grade_id+'\', $(this).parent().parent()); return false;"><i class="fa fa-pencil"></i></a></td>\
                        <td><a href="#" style="color: #333;" onclick="delete_grade(\''+course_id+'\', \''+category_id+'\', \''+grade_id+'\', $(this).parent().parent()); return false;"><i class="fa fa-trash"></i></a></td>\
                        <td class="gName">'+name+'</td>\
                        <td class="gGrade" style="text-align: right;"><b>'+earned.toFixed(1)+'</b><small>/'+total.toFixed(1)+'</small></td>\
                    ');
                    $('#errormodal .modal-body').html(data);
                    $('#errormodal').modal('show');
                }
                else {
                    var gpa;
                    var course_grade;
                    var category_grade;
                    $.post("../../actions/get/category_grade.php",
                    {
                        user_id: user_id,
                        category_id: category_id,
                        token: token
                    },
                    function (data, status) {
                        category_grade = data.split('/');
                        $.post("../../actions/get/course_grade.php",
                        {
                            user_id: user_id,
                            course_id: course_id,
                            token: token
                        },
                        function (data, status) {
                            course_grade = data;
                            $.post("../../actions/get/gpa.php",
                            {
                                user_id: user_id,
                                token: token
                            },
                            function (data, status) {
                                gpa = data;

                                $(tr).remove();
                                
                                $('a[href=\'#collapse'+category_id+'\'] .pull-right').html('<b>'+category_grade[0]+'</b><small>/'+category_grade[1]+'</small>');
                                $('#'+course_id+'-select .cGrade').html(course_grade);
                                $('#gpa').html('GPA: '+gpa);
                            });
                        });
                    });
                }
            });
        }

        function finalize_grade(course_id, category_id, grade_id, tr) {
            $(tr).find('td[colspan="2"]').html('<i class="fa fa-refresh fa-spin"></i>');
            var name = $(tr).find('#gName').val();
            var earned = parseFloat($(tr).find('#gEarned').val());
            var total = parseFloat($(tr).find('#gTotal').val());
            var user_id = <?php echo $user->data()->id; ?>;
            var token = '<?php echo $token; ?>';
            $.post("../../actions/edit/grade.php",
            {
                id: grade_id,
                name: name,
                earned: earned,
                total: total,
                token: token
            },
            function (data, status) {
                if (data.length != 0) {
                    $(tr).find('td[colspan="2"]').html('<button class="btn btn-primary btn-xs" onclick="finalize_grade(\''+course_id+'\', \''+category_id+'\', \''+grade_id+'\', $(this).parent().parent());"><i class="fa fa-pencil"></i></button>');
                    $('#errormodal .modal-body').html(data);
                    $('#errormodal').modal('show');
                }
                else {
                    var gpa;
                    var course_grade;
                    var category_grade;
                    $.post("../../actions/get/category_grade.php",
                    {
                        user_id: user_id,
                        category_id: category_id,
                        token: token
                    },
                    function (data, status) {
                        category_grade = data.split('/');
                        $.post("../../actions/get/course_grade.php",
                        {
                            user_id: user_id,
                            course_id: course_id,
                            token: token
                        },
                        function (data, status) {
                            course_grade = data;
                            $.post("../../actions/get/gpa.php",
                            {
                                user_id: user_id,
                                token: token
                            },
                            function (data, status) {
                                gpa = data;
                                
                                $(tr).html('\
                                    <td><a href="#" style="color: #333;" onclick="edit_grade(\''+course_id+'\', \''+category_id+'\', \''+grade_id+'\', $(this).parent().parent()); return false;"><i class="fa fa-pencil"></i></a></td>\
                                    <td><a href="#" style="color: #333;" onclick="delete_grade(\''+course_id+'\', \''+category_id+'\', \''+grade_id+'\', $(this).parent().parent()); return false;"><i class="fa fa-trash"></i></a></td>\
                                    <td class="gName">'+name+'</td>\
                                    <td class="gGrade" style="text-align: right;"><b>'+earned.toFixed(1)+'</b><small>/'+total.toFixed(1)+'</small></td>\
                                ');
                                
                                $('a[href=\'#collapse'+category_id+'\'] .pull-right').html('<b>'+category_grade[0]+'</b><small>/'+category_grade[1]+'</small>');
                                $('#'+course_id+'-select .cGrade').html(course_grade);
                                $('#gpa').html('GPA: '+gpa);
                            });
                        });
                    });
                }
            });
        }

        function edit_grade(course_id, category_id, grade_id, tr) {
            var name = $(tr).find('.gName').text();
            var grade = $(tr).find('.gGrade').text().split('/');
            var earned = parseFloat(grade[0]);
            var total = parseFloat(grade[1]);
            $(tr).html('\
                <td colspan="2"><button class="btn btn-primary btn-xs" onclick="finalize_grade(\''+course_id+'\', \''+category_id+'\', \''+grade_id+'\', $(this).parent().parent());"><i class="fa fa-pencil"></i></button></td>\
                <td><input id="gName" type="text" style="width: 100%;" placeholder="Name" value="'+name+'" /></td>\
                <td style="text-align: right;"><input id="gEarned" type="number" placeholder="Score" style="width: 55px;" value="'+earned+'" />/<input id="gTotal" type="number" value="'+total+'" placeholder="Total" style="width: 55px;" /></td>\
            ');
        }

        function create_grade(course_id, category_id, tr) {
            $(tr).find('td[colspan="2"]').html('<i class="fa fa-refresh fa-spin"></i>');
            var name = $(tr).find('#gName').val();
            var earned = parseFloat($(tr).find('#gEarned').val());
            var total = parseFloat($(tr).find('#gTotal').val());
            var user_id = <?php echo $user->data()->id; ?>;
            var token = '<?php echo $token; ?>';
            $.post("../../actions/create/grade.php",
            {
                user_id: user_id,
                category_id: category_id,
                name: name,
                earned: earned,
                total: total,
                token: token
            },
            function (data, status) {
                if (data.length == 0) {
                    $(tr).find('td[colspan="2"]').html('<button class="btn btn-primary btn-xs" onclick="create_grade(\''+course_id+'\', \''+category_id+'\', $(this).parent().parent());"><i class="fa fa-plus"></i></button>');
                    $('#errormodal .modal-body').html('Could not create entry.');
                    $('#errormodal').modal('show');
                }
                else {
                    var gpa;
                    var course_grade;
                    var category_grade;
                    var grade_id = data;
                    $.post("../../actions/get/category_grade.php",
                    {
                        user_id: user_id,
                        category_id: category_id,
                        token: token
                    },
                    function (data, status) {
                        category_grade = data.split('/');
                        $.post("../../actions/get/course_grade.php",
                        {
                            user_id: user_id,
                            course_id: course_id,
                            token: token
                        },
                        function (data, status) {
                            course_grade = data;
                            $.post("../../actions/get/gpa.php",
                            {
                                user_id: user_id,
                                token: token
                            },
                            function (data, status) {
                                gpa = data;

                                $(tr).find('td[colspan="2"]').html('<button class="btn btn-primary btn-xs" onclick="create_grade(\''+course_id+'\', \''+category_id+'\', $(this).parent().parent());"><i class="fa fa-plus"></i></button>');
                                $(tr).before('<tr>\
                                    <td><a href="#" style="color: #333;" onclick="edit_grade(\''+course_id+'\', \''+category_id+'\', \''+grade_id+'\', $(this).parent().parent()); return false;"><i class="fa fa-pencil"></i></a></td>\
                                    <td><a href="#" style="color: #333;" onclick="delete_grade(\''+course_id+'\', \''+category_id+'\', \''+grade_id+'\', $(this).parent().parent()); return false;"><i class="fa fa-trash"></i></a></td>\
                                    <td class="gName">'+name+'</td>\
                                    <td class="gGrade" style="text-align: right;"><b>'+earned.toFixed(1)+'</b><small>/'+total.toFixed(1)+'</small></td>\
                                </tr>');
                                $(tr).find('#gName').val('');
                                $(tr).find('#gEarned').val('');
                                $(tr).find('#gTotal').val('100');
                                
                                $('a[href=\'#collapse'+category_id+'\'] .pull-right').html('<b>'+category_grade[0]+'</b><small>/'+category_grade[1]+'</small>');
                                $('#'+course_id+'-select .cGrade').html(course_grade);
                                $('#gpa').html('GPA: '+gpa);
                            });
                        });
                    });
                }
            });
        }

        function change_course(course) {
            <?php foreach($courses as $course) { ?>
            $('#<?php echo $course->id; ?>').hide();
            $('#<?php echo $course->id; ?>-select').css('font-weight', '');
            $('#<?php echo $course->id; ?>-select').css('background-color', '');
            <?php } ?>
            $('#' + course).show();
            $('#' + course +'-select').css('font-weight', 'bold');
            $('#' + course +'-select').css('background-color', '#f39c12');
        }

        $(function () {
            change_course('<?php echo $courses[0]->id; ?>');
            var tooltips = $( "[title]" ).tooltip();
            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
              checkboxClass: 'icheckbox_minimal-blue',
              radioClass: 'iradio_minimal-blue'
            });
        });
    </script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../../js/pages/dashboard.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="../../plugins/iCheck/icheck.min.js"></script>
  </body>
</html>
