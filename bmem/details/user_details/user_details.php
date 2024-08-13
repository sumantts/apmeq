<?php 
if(!$_SESSION["user_id"] || !$_SESSION["user_type_code"]){header('location:?p=signin');}
include('common/head.php');  
?> 

<body class="">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->	
	<?php include('common/nav.php'); ?>
	<!-- [ navigation menu ] end -->

	<!-- [ Header ] start -->
	<?php include('common/top_bar.php'); ?>
	<!-- [ Header ] end -->
	
	

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10"><?=$title?></h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#!"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!"><?=$title?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ sample-table ] start -->
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">
                        <h5> <?=$title?> Table</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <!-- <li><a href="javascript: void(0)" data-toggle="modal" id="onMyModal"><i class="feather icon-file-plus"></i> add new</a> </li>
                                    <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                    <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                    <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;" id="orgFormAlert">
							<strong>Success!</strong> Your Data Deleted successfully.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;" id="orgFormAlert1">
							<strong>Success!</strong> Your Data saved successfully.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
                        <button type="button" class="btn btn-primary mb-2 float-right" id="onMyModal">Add New</button>

                        
                        <div class="table-responsive">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sl.No.</th> 
                                        <th>Name</th>
                                        <th>User Type</th>
                                        <th>Mobile Number</th>
                                        <th>Phone Number</th>
                                        <th>Email ID</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Sl.No.</th> 
                                        <th>Name</th>
                                        <th>User Type</th>
                                        <th>Mobile Number</th>
                                        <th>Phone Number</th>
                                        <th>Email ID</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>                       

                    </div>
                </div>
            </div>

            <!-- Modal start -->
            <div id="exampleModalLong" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><?=$title?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate>
                                <div class="form-row">
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="user_name" class="text-danger">Name*</label>
                                        <input type="text" class="form-control" id="user_name" value="" >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Name.
                                        </div>
                                    </div> 

                                    <div class="col-md-4 mb-3">
                                        <label for="user_type_id" class="text-danger">User Type*</label>
                                        <select class="form-control" name="user_type_id" id="user_type_id">
                                            <option value="0">Select</option> 
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please select User Type.
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="hospital_id" class="text-danger">Hospital Name*</label>
                                        <select class="form-control" name="hospital_id" id="hospital_id">
                                            <option value="0">Select</option>                                             
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please select Hospital Name.
                                        </div>
                                    </div> 
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="user_mobile" class="text-danger">Mobile Number*</label>
                                        <input type="tel" class="form-control" id="user_mobile" value=""> 
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Mobile Number.
                                        </div>
                                    </div>   
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="user_phone" >Phone Number</label>
                                        <input type="text" class="form-control" id="user_phone" value=""> 
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Phone Number.
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="user_email" class="text-danger">Email ID*</label>
                                        <input type="text" class="form-control" id="user_email" value=""> 
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Email ID.
                                        </div>
                                    </div> 
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="user_dob" class="text-danger">Date of Birth*</label>
                                        <input type="date" class="form-control" id="user_dob" value=""> 
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Date of Birth.
                                        </div>
                                    </div> 

                                    <div class="col-md-8 mb-3">
                                        <label for="user_address" class="text-danger">Address*</label>
                                        <textarea class="form-control" name="user_address" id="user_address"> </textarea>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Address.
                                        </div>
                                    </div> 
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="user_user_name" class="text-danger">Username*</label>
                                        <input type="text" class="form-control" id="user_user_name" value=""> 
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Username.
                                        </div>
                                    </div> 
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="user_password" class="text-danger">Password*</label>
                                        <input type="text" class="form-control" id="user_password" value=""> 
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please enter Password.
                                        </div>
                                    </div> 
                                    
                                    <!-- <div class="col-md-4 mb-2 mt-4">
                                        <input type="file" accept="image/*" class="custom-file-input" id="author_photo" aria-describedby="author_photo"  onchange="savePhoto()">
                                        <label class="custom-file-label" for="validatedCustomFile">Choose image...</label>
                                        <small id="author_photoError" class="form-text text-danger"> </small>
                                        <img src="" id="image" width="100">
                                    </div>  -->
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="user_status" class="text-danger">Status*</label>
                                        <select class="form-control" name="user_status" id="user_status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please select status.
                                        </div>
                                    </div> 

                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="user_id" value="0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                            <button class="btn  btn-primary" type="button" id="submitForm">
                                <span class="spinner-border spinner-border-sm" role="status" style="display: none;" id="submitForm_spinner"></span>
                                <span class="load-text" style="display: none;" id="submitForm_spinner_text">Loading...</span>
                                <span class="btn-text" id="submitForm_text">Save</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal end -->

            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->
	<?php include('common/footer.php'); ?>
    
    <script src="details/user_details/function.js?d=<?=date('Ymdhis')?>"></script>