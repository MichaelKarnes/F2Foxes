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

    //generate token to submit with all forms. form php files in ../actions/create/blahblah.php
    $token = Token::generate();

    $error = Session::flash("error");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>F-2 Foxes | PT Scores</title>
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
            <form class="navbar-form navbar-left" role="search" action="../../actions/logout.php">
              <button type="submit" class="btn btn-default">Log Out</button>
            </form>
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
              <a href="../../pages/training">
                <i class="fa fa-calendar"></i> <span>Training Schedule</span>
              </a>
            </li>
            <li>
              <a href="../../pages/grades">
                <i class="fa fa-graduation-cap"></i> <span>Grades</span>
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
            <li class="active">
              <a href="../../pages/pt">
                <i class="fa fa-line-chart"></i> <span>PT Scores</span>
              </a>
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
             PT Scores
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../../"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> PT Scores</li>
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
          <!-- PT Scores stuff -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><i class="icon fa fa-bookmark"></i>  History</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding" style="min-height: 200px;">
                  <table class="table">
                  <tr>
                  <td><b>Date</b></td> <td><b>Type</b></td> <td><b>Push Ups</b></td> <td><b>Push Up Score</b></td>
                  <td><b>Sit Ups</b></td> <td><b>Sit Up Score</b></td>
                  <td><b>Run Time</b></td> <td><b>Run Score</b></td> <td><b>Total Score</b></td>
                  <td><b>Pass/Fail</b></td> <td><b>Delete</b></td>
                  </tr>


                  <?php
                      $scores = $db->get('pt', array('user_id', '=', $user->data()->id));
                      if (!$scores->count()) {
                          echo "<tr>" . "<td>" . "No Scores To Date" . "</td>" . "</tr>";
                      } else {
                        foreach ($scores->results() as $scores) {
                            echo "<tr>" .
                            "<td>" . $scores->date . "</td>" .
				            "<td>" . $scores->type . "</td>" .
                            "<td>" . $scores->push_ups_raw . "</td>" .
                            "<td>" . $scores->push_ups_score . "</td>" .
                            "<td>" . $scores->sit_ups_raw . "</td>" .
                            "<td>" . $scores->sit_ups_score . "</td>" .
                            "<td>" . $scores->run_time . "</td>" .
                            "<td>" . $scores->run_score . "</td>" .
                            "<td>" . $scores->total_score . "</td>" .
                            "<td>" . $scores->pass . "</td>" .

                            "<td>" .
                            '<form action = "../../actions/delete/pt_score.php" method = "POST">' .
                            '<input type = "submit" value = "X" class = "tableSub"
                            name = "delete[' . $scores->id . ']" />' .

                            // the token is required in order to run /delete/pt_score/php second if stmt
                            '<input type="hidden" name="token" value= "' . $token . '" >' .
                            '</form>' .
                            "</td>" .
                            "</tr>";

                        }
                      }
                  ?>
                  </table>
                </div>
              </div>
              <!-- /.nav-tabs-custom -->
            </div>


            <!-- The code block below is for the form to add a new pt score -->
            <div class="col-xs-5">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> <i class="icon fa fa-plus"></i> New PT Score</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="min-height: 200px;">

                <p>Please fill out the form below to add a PT Score. Your score will be
                calculated from raw scores (ex. You did 80 push ups, enter 80).</p>


                <form action="../../actions/create/pt_score.php" method="POST">
                <label>Type: &nbsp </label>
                <input type="radio" name="type" value="Army" checked>Army &nbsp
                <input type="radio" name="type" value="Corps">Corps <br>

                <label>Select Date: &nbsp </label>
                <input type="date" id="formIn" name="date" maxlength="15"/> <br>

                <label>Raw Push Ups (ex. 80): &nbsp </label>
                <input type="text" id="formIn" name="pushUpsRaw" maxlength="3"/> <br>

                <label>Raw Sit Ups (ex. 90): &nbsp </label>
                <input type="text" id="formIn" name="sitUpsRaw" maxlength="3"/> <br>

                <label>Run Time (ex. 12:30): &nbsp </label>
                <input type="text" id="formIn" name="runRaw" maxlength="10"/> <br>

                <label>Gender: &nbsp </label>
                <input type="radio" name="gender" value="male" checked>Male &nbsp
                <input type="radio" name="gender" value="female">Female <br>

                <input type="hidden" name="token" value= "<?php echo $token; ?>" >

                <input type="submit"> <br></br>
                </form>
                </div>
              </div>
            </div>


            <!-- This code block shows the top pt scores -->
              <div class="col-xs-7">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> <i class="icon fa fa-trophy"></i> Top Scores </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="min-height: 280px;">

                <table class="table">
                <tr>
                <td><b>Last</b></td> <td><b>First</b></td> <td><b>Date</b></td>
                <td><b>Type</b></td> <td><b>Total Score</b></td>
                </tr>

                <?php
                   $top = $db->get('pt', array('1', '=', '1'))->results();
                   $ids = array('','','','','','','');
                   $max = array('','','','','','','');
                   $lastTop = array('','','','','','','');
                   $firstTop = array('','','','','','','');
                   $dateTop = array('','','','','','','');
                   $typeTop = array('','','','','','','');
                   $numScores = 0;

                   // find the top 6 scores
                   while ($numScores < 6) {
                      foreach($top as $i) {
                        // ensure the score hasn't been included multiple times by checking the id
                        if ($i->total_score >= $max[$numScores] && in_array($i->id, $ids) == 0) {
                          $max[$numScores] = $i->total_score;
                          $ids[$numScores] = $i->id;
                          $lastTop[$numScores] = $i->last;
                          $firstTop[$numScores] = $i->first;
                          $dateTop[$numScores] = $i->date;
                          $typeTop[$numScores] = $i->type;
                        }
                      }
                      $numScores++;
                   }


                   // input top scores into the html table
                   $numScores = 0;
                   while ($numScores < 6) {
                      echo "<tr>" .
                            "<td>" . $lastTop[$numScores] . "</td>" .
				            "<td>" . $firstTop[$numScores] . "</td>" .
                            "<td>" . $dateTop[$numScores] . "</td>" .
                            "<td>" . $typeTop[$numScores] . "</td>" .
                            "<td>" . $max[$numScores] . "</td>" .
                            "<tr>";

                      $numScores++;
                   }
                ?>

                </table>
                </div>
              </div>
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
