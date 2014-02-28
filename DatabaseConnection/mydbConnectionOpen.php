<?php
	function openDatabaseConnection()
	{
		// Create connection with default parameters
		$connection=mysqli_connect("localhost","root","","mydb");//$host,$userName,$password,$databaseName);
		
		// Check connection
		if (mysqli_connect_errno())
		{
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}else{
			echo "Connection is successful.";
		}
	}
	
	function openDatabaseConnectionWithParameters($host,$userName,$password,$databaseName)
	{	
		// Create connection without default parameters
		$connection=mysqli_connect($host,$userName,$password,$databaseName);
		
		// Check connection
		if (mysqli_connect_errno())
		{
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}else{
			echo "Connection is successful.";
		}
		
		return $connection;
	}
	
	function closeOpenedDatabaseConnection($mysqli_connection)
	{
			if(is_object($mysqli_connection) && get_class($mysqli_connection) == 'mysqli')

			if($mysqli_connection_thread = mysqli_thread_id($mysqli_connection))
			{
				$mysqli_connection->kill($mysqli_connection_thread);
			}
			$mysqli_connection->close();
	}	
	
	
	// sample
	//$connections= openDatabaseConnectionWithParameters("localhost","root","","mydb");
	//closeOpenedDatabaseConnection($connections);
	
	//if (connection_status()==0){
		//echo "\n\nThe connection is closed.";
    //}
	
?>