<?php
$mdlTestType = new TestTypeModel();
class TestTypeModel{

	private $Id = "";
	private $Test_Id = "";
	private $Name = "";
	private $MaxHours = "";
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


	//Test_Id
	public function getTest_Id(){
		return $this->Test_Id;
	}

	public function getsqlTest_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Test_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setTest_Id($Test_Id){
		$this->Test_Id = $Test_Id;
	}


	//Name
	public function getName(){
		return $this->Name;
	}

	public function getsqlName(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Name);
		mysqli_close($conn);
		return $value;
	}

	public function setName($Name){
		$this->Name = $Name;
	}


	//MaxHours
	public function getMaxHours(){
		return $this->MaxHours;
	}

	public function getsqlMaxHours(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->MaxHours);
		mysqli_close($conn);
		return $value;
	}

	public function setMaxHours($MaxHours){
		$this->MaxHours = $MaxHours;
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
