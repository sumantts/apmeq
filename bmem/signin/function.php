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
		
		//$v = "'".$param1."','".$param2."'";		
		
		try {
			$sql = "SELECT login.login_id, login.author_id, login.user_level, login.username, login.password, login.profile_name, author_details.author_status, author_details.author_photo FROM login JOIN author_details ON author_details.author_id = login.author_id WHERE login.username = '".$username."' AND login.password = '".$password."'";
			$result = $mysqli->query($sql);

			if ($result->num_rows > 0) {		
				$row = $result->fetch_array();	
				$author_status = $row['author_status'];
				if($author_status == 'active'){
					$login_id = $row['login_id'];
					$author_id = $row['author_id'];	
					$user_level = $row['user_level'];		
					$username = $row['username'];			
					$password = $row['password'];			
					$profile_name = $row['profile_name'];			
					$author_photo = $row['author_photo'];

					$_SESSION["username"] = $username;
					$_SESSION["password"] = $password;			
					$_SESSION["profile_name"] = $profile_name;			
					$_SESSION["login_id"] = $login_id;			
					$_SESSION["author_id"] = $author_id;			
					$_SESSION["user_level"] = $user_level;			
					$_SESSION["author_photo"] = $author_photo;
				}else{
					$status = false;
					$message = 'Account Inactive';
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
		sleep(2);
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
		sleep(2);
		echo json_encode($return_result);
	}//end function doLogin

    ?>