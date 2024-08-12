<?php
	include('../../assets/php/sql_conn.php');
	$fn = '';
    
	if(isset($_GET["fn"])){
	    $fn = $_GET["fn"];
	}else if(isset($_POST["fn"])){
	    $fn = $_POST["fn"];
	}

	//Save function start
	if($fn == 'saveFormData'){
		$return_result = array();
		$status = true;

		$service_providers_id = $_POST["service_providers_id"];		
		$service_providers_name = $_POST["service_providers_name"];		
		$service_providers_code = $_POST["service_providers_code"];				
		$primary_contact_number = $_POST["primary_contact_number"];			
		$secondary_contact_number = $_POST["secondary_contact_number"];	
		$service_providers_status = $_POST["service_providers_status"];
		
		try {
			if($service_providers_id > 0){
				$status = true;
				$sql = "UPDATE service_providers_list SET service_providers_name = '" .$service_providers_name. "', service_providers_code = '" .$service_providers_code. "', primary_contact_number = '" .$primary_contact_number. "', secondary_contact_number = '" .$secondary_contact_number. "', service_providers_status = '" .$service_providers_status. "' WHERE service_providers_id = '" .$service_providers_id. "' ";
				$result = $mysqli->query($sql);
			}else{
				$status = true;
				$sql = "INSERT INTO service_providers_list (service_providers_name, service_providers_code, primary_contact_number, secondary_contact_number, service_providers_status) VALUES ('".$service_providers_name."','".$service_providers_code."', '" .$primary_contact_number. "', '" .$secondary_contact_number. "', '".$service_providers_status."')";
				$result = $mysqli->query($sql);
			}
				
		} catch (PDOException $e) {
			die("Error occurred:" . $e->getMessage());
		}
		$return_result['status'] = $status;
		// sleep(2);
		echo json_encode($return_result);
	}//Save function end	

	//function start
	if($fn == 'getTableData'){
		$return_array = array();
		$status = true;
		$mainData = array();
		$author_bio1 = '';
		$sql = "SELECT * FROM service_providers_list ORDER BY service_providers_name";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$service_providers_id = $row['service_providers_id'];		
				$service_providers_name = $row['service_providers_name'];	
				$service_providers_code = $row['service_providers_code'];		
				$primary_contact_number = $row['primary_contact_number'];	
				$secondary_contact_number = $row['secondary_contact_number'];	
				$service_providers_status = $row['service_providers_status'];	

				$data[0] = $slno;
				$data[1] = $service_providers_name;
				$data[2] = $service_providers_code;
				$data[3] = $primary_contact_number;
				$data[4] = $secondary_contact_number;
				$data[5] = $activity_status[$service_providers_status];
				$data[6] = "<a href='javascript: void(0)' data-service_providers_id='.$service_providers_id.'><i class='fa fa-edit' aria-hidden='true' onclick='editTableData(".$service_providers_id.")'></i></a> <a href='javascript: void(0)' data-service_providers_id='.$service_providers_id.'> <i class='fa fa-trash' aria-hidden='true' onclick='deleteTableData(".$service_providers_id.")'></i></a>";

				array_push($mainData, $data);
				$slno++;
			}
		} else {
			$status = false;
		}
		//$mysqli->close();

		$return_array['data'] = $mainData;
    	echo json_encode($return_array);
	}//function end	

	//function start
	if($fn == 'getFormEditData'){
		$return_array = array();
		$status = true;
		$mainData = array();
		$service_providers_id = $_POST['service_providers_id'];

		$sql = "SELECT * FROM service_providers_list WHERE service_providers_id = '" .$service_providers_id. "' ";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;	
			$row = $result->fetch_array();
			
			$service_providers_id = $row['service_providers_id'];		
			$service_providers_name = $row['service_providers_name'];	
			$service_providers_code = $row['service_providers_code'];		
			$primary_contact_number = $row['primary_contact_number'];
			$secondary_contact_number = $row['secondary_contact_number'];
			$service_providers_status = $row['service_providers_status'];	
		} else {
			$status = false;
		}
		//$mysqli->close();
			
		$return_array['service_providers_id'] = $service_providers_id;
		$return_array['service_providers_name'] = $service_providers_name;
		$return_array['service_providers_code'] = $service_providers_code;
		$return_array['primary_contact_number'] = $primary_contact_number;
		$return_array['secondary_contact_number'] = $secondary_contact_number;
		$return_array['service_providers_status'] = $service_providers_status;

		$return_array['status'] = $status;
    	echo json_encode($return_array);
	}//function end

	//Delete function
	if($fn == 'deleteTableData'){
		$return_result = array();
		$service_providers_id = $_POST["service_providers_id"];
		$status = true;	

		$sql = "DELETE FROM service_providers_list WHERE service_providers_id = '".$service_providers_id."'";
		$result = $mysqli->query($sql);
		$return_result['status'] = $status;
		// sleep(1);
		echo json_encode($return_result);
	}//end function deleteItem

	//Get Category name
	/*if($fn == 'getAllCategoryName'){
		$return_array = array();
		$status = true;
		$mainData = array();

		$sql = "SELECT * FROM service_providers_list WHERE service_providers_status = 'active' ORDER BY service_providers_name ASC";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$service_providers_id = $row['service_providers_id'];	
				$service_providers_name = $row['service_providers_name'];			
				$service_providers_code = $row['service_providers_code'];
				$data = new stdClass();

				$data->service_providers_id = $service_providers_id;
				$data->service_providers_name = $service_providers_name;
				$data->service_providers_code = $service_providers_code;
				
				array_push($mainData, $data);
				$slno++;
			}
		} else {
			$status = false;
		}
		//$mysqli->close();

		$return_array['status'] = $status;
		$return_array['data'] = $mainData;
    	echo json_encode($return_array);
	}//function end	

	//Get Authors name
	if($fn == 'getAllAuthorsyName'){
		$return_array = array();
		$status = true;
		$mainData = array();

		$sql = "SELECT * FROM author_details WHERE author_status = 'active' ORDER BY author_name ASC";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$author_id = $row['author_id'];	
				$author_name = $row['author_name'];	
				$data = new stdClass();

				$data->author_id = $author_id;
				$data->author_name = $author_name;
				
				array_push($mainData, $data);
				$slno++;
			}
		} else {
			$status = false;
		}
		//$mysqli->close();

		$return_array['status'] = $status;
		$return_array['data'] = $mainData;
    	echo json_encode($return_array);
	}//function end	*/

?>