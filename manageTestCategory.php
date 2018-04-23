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

  include 'lib/Admin.php';
  Session::checkAdminSession();
  $admin = new Admin();

  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addCategory'])){
    $addCategory = $admin->addCategory($_POST);
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editCategory'])){
    $editCategory = $admin->editCategory($_POST);
  }

  if(isset($_GET['disCat'])){
    $disId = (int)$_GET['disCat'];
    $disCat = $admin->DisableCategory($disId);
  }

  if(isset($_GET['enaCat'])){
    $enaId = (int)$_GET['enaCat'];
    $enaCat = $admin->EnableCategory($enaId);
  }



?>


<!DOCTYPE html>
<html lang="en">
  <head>
  
    <title>Edit Test - Learn Quest Academy</title>
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
      if (isset($addCategory)) {
        echo $addCategory;
      }
      if (isset($editCategory)) {
        echo $editCategory;
      }
      if (isset($enaCat)) {
        echo $enaCat;
      }
      if (isset($disCat)) {
        echo $disCat;
      }
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
            <li><a class="dropdown-item" href="admin.php?action=logout"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
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
        <li><a class="app-menu__item" href="admin.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li><a class="app-menu__item" href="manageUser.php"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Manage Users</span></a></li>
        <li><a class="app-menu__item active" href="manageTestCategory.php"><i class="app-menu__icon fa fa-pencil"></i><span class="app-menu__label">Manage Test Category</span></a></li>
        <li><a class="app-menu__item" href="manageTest.php"><i class="app-menu__icon fa fa-pencil"></i><span class="app-menu__label">Manage Tests</span></a></li>
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
            <li><a class="treeview-item" href="#">Sample Test</a></li>
            <li><a class="treeview-item" href="#">Doubts</a></li>
            <li><a class="treeview-item" href="#">Test Series</a></li>
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
          <h1><i class="fa fa-dashboard"></i> Admin - All Tests</h1>
          <p>Welcome to Learn Quest Academy</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-title-w-btn">
              <h3 class="title">All Test Categories</h3>
              <div class="btn-group"><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#addCategory"><i class="fa fa-lg fa-plus"></i>Add New Category </a></div>
              <!-- Modal -->
              <div class="modal fade" id="addCategory" role="dialog">
                <div class="modal-dialog" role="document">
                  <form class="login-form" action="" method="POST">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Add New Test Category</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label class="control-label">Category Name</label>
                          <input class="form-control" type="text" name="CategoryName" placeholder="e.g. CAT 2017-18">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-primary" type="submit" name="addCategory"><i class="fa fa-sign-in fa-lg fa-fw"></i>Add Category</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- End Modal -->
            </div>
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Category Name</th>
                    <th>Created Date</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $testCatData = $admin->getAllTestCat();
                  if ($testCatData) {
                      while($result = $testCatData->fetch_assoc()){
                ?>
                        <tr>
                          <td><?php echo $result['Name']; ?></td>
                          <td><?php echo $result['Timestamp']; ?></td>
                          <td>
                            <div class="btn-group">
                              <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#editCategory<?php echo $result['Id']; ?>"><i class="fa fa-lg fa-edit"></i></a>
                              <?php if($result['status'] == '1') { ?>
                                <a class="btn btn-primary" href="?disCat=<?php echo $result['Id']; ?>" ><i class="fa fa-lg fa-remove"></i></a>
                              <?php } else { ?>
                                <a class="btn btn-primary" href="?enaCat=<?php echo $result['Id']; ?>" ><i class="fa fa-lg fa-check"></i></a>
                              <?php }?>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="editCategory<?php echo $result['Id']; ?>" role="dialog">
                              <div class="modal-dialog" role="document">
                                <form class="login-form" action="" method="POST">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Edit Test Category</h5>
                                      <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <label class="control-label">Category Name</label>
                                        <input class="form-control" type="text" name="CategoryName" value="<?php echo $result['Name']; ?>" required>
                                        <input class="form-control" type="text" name="Id" value="<?php echo $result['Id']; ?>" hidden >
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button class="btn btn-primary" type="submit" name="editCategory"><i class="fa fa-sign-in fa-lg fa-fw"></i>Update</button>
                                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                            <!-- End Modal -->
                          </td>
                        </tr>
                <?php
                      }
                  }
                ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Data table plugin-->
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="js/plugins/chart.js"></script>
    <script type="text/javascript" src="js/plugins/sweetalert.min.js"></script>
    <script type="text/javascript">
      var data = {
      	labels: ["January", "February", "March", "April", "May"],
      	datasets: [
      		{
      			label: "My First dataset",
      			fillColor: "rgba(220,220,220,0.2)",
      			strokeColor: "rgba(220,220,220,1)",
      			pointColor: "rgba(220,220,220,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(220,220,220,1)",
      			data: [65, 59, 80, 81, 56]
      		},
      		{
      			label: "My Second dataset",
      			fillColor: "rgba(151,187,205,0.2)",
      			strokeColor: "rgba(151,187,205,1)",
      			pointColor: "rgba(151,187,205,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(151,187,205,1)",
      			data: [28, 48, 40, 19, 86]
      		}
      	]
      };
      var pdata = [
      	{
      		value: 300,
      		color: "#46BFBD",
      		highlight: "#5AD3D1",
      		label: "Complete"
      	},
      	{
      		value: 50,
      		color:"#F7464A",
      		highlight: "#FF5A5E",
      		label: "In-Progress"
      	}
      ]
      
      var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      var lineChart = new Chart(ctxl).Line(data);
      
      var ctxp = $("#pieChartDemo").get(0).getContext("2d");
      var pieChart = new Chart(ctxp).Pie(pdata);
    </script>
  </body>
</html>