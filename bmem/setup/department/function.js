$('#onMyModal').on('click', function(){
    $('#department_id').val('0');
    $('#department_name').val('');
    $('#department_code').val('');
    $('#exampleModalLong').modal('show');
})

$('#department_name').on('blur', function(){
    $department_name = $('#department_name').val();
    $department_code = $department_name.replace(/ /g,"_");
    $('#department_code').val($department_code).toLowerCase();
})

function validateForm(){
    $department_id = $('#department_id').val();
    $department_name = $('#department_name').val().replace(/^\s+|\s+$/gm,'');
    $department_code = $('#department_code').val().replace(/^\s+|\s+$/gm,'');
    $department_status = $('#department_status').val();
    $status = true;

    if($department_name == ''){
        $status = false;
        $('#department_name').removeClass('is-valid');
        $('#department_name').addClass('is-invalid');
    }else{
        $('#department_name').removeClass('is-invalid');
        $('#department_name').addClass('is-valid');
    }   

    if($department_code == ''){
        $status = false;
        $('#department_code').removeClass('is-valid');
        $('#department_code').addClass('is-invalid');
    }else{
        $('#department_code').removeClass('is-invalid');
        $('#department_code').addClass('is-valid');
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
            $department_id = $('#department_id').val();

            $.ajax({
                method: "POST",
                url: "setup/department/function.php",
                data: { fn: "saveFormData", department_id: $department_id, department_name: $department_name, department_code: $department_code, department_status: $department_status }
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

function editTableData($department_id){
    $('#myForm')[0].reset();
    $("#post_video_link").hide();

    $.ajax({
        method: "POST",
        url: "setup/department/function.php",
        data: { fn: "getFormEditData", department_id: $department_id }
    })
    .done(function( res ) {
        //console.log(res);
        $res1 = JSON.parse(res);
        if($res1.status == true){ 
            $('#department_name').val($res1.department_name);  
            $('#department_code').val($res1.department_code); 
            $('#department_status').val($res1.department_status).trigger('change');   
            $('#department_id').val($res1.department_id);

            $('#exampleModalLong').modal('show');
        }
    });//end ajax

}

//Delete function	
function deleteTableData($department_id){
    if (confirm('Are you sure to delete the data?')) {
        $.ajax({
            method: "POST",
            url: "setup/department/function.php",
            data: { fn: "deleteTableData", department_id: $department_id }
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
        ajax: {'url': 'setup/department/function.php?fn=getTableData' },
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
        url: "setup/department/function.php",
        data: { fn: "getAllCategoryName" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        //console.log(JSON.stringify($res1));
        if($res1.status == true){
            $rows = $res1.data;

            if($rows.length > 0){
                $('#department_id').html('');
                $option_department_id = "<option value='0'>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $option_department_id += "<option data-department_code='"+$rows[$i].department_code+"' value='"+$rows[$i].department_id+"'>"+$rows[$i].department_name+"</option>";                    
                }//end for
                
                $('#department_id').html($option_department_id);
            }//end if
        }        
    });//end ajax
}//end

function configureAuthorDropDown(){
    $.ajax({
        method: "POST",
        url: "setup/department/function.php",
        data: { fn: "getAllAuthorsyName" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        //console.log(JSON.stringify($res1));
        if($res1.status == true){
            $rows = $res1.data;

            if($rows.length > 0){
                $('#department_name').html('');
                $option_department_name = "<option value='0'>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $option_department_name += "<option value='"+$rows[$i].department_name+"'>"+$rows[$i].author_name+"</option>";                    
                }//end for
                
                $('#department_name').html($option_department_name);
            }//end if
        }        
    });//end ajax
}//end

$(document).ready(function () {
    populateDataTable();
    //configureCategoryDropDown();
    //configureAuthorDropDown();
});