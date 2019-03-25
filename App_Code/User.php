<?php
require_once ("UserModel.php");
$clsUser = new User();
class User{

	private $table = "user";

	public function __construct(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();
		$sql = "INSERT INTO `".$this->table."`
			(
				`User_FirstName`,
				`User_MiddleName`,
				`User_LastName`,
				`User_SuffixName`,
				`UserPosition_Id`,
				`User_Username`,
				`User_Password`
			) VALUES (
				'".$mdl->getsqlFirstName()."',
				'".$mdl->getsqlMiddleName()."',
				'".$mdl->getsqlLastName()."',
				'".$mdl->getsqlSuffixName()."',
				'".$mdl->getsqlUserPosition_Id()."',
				'".$mdl->getsqlUsername()."',
				'".$mdl->getsqlPassword()."'
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
				 `User_FirstName`='".$mdl->getsqlFirstName()."',
				 `User_MiddleName`='".$mdl->getsqlMiddleName()."',
				 `User_LastName`='".$mdl->getsqlLastName()."',
				 `User_SuffixName`='".$mdl->getsqlSuffixName()."',
				 `UserPosition_Id`='".$mdl->getsqlUserPosition_Id()."',
				 `User_Username`='".$mdl->getsqlUsername()."',
				 `User_Password`='".$mdl->getsqlPassword()."',
				 `User_Status`='".$mdl->getsqlStatus()."'
		 WHERE `User_Id`='".$mdl->getsqlId()."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		 mysqli_close($conn);
	}

	public function UpdateFirstName($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`User_FirstName`='".$value."'
			WHERE `User_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateMiddleName($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`User_MiddleName`='".$value."'
			WHERE `User_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateLastName($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`User_LastName`='".$value."'
			WHERE `User_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateSuffixName($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`User_SuffixName`='".$value."'
			WHERE `User_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateUserPosition_Id($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`UserPosition_Id`='".$value."'
			WHERE `User_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateUsername($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`User_Username`='".$value."'
			WHERE `User_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdatePassword($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`User_Password`='".$value."'
			WHERE `User_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateStatus($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`User_Status`='".$value."'
			WHERE `User_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Delete($id){

		$Database = new Database();
		$conn = $Database->GetConn();
		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
			WHERE `User_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

			mysqli_close($conn);

	}

	public function IsExist($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$val = false;
		$msg = "";



		// User_Username
		$sql = "SELECT COUNT(*) FROM `".$this->table."`
			WHERE
			`User_Id` != '".$mdl->getsqlId()."' AND
			`User_Username` = '".$mdl->getsqlUsername()."'
		";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$rows = mysqli_fetch_row($result);
		if($rows[0] > 0)
		{
			$msg .= "<p><a href='javascript:void(0)' class='alert-link' onclick='setFocus(\"inputUsername\")'>Username</a>: " . $mdl->getUsername() . "</p>";
			$val = true;
		}

		mysqli_close($conn);

		return array("val"=>"$val","msg"=>"$msg");

	}

	public function Get($status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="SELECT * FROM `".$this->table."`
		WHERE `User_Status` = '".$status."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetFirstNameById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `User_FirstName` FROM `".$this->table."`
		WHERE `User_Id` = '".$id."'
		AND `User_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['User_FirstName'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetMiddleNameById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `User_MiddleName` FROM `".$this->table."`
		WHERE `User_Id` = '".$id."'
		AND `User_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['User_MiddleName'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetLastNameById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `User_LastName` FROM `".$this->table."`
		WHERE `User_Id` = '".$id."'
		AND `User_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['User_LastName'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetSuffixNameById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `User_SuffixName` FROM `".$this->table."`
		WHERE `User_Id` = '".$id."'
		AND `User_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['User_SuffixName'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetUserPosition_IdById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `UserPosition_Id` FROM `".$this->table."`
		WHERE `User_Id` = '".$id."'
		AND `User_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['UserPosition_Id'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetUsernameById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `User_Username` FROM `".$this->table."`
		WHERE `User_Id` = '".$id."'
		AND `User_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['User_Username'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetPasswordById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `User_Password` FROM `".$this->table."`
		WHERE `User_Id` = '".$id."'
		AND `User_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['User_Password'];
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

		$sql="SELECT `User_Status` FROM `".$this->table."`
		WHERE `User_Id` = '".$id."'
		AND `User_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['User_Status'];
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
		WHERE `User_Id` = '".$value."'
		AND `User_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetByFirstName($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `User_FirstName` = '".$value."'
		AND `User_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByMiddleName($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `User_MiddleName` = '".$value."'
		AND `User_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByLastName($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `User_LastName` = '".$value."'
		AND `User_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetBySuffixName($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `User_SuffixName` = '".$value."'
		AND `User_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByUserPosition_Id($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `UserPosition_Id` = '".$value."'
		AND `User_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByUsername($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `User_Username` = '".$value."'
		AND `User_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByPassword($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `User_Password` = '".$value."'
		AND `User_Status` = '".$status."'";

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
		WHERE `User_DateCreated` = '".$value."'
		AND `User_Status` = '".$status."'";

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
		WHERE `User_Status` = '".$value."'
		AND `User_Status` = '".$status."'";

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

		$mdl = new UserModel();
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
			$mdl = new UserModel();
			$mdl = $this->ToModel($row);
			array_push($lst,$mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new UserModel();
		$mdl->setId((isset($row['User_Id'])) ? $row['User_Id'] : '');
		$mdl->setFirstName((isset($row['User_FirstName'])) ? $row['User_FirstName'] : '');
		$mdl->setMiddleName((isset($row['User_MiddleName'])) ? $row['User_MiddleName'] : '');
		$mdl->setLastName((isset($row['User_LastName'])) ? $row['User_LastName'] : '');
		$mdl->setSuffixName((isset($row['User_SuffixName'])) ? $row['User_SuffixName'] : '');
		$mdl->setUserPosition_Id((isset($row['UserPosition_Id'])) ? $row['UserPosition_Id'] : '');
		$mdl->setUsername((isset($row['User_Username'])) ? $row['User_Username'] : '');
		$mdl->setPassword((isset($row['User_Password'])) ? $row['User_Password'] : '');
		$mdl->setDateCreated((isset($row['User_DateCreated'])) ? $row['User_DateCreated'] : '');
		$mdl->setStatus((isset($row['User_Status'])) ? $row['User_Status'] : '');
		return $mdl;
	}





	public function ToName($mdl){
			$name = '';
			$name .= $mdl->getFirstName();
			if (!empty($mdl->getMiddleName())) {
				$name .= ' ' . $mdl->getMiddleName()[0] . '.';
			}
			$name .= ' ' . $mdl->getLastName();
			$name .= ' ' . $mdl->getSuffixName();
			return $name;
	}
}
