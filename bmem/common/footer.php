
    <!-- Warning Section start -->
    <!-- Older IE warning message -->
    <!--[if lt IE 11]>
        <div class="ie-warning">
            <h1>Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade
               <br/>to any of the following web browsers to access this website.
            </p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="assets/images/browser/chrome.png" alt="Chrome">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="assets/images/browser/firefox.png" alt="Firefox">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="assets/images/browser/opera.png" alt="Opera">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="assets/images/browser/safari.png" alt="Safari">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="assets/images/browser/ie.png" alt="">
                            <div>IE (11 & above)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>
    <![endif]-->
    <!-- Warning Section Ends -->

    

    <!-- Modal start -->
    <div id="updateProfileModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateProfileModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProfileModalTitle">Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="profile_name" class="col-form-label">Profile Name</label>
                            <input type="text" class="form-control" id="profile_name" value="<?=$_SESSION["profile_name"]?>">
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-form-label">Username</label>
                            <input type="text" class="form-control" id="username" value="<?=$_SESSION["username"]?>">
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Password</label>
                            <input type="text" class="form-control" id="password" value="<?=$_SESSION["password"]?>">
                        </div>
                                    
                        <div class="form-group">
                        <div class="col-md-12 mb-2 mt-4">
                            <input type="file" accept="image/*" class="custom-file-input" id="author_photo" aria-describedby="author_photo"  onchange="savePhoto()">
                            <label class="custom-file-label" for="validatedCustomFile">Choose image...</label>
                            <small id="author_photoError" class="form-text text-danger"> </small>
                            <img src="<?=$_SESSION["author_photo"]?>" id="image" width="100">
                        </div> 
                        </div> 

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="updateProfile" class="btn  btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->

    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>

    <?php if($p == 'dashboard'){?>    
        <!-- Apex Chart -->
        <script src="assets/js/plugins/apexcharts.min.js"></script>
        <!-- custom-chart js -->
        <script src="assets/js/pages/dashboard-main.js"></script>
    <?php } ?>
    
    <script>
        //Left menu Scroll up to nth position
        $(document).ready(function(){
            var gr_offset = $('#<?=$gr?>').offset();
            var upto = parseInt(gr_offset.top) - 50;
            $("#nav_bar").scrollTop(upto, 0);
        });

        // common for all function.js page 
        //Loading screen
        $body = $("body");
        $(document).on({
            ajaxStart: function() { $body.addClass("loading"); },
            ajaxStop: function() { $body.removeClass("loading"); }    
        });
        // common for all function.js page 

        $('#updateProfile').click(function(){
            
            $profile_name = $('#profile_name').val();
            $username = $('#username').val();
            $password = $('#password').val();
            $author_photo = localStorage.getItem('author_photo');

            if($profile_name == ''){
                alert('Please enter profile name');
                $('#profile_name').focus();
            }else if($username == ''){
                alert('Please enter user name');
                $('#username').focus();
            }else if($password == ''){
                alert('Please enter password');
                $('#password').focus();
            }else{
                $.ajax({
                    method: "POST",
                    url: "signin/function.php",
                    data: { fn: "updateProfile", profile_name: $profile_name, username: $username, password: $password, author_photo: $author_photo }
                })
                .done(function( res ) {
                    console.log(res);
                    $res1 = JSON.parse(res);
                    // $('#signin_spinner').hide();
                    // $('#signin_spinner_text').hide();
                    // $('#signin_text').show();

                    if($res1.status == true){
                        $('#updateProfileModal').modal('hide');
                        localStorage.setItem('author_photo', '');
                        alert('Profile Updated. You will be log out automatically, Please login again')
                        window.location.href = '?p=signin&log=out';
                    }else{
                        $('#updateProfileModal').modal('hide');
                        //alert($res1.message);
                        //$('#error_text').html('Wrong username or password');
                    }
                });//end ajax
            }

        });//end function

        //Photo function
        

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
        
    </script>
    
    <!-- Place at bottom of page Loading -->
    <div class="modalSpinner"></div>
    <!-- //Place at bottom of page Loading-->
<!-- start for data table  -->

<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- End for data table -->

<!-- Select 2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>