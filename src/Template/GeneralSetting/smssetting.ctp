
<!-- Main content -->
<section class="content">
 <?php  //$details = $generalSetting[0];  ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title">Select Automatic Notification Areas</h4>
                </div>
                <div class="panel-body" id='main_id'>
                    <div class="alert alert-success warning">
                        <!--<span class="icon-warning icon-2x" style="color:orange"></span>-->
                        If you want to incorporate student information from the database in the message, then you have to include certain codes in the place of student information.                        <br>
                        The codes are:
                        <br>
                        Code for student (Student Name :#B#, Student admission number/reference number :#C# , Course :#D#, Batch : #E#).
                        <br>
                        Code for exam (Exam Name: #B#, Subject: #C# ).
                        <br>
                        Code for fees (Amount: #B#, Due Date: #C# ).
                        <br>
                        Code for event (Start Date: #B#, End Date: #C#, Event: #D# ).
<!--                        <br>
                        Code for url (Phone Number: #no#, Message: #message#).-->
<!--                      <br>
                     Code for Transport Allocation (Route: #route#, Destination: #destination#, Amount: #amount#).-->
                    <br /><br />
                    <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#add-example">Click here</button>
                    <br />
                    </div>
                    <div class="col-sm-12">
                        
                        <div class="col-sm-12">
                            <div class="col-sm-2"><label>&nbsp;&nbsp;&nbsp;URL</label></div>
                            <div class="col-sm-10"><label><input type="text" readonly="" class="form-control" id="url" value="" size="130"></label></div>
                            <div class="col-sm-2"><label>Admission</label></div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" value="1" id="inline_optionsRadios1" <?php echo  $settings[0]['admission'] ===1 ? 'checked' : ''  ?> name="inline_optionsRadios">
                                        Guardian                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="2" id="inline_optionsRadios2" <?php echo  $settings[0]['admission'] ===2 ? 'checked' : ''  ?>  name="inline_optionsRadios">
                                        Student                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="3" id="inline_optionsRadios3" <?php echo  $settings[0]['admission'] ===3 ? 'checked' : ''  ?> name="inline_optionsRadios">
                                        Parents                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="4" id="inline_optionsRadios4" <?php echo $settings[0]['admission'] ===4 ? 'checked' : ''  ?> name="inline_optionsRadios">
                                        All                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-5"><label><textarea name="comment" rows="4" cols="50" id="admission_msg" placeholder=Message Format><?php echo $settings[0]['admission_msg'];  ?></textarea></label>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="col-sm-2"><label>Absent/Leave</label></div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" value="1" id="inline_optionsRadios4" <?php echo  $settings[0]['absent'] ===1 ? 'checked' : ''  ?> name="inline_optionsRadios1">
                                        Guardian                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="2" id="inline_optionsRadios5" <?php echo  $settings[0]['absent'] ===2 ? 'checked' : ''  ?> name="inline_optionsRadios1">
                                        Student                                    </label>
                                    <label class="radio-inline">
                                         <input type="radio" value="3" id="inline_optionsRadios6" <?php echo  $settings[0]['absent'] ===3 ? 'checked' : ''  ?> name="inline_optionsRadios1">
                                        Parents                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="4" id="inline_optionsRadios4" <?php echo  $settings[0]['absent'] ===4 ? 'checked' : ''  ?> name="inline_optionsRadios1">
                                        All                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-5 hidden"><label><textarea name="comment" rows="4" cols="50" id="absent_msg" readonly placeholder=Message Format><?php echo $settings[0]['absent_msg'];  ?></textarea></label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-2"><label>Present</label></div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" value="1" id="inline_optionsRadios7" <?php echo  $settings[0]['examcreation'] ===1 ? 'checked' : ''  ?> name="inline_optionsRadios2">
                                        Guardian                                    </label>
                                    <label class="radio-inline">
                                         <input type="radio" value="2" id="inline_optionsRadios8" <?php echo  $settings[0]['examcreation'] ===2 ? 'checked' : ''  ?> name="inline_optionsRadios2">
                                        Student                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="3" id="inline_optionsRadios9" <?php echo  $settings[0]['examcreation'] ===3 ? 'checked' : ''  ?> name="inline_optionsRadios2">
                                        Parents                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="4" id="inline_optionsRadios4" <?php echo  $settings[0]['examcreation'] ===4 ? 'checked' : ''  ?> name="inline_optionsRadios2">
                                        All                                    </label>
                                </div>
                            </div>
                             <div class="col-sm-5 hidden"><label><textarea name="comment" rows="4" cols="50" id="examcreation_msg" readonly placeholder=Message Format><?php echo $settings[0]['examcreation_msg'];  ?></textarea></label>
                            </div>
                        </div>

                        <div class="col-sm-12 hidden">
                            <div class="col-sm-2"><label>Exam Results</label></div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" value="1" id="inline_optionsRadios10" <?php echo  $settings[0]['examresults'] ===1 ? 'checked' : ''  ?> name="inline_optionsRadios3">
                                        Guardian                                    </label>
                                    <label class="radio-inline">
                                         <input type="radio" value="2" id="inline_optionsRadios11" <?php echo  $settings[0]['examresults'] ===2 ? 'checked' : ''  ?> name="inline_optionsRadios3">
                                        Student                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="3"  id="inline_optionsRadios12" <?php echo  $settings[0]['examresults'] ===3 ? 'checked' : ''  ?> name="inline_optionsRadios3">
                                        Parents                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="4" id="inline_optionsRadios4" <?php echo  $settings[0]['examresults'] ===4 ? 'checked' : ''  ?> name="inline_optionsRadios3">  
                                        All                                    </label>
                                </div>
                            </div>
                             <div class="col-sm-5"><label><textarea name="comment" rows="4" cols="50" id="examresults_msg" placeholder=Message Format><?php echo $settings[0]['examresults_msg'];  ?></textarea></label>
                            </div>
                        </div>

                        <div class="col-sm-12 hidden">
                            <div class="col-sm-2"><label>Fee Dates</label></div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" value="1"  id="inline_optionsRadios13" <?php echo  $settings[0]['feedates'] ===1 ? 'checked' : ''  ?> name="inline_optionsRadios4">
                                        Guardian                                    </label>
                                    <label class="radio-inline">
                                         <input type="radio" value="2" id="inline_optionsRadios14" <?php echo  $settings[0]['feedates'] ===2 ? 'checked' : ''  ?> name="inline_optionsRadios4">
                                        Student                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="3" id="inline_optionsRadios15" <?php echo  $settings[0]['feedates'] ===3 ? 'checked' : ''  ?> name="inline_optionsRadios4">
                                        Parents                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="4" id="inline_optionsRadios4" <?php echo  $settings[0]['feedates'] ===4 ? 'checked' : ''  ?> name="inline_optionsRadios4">
                                        All                                    </label>
                                </div>
                            </div>
                             <div class="col-sm-5"><label><textarea name="comment" rows="4" cols="50" id="feedates_msg" placeholder=Message Format><?php echo $settings[0]['feedates_msg'];  ?></textarea></label>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="col-sm-2"><label>General Message</label></div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" value="1"  id="inline_optionsRadios16" <?php echo  $settings[0]['events'] ===1 ? 'checked' : ''  ?> name="inline_optionsRadios5">
                                        Guardian                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="2" id="inline_optionsRadios17" <?php echo  $settings[0]['events'] ===2 ? 'checked' : ''  ?> name="inline_optionsRadios5">
                                        Student                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="3" id="inline_optionsRadios18" <?php echo  $settings[0]['events'] ===3 ? 'checked' : ''  ?> name="inline_optionsRadios5">
                                        Parents                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="4" id="inline_optionsRadios4" <?php echo  $settings[0]['events'] ===4 ? 'checked' : ''  ?> name="inline_optionsRadios5">
                                       All                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-5"><label><textarea name="comment" rows="4" cols="50" id="events_msg" placeholder=Message Format><?php echo $settings[0]['events_msg'];  ?></textarea></label>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="col-sm-2"><label>Enquiry</label></div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" value="1"  id="inline_optionsRadios19" <?php echo  $settings[0]['onlineenquiry'] ===1 ? 'checked' : ''  ?> name="inline_optionsRadios6">
                                        Guardian                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="2" id="inline_optionsRadios20" <?php echo  $settings[0]['onlineenquiry'] ===2 ? 'checked' : ''  ?> name="inline_optionsRadios6">
                                        Student                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="3" id="inline_optionsRadios21" <?php echo  $settings[0]['onlineenquiry'] ===3 ? 'checked' : ''  ?> name="inline_optionsRadios6">
                                         Parents                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="4" id="inline_optionsRadios4" <?php echo  $settings[0]['onlineenquiry'] ===4 ? 'checked' : ''  ?> name="inline_optionsRadios6">
                                        All                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-5"><label><textarea name="comment" rows="4" cols="50" id="onlineenquiry_msg" placeholder=Message Format><?php echo $settings[0]['onlineenquiry_msg'];  ?></textarea></label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-2"><label>Fee Payment</label></div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" value="1" id="inline_optionsRadios22" <?php echo  $settings[0]['feepayment'] ===1 ? 'checked' : ''  ?> name="inline_optionsRadiosfeepayment">
                                        Guardian                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="2"  id="inline_optionsRadios23"<?php echo  $settings[0]['feepayment'] ===2 ? 'checked' : ''  ?> name="inline_optionsRadiosfeepayment">
                                        Student                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="3" id="inline_optionsRadios24" <?php echo  $settings[0]['feepayment'] ===3 ? 'checked' : ''  ?> name="inline_optionsRadiosfeepayment">
                                         Parents                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="4" id="inline_optionsRadios4" <?php echo  $settings[0]['feepayment'] ===4 ? 'checked' : ''  ?> name="inline_optionsRadiosfeepayment">
                                        All                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-5"><label><textarea name="comment" rows="4" cols="50" id="feepayment_msg" placeholder=Message Format><?php echo $settings[0]['feepayment_msg'];  ?></textarea></label>
                            </div>
                        </div>
                         <div class="col-sm-12 hidden">
                            <div class="col-sm-2"><label>Transport Allocation</label></div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" value="1" id="inline_optionsRadios25" <?php echo  $settings[0]['transportallocation'] ===1 ? 'checked' : ''  ?> name="inline_optionsRadiostransportalloc">
                                        Guardian                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="2" id="inline_optionsRadios26"<?php echo  $settings[0]['transportallocation'] ===2 ? 'checked' : ''  ?> name="inline_optionsRadiostransportalloc">
                                        Student                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="3" id="inline_optionsRadios27"<?php echo  $settings[0]['transportallocation'] ===3 ? 'checked' : ''  ?> name="inline_optionsRadiostransportalloc">
                                        Both                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="4" id="inline_optionsRadios4"<?php echo  $settings[0]['transportallocation'] ===4 ? 'checked' : ''  ?> name="inline_optionsRadiostransportalloc">                                        None                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-5"><label><textarea name="comment" rows="4" cols="50" id="transportallocation_msg" placeholder=Message Format><?php echo $settings[0]['transportallocation_msg'];  ?></textarea></label>
                            </div>
                        </div>
                        <div class="col-sm-12 hidden">
                            <div class="col-sm-2"><label>Assignment</label></div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input type="radio" value="1" id="inline_optionsRadios28" <?php echo  $settings[0]['assignment'] ===1 ? 'checked' : ''  ?> name="inline_optionsRadiosassignment">
                                        Guardian                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="2" id="inline_optionsRadios29"<?php echo  $settings[0]['assignment'] ===2 ? 'checked' : ''  ?> name="inline_optionsRadiosassignment">
                                        Student                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="3" id="inline_optionsRadios30" <?php echo  $settings[0]['assignment'] ===3 ? 'checked' : ''  ?> name="inline_optionsRadiosassignment">
                                        Both                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="4" id="inline_optionsRadios4" <?php echo  $settings[0]['assignment'] ===4 ? 'checked' : ''  ?> name="inline_optionsRadiosassignment">                                        None                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-5"><label><textarea name="comment" rows="4" cols="50" id="assignment_msg" placeholder=Message Format><?php echo $settings[0]['assignment_msg'];  ?></textarea></label>
                            </div>
                        </div>
                        
                        
                        <div class="row">
                            <div class="col-sm-5">
                                
                                <div class="text-left">
                                            <button class="btn btn-primary" onclick="savesettings();" type="button"> <i class="icon-arrow-right14 position-right"></i>Save Setting</button>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
   <!-- /.col -->

 <!-- /.row -->

</section>
<!-- /.content -->
 <div class="modal fade" id="add_logo_modal" tabindex="-1" role="add_doctor_modal"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <span class="close"  data-dismiss="modal" aria-hidden="true">x</span>
                </div>
           <form id="forget-form"> 
            <div class="modal-body">
                <form id="add_doctor_form" action="" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="form-group">
                               <a href="#" onclick="document.getElementById('upload').click(); return false"><?php echo $this->Html->image('students_images/avatar-1.jpg', ['alt' => 'user Picture', 'class' => 'profile-user-img img-responsive', 'id' => 'blah']); ?></a>
                                <input type="file" id="upload" onchange="readURL(this);" name="file" style="visibility: hidden; width: 1px; height: 1px" multiple />

                            </div>
                            
                        </div>
                       
                      
                        <div class="col-md-12">
                            <div class="form-group clearfix">
                                <button type="button" onclick="imageupload();" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Save</button>
                                
                            </div>
                        </div>
                    </div>
              </div>
           </form>
        </div>
            <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

 <div class="modal fade" id="add-example" tabindex="-1" role="add_doctor_modal"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <span class="close"  data-dismiss="modal" aria-hidden="true">x</span>
                </div>
           <form id="forget-form"> 
            <div class="modal-body">
              
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="form-group">
                                <label><textarea name="comment" rows="20" cols="80" id="assignment_msg" placeholder=Message Format>
Personalising your messages allows you to send bulk SMS 
with unique information for each contact in your file (txt,csv,xls,xlsx).

You can create a single personalised message to all of your contacts 
by selecting relevant customisable information. 
This means that you can add the recipients 

first name, surname, account number, meeting time etc 
to the same message and the information relevant to that recipient
will be inserted into the message.

--------------------------------------------------
For Example:-

Dear #B#!
You have Got #C# Marks
Your Result #D# 
Please Contact With Department For Details.

---------------------------------------------------

Sample Output ( The Output Sample is given Below )

Dear Yasir Ali
You Have Got 1051 Marks 
Your Result PASS
Please Contact With Department For Details.


Dear Rizwan
You Have Got 1123 Marks 
Your Result PASS
Please Contact With Department For Details.


Dear Ahmed Khan
You Have Got 330 Marks 
Your Result FAIL
Please Contact With Department For Details.


                                </textarea></label>

                            </div>
                            
                        </div>
                       
                    </div>
              </div>
           </form>
        </div>
            <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?> 
<?= $this->Html->script('../plugins/timepicker/bootstrap-timepicker.min.js') ?> 
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>    
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 

   

<script>
    $(document).ready(function () {
       $("#Country").select2();
       $("#Currency_Type").select2();
       $("#Timezone").select2();
       
    });
     //Timepicke
    
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                        .attr('src', e.target.result)
                        .width(127);
                //.height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

  function setting() {
      var id                    = $('#id_settings').val();
      var Institution_Name      = $('#Institution_institution_name').val();
      var Institution_Address   = $('#Institution_institution_address').val();
      var Institution_Email     = $('#Institution_institution_contactemail').val();
      var Institution_Phone     = $('#Institution_institution_phone').val();
      var Institution_Mobile    = $('#Institution_Mobile').val();
      var Institution_Fax       = $('#Institution_institution_fax').val();
      var Admin_Contact_Person  = $('#Institution_institution_contactperson').val();
      var Country               = $('#Country option:selected').val();
      var Currency_Type         = $('#Currency_Type option:selected').val();
      var Language              = $('#Language').val();
      var Timezone              = $('#Timezone option:selected').val();

       swal({
            title: 'Are you sure?',
            text: "you want to save!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Sure!'
          }).then(function (result) {
         
            if (result) {
                if (id > 0) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'GeneralSetting', 'action' => 'edit']); ?>/"+ id,
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {Institution_Name: Institution_Name
                                ,Institution_Address:Institution_Address
                                ,Institution_Email:Institution_Email
                                ,Institution_Phone:Institution_Phone
                                ,Institution_Mobile:Institution_Mobile
                                ,Institution_Fax:Institution_Fax
                                ,Admin_Contact_Person:Admin_Contact_Person
                                ,Country:Country
                                ,Currency_Type:Currency_Type
                                ,Language:Language
                                ,Timezone:Timezone},
                        success: function (data) {
                            var result = data.msg.split("|");
                            if (result[0] === "Success") {
                                toastr.success(result[0], result[1]);
                               
                            } else {
                                toastr.error(result[0], result[1]);
                            }
                        }
                    });
                }

            }
           swal(
            'Success!',
            'Setting has been saved.',
            'success'
           
          )
         //  location.reload();
        });

    }

    function loadmodal() {

            $('#add_logo_modal').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
        }


    function imageupload(){
        var fd = new FormData();
        var file_data = $('input[type="file"]')[0].files; // for multiple files
        for(var i = 0;i<file_data.length;i++){
            fd.append("file", file_data[i]);
        }
        var other_data = $('forget-form').serializeArray();
        $.each(other_data,function(key,input){
            fd.append(input.name,input.value);
        });
        
      
        $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'GeneralSetting', 'action' => 'updatelogo']); ?>",
                dataType: 'json',
                cache: false,
                async: false,
                data: fd,//only input,
                contentType: false,
                processData: false,
                success: function (data) {
                    var result = data.msg.split("|");
                    var filename = data.fileName;
                    $('#filename').val(filename);
                    if (result[0] === "Success") {
                        toastr.success(result[0], result[1]);
                    }else{
                       $('#upload').val('');
                       $('#imgpath').html('<?php echo $this->Html->image('students_images/avatar-1.jpg', ['alt' => 'user Picture', 'class' => 'profile-user-img img-responsive img-circle', 'id' => 'blah']); ?>'); 
                       toastr.warning(result[0], result[1]); 
                    }
                    
                }
            });
    }
    
    
    function savesettings() {
        imageOverlay('#main_id','show');
        var admission = $("input[name=inline_optionsRadios]:checked").val();
        var absent = $("input[name=inline_optionsRadios1]:checked").val();
        var examcreation = $("input[name=inline_optionsRadios2]:checked").val();
        var examresults = $("input[name=inline_optionsRadios3]:checked").val();
        var feedates = $("input[name=inline_optionsRadios4]:checked").val();
        var events = $("input[name=inline_optionsRadios5]:checked").val();
        var onlineenquiry = $("input[name=inline_optionsRadios6]:checked").val();
        var feepayment = $("input[name=inline_optionsRadiosfeepayment]:checked").val();
        var transportallocation = $("input[name=inline_optionsRadiostransportalloc]:checked").val();
        var assignment = $("input[name=inline_optionsRadiosassignment]:checked").val();

        var admission_msg = $("#admission_msg").val();
        var absent_msg = $("#absent_msg").val();
        var examcreation_msg = $("#examcreation_msg").val();
        var examresults_msg = $("#examresults_msg").val();
        var feedates_msg = $("#feedates_msg").val();
        var events_msg = $("#events_msg").val();
        var onlineenquiry_msg = $("#onlineenquiry_msg").val();
        var feepayment_msg = $("#feepayment_msg").val();
        var transportallocation_msg = $("#transportallocation_msg").val();
        var assignment_msg = $("#assignment_msg").val();
        var url = $("#url").val();

        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'GeneralSetting', 'action' => 'smssetting']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {url: url, admission: admission, absent: absent, examcreation: examcreation, examresults: examresults, feedates: feedates, events: events, onlineenquiry: onlineenquiry, admission_msg: admission_msg,
                absent_msg: absent_msg, examcreation_msg: examcreation_msg, examresults_msg: examresults_msg, feedates_msg: feedates_msg,
                events_msg: events_msg, onlineenquiry_msg: onlineenquiry_msg, feepayment: feepayment, transportallocation: transportallocation,
                feepayment_msg: feepayment_msg, transportallocation_msg: transportallocation_msg, assignment: assignment, assignment_msg: assignment_msg},
            success: function (data) {
                imageOverlay('#main_id','hide');
                var result = data.msg.split("|");
                if (result[0] === "Success") {
                    toastr.success(result[0], result[1]);

                } else {
                    toastr.error(result[0], result[1]);
                }
            }
        });
    }
    
    

</script>   