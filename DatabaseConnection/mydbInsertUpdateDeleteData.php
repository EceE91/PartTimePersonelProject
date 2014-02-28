<?php
	//include('mydbFileUpload.php');

	function InsertDataIntoDatabase($databaseConnectionString,$name,$surname,$university,
									$department,$workplace,$gsm,$email,$address,
									$assignedProject,$mentor,$isNeedTransport,$cvPath,$photoPath,$competence,$competenceOther
									,$workdaysArray,$workTypeArray)
	{
			// önce connection açılmış olmalı
			mysqli_autocommit($databaseConnectionString, false);
			$flag=true;
			
			$sqlInsertStatementForPersonel="INSERT INTO parttimepersonel
											(Name,Surname,University,Department,Workplace,Gsm,Email,Address,AssignedProject,
											 Mentor,IsNeedTransport,CvPath,PhotoPath,Competence,CompetenceOther) 
											VALUES
											('$name','$surname','$university','$department','$workplace','$gsm','$email','$address',
											 '$assignedProject','$mentor','$isNeedTransport','$cvPath','$photoPath','$competence','$competenceOther')";
		
			
			
			if (!mysqli_query($databaseConnectionString,$sqlInsertStatementForPersonel))
			{
			  $flag=false;
			  die('Error inserting personal profile: ' . mysqli_error($databaseConnectionString));
			}else
			{
			
			$newid = mysqli_insert_id($databaseConnectionString);
			
			  for($i=0; $i<count($workdaysArray); $i++){
		
				// Workday icin; FullDay => 2, After Noon => 1,Before Noon => 0					 
				$sqlInsertStatementForWorkDays="INSERT INTO workday 
												(Workday,IsFullDay,PersonelID) 
												VALUES
												('$workdaysArray[$i]','$workTypeArray[$i]',$newid)";
												
				if (!mysqli_query($databaseConnectionString,$sqlInsertStatementForWorkDays))
					{
					  $flag=false;
					  die('Error inserting personal profile: ' . mysqli_error($databaseConnectionString));
					}
					else{
						$flag=true;
					}
				 } 
			}
	
			if($flag){
				mysqli_commit($databaseConnectionString);
				echo "Success!";
			}else{
				mysqli_rollback($databaseConnectionString);
				echo "Error!";
			}
			
			closeOpenedDatabaseConnection($databaseConnectionString);
			// bundan sonra connection kapatılmalı
	}
	
	
	
	
	
?>