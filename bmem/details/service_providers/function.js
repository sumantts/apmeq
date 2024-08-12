$('#onMyModal').on('click', function(){
    $('#service_providers_id').val('0');
    $('#service_providers_name').val('');
    $('#service_providers_code').val('');
    $('#primary_contact_number').val('');
    $('#secondary_contact_number').val('');

    $service_providers_status = $('#service_providers_status').val();
    $('#exampleModalLong').modal('show');
})

$('#service_providers_name').on('blur', function(){
    $service_providers_name = $('#service_providers_name').val();
    $service_providers_code = $service_providers_name.replace(/ /g,"_");
    $('#service_providers_code').val($service_providers_code).toLowerCase();
})

function validateForm(){
    $service_providers_id = $('#service_providers_id').val();
    $service_providers_name = $('#service_providers_name').val().replace(/^\s+|\s+$/gm,'');
    $service_providers_code = $('#service_providers_code').val().replace(/^\s+|\s+$/gm,'');
    $primary_contact_number = $('#primary_contact_number').val().replace(/^\s+|\s+$/gm,'');
    $secondary_contact_number = $('#secondary_contact_number').val().replace(/^\s+|\s+$/gm,'');
    $service_providers_status = $('#service_providers_status').val();
    $status = true;

    if($service_providers_name == ''){
        $status = false;
        $('#service_providers_name').removeClass('is-valid');
        $('#service_providers_name').addClass('is-invalid');
    }else{
        $('#service_providers_name').removeClass('is-invalid');
        $('#service_providers_name').addClass('is-valid');
    }   

    if($service_providers_code == ''){
        $status = false;
        $('#service_providers_code').removeClass('is-valid');
        $('#service_providers_code').addClass('is-invalid');
    }else{
        $('#service_providers_code').removeClass('is-invalid');
        $('#service_providers_code').addClass('is-valid');
    }   

    if($primary_contact_number == ''){
        $status = false;
        $('#primary_contact_number').removeClass('is-valid');
        $('#primary_contact_number').addClass('is-invalid');
    }else{
        $('#primary_contact_number').removeClass('is-invalid');
        $('#primary_contact_number').addClass('is-valid');
    }  

    $('#submitForm_spinner').hide();
    $('#submitForm_spinner_text').hide();
    $('#submitForm_text').show();

    return $status;
}//en validate form

$('#submitForm').click(function(){
    $('#submitForm_spinner').show();
    $('#submitForm_spinner_text').show();
    $('#submitForm_text').hide();
    //setTimeout(function(){
        $formVallidStatus = validateForm();

        if($formVallidStatus == true){
            $published = $('#published').val();
            $service_providers_id = $('#service_providers_id').val();

            $.ajax({
                method: "POST",
                url: "details/service_providers/function.php",
                data: { fn: "saveFormData", service_providers_id: $service_providers_id, service_providers_name: $service_providers_name, service_providers_code: $service_providers_code, primary_contact_number: $primary_contact_number, secondary_contact_number: $secondary_contact_number, service_providers_status: $service_providers_status }
            })
            .done(function( res ) {
                //console.log(res);
                $res1 = JSON.parse(res);
                if($res1.status == true){
                    $('#orgFormAlert1').show();
                    $('#myForm')[0].reset();
                    $('#exampleModalLong').modal('hide');
                    populateDataTable();
                }else{
                    
                }                
                $('#submitForm_spinner').hide();
                $('#submitForm_spinner_text').hide();
                $('#submitForm_text').show();
            });//end ajax
        }

    //}, 500)    
})

function editTableData($service_providers_id){
    $('#myForm')[0].reset();
    $("#post_video_link").hide();

    $.ajax({
        method: "POST",
        url: "details/service_providers/function.php",
        data: { fn: "getFormEditData", service_providers_id: $service_providers_id }
    })
    .done(function( res ) {
        //console.log(res);
        $res1 = JSON.parse(res);
        if($res1.status == true){ 
            $('#service_providers_name').val($res1.service_providers_name);  
            $('#service_providers_code').val($res1.service_providers_code); 
            $('#primary_contact_number').val($res1.primary_contact_number); 
            $('#secondary_contact_number').val($res1.secondary_contact_number); 
            $('#service_providers_status').val($res1.service_providers_status).trigger('change');   
            $('#service_providers_id').val($res1.service_providers_id);

            $('#exampleModalLong').modal('show');
        }
    });//end ajax

}

//Delete function	
function deleteTableData($service_providers_id){
    if (confirm('Are you sure to delete the data?')) {
        $.ajax({
            method: "POST",
            url: "details/service_providers/function.php",
            data: { fn: "deleteTableData", service_providers_id: $service_providers_id }
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
        localStorage.setItem("post_image", reader.result);
        $('#post_image_data').val(reader.result);
    }, false);

    if (imgPath) {
        reader.readAsDataURL(imgPath);
    }

    //To display image again
    setTimeout(function(){
    let img = document.getElementById('image');
    img.src = localStorage.getItem('post_image');
    }, 250);
}


function populateDataTable(){
    $('#example').dataTable().fnClearTable();
    $('#example').dataTable().fnDestroy();

    $('#example').DataTable({ 
        responsive: true,
        serverMethod: 'GET',
        ajax: {'url': 'details/service_providers/function.php?fn=getTableData' },
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
        order: [[1, 'asc']],

    });
}//end fun

/*
function configureCategoryDropDown(){
    $.ajax({
        method: "POST",
        url: "details/service_providers/function.php",
        data: { fn: "getAllCategoryName" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        //console.log(JSON.stringify($res1));
        if($res1.status == true){
            $rows = $res1.data;

            if($rows.length > 0){
                $('#service_providers_id').html('');
                $option_service_providers_id = "<option value='0'>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $option_service_providers_id += "<option data-service_providers_code='"+$rows[$i].service_providers_code+"' value='"+$rows[$i].service_providers_id+"'>"+$rows[$i].service_providers_name+"</option>";                    
                }//end for
                
                $('#service_providers_id').html($option_service_providers_id);
            }//end if
        }        
    });//end ajax
}//end

function configureAuthorDropDown(){
    $.ajax({
        method: "POST",
        url: "details/service_providers/function.php",
        data: { fn: "getAllAuthorsyName" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        //console.log(JSON.stringify($res1));
        if($res1.status == true){
            $rows = $res1.data;

            if($rows.length > 0){
                $('#service_providers_name').html('');
                $option_service_providers_name = "<option value='0'>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $option_service_providers_name += "<option value='"+$rows[$i].service_providers_name+"'>"+$rows[$i].author_name+"</option>";                    
                }//end for
                
                $('#service_providers_name').html($option_service_providers_name);
            }//end if
        }        
    });//end ajax
}//end
*/

$(document).ready(function () {
    populateDataTable();
    //configureCategoryDropDown();
    //configureAuthorDropDown();
});