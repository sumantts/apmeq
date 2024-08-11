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

		$designation = $_POST["designation"];		
		$highestQualification = $_POST["highestQualification"];		
		$secondaryEmail = $_POST["secondaryEmail"];		
		$dateOfJoining = $_POST["dateOfJoining"];	
		$teachingExperience = $_POST["teachingExperience"];	
		$researchInterest = $_POST["researchInterest"];	
		$indExperience = $_POST["indExperience"];	
		$author_id = $_POST["author_id"];	
		$introduction_id = $_POST["introduction_id"];
		
		try {
			if($introduction_id > 0){
				$status = true;
				$sql = "UPDATE introduction SET designation = '" .$designation. "', highest_quali = '" .$highestQualification. "', secondary_email = '" .$secondaryEmail. "', date_of_joining = '" .$dateOfJoining. "', teaching_experience = '" .$teachingExperience. "', research_interest = '" .$researchInterest. "', ind_exp = '" .$indExperience. "' WHERE introduction_id = '" .$introduction_id. "' ";
				$result = $mysqli->query($sql);
			}else{
				$status = true;
				$sql = "INSERT INTO introduction (author_id, designation, highest_quali, secondary_email, date_of_joining, teaching_experience, research_interest, ind_exp) VALUES ('".$author_id."', '".$designation."', '".$highestQualification."', '".$secondaryEmail."', '".$dateOfJoining."', '".$teachingExperience."', '".$researchInterest."', '".$indExperience."')";
				$result = $mysqli->query($sql);
				$introduction_id = $mysqli->insert_id;
			}
				
		} catch (PDOException $e) {
			die("Error occurred:" . $e->getMessage());
		}

		$return_result['status'] = $status;
		$return_result['author_id'] = $author_id;
		$return_result['introduction_id'] = $introduction_id;
		sleep(2);
		echo json_encode($return_result);
	}//Save function end	

	//function start
	if($fn == 'getTableData'){
		$return_array = array();
		$status = true;
		$mainData = array();

		$slno = 1;
		$data[0] = $slno;
		$data[1] = 'Automated Wireless Sensor’s Energy Saving System';
		$data[2] = '201711016938, 15/05/2017';
		$data[3] = 'Official Journal of the Patent Office';
		$data[4] = '46/2018 Dated 16/11/2018';
		$data[5] = "<a href='javascript: void(0)' data-category_id='.$slno.'><i class='fa fa-edit' aria-hidden='true' onclick='editTableData(".$slno.")'></i></a> <a href='javascript: void(0)' data-category_id='.$slno.'> <i class='fa fa-trash' aria-hidden='true' onclick='deleteTableData(".$slno.")'></i></a>";
		array_push($mainData, $data);

		$slno = 2;
		$data[0] = $slno;
		$data[1] = 'A System and Method for Detection of Wallet Using IoT Sensor';
		$data[2] = '201811013632, 10/04/2018';
		$data[3] = 'Official Journal of the Patent Office';
		$data[4] = '41/2019 Dated 11/10/2019';
		$data[5] = "<a href='javascript: void(0)' data-category_id='.$slno.'><i class='fa fa-edit' aria-hidden='true' onclick='editTableData(".$slno.")'></i></a> <a href='javascript: void(0)' data-category_id='.$slno.'> <i class='fa fa-trash' aria-hidden='true' onclick='deleteTableData(".$slno.")'></i></a>";
		array_push($mainData, $data);
		

		$return_array['data'] = $mainData;
    	echo json_encode($return_array);
	}//function end	

	//function start
	if($fn == 'getFormEditData'){
		$return_array = array();
		$status = true;
		$mainData = array();
		$category_id = $_POST['category_id'];

		$sql = "SELECT * FROM introduction WHERE category_id = '" .$category_id. "' ";
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

		$sql = "DELETE FROM introduction WHERE category_id = '".$category_id."'";
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

		$sql = "SELECT * FROM introduction WHERE activity_status = 'active' ORDER BY category_name ASC";
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