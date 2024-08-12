$('#onMyModal').on('click', function(){
    $('#supplier_id').val('0');
    $('#supplier_name').val('');
    $('#supplier_code').val('');
    $('#primary_contact_number').val('');
    $('#secondary_contact_number').val('');

    $supplier_status = $('#supplier_status').val();
    $('#exampleModalLong').modal('show');
})

$('#supplier_name').on('blur', function(){
    $supplier_name = $('#supplier_name').val();
    $supplier_code = $supplier_name.replace(/ /g,"_");
    $('#supplier_code').val($supplier_code).toLowerCase();
})

function validateForm(){
    $supplier_id = $('#supplier_id').val();
    $supplier_name = $('#supplier_name').val().replace(/^\s+|\s+$/gm,'');
    $supplier_code = $('#supplier_code').val().replace(/^\s+|\s+$/gm,'');
    $primary_contact_number = $('#primary_contact_number').val().replace(/^\s+|\s+$/gm,'');
    $secondary_contact_number = $('#secondary_contact_number').val().replace(/^\s+|\s+$/gm,'');
    $supplier_status = $('#supplier_status').val();
    $status = true;

    if($supplier_name == ''){
        $status = false;
        $('#supplier_name').removeClass('is-valid');
        $('#supplier_name').addClass('is-invalid');
    }else{
        $('#supplier_name').removeClass('is-invalid');
        $('#supplier_name').addClass('is-valid');
    }   

    if($supplier_code == ''){
        $status = false;
        $('#supplier_code').removeClass('is-valid');
        $('#supplier_code').addClass('is-invalid');
    }else{
        $('#supplier_code').removeClass('is-invalid');
        $('#supplier_code').addClass('is-valid');
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
            $supplier_id = $('#supplier_id').val();

            $.ajax({
                method: "POST",
                url: "details/supplier/function.php",
                data: { fn: "saveFormData", supplier_id: $supplier_id, supplier_name: $supplier_name, supplier_code: $supplier_code, primary_contact_number: $primary_contact_number, secondary_contact_number: $secondary_contact_number, supplier_status: $supplier_status }
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

function editTableData($supplier_id){
    $('#myForm')[0].reset();
    $("#post_video_link").hide();

    $.ajax({
        method: "POST",
        url: "details/supplier/function.php",
        data: { fn: "getFormEditData", supplier_id: $supplier_id }
    })
    .done(function( res ) {
        //console.log(res);
        $res1 = JSON.parse(res);
        if($res1.status == true){ 
            $('#supplier_name').val($res1.supplier_name);  
            $('#supplier_code').val($res1.supplier_code); 
            $('#primary_contact_number').val($res1.primary_contact_number); 
            $('#secondary_contact_number').val($res1.secondary_contact_number); 
            $('#supplier_status').val($res1.supplier_status).trigger('change');   
            $('#supplier_id').val($res1.supplier_id);

            $('#exampleModalLong').modal('show');
        }
    });//end ajax

}

//Delete function	
function deleteTableData($supplier_id){
    if (confirm('Are you sure to delete the data?')) {
        $.ajax({
            method: "POST",
            url: "details/supplier/function.php",
            data: { fn: "deleteTableData", supplier_id: $supplier_id }
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
        ajax: {'url': 'details/supplier/function.php?fn=getTableData' },
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
        url: "details/supplier/function.php",
        data: { fn: "getAllCategoryName" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        //console.log(JSON.stringify($res1));
        if($res1.status == true){
            $rows = $res1.data;

            if($rows.length > 0){
                $('#supplier_id').html('');
                $option_supplier_id = "<option value='0'>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $option_supplier_id += "<option data-supplier_code='"+$rows[$i].supplier_code+"' value='"+$rows[$i].supplier_id+"'>"+$rows[$i].supplier_name+"</option>";                    
                }//end for
                
                $('#supplier_id').html($option_supplier_id);
            }//end if
        }        
    });//end ajax
}//end

function configureAuthorDropDown(){
    $.ajax({
        method: "POST",
        url: "details/supplier/function.php",
        data: { fn: "getAllAuthorsyName" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        //console.log(JSON.stringify($res1));
        if($res1.status == true){
            $rows = $res1.data;

            if($rows.length > 0){
                $('#supplier_name').html('');
                $option_supplier_name = "<option value='0'>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $option_supplier_name += "<option value='"+$rows[$i].supplier_name+"'>"+$rows[$i].author_name+"</option>";                    
                }//end for
                
                $('#supplier_name').html($option_supplier_name);
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