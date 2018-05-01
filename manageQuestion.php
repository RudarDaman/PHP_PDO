<?php
  
  $filepath = realpath(dirname(__FILE__));
  include_once $filepath.'/lib/Session.php';
  Session::init();

  if (isset($_GET['action']) && $_GET['action'] == "logout") {
    Session::destroy();
    exit();
  }

  if(isset($_GET['TestNo'])){
    $TestNo = (int)$_GET['TestNo'];
  }

?>

<?php

  include 'lib/Admin.php';
  Session::checkAdminSession();
  $admin = new Admin();

  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addQue'])){
    $addQue = $admin->addQue($_POST);
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editQue'])){
    $editQue = $admin->editQue($_POST);
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delQue'])){
    $delQue = $admin->delQue($_POST);
  }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
  
    <title>Edit Questions - Learn Quest Academy</title>
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
      if (isset($addQue)) {
        echo $addQue;
      }
      if (isset($editQue)) {
        echo $editQue;
      }
      if (isset($delQue)) {
        echo $delQue;
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
          <h1><i class="fa fa-dashboard"></i> Admin - All Questions</h1>
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
              <h3 class="title">
                <?php $name = $admin->getTestName($TestNo);
                      echo $name[1]; 
                ?>
                / <?php echo $name[0]; ?>
              </h3>
              <div class="btn-group"><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#addQue"><i class="fa fa-lg fa-plus"></i>Add New Question</a></div>
              <!-- Modal -->
              <div class="modal fade" id="addQue" role="dialog">
                <div class="modal-dialog" role="document">
                  <form class="login-form" action="" method="POST">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Add New Question</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                      </div>
                        <input class="form-control" type="text" name="TestNo" value="<?php echo $TestNo; ?>" hidden>
                      <div class="modal-body">
                        <div class="form-group">
                          <label class="control-label">Question</label>
                          <input class="form-control" type="text" name="Question" placeholder="e.g. What is LQ?" required>
                        </div>
                        <div class="form-group">
                          <label class="control-label">Option A</label>
                          <input class="form-control" type="text" name="aAnswer" required>
                          <label class="control-label">Option B</label>
                          <input class="form-control" type="text" name="bAnswer" required>
                          <label class="control-label">Option C</label>
                          <input class="form-control" type="text" name="cAnswer" required>
                          <label class="control-label">Option D</label>
                          <input class="form-control" type="text" name="dAnswer" required>
                        </div>
                        <div class="form-group">
                          <label class="control-label">Correct Answer</label>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="radio" value="1" name="correctAnswer" required>A
                            </label>
                          </div>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="radio" value="2" name="correctAnswer">B
                            </label>
                          </div>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="radio" value="3" name="correctAnswer">C
                            </label>
                          </div>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="radio" value="4" name="correctAnswer">D
                            </label>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label">Que Category</label>
                          <select class="form-control input-lg mb-md" name="QueCategory" required>
                            <option selected disabled hidden value>Select Que Category</option>
                            <option value="Quants">Quants</option>
                            <option value="DI-LR">DI-LR</option>
                            <option value="VA-RC">VA-RC</option>
                          </select>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-primary" type="submit" name="addQue"><i class="fa fa-sign-in fa-lg fa-fw"></i>Add Question</button>
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
                    <th>S. No.</th>
                    <th>Question</th>
                    <th>Correct Answer</th>
                    <th>Type</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $testQues = $admin->getAllTestQues($TestNo);
                  if ($testQues) {
                      $count = 0;
                      while($result = $testQues->fetch_assoc()){
                        $count++;
                        $aAnswer = $result['aAnswer'];
                        $bAnswer = $result['bAnswer'];
                        $cAnswer = $result['cAnswer'];
                        $dAnswer = $result['dAnswer'];
                        $answers = array($aAnswer,$bAnswer,$cAnswer,$dAnswer);
                ?>
                        <tr>
                          <td><?php echo $count; ?></td>
                          <td><?php echo $result['que']; ?></td>
                          <td><?php echo $result['correct']; ?></td>
                          <td><?php echo $result['Type']; ?></td>
                          <td>
                            <div class="btn-group">
                              <button class="btn btn-primary" href="#" data-toggle="modal" data-target="#editQue<?php echo $TestNo."-".$result['queNo']; ?>"><i class="fa fa-lg fa-edit"></i></button>
                                <form class="test-form" action="" method="POST">
                                  <input class="form-control" type="text" name="TestNo" value="<?php echo $TestNo; ?>" hidden >
                                  <input class="form-control" type="text" name="queNo" value="<?php echo $result['queNo']; ?>" hidden >
                                  <button class="btn btn-primary" type="submit" name="delQue"><i class="fa fa-lg fa-trash"></i></button>
                                </form>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="editQue<?php echo $TestNo."-".$result['queNo']; ?>" role="dialog">
                              <div class="modal-dialog" role="document">
                                <form class="test-form" action="" method="POST">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Edit Question Details</h5>
                                      <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <label class="control-label">Question Name</label>
                                        <input class="form-control" type="text" name="Question" value="<?php echo $result['que']; ?>" required>
                                        <input class="form-control" type="text" name="TestNo" value="<?php echo $TestNo; ?>" hidden >
                                        <input class="form-control" type="text" name="queNo" value="<?php echo $result['queNo']; ?>" hidden >
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label">Option A</label>
                                        <input class="form-control" type="text" name="aAnswer" value="<?php echo $result['aAnswer']; ?>" required>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label">Option B</label>
                                        <input class="form-control" type="text" name="bAnswer" value="<?php echo $result['bAnswer']; ?>" required>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label">Option C</label>
                                        <input class="form-control" type="text" name="cAnswer" value="<?php echo $result['cAnswer']; ?>" required>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label">Option D</label>
                                        <input class="form-control" type="text" name="dAnswer" value="<?php echo $result['dAnswer']; ?>" required>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label">Correct Answer</label>
                                        <div class="form-check">
                                          <label class="form-check-label">
                                            <input class="form-check-input" type="radio" value="1" name="correctAnswer" <?php if($result['correct'] == $answers[0]){ ?>checked<?php } ?>>A
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <label class="form-check-label">
                                            <input class="form-check-input" type="radio" value="2" name="correctAnswer" <?php if($result['correct'] == $answers[1]){ ?>checked<?php } ?>>B
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <label class="form-check-label">
                                            <input class="form-check-input" type="radio" value="3" name="correctAnswer" <?php if($result['correct'] == $answers[2]){ ?>checked<?php } ?>>C
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <label class="form-check-label">
                                            <input class="form-check-input" type="radio" value="4" name="correctAnswer" <?php if($result['correct'] == $answers[3]){ ?>checked<?php } ?>>D
                                          </label>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label">Que Category</label>
                                        <select class="form-control input-lg mb-md" name="QueCategory">
                                          <option value="Quants" <?php if($result['Type'] == "Quants"){ ?>selected<?php } ?>>Quants</option>
                                          <option value="DI-LR" <?php if($result['Type'] == "DI-LR"){ ?>selected<?php } ?>>DI-LR</option>
                                          <option value="VA-RC" <?php if($result['Type'] == "VA-RC"){ ?>selected<?php } ?>>VA-RC</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button class="btn btn-primary" type="submit" name="editQue"><i class="fa fa-sign-in fa-lg fa-fw"></i>Update</button>
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