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

		$manufacturer_id = $_POST["manufacturer_id"];		
		$manufacturer_name = $_POST["manufacturer_name"];		
		$manufacturer_code = $_POST["manufacturer_code"];				
		$primary_contact_number = $_POST["primary_contact_number"];			
		$secondary_contact_number = $_POST["secondary_contact_number"];	
		$manufacturer_status = $_POST["manufacturer_status"];
		
		try {
			if($manufacturer_id > 0){
				$status = true;
				$sql = "UPDATE manufacturer_list SET manufacturer_name = '" .$manufacturer_name. "', manufacturer_code = '" .$manufacturer_code. "', primary_contact_number = '" .$primary_contact_number. "', secondary_contact_number = '" .$secondary_contact_number. "', manufacturer_status = '" .$manufacturer_status. "' WHERE manufacturer_id = '" .$manufacturer_id. "' ";
				$result = $mysqli->query($sql);
			}else{
				$status = true;
				$sql = "INSERT INTO manufacturer_list (manufacturer_name, manufacturer_code, primary_contact_number, secondary_contact_number, manufacturer_status) VALUES ('".$manufacturer_name."','".$manufacturer_code."', '" .$primary_contact_number. "', '" .$secondary_contact_number. "', '".$manufacturer_status."')";
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
		$sql = "SELECT * FROM manufacturer_list ORDER BY manufacturer_name";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$manufacturer_id = $row['manufacturer_id'];		
				$manufacturer_name = $row['manufacturer_name'];	
				$manufacturer_code = $row['manufacturer_code'];		
				$primary_contact_number = $row['primary_contact_number'];	
				$secondary_contact_number = $row['secondary_contact_number'];	
				$manufacturer_status = $row['manufacturer_status'];	

				$data[0] = $slno;
				$data[1] = $manufacturer_name;
				$data[2] = $manufacturer_code;
				$data[3] = $primary_contact_number;
				$data[4] = $secondary_contact_number;
				$data[5] = $activity_status[$manufacturer_status];
				$data[6] = "<a href='javascript: void(0)' data-manufacturer_id='.$manufacturer_id.'><i class='fa fa-edit' aria-hidden='true' onclick='editTableData(".$manufacturer_id.")'></i></a> <a href='javascript: void(0)' data-manufacturer_id='.$manufacturer_id.'> <i class='fa fa-trash' aria-hidden='true' onclick='deleteTableData(".$manufacturer_id.")'></i></a>";

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
		$manufacturer_id = $_POST['manufacturer_id'];

		$sql = "SELECT * FROM manufacturer_list WHERE manufacturer_id = '" .$manufacturer_id. "' ";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;	
			$row = $result->fetch_array();
			
			$manufacturer_id = $row['manufacturer_id'];		
			$manufacturer_name = $row['manufacturer_name'];	
			$manufacturer_code = $row['manufacturer_code'];		
			$primary_contact_number = $row['primary_contact_number'];
			$secondary_contact_number = $row['secondary_contact_number'];
			$manufacturer_status = $row['manufacturer_status'];	
		} else {
			$status = false;
		}
		//$mysqli->close();
			
		$return_array['manufacturer_id'] = $manufacturer_id;
		$return_array['manufacturer_name'] = $manufacturer_name;
		$return_array['manufacturer_code'] = $manufacturer_code;
		$return_array['primary_contact_number'] = $primary_contact_number;
		$return_array['secondary_contact_number'] = $secondary_contact_number;
		$return_array['manufacturer_status'] = $manufacturer_status;

		$return_array['status'] = $status;
    	echo json_encode($return_array);
	}//function end

	//Delete function
	if($fn == 'deleteTableData'){
		$return_result = array();
		$manufacturer_id = $_POST["manufacturer_id"];
		$status = true;	

		$sql = "DELETE FROM manufacturer_list WHERE manufacturer_id = '".$manufacturer_id."'";
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

		$sql = "SELECT * FROM manufacturer_list WHERE manufacturer_status = 'active' ORDER BY manufacturer_name ASC";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$manufacturer_id = $row['manufacturer_id'];	
				$manufacturer_name = $row['manufacturer_name'];			
				$manufacturer_code = $row['manufacturer_code'];
				$data = new stdClass();

				$data->manufacturer_id = $manufacturer_id;
				$data->manufacturer_name = $manufacturer_name;
				$data->manufacturer_code = $manufacturer_code;
				
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