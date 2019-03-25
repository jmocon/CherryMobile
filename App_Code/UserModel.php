<?php
$mdlUser = new UserModel();
class UserModel{

	private $Id = "";
	private $FirstName = "";
	private $MiddleName = "";
	private $LastName = "";
	private $SuffixName = "";
	private $UserPosition_Id = "";
	private $Username = "";
	private $Password = "";
	private $DateCreated = "";
	private $Status = "";

	public function __construct(){}

	//Id
	public function getId(){
		return $this->Id;
	}

	public function getsqlId(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Id);
		mysqli_close($conn);
		return $value;
	}

	public function setId($Id){
		$this->Id = $Id;
	}


	//FirstName
	public function getFirstName(){
		return $this->FirstName;
	}

	public function getsqlFirstName(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->FirstName);
		mysqli_close($conn);
		return $value;
	}

	public function setFirstName($FirstName){
		$this->FirstName = $FirstName;
	}


	//MiddleName
	public function getMiddleName(){
		return $this->MiddleName;
	}

	public function getsqlMiddleName(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->MiddleName);
		mysqli_close($conn);
		return $value;
	}

	public function setMiddleName($MiddleName){
		$this->MiddleName = $MiddleName;
	}


	//LastName
	public function getLastName(){
		return $this->LastName;
	}

	public function getsqlLastName(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->LastName);
		mysqli_close($conn);
		return $value;
	}

	public function setLastName($LastName){
		$this->LastName = $LastName;
	}


	//SuffixName
	public function getSuffixName(){
		return $this->SuffixName;
	}

	public function getsqlSuffixName(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->SuffixName);
		mysqli_close($conn);
		return $value;
	}

	public function setSuffixName($SuffixName){
		$this->SuffixName = $SuffixName;
	}


	//UserPosition_Id
	public function getUserPosition_Id(){
		return $this->UserPosition_Id;
	}

	public function getsqlUserPosition_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->UserPosition_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setUserPosition_Id($UserPosition_Id){
		$this->UserPosition_Id = $UserPosition_Id;
	}


	//Username
	public function getUsername(){
		return $this->Username;
	}

	public function getsqlUsername(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Username);
		mysqli_close($conn);
		return $value;
	}

	public function setUsername($Username){
		$this->Username = $Username;
	}


	//Password
	public function getPassword(){
		return $this->Password;
	}

	public function getsqlPassword(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Password);
		mysqli_close($conn);
		return $value;
	}

	public function setPassword($Password){
		$this->Password = $Password;
	}


	//DateCreated
	public function getDateCreated(){
		return $this->DateCreated;
	}

	public function getsqlDateCreated(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->DateCreated);
		mysqli_close($conn);
		return $value;
	}

	public function setDateCreated($DateCreated){
		$this->DateCreated = $DateCreated;
	}


	//Status
	public function getStatus(){
		return $this->Status;
	}

	public function getsqlStatus(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Status);
		mysqli_close($conn);
		return $value;
	}

	public function setStatus($Status){
		$this->Status = $Status;
	}


}
