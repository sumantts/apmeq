<?php
	include('assets/php/sql_conn.php');	
	
	if(isset($_GET["p"])){
		$p = $_GET["p"];
	}else{
		$p = '';
	}
	
	if(isset($_GET["gr"])){
		$gr = $_GET["gr"];
	}else{
		$gr = '';
	}

	switch($p){
		case 'signin':
        $title = "Signin";
		include('signin/signin.php');
		break;

		case 'signup':
        $title = "Signup";
		include('signup/signup.php');
		break;
		
		case 'dashboard':
		$title = "Dashboard";
		include('dashboard/dashboard.php');		
		break;

		//SETUP		
		case 'department':
			$title = "Department";
			include('setup/department/department.php');		
		break; 	

		case 'hospital-details':
			$title = "Hospital Details";
			include('setup/hospital_details/hospital_details.php');		
		break; 	

		case 'user-type':
			$title = "User Type";
			include('setup/user_type/user_type.php');		
		break; 	

		case 'students':
			$title = "students";
			include('setup/students/students.php');		
		break; 
					
		case 'asset-type':
			$title = "Asset Type";
			include('setup/asset_type/asset_type.php');		
		break;

		case 'paid_fees':
			$title = "Paid Fees";
			include('reports/paid_fees/paid_fees.php');		
		break;
						
		//DETAILS	 	
		case 'user-details':
			$title = "User Details";
			include('details/user_details/user_details.php');		
		break; 	

		case 'asset-details':
			$title = "Asset Details";
			include('details/asset_details/asset_details.php');		
		break; 

		default:
		include('signin/signin.php');
	}
    

?>