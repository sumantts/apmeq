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

		$category_id = $_POST["category_id"];		
		$category_name = $_POST["category_name"];		
		$category_slug = strtolower($_POST["category_slug"]);		
		$activity_status = $_POST["activity_status"];
		
		try {
			if($category_id > 0){
				$status = true;
				$sql = "UPDATE category_list SET category_name = '" .$category_name. "', category_slug = '" .$category_slug. "', activity_status = '" .$activity_status. "' WHERE category_id = '" .$category_id. "' ";
				$result = $mysqli->query($sql);
			}else{
				$status = true;
				$sql = "INSERT INTO category_list (category_name, category_slug, activity_status) VALUES ('".$category_name."','".$category_slug."', '".$activity_status."')";
				$result = $mysqli->query($sql);
			}
				
		} catch (PDOException $e) {
			die("Error occurred:" . $e->getMessage());
		}
		$return_result['status'] = $status;
		sleep(2);
		echo json_encode($return_result);
	}//Save function end	

	//function start
	if($fn == 'getTableData'){
		$return_array = array();
		$status = true;
		$mainData = array();
		$author_bio1 = '';
		$sql = "SELECT * FROM category_list ORDER BY category_name";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$category_id = $row['category_id'];		
				$category_name = $row['category_name'];	
				$category_slug = $row['category_slug'];		
				$activity_status = $row['activity_status'];	

				$data[0] = $slno;
				$data[1] = $category_name;
				$data[2] = $category_slug;
				$data[3] =  ucfirst($activity_status);
				$data[4] = "<a href='javascript: void(0)' data-category_id='.$category_id.'><i class='fa fa-edit' aria-hidden='true' onclick='editTableData(".$category_id.")'></i></a> <a href='javascript: void(0)' data-category_id='.$category_id.'> <i class='fa fa-trash' aria-hidden='true' onclick='deleteTableData(".$category_id.")'></i></a>";

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
		$category_id = $_POST['category_id'];

		$sql = "SELECT * FROM category_list WHERE category_id = '" .$category_id. "' ";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;	
			$row = $result->fetch_array();
			
			$category_id = $row['category_id'];		
			$category_name = $row['category_name'];	
			$category_slug = $row['category_slug'];		
			$activity_status = $row['activity_status'];	
		} else {
			$status = false;
		}
		//$mysqli->close();
			
		$return_array['category_id'] = $category_id;
		$return_array['category_name'] = $category_name;
		$return_array['category_slug'] = $category_slug;
		$return_array['activity_status'] = $activity_status;

		$return_array['status'] = $status;
    	echo json_encode($return_array);
	}//function end

	//Delete function
	if($fn == 'deleteTableData'){
		$return_result = array();
		$category_id = $_POST["category_id"];
		$status = true;	

		$sql = "DELETE FROM category_list WHERE category_id = '".$category_id."'";
		$result = $mysqli->query($sql);
		$return_result['status'] = $status;
		sleep(1);
		echo json_encode($return_result);
	}//end function deleteItem

	//Get Category name
	if($fn == 'getAllCategoryName'){
		$return_array = array();
		$status = true;
		$mainData = array();

		$sql = "SELECT * FROM category_list WHERE activity_status = 'active' ORDER BY category_name ASC";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			$status = true;
			$slno = 1;
			while($row = $result->fetch_array()){
				$category_id = $row['category_id'];	
				$category_name = $row['category_name'];			
				$category_slug = $row['category_slug'];
				$data = new stdClass();

				$data->category_id = $category_id;
				$data->category_name = $category_name;
				$data->category_slug = $category_slug;
				
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