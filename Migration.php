<?php

require_once "Config.php";

	$url = 'https://nextar.flip.id';
	$curl = curl_init($url);

	curl_setopt_array($curl, array(
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTPHEADER => array(
	"Content-type: application/json"
  ),
));

$curl_response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);


$sql = "CREATE TABLE migrateddata (
    id BIGINT(6) PRIMARY KEY, 
    amount INT(15) NOT NULL,
    status VARCHAR(10) NOT NULL,
    timestamp TIMESTAMP NOT NULL,
    bank_code VARCHAR(20) NOT NULL,
    account_number VARCHAR(15) NOT NULL,
    beneficiary_name VARCHAR(25) NOT NULL,
    remark VARCHAR(50) NOT NULL,
    receipt VARCHAR(150) ,
    time_served TIMESTAMP NOT NULL,
    fee int(5) NOT NULL
    )";

if ($conn->query($sql) === TRUE) {
    echo "Table migrateddata created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();

?>