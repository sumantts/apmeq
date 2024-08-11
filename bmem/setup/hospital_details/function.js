$('#onMyModal').on('click', function(){
    $('#exampleModalLong').modal('show');
})

$('#hospital_name').on('blur', function(){
    $hospital_name = $('#hospital_name').val();
    $hospital_code = $hospital_name.replace(/ /g,"_");
    $('#hospital_code').val($hospital_code).toLowerCase();
})

function validateForm(){
    $hospital_id = $('#hospital_id').val();
    $hospital_name = $('#hospital_name').val().replace(/^\s+|\s+$/gm,'');
    $hospital_code = $('#hospital_code').val().replace(/^\s+|\s+$/gm,'');
    $hospital_status = $('#hospital_status').val();
    $status = true;

    if($hospital_name == ''){
        $status = false;
        $('#hospital_name').removeClass('is-valid');
        $('#hospital_name').addClass('is-invalid');
    }else{
        $('#hospital_name').removeClass('is-invalid');
        $('#hospital_name').addClass('is-valid');
    }   

    if($hospital_code == ''){
        $status = false;
        $('#hospital_code').removeClass('is-valid');
        $('#hospital_code').addClass('is-invalid');
    }else{
        $('#hospital_code').removeClass('is-invalid');
        $('#hospital_code').addClass('is-valid');
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
            $hospital_id = $('#hospital_id').val();
            $hospital_address = $('#hospital_address').val();

            $.ajax({
                method: "POST",
                url: "setup/hospital_details/function.php",
                data: { fn: "saveFormData", hospital_id: $hospital_id, hospital_name: $hospital_name, hospital_code: $hospital_code, hospital_status: $hospital_status, hospital_address: $hospital_address }
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

function editTableData($hospital_id){
    $('#myForm')[0].reset();
    $("#post_video_link").hide();

    $.ajax({
        method: "POST",
        url: "setup/hospital_details/function.php",
        data: { fn: "getFormEditData", hospital_id: $hospital_id }
    })
    .done(function( res ) {
        //console.log(res);
        $res1 = JSON.parse(res);
        if($res1.status == true){ 
            $('#hospital_name').val($res1.hospital_name);  
            $('#hospital_code').val($res1.hospital_code); 
            $('#hospital_status').val($res1.hospital_status).trigger('change');   
            $('#hospital_address').val($res1.hospital_address);
            $('#hospital_id').val($res1.hospital_id);

            $('#exampleModalLong').modal('show');
        }
    });//end ajax

}

//Delete function	
function deleteTableData($hospital_id){
    if (confirm('Are you sure to delete the data?')) {
        $.ajax({
            method: "POST",
            url: "setup/hospital_details/function.php",
            data: { fn: "deleteTableData", hospital_id: $hospital_id }
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
        ajax: {'url': 'setup/hospital_details/function.php?fn=getTableData' },
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

function configureCategoryDropDown(){
    $.ajax({
        method: "POST",
        url: "setup/hospital_details/function.php",
        data: { fn: "getAllCategoryName" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        //console.log(JSON.stringify($res1));
        if($res1.status == true){
            $rows = $res1.data;

            if($rows.length > 0){
                $('#hospital_id').html('');
                $option_hospital_id = "<option value='0'>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $option_hospital_id += "<option data-hospital_code='"+$rows[$i].hospital_code+"' value='"+$rows[$i].hospital_id+"'>"+$rows[$i].hospital_name+"</option>";                    
                }//end for
                
                $('#hospital_id').html($option_hospital_id);
            }//end if
        }        
    });//end ajax
}//end

function configureAuthorDropDown(){
    $.ajax({
        method: "POST",
        url: "setup/hospital_details/function.php",
        data: { fn: "getAllAuthorsyName" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        //console.log(JSON.stringify($res1));
        if($res1.status == true){
            $rows = $res1.data;

            if($rows.length > 0){
                $('#hospital_name').html('');
                $option_hospital_name = "<option value='0'>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $option_hospital_name += "<option value='"+$rows[$i].hospital_name+"'>"+$rows[$i].author_name+"</option>";                    
                }//end for
                
                $('#hospital_name').html($option_hospital_name);
            }//end if
        }        
    });//end ajax
}//end

$(document).ready(function () {
    populateDataTable();
    //configureCategoryDropDown();
    //configureAuthorDropDown();
});