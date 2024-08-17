<?php
	include('../../assets/php/sql_conn.php');
    
    $return_data = array();
    $status = true;
    $message = '';
    $all_images_en = '';

    $asset_detail_id = $_POST['asset_detail_id'];
    $filename = $_FILES["upload_image"]["name"];
    $u_id = uniqid(); 
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $new_file_name = $u_id.'.'.$ext;

    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png'){
        $status = true;
        move_uploaded_file($_FILES["upload_image"]["tmp_name"], 'photos/'.$new_file_name);

        $all_images = array();
        

		$sql = "SELECT files_attached FROM asset_details WHERE asset_detail_id = '" .$asset_detail_id. "' ";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) { 
			$row = $result->fetch_array(); 
			$all_images_en = $row['files_attached'];	
            if($all_images_en != ''){
                $all_images_de = json_decode($all_images_en);
                $all_images = $all_images_de;
            } //end if
        }//end if
        array_push($all_images, $new_file_name);
        $files_attached_en = json_encode($all_images);
        
        $upd_sql = "UPDATE asset_details SET files_attached = '" .$files_attached_en. "' WHERE asset_detail_id = '" .$asset_detail_id. "' ";
        $mysqli->query($upd_sql);

    }else{
        $message = 'File Extention not supported';
    }

    $return_data['status'] = $status;
    $return_data['ext'] = $ext; 
    $return_data['asset_detail_id'] = $asset_detail_id;
    $return_data['new_file_name'] = $new_file_name;
    $return_data['message'] = $message;
    echo json_encode($return_data);
 
?>