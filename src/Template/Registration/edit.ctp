 <?= $this->Html->css('../plugins/timepicker/bootstrap-timepicker.min.css') ?> 
<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<?= $this->Form->create($registration,array('type'=>'file')) ?>
<?php
     function url(){
      
        $currentPath = $_SERVER['PHP_SELF']; 
        $pathInfo = pathinfo($currentPath); 
        $hostName = $_SERVER['HTTP_HOST']; 
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
        return $protocol.$hostName.$pathInfo['dirname']."/";
    }
?>
<!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
             <a href="#" onclick="document.getElementById('upload').click(); return false"><?php echo $this->Html->image('students_images/'.$registration->image, ['alt' => 'user Picture', 'class' => 'profile-user-img img-responsive img-circle', 'id' => 'blah']); ?></a>
               <input type="file" id="upload" onchange="readURL(this);" name="file" style="visibility: hidden; width: 1px; height: 1px" multiple />

              <h3 class="profile-username text-center"><?php echo $registration->student_name;  ?></h3>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b>Computer Code : </b> <a class="pull-right"><input type="text" readonly name="cc" value="<?= $registration->id_registration ?>" style="border:none;text-align:center;width:100px;"></a>
                </li>
                <li class="list-group-item">
                   <b>GR# :</b> <a class="pull-right"><input type="text"  name="gr" value="<?= $registration->gr ?>" style="border:none;text-align:center;width:100px;"></a>
                </li>
                <li class="list-group-item">
                   <b>Class Roll No :</b> <a class="pull-right"><input type="text"  name="roll_no" id="roll_no" value="<?php echo $registration->students_master_details[0]['roll_no']; ?>" style="border:none;text-align:center;width:100px;"></a>
                </li>
                <li class="list-group-item">
                  <b>Family Code :</b> <a class="pull-right"><input type="text"  name="fmc" id="fmc" value="<?= $registration->fmc ?>" style="border:none;text-align:center;width:100px;"></a>
                </li>
              </ul>

             
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>

              <hr>

             
             
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#registration" data-toggle="tab">Registration Details</a></li>
              <li><a href="#personal" data-toggle="tab">Personal Details</a></li>
              <li><a href="#contact" data-toggle="tab">Contact Details</a></li>
              <li><a href="#record" data-toggle="tab">Certificate Details</a></li>
            </ul>
            <div class="form-body form-horizontal form-bordered form-row-stripped">
            <fieldset
            <div class="tab-content">
          
              <div class="active tab-pane" id="registration" style="margin-bottom: 28px;">
                  <br />
                  
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Admission Date:</label>
                    <div class="col-sm-9">
                        <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text"  name="doa" value="<?= $registration->doa ?>" class="form-control pull-right" id="datepicker">
                          </div>
                    </div>
                  </div>
                  
                  
                   <div class="form-group">
                    <label for="campus" class="col-sm-2 control-label">Campus</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="campus_id" id="campus_id">
                        
                        <?php foreach($campuses as $campuses):  ?>
                            <option <?php echo $registration->students_master_details[0]->campus_id == $campuses->id_campus ? 'selected' : 'OK' ; ?> value="<?php echo $campuses->id_campus; ?>"><?php echo $campuses->campus_name; ?></option>
                        <?php endforeach; ?>
                            
                         </select>
                     </div>
                </div> 
                   
                    
                <!-- registration -->
               <div class="form-group">
                    <label for="class_id" class="col-sm-2 control-label">Class</label>
                    <div class="col-sm-9">
                      <select onchange="get_roll_no();" class="form-control" name="class_id" id="class_id">
                        <?php foreach($classes as $classes):  ?>
                            <option <?php echo $registration->students_master_details[0]->class_id == $classes->id_class ? 'selected' : 'OK' ; ?>  value="<?php echo $classes->id_class; ?>"><?php echo $classes->class_name; ?></option>
                        <?php endforeach; ?>

                      </select>
                     </div>
                </div> 
                
                <div class="form-group">
                    <label for="shift_id" class="col-sm-2 control-label">Shift</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="shift_id" id="shift_id">
                        
                            <option <?php echo $registration->students_master_details[0]->shift_id == 1 ? 'selected' : 'OK' ; ?> value="1">Morning</option>
                            <option <?php echo $registration->students_master_details[0]->shift_id == 2 ? 'selected' : 'OK' ; ?> value="2">Afternoon</option>
                            <option <?php echo $registration->students_master_details[0]->shift_id == 3 ? 'selected' : 'OK' ; ?> value="3">Evening</option>

                      </select>
                     </div>
                </div> 
                
                      
                <div class="form-group">
                    <label for="session" class="col-sm-2 control-label">Session</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="session_id" id="session_id">
                        
                        <?php foreach($session as $session):  ?>
                            <option <?php echo $registration->students_master_details[0]->session_id == $session->id_session ? 'selected' : 'OK' ; ?>  value="<?php echo $session->id_session; ?>"><?php echo $session->session; ?></option>
                        <?php endforeach; ?>
                                                      
                         </select>
                     </div>
                </div> 
                
                <!-- time Picker -->
                <div class="bootstrap-timepicker">
                 <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Start Time:</label>

                    <div class="col-sm-9">
                     <div class="input-group">
                        <input type="text" name="srtattime"   class="form-control timepicker" id="stimepicker" value="<?= date("H:i:s",strtotime($registration->students_master_details[0]->class_start_time)); ?>">

                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div>
                        <!-- /.input group -->
                    </div>
                  </div>
                 </div>
                
                 <!-- time Picker -->
                <div class="bootstrap-timepicker">
                 <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">End Time:</label>

                    <div class="col-sm-9">
                     <div class="input-group">
                        <input type="text" name="endtime" id="etimepicker"  class="form-control timepicker" value="<?= date("H:i:s",strtotime($registration->students_master_details[0]->class_end_time)); ?>">

                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div>
                        <!-- /.input group -->
                    </div>
                   
                  </div>
                 </div>
                  
 
                 
                <!-- end -->
                <div class="post clearfix">
                  

                </div>
                <!-- /.post -->

               
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="personal">
                <!-- The personal infor -->
                <br />
                
                  <div class="form-group">
                    <label for="mother_name" class="col-sm-2 control-label">CNIC#:</label>

                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-laptop"></i>
                                </div>
                                <input type="text"  name="nic" class="form-control" value="<?= $registration->nic ?>" data-inputmask="'mask': ['99999-9999999-9']" data-mask>
                              </div>
                    </div>
                    </div>
                
                
                  <div class="form-group">
                    <label for="student_name" class="col-sm-2 control-label">Student's Name</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control text-uppercase" required name="student_name" id="student_name" value="<?= $registration->student_name ?>" placeholder="Student's Name">
                    </div>
                  </div>
                 
                <div class="form-group">
                    <label for="father_name" class="col-sm-2 control-label">Father's Name</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control text-uppercase" required name="father_name" id="father_name" value="<?= $registration->father_name ?>" placeholder="Father's Name">
                    </div>
                  </div>
                
                  <div class="form-group">
                    <label for=guardian_name" class="col-sm-2 control-label">Guardian Name</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control text-uppercase"  name="guardian_name" id="guardian_name" value="<?= $registration->guardian_name ?>" placeholder="Guardian Name">
                    </div>
                  </div>
                
                
                 <div class="form-group">
                    <label for="mother_name" class="col-sm-2 control-label">Monther's Name</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control text-uppercase"  name="mother_name" id="mother_name" value="<?= $registration->mother_name ?>" placeholder="Mother's Name">
                    </div>
                  </div>
                
                
                 <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">D.O.B</label>
                    <div class="col-sm-9">
                        <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name='dob' value="<?= $registration->dob ?>" placeholder="Date of Birth" class="form-control pull-right" id="dob">
                          </div>
                    </div>
                  </div>
                

                 <div class="form-group">
                    <label for="Religion" class="col-sm-2 control-label">Religion</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="religion" id="religion">
                        
                            <option <?php echo $registration->religion == 1 ? 'selected' : 'OK' ; ?> value="1">Muslim</option>
                            <option <?php echo $registration->religion == 2 ? 'selected' : 'OK' ; ?> value="2">Non-Muslim</option>
                            
                         </select>
                     </div>
                </div> 
                
                 <div class="form-group">
                    <label for="gender" class="col-sm-2 control-label">Gender</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="sex" id="sex">
                        
                            <option <?php echo $registration->sex === 'Male' ? 'selected' : 'OK' ; ?> value="Male">Male</option>
                            <option <?php echo $registration->sex === 'Female' ? 'selected' : 'OK' ; ?> value="Female">Female</option>
                            
                            
                         </select>
                     </div>
                </div> 
                
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="contact">
                  <br />
                    <div class="form-group">
                        <label for="mobile" class="col-sm-2 control-label">Father's Mobile No:</label>

                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-phone"></i>
                                    </div>
                                    <input type="text" name='contact1' value="<?= $registration->contact1 ?>" class="form-control">
                                  </div>
                        </div>
                    </div>
                  
                  
                   <div class="form-group">
                        <label for="mobile" class="col-sm-2 control-label">Guardian's Mobile No:</label>

                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-phone"></i>
                                    </div>
                                    <input type="text" name='contact2' class="form-control" value="<?= $registration->contact2 ?>">
                                  </div>
                        </div>
                    </div>
                   
                  
                  <div class="form-group">
                        <label for="mobile" class="col-sm-2 control-label">Student's Mobile No:</label>

                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-phone"></i>
                                    </div>
                                    <input type="text" name='contact3' class="form-control" value="<?= $registration->contact3 ?>">
                                  </div>
                        </div>
                    </div>
                  
                  
                   <div class="form-group">
                        <label for="mobile" class="col-sm-2 control-label">Phone No:</label>

                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                      <i class="fa fa-phone"></i>
                                    </div>
                                    <input type="text" name='phone' class="form-control" value="<?= $registration->phone ?>">
                                  </div>
                        </div>
                    </div>
                  
                  
                    
                 <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>
                   
                    <div class="col-sm-9">
                        <input type="email" class="form-control"  value="<?= $registration->email ?>" name="email" id="email" placeholder="email">
                    </div>
                  </div>
                  
                  
                 
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name='address' id="inputExperience" placeholder="Address"><?= $registration->address ?></textarea>
                    </div>
                  </div>
                 
                 
                  
            
              </div>
              <div class="tab-pane" id="record">
                <br />
                <div class="btn-group pull-right">
                  <!-- <div class="col-sm-11 "> -->
                        <div class="action" style="margin-bottom: 28px;">
                            <a  href="#" onclick="document.getElementById('recordupload').click(); return false" >
                                <h2 class="btn btn-sm btn-warning">
                                  <i class="fa fa-upload"> Upload</i> 
                                </h2> 
                              </a>
                               
                                <h2 class="btn btn-sm btn-danger" onclick="deleteme();" value="'<?php echo $registration->id_registartion; ?>'" style="cursor: pointer;">
                                  <i class="fa fa-trash">Delete</i>
                                </h2>
                              
                               
                            <!-- </div> -->
                        </div>
                    </div>
                    <section class="content">
             
                        <div class="form-group"><?php echo $this->Html->image('students_images/'.$registration->record, ['alt' => 'No Record Found', 'class' => 'profile-user-img img-responsive', 'id' => 'recordd']); ?> 
                        </div>
                        <input type="file" id="recordupload" onchange="readURL_(this);" name="file2" style="visibility: hidden; width: 1px; height: 1px" multiple />   

                    </section>
                  <div class="form-group">
                    <div class="col-sm-11 ">
                      <?= $this->Form->button(__('<i class="fa fa-floppy-o"></i> Update'), ['onclick'=>'validate_form();', 'class' => 'btn btn-danger pull-right', 'escape' => false]) ?>
                    </div>
                  </div>

    </div>
                
              </div>
              <!-- /.tab-pane -->
               </fieldset>
              </div>
           
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
     <?= $this->Form->end() ?> 
  <?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?> 
  <?= $this->Html->script('../plugins/timepicker/bootstrap-timepicker.min.js') ?> 
  <?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>    
  <?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
  <?= $this->Html->script('../plugins/input-mask/jquery.inputmask.js') ?>  
   
    
