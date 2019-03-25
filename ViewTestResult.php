<?php
require_once "App_Code/Database.php";
require_once "App_Code/Functions.php";
require_once "App_Code/User.php";
require_once "App_Code/Device.php";
require_once "App_Code/TestType.php";
require_once "App_Code/TestResult.php";

$msg = "";
$err = "";

if (!empty($_POST['Submit'])) {

  $err .= $clsFn->setForm('User_Id',$mdlTestResult,true);
  $err .= $clsFn->setForm('TestType_Id',$mdlTestResult,true);
  $err .= $clsFn->setForm('TestNumber',$mdlTestResult,true);
  $err .= $clsFn->setForm('Date',$mdlTestResult,true);
  $err .= $clsFn->setForm('Device_Id',$mdlTestResult,true);
  $err .= $clsFn->setForm('Hours',$mdlTestResult,true);

  if($err == ""){
		$duplicate = $clsTestResult->IsExist($mdlTestResult);
		if($duplicate['val']){
			$msg .= '
			<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
			<span class="sr-only">Close</span>
			</button>
			<h4>Duplicate of Information Detected. </h4>
			'.$duplicate['msg'].'
			</div>';
		}else{
			$id = $clsTestResult->Add($mdlTestResult);
			$msg .= '
				<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
				<span class="sr-only">Close</span>
				</button>
				<h4>
					Successfully Added New TestResult.
				</h4>
				</div>
			';
			// Clear all data if success
			$mdlTestResult = new TestResultModel();
		}
	}else{
		$msg .= '
		<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
		<span class="sr-only">Close</span>
		</button>
		<h4>Please Complete All Required Fields. </h4>
		'.$err.'
		</div>';
	}
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
            <h1 class="h3 mb-0 text-gray-800">Add Test Result</h1>
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
                        if ($mdlTestResult->getUser_Id() == $mdlUser->getId()) {
                          echo "<option value=".$mdlUser->getId()." selected>".$clsUser->ToName($mdlUser)."</option>";
                        } else {
                          echo "<option value=".$mdlUser->getId().">".$clsUser->ToName($mdlUser)."</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                    <div class="col-4 mb-2">
                      <label>Device</label>
                      <select name="Device_Id" class="form-control">
                        <?php
                        $lstDevice = $clsDevice->Get();
                        foreach ($lstDevice as $mdlDevice) {
                          if ($mdlTestResult->getDevice_Id() == $mdlDevice->getId()) {
                            echo "<option value=".$mdlDevice->getId()." selected>".$mdlDevice->getName()."</option>";
                          } else {
                            echo "<option value=".$mdlDevice->getId().">".$mdlDevice->getName()."</option>";
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
                        if ($mdlTestResult->getTestType_Id() == $mdlTestType->getId()) {
                          echo "<option value=".$mdlTestType->getId()." selected>".$mdlTestType->getName()."</option>";
                        } else {
                          echo "<option value=".$mdlTestType->getId().">".$mdlTestType->getName()."</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-4 mb-2">
                    <label>Test Number</label>
                    <input type="number" name="TestNumber" class="form-control" placeholder="Test Number" value="<?php echo $mdlTestResult->getTestNumber(); ?>" />
                  </div>
                  <div class="col-4 mb-2">
                    <label>Date</label>
                    <input type="date" name="Date" class="form-control" placeholder="Date" value="<?php echo $mdlTestResult->getDate(); ?>" />
                  </div>
                  <div class="col-4 mb-2">
                    <label>Hours</label>
                    <input type="number" step=".01" name="Hours" class="form-control" placeholder="Hours" value="<?php echo $mdlTestResult->getHours(); ?>" />
                  </div>
                </div>

                <div class="row">
                  <div class="col-2 offset-5">
                    <input type="submit" name="Submit" class="btn btn-primary w-100" value="Submit" />
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
                  $lstTestResult = $clsTestResult->Get();
                  foreach ($lstTestResult as $mdlTestResult) {
                    ?>
                    <tr>
                      <td><?php echo $clsUser->ToName($clsUser->GetById($mdlTestResult->getUser_Id())); ?></td>
                      <td><?php echo $clsDevice->GetNameById($mdlTestResult->getDevice_Id()); ?></td>
                      <td><?php echo $clsTestType->GetNameById($mdlTestResult->getTestType_Id()); ?></td>
                      <td><?php echo $mdlTestResult->getTestNumber(); ?></td>
                      <td><?php echo $mdlTestResult->getDate(); ?></td>
                      <th><?php echo $mdlTestResult->getHours(); ?></th>
                      <td>
                        <a href="EditTestResult.php?Id=<?php echo $mdlTestResult->getId(); ?>" class="btn btn-sm" data-toggle="tooltip" data-original-title="Edit">
                          <i class="fa fa-edit" aria-hidden="true"></i>
                        </a>

                        <span data-toggle="modal" data-target="#ModalWrapper" onclick="deleteShow(<?php echo $mdlTestResult->getId(); ?>);">
                          <a href="JavaScript:void(0);" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" data-original-title="Remove">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                          </a>
                        </span>
                      </td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
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
