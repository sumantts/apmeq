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
		$password = '12345678';
		$status = true;

		$asset_detail_id = $_POST["asset_detail_id"];	
		$category_id = $_POST["category_id"];	
		$for_the_year = $_POST["for_the_year"];
		$author_name = $_POST["author_name"];
		$email = $_POST["email"];	
		$registration_number = $_POST["registration_number"];
		$author_photo = $_POST["author_photo"];	
		$author_status = $_POST["author_status"];
		
		try {
			if($asset_detail_id > 0){
				$status = true;
				$sql = "UPDATE author_details SET category_id = '" .$category_id. "', for_the_year = '" .$for_the_year. "', author_name = '" .$author_name. "', email = '" .$email. "', registration_number = '" .$registration_number. "', author_photo = '" .$author_photo. "', author_status = '" .$author_status. "' WHERE asset_detail_id = '" .$asset_detail_id. "' ";
				$result = $mysqli->query($sql);

				//Update login table
				$sql1 = "UPDATE login SET profile_name = '" .$author_name. "', username = '" .$email. "', password = '" .$password. "' WHERE asset_detail_id = '" .$asset_detail_id. "' ";
				$result1 = $mysqli->query($sql1);
			}else{
				$check_sql = "SELECT * FROM author_details WHERE email = '" .$email. "' ";
				$check_result = $mysqli->query($check_sql);

				if ($check_result->num_rows > 0) {
					$return_result['error_message'] = 'This email already exist';
					$status = false;
				}else{
					$sql = "INSERT INTO author_details (category_id, for_the_year, author_name, email, registration_number, author_photo) VALUES ('" .$category_id. "', '" .$for_the_year. "', '" .$author_name. "', '" .$email. "', '" .$registration_number. "', '" .$author_photo. "')";
					$result = $mysqli->query($sql);
					$insert_id = $mysqli->insert_id;
					if($insert_id > 0){
						$status = true;

						//Insert into login table
						$sql1 = "INSERT INTO login (asset_detail_id, profile_name, username, password) VALUES ('" .$insert_id. "', '" .$author_name. "', '" .$email. "', '" .$password. "')";
						$result1 = $mysqli->query($sql1);
						$insert_id1 = $mysqli->insert_id;
					}else{
						$return_result['error_message'] = 'Photo size is soo large';
						$status = false;
					}	
				}//end if	
			}	
		} catch (PDOException $e) {
			die("Error occurred:" . $e->getMessage());
		}
		$return_result['status'] = $status;
		$return_result['login_id'] = $insert_id1;
		//sleep(2);
		echo json_encode($return_result);
	}//Save function end	

	//function start
	if($fn == 'getTableData'){
		$return_array = array();
		$status = true;
		$mainData = array();
		$email1 = '';
		$sql = "SELECT * FROM asset_details ORDER BY name_of_asset";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;

			while($row = $result->fetch_array()){
				$asset_detail_id = $row['asset_detail_id'];
				$name_of_asset = $row['name_of_asset'];
				$department_id = $row['department_id'];
				$hospital_id = $row['hospital_id'];
				$asset_code = $row['asset_code'];
				$manufacturer_id = $row['manufacturer_id'];
				$model_name = $row['model_name'];
				$supplier_id = $row['supplier_id'];
				$asset_slno = $row['asset_slno'];
				$equipment_name = $row['equipment_name'];
				$installation_date = $row['installation_date'];
				$total_year_in_service = $row['total_year_in_service'];
				$calibration_last_date = $row['calibration_last_date'];
				$calibration_frequency = $row['calibration_frequency'];
				$preventive_maintain_last_date = $row['preventive_maintain_last_date'];
				$preventive_maintenance_frequency = $row['preventive_maintenance_frequency'];
				$warenty = $row['warenty'];
				$amc = $row['amc'];
				$amc_last_date = $row['amc_last_date'];
				$cmc = $row['cmc'];
				$cmc_last_date = $row['cmc_last_date'];
				$service_providers_id = $row['service_providers_id'];
				$files_attached = $row['files_attached'];
				$reallocate_id = $row['reallocate_id'];
				$qa_certificate = $row['qa_certificate'];
				$qa_certificate_last_date = $row['qa_certificate_last_date'];
				$asset_status = $row['asset_status'];
				

				$data[0] = $slno; 
				$data[1] = $name_of_asset;
				$data[2] = $department_id;
				$data[3] = $manufacturer_id;
				$data[4] = $supplier_id;
				$data[5] = $installation_date;
				$data[6] = $total_year_in_service;
				$data[7] = $calibration_last_date;
				$data[8] = $calibration_frequency;
				$data[9] = $service_providers_id;
				$data[10] = $service_providers_id;
				$data[11] = $activity_status[$asset_status];
				if($_SESSION["user_type_code"] == 'dev' || $_SESSION["user_type_code"] == 'super'){
					$data[12] = "<a href='javascript: void(0)' data-center_id='1'><i class='fa fa-edit' aria-hidden='true' onclick='editTableData(".$asset_detail_id.")'></i></a><a href='javascript: void(0)' data-center_id='1'> <i class='fa fa-trash' aria-hidden='true' onclick='deleteTableData(".$asset_detail_id.")'></i></a>";
				}else{
					$data[12] = "Restricted";
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
		$asset_detail_id = $_POST['asset_detail_id'];

		$sql = "SELECT * FROM author_details WHERE asset_detail_id = '" .$asset_detail_id. "'";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;	
			$row = $result->fetch_array();
			$asset_detail_id = $row['asset_detail_id'];		
			$category_id = $row['category_id'];		
			$for_the_year = $row['for_the_year'];			
			$author_name = $row['author_name'];		
			$email = $row['email'];				
			$registration_number = $row['registration_number'];			
			$author_status = $row['author_status'];	
			if($row['author_photo'] != ''){
				$author_photo = $row['author_photo'];	
			}else{
				$author_photo = '';
			}
		} else {
			$status = false;
		}
		//$mysqli->close();

		$return_array['author_name'] = $author_name;
		$return_array['category_id'] = $category_id;
		$return_array['for_the_year'] = $for_the_year;
		$return_array['email'] = $email;
		$return_array['registration_number'] = $registration_number;
		$return_array['author_photo'] = $author_photo;
		$return_array['author_status'] = $author_status;
		$return_array['status'] = $status;
    	echo json_encode($return_array);
	}//function end

	//Delete function
	if($fn == 'deleteTableData'){
		$return_result = array();
		$asset_detail_id = $_POST["asset_detail_id"];
		$status = true;	

		$sql = "DELETE FROM author_details WHERE asset_detail_id = '".$asset_detail_id."'";
		$result = $mysqli->query($sql);

		//Delete from Login table
		$sql1 = "DELETE FROM login WHERE asset_detail_id = '".$asset_detail_id."'";
		$result1 = $mysqli->query($sql1);

		$return_result['status'] = $status;
		//sleep(1);
		echo json_encode($return_result);
	}//end function deleteItem

	

	//Get Supplier name
	if($fn == 'getAllSupplierName'){
		$return_array = array();
		$status = true;
		$mainData = array();
		$parent_category_id = 0;

		$sql = "SELECT * FROM supplier_list WHERE supplier_status = 1 ORDER BY supplier_name ASC";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$supplier_id = $row['supplier_id'];	
				$supplier_name = $row['supplier_name'];			
				$supplier_code = $row['supplier_code'];
				$data = new stdClass();

				$data->supplier_id = $supplier_id;
				$data->supplier_name = $supplier_name;
				$data->supplier_code = $supplier_code;
				
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
	if($fn == 'getAllCourseName'){
		$return_array = array();
		$status = true;
		$mainData = array(); 

		/*$sql = "SELECT * FROM course_fee_detail ORDER BY course_name ASC";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$course_id = $row['course_id'];	
				$course_name = $row['course_name'];			
				$course_fee = $row['course_fee'];		
				$course_duration = $row['course_duration'];
				$data = new stdClass();

				$data->course_id = $course_id;
				$data->course_name = $course_name;
				$data->course_fee = $course_fee;
				$data->course_duration = $course_duration;
				
				array_push($mainData, $data);
				$slno++;
			}
		} else {
			$status = false;
		} */

		$return_array['status'] = $status;
		$return_array['data'] = $mainData;
		echo json_encode($return_array);
	}//function end	

	//Get Authors name
	if($fn == 'getAllDepartmentName'){
		$return_array = array();
		$status = true;
		$mainData = array();

		$sql = "SELECT * FROM department_list WHERE department_status = 1 ORDER BY department_name ASC";
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

	//Get Manufacturer name
	if($fn == 'getAllManufacturerName'){
		$return_array = array();
		$status = true;
		$mainData = array();

		$sql = "SELECT * FROM manufacturer_list WHERE manufacturer_status = 1 ORDER BY manufacturer_name ASC";
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

?>