<script>
     $(document).ready(function () {
       $("#class_id").select2();
    });
     //Timepicker
    $("#stimepicker").timepicker({
      showInputs: false
    });
    
    $("#etimepicker").timepicker({
      showInputs: false
    });
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
    $('#dob').datepicker({
      autoclose: true
    });
    $("[data-mask]").inputmask();
    
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
    function readURL_(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#recordd')
                        .attr('src', e.target.result)
                        .width(300);
                // .height(500);
            };

                reader.readAsDataURL(input.files[0]);
            }
    } 
 
    
  ///   get roll_no
    function get_roll_no() {
        var id_class = $("#class_id option:selected").val();
        var id_shift = $("#shift_id option:selected").val();
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'Registration', 'action' => 'getrollno']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {class: id_class,shift:id_shift},
            success: function (data) {
                var rollno = data.roll_no;
                
                    $('#roll_no').val(rollno);
              
            }
        });
    }
 
 ///   get roll_no
    function get_fmc() {
        var cnic = $("#nic").val();
        $('#fmc').val('');
        $('#student_name').val('');
        $('#father_name').val('');
        $('#guardian_name').val('');
        $('#mother_name').val('');
        $('#contact1').val('');
        $('#contact2').val('');
        $('#contact3').val('');
        $('#phone').val('');
        $('#email').val('');
        $('#inputExperience').val('');

           $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'Registration', 'action' => 'getfmc']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {nic: cnic},
            success: function (data) {
                var mdata = data.data;
                    toastr["success"]("Family information already exisit.", "Please wait collecting details!");
                    $('#fmc').val(mdata.fmc);
                    $('#student_name').val(mdata.student_name);
                    $('#father_name').val(mdata.father_name);
                    $('#guardian_name').val(mdata.guardian_name);
                    $('#mother_name').val(mdata.mother_name);
                    $('#contact1').val(mdata.contact1);
                    $('#contact2').val(mdata.contact2);
                    $('#contact3').val(mdata.contact3);
                    $('#phone').val(mdata.phone);
                    $('#email').val(mdata.email);
                    $('#inputExperience').val(mdata.address);
                    
                    
             }
        });
       
    }
    
    function validate_form(){
      
        if($('#datepicker').val() === ''){
            swal(
                'Required?',
                'Please select registration date!',
                'warning'
            );
           return false;   
        }
        
        
        if($('#student_name').val() === ''){
            swal(
                'Required?',
                'Please enter student name!',
                'warning'
            );
           return false;   
        }
        
        if($('#father_name').val() === ''){
            swal(
                'Required?',
                'Please enter father name!',
                'warning'
            );
           return false;   
        }
        
        
        swal(
            'Congratulations!',
            'New registration han been save!',
            'success'
          );
        
    }
    function deleteme(id){
         swal({
            title: 'Are you sure?',
            text: "you want to delete!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then(function (result) {
            if (result) {
              console.log(result);
                if (id > 0) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'Registration', 'action' => 'deleteme']); ?>",
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {id: id,pic:pic},
                        success: function (data) {
                            var result = data.msg.split("|");
                              console.log(result);
                            if (result[0] === "Success") {
                                toastr.success(result[0], result[1]);
                                location.reload();
                            } else {
                                toastr.error(result[0], result[1]);
                            }
                        }
                    });
                }
            }
           swal(
            'Deleted!',
            'Record has been deleted.',
            'success'
          )
        
        });
    }
    
    function loadmodal() {

        $('#add-fee').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    } 
    
