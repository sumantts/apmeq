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

		$supplier_id = $_POST["supplier_id"];		
		$supplier_name = $_POST["supplier_name"];		
		$supplier_code = $_POST["supplier_code"];				
		$primary_contact_number = $_POST["primary_contact_number"];			
		$secondary_contact_number = $_POST["secondary_contact_number"];	
		$supplier_status = $_POST["supplier_status"];
		
		try {
			if($supplier_id > 0){
				$status = true;
				$sql = "UPDATE supplier_list SET supplier_name = '" .$supplier_name. "', supplier_code = '" .$supplier_code. "', primary_contact_number = '" .$primary_contact_number. "', secondary_contact_number = '" .$secondary_contact_number. "', supplier_status = '" .$supplier_status. "' WHERE supplier_id = '" .$supplier_id. "' ";
				$result = $mysqli->query($sql);
			}else{
				$status = true;
				$sql = "INSERT INTO supplier_list (supplier_name, supplier_code, primary_contact_number, secondary_contact_number, supplier_status) VALUES ('".$supplier_name."','".$supplier_code."', '" .$primary_contact_number. "', '" .$secondary_contact_number. "', '".$supplier_status."')";
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
		$sql = "SELECT * FROM supplier_list ORDER BY supplier_name";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$supplier_id = $row['supplier_id'];		
				$supplier_name = $row['supplier_name'];	
				$supplier_code = $row['supplier_code'];		
				$primary_contact_number = $row['primary_contact_number'];	
				$secondary_contact_number = $row['secondary_contact_number'];	
				$supplier_status = $row['supplier_status'];	

				$data[0] = $slno;
				$data[1] = $supplier_name;
				$data[2] = $supplier_code;
				$data[3] = $primary_contact_number;
				$data[4] = $secondary_contact_number;
				$data[5] = $activity_status[$supplier_status];
				$data[6] = "<a href='javascript: void(0)' data-supplier_id='.$supplier_id.'><i class='fa fa-edit' aria-hidden='true' onclick='editTableData(".$supplier_id.")'></i></a> <a href='javascript: void(0)' data-supplier_id='.$supplier_id.'> <i class='fa fa-trash' aria-hidden='true' onclick='deleteTableData(".$supplier_id.")'></i></a>";

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
		$supplier_id = $_POST['supplier_id'];

		$sql = "SELECT * FROM supplier_list WHERE supplier_id = '" .$supplier_id. "' ";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;	
			$row = $result->fetch_array();
			
			$supplier_id = $row['supplier_id'];		
			$supplier_name = $row['supplier_name'];	
			$supplier_code = $row['supplier_code'];		
			$primary_contact_number = $row['primary_contact_number'];
			$secondary_contact_number = $row['secondary_contact_number'];
			$supplier_status = $row['supplier_status'];	
		} else {
			$status = false;
		}
		//$mysqli->close();
			
		$return_array['supplier_id'] = $supplier_id;
		$return_array['supplier_name'] = $supplier_name;
		$return_array['supplier_code'] = $supplier_code;
		$return_array['primary_contact_number'] = $primary_contact_number;
		$return_array['secondary_contact_number'] = $secondary_contact_number;
		$return_array['supplier_status'] = $supplier_status;

		$return_array['status'] = $status;
    	echo json_encode($return_array);
	}//function end

	//Delete function
	if($fn == 'deleteTableData'){
		$return_result = array();
		$supplier_id = $_POST["supplier_id"];
		$status = true;	

		$sql = "DELETE FROM supplier_list WHERE supplier_id = '".$supplier_id."'";
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

		$sql = "SELECT * FROM supplier_list WHERE supplier_status = 'active' ORDER BY supplier_name ASC";
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