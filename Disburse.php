<html>
	<head>
	<meta = charset="utf.8">
	Request Disburse
	</head> <br>
	<br>
	<body>
	
		<form action = "Disburse.php" method = "post">
			Bank Code: <input type="text" name="code">
			<br>
			Account Number: <input type="number" name="account">
			<br>
			Amount: <input type="number" name="amount">
			<br>
			Remark: <input type="text" name="remark">
			<br>
		<input type="submit" name="submitbutton" value="Submit">
		</form>
		
<?php 

	date_default_timezone_set("Asia/Jakarta");
	$id = "123456";
	$amount = false;
	$status = "PENDING";
	$timestamp = date("Y-m-d H:i:sa");
	$code = false;
	$account = false;
	$beneficiary_name = "PT FLIP";
	$remark = false;
	$receipt = "null";
	$time_served = "0000-00-00 00:00:00:00";
	$fee = "4000";

if(isset($_POST["submitbutton"])){
	$amount = $_POST['amount'];
	$code = $_POST['code'];
	$account = $_POST['account'];
	$remark = $_POST['remark'];
	echo "Request Success! You can check your request in Check.php.<br>";
	echo "id: " . $id . "<br>";
	echo "amount: " . $amount . "<br>";
	echo "status: " . $status . "<br>";
	echo "timestamp: " . $timestamp . "<br>";
	echo "bank_code: " . $code . "<br>";
	echo "account_number: " . $account . "<br>";
	echo "beneficiary_name: " . $beneficiary_name . "<br>";
	echo "remark: " . $remark . "<br>";
	echo "receipt: " . $receipt . "<br>";
	echo "time_served: " . $time_served . "<br>";
	echo "fee: " . $fee . "<br> <br>";
	}

$apikey = "HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41";
$encoded_auth = base64_encode($apikey.":");

$array = array (
    "amount" => $amount,
    "code" => $code,
    "account" => $account,
    "remark" => $remark,
);
$myvars = 'id:' . $id . 'status:' . $status . 'timestamp:' . $timestamp . 'beneficiary_name:' . $beneficiary_name . 'receipt:' . $receipt . 'time_served:' . $time_served . 'fee:' . $fee;
$data_string = json_encode($array);
$url = 'https://nextar.flip.id';
$curl = curl_init($url);
$headers = @get_headers($url); 
 
if(isset($_POST["submitbutton"])){
// Use condition to check the existence of URL 
if($headers && strpos( $headers[0], '200')) { 
    $status = "URL Exist, data has been sent to the API."; 
} 
else { 
    $status = "URL Doesn't Exist for the moment, we will send the data once the URL is available."; 
} 
  
// Display result 
echo "Status: (200) " . $status . "<br>" ; 

curl_setopt_array( $curl, array(
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_POSTFIELDS => $myvars,
	CURLOPT_POSTFIELDS => $data_string,
	CURLOPT_FOLLOWLOCATION => 1,
	CURLOPT_HEADER => 0,
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_HTTPHEADER => array(
    "Content-type: application/x-www-form-urlencoded",
    "Authorization: Basic ".$encoded_auth),
));

//Execute cURL
$curl_response = curl_exec($curl);

//Output server response
print_r($curl_response);

//Close cURL connection
curl_close($curl);

}

?>

	</body>
</html>