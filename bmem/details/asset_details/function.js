$('#onMyModal').on('click', function(){ 
    $('#asset_detail_id').val('0');
    $('#partTwoBoard').hide();
    clearForm();
    $('#exampleModalLong').modal('show');
})

$("#partTwoSwitch").click(function(){
    $("#partTwoBoard").toggle('slow');
});

function validateForm(){
    $category_id = $('#category_id').val();
    $for_the_year = $('#for_the_year').val();
    $author_name = $('#author_name').val().replace(/^\s+|\s+$/gm,'');
    $email = $('#email').val().replace(/^\s+|\s+$/gm,'');
    $registration_number = $('#registration_number').val().replace(/^\s+|\s+$/gm,'');
    $course_id = $('#course_id').val();

    $status = true;

    if($category_id == '0'){
        $status = false;
        $('#category_id').removeClass('is-valid');
        $('#category_id').addClass('is-invalid');
    }else{
        $status = true;
        $('#category_id').removeClass('is-invalid');
        $('#category_id').addClass('is-valid');
    }

    if($for_the_year == '0'){
        $status = false;
        $('#for_the_year').removeClass('is-valid');
        $('#for_the_year').addClass('is-invalid');
    }else{
        $status = true;
        $('#for_the_year').removeClass('is-invalid');
        $('#for_the_year').addClass('is-valid');
    }

    if($course_id == '0'){
        $status = false;
        $('#course_id').removeClass('is-valid');
        $('#course_id').addClass('is-invalid');
    }else{
        $status = true;
        $('#course_id').removeClass('is-invalid');
        $('#course_id').addClass('is-valid');
    }

    if($author_name == ''){
        $status = false;
        $('#author_name').removeClass('is-valid');
        $('#author_name').addClass('is-invalid');
    }else{
        $status = true;
        $('#author_name').removeClass('is-invalid');
        $('#author_name').addClass('is-valid');
    }

    if($email == ''){
        $status = false;
        $('#email').removeClass('is-valid');
        $('#email').addClass('is-invalid');
    }else{
        $status = true;
        $('#email').removeClass('is-invalid');
        $('#email').addClass('is-valid');
    }  

    if($registration_number == ''){
        $status = false;
        $('#registration_number').removeClass('is-valid');
        $('#registration_number').addClass('is-invalid');
    }else{
        $status = true;
        $('#registration_number').removeClass('is-invalid');
        $('#registration_number').addClass('is-valid');
    }     

    $('#submitForm_spinner').hide();
    $('#submitForm_spinner_text').hide();
    $('#submitForm_text').show();

    return $status;
}//en validate form

function clearForm(){
    $('#category_id').val('0').trigger('change');
    $('#category_id').removeClass('is-valid');
    $('#category_id').removeClass('is-invalid');

    $('#for_the_year').val('0').trigger('change');
    $('#for_the_year').removeClass('is-valid');
    $('#for_the_year').removeClass('is-invalid');

    $('#author_name').val('');
    $('#author_name').removeClass('is-valid');
    $('#author_name').removeClass('is-invalid');

    $('#email').val('');
    $('#email').removeClass('is-valid');
    $('#email').removeClass('is-invalid');

    $('#registration_number').val('');
    $('#registration_number').removeClass('is-valid');
    $('#registration_number').removeClass('is-invalid');

    $('#asset_detail_id').val('0');  

}//end 

$(".form-control").blur(function(){
    $('#orgFormAlert').css("display", "none");
    $formVallidStatus = validateForm();
});

