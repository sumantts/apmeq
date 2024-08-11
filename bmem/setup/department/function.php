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

		$department_id = $_POST["department_id"];		
		$department_name = $_POST["department_name"];		
		$department_code = $_POST["department_code"];		
		$department_status = $_POST["department_status"];
		
		try {
			if($department_id > 0){
				$status = true;
				$sql = "UPDATE department_list SET department_name = '" .$department_name. "', department_code = '" .$department_code. "', department_status = '" .$department_status. "' WHERE department_id = '" .$department_id. "' ";
				$result = $mysqli->query($sql);
			}else{
				$status = true;
				$sql = "INSERT INTO department_list (department_name, department_code, department_status) VALUES ('".$department_name."','".$department_code."', '".$department_status."')";
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
		$sql = "SELECT * FROM department_list ORDER BY department_name";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$department_id = $row['department_id'];		
				$department_name = $row['department_name'];	
				$department_code = $row['department_code'];		
				$department_status = $row['department_status'];	

				$data[0] = $slno;
				$data[1] = $department_name;
				$data[2] = $department_code;
				$data[3] =  $activity_status[$department_status];
				$data[4] = "<a href='javascript: void(0)' data-department_id='.$department_id.'><i class='fa fa-edit' aria-hidden='true' onclick='editTableData(".$department_id.")'></i></a> <a href='javascript: void(0)' data-department_id='.$department_id.'> <i class='fa fa-trash' aria-hidden='true' onclick='deleteTableData(".$department_id.")'></i></a>";

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
		$department_id = $_POST['department_id'];

		$sql = "SELECT * FROM department_list WHERE department_id = '" .$department_id. "' ";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;	
			$row = $result->fetch_array();
			
			$department_id = $row['department_id'];		
			$department_name = $row['department_name'];	
			$department_code = $row['department_code'];		
			$department_status = $row['department_status'];	
		} else {
			$status = false;
		}
		//$mysqli->close();
			
		$return_array['department_id'] = $department_id;
		$return_array['department_name'] = $department_name;
		$return_array['department_code'] = $department_code;
		$return_array['department_status'] = $department_status;

		$return_array['status'] = $status;
    	echo json_encode($return_array);
	}//function end

	//Delete function
	if($fn == 'deleteTableData'){
		$return_result = array();
		$department_id = $_POST["department_id"];
		$status = true;	

		$sql = "DELETE FROM department_list WHERE department_id = '".$department_id."'";
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

		$sql = "SELECT * FROM department_list WHERE department_status = 'active' ORDER BY department_name ASC";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$department_id = $row['department_id'];	
				$department_name = $row['department_name'];			
				$department_code = $row['department_code'];
				$data = new stdClass();

				$data->department_id = $department_id;
				$data->department_name = $department_name;
				$data->department_code = $department_code;
				
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