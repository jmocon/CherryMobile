<?php
$clsImage = new Image();
class Image{

	private $table = "image";

	public function __construct(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "INSERT INTO `".$this->table."`
				(
					`Image_Name`,
					`Image_Table`,
					`Image_TableId`,
					`Image_Size`
				) VALUES (
					'".$mdl->getsqlName()."',
					'".$mdl->getsqlTable()."',
					'".$mdl->getsqlTableId()."',
					'".$mdl->getsqlSize()."'
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
			`Image_Name`='".$mdl->getsqlName()."',
			`Image_Table`='".$mdl->getsqlTable()."',
			`Image_TableId`='".$mdl->getsqlTableId()."',
			`Image_Size`='".$mdl->getsqlSize()."'
			WHERE `Image_Id`='".$mdl->getsqlId()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Activate($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="UPDATE `".$this->table."` SET
			`Image_Status`='0'
			WHERE `Image_Id`='".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Deactivate($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="UPDATE `".$this->table."` SET
			`Image_Status`='1'
			WHERE `Image_Id`='".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Delete($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
				WHERE `Image_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function DeleteAllSize($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT * FROM `".$this->table."`
				WHERE
				`Image_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		$mdl = $this->ModelTransfer($result);


		$sql="DELETE FROM `".$this->table."`
				WHERE
				`Image_Name` = '".$mdl->getName()."' AND
				`Image_Table` = '".$mdl->getTable()."' AND
				`Image_TableId` = '".$mdl->getTableId()."'
				";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function DeleteByTableTableId($table,$tableId){

		$Database = new Database();
		$conn = $Database->GetConn();

		$table = mysqli_real_escape_string($conn,$table);
		$tableId = mysqli_real_escape_string($conn,$tableId);

		$sql="DELETE FROM `".$this->table."`
				WHERE
				`Image_Table` = '".$table."' AND
				`Image_TableId` = '".$tableId."'
				";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function IsExist($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$val = false; // true - exist | false - does not exist
		$msg = "";

		$sql = "SELECT `Image_Id` FROM `".$this->table."`
				WHERE
				`Image_Table` = '".$mdl->getsqlTable()."' AND
				`Image_TableId` = '".$mdl->getsqlTableId()."' AND
				`Image_Size` = '".$mdl->getsqlSize()."' AND
				`Image_Id` != '".$mdl->getsqlId()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$num_rows = mysqli_num_rows($result);

		if($num_rows > 0)
		{
			$msg .= "<p>Size: " . $mdl->getSize() . "</p>";
			$val = true;
		}

		mysqli_close($conn);
		return array("val"=>$val,"msg"=>$msg);
	}

	public function IsExistGetId($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$val = false; // true - exist | false - does not exist
		$imgId = "";

		$sql = "SELECT `Image_Id` FROM `".$this->table."`
				WHERE
				`Image_Name` = '".$mdl->getsqlTable()."' AND
				`Image_Table` = '".$mdl->getsqlTable()."' AND
				`Image_TableId` = '".$mdl->getsqlTableId()."' AND
				`Image_Size` = '".$mdl->getsqlSize()."' AND
				`Image_Id` != '".$mdl->getsqlId()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$num_rows = mysqli_num_rows($result);

		if($num_rows > 0)
		{
			while($row = mysqli_fetch_array($result))
			{
				$imgId = $row['Image_Id'];
			}
			$val = true;
		}

		mysqli_close($conn);
		return array("val"=>$val,"id"=>$imgId);
	}

	public function Get(){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="SELECT * FROM `".$this->table."`";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT * FROM `".$this->table."`
				WHERE `Image_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetByIdSize($id,$size){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT * FROM `".$this->table."`
				WHERE `Image_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$mdl = $this->ModelTransfer($result);
		if($size != $mdl->getSize()){
			$sql="SELECT * FROM `".$this->table."`
					WHERE
					`Image_Name` = '".$mdl->getName()."' AND
					`Image_Table` = '".$mdl->getTable()."' AND
					`Image_TableId` = '".$mdl->getTableId()."' AND
					`Image_Size` = '".$size."'";

			$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
			$mdl = $this->ModelTransfer($result);
		}

		mysqli_close($conn);

		return $mdl;
	}

	public function GetByDetail($table,$tableId,$size){

		$Database = new Database();
		$conn = $Database->GetConn();

		$table = mysqli_real_escape_string($conn,$table);
		$tableId = mysqli_real_escape_string($conn,$tableId);
		$size = mysqli_real_escape_string($conn,$size);

		$sql="SELECT * FROM `".$this->table."`
				WHERE
				`Image_Table` = '".$table."' AND
				`Image_TableId` = '".$tableId."' AND
				`Image_Size` = '".$size."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function ToLocation($mdl){
		if($mdl->getTable() != "" && $mdl->getSize() != "" && $mdl->getName() != ""){
			$loc = "image/".$mdl->getTable()."/".$mdl->getSize()."/".$mdl->getName();
		}else{
			return "";
		}
		return $loc;
	}

	public function Upload($imageFile,$table,$tableId){
		/*
		Return Value
		[0] - Error Message
		[1] - Image Id
		*/
		$Database = new Database();
		$conn = $Database->GetConn();

		$errMessage = "";
		$imageId = "";
		$size = "original";

		//Add Database Image
			$mdl = new ImageModel();
			$mdl->setName("");
			$mdl->setTable($table);
			$mdl->setTableId($tableId);
			$mdl->setSize($size);
			$imageId = $this->Add($mdl);

		$target_dir = "../image/".$table."/original/";

		if (!file_exists($target_dir)) {
			mkdir($target_dir, 0777, true);
		}

		$temp = explode(".", $imageFile["name"]);
		$newfilename = $imageId . '.' . end($temp);
		$target_file = $target_dir . basename($newfilename);

		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])){
			if(isset($imageFile["tmp_name"]) && $imageFile["tmp_name"] != ""){
				$check = getimagesize($imageFile["tmp_name"]);
				if($check !== false){
					$errMessage .= "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					$errMessage .= "File is not an image.";
					$uploadOk = 0;
				}
			}else{
				$errMessage .= "File is not an image. Or exceeds File Upload Limit (Update phpinfo). ";
				$uploadOk = 0;
			}
		}
		// Check file size
		if ($imageFile["size"] > 5000000){
			$errMessage .= "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if(
				$imageFileType != "jpg" && $imageFileType != "JPG" &&
		 		$imageFileType != "png" && $imageFileType != "PNG" &&
				$imageFileType != "jpeg" && $imageFileType != "JPED" &&
				$imageFileType != "gif" && $imageFileType != "GIF"
				 ){
			$errMessage .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0){
			$errMessage .= "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($imageFile["tmp_name"], $target_file)){

				//Add Database Image
				$mdl->setId($imageId);
				$mdl->setName($newfilename);
				$this->Update($mdl);

				$errMessage = "";
			} else {
				$errMessage .= "Sorry, there was an error uploading your file.";
			}
		}

		mysqli_close($conn);

		return array($errMessage,$imageId);
	}

	public function Resize($imageId,$size){
		$mdl = new ImageModel();
		$mdl = $this->GetById($imageId);

		$oldDir = "../image/".$mdl->getTable()."/".$mdl->getSize()."/";
		$newDir = "../image/".$mdl->getTable()."/".$size."/";
		if (!file_exists($newDir)) {
			mkdir($newDir, 0777, true);
		}
		copy($oldDir.$mdl->getName(),$newDir.$mdl->getName());

		$maxDim = $size;
		$src = "";
		$file_name = $newDir.$mdl->getName();
		list($width, $height, $type, $attr) = getimagesize( $file_name );
		if ( $width > $maxDim || $height > $maxDim ) {
			$target_filename = $file_name;
			$ratio = $width/$height;
			if( $ratio > 1) {
				$new_width = $maxDim;
				$new_height = $maxDim/$ratio;
			} else {
				$new_width = $maxDim*$ratio;
				$new_height = $maxDim;
			}

			$imageFileType = pathinfo($file_name,PATHINFO_EXTENSION);
			switch (strtolower($imageFileType)){
				case 'jpg':{
					$src = imagecreatefromjpeg( $file_name );
					break;
				}
				case 'jpeg':{
					$src = imagecreatefromjpeg( $file_name );
					break;
				}
				case 'png':{
					$src = imagecreatefrompng( $file_name );
					break;
				}
				case 'gif':{
					$src = imagecreatefromgif( $file_name );
					break;
				}
			}
			$dst = imagecreatetruecolor( $new_width, $new_height );

			// preserve transparency
		  if($imageFileType == "gif" or $imageFileType == "png"){
		    imagecolortransparent($dst, imagecolorallocatealpha($dst, 0, 0, 0, 127));
		    imagealphablending($dst, false);
		    imagesavealpha($dst, true);
		  }
			imagecopyresampled( $dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
			imagedestroy( $src );
			imagepng( $dst, $target_filename ); // adjust format as needed
			imagedestroy( $dst );
		}

		//Add Database Image
		$mdl->setSize($size);
		$result = $this->IsExistGetId($mdl);
		if(!$result['val']){
			$imageId = $this->Add($mdl);
		}

	}

	public function ResizeH($imageId,$size){
		$mdl = new ImageModel();
		$mdl = $this->GetById($imageId);
		$oldDir = "../image/".$mdl->getTable()."/".$mdl->getSize()."/";
		$newDir = "../image/".$mdl->getTable()."/h".$size."/";
		if (!file_exists($newDir)) {
			mkdir($newDir, 0777, true);
		}
		copy($oldDir.$mdl->getName(),$newDir.$mdl->getName());

		$maxDim = $size;
		$src = "";
		$file_name = $newDir.$mdl->getName();
		list($width, $height, $type, $attr) = getimagesize( $file_name );
		if ( $width > $maxDim || $height > $maxDim ) {
			$target_filename = $file_name;
			$ratio = $width/$height;
			$new_width = $maxDim*$ratio;
			$new_height = $maxDim;

			$imageFileType = pathinfo($file_name,PATHINFO_EXTENSION);
			switch ($imageFileType){
				case 'jpg':{
					$src = imagecreatefromjpeg( $file_name );
					break;
				}
				case 'jpeg':{
					$src = imagecreatefromjpeg( $file_name );
					break;
				}
				case 'png':{
					$src = imagecreatefrompng( $file_name );
					break;
				}
				case 'gif':{
					$src = imagecreatefromgif( $file_name );
					break;
				}
				default:
					$src = imagecreatefrompng( $file_name );
					break;
			}
			$dst = imagecreatetruecolor( $new_width, $new_height );

			// preserve transparency
			if($imageFileType == "gif" or $imageFileType == "png"){
				imagecolortransparent($dst, imagecolorallocatealpha($dst, 0, 0, 0, 127));
				imagealphablending($dst, false);
				imagesavealpha($dst, true);
			}

			imagecopyresampled( $dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
			imagedestroy( $src );
			imagepng( $dst, $target_filename ); // adjust format as needed
			imagedestroy( $dst );
		}

		//Add Database Image
		$mdl->setSize("h".$size);
		$result = $this->IsExistGetId($mdl);
		if(!$result['val']){
			$imageId = $this->Add($mdl);
		}else{
			echo $result['id'];
					die();
		}

	}

	public function ResizeW($imageId,$size){

		$mdl = new ImageModel();
		$mdl = $this->GetById($imageId);

		$oldDir = "../image/".$mdl->getTable()."/".$mdl->getSize()."/";
		$newDir = "../image/".$mdl->getTable()."/w".$size."/";
		if (!file_exists($newDir)) {
			mkdir($newDir, 0777, true);
		}
		copy($oldDir.$mdl->getName(),$newDir.$mdl->getName());

		$maxDim = $size;
		$src = "";
		$file_name = $newDir.$mdl->getName();
		list($width, $height, $type, $attr) = getimagesize( $file_name );
		if ( $width > $maxDim || $height > $maxDim ) {
			$target_filename = $file_name;
			$ratio = $width/$height;
			$new_width = $maxDim;
			$new_height = $maxDim/$ratio;

			$imageFileType = pathinfo($file_name,PATHINFO_EXTENSION);
			switch (strtolower($imageFileType)){
				case 'jpg':{
					$src = imagecreatefromjpeg( $file_name );
					break;
				}
				case 'jpeg':{
					$src = imagecreatefromjpeg( $file_name );
					break;
				}
				case 'png':{
					$src = imagecreatefrompng( $file_name );
					break;
				}
				case 'gif':{
					$src = imagecreatefromgif( $file_name );
					break;
				}
			}
			$dst = imagecreatetruecolor( $new_width, $new_height );

			// preserve transparency
		  if($imageFileType == "gif" or $imageFileType == "png"){
		    imagecolortransparent($dst, imagecolorallocatealpha($dst, 0, 0, 0, 127));
		    imagealphablending($dst, false);
		    imagesavealpha($dst, true);
		  }

			imagecopyresampled( $dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
			imagedestroy( $src );
			imagepng( $dst, $target_filename ); // adjust format as needed
			imagedestroy( $dst );
		}

		//Add Database Image
		$mdl->setSize("w".$size);
		$result = $this->IsExistGetId($mdl);
		if(!$result['val']){
			$imageId = $this->Add($mdl);
		}

	}

	public function ModelTransfer($result){

		$mdl = new ImageModel();
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
			$mdl = new ImageModel();
			$mdl = $this->ToModel($row);
			array_push($lst, $mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new ImageModel();

		$mdl->setId((isset($row['Image_Id'])) ? $row['Image_Id'] : '');
		$mdl->setName((isset($row['Image_Name'])) ? $row['Image_Name'] : '');
		$mdl->setTable((isset($row['Image_Table'])) ? $row['Image_Table'] : '');
		$mdl->setTableId((isset($row['Image_TableId'])) ? $row['Image_TableId'] : '');
		$mdl->setSize((isset($row['Image_Size'])) ? $row['Image_Size'] : '');
		$mdl->setDateCreated((isset($row['Image_DateCreated'])) ? $row['Image_DateCreated'] : '');
		$mdl->setStatus((isset($row['Image_Status'])) ? $row['Image_Status'] : '');

		return $mdl;
	}
}
?>
