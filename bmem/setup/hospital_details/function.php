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

		$hospital_id = $_POST["hospital_id"];		
		$hospital_name = $_POST["hospital_name"];		
		$hospital_code = $_POST["hospital_code"];				
		$hospital_address = $_POST["hospital_address"];
		$hospital_status = $_POST["hospital_status"];
		
		try {
			if($hospital_id > 0){
				$status = true;
				$sql = "UPDATE hospital_list SET hospital_name = '" .$hospital_name. "', hospital_code = '" .$hospital_code. "', hospital_address = '" .$hospital_address. "', hospital_status = '" .$hospital_status. "' WHERE hospital_id = '" .$hospital_id. "' ";
				$result = $mysqli->query($sql);
			}else{
				$status = true;
				$sql = "INSERT INTO hospital_list (hospital_name, hospital_code, hospital_address, hospital_status) VALUES ('".$hospital_name."','".$hospital_code."', '" .$hospital_address. "', '".$hospital_status."')";
				$result = $mysqli->query($sql);
			}
				
		} catch (PDOException $e) {
			die("Error occurred:" . $e->getMessage());
		}
		$return_result['status'] = $status;
		//sleep(2);
		echo json_encode($return_result);
	}//Save function end	

	//function start
	if($fn == 'getTableData'){
		$return_array = array();
		$status = true;
		$mainData = array();
		$author_bio1 = '';
		$sql = "SELECT * FROM hospital_list ORDER BY hospital_name";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$hospital_id = $row['hospital_id'];		
				$hospital_name = $row['hospital_name'];	
				$hospital_code = $row['hospital_code'];			
				$hospital_address = $row['hospital_address'];
				$hospital_status = $row['hospital_status'];	

				$data[0] = $slno;
				$data[1] = $hospital_name;
				$data[2] = $hospital_code;
				$data[3] = $hospital_address;
				$data[4] = $activity_status[$hospital_status];
				$data[5] = "<a href='javascript: void(0)' data-hospital_id='.$hospital_id.'><i class='fa fa-edit' aria-hidden='true' onclick='editTableData(".$hospital_id.")'></i></a> <a href='javascript: void(0)' data-hospital_id='.$hospital_id.'> <i class='fa fa-trash' aria-hidden='true' onclick='deleteTableData(".$hospital_id.")'></i></a>";

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
		$hospital_id = $_POST['hospital_id'];

		$sql = "SELECT * FROM hospital_list WHERE hospital_id = '" .$hospital_id. "' ";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;	
			$row = $result->fetch_array();
			
			$hospital_id = $row['hospital_id'];		
			$hospital_name = $row['hospital_name'];	
			$hospital_code = $row['hospital_code'];		
			$hospital_status = $row['hospital_status'];	
		} else {
			$status = false;
		}
		//$mysqli->close();
			
		$return_array['hospital_id'] = $hospital_id;
		$return_array['hospital_name'] = $hospital_name;
		$return_array['hospital_code'] = $hospital_code;
		$return_array['hospital_status'] = $hospital_status;

		$return_array['status'] = $status;
    	echo json_encode($return_array);
	}//function end

	//Delete function
	if($fn == 'deleteTableData'){
		$return_result = array();
		$hospital_id = $_POST["hospital_id"];
		$status = true;	

		$sql = "DELETE FROM hospital_list WHERE hospital_id = '".$hospital_id."'";
		$result = $mysqli->query($sql);
		$return_result['status'] = $status;
		//sleep(1);
		echo json_encode($return_result);
	}//end function deleteItem

	//Get Category name
	if($fn == 'getAllCategoryName'){
		$return_array = array();
		$status = true;
		$mainData = array();

		$sql = "SELECT * FROM hospital_list WHERE hospital_status = 'active' ORDER BY hospital_name ASC";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$hospital_id = $row['hospital_id'];	
				$hospital_name = $row['hospital_name'];			
				$hospital_code = $row['hospital_code'];
				$data = new stdClass();

				$data->hospital_id = $hospital_id;
				$data->hospital_name = $hospital_name;
				$data->hospital_code = $hospital_code;
				
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
	}//function end	

?>