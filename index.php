<?php
	//include('assets/php/sql_conn.php');	
	
	if(isset($_GET["p"])){
		$p = $_GET["p"];
	}else{
		$p = '';
	} 

	switch($p){ 		
		case 'home':
			$title = "Home";
			include('pages/home.php');		
		break;
				
		case 'about-us':
			$title = "About Us";
			include('pages/about_us.php');		
		break; 
				
		case 'contact-us':
			$title = "Contact Us";
			include('pages/contact_us.php');		
		break; 	
						
		default:
		include('pages/home.php');
	}
    

?>