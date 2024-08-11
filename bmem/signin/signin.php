<!DOCTYPE html>
<html lang="en">

<head>
	<title><?php echo $title; ?> | Login</title>
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
		.modal {
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
		body.loading .modal {
			overflow: hidden;   
		}

		/* Anytime the body has the loading class, our
			modal element will be visible */
		body.loading .modal {
			display: block;
		}
	</style>
	<!-- //Spinner Loader -->
</head>

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content text-center">
		<img src="assets/images/<?=$logo?>" width="100" alt="Fee Fusion" class="img-fluid mb-4">
		<div class="card borderless">
			<div class="row align-items-center ">
				<div class="col-md-12">
							
					<div class="card-body">
						<h4 class="mb-3 f-w-400"><?php echo $title; ?></h4>
						<hr>
						<div class="form-group mb-3">
							<input type="text" class="form-control" id="Email" placeholder="Email address">
						</div>
						<div class="form-group mb-4">
							<input type="password" class="form-control" id="Password" placeholder="Password">
						</div>
						<div class="custom-control custom-checkbox text-left mb-4 mt-2">
							<input type="checkbox" class="custom-control-input" id="customCheck1">
							<label class="custom-control-label" for="customCheck1">Save credentials.</label>
						</div>

						<!-- <button class="btn btn-block btn-primary mb-4" id="Signin">Signin</button> -->
						<button class="btn btn-block btn-primary mb-4" type="button" id="Signin">
							<span class="spinner-border spinner-border-sm" role="status" style="display: none;" id="signin_spinner"></span>
							<span class="load-text" style="display: none;" id="signin_spinner_text">Loading...</span>
							<span class="btn-text" id="signin_text">Signin</span>
						</button>

						<hr>
						<!-- <p class="mb-2 text-muted">Forgot password? <a href="auth-reset-password.html" class="f-w-400">Reset</a></p> 
						<p class="mb-2 text-muted">Create an Account! <a href="?p=signup" class="f-w-400">Create</a></p>-->
						<?php if(isset($_GET['id'])){?>
							<!-- <p class="mb-0 text-muted">Go to website? <a href="../?p=my-bio&id=<?=$_GET['id']?>" class="f-w-400">Click Here</a></p> -->
						<?php }else{?>
							<!-- <p class="mb-0 text-muted">Go to website? <a href="../" class="f-w-400">Click Here</a></p> -->
						<?php } ?>
					</div>
					
					
					<div style="position:absolute;top:40px;right: 40px" class="toast hide toast-5s" role="alert" aria-live="assertive" data-delay="5000" aria-atomic="true">
						<div class="toast-header">
							<img src="assets/images/<?=$ico?>" alt="" class="img-fluid m-r-5" style="width:20px;">
							<strong class="mr-auto"><?=$p_name?></strong>
							<!-- <small class="text-muted">11 mins ago</small> -->
							<button type="button" class="m-l-5 mb-1 mt-1 close" data-dismiss="toast" aria-label="Close">
								<span>&times;</span>
							</button>
						</div>
						<div class="toast-body" id="toastMsgTxt">
							Username or password is not match.
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- [ auth-signin ] end -->

<?php
	if(isset($_GET['log'])){
		if($_GET['log'] == 'out'){
			session_start();
			// remove all session variables
			session_unset();

			// destroy the session
			session_destroy();
		}
	}
?>

<!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>
<script src="assets/js/pcoded.min.js"></script>
<script src="signin/function.js"></script>

<div class="modal"><!-- Place at bottom of page Loading--></div>
</body>
</html>
