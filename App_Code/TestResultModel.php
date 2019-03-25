<?php
$mdlTestResult = new TestResultModel();
class TestResultModel{

	private $Id = "";
	private $User_Id = "";
	private $TestType_Id = "";
	private $TestNumber = "";
	private $Date = "";
	private $Device_Id = "";
	private $Hours = "";
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


	//User_Id
	public function getUser_Id(){
		return $this->User_Id;
	}

	public function getsqlUser_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->User_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setUser_Id($User_Id){
		$this->User_Id = $User_Id;
	}


	//TestType_Id
	public function getTestType_Id(){
		return $this->TestType_Id;
	}

	public function getsqlTestType_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->TestType_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setTestType_Id($TestType_Id){
		$this->TestType_Id = $TestType_Id;
	}


	//TestNumber
	public function getTestNumber(){
		return $this->TestNumber;
	}

	public function getsqlTestNumber(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->TestNumber);
		mysqli_close($conn);
		return $value;
	}

	public function setTestNumber($TestNumber){
		$this->TestNumber = $TestNumber;
	}


	//Date
	public function getDate(){
		return $this->Date;
	}

	public function getsqlDate(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Date);
		mysqli_close($conn);
		return $value;
	}

	public function setDate($Date){
		$this->Date = $Date;
	}


	//Device_Id
	public function getDevice_Id(){
		return $this->Device_Id;
	}

	public function getsqlDevice_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Device_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setDevice_Id($Device_Id){
		$this->Device_Id = $Device_Id;
	}


	//Hours
	public function getHours(){
		return $this->Hours;
	}

	public function getsqlHours(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Hours);
		mysqli_close($conn);
		return $value;
	}

	public function setHours($Hours){
		$this->Hours = $Hours;
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
