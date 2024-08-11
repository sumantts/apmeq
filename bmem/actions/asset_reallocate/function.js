$('#onMyModal').on('click', function(){
    $('#exampleModalLong').modal('show');
})

$('#category_name').on('blur', function(){
    $category_name = $('#category_name').val();
    $category_slug = $category_name.replace(/ /g,"_");
    $('#category_slug').val($category_slug).toLowerCase();
})

function validateForm(){
    $category_id = $('#category_id').val();
    $category_name = $('#category_name').val().replace(/^\s+|\s+$/gm,'');
    $category_slug = $('#category_slug').val().replace(/^\s+|\s+$/gm,'');
    $activity_status = $('#activity_status').val();
    $status = true;

    if($category_name == ''){
        $status = false;
        $('#category_name').removeClass('is-valid');
        $('#category_name').addClass('is-invalid');
    }else{
        $('#category_name').removeClass('is-invalid');
        $('#category_name').addClass('is-valid');
    }   

    if($category_slug == ''){
        $status = false;
        $('#category_slug').removeClass('is-valid');
        $('#category_slug').addClass('is-invalid');
    }else{
        $('#category_slug').removeClass('is-invalid');
        $('#category_slug').addClass('is-valid');
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
    setTimeout(function(){
        $formVallidStatus = validateForm();

        if($formVallidStatus == true){
            $published = $('#published').val();
            $category_id = $('#category_id').val();

            $.ajax({
                method: "POST",
                url: "actions/asset_reallocate/function.php",
                data: { fn: "saveFormData", category_id: $category_id, category_name: $category_name, category_slug: $category_slug, activity_status: $activity_status }
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

    }, 500)    
})

function editTableData($category_id){
    $('#myForm')[0].reset();
    $("#post_video_link").hide();

    $.ajax({
        method: "POST",
        url: "actions/asset_reallocate/function.php",
        data: { fn: "getFormEditData", category_id: $category_id }
    })
    .done(function( res ) {
        //console.log(res);
        $res1 = JSON.parse(res);
        if($res1.status == true){ 
            $('#category_name').val($res1.category_name);  
            $('#category_slug').val($res1.category_slug); 
            $('#activity_status').val($res1.activity_status).trigger('change');   
            $('#category_id').val($res1.category_id);

            $('#exampleModalLong').modal('show');
        }
    });//end ajax

}

//Delete function	
function deleteTableData($category_id){
    if (confirm('Are you sure to delete the data?')) {
        $.ajax({
            method: "POST",
            url: "actions/asset_reallocate/function.php",
            data: { fn: "deleteTableData", category_id: $category_id }
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
        ajax: {'url': 'actions/asset_reallocate/function.php?fn=getTableData' },
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
        url: "actions/asset_reallocate/function.php",
        data: { fn: "getAllCategoryName" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        //console.log(JSON.stringify($res1));
        if($res1.status == true){
            $rows = $res1.data;

            if($rows.length > 0){
                $('#category_id').html('');
                $option_category_id = "<option value='0'>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $option_category_id += "<option data-category_slug='"+$rows[$i].category_slug+"' value='"+$rows[$i].category_id+"'>"+$rows[$i].category_name+"</option>";                    
                }//end for
                
                $('#category_id').html($option_category_id);
            }//end if
        }        
    });//end ajax
}//end

function configureAuthorDropDown(){
    $.ajax({
        method: "POST",
        url: "actions/asset_reallocate/function.php",
        data: { fn: "getAllAuthorsyName" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        //console.log(JSON.stringify($res1));
        if($res1.status == true){
            $rows = $res1.data;

            if($rows.length > 0){
                $('#category_name').html('');
                $option_category_name = "<option value='0'>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $option_category_name += "<option value='"+$rows[$i].category_name+"'>"+$rows[$i].author_name+"</option>";                    
                }//end for
                
                $('#category_name').html($option_category_name);
            }//end if
        }        
    });//end ajax
}//end

$(document).ready(function () {
    populateDataTable();
    //configureCategoryDropDown();
    //configureAuthorDropDown();
});