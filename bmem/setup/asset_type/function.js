$('#onMyModal').on('click', function(){
    $('#asset_type_id').val('0');
    $('#asset_type_name').val('');
    $('#asset_type_code').val('');
    $('#asset_type_status').val('1').trigger('change');
    $('#exampleModalLong').modal('show');
})

$('#asset_type_name').on('blur', function(){
    $asset_type_name = $('#asset_type_name').val();
    $asset_type_code = $asset_type_name.replace(/ /g,"_");
    $('#asset_type_code').val($asset_type_code).toLowerCase();
})

function validateForm(){
    $asset_type_id = $('#asset_type_id').val();
    $asset_type_name = $('#asset_type_name').val().replace(/^\s+|\s+$/gm,'');
    $asset_type_code = $('#asset_type_code').val().replace(/^\s+|\s+$/gm,'');
    $asset_type_status = $('#asset_type_status').val();
    $status = true;

    if($asset_type_name == ''){
        $status = false;
        $('#asset_type_name').removeClass('is-valid');
        $('#asset_type_name').addClass('is-invalid');
    }else{
        $('#asset_type_name').removeClass('is-invalid');
        $('#asset_type_name').addClass('is-valid');
    }   

    if($asset_type_code == ''){
        $status = false;
        $('#asset_type_code').removeClass('is-valid');
        $('#asset_type_code').addClass('is-invalid');
    }else{
        $('#asset_type_code').removeClass('is-invalid');
        $('#asset_type_code').addClass('is-valid');
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
            $asset_type_id = $('#asset_type_id').val();

            $.ajax({
                method: "POST",
                url: "setup/asset_type/function.php",
                data: { fn: "saveFormData", asset_type_id: $asset_type_id, asset_type_name: $asset_type_name, asset_type_code: $asset_type_code, asset_type_status: $asset_type_status }
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

function editTableData($asset_type_id){
    $('#myForm')[0].reset();
    $("#post_video_link").hide();

    $.ajax({
        method: "POST",
        url: "setup/asset_type/function.php",
        data: { fn: "getFormEditData", asset_type_id: $asset_type_id }
    })
    .done(function( res ) {
        //console.log(res);
        $res1 = JSON.parse(res);
        if($res1.status == true){ 
            $('#asset_type_name').val($res1.asset_type_name);  
            $('#asset_type_code').val($res1.asset_type_code); 
            $('#asset_type_status').val($res1.asset_type_status).trigger('change');   
            $('#asset_type_id').val($res1.asset_type_id);

            $('#exampleModalLong').modal('show');
        }
    });//end ajax

}

//Delete function	
function deleteTableData($asset_type_id){
    if (confirm('Are you sure to delete the data?')) {
        $.ajax({
            method: "POST",
            url: "setup/asset_type/function.php",
            data: { fn: "deleteTableData", asset_type_id: $asset_type_id }
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
        ajax: {'url': 'setup/asset_type/function.php?fn=getTableData' },
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
        url: "setup/asset_type/function.php",
        data: { fn: "getAllCategoryName" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        //console.log(JSON.stringify($res1));
        if($res1.status == true){
            $rows = $res1.data;

            if($rows.length > 0){
                $('#asset_type_id').html('');
                $option_asset_type_id = "<option value='0'>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $option_asset_type_id += "<option data-asset_type_code='"+$rows[$i].asset_type_code+"' value='"+$rows[$i].asset_type_id+"'>"+$rows[$i].asset_type_name+"</option>";                    
                }//end for
                
                $('#asset_type_id').html($option_asset_type_id);
            }//end if
        }        
    });//end ajax
}//end

$(document).ready(function () {
    populateDataTable();
    //configureCategoryDropDown();
});