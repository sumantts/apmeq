<?php 
if(!$_SESSION["login_id"] || !$_SESSION["user_level"]){header('location:?p=signin');}
include('common/head.php'); 

$author_id = $_SESSION["author_id"];

//Get All Category Name
$status = true;
$categories = array();

$sql = "SELECT * FROM category_list WHERE activity_status = 'active' ORDER BY category_name ASC";
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
        
        array_push($categories, $data);
        $slno++;
    }
} else {
    $status = false;
}

//Get Existing Data
$sql1 = "SELECT introduction.introduction_id, introduction.designation, introduction.highest_quali, introduction.secondary_email, introduction.date_of_joining, introduction.teaching_experience, introduction.research_interest, introduction.ind_exp, author_details.category_id, category_list.category_name FROM introduction JOIN author_details ON author_details.author_id = introduction.author_id JOIN category_list ON category_list.category_id = author_details.category_id WHERE introduction.author_id = '".$author_id."' ";
$result1 = $mysqli->query($sql1);
if ($result1->num_rows > 0) {
    $row1 = $result1->fetch_array();
    $introduction_id = $row1['introduction_id'];
    $designation = $row1['designation'];
    $highest_quali = $row1['highest_quali'];
    $secondary_email = $row1['secondary_email'];
    $date_of_joining = $row1['date_of_joining'];
    $teaching_experience = $row1['teaching_experience'];
    $research_interest = $row1['research_interest'];
    $ind_exp = $row1['ind_exp'];	
    $category_name = $row1['category_name'];	
}else{
    $introduction_id = 0;
    $designation = '';
    $highest_quali = '';
    $secondary_email = '';
    $date_of_joining = '';
    $teaching_experience = '';
    $research_interest = '';
    $ind_exp = '';
    $category_name = '';
    $sql2 = "SELECT author_details.category_id, category_list.category_name FROM author_details JOIN category_list ON category_list.category_id = author_details.category_id WHERE author_details.author_id = '".$author_id."' ";
    $result2 = $mysqli->query($sql2);
    if($result2->num_rows > 0) {
        $row2 = $result2->fetch_array();
        $category_name = $row2['category_name'];
    }
}//end if

?>

<style>
    table td {
        word-break: break-word;
        vertical-align: top;
        white-space: normal !important;
    }

    .myclass {
        text-transform: lowercase;
    }
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
                <!-- Award start -->
                <div class="card">
                    <div class="card-header">
                        <h5><?=$title?></h5>
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

                        <!-- Form start -->                        
                        <form class="needs-validation" novalidate id="myForm" name="myForm">
                            <div class="form-row">                                    
                                <div class="col-md-4 mb-3">
                                    <label for="designation" class="text-danger">Designation*</label>
                                    <input type="text" class="form-control" name="designation" id="designation" value="<?=$designation?>">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please provide Designation.
                                    </div>
                                </div> 

                                <div class="col-md-4 mb-3">
                                    <label for="category_id">Department</label>
                                    <input type="text" class="form-control" name="category_id" id="category_id" value="<?=$category_name?>" readonly>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please select Department.
                                    </div>
                                </div> 

                                <div class="col-md-4 mb-3">
                                    <label for="highestQualification" class="text-danger">Highest Qualification*</label>
                                    <input type="text" class="form-control" name="highestQualification" id="highestQualification"  value="<?=$highest_quali?>">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please provide Highest Qualification.
                                    </div>
                                </div>                                    
                                <div class="col-md-4 mb-3">
                                    <label for="secondaryEmail">Secondary Email</label>
                                    <input type="text" class="form-control" name="secondaryEmail" id="secondaryEmail" value="<?=$secondary_email?>">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please provide Secondary Email.
                                    </div>
                                </div>                                     
                                <div class="col-md-4 mb-3">
                                    <label for="dateOfJoining" class="text-danger">DOJ* (in this college)</label>
                                    <input type="date" class="form-control" name="dateOfJoining" id="dateOfJoining" value="<?=$date_of_joining?>">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please select Date Of Joining.
                                    </div>
                                </div>                                     
                                <div class="col-md-4 mb-3">
                                    <label for="teachingExperience">Experience (in this college)</label>
                                    <input type="text" class="form-control" name="teachingExperience" id="teachingExperience" readonly value="<?=$teaching_experience?>">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please provide Experience.
                                    </div>
                                </div> 

                                <div class="col-md-4 mb-3">
                                    <label for="researchInterest" class="text-danger">Research Interest*</label>
                                    <input type="text" class="form-control" name="researchInterest" id="researchInterest" value="<?=$research_interest?>">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please provide Research Interest.
                                    </div>
                                </div>   

                                <div class="col-md-4 mb-3">
                                    <label for="indExperience">Industrial/Professional Experience</label>
                                    <input type="text" class="form-control" name="indExperience" id="indExperience" value="<?=$ind_exp?>">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>                                    
                                    <div class="invalid-feedback">
                                        Please provide Industrial/Professional Experience.
                                    </div>
                                </div> 
                                    
                                <div class="col-md-4 mb-3">
                                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button> -->
                                    <input type="hidden" name="author_id" id="author_id" value="<?=$_SESSION["author_id"]?>">
                                    <input type="hidden" name="introduction_id" id="introduction_id" value="<?=$introduction_id?>">
                                    <button class="btn  btn-primary mt-4" type="button" id="submitForm">
                                        <span class="spinner-border spinner-border-sm" role="status" style="display: none;" id="submitForm_spinner"></span>
                                        <span class="load-text" style="display: none;" id="submitForm_spinner_text">Loading...</span>
                                        <span class="btn-text" id="submitForm_text">Save</span>
                                    </button>
                                </div> 
                            </div> 
                        </form>
                        <!-- Form End -->

                        <!-- <button type="button" class="btn btn-primary mb-2 float-right" id="onMyModal">Add New</button>
                        
                        <div class="table-responsive">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sl.No.</th>
                                        <th>Title</th>
                                        <th>Authors</th>
                                        <th>Publisher</th>
                                        <th>Published on</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Sl.No.</th>
                                        <th>Title</th>
                                        <th>Authors</th>
                                        <th>Publisher</th>
                                        <th>Published on</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>  -->
                    </div>
                </div>
                <!-- Award end -->
                
            </div>

            <!-- Award Modal start -->
            <!-- <div id="exampleModalLong" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"> <?=$title?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate id="myForm" name="myForm">
                                <div class="form-row">                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="bookTitle">Book Title*</label>
                                        <input type="text" class="form-control" name="bookTitle" id="bookTitle">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Book Title.
                                        </div>
                                    </div>                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="authors">Authors*</label>
                                        <input type="text" class="form-control" name="authors" id="authors">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Authors.
                                        </div>
                                    </div>                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="publisher">Publisher*</label>
                                        <input type="text" class="form-control" name="publisher" id="publisher">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Publisher.
                                        </div>
                                    </div>                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="publishedOn">Published on*</label>
                                        <input type="text" class="form-control" name="publishedOn" id="publishedOn">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>                                    
                                        <div class="invalid-feedback">
                                            Please provide Published on.
                                        </div>
                                    </div> 
                                     
                                </div> 
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn  btn-primary" type="button" id="submitForm">
                                <span class="spinner-border spinner-border-sm" role="status" style="display: none;" id="submitForm_spinner"></span>
                                <span class="load-text" style="display: none;" id="submitForm_spinner_text">Loading...</span>
                                <span class="btn-text" id="submitForm_text">Save</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- Award Modal end -->
            

            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->
	<?php include('common/footer.php'); ?>
    
    <script src="setup/introduction/function.js"></script>