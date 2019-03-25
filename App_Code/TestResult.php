<?php
require_once ("TestResultModel.php");
$clsTestResult = new TestResult();
class TestResult{

	private $table = "testresult";

	public function __construct(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();
		$sql = "INSERT INTO `".$this->table."`
			(
				`User_Id`,
				`TestType_Id`,
				`TestResult_TestNumber`,
				`TestResult_Date`,
				`Device_Id`,
				`Hours`
			) VALUES (
				'".$mdl->getsqlUser_Id()."',
				'".$mdl->getsqlTestType_Id()."',
				'".$mdl->getsqlTestNumber()."',
				'".$mdl->getsqlDate()."',
				'".$mdl->getsqlDevice_Id()."',
				'".$mdl->getsqlHours()."'
			)";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$id = mysqli_insert_id($conn);

		mysqli_close($conn);
		return $id;
	}

	public function Update($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();
		$sql="UPDATE `".$this->table."` SET
				 `User_Id`='".$mdl->getsqlUser_Id()."',
				 `TestType_Id`='".$mdl->getsqlTestType_Id()."',
				 `TestResult_TestNumber`='".$mdl->getsqlTestNumber()."',
				 `TestResult_Date`='".$mdl->getsqlDate()."',
				 `Device_Id`='".$mdl->getsqlDevice_Id()."',
				 `Hours`='".$mdl->getsqlHours()."',
				 `TestResult_Status`='".$mdl->getsqlStatus()."'
		 WHERE `TestResult_Id`='".$mdl->getsqlId()."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		 mysqli_close($conn);
	}

	public function UpdateUser_Id($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`User_Id`='".$value."'
			WHERE `TestResult_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateTestType_Id($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`TestType_Id`='".$value."'
			WHERE `TestResult_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateTestNumber($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`TestResult_TestNumber`='".$value."'
			WHERE `TestResult_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateDate($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`TestResult_Date`='".$value."'
			WHERE `TestResult_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateDevice_Id($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Device_Id`='".$value."'
			WHERE `TestResult_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateHours($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Hours`='".$value."'
			WHERE `TestResult_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateStatus($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`TestResult_Status`='".$value."'
			WHERE `TestResult_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Delete($id){

		$Database = new Database();
		$conn = $Database->GetConn();
		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
			WHERE `TestResult_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

			mysqli_close($conn);

	}

	public function IsExist($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$val = false;
		$msg = "";

		// User_Id
		$sql = "SELECT COUNT(*) FROM `".$this->table."`
			WHERE
			`TestResult_Id` != '".$mdl->getsqlId()."' AND
			`User_Id` = '".$mdl->getsqlUser_Id()."' AND
			`TestType_Id` = '".$mdl->getsqlTestType_Id()."' AND
			`TestResult_TestNumber` = '".$mdl->getsqlTestNumber()."' AND
			`Device_Id` = '".$mdl->getsqlDevice_Id()."'
		";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$rows = mysqli_fetch_row($result);
		if($rows[0] > 0)
		{
			$msg .= "<p><a href='javascript:void(0)' class='alert-link' onclick='setFocus(\"inputUser_Id\")'>User_Id</a>: " . $mdl->getUser_Id() . "</p>";
			$val = true;
		}

		mysqli_close($conn);

		return array("val"=>"$val","msg"=>"$msg");

	}

	public function Get($status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="SELECT * FROM `".$this->table."`
		WHERE `TestResult_Status` = '".$status."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetUser_IdById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `User_Id` FROM `".$this->table."`
		WHERE `TestResult_Id` = '".$id."'
		AND `TestResult_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['User_Id'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetTestType_IdById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `TestType_Id` FROM `".$this->table."`
		WHERE `TestResult_Id` = '".$id."'
		AND `TestResult_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['TestType_Id'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetTestNumberById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `TestResult_TestNumber` FROM `".$this->table."`
		WHERE `TestResult_Id` = '".$id."'
		AND `TestResult_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['TestResult_TestNumber'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetDateById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `TestResult_Date` FROM `".$this->table."`
		WHERE `TestResult_Id` = '".$id."'
		AND `TestResult_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['TestResult_Date'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetDevice_IdById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `Device_Id` FROM `".$this->table."`
		WHERE `TestResult_Id` = '".$id."'
		AND `TestResult_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Device_Id'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetHoursById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `Hours` FROM `".$this->table."`
		WHERE `TestResult_Id` = '".$id."'
		AND `TestResult_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Hours'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetStatusById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `TestResult_Status` FROM `".$this->table."`
		WHERE `TestResult_Id` = '".$id."'
		AND `TestResult_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['TestResult_Status'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetById($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `TestResult_Id` = '".$value."'
		AND `TestResult_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetByUser_Id($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `User_Id` = '".$value."'
		AND `TestResult_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByTestType_Id($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `TestType_Id` = '".$value."'
		AND `TestResult_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByTestNumber($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `TestResult_TestNumber` = '".$value."'
		AND `TestResult_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByDate($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `TestResult_Date` = '".$value."'
		AND `TestResult_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByDevice_Id($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Device_Id` = '".$value."'
		AND `TestResult_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByHours($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Hours` = '".$value."'
		AND `TestResult_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByDateCreated($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `TestResult_DateCreated` = '".$value."'
		AND `TestResult_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByStatus($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `TestResult_Status` = '".$value."'
		AND `TestResult_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function SetImage($image,$id){

		$val = true;
		$msg = "";
		$clsImage = new Image();
		if(isset($image["name"]) && ($image["name"]!=""))
		{
			$result = $clsImage->Upload($image,$this->table,$id);
			if($result[0] != ""){
				$msg = $result[0];
			}
		}
		return array("val"=>$val,"msg"=>$msg);
	}

	public function ModelTransfer($result){

		$mdl = new TestResultModel();
		while($row = mysqli_fetch_array($result))
		{
			$mdl = $this->ToModel($row);
		}
		return $mdl;
	}

	public function ListTransfer($result){
		$lst = array();
		while($row = mysqli_fetch_array($result))
		{
			$mdl = new TestResultModel();
			$mdl = $this->ToModel($row);
			array_push($lst,$mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new TestResultModel();
		$mdl->setId((isset($row['TestResult_Id'])) ? $row['TestResult_Id'] : '');
		$mdl->setUser_Id((isset($row['User_Id'])) ? $row['User_Id'] : '');
		$mdl->setTestType_Id((isset($row['TestType_Id'])) ? $row['TestType_Id'] : '');
		$mdl->setTestNumber((isset($row['TestResult_TestNumber'])) ? $row['TestResult_TestNumber'] : '');
		$mdl->setDate((isset($row['TestResult_Date'])) ? $row['TestResult_Date'] : '');
		$mdl->setDevice_Id((isset($row['Device_Id'])) ? $row['Device_Id'] : '');
		$mdl->setHours((isset($row['Hours'])) ? $row['Hours'] : '');
		$mdl->setDateCreated((isset($row['TestResult_DateCreated'])) ? $row['TestResult_DateCreated'] : '');
		$mdl->setStatus((isset($row['TestResult_Status'])) ? $row['TestResult_Status'] : '');
		return $mdl;
	}



	public function GetByUser_IdTestType_Id($User_Id,$TestType_Id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$User_Id = mysqli_real_escape_string($conn,$User_Id);
		$TestType_Id = mysqli_real_escape_string($conn,$TestType_Id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `User_Id` = '".$User_Id."'
		AND `TestType_Id` = '".$TestType_Id."'
		AND `TestResult_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}
}
