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

		
		$asset_detail_id = $_POST['asset_detail_id']; 
		$name_of_asset = $_POST['name_of_asset']; 
		$department_id = $_POST['department_id']; 
		$hospital_id = $_POST['hospital_id']; 
		$asset_code = $_POST['asset_code']; 
		$manufacturer_id = $_POST['manufacturer_id']; 
		$model_name = $_POST['model_name']; 
		$supplier_id = $_POST['supplier_id']; 
		$asset_slno = $_POST['asset_slno']; 
		$equipment_name = $_POST['equipment_name']; 
		$installation_date = $_POST['installation_date']; 
		$total_year_in_service = $_POST['total_year_in_service']; 
		$calibration_last_date = $_POST['calibration_last_date']; 
		$calibration_frequency = $_POST['calibration_frequency']; 
		$preventive_maintain_last_date = $_POST['preventive_maintain_last_date']; 
		$preventive_maintenance_frequency = $_POST['preventive_maintenance_frequency']; 
		$warenty = $_POST['warenty']; 
		$amc = $_POST['amc']; 
		$amc_last_date = $_POST['amc_last_date']; 
		$cmc = $_POST['cmc']; 
		$cmc_last_date = $_POST['cmc_last_date']; 
		$service_providers_id = $_POST['service_providers_id']; 
		$files_attached = $_POST['files_attached']; 
		$reallocate_id = 0;//$_POST['reallocate_id']; 
		$qa_certificate = $_POST['qa_certificate']; 
		$qa_certificate_last_date = $_POST['qa_certificate_last_date']; 
		$asset_status = $_POST['asset_status'];
		
		try {
			if($asset_detail_id > 0){
				$status = true;
				$sql = "UPDATE asset_details SET name_of_asset = '" .$name_of_asset. "', department_id = '" .$department_id. "', hospital_id = '" .$hospital_id. "', asset_code = '" .$asset_code. "', manufacturer_id = '" .$manufacturer_id. "', model_name = '" .$model_name. "', supplier_id = '" .$supplier_id. "', asset_slno = '" .$asset_slno. "', equipment_name = '" .$equipment_name. "', installation_date = '" .$installation_date. "', total_year_in_service = '" .$total_year_in_service. "', calibration_last_date = '" .$calibration_last_date. "', calibration_frequency = '" .$calibration_frequency. "', preventive_maintain_last_date = '" .$preventive_maintain_last_date. "', preventive_maintenance_frequency = '" .$preventive_maintenance_frequency. "', warenty = '" .$warenty. "', amc = '" .$amc. "', amc_last_date = '" .$amc_last_date. "', cmc = '" .$cmc. "', cmc_last_date = '" .$cmc_last_date. "', service_providers_id = '" .$service_providers_id. "', files_attached = '" .$files_attached. "', reallocate_id = '" .$reallocate_id. "', qa_certificate = '" .$qa_certificate. "', qa_certificate_last_date = '" .$qa_certificate_last_date. "', asset_status = '" .$asset_status. "' WHERE asset_detail_id = '" .$asset_detail_id. "'";
				$result = $mysqli->query($sql);				
			}else{
				$sql = "INSERT INTO asset_details (name_of_asset, department_id, hospital_id, asset_code, manufacturer_id, model_name, supplier_id, asset_slno, equipment_name, installation_date, total_year_in_service, calibration_last_date, calibration_frequency, preventive_maintain_last_date, preventive_maintenance_frequency, warenty, amc, amc_last_date, cmc, cmc_last_date, service_providers_id, files_attached, reallocate_id, qa_certificate, qa_certificate_last_date, asset_status) VALUES ('" .$name_of_asset. "', '" .$department_id. "', '" .$hospital_id. "', '" .$asset_code. "', '" .$manufacturer_id. "', '" .$model_name. "', '" .$supplier_id. "', '" .$asset_slno. "', '" .$equipment_name. "', '" .$installation_date. "', '" .$total_year_in_service. "', '" .$calibration_last_date. "', '" .$calibration_frequency. "', '" .$preventive_maintain_last_date. "', '" .$preventive_maintenance_frequency. "', '" .$warenty. "', '" .$amc. "', '" .$amc_last_date. "', '" .$cmc. "', '" .$cmc_last_date. "', '" .$service_providers_id. "', '" .$files_attached. "', '" .$reallocate_id. "', '" .$qa_certificate. "', '" .$qa_certificate_last_date. "', '" .$asset_status. "')";
				$result = $mysqli->query($sql);
				$asset_detail_id = $mysqli->insert_id;
				if($asset_detail_id > 0){
					$status = true;					
				}	
			}	
		} catch (PDOException $e) {
			die("Error occurred:" . $e->getMessage());
		}
		$return_result['status'] = $status;
		$return_result['asset_detail_id'] = $asset_detail_id;
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

		$sql = "SELECT * FROM asset_details WHERE asset_detail_id = '" .$asset_detail_id. "'";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;	
			$row = $result->fetch_array();
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
		} else {
			$status = false;
		}
		//$mysqli->close();
		
		$return_array['asset_detail_id'] = $asset_detail_id;
		$return_array['name_of_asset'] = $name_of_asset;
		$return_array['department_id'] = $department_id;
		$return_array['hospital_id'] = $hospital_id;
		$return_array['asset_code'] = $asset_code;
		$return_array['manufacturer_id'] = $manufacturer_id;
		$return_array['model_name'] = $model_name;
		$return_array['supplier_id'] = $supplier_id;
		$return_array['asset_slno'] = $asset_slno;
		$return_array['equipment_name'] = $equipment_name;
		$return_array['installation_date'] = $installation_date;
		$return_array['total_year_in_service'] = $total_year_in_service;
		$return_array['calibration_last_date'] = $calibration_last_date;
		$return_array['calibration_frequency'] = $calibration_frequency;
		$return_array['preventive_maintain_last_date'] = $preventive_maintain_last_date;
		$return_array['preventive_maintenance_frequency'] = $preventive_maintenance_frequency;
		$return_array['warenty'] = $warenty;
		$return_array['amc'] = $amc;
		$return_array['amc_last_date'] = $amc_last_date;
		$return_array['cmc'] = $cmc;
		$return_array['cmc_last_date'] = $cmc_last_date;
		$return_array['service_providers_id'] = $service_providers_id;
		$return_array['files_attached'] = $files_attached;
		$return_array['reallocate_id'] = $reallocate_id;
		$return_array['qa_certificate'] = $qa_certificate;
		$return_array['qa_certificate_last_date'] = $qa_certificate_last_date;
		$return_array['asset_status'] = $asset_status;
		$return_array['status'] = $status;
    	echo json_encode($return_array);
	}//function end

	//Delete function
	if($fn == 'deleteTableData'){
		$return_result = array();
		$asset_detail_id = $_POST["asset_detail_id"];
		$status = true;	

		$sql = "DELETE FROM asset_details WHERE asset_detail_id = '".$asset_detail_id."'";
		$result = $mysqli->query($sql);
		

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
	if($fn == 'getAllServiceProvidersName'){
		$return_array = array();
		$status = true;
		$mainData = array(); 

		$sql = "SELECT * FROM service_providers_list WHERE service_providers_status = 1 ORDER BY service_providers_name ASC";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$service_providers_id = $row['service_providers_id'];	
				$service_providers_name = $row['service_providers_name']; 

				$data = new stdClass();
				$data->service_providers_id = $service_providers_id;
				$data->service_providers_name = $service_providers_name; 
				
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