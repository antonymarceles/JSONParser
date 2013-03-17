<?php

	//HTTPFul Bootstrap loader
	require(__DIR__ . '/bootstrap.php');
 

 	//Parent Node Elements 
 	$parentnode = $_POST[parentnode];


	//Create Column Structure
	//Fields to Capture
	$fields = $_POST[fields2capture];
	$field = explode(",", $fields);

 	//Initialize Column Names
	$columnNameListInitialization = "(";
	$counter = 1;
	foreach($field as $columnName){
	
		$pos = strpos(trim($columnName),"->")+2;
		$pos = strlen(trim($columnName))-$pos;
		//echo "Text -".substr($columnName, -$pos).'<br/>';
		$columnName = substr($columnName, -$pos);
		
		$columnName = str_replace("->", "_", trim($columnName));		
		$columnName = str_replace("-", "_", trim($columnName));
		$columnName = str_replace("[", "", trim($columnName));
		$columnName = str_replace("]", "", trim($columnName));
	
		if ($counter == count($field)) {
			$columnNameListInitialization = $columnNameListInitialization.$columnName. ' varchar(1000))';
		} else {
			$columnNameListInitialization = $columnNameListInitialization.$columnName. ' varchar(1000), ';
		}
		$counter += 1;
	}
 	//echo $columnNameListInitialization .'<br/>';
 	

	//Create a DB Connection
	$con = mysql_connect("localhost","root","");
 	if (!$con)
 	  {
 	  die('Could not connect: ' . mysql_error());
 	  }
 	
 	mysql_select_db("iGov", $con);
 	
 
 	//Parent Node Elements 
 	$tablename = $_POST[tablename];
 
 
 	$tableExist = mysql_query('select 1 from '.$tablename);

	if ($tableExist !== FALSE) {
		//Delete Previous Table
		$sql = "DROP TABLE ".$tablename;
		if (!mysql_query($sql,$con))
		{
			die('Error: ' . mysql_error());
		}
		//echo "Table Deleted Successfully<br/>"; 
		//Create Table	
		$sql = "CREATE TABLE ".$tablename." ".$columnNameListInitialization;	
		if (!mysql_query($sql,$con))
		{
			die('Error: ' . mysql_error());
		}
		//echo "Table Created Successfully<br/>";			
	} else {
		//Create Table	
		$sql = "CREATE TABLE ".$tablename." ".$columnNameListInitialization;	
		if (!mysql_query($sql,$con))
		{
			die('Error: ' . mysql_error());
		}
		//echo "Table Created Successfully<br/>";	
	}
 	
 	
 	//Table Columns	
	$columnNameListFields = "(";
	$counter = 1;
		
	foreach($field as $columnName){
	
		$pos = strpos(trim($columnName),"->")+2;
		$pos = strlen(trim($columnName))-$pos;
		//echo "Text -".substr($columnName, -$pos).'<br/>';
		$columnName = substr($columnName, -$pos);
		
		$columnName = str_replace("->", "_", trim($columnName));		
		$columnName = str_replace("-", "_", trim($columnName));
		$columnName = str_replace("[", "", trim($columnName));
		$columnName = str_replace("]", "", trim($columnName));
	
		if ($counter == count($field)) {
			$columnNameListFields = $columnNameListFields.$columnName. ')';
		} else {
			$columnNameListFields = $columnNameListFields.$columnName. ', ';
		}
		$counter += 1;
	}
 	
 	
 	//Make call to API URL
	$url = $_POST[jsonurl];
  	$query = urlencode('#PHP');
  	$response = \Httpful\Request::get($url)->send();
 	
 	if (!$response->hasErrors()) {
 		echo '************** Total Rows Executed - '.count($response->body->people).'**************<br/><br/><br/>';

		foreach ($response->body->people as $congressMan) {

		 	//Table Values
			$columnNameListValue = "(";
			$counter = 1;
			foreach($field as $columnName){
				$columnName = explode("->", trim($columnName));
 
				if ($counter == count($field)) {
					if (count($columnName) == 4) {
						if (($congressMan->$columnName[0]->$columnName[1]->$columnName[2]->$columnName[3])!="") {
							$columnNameListValue = $columnNameListValue."'".$congressMan->$columnName[0]->$columnName[1]->$columnName[2]->$columnName[3]."')";
						} else {
							$columnNameListValue = $columnNameListValue."''".")";
						}
					} else if (count($columnName) == 3) {
						if (($congressMan->$columnName[0]->$columnName[1]->$columnName[2])!="") {
							$columnNameListValue = $columnNameListValue."'".$congressMan->$columnName[0]->$columnName[1]->$columnName[2]."')";
						} else {
							$columnNameListValue = $columnNameListValue."''".")";
						}
					} else if (count($columnName) == 2) {

						if (($congressMan->$columnName[0]->$columnName[1])!="") {
							$columnNameListValue = $columnNameListValue."'".$congressMan->$columnName[0]->$columnName[1]."')";
						} else {
							$columnNameListValue = $columnNameListValue."''".")";
						}
					} else if (count($columnName) == 1) {
						if (($congressMan->$columnName[0])!="") {
							$columnNameListValue = $columnNameListValue."'".$congressMan->$columnName[0]."')";
						} else {
							$columnNameListValue = $columnNameListValue."''".")";
						}
					}
				} else {
					if (count($columnName) == 4) {
						if (($congressMan->$columnName[0]->$columnName[1]->$columnName[2]->$columnName[3])!="") {
							$columnNameListValue = $columnNameListValue."'".$congressMan->$columnName[0]->$columnName[1]->$columnName[2]->$columnName[3]."', ";
						} else {
							$columnNameListValue = $columnNameListValue."''".", ";
						}
					} else if (count($columnName) == 3) {
						if (($congressMan->$columnName[0]->$columnName[1]->$columnName[2])!="") {
							$columnNameListValue = $columnNameListValue."'".$congressMan->$columnName[0]->$columnName[1]->$columnName[2]."', ";
						} else {
							$columnNameListValue = $columnNameListValue."''".", ";
						}
					} else if (count($columnName) == 2) {
						if (($congressMan->$columnName[0]->$columnName[1])!="") {
							$columnNameListValue = $columnNameListValue."'".$congressMan->$columnName[0]->$columnName[1]."', ";
						} else {
							$columnNameListValue = $columnNameListValue."''".", ";
						}
					} else if (count($columnName) == 1) {
						if (($congressMan->$columnName[0])!="") {
							$columnNameListValue = $columnNameListValue."'".$congressMan->$columnName[0]."', ";
						} else {
							$columnNameListValue = $columnNameListValue."''".", ";
						}
					}
				}
				$counter += 1;
			}
		
			
			echo "*** SQL EXECUTED ***<br/>";
			echo "INSERT INTO ".$tablename." ".$columnNameListFields." VALUES ". $columnNameListValue."<br/>";
			
			if (!mysql_query("INSERT INTO ".$tablename." ".$columnNameListFields." VALUES ". $columnNameListValue))
			{
				die('*** Error ***<br/>' . mysql_error());
			}
			
			echo "*** INSERT SUCCESSFUL ***<br/><br/><br/>";		
		}
	} else {
		echo "API failed on us";
	}

   	mysql_close($con);
  
?>