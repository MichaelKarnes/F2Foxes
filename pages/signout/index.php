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

    // generate token to submit with all forms. form php files in ../actions/create/blahblah.php
    $token = Token::generate();

    $error = Session::flash("error");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>F-2 Foxes | Sign Out</title>
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
                  <span class="hidden-xs"><?php echo escape($user->data()->first." ".$user->data()->last); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../../images/rank-ssg.jpg" class="img-circle" alt="User Image">
                    <p>
                      <?php echo escape($user->data()->first." ".$user->data()->last); ?> - Web Developer
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
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Admin</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="../../pages/users"><i class="fa fa-circle-o"></i> Users</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Groups</a></li>
              </ul>
            </li>
            <li>
              <a href="../../pages/mailbox/mailbox">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>
            <li>
              <a href="../..pages/training">
                <i class="fa fa-calendar"></i> <span>Training Schedule</span>
              </a>
            </li>
            <li>
              <a href="../../pages/grades">
                <i class="fa fa-graduation-cap"></i> <span>My Grades</span>
              </a>
            </li>
            <li class="active">
              <a href="../../pages/signout">
                <i class="fa fa-sign-out"></i> <span>Sign Out Sheet</span>
              </a>
            </li>
            <li>
              <a href="../../pages/pt">
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
            Sign Out Sheet
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Sign Out Sheet</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Alert -->
          <!--
          This feature is to be implemented at a later time
          <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="icon fa fa-ban"></i> Danger alert preview. This alert is dismissable.
                </div>
            </div>
          </div> -->



          <!-- Singout Sheet
          The first block of code is to input new signouts into the database -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><i class="icon fa fa-arrow-right"></i>
                     New Sign Out for the Week Of: &nbsp
                     <?php
                        $d1 = strtotime("this week");
                        echo date("d M  Y", $d1);
                     ?>
                  </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding" style="min-height: 100px;">
                <!-- main code goes here -->

                <form action = "../../actions/create/signout.php" method = "post">
                <table class = "table">

                  <!-- Table Header -->
                  <tr>
                    <!-- the database contains the current weekly training times in the train_times table -->
                    <?php
                      // draw in training times for the current semester, the admin can change
                      // these training times to add special events or account for corps changes
                      $train = $db->get('train_times', array('1','=','1'))->results();

                      foreach($train as $i) {
                        $myString = $i->times;
                        // in the database, the training times are stored as comma seperated values
                        // the explode function converts csv to a normal php array
                        $timeArray = explode(',',$myString);
                      }

                      foreach($timeArray as $i) {
                        echo "<td><b>" . $i . "</b></td>";
                      }
                    ?>
                  </tr>
                  <tr>
                  <!-- we now need to create a table of checkboxes based on the number of users -->
                  <?php
                    // determine the amount of boxes we will need per row based off the number of weekly training times
                    $j = 0;
                    while ($j < count($timeArray)) {
                      // the numBoxes string adds a string of html checkboxes
                      echo "<td>" . '<input type="checkbox" name="' . $j . '">' . "</td>";
                      $j++;
                    }
                  ?>
                  </tr>
                </table>
                <b> &nbsp Select Reason for Sign Out </b> <br>
                &nbsp <select name="reason">
                  <option value="Work"> Work </option>
                  <option value="Class"> Class </option>
                  <option value="Lab"> Lab </option>
                  <option value="Tutoring"> Tutoring </option>
                  <option value="Student Org"> Student Org </option>
                  <option value="Army"> Army </option>
                  <option value="Rudders"> Rudders </option>
                  <option value="Ranger Challenge"> Ranger Challenge </option>
                  <option value="Fish Drill Team"> Fish Drill Team </option>
                  <option value="Ross Volunteers"> Ross Volunteers </option>
                  <option value="Recon CO"> Recon CO </option>
                  <option value="Seal PLT"> Seal PLT </option>
                  <option value="Corps Athletics"> Corps Athletics </option>
                  <option value="Intramurals"> Intramurals </option>
                  <option value="Other"> Other </option>
                  <option values="none"> None </option>
                </select>
                <input type="hidden" name="token" value="<?php echo $token; ?>" >
                <input type="hidden" name="numboxes" value="<?php echo count($timeArray); ?>" >
                <input type="submit"> <br> <br>
                </form>

                <p> &nbsp <b>Current Sign Out</b></p>
                <table class="table">
                  <tr>
                    <?php
                      foreach($train as $i) {
                        $myString = $i->times;
                        // in the database, the training times are stored as comma seperated values
                        // the explode function converts csv to a normal php array
                        $timeArray = explode(',',$myString);
                      }

                      foreach($timeArray as $i) {
                        echo "<td><b>" . $i . "</b></td>";
                      }

                      ?>
                  </tr>

                      <tr>
                        <?php
                        // retreive signout CSV for the current week
                        $signOuts = $db->get('signout', array('user_id','=', $user->data()->id))->results();

                        // we explode the string into a php array to display in the next table row
                        foreach($signOuts as $i) {
                          $myString = $i->current_week;
                          // in the database, the training times are stored as comma seperated values
                          // the explode function converts csv to a normal php array
                          $try = explode(',',$myString);
                        }

                        $j = 0;
                        while ($j < count($timeArray)) {
                          // the numBoxes string adds a string of html checkboxes
                          echo "<td>" . $try[$j] . "</td>";
                          $j++;
                        }
                        ?>
                      </tr>
                </table>





                </div>
              </div>
              <!-- /.nav-tabs-custom -->
            </div>






            <!-- this block of code shows the current outfit signouts -->
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><i class="icon fa fa-arrow-right"></i>  Sign Out</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding" style="min-height: 600px;">
                <!-- main code goes here -->

                <form action = "../../actions/create/signout.php" method = "post">
                <table class = "table">


                  <!-- Table Header -->
                  <tr>
                    <td><b>Name</b></td>
                    <!-- the database contains the current weekly training times in the train_times table -->
                    <?php
                      // draw in training times for the current semester, the admin can change
                      // these training times to add special events or account for corps changes
                      $train = $db->get('train_times', array('1','=','1'))->results();

                      foreach($train as $i) {
                        $myString = $i->times;
                        // in the database, the training times are stored as comma seperated values
                        // the explode function converts csv to a normal php array
                        $timeArray = explode(',',$myString);
                      }

                      foreach($timeArray as $i) {
                        echo "<td><b>" . $i . "</b></td>";
                      }
                    ?>
                  </tr>


                  <!-- we now need to create a table of checkboxes based on the number of users -->
                  <?php
                    $tableCreate = $db->get('users', array('1','=','1'))->results();

                    // determine the amount of boxes we will need per row based off the number of weekly training times
                    $j = 0;
                    while ($j < count($timeArray)) {
                      // the numBoxes string adds a string of html checkboxes
                      $add = "<td>" . '<input type="checkbox" name="hi">' . "</td>";
                      $numBoxes = $numBoxes . $add;
                      $j++;
                    }

                    // this code fills the html table with names and the corresponding checkboxes
                    foreach($tableCreate as $i) {
                      $name = $i->last . ", " . $i->first;
                      echo "<tr><td>" . $name . "</td>" . $numBoxes . "</tr>";
                    }
                  ?>

                </table>

                <input type="hidden" name="token" value="<?php echo $token; ?>" >
                <input type="submit">
                </form>




                </div>
              </div>
              <!-- /.nav-tabs-custom -->
            </div>

          </div>
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

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../../js/pages/dashboard.js"></script>
  </body>
</html>