</script> 
<style>
    
 .hovereffect {
    width: 100%;
    height: 100%;
    float: left;
    overflow: hidden;
    position: relative;
    text-align: center;
    cursor: default;
}
.hovereffect .overlay {
    width: 100%;
    position: absolute;
    overflow: hidden;
    left: 0;
  top: auto;
  bottom: 0;
  padding: 1em;
  height: 4.75em;
  background: #79FAC4;
  color: #3c4a50;
  -webkit-transition: -webkit-transform 0.35s;
  transition: transform 0.35s;
  -webkit-transform: translate3d(0,100%,0);
  transform: translate3d(0,100%,0);
  visibility: hidden;

}

.hovereffect img {
    display: block;
    position: relative;
  -webkit-transition: -webkit-transform 0.35s;
  transition: transform 0.35s;
}

.hovereffect:hover img {
-webkit-transform: translate3d(0,-10%,0);
  transform: translate3d(0,-10%,0);
}

.hovereffect h2 {
    text-transform: uppercase;
    color: #fff;
    text-align: center;
    position: relative;
    font-size: 17px;
    padding: 10px;
    background: rgba(0, 0, 0, 0.6);
  float: left;
  margin: 0px;
  display: inline-block;
}

.hovereffect a.info {
    display: inline-block;
    text-decoration: none;
    padding: 7px 14px;
    text-transform: uppercase;
  color: #fff;
  border: 1px solid #fff;
  margin: 50px 0 0 0;
  background-color: transparent;
}
.hovereffect a.info:hover {
    box-shadow: 0 0 5px #fff;
}


