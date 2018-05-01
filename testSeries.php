<?php
  
  $filepath = realpath(dirname(__FILE__));
  include_once $filepath.'/lib/Session.php';
  Session::init();

  if (isset($_GET['action']) && $_GET['action'] == "logout") {
    Session::destroy();
    exit();
  }

?>

<?php

  include 'lib/User.php';
  Session::checkSession();
  $user = new User();

?>


<!DOCTYPE html>
<html lang="en">
  <head>
  
    <title>Mock Portal - Learn Quest Academy</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="js/plugins/sweetalert.min.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <?php
      $loginmsg = Session::get("loginmsg");
      if (isset($loginmsg)) {
        echo $loginmsg;
      }
      Session::set("loginmsg", NULL);
    ?>
  </head>
  <body class="app sidebar-mini rtl">
    
    <header class="app-header"><a class="app-header__logo" href="index.html">Learn Quest</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        
        <!-- User Menu-->
        <li class="dropdown">
          <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
            <span class="fa-stack">
              <i class="fa fa-circle-thin fa-stack-2x"></i>
              <i class="fa fa-user fa-stack-1x"></i>
            </span>
          </a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
<!--             <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
 -->            <li><a class="dropdown-item" href="profile.php"><i class="fa fa-user fa-lg"></i> Profile</a></li>
            <li><a class="dropdown-item" href="index.php?action=logout"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
        <div>
          <p class="app-sidebar__user-name">
            <?php
              $name = Session::get("name");
              if (isset($name)) {
                echo $name;
              }
            ?>
          </p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item active" href="index.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-shopping-cart"></i><span class="app-menu__label">Purchase</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="bootstrap-components.html">CAT 2018-19</a></li>
            <li><a class="treeview-item" href="bootstrap-components.html">BANK 2018-19</a></li>
            <li><a class="treeview-item" href="bootstrap-components.html">XAT 2018-19</a></li>
            <li><a class="treeview-item" href="bootstrap-components.html">MBA 2018-19</a></li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Courseware</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="testSeries.php">Test Series</a></li>
            <li><a class="treeview-item" href="#">Test reports</a></li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-envelope-open-o"></i><span class="app-menu__label">Free Resources</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="#">Exam Info</a></li>
            <li><a class="treeview-item" href="#">Exam Calendar</a></li>
            <li><a class="treeview-item" href="#">Current Affairs</a></li>
            <li><a class="treeview-item" href="#">B School Rankings</a></li>
            <li><a class="treeview-item" href="#">B School Merit</a></li>
          </ul>
        </li>
      </ul>
    </aside>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Choose Category</h1>
          <p>Welcome to Learn Quest Academy</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">
        <?php
          $testSeries = $user->getAllTestSeries();
          if ($testSeries) {
              while($result = $testSeries->fetch_assoc()){
        ?>
        <div class="col-md-4 col-lg-4">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-lightbulb-o fa-3x"></i>
            <div class="info">
              <h4><a href="tests.php?name=<?php echo $result['Name']; ?>"><?php echo $result['Name']; ?></a></h4>
              <p>No. of Tests: <b><?php echo $user->getTestCount($result['Name'])->fetch_assoc()['count']; ?></b></p>
            </div>
          </div>
        </div>
        <?php
            }
          }
        ?>
      </div>
      
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
  </body>
</html>testSeries