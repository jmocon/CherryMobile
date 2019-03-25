<?php
require_once "App_Code/Database.php";
require_once "App_Code/Functions.php";
require_once "App_Code/User.php";
require_once "App_Code/Device.php";
require_once "App_Code/TestType.php";
require_once "App_Code/TestResult.php";

$msg = "";
$err = "";
$lstReport = [];
if (!empty($_POST['Submit'])) {
  $lstReport = $clsTestResult->GetByUser_IdTestType_Id($_POST['User_Id'],$_POST['TestType_Id']);
}



?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>View Test Results - CherryMobile PDD</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php require_once("sidebar.php"); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php require_once("topbar.php"); ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Search Test Result</h1>
          </div>

          <!-- Content Row -->

          <div class="card shadow h-100 py-2">
            <div class="card-body">
              <form method="POST">
                <?php echo $msg; ?>
                <div class="row mb-4">
                  <div class="col-4 mb-2">
                    <label>User</label>
                    <select name="User_Id" class="form-control">
                      <?php
                      $lstUser = $clsUser->Get();
                      foreach ($lstUser as $mdlUser) {
                        if ($_POST['User_Id'] == $mdlUser->getId()) {
                          echo "<option value=".$mdlUser->getId()." selected>".$clsUser->ToName($mdlUser)."</option>";
                        } else {
                          echo "<option value=".$mdlUser->getId().">".$clsUser->ToName($mdlUser)."</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-4 mb-2">
                    <label>Test Type</label>
                    <select name="TestType_Id" class="form-control">
                      <?php
                      $lstTestType = $clsTestType->Get();
                      foreach ($lstTestType as $mdlTestType) {
                        if ($_POST['TestType_Id'] == $mdlTestType->getId()) {
                          echo "<option value=".$mdlTestType->getId()." selected>".$mdlTestType->getName()."</option>";
                        } else {
                          echo "<option value=".$mdlTestType->getId().">".$mdlTestType->getName()."</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-4 mb-2">
                    <label>Month</label>
                    <select class="form-control" name="Month">
                      <?php
                      for ($i=0; $i < 13; $i++) {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="row">
                  <div class="col-2 offset-5">
                    <input type="submit" name="Submit" class="btn btn-primary w-100" value="Search" />
                  </div>
                </div>
              </form>
            </div>
          </div>

          <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Model</h6>
            </div>
            <div class="card-body">
              <div class="row mb-4">
                <div class="col">
                  <table class="table table-bordered" id="dataTable">
                    <thead>
                      <tr>
                        <th>User</th>
                        <th>Device</th>
                        <th>TestType</th>
                        <th>Test Number</th>
                        <th>Date</th>
                        <th>Hours</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>User</th>
                        <th>Device</th>
                        <th>TestType</th>
                        <th>Test Number</th>
                        <th>Date</th>
                        <th>Hours</th>
                        <th>Actions</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php
                      $totalHours = 0;
                      $totalTask = 0;
                      $maxHours = 0;
                      foreach ($lstReport as $mdlTestResult) {
                        $maxHours = $clsTestType->GetMaxHoursById($mdlTestResult->getTestType_Id());
                        $totalHours += $mdlTestResult->getHours();
                        $totalTask++;
                        ?>
                        <tr>
                          <td><?php echo $clsUser->ToName($clsUser->GetById($mdlTestResult->getUser_Id())); ?></td>
                          <td><?php echo $clsDevice->GetNameById($mdlTestResult->getDevice_Id()); ?></td>
                          <td><?php echo $clsTestType->GetNameById($mdlTestResult->getTestType_Id()); ?></td>
                          <td><?php echo $mdlTestResult->getTestNumber(); ?></td>
                          <td><?php echo $mdlTestResult->getDate(); ?></td>
                          <th><?php echo $mdlTestResult->getHours(); ?></th>
                          <td>
                            <?php
                            if ($mdlTestResult->getHours() <= $maxHours) {
                              echo '<div class="text-success">PASSED</div>';
                            } else {
                              echo '<div class="text-danger">FAILED</div>';
                            }
                            ?>
                          </td>
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col-2">
                  Average:
                </div>
                <div class="col-10">
                  <?php
                  if ($maxHours) {
                    echo ($totalHours/$totalTask) . ' / ' . $maxHours;
                  }
                  ?>
                </div>
              </div>
              <div class="row">
                <div class="col-2">
                  Status:
                </div>
                <div class="col-10">
                  <?php
                  if ($totalTask) {
                    if (($totalHours/$totalTask) <= $maxHours) {
                      echo '<div class="text-success">PASSED</div>';
                    } else {
                      echo '<div class="text-danger">FAILED</div>';
                    }
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php require_once "footer.php"; ?>
      <!-- End of Footer -->

  		<!-- Modal -->
      <div class="modal" id="ModalWrapper">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Modal Heading</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              Modal body..
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
      </div>
  		<!-- End Modal -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <?php require_once "logoutmodal.php"; ?>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
