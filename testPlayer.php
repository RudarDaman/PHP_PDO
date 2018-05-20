<?php
  
  $filepath = realpath(dirname(__FILE__));
  include_once $filepath.'/lib/Session.php';
  Session::init();

  if (isset($_GET['action']) && $_GET['action'] == "logout") {
    Session::destroy();
    exit();
  }

  if(isset($_GET['no'])){
    $TestNo = $_GET['no'];

  }
  else{
    header('Location: testSeries.php');
  }


?>

<?php

  include 'lib/User.php';
  Session::checkSession();
  $user = new User();

  $user->prepareQue($TestNo);

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
    <link rel="stylesheet" type="text/css" href="js/plugins/pagination.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="js/plugins/sweetalert.min.js"></script>
<!--     <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.5/angular.js"></script>
 -->    <script src="js/jquery-3.2.1.min.js"></script>
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
    </aside>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Choose Test</h1>
          <p>Welcome to Learn Quest Academy</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>

      <div class="data-container"></div>
      <div id="pagination-demo1"></div>
      
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js?=1400"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <script src="js/plugins/pagination.js"></script>
    <script type="text/javascript">
      window.onload = maxWindow;

      function maxWindow() {
          window.moveTo(0, 0);


          if (document.all) {
              top.window.resizeTo(screen.availWidth, screen.availHeight);
          }

          else if (document.layers || document.getElementById) {
              if (top.window.outerHeight < screen.availHeight || top.window.outerWidth < screen.availWidth) {
                  top.window.outerHeight = screen.availHeight;
                  top.window.outerWidth = screen.availWidth;
              }
          }
      }
      </script>


    </script> 
  </body>
</html>