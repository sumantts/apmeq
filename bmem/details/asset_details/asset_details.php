<?php 
if(!$_SESSION["user_type_code"] || !$_SESSION["user_type_code"]){header('location:?p=signin');}
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
                                        <th>Department Name</th>
                                        <th>Manufacturer Name</th>
                                        <th>Supplier Name</th>
                                        <th>Installation Date</th>
                                        <th>Total year in Service</th>
                                        <th>Calibration Last Date</th>
                                        <th>Calibration Frequency </th>
                                        <th>Service Provider Name</th>
                                        <th>Service Provider Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Sl.No.</th> 
                                        <th>Name</th>
                                        <th>Department Name</th>
                                        <th>Manufacturer Name</th>
                                        <th>Supplier Name</th>
                                        <th>Installation Date</th>
                                        <th>Total year in Service</th>
                                        <th>Calibration Last Date</th>
                                        <th>Calibration Frequency </th>
                                        <th>Service Provider Name</th>
                                        <th>Service Provider Phone</th>
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
                                        <label for="name_of_asset" class="text-danger">Name of Asset*</label>
                                        <input type="text" class="form-control" id="name_of_asset" value="" >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Name of Asset.
                                        </div>
                                    </div>      

                                    <div class="col-md-4 mb-3">
                                        <label for="asset_code" class="text-danger">Asset Code*</label>
                                        <input type="text" class="form-control" id="asset_code" value="" >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Asset Code.
                                        </div>
                                    </div>       

                                    <div class="col-md-4 mb-3">
                                        <label for="asset_slno" class="text-danger">Asset serial No*</label>
                                        <input type="text" class="form-control" id="asset_slno" value="" >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Asset serial No.
                                        </div>
                                    </div>        

                                    <div class="col-md-4 mb-3">
                                        <label for="model_name" class="text-danger">Model name*</label>
                                        <input type="text" class="form-control" id="model_name" value="" >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Model name.
                                        </div>
                                    </div>         

                                    <div class="col-md-4 mb-3">
                                        <label for="equipment_name" class="text-danger">Equipment Name*</label>
                                        <input type="text" class="form-control" id="equipment_name" value="" >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Equipment Name.
                                        </div>
                                    </div>    

                                    <div class="col-md-4 mb-3">
                                        <label for="department_id" class="text-danger">Department*</label>
                                        <select class="form-control" name="department_id" id="department_id">
                                            <option value="0">Select</option> 
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please select Department.
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="hospital_id" class="text-danger">Hospital*</label>
                                        <select class="form-control" name="hospital_id" id="hospital_id">
                                            <option value="0">Select</option> 
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please select Hospital.
                                        </div>
                                    </div> 

                                    <div class="col-md-4 mb-3">
                                        <label for="manufacturer_id" class="text-danger">Manufacturer*</label>
                                        <select class="form-control" name="manufacturer_id" id="manufacturer_id">
                                            <option value="0">Select</option> 
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please select Manufacturer.
                                        </div>
                                    </div>  

                                    <div class="col-md-4 mb-3">
                                        <label for="supplier_id" class="text-danger">Supplier*</label>
                                        <select class="form-control" name="supplier_id" id="supplier_id">
                                            <option value="0">Select</option> 
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please select Supplier.
                                        </div>
                                    </div>         

                                    <div class="col-md-4 mb-3">
                                        <label for="installation_date" class="text-danger">Installation Date*</label>
                                        <input type="date" class="form-control" id="installation_date" value="" >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Installation Date.
                                        </div>
                                    </div>        

                                    <div class="col-md-4 mb-3">
                                        <label for="total_year_in_service" class="text-danger">Total Year in Service*</label>
                                        <input type="number" class="form-control" id="total_year_in_service" value="" >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Total Year in Service.
                                        </div>
                                    </div>          

                                    <div class="col-md-4 mb-3">
                                        <label for="calibration_last_date" class="text-danger">Calibration Last Date*</label>
                                        <input type="date" class="form-control" id="calibration_last_date" value="" >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Calibration Last Date.
                                        </div>
                                    </div>        

                                    <div class="col-md-4 mb-3">
                                        <label for="calibration_frequency" class="text-danger">Calibration Frequency*</label>
                                        <input type="number" class="form-control" id="calibration_frequency" value="" >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Calibration Frequency.
                                        </div>
                                    </div>        

                                    <div class="col-md-4 mb-3">
                                        <label for="preventive_maintain_last_date" class="text-danger">Preventive Maintain Last Date*</label>
                                        <input type="date" class="form-control" id="preventive_maintain_last_date" value="" >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Preventive Maintain Last Date.
                                        </div>
                                    </div>        

                                    <div class="col-md-4 mb-3">
                                        <label for="preventive_maintenance_frequency" class="text-danger">Preventive Maintenance Frequency*</label>
                                        <input type="text" class="form-control" id="preventive_maintenance_frequency" value="" >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Preventive Maintenance Frequency.
                                        </div>
                                    </div>         

                                    <div class="col-md-4 mb-3">
                                        <label for="warenty" class="text-danger">Warenty*</label>
                                        <input type="text" class="form-control" id="warenty" value="" >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Warenty period.
                                        </div>
                                    </div>          

                                    <div class="col-md-4 mb-3">
                                        <label for="amc" class="text-danger">AMC Period*</label>
                                        <input type="text" class="form-control" id="amc" value="" >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide amc period.
                                        </div>
                                    </div>          

                                    <div class="col-md-4 mb-3">
                                        <label for="amc_last_date" class="text-danger">AMC Last Date*</label>
                                        <input type="date" class="form-control" id="amc_last_date" value="" >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide amc period.
                                        </div>
                                    </div>          

                                    <div class="col-md-4 mb-3">
                                        <label for="cmc" class="text-danger">AMC Period*</label>
                                        <input type="text" class="form-control" id="cmc" value="" >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide cmc period.
                                        </div>
                                    </div>          

                                    <div class="col-md-4 mb-3">
                                        <label for="cmc_last_date" class="text-danger">CMC Last Date*</label>
                                        <input type="date" class="form-control" id="cmc_last_date" value="" >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide cmc period.
                                        </div>
                                    </div>   

                                    <div class="col-md-4 mb-3">
                                        <label for="service_providers_id" class="text-danger">Service Providers*</label>
                                        <select class="form-control" name="service_providers_id" id="service_providers_id">
                                            <option value="0">Select</option> 
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please select Service Providers.
                                        </div>
                                    </div>   

                                    <!-- <div class="col-md-4 mb-3">
                                        <label for="files_attached">Attach Document</label>
                                        <input type="file" class="form-control" id="files_attached" value="" > 
                                    </div>          -->

                                    <div class="col-md-4 mb-3">
                                        <label for="qa_certificate" class="text-danger">QA Certificate*</label>
                                        <input type="text" class="form-control" id="qa_certificate" value="" >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide QA Certificate.
                                        </div>
                                    </div>          

                                    <div class="col-md-4 mb-3">
                                        <label for="qa_certificate_last_date" class="text-danger">QA Certificate Last Date*</label>
                                        <input type="date" class="form-control" id="qa_certificate_last_date" value="" >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide cmc period.
                                        </div>
                                    </div> 
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="asset_status" class="text-danger">Activity Status*</label>
                                        <select class="form-control" name="asset_status" id="asset_status">
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
                                <a href="javascript: void(0);" id="partTwoSwitch" class="float-right">Upload Document</a>
                                <br>
                                <hr>

                                <div class="form-row" id="partTwoBoard"> 
                                    <div class="col-md-3 mt-4">
                                        <input type="file" id="files_attached" name="uploadFiledd[]" multiple accept=".jpg,.jpeg,.png" >
                                        <span id="uploadMessage"></span>
                                    </div> 

                                    <div class="col-md-1 mt-4"> 
                                        <button type="button" id="startUpload" class="btn btn-primary btn-sm">Upload</button>
                                    </div> 

                                    <div class="col-md-12 mb-3">
                                        <div class="text-center" id="product_gallery"> 
                                            <img src="details/asset_details/photos/no_doc.jpg" width="75" class="img-fluid img-thumbnail" alt="...">
                                            <!-- <a href='javascript: void(0)'> <i class='fa fa-trash' aria-hidden='true' onclick='deleteProdImage()'></i></a>  -->
                                        </div>
                                    </div> 
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="asset_detail_id" value="0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                            <button class="btn  btn-primary" type="button" id="submitForm">
                                <span class="spinner-border spinner-border-sm" role="status" style="display: none;" id="submitForm_spinner"></span>
                                <span class="load-text" style="display: none;" id="submitForm_spinner_text">Loading...</span>
                                <span class="btn-text" id="submitForm_text">Save Changes</span>
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
    
    <script src="details/asset_details/function.js?d=<?=date('Ymdhis')?>"></script>