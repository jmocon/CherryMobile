<?php
require_once "App_Code/Database.php";
require_once "App_Code/Functions.php";
require_once "App_Code/DeviceType.php";
require_once "App_Code/Test.php";

$msg = "";
$err = "";

if (!empty($_POST['Submit'])) {

  $err .= $clsFn->setForm('Name',$mdlTest,true);
  $err .= $clsFn->setForm('DeviceType_Id',$mdlTest,true);

  if($err == ""){
		$duplicate = $clsTest->IsExist($mdlTest);
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
			$id = $clsTest->Add($mdlTest);
			$msg .= '
				<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
				<span class="sr-only">Close</span>
				</button>
				<h4>
					Successfully Added New User Position.
				</h4>
				</div>
			';
			// Clear all data if success
			$mdlTest = new TestModel();
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

  <title>View Test - CherryMobile PDD</title>

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
            <h1 class="h3 mb-0 text-gray-800">Add Test</h1>
          </div>

          <!-- Content Row -->

          <div class="card shadow h-100 py-2">
            <div class="card-body">
              <form method="POST">
                <?php echo $msg; ?>
                <div class="row mb-4">

                  <div class="col-12 mb-2">
                    <label>DeviceType</label>
                    <select name="DeviceType_Id" class="form-control">
                      <?php
                      $lstDeviceType = $clsDeviceType->Get();
                      foreach ($lstDeviceType as $mdlDeviceType) {
                        if ($mdlTest->getDeviceType_Id() == $mdlDeviceType->getId()) {
                          echo "<option value=".$mdlDeviceType->getId()." selected>".$mdlDeviceType->getName()."</option>";
                        } else {
                          echo "<option value=".$mdlDeviceType->getId().">".$mdlDeviceType->getName()."</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-12 mb-2">
                    <label>Name</label>
                    <input type="text" name="Name" class="form-control" placeholder="Name" value="<?php echo $mdlTest->getName(); ?>" />
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
              <h6 class="m-0 font-weight-bold text-primary">Test</h6>
            </div>
            <div class="card-body">
              <table class="table table-bordered" id="dataTable">
                <thead>
                  <tr>
                    <th>Device Type</th>
                    <th>Name</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Device Type</th>
                    <th>Name</th>
                    <th>Actions</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  $lstTest = $clsTest->Get();
                  foreach ($lstTest as $mdlTest) {
                    ?>
                    <tr>
                      <td><?php echo $clsDeviceType->GetNameById($mdlTest->getDeviceType_Id()); ?></td>
                      <td><?php echo $mdlTest->getName(); ?></td>
                      <td>
                        <a href="EditTest.php?Id=<?php echo $mdlTest->getId(); ?>" class="btn btn-sm" data-toggle="tooltip" data-original-title="Edit">
                          <i class="fa fa-edit" aria-hidden="true"></i>
                        </a>

                        <span data-toggle="modal" data-target="#ModalWrapper" onclick="deleteShow(<?php echo $mdlTest->getId(); ?>);">
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
