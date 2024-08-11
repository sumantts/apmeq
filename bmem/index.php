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

		case 'fee_particulars':
			$title = "Fee Particulars";
			include('setup/fee_particulars/fee_particulars.php');		
		break; 	

		case 'course_fee':
			$title = "Course Fee";
			include('setup/course_fee/course_fee.php');		
		break; 	 	

		case 'collect_course_fee':
			$title = "Collect Course Fee";
			include('setup/collect_course_fee/collect_course_fee.php');		
		break; 	

		case 'students':
			$title = "students";
			include('setup/students/students.php');		
		break; 
		
		case 'introduction':
			$title = "Introduction";
			include('setup/introduction/introduction.php');		
		break;

		//Reports		
		case 'collected_fees':
			$title = "Collected Fees";
			include('reports/collected_fees/collected_fees.php');		
		break;

		case 'paid_fees':
			$title = "Paid Fees";
			include('reports/paid_fees/paid_fees.php');		
		break;
						
		default:
		include('signin/signin.php');
	}
    

?>