
<?php
	/////// FUNCTIONLARIN OLDUÐU SAYFALAR INCLUDE EDÝLECEK //////////////////
	
	include('../DatabaseConnection/mydbFileUpload.php');
	include('../DatabaseConnection/mydbInsertUpdateDeleteData.php');
	include('../DatabaseConnection/mydbConnectionOpen.php');
	
	$AddPersonelProfile=isset($_POST["AddPersonelProfile"])?$_POST["AddPersonelProfile"]:NULL;
  	if(!is_null($AddPersonelProfile)){ 
		
		$connections= openDatabaseConnectionWithParameters("localhost","root","","mydb");
		
		$name=$_POST["name"];
		$surname =$_POST["surname"];
		$university =$_POST["university"];
		$department =$_POST["department"];
		$workplace=$_POST["workplace"];
		$gsm=$_POST["gsm1"].$_POST["gsm2"].$_POST["gsm3"];
		$email=$_POST["email"];
		$address=$_POST["address"];
		$assignedProject=$_POST["assignedProject"];
		$mentor=$_POST["mentor"];
		
		$isNeedTransport=0;
		if(isset($_POST['isNeedService'])){
			$isNeedTransport=1;
		}else{
			$isNeedTransport=0;
		}
		
		$cvPath=uploadCV("cvPath",$name,$surname);
		$photoPath=uploadPhoto("photoPath",$name,$surname);
		
		$competenceArray=array();
		if(!empty($_POST['competence_list'])) {
			foreach($_POST['competence_list'] as $competence_list_checked) {
				$competenceArray[]=$competence_list_checked;
			}
		}
		
		$competences='';
		foreach ($competenceArray as $competenceListAsString){
			$competences=$competences.$competenceListAsString.',';	
		}
		$trimmedCompetences=rtrim($competences, ',');
		$otherCompetence=$_POST["otherCompetence"];
		
		//form tarafýnda eksik (afternoon,beforenoon,full day)
		$workdaysArray=array();
		if(!empty($_POST['workdays_list'])) {
			foreach($_POST['workdays_list'] as $workdays_list_checked) {
				$workdaysArray[]=$workdays_list_checked;
				// workdayler ile beraber workday type eklenecek
			}
		}
		$workTypeArray = array();
		foreach($workdaysArray as $workType) {
			$workTypeName='drpdown'.$workType;
			$workTypeArray[]=$_POST[$workTypeName];		
		}
		
		InsertDataIntoDatabase($connections,$name,$surname,$university,$department
		,$workplace,$gsm,$email,$address,$assignedProject,$mentor,$isNeedTransport,
		$cvPath,$photoPath,$trimmedCompetences,$otherCompetence,$workdaysArray,$workTypeArray);
		

		//for($i=0; $i<count($workdaysArray); $i++){
			//echo $workdaysArray[$i].' '.$workTypeArray[$i].'<br/>';
		//}		
	}
	
?>