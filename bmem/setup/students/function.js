$('#onMyModal').on('click', function(){
    localStorage.setItem('author_photo', '');
    clearForm();
    $('#exampleModalLong').modal('show');
})

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

    $('#author_id').val('0');           
    let img = document.getElementById('image');
    img.src = '';

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
            $category_id = $('#category_id').val();
            $author_id = $('#author_id').val();
            $author_photo = localStorage.getItem('author_photo');
            $author_status = $('#author_status').val();
            $for_the_year = $('#for_the_year').val();
            $course_id = 0;//$('#course_id').val();

            $.ajax({
                method: "POST",
                url: "setup/students/function.php",
                data: { fn: "saveFormData", category_id: $category_id, for_the_year: $for_the_year, course_id: $course_id, author_id: $author_id, author_name: $author_name, email: $email, registration_number: $registration_number, author_photo: $author_photo, author_status: $author_status }
            })
            .done(function( res ) {
                //console.log(res);
                $res1 = JSON.parse(res);
                if($res1.status == true){
                    $('#orgFormAlert1').css("display", "block");
                    $('.toast-right').toast('show');
                    //$('#liveToast').toast('show');
                    clearForm();
                    localStorage.setItem('author_photo', '');
                    $('#exampleModalLong').modal('hide');
                    populateDataTable();
                }else{
                    alert($res1.error_message);
                }
            });//end ajax
        }

    //}, 500)    
})

function editTableData($author_id){
    $('#exampleModalLong').modal('show');
    $.ajax({
        method: "POST",
        url: "setup/students/function.php",
        data: { fn: "getFormEditData", author_id: $author_id }
    })
    .done(function( res ) {
        //console.log(res);
        $res1 = JSON.parse(res);
        if($res1.status == true){
            $('#category_id').val($res1.category_id).trigger('change');
            $('#for_the_year').val($res1.for_the_year).trigger('change');
            $('#author_name').val($res1.author_name);
            $('#email').val($res1.email);            
            $('#registration_number').val($res1.registration_number); 
            let img = document.getElementById('image');
            img.src = $res1.author_photo;
            localStorage.setItem("author_photo", $res1.author_photo);
            $('#author_status').val($res1.author_status).trigger('change');  
            $('#author_id').val($author_id);
        }
    });//end ajax

}

//Delete function	
function deleteTableData($author_id){
    if (confirm('Are you sure to delete the Data?')) {
        $.ajax({
            method: "POST",
            url: "setup/students/function.php",
            data: { fn: "deleteTableData", author_id: $author_id }
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
        ajax: {'url': 'setup/students/function.php?fn=getTableData' },
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
function configureCategoryDropDown(){
    $.ajax({
        method: "POST",
        url: "setup/students/function.php",
        data: { fn: "getAllCategoryName" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
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

//Course
function configureCourseDropDown(){
    $.ajax({
        method: "POST",
        url: "setup/students/function.php",
        data: { fn: "getAllCourseName" }
    })
    .done(function( res ) {
        $res1 = JSON.parse(res);
        if($res1.status == true){
            $rows = $res1.data;

            if($rows.length > 0){
                $('#course_id').html('');
                $option_course_id = "<option value='0'>Select</option>";

                for($i = 0; $i < $rows.length; $i++){
                    $option_course_id += "<option data-course_fee='"+$rows[$i].course_fee+"' data-course_duration='"+$rows[$i].course_duration+"' value='"+$rows[$i].course_id+"'>"+$rows[$i].course_name+"</option>";                    
                }//end for
                
                $('#course_id').html($option_course_id);
            }//end if
        }        
    });//end ajax
}//end

$(document).ready(function () {
    configureCategoryDropDown(); 
    configureCourseDropDown(); 
    populateDataTable();
});