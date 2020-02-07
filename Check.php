<html>
	<head>
	<meta = charset="utf.8">
	Check Disburse Process
	</head> <br>
	<h4>
	<meta = charset="utf.8">
	Please Input your Disburse Request ID
	</h4>
	<body>
	
		<form action = "Check.php" method = "post">
			ID: <input type="number" name="id">
		<input type="submit" name="submitbutton" value="Submit">
		</form>

<?php

if(isset($_POST["submitbutton"])){
	
	include "Config.php";
	$id = mysqli_real_escape_string($conn,$_POST['id']);

	//Check if there is any Matching ID
	$tables = "SELECT * FROM testdatabase WHERE id = '$id'";
	$query = mysqli_query($conn, $tables);
	
		if (!$query) {
			printf("Error: %s\n", mysqli_error($conn));
			exit();
		}
		
		if (mysqli_num_rows($query) == 1) 
		{
		echo "Found Matched ID <br>";
		
		$db = mysqli_select_db($conn, $database);
		if (!$db)
		{
			die ("Can't use database : " . mysqli_errno);
		} 
		
		$json_response = array();  

		// Fetch data in array format  
		while ($row = mysqli_fetch_array($query)) {  

		// Fetch data of Fname Column and store in array of row_array
		$row_array['id'] = $row['id'] . "<br>";  
		$row_array['amount'] = $row['amount'] . "<br>"; 
		$row_array['status'] = $row['status'] . "<br>";
		$row_array['timestamp'] = $row['timestamp'] . "<br>";  
		$row_array['bank_code'] = $row['bank_code'] . "<br>"; 
		$row_array['account_number'] = $row['account_number'] . "<br>"; 
		$row_array['beneficiary_name'] = $row['beneficiary_name'] . "<br>";  
		$row_array['remark'] = $row['remark'] . "<br>"; 
		$row_array['receipt'] = $row['receipt'] . "<br>"; 
		$row_array['time_served'] = $row['time_served'] . "<br>";  
		$row_array['fee'] = $row['fee'] . "<br>"; 

		//Push the values in the array  
		array_push($json_response,$row_array);  
		}  

		echo json_encode($json_response); 
		
		} 
		else 
		{
        echo "No ID was Found";
		}

}

?> 

	</body>
</html>