<?php
// start session
session_start();
// store session data
$_SESSION['userName']=NULL;
include("PHPconnectionDB.php");
?>
<html>
	<body>
		<?php
		
		if (isset ($_POST['validate'])){
		 	$pid = $_POST['personid'];
			$pword = $_POST['password'];
		
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
	    
      //establish connection
      $conn=connect();		 		
      if (!$conn) {
      	echo 'Cannot connect to database!';
      	//$e = oci_error();
      	//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
      }
      
      $sql = "SELECT password FROM users WHERE person_id='$pid'";

      //Prepare sql using conn and returns the statement identifier
	   $stid = oci_parse($conn, $sql );	   
	   
	   //Execute a statement returned from oci_parse()
	   $res=oci_execute($stid);
	   //$res = $conn->query($sql);

		if ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
   		foreach ($row as $item) {
        		$rightPword = ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;");
    		}
    		if ($rightPword != $pword) {
				echo 'Invalid password'; 
				  
      	} else{
      		$_SESSION['userName'] = $pid;
      		header('Location: http://consort.cs.ualberta.ca/~han8/welcome.html'); 
      		exit;
      		/*
      		if(file_exists("welcome.html")){
      			include 'welcome.html';
   				//break;     
   			} else {
   				echo 'html file does not exist!';
   			}
   			*/
      	}
		} else {
			echo 'Invalid id';
		}


      
      // Free the statement identifier when closing the connection
	   oci_free_statement($stid);
	   oci_close($conn);
	   
	   
   }