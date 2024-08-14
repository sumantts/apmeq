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

		$user_type_id = $_POST["user_type_id"];		
		$user_type_name = $_POST["user_type_name"];		
		$user_type_code = $_POST["user_type_code"];		
		$user_type_status = $_POST["user_type_status"];
		
		try {
			if($user_type_id > 0){
				$status = true;
				$sql = "UPDATE user_type SET user_type_name = '" .$user_type_name. "', user_type_code = '" .$user_type_code. "', user_type_status = '" .$user_type_status. "' WHERE user_type_id = '" .$user_type_id. "' ";
				$result = $mysqli->query($sql);
			}else{
				$status = true;
				$sql = "INSERT INTO user_type (user_type_name, user_type_code, user_type_status) VALUES ('".$user_type_name."','".$user_type_code."', '".$user_type_status."')";
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
		$sql = "SELECT * FROM user_type ORDER BY user_type_name";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$user_type_id = $row['user_type_id'];		
				$user_type_name = $row['user_type_name'];	
				$user_type_code = $row['user_type_code'];		
				$user_type_status = $row['user_type_status'];	

				$data[0] = $slno;
				$data[1] = $user_type_name;
				$data[2] = $user_type_code;
				$data[3] = $activity_status[$user_type_status];
				//$data[4] = "Restricted";
				$data[4] = "<a href='javascript: void(0)' data-user_type_id='.$user_type_id.'><i class='fa fa-edit' aria-hidden='true' onclick='editTableData(".$user_type_id.")'></i></a> <a href='javascript: void(0)' data-user_type_id='.$user_type_id.'> <i class='fa fa-trash' aria-hidden='true' onclick='deleteTableData(".$user_type_id.")'></i></a>";

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
		$user_type_id = $_POST['user_type_id'];

		$sql = "SELECT * FROM user_type WHERE user_type_id = '" .$user_type_id. "' ";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;	
			$row = $result->fetch_array();
			
			$user_type_id = $row['user_type_id'];		
			$user_type_name = $row['user_type_name'];	
			$user_type_code = $row['user_type_code'];		
			$user_type_status = $row['user_type_status'];	
		} else {
			$status = false;
		}
		//$mysqli->close();
			
		$return_array['user_type_id'] = $user_type_id;
		$return_array['user_type_name'] = $user_type_name;
		$return_array['user_type_code'] = $user_type_code;
		$return_array['user_type_status'] = $user_type_status;

		$return_array['status'] = $status;
    	echo json_encode($return_array);
	}//function end

	//Delete function
	if($fn == 'deleteTableData'){
		$return_result = array();
		$user_type_id = $_POST["user_type_id"];
		$status = true;	

		$sql = "DELETE FROM user_type WHERE user_type_id = '".$user_type_id."'";
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

		$sql = "SELECT * FROM user_type WHERE user_type_status = 'active' ORDER BY user_type_name ASC";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$user_type_id = $row['user_type_id'];	
				$user_type_name = $row['user_type_name'];			
				$user_type_code = $row['user_type_code'];
				$data = new stdClass();

				$data->user_type_id = $user_type_id;
				$data->user_type_name = $user_type_name;
				$data->user_type_code = $user_type_code;
				
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