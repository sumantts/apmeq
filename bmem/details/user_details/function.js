$('#onMyModal').on('click', function(){
    localStorage.setItem('author_photo', '');
    clearForm();
    $('#exampleModalLong').modal('show');
})

function validateForm(){
    $user_name = $('#user_name').val();
    $user_type_id = $('#user_type_id').val();
    $hospital_id = $('#hospital_id').val();
    $user_mobile = $('#user_mobile').val().replace(/^\s+|\s+$/gm,'');
    $user_email = $('#user_email').val().replace(/^\s+|\s+$/gm,'');
    $user_dob = $('#user_dob').val();
    $user_address = $('#user_address').val().replace(/^\s+|\s+$/gm,'');
    $user_user_name = $('#user_user_name').val().replace(/^\s+|\s+$/gm,'');
    $user_password = $('#user_password').val().replace(/^\s+|\s+$/gm,'');

    $status = true;

    if($user_name == ''){
        $status = false;
        $('#user_name').removeClass('is-valid');
        $('#user_name').addClass('is-invalid');
    }else{
        $status = true;
        $('#user_name').removeClass('is-invalid');
        $('#user_name').addClass('is-valid');
    }

    if($user_type_id == '0'){
        $status = false;
        $('#user_type_id').removeClass('is-valid');
        $('#user_type_id').addClass('is-invalid');
    }else{
        $status = true;
        $('#user_type_id').removeClass('is-invalid');
        $('#user_type_id').addClass('is-valid');
    }

    if($user_dob == '0'){
        $status = false;
        $('#user_dob').removeClass('is-valid');
        $('#user_dob').addClass('is-invalid');
    }else{
        $status = true;
        $('#user_dob').removeClass('is-invalid');
        $('#user_dob').addClass('is-valid');
    }

    if($hospital_id == '0'){
        $status = false;
        $('#hospital_id').removeClass('is-valid');
        $('#hospital_id').addClass('is-invalid');
    }else{
        $status = true;
        $('#hospital_id').removeClass('is-invalid');
        $('#hospital_id').addClass('is-valid');
    }

    if($user_mobile == ''){
        $status = false;
        $('#user_mobile').removeClass('is-valid');
        $('#user_mobile').addClass('is-invalid');
    }else{
        $status = true;
        $('#user_mobile').removeClass('is-invalid');
        $('#user_mobile').addClass('is-valid');
    }  

    if($user_email == ''){
        $status = false;
        $('#user_email').removeClass('is-valid');
        $('#user_email').addClass('is-invalid');
    }else{
        $status = true;
        $('#user_email').removeClass('is-invalid');
        $('#user_email').addClass('is-valid');
    }   

    if($user_address == ''){
        $status = false;
        $('#user_address').removeClass('is-valid');
        $('#user_address').addClass('is-invalid');
    }else{
        $status = true;
        $('#user_address').removeClass('is-invalid');
        $('#user_address').addClass('is-valid');
    }

    if($user_user_name == ''){
        $status = false;
        $('#user_user_name').removeClass('is-valid');
        $('#user_user_name').addClass('is-invalid');
    }else{
        $status = true;
        $('#user_user_name').removeClass('is-invalid');
        $('#user_user_name').addClass('is-valid');
    }  

    if($user_password == ''){
        $status = false;
        $('#user_password').removeClass('is-valid');
        $('#user_password').addClass('is-invalid');
    }else{
        $status = true;
        $('#user_password').removeClass('is-invalid');
        $('#user_password').addClass('is-valid');
    }        

    $('#submitForm_spinner').hide();
    $('#submitForm_spinner_text').hide();
    $('#submitForm_text').show();

    return $status;
}//en validate form

