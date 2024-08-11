<?php
if(!$_SESSION["user_id"] || !$_SESSION["user_type_code"]){header('location:?p=signin');}
include('common/head.php'); ?>

<style>
    /*table td {
        word-break: break-word;
        vertical-align: top;
        white-space: normal !important;
    }

    .myclass {
        text-transform: lowercase;
    }*/
</style>

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
                        <h5> <?=$title?> </h5>
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
                                        <th>Hospita Name</th>
                                        <th>Hospita Code</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Sl.No.</th>
                                        <th>Hospita Name</th>
                                        <th>Hospita Code</th>
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
                            <form class="needs-validation" novalidate id="myForm" name="myForm">
                                <div class="form-row">                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="hospital_name" class="text-danger">Hospita Name*</label>
                                        <input type="text" class="form-control" name="hospital_name" id="hospital_name">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Hospita Name.
                                        </div>
                                    </div> 

                                    <div class="col-md-4 mb-3">
                                        <label for="hospital_code" class="text-danger">Hospita Code*</label>
                                        <input type="text" class="form-control myclass" name="hospital_code" id="hospital_code">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Hospita Code.
                                        </div>
                                    </div> 

                                    <div class="col-md-4 mb-3">
                                        <label for="hospital_status">Status</label>
                                        <select class="form-control" name="hospital_status" id="hospital_status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div> 

                                    <div class="col-md-12 mb-3">
                                        <label for="hospital_address">Address</label>
                                        <textarea class="form-control" name="hospital_address" id="hospital_address"> </textarea> 
                                    </div> 
                                </div> 
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                            <input type="hidden" name="hospital_id" id="hospital_id" value="0">
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
    
    <script src="setup/hospital_details/function.js?d=<?=date('YmdHis')?>"></script>