.hovereffect p.icon-links a {
  float: right;
  color: #3c4a50;
  font-size: 1.4em;
}

.hovereffect:hover p.icon-links a:hover,
.hovereffect:hover p.icon-links a:focus {
  color: #252d31;
}

.hovereffect h2,
.hovereffect p.icon-links a {
  -webkit-transition: -webkit-transform 0.35s;
  transition: transform 0.35s;
  -webkit-transform: translate3d(0,200%,0);
  transform: translate3d(0,200%,0);
  visibility: visible;
}

.hovereffect p.icon-links a span:before {
  display: inline-block;
  padding: 8px 10px;
  speak: none;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}


.hovereffect:hover .overlay,
.hovereffect:hover h2,
.hovereffect:hover p.icon-links a {
  -webkit-transform: translate3d(0,0,0);
  transform: translate3d(0,0,0);
}

.hovereffect:hover h2 {
  -webkit-transition-delay: 0.05s;
  transition-delay: 0.05s;
}

.hovereffect:hover p.icon-links a:nth-child(3) {
  -webkit-transition-delay: 0.1s;
  transition-delay: 0.1s;
}

.hovereffect:hover p.icon-links a:nth-child(2) {
  -webkit-transition-delay: 0.15s;
  transition-delay: 0.15s;
}

.hovereffect:hover p.icon-links a:first-child {
  -webkit-transition-delay: 0.2s;
  transition-delay: 0.2s;
}
Close
</style>  