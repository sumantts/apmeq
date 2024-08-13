<?php
	include('../assets/php/sql_conn.php');
	$fn = '';
	if(isset($_POST["fn"])){
	$fn = $_POST["fn"];
	}
	
	//Login function
	if($fn == 'doLogin'){
		$return_result = array();
		$username = $_POST["username"];
		$password = $_POST["password"];
		$status = true;
		$message = ''; 		
		
		try {
			$sql = "SELECT user_details.user_id, user_details.user_name, user_details.user_type_id, user_details.hospital_id, user_details.user_mobile, user_details.user_phone, user_details.user_email, user_details.user_dob, user_details.user_address, user_details.user_user_name, user_details.user_password, user_details.user_status, user_type.user_type_name, user_type.user_type_code, user_type.user_type_status FROM user_details JOIN user_type ON user_details.user_type_id = user_type.user_type_id WHERE user_details.user_user_name = '".$username."' AND user_details.user_password = '".$password."' AND user_type.user_type_status = 1";
			$result = $mysqli->query($sql);

			if ($result->num_rows > 0) {		
				$row = $result->fetch_array();	
				$user_status = $row['user_status'];
				$user_type_id = $row['user_type_id']; 
				$user_type_name = $row['user_type_name'];				
				$user_type_code = $row['user_type_code'];

				if($user_status == 1){
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
					$user_type_status = $row['user_type_status'];	

					$_SESSION["user_id"] = $user_id;
					$_SESSION["user_name"] = $user_name;			
					$_SESSION["user_type_id"] = $user_type_id;			
					$_SESSION["hospital_id"] = $hospital_id;			
					$_SESSION["user_mobile"] = $user_mobile;			
					$_SESSION["user_phone"] = $user_phone;			
					$_SESSION["user_email"] = $user_email;		
					$_SESSION["user_dob"] = $user_dob;		
					$_SESSION["user_address"] = $user_address;		
					$_SESSION["user_user_name"] = $user_user_name;		
					$_SESSION["user_password"] = $user_password; 
						
					$_SESSION["user_type_name"] = $user_type_name; 	
					$_SESSION["user_type_code"] = $user_type_code; 	
					$_SESSION["user_type_status"] = $user_type_status; 
				}else{
					$status = false; 
					if($user_type_code == 'super'){
						$message = 'Account Inactive, please contact to Developer';
					}else if($user_type_code == 'h_admin'){
						$message = 'Account Inactive, please contact to Super Admin';
					}else{
						$message = 'Account Inactive, please contact to Hospital Admin';
					}
				}
			} else {
				$status = false;
				$message = 'Wrong Username or password';
			}
			//$mysqli->close();
		} catch (PDOException $e) {
			die("Error occurred:" . $e->getMessage());
		}

		$return_result['status'] = $status;
		$return_result['message'] = $message;
		//sleep(2);
		echo json_encode($return_result);
	}//end function doLogin
	
	//Login function
	if($fn == 'updateProfile'){
		$return_result = array();
		$profile_name = $_POST["profile_name"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$author_photo = $_POST["author_photo"];
		$login_id = $_SESSION["login_id"];
		$author_id = $_SESSION["author_id"];
		$status = true;			
		
		$sql = "UPDATE login SET profile_name = '" .$profile_name. "', username = '".$username."', password = '".$password."' WHERE login_id = '" .$login_id. "'";
		$result = $mysqli->query($sql);

		//Update Author Table
		if($author_photo != ''){
			$sql1 = "UPDATE author_details SET author_name = '" .$profile_name. "', email = '".$username."', author_photo = '".$author_photo."' WHERE author_id = '" .$author_id. "'";
		}else{
			$sql1 = "UPDATE author_details SET author_name = '" .$profile_name. "', email = '".$username."' WHERE author_id = '" .$author_id. "'";
		}
		$result1 = $mysqli->query($sql1);

		$ststus = true;
		//$mysqli->close();

		$return_result['status'] = $status;
		//sleep(2);
		echo json_encode($return_result);
	}//end function doLogin

    ?>