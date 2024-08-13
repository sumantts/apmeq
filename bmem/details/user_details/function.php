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
		$insert_id1 = 0; 
		$status = true;

		
		$user_id = $_POST['user_id'];
		$user_name = $_POST['user_name'];
		$user_type_id = $_POST['user_type_id'];
		$hospital_id = $_POST['hospital_id'];
		$user_mobile = $_POST['user_mobile'];
		$user_phone = $_POST['user_phone'];
		$user_email = $_POST['user_email'];
		$user_dob = $_POST['user_dob'];
		$user_address = $_POST['user_address'];
		$user_user_name = $_POST['user_user_name'];
		$user_password = $_POST['user_password'];
		$user_status = $_POST['user_status'];
		
		try {
			if($user_id > 0){
				$status = true;
				$sql = "UPDATE user_details SET user_name = '" .$user_name. "', user_type_id = '" .$user_type_id. "', hospital_id = '" .$hospital_id. "', user_mobile = '" .$user_mobile. "', user_phone = '" .$user_phone. "', user_email = '" .$user_email. "', user_dob = '" .$user_dob. "', user_address = '" .$user_address. "', user_user_name = '" .$user_user_name. "', user_password = '" .$user_password. "', user_status = '" .$user_status. "' WHERE user_id = '" .$user_id. "' ";
				$result = $mysqli->query($sql); 
			}else{
				$check_sql = "SELECT * FROM user_details WHERE user_email = '" .$user_email. "' AND user_mobile = '" .$user_mobile. "'";
				$check_result = $mysqli->query($check_sql);

				if ($check_result->num_rows > 0) {
					$return_result['error_message'] = 'This email and phone number already exist';
					$status = false;
				}else{
					$sql = "INSERT INTO user_details (user_name, user_type_id, hospital_id, user_mobile, user_phone, user_email, user_dob, user_address, user_user_name, user_password, user_status) VALUES ('" .$user_name. "', '" .$user_type_id. "', '" .$hospital_id. "', '" .$user_mobile. "', '" .$user_phone. "', '" .$user_email. "', '" .$user_dob. "', '" .$user_address. "', '" .$user_user_name. "', '" .$user_password. "', '" .$user_status. "')";
					$result = $mysqli->query($sql);
					$user_id = $mysqli->insert_id; 
				}//end if	
			}	
		} catch (PDOException $e) {
			die("Error occurred:" . $e->getMessage());
		}
		$return_result['status'] = $status;
		$return_result['user_id'] = $user_id;
		//sleep(2);
		echo json_encode($return_result);
	}//Save function end	

	//function start
	if($fn == 'getTableData'){
		$return_array = array();
		$status = true;
		$mainData = array();
		$email1 = '';
		$sql = "SELECT user_details.user_id, user_details.user_name, user_details.user_type_id, user_details.hospital_id, user_details.user_mobile, user_details.user_phone, user_details.user_email, user_details.user_dob, user_details.user_address, user_details.user_user_name, user_details.user_password, user_details.user_status, user_type.user_type_name, user_type.user_type_code, hospital_list.hospital_name, hospital_list.hospital_code FROM user_details JOIN user_type ON user_details.user_type_id = user_type.user_type_id JOIN hospital_list ON user_details.hospital_id = hospital_list.hospital_id";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;

			while($row = $result->fetch_array()){ 	
				$user_id = $row['user_id'];
				$user_name = $row['user_name'];
				$user_type_id = $row['user_type_id'];
				$user_type_name = $row['user_type_name'];
				$user_type_code = $row['user_type_code'];
				$hospital_id = $row['hospital_id'];
				$hospital_name = $row['hospital_name'];
				$hospital_code = $row['hospital_code'];
				$user_mobile = $row['user_mobile'];
				$user_phone = $row['user_phone'];
				$user_email = $row['user_email'];
				$user_dob = $row['user_dob'];
				$user_address = $row['user_address'];
				$user_user_name = $row['user_user_name'];
				$user_password = $row['user_password'];
				$user_status = $row['user_status'];

				$data[0] = $slno; 
				$data[1] = $user_name;
				$data[2] = $user_type_name;
				$data[3] = $user_mobile;
				$data[4] = $user_phone; 
				$data[5] = $user_email;
				$data[6] = $user_address;
				$data[7] = $activity_status[$user_status];
				if($_SESSION["user_type_code"] == 'dev' || $_SESSION["user_type_code"] == 'super' || $_SESSION["user_type_code"] == 'h_admin'){
					if($_SESSION["user_type_code"] == 'dev'){
						$data[8] = "<a href='javascript: void(0)' data-center_id='1'><i class='fa fa-edit' aria-hidden='true' onclick='editTableData(".$user_id.")'></i></a><a href='javascript: void(0)' data-center_id='1'> <i class='fa fa-trash' aria-hidden='true' onclick='deleteTableData(".$user_id.")'></i></a>";
					}else{
						$data[8] = "<a href='javascript: void(0)' data-center_id='1'><i class='fa fa-edit' aria-hidden='true' onclick='editTableData(".$user_id.")'></i></a>";
					}
				}else{
					$data[8] = "Restricted";
				}
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
		$user_id = $_POST['user_id'];

		$sql = "SELECT * FROM user_details WHERE user_id = '" .$user_id. "'";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;	
			$row = $result->fetch_array();	
			$user_id = $row['user_id'];
			$user_name = $row['user_name'];
			$user_type_id = $row['user_type_id']; 
			$hospital_id = $row['hospital_id']; 
			$user_mobile = $row['user_mobile'];
			$user_phone = $row['user_phone'];
			$user_email = $row['user_email'];
			$user_dob = $row['user_dob'];
			$user_address = $row['user_address'];
			$user_user_name = $row['user_user_name'];
			$user_password = $row['user_password'];
			$user_status = $row['user_status'];
		} else {
			$status = false;
		}
		//$mysqli->close();

			
		$return_array['user_id'] = $user_id;
		$return_array['user_name'] = $user_name;
		$return_array['user_type_id'] = $user_type_id;
		$return_array['hospital_id'] = $hospital_id;
		$return_array['user_mobile'] = $user_mobile;
		$return_array['user_phone'] = $user_phone;
		$return_array['user_email'] = $user_email;
		$return_array['user_dob'] = $user_dob;
		$return_array['user_address'] = $user_address;
		$return_array['user_user_name'] = $user_user_name;
		$return_array['user_password'] = $user_password;
		$return_array['user_status'] = $user_status;
		$return_array['status'] = $status;
		
    	echo json_encode($return_array);
	}//function end

	//Delete function
	if($fn == 'deleteTableData'){
		$return_result = array();
		$user_id = $_POST["user_id"];
		$status = true;	

		$sql = "DELETE FROM user_details WHERE user_id = '".$user_id."'";
		$result = $mysqli->query($sql); 

		$return_result['status'] = $status;
		//sleep(1);
		echo json_encode($return_result);
	}//end function deleteItem

	

	//Get Category name
	if($fn == 'getAllUserType'){
		$return_array = array();
		$status = true;
		$mainData = array(); 

		$sql = "SELECT * FROM user_type WHERE user_type_status = 1 ORDER BY user_type_name ASC";
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

		$return_array['status'] = $status;
		$return_array['data'] = $mainData;
		echo json_encode($return_array);
	}//end if

	//Get Course name
	if($fn == 'getAllHospitaName'){
		$return_array = array();
		$status = true;
		$mainData = array(); 

		$sql = "SELECT * FROM hospital_list WHERE hospital_status = 1 ORDER BY hospital_name ASC";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$hospital_id = $row['hospital_id'];	
				$hospital_name = $row['hospital_name'];			
				$hospital_code = $row['hospital_code'];		
				$hospital_address = $row['hospital_address'];
				$data = new stdClass();

				$data->hospital_id = $hospital_id;
				$data->hospital_name = $hospital_name;
				$data->hospital_code = $hospital_code;
				$data->hospital_address = $hospital_address;
				
				array_push($mainData, $data);
				$slno++;
			}
		} else {
			$status = false;
		} 

		$return_array['status'] = $status;
		$return_array['data'] = $mainData;
		echo json_encode($return_array);
	}//function end	

?>