$('#submitForm').click(function(){
    $('#submitForm_spinner').show();
    $('#submitForm_spinner_text').show();
    $('#submitForm_text').hide();
    //setTimeout(function(){
        $('#submitForm_spinner').hide();
        $('#submitForm_spinner_text').hide();
        $('#submitForm_text').show();
        $formVallidStatus = true;//validateForm();

        if($formVallidStatus == true){
            $asset_detail_id = $('#asset_detail_id').val(); 
            $name_of_asset = $('#name_of_asset').val(); 
            $department_id = $('#department_id').val(); 
            $hospital_id = $('#hospital_id').val(); 
            $asset_code = $('#asset_code').val(); 
            $manufacturer_id = $('#manufacturer_id').val(); 
            $model_name = $('#model_name').val(); 
            $supplier_id = $('#supplier_id').val(); 
            $asset_slno = $('#asset_slno').val(); 
            $equipment_name = $('#equipment_name').val(); 
            $installation_date = $('#installation_date').val(); 
            $total_year_in_service = $('#total_year_in_service').val(); 
            $calibration_last_date = $('#calibration_last_date').val(); 
            $calibration_frequency = $('#calibration_frequency').val(); 
            $preventive_maintain_last_date = $('#preventive_maintain_last_date').val(); 
            $preventive_maintenance_frequency = $('#preventive_maintenance_frequency').val(); 
            $warenty = $('#warenty').val(); 
            $amc = $('#amc').val(); 
            $amc_last_date = $('#amc_last_date').val(); 
            $cmc = $('#cmc').val(); 
            $cmc_last_date = $('#cmc_last_date').val(); 
            $service_providers_id = $('#service_providers_id').val(); 
            $files_attached = $('#files_attached').val(); 
            $reallocate_id = $('#reallocate_id').val(); 
            $qa_certificate = $('#qa_certificate').val(); 
            $qa_certificate_last_date = $('#qa_certificate_last_date').val(); 
            $asset_status = $('#asset_status').val();

            $.ajax({
                method: "POST",
                url: "details/asset_details/function.php",
                data: { fn: "saveFormData", asset_detail_id: $asset_detail_id, name_of_asset: $name_of_asset, department_id: $department_id, hospital_id: $hospital_id, asset_code: $asset_code, manufacturer_id: $manufacturer_id, model_name: $model_name, supplier_id: $supplier_id, asset_slno: $asset_slno, equipment_name: $equipment_name, installation_date: $installation_date, total_year_in_service: $total_year_in_service, calibration_last_date: $calibration_last_date, calibration_frequency: $calibration_frequency, preventive_maintain_last_date: $preventive_maintain_last_date, preventive_maintenance_frequency: $preventive_maintenance_frequency, warenty: $warenty, amc: $amc, amc_last_date: $amc_last_date, cmc: $cmc, cmc_last_date: $cmc_last_date, service_providers_id: $service_providers_id, files_attached: $files_attached, reallocate_id: $reallocate_id, qa_certificate: $qa_certificate, qa_certificate_last_date: $qa_certificate_last_date, asset_status: $asset_status }
            })
            .done(function( res ) {
                //console.log(res);
                $res1 = JSON.parse(res);
                if($res1.status == true){
                    $('#orgFormAlert1').css("display", "block");
                    $('.toast-right').toast('show');
                    
                    clearForm();
                    
                    $('#exampleModalLong').modal('hide');
                    populateDataTable();
                }else{
                    alert($res1.error_message);
                }
            });//end ajax
        }

    //}, 500)    
})

function editTableData($asset_detail_id){
    getAllProductImages($asset_detail_id);
    $('#exampleModalLong').modal('show');
    $.ajax({
        method: "POST",
        url: "details/asset_details/function.php",
        data: { fn: "getFormEditData", asset_detail_id: $asset_detail_id }
    })
    .done(function( res ) {
        //console.log(res);
        $res1 = JSON.parse(res);
        if($res1.status == true){
            //$('#category_id').val($res1.category_id).trigger('change'); 
            $('#asset_detail_id').val($asset_detail_id);
            $('#name_of_asset').val($res1.name_of_asset);
            $('#department_id').val($res1.department_id).trigger('change');
            $('#hospital_id').val($res1.hospital_id).trigger('change');
            $('#asset_code').val($res1.asset_code);
            $('#manufacturer_id').val($res1.manufacturer_id).trigger('change');
            $('#model_name').val($res1.model_name);
            $('#supplier_id').val($res1.supplier_id).trigger('change');
            $('#asset_slno').val($res1.asset_slno);
            $('#equipment_name').val($res1.equipment_name);
            $('#installation_date').val($res1.installation_date);
            $('#total_year_in_service').val($res1.total_year_in_service);
            $('#calibration_last_date').val($res1.calibration_last_date);
            $('#calibration_frequency').val($res1.calibration_frequency);
            $('#preventive_maintain_last_date').val($res1.preventive_maintain_last_date);
            $('#preventive_maintenance_frequency').val($res1.preventive_maintenance_frequency);
            $('#warenty').val($res1.warenty);
            $('#amc').val($res1.amc);
            $('#amc_last_date').val($res1.amc_last_date);
            $('#cmc').val($res1.cmc);
            $('#cmc_last_date').val($res1.cmc_last_date);
            $('#service_providers_id').val($res1.service_providers_id).trigger('change');
            $('#files_attached').val($res1.files_attached);
            $('#reallocate_id').val($res1.reallocate_id);
            $('#qa_certificate').val($res1.qa_certificate);
            $('#qa_certificate_last_date').val($res1.qa_certificate_last_date);
            $('#asset_status').val($res1.asset_status).trigger('change');

        }
    });//end ajax

}

