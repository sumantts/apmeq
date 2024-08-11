$('#onMyModal').on('click', function(){
    $('#exampleModalLong').modal('show');
})

$('#category_name').on('blur', function(){
    $category_name = $('#category_name').val();
    $category_slug = $category_name.replace(/ /g,"_");
    $('#category_slug').val($category_slug).toLowerCase();
})

function validateForm(){
    $designation = $('#designation').val().replace(/^\s+|\s+$/gm,'');
    $highestQualification = $('#highestQualification').val().replace(/^\s+|\s+$/gm,'');
    $dateOfJoining = $('#dateOfJoining').val().replace(/^\s+|\s+$/gm,'');
    $researchInterest = $('#researchInterest').val().replace(/^\s+|\s+$/gm,'');
    $status = true;

    if($designation == ''){
        $status = false;
        $('#designation').removeClass('is-valid');
        $('#designation').addClass('is-invalid');
    }else{
        $('#designation').removeClass('is-invalid');
        $('#designation').addClass('is-valid');
    }   

    if($highestQualification == ''){
        $status = false;
        $('#highestQualification').removeClass('is-valid');
        $('#highestQualification').addClass('is-invalid');
    }else{
        $('#highestQualification').removeClass('is-invalid');
        $('#highestQualification').addClass('is-valid');
    }    

    if($dateOfJoining == ''){
        $status = false;
        $('#dateOfJoining').removeClass('is-valid');
        $('#dateOfJoining').addClass('is-invalid');
    }else{
        $('#dateOfJoining').removeClass('is-invalid');
        $('#dateOfJoining').addClass('is-valid');
    }     

    if($researchInterest == ''){
        $status = false;
        $('#researchInterest').removeClass('is-valid');
        $('#researchInterest').addClass('is-invalid');
    }else{
        $('#researchInterest').removeClass('is-invalid');
        $('#researchInterest').addClass('is-valid');
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
            $designation = $('#designation').val().replace(/^\s+|\s+$/gm,'');
            $highestQualification = $('#highestQualification').val().replace(/^\s+|\s+$/gm,'');
            $secondaryEmail = $('#secondaryEmail').val().replace(/^\s+|\s+$/gm,'');
            $dateOfJoining = $('#dateOfJoining').val().replace(/^\s+|\s+$/gm,'');
            $teachingExperience = $('#teachingExperience').val().replace(/^\s+|\s+$/gm,'');
            $researchInterest = $('#researchInterest').val().replace(/^\s+|\s+$/gm,'');
            $indExperience = $('#indExperience').val().replace(/^\s+|\s+$/gm,'');	
            $author_id = $('#author_id').val();	
            $introduction_id = $('#introduction_id').val();

            $.ajax({
                method: "POST",
                url: "setup/introduction/function.php",
                data: { fn: "saveFormData", designation: $designation, highestQualification: $highestQualification, secondaryEmail: $secondaryEmail, dateOfJoining: $dateOfJoining, teachingExperience: $teachingExperience, researchInterest: $researchInterest, indExperience: $indExperience, author_id: $author_id, introduction_id: $introduction_id }
            })
            .done(function( res ) {
                //console.log(res);
                $res1 = JSON.parse(res);
                if($res1.status == true){
                    $('#orgFormAlert1').show();
                    //$('#myForm')[0].reset();
                    $('#author_id').val($res1.author_id);
                    $('#introduction_id').val($res1.introduction_id);

                    //$('#exampleModalLong').modal('hide');
                    //populateDataTable();
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
    $('#exampleModalLong').modal('show');

    /*$.ajax({
        method: "POST",
        url: "setup/introduction/function.php",
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
    });*/ //end ajax

}//end

//Delete function	
function deleteTableData($category_id){
    if (confirm('Are you sure to delete the data?')) {
        $.ajax({
            method: "POST",
            url: "setup/introduction/function.php",
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
        ajax: {'url': 'setup/introduction/function.php?fn=getTableData' },
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
        url: "setup/introduction/function.php",
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
        url: "setup/introduction/function.php",
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

function calculateDateDifference(date1, date2) {
    // Create two Date objects from the input dates.
    const startDate = new Date(date1);
    const endDate = new Date(date2);
  
    // Calculate the difference in milliseconds between the two dates.
    const timeDifference = endDate.getTime() - startDate.getTime();
  
    // Convert the time difference to days.
    const daysDifference = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
  
    // Calculate the difference in years.
    const yearsDifference = Math.floor(daysDifference / 365);
  
    // Calculate the difference in months.
    const monthsDifference = Math.floor((daysDifference % 365) / 30);
  
    // Return the difference in years, months, and days.
    return {
      years: yearsDifference,
      months: monthsDifference,
      days: daysDifference % 30,
    };
  }
  
  // Example usage:
  
  

  $('#dateOfJoining').on('change', function(){
    console.log('connecting...');
    const today = new Date().toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'numeric',
        day: 'numeric',
      });
    console.log(today); // "2023-06-14"

    $dateOfJoining = $('#dateOfJoining').val();
    const date1 = new Date($dateOfJoining);
    const date2 = new Date(today);
    
    const dateDifference = calculateDateDifference(date1, date2);
    
    console.log(dateDifference); // { years: 1, months: 1, days: 25 }
    $teachingExperienceTxt = dateDifference.years + ' years ' + dateDifference.months + ' months ' + dateDifference.days + ' days';
    $('#teachingExperience').val($teachingExperienceTxt)
  })