<?php
	if($_SERVER['HTTP_HOST'] == 'localhost'){
		$host = 'localhost';
		$username = 'root';
		$password = '';
		$dbname = 'apmeq';
	}else{
		$host = 'localhost';
		$username = 'apmeqcom_apmeq';
		$password = 'apmeq123!@#';
		$dbname = 'apmeqcom_apmeq';
	}
	$mysqli = new mysqli($host, $username, $password, $dbname);

	// Check connection
	if ($mysqli -> connect_errno) {
		echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
		exit();
	}else{
		//echo "Connected Successfully";
	}

	$con = mysqli_connect($host, $username, $password, $dbname);
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}
	session_start();
	
	/*echo "connected...";
	
	try {
		$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
		$sql = "CALL usp_validateuser('admin','bagnan')";
		$q = $pdo->query($sql);
		$q->setFetchMode(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		die("Error occurred:" . $e->getMessage());
	}
		
	while ($r = $q->fetch()): 
		echo $r['SocietyNm'];
	endwhile;*/

	$title = 'APMEQ';
	$logo_text = 'APMEQ';

    $p_name = 'APMEQ';
	$logo = 'apmeq_logo.png';
	$ico = 'apmeq_logo.png';
	

	//Social Media
	$socials = [
		"twitter" => '',
		"facebook" => '',
		"instagram" => '',
		"google_plus" => '',
		"linkedin" => '',
	];

	$forTheYearsArr1 = '[
		{
			"value": "0",
			"text": "Select"
		}, 
		{
			"value": "1", 
			"text": "1st Year"
		} , 
		{
			"value": "2", 
			"text": "2nd Year"
		}, 
		{
			"value": "3", 
			"text": "3rd Year"
		}, 
		{
			"value": "4", 
			"text": "4th Year Onwards"
		}
	]';
	$forTheYearsArr = json_decode($forTheYearsArr1);

	date_default_timezone_set('Asia/Kolkata');

	$activity_status = ["Inactive", "Active"];

		 
?>
