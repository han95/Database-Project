<?php
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

      if ($res == $pword) {
			echo 'Invalid id/password';    
      } else{
      	echo 'Welcome!';      
      }
      
      // Free the statement identifier when closing the connection
	   oci_free_statement($stid);
	   oci_close($conn);
	   
	   
   }







/* <html>
	<body>
		//The following code based on http://www.w3schools.com/php/php_forms.asp
		<form action="welcome.php" method="post">
			User Name: <input type="text" name="username"><br>
			Password: <input type="text" name="password"><br>
			<input type="submit">
		</form>

	</body>
</html> */