//Delete function	
function deleteTableData($asset_detail_id){
    if (confirm('Are you sure to delete the Data?')) {
        $.ajax({
            method: "POST",
            url: "details/asset_details/function.php",
            data: { fn: "deleteTableData", asset_detail_id: $asset_detail_id }
        })
        .done(function( res ) {
            //console.log(res);
            $res1 = JSON.parse(res);
            if($res1.status == true){
                $('#orgFormAlert').show();
                populateDataTable();
            }
        });//end ajax
    }		
}//end delete

//Image upload
function savePhoto(){
    const imgPath = document.querySelector('input[type=file]').files[0];
    const reader = new FileReader();

    reader.addEventListener("load", function () {
        // convert image file to base64 string and save to localStorage
        localStorage.setItem("author_photo", reader.result);
    }, false);

    if (imgPath) {
        reader.readAsDataURL(imgPath);
    }

    //To display image again
    setTimeout(function(){
    let img = document.getElementById('image');
    img.src = localStorage.getItem('author_photo');
    }, 250);
}


function populateDataTable(){
    $('#example').dataTable().fnClearTable();
    $('#example').dataTable().fnDestroy();

    $('#example').DataTable({ 
        columnDefs: [{ width: 5, targets: 0 }, { width: 5, targets: 1 }, { width: 150, targets: 2 }, { width: 200, targets: 3 }, { width: 10, targets: 4 }, { width: 10, targets: 5 }],
        responsive: true,
        serverMethod: 'GET',
        ajax: {'url': 'details/asset_details/function.php?fn=getTableData' },
        dom: 'Bfrtip',
        buttons: [
            {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
                titleAttr: 'Copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel'
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fa fa-file-text-o"></i>',
                titleAttr: 'CSV'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o"></i>',
                titleAttr: 'PDF'
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i>',
                titleAttr: 'Print'
            },
        ],
        order: [[0, 'desc']],

    });
}//end fun



//Category
function configureSupplierDropDown(){
    $.ajax({
        method: "POST",
        url: "details/asset_details/function.php",
        data: { fn: "getAllSupplierName" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        if($res1.status == true){
            $rows = $res1.data;

            if($rows.length > 0){
                $('#supplier_id').html('');
                $html = "<option value='0'>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $html += "<option value='"+$rows[$i].supplier_id+"'>"+$rows[$i].supplier_name+"</option>";                    
                }//end for
                
                $('#supplier_id').html($html);
            }//end if
        }        
    });//end ajax
}//end

//Service providers
function configureCourseDropDown(){
    $.ajax({
        method: "POST",
        url: "details/asset_details/function.php",
        data: { fn: "getAllServiceProvidersName" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        if($res1.status == true){
            $rows = $res1.data;

            if($rows.length > 0){
                $('#service_providers_id').html('');
                $html = "<option value='0'>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $html += "<option value='"+$rows[$i].service_providers_id+"'>"+$rows[$i].service_providers_name+"</option>";                    
                }//end for
                
                $('#service_providers_id').html($html);
            }//end if
        }        
    });//end ajax
}//end

function configureDepartmentDropDown(){
    $.ajax({
        method: "POST",
        url: "details/asset_details/function.php",
        data: { fn: "getAllDepartmentName" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res); 
        if($res1.status == true){
            $rows = $res1.data;

            if($rows.length > 0){
                $('#department_id').html('');
                $html = "<option value='0'>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $html += "<option value='"+$rows[$i].department_id+"'>"+$rows[$i].department_name+"</option>";                    
                }//end for
                
                $('#department_id').html($html);
            }//end if
        }        
    });//end ajax
}//end

//Course
function configureHospitaDropDown(){
    $.ajax({
        method: "POST",
        url: "details/user_details/function.php",
        data: { fn: "getAllHospitaName" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        if($res1.status == true){
            $rows = $res1.data;

            if($rows.length > 0){
                $('#hospital_id').html('');
                $html = "<option value='0'>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $html += "<option value='"+$rows[$i].hospital_id+"'>"+$rows[$i].hospital_name+"</option>";                    
                }//end for
                
                $('#hospital_id').html($html);
            }//end if
        }        
    });//end ajax
}//end

//Manufacturer
function configureManufacturerDropDown(){
    $.ajax({
        method: "POST",
        url: "details/asset_details/function.php",
        data: { fn: "getAllManufacturerName" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        if($res1.status == true){
            $rows = $res1.data;

            if($rows.length > 0){
                $('#manufacturer_id').html('');
                $html = "<option value='0'>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $html += "<option value='"+$rows[$i].manufacturer_id+"'>"+$rows[$i].manufacturer_name+"</option>";                    
                }//end for
                
                $('#manufacturer_id').html($html);
            }//end if
        }        
    });//end ajax
}//end

//Multiple Photo Upload
function uploadajax(ttl,cl){
    $asset_detail_id = $('#asset_detail_id').val();

    var fileList = $('#files_attached').prop("files"); 
    var form_data =  "";
    form_data = new FormData();
    form_data.append("upload_image", fileList[cl]);
    form_data.append("asset_detail_id", $asset_detail_id);

    var request = $.ajax({
        url: "details/asset_details/upload.php",
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        data: form_data,
        type: 'POST', 
        success: function (res, status) {
            console.log('return data: '+res + ' status: ' + status);
            $res1 = JSON.parse(res);
            if ($res1.status == true) {
                $upload_count++;
                percent = 0; 
                if (cl < ttl) {
                    uploadajax(ttl, cl + 1);
                } else {
                    console.log('Done');
                    $('#uploadMessage').html($upload_count + ' Files Uploaded');
                    getAllProductImages($asset_detail_id);
                }
            }
        },
        fail: function (res) {
            console.log('Failed');
        }    
    })
}

$('#startUpload').on('click', function(){
    console.log('upload start...');    
    $asset_detail_id = $('#asset_detail_id').val();
    $upload_count = 0;
    if($asset_detail_id > 0){
        $('#uploadMessage').html('');
        var fileList = $('#files_attached').prop("files"); 
        var i;
        for ( i = 0; i < fileList.length; i++) { 
            if(i == fileList.length-1){
                uploadajax(fileList.length-1,0);
            }
        }
    }else{
        alert('Please enter asset name first');
    }//end if
}); 

function getAllProductImages($asset_detail_id){
    console.log(' fun calling...');
    $('#product_gallery').html('');
    $.ajax({
        method: "POST",
        url: "details/asset_details/function.php",
        data: { fn: "getAllProductImages", asset_detail_id: $asset_detail_id }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        //console.log(JSON.stringify($res1));
        if($res1.status == true){
            $all_images = $res1.all_images;

            if($all_images.length > 0){ 
                $html = "";
                console.log('all_images length: '+$all_images.length);
                for($i in $all_images ){
                    $html += '<img src="details/asset_details/photos/'+$all_images[$i]+'" width="75" class="img-fluid img-thumbnail" alt="..."><a href="javascript: void(0)"> <i class="fa fa-trash" aria-hidden="true" onclick="deleteProdImage(\''+$all_images[$i]+'\')"></i></a>'; 
                }//end for
                
                $('#product_gallery').html($html);
            }//end if
        } //end if       
    });//end ajax

}//end if

function deleteProdImage($prod_iamge_name){
    console.log('prod_iamge_name: ' + $prod_iamge_name);
    if (confirm('Are you sure to delete the Image?')) {
        $asset_detail_id = $('#asset_detail_id').val();
        $.ajax({
            method: "POST",
            url: "details/asset_details/function.php",
            data: { fn: "deleteProdImage", asset_detail_id: $asset_detail_id, prod_iamge_name: $prod_iamge_name }
        })
        .done(function( res ) {
            //console.log(res);
            $res1 = JSON.parse(res);
            if($res1.status == true){
                getAllProductImages($asset_detail_id);
            }
        });//end ajax
    }		
}//end fun
//End multiple pgoto upload

$(document).ready(function () {
    configureDepartmentDropDown();
    configureHospitaDropDown(); 
    configureManufacturerDropDown(); 
    configureSupplierDropDown(); 
    configureCourseDropDown(); 
    populateDataTable();
});

