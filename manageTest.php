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

  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addTest'])){
    $addTest = $admin->addTest($_POST);
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editTest'])){
    $editTest = $admin->editTest($_POST);
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['disTest'])){
    $editTest = $admin->DisableTest($_POST);
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['enaTest'])){
    $editTest = $admin->EnableTest($_POST);
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['freeTest'])){
    $editTest = $admin->FreeTest($_POST);
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['primeTest'])){
    $editTest = $admin->PrimeTest($_POST);
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
      if (isset($addTest)) {
        echo $addTest;
      }
      if (isset($editTest)) {
        echo $editTest;
      }
      if (isset($enaTest)) {
        echo $enaTest;
      }
      if (isset($disTest)) {
        echo $disTest;
      }
      if (isset($freeTest)) {
        echo $freeTest;
      }
      if (isset($primeTest)) {
        echo $primeTest;
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
        <li><a class="app-menu__item" href="manageTestCategory.php"><i class="app-menu__icon fa fa-pencil"></i><span class="app-menu__label">Manage Test Category</span></a></li>
        <li><a class="app-menu__item active" href="manageTest.php"><i class="app-menu__icon fa fa-pencil"></i><span class="app-menu__label">Manage Tests</span></a></li>
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
              <h3 class="title">All Tests</h3>
              <div class="btn-group"><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#addTest"><i class="fa fa-lg fa-plus"></i>Add New Test </a></div>
              <!-- Modal -->
              <div class="modal fade" id="addTest" role="dialog">
                <div class="modal-dialog" role="document">
                  <form class="login-form" action="" method="POST">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Add New Test</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label class="control-label">Test Name</label>
                          <input class="form-control" type="text" name="TestName" placeholder="e.g. LQ MOCK-1">
                        </div>
                        <div class="form-group">
                          <label class="control-label">Test Category</label>
                          <select class="form-control input-lg mb-md" name="TestCategory">
                            <option selected disabled hidden value>Select Test Category</option>
                            <?php
                              $testCatData = $admin->getAllTestCat();
                              if ($testCatData) {
                                while($result = $testCatData->fetch_assoc()){
                            ?>
                            <option value="<?php echo $result["Name"];?>"><?php echo $result["Name"];?></option>
                            <?php
                                }
                              }
                            ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label class="control-label">Test Duration</label>
                          <input class="form-control" type="text" name="TestDuration" placeholder="e.g. 3 (in hours)">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-primary" type="submit" name="addTest"><i class="fa fa-sign-in fa-lg fa-fw"></i>Add Test</button>
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
                    <th>Test Name</th>
                    <th>Category</th>
                    <th>Duration</th>
                    <th>Type</th>
                    <th>Created Date</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $testsData = $admin->getAllTests();
                  if ($testsData) {
                      while($result = $testsData->fetch_assoc()){
                        $data = explode("@", $result['Name']);
                ?>
                        <tr>
                          <td><a href="manageQuestion.php?TestNo=<?php echo $result['TestNo']; ?>"><?php echo $data[0]; ?></a></td>
                          <td><?php echo $data[1]; ?></td>
                          <td><?php echo $result['Duration']; ?> hrs</td>
                          <td>
                             <div class="btn-group">
                              <?php if($result['Type'] == '1') { ?>
                                <form class="test-form" action="" method="POST">
                                  <input class="form-control" type="text" name="TestNo" value="<?php echo $result['TestNo']; ?>" hidden >
                                  <button class="btn btn-primary" type="submit" name="freeTest">PREMIUM</button>
                                </form>
                              <?php } else { ?>
                                <form class="test-form" action="" method="POST">
                                  <input class="form-control" type="text" name="TestNo" value="<?php echo $result['TestNo']; ?>" hidden >
                                  <button class="btn btn-primary" type="submit" name="primeTest">FREE</button>
                                </form>
                              <?php }?>
                            </div>
                          </td>
                          <td><?php echo $result['Created']; ?></td>
                          <td>
                            <div class="btn-group">
                              <button class="btn btn-primary" href="#" data-toggle="modal" data-target="#editTest<?php echo $result['TestNo']; ?>"><i class="fa fa-lg fa-edit"></i></button>
                                <?php if($result['status'] == '1') { ?>
                                  <form class="test-form" action="" method="POST">
                                    <input class="form-control" type="text" name="TestNo" value="<?php echo $result['TestNo']; ?>" hidden >
                                    <button class="btn btn-primary" type="submit" name="disTest"><i class="fa fa-lg fa-check"></i></button>
                                  </form>
                                <?php } else { ?>
                                  <form class="test-form" action="" method="POST">
                                    <form class="test-form" action="" method="POST">
                                    <input class="form-control" type="text" name="TestNo" value="<?php echo $result['TestNo']; ?>" hidden >
                                    <button class="btn btn-primary" type="submit" name="enaTest"><i class="fa fa-lg fa-remove"></i></button>
                                  </form>
                                <?php }?>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="editTest<?php echo $result['TestNo']; ?>" role="dialog">
                              <div class="modal-dialog" role="document">
                                <form class="test-form" action="" method="POST">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Edit Test Details</h5>
                                      <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <label class="control-label">Test Name</label>
                                        <input class="form-control" type="text" name="TestName" value="<?php echo $data[0]; ?>" required>
                                        <input class="form-control" type="text" name="TestNo" value="<?php echo $result['TestNo']; ?>" hidden >
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label">Test Category</label>
                                        <select class="form-control input-lg mb-md" name="TestCategory">
                                          <?php
                                            $testCatData = $admin->getAllTestCat();
                                            if ($testCatData) {
                                              while($result1 = $testCatData->fetch_assoc()){
                                          ?>
                                          <option value="<?php echo $result1["Name"];?>" <?php if($result1["Name"] == $data[1]){ ?>selected <?php } ?>><?php echo $result1["Name"];?></option>
                                          <?php
                                              }
                                            }
                                          ?>
                                        </select>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label">Test Duration</label>
                                        <input class="form-control" type="text" name="TestDuration" value="<?php echo $result['Duration']; ?>" required>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button class="btn btn-primary" type="submit" name="editTest"><i class="fa fa-sign-in fa-lg fa-fw"></i>Update</button>
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
    <script type="text/javascript" src="js/plugins/sweetalert.min.js"></script>
    </script>
  </body>
</html>