function clearForm(){
    $('#user_name').val('');
    $('#user_name').removeClass('is-valid');
    $('#user_name').removeClass('is-invalid');

    $('#user_type_id').val('0').trigger('change');
    $('#user_type_id').removeClass('is-valid');
    $('#user_type_id').removeClass('is-invalid');

    $('#hospital_id').val('0').trigger('change');
    $('#hospital_id').removeClass('is-valid');
    $('#hospital_id').removeClass('is-invalid');

    $('#user_mobile').val('');
    $('#user_mobile').removeClass('is-valid');
    $('#user_mobile').removeClass('is-invalid');

    $('#user_phone').val('');
    $('#user_phone').removeClass('is-valid');
    $('#user_phone').removeClass('is-invalid');

    $('#user_email').val('');
    $('#user_email').removeClass('is-valid');
    $('#user_email').removeClass('is-invalid');

    $('#user_address').val('');
    $('#user_address').removeClass('is-valid');
    $('#user_address').removeClass('is-invalid');

    $('#user_user_name').val('');
    $('#user_user_name').removeClass('is-valid');
    $('#user_user_name').removeClass('is-invalid');

    $('#user_password').val('');
    $('#user_password').removeClass('is-valid');
    $('#user_password').removeClass('is-invalid');  

    $('#user_dob').val('');
    $('#user_dob').removeClass('is-valid');
    $('#user_dob').removeClass('is-invalid');    

    $('#user_id').val('0');    

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
        $formVallidStatus = validateForm();

        if($formVallidStatus == true){
            $user_id = $('#user_id').val();
            $user_name = $('#user_name').val();
            $user_type_id = $('#user_type_id').val();
            $hospital_id = $('#hospital_id').val();
            $user_mobile = $('#user_mobile').val();
            $user_phone = $('#user_phone').val();
            $user_email = $('#user_email').val();
            $user_dob = $('#user_dob').val();
            $user_address = $('#user_address').val();
            $user_user_name = $('#user_user_name').val();
            $user_password = $('#user_password').val();
            $user_status = $('#user_status').val();

            $.ajax({
                method: "POST",
                url: "details/user_details/function.php",
                data: { fn: "saveFormData", user_id: $user_id, user_name: $user_name, user_type_id: $user_type_id, hospital_id: $hospital_id, user_mobile: $user_mobile, user_phone: $user_phone, user_email: $user_email, user_dob: $user_dob, user_address: $user_address, user_user_name: $user_user_name, user_password: $user_password, user_status: $user_status }
            })
            .done(function( res ) {
                //console.log(res);
                $res1 = JSON.parse(res);
                if($res1.status == true){
                    $('#exampleModalLong').modal('hide');
                    $('#orgFormAlert1').css("display", "block");                    
                    clearForm();                    
                    populateDataTable(); 
                }else{
                    alert($res1.error_message);
                }
            });//end ajax
        }

    //}, 500)    
})

function editTableData($user_id){
    $('#exampleModalLong').modal('show');
    $.ajax({
        method: "POST",
        url: "details/user_details/function.php",
        data: { fn: "getFormEditData", user_id: $user_id }
    })
    .done(function( res ) {
        //console.log(res);
        $res1 = JSON.parse(res);
        if($res1.status == true){
            $('#user_id').val($res1.user_id);
            $('#user_name').val($res1.user_name);
            $('#user_type_id').val($res1.user_type_id).trigger('change');
            $('#hospital_id').val($res1.hospital_id).trigger('change');
            $('#user_mobile').val($res1.user_mobile);
            $('#user_phone').val($res1.user_phone);
            $('#user_email').val($res1.user_email);
            $('#user_dob').val($res1.user_dob);
            $('#user_address').val($res1.user_address);
            $('#user_user_name').val($res1.user_user_name);
            $('#user_password').val($res1.user_password);
            $('#user_status').val($res1.user_status).trigger('change');  
            
        }
    });//end ajax

}

//Delete function	
function deleteTableData($user_id){
    if (confirm('Are you sure to delete the Data?')) {
        $.ajax({
            method: "POST",
            url: "details/user_details/function.php",
            data: { fn: "deleteTableData", user_id: $user_id }
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
        ajax: {'url': 'details/user_details/function.php?fn=getTableData' },
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
function configureUserTypeDropDown(){
    $.ajax({
        method: "POST",
        url: "details/user_details/function.php",
        data: { fn: "getAllUserType" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        if($res1.status == true){
            $rows = $res1.data;

            if($rows.length > 0){
                $('#user_type_id').html('');
                $option_user_type_id = "<option value='0'>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $option_user_type_id += "<option value='"+$rows[$i].user_type_id+"'>"+$rows[$i].user_type_name+"</option>";                    
                }//end for
                
                $('#user_type_id').html($option_user_type_id);
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
                $option_hospital_id = "<option value='0'>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $option_hospital_id += "<option value='"+$rows[$i].hospital_id+"'>"+$rows[$i].hospital_name+"</option>";                    
                }//end for
                
                $('#hospital_id').html($option_hospital_id);
            }//end if
        }        
    });//end ajax
}//end

$(document).ready(function () {
    configureUserTypeDropDown(); 
    configureHospitaDropDown(); 
    populateDataTable();
});