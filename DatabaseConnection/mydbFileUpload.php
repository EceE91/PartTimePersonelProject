<?php
	
	/////////////////// UPLOAD PHOTO /////////////////////////////
	function uploadPhoto($photo,$name,$surname){
		$fotoName= $_FILES[$photo]["name"];
		$fotoType=$_FILES[$photo]["type"];
		$fotoSize=$_FILES[$photo]["size"];
		$fotoUploadError=$_FILES[$photo]["error"];
		$fotoStoredIn =$_FILES[$photo]["tmp_name"];
        $allowedExts = array("jpeg", "jpg", "png");

        $temp = explode(".",$fotoName);
        $fileExtension = end($temp);
		
		$fotoDirectory='';
		if ((($fotoType == "image/jpeg") || ($fotoType == "image/jpg") 
			|| ($fotoType == "image/pjpeg") || ($fotoType == "image/x-png") 
			|| ($fotoType == "image/png")) && (	$fotoSize < 1000000) && in_array($fileExtension, $allowedExts)) 
		{
			
			  if ($fotoUploadError > 0)
			  {
				echo "Error uploading photo: " . $fotoUploadError . "<br>";
			  }
			  else
			  {
				if (file_exists("../uploadedPhoto/" . $fotoName))
				{
						echo $fotoName . " already exists. ";
				}else{
						move_uploaded_file($fotoStoredIn,"../uploadedPhoto/".$name.'-'.$surname.'-'.$fotoName);
						$fotoDirectory="uploadedPhoto/".$fotoName."-".$name.'-'.$surname;
				}
				
			  }
		}else{
			echo "Invalid File! Please upload a photo with any of '.jpeg,.jpg,.png' extensions. ";
		}
			return $fotoDirectory;
	}// end function uploadPhoto
		
	
	////////////////////// UPLOAD CV /////////////////////////
	function uploadCV( $CV,$name,$surname)
	{
		$CVFileName=$_FILES[$CV]["name"];
		$CVFileType=$_FILES[$CV]["type"];
		$CVFileSize=$_FILES[$CV]["size"];
		
		$CVFileSizeInKB=$CVFileSize / 1024;
		$CVFileStoredIn =$_FILES[$CV]["tmp_name"];
		$CVFileUploadError =$_FILES[$CV]["error"];
	
		$allowedExts = array("doc", "odt", "pdf", "txt");
		$temp = explode(".", $_FILES[$CV]["name"]);
		$extension = end($temp);
		
		$cvDirectory='';
		if ((($CVFileType == "application/pdf")
			|| ($CVFileType == "text/plain")
			|| ($CVFileType == "application/msword")
			|| ($CVFileType == "application/vnd.oasis.opendocument.text"))
			&& ($CVFileSize< 50000)
			&& in_array($extension, $allowedExts))
		  {		
				if ($CVFileUploadError > 0)
				{
					echo "Error uploading CV" . $CVFileUploadError . "<br>";
				}
				else
				{
					if (file_exists("../uploadCVFiles/" . $CVFileName))
					{
						echo $CVFileName . " already exists. ";
					}else{
					  move_uploaded_file($CVFileStoredIn,'../uploadCVFiles/' .$name.'-'.$surname.'-'.$CVFileName);
					  $cvDirectory="uploadCVFiles/".$CVFileName;	
					}					  
				}
		  }else
		  {
			echo "Invalid File! Please upload a CV with any of '.doc,.odt,.pdf,.txt' extensions. ";
		  }
		  
		  return $cvDirectory;
	}// end function uploadCv
	
?>