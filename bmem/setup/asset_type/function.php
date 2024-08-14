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

		$asset_type_id = $_POST["asset_type_id"];		
		$asset_type_name = $_POST["asset_type_name"];		
		$asset_type_code = $_POST["asset_type_code"];		
		$asset_type_status = $_POST["asset_type_status"];
		
		try {
			if($asset_type_id > 0){
				$status = true;
				$sql = "UPDATE asset_type_list SET asset_type_name = '" .$asset_type_name. "', asset_type_code = '" .$asset_type_code. "', asset_type_status = '" .$asset_type_status. "' WHERE asset_type_id = '" .$asset_type_id. "' ";
				$result = $mysqli->query($sql);
			}else{
				$status = true;
				$sql = "INSERT INTO asset_type_list (asset_type_name, asset_type_code, asset_type_status) VALUES ('".$asset_type_name."','".$asset_type_code."', '".$asset_type_status."')";
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
		$sql = "SELECT * FROM asset_type_list ORDER BY asset_type_name";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$asset_type_id = $row['asset_type_id'];		
				$asset_type_name = $row['asset_type_name'];	
				$asset_type_code = $row['asset_type_code'];		
				$asset_type_status = $row['asset_type_status'];	

				$data[0] = $slno;
				$data[1] = $asset_type_name;
				$data[2] = $asset_type_code;
				$data[3] = $activity_status[$asset_type_status];
				$data[4] = "<a href='javascript: void(0)' data-asset_type_id='.$asset_type_id.'><i class='fa fa-edit' aria-hidden='true' onclick='editTableData(".$asset_type_id.")'></i></a> <a href='javascript: void(0)' data-asset_type_id='.$asset_type_id.'> <i class='fa fa-trash' aria-hidden='true' onclick='deleteTableData(".$asset_type_id.")'></i></a>";

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
		$asset_type_id = $_POST['asset_type_id'];

		$sql = "SELECT * FROM asset_type_list WHERE asset_type_id = '" .$asset_type_id. "' ";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;	
			$row = $result->fetch_array();
			
			$asset_type_id = $row['asset_type_id'];		
			$asset_type_name = $row['asset_type_name'];	
			$asset_type_code = $row['asset_type_code'];		
			$asset_type_status = $row['asset_type_status'];	
		} else {
			$status = false;
		}
		//$mysqli->close();
			
		$return_array['asset_type_id'] = $asset_type_id;
		$return_array['asset_type_name'] = $asset_type_name;
		$return_array['asset_type_code'] = $asset_type_code;
		$return_array['asset_type_status'] = $asset_type_status;

		$return_array['status'] = $status;
    	echo json_encode($return_array);
	}//function end

	//Delete function
	if($fn == 'deleteTableData'){
		$return_result = array();
		$asset_type_id = $_POST["asset_type_id"];
		$status = true;	

		$sql = "DELETE FROM asset_type_list WHERE asset_type_id = '".$asset_type_id."'";
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

		$sql = "SELECT * FROM asset_type_list WHERE asset_type_status = 'active' ORDER BY asset_type_name ASC";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$asset_type_id = $row['asset_type_id'];	
				$asset_type_name = $row['asset_type_name'];			
				$asset_type_code = $row['asset_type_code'];
				$data = new stdClass();

				$data->asset_type_id = $asset_type_id;
				$data->asset_type_name = $asset_type_name;
				$data->asset_type_code = $asset_type_code;
				
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