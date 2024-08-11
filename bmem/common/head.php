<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $title; ?> | <?php echo $p_name; ?></title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
    	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/<?=$ico?>" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css">
	<!-- Spinner Loader -->
	<style>
		.modalSpinner {
			display:    none;
			position:   fixed;
			z-index:    1000;
			top:        0;
			left:       0;
			height:     100%;
			width:      100%;
			background: rgba( 255, 255, 255, .5 ) 
						url('assets/images/DualRing-1.4s-204px.gif')
						50% 50% 
						no-repeat;
		}

		/* When the body has the loading class, we turn
			the scrollbar off with overflow:hidden */
		body.loading .modalSpinner {
			overflow: hidden;   
		}

		/* Anytime the body has the loading class, our
			modal element will be visible */
		body.loading .modalSpinner {
			display: block;
		}
	</style>
	<!-- //Spinner Loader -->
</head>