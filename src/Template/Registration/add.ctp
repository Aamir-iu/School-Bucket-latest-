<?php  if(!empty($inquiry)){ $class  =   $inquiry[0]['for_class_id']; }else{ $class = 0; } ?>
<?= $this->Html->css('../plugins/timepicker/bootstrap-timepicker.min.css') ?> 
<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<?= $this->Form->create('User', array('type' => 'file', 'url' => array('controller' => 'Registration', 'action' => 'add', 'id' => 'forget-form'))); ?>        
<!-- Main content -->
    <section class="content">
        <input type="text"  name="inquiry_id" hidden value="<?php  if(!empty($inquiry)){ echo  $inquiry[0]['id_inquery']; } ?>">   
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
             <a href="#" onclick="document.getElementById('upload').click(); return false"><?php echo $this->Html->image('students_images/avatar-1.jpg', ['alt' => 'user Picture', 'class' => 'profile-user-img img-responsive img-circle', 'id' => 'blah']); ?></a>
               <input type="file" id="upload" onchange="readURL(this);" name="file" style="visibility: hidden; width: 1px; height: 1px" multiple />

              <h3 class="profile-username text-center"></h3>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b>Computer Code : </b> <a class="pull-right"><input type="text" readonly name="cc" value="-" style="border:none;text-align:center;width:100px;"></a>
                </li>
                <!-- <li class="list-group-item">
                   <b>GR# :</b> <a class="pull-right"><input type="text"  name="gr" value="" style="border:solid 1px;text-align:center;width:100px;"></a>
                </li> -->
                <li class="list-group-item">
                   <b>Class Roll No :</b> <a class="pull-right"><input type="text"  readonly id="roll_no" name="roll_no" value="" style="border:none;text-align:center;width:100px;"></a>
                </li>
                <li class="list-group-item">
                    <b>Family Code :</b> <a class="pull-right"><input type="text" id="fmc"   name="fmc" value="" style="border:snone;text-align:center;width:100px;"></a>
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
                            <input type="text"  placeholder="Date of Admission" name="doa" class="form-control pull-right" id="datepicker" value="<?php  echo date("m/d/Y"); ?>">
                          </div>
                    </div>
                  </div>
                  
                  
                   <div class="form-group">
                    <label for="campus" class="col-sm-2 control-label">Campus</label>
                    <div class="col-sm-9">
                      <select onchange="get_roll_no();" class="form-control" name="campus_id" id="campus_id">
                        
                        <?php foreach($campuses as $campuses):  ?>
                            <option  value="<?php echo $campuses->id_campus; ?>"><?php echo $campuses->campus_name; ?></option>
                        <?php endforeach; ?>
                            
                         </select>
                     </div>
                </div> 
                  
                    
                <!-- registration -->
               <div class="form-group">
                    <label for="class_id" class="col-sm-2 control-label">Class</label>
                    <div class="col-sm-9">
                        <select onchange="get_roll_no();" class="form-control" name="class_id" id="class_id" style="width:100%;">
                        <?php foreach($classes as $classes):  ?>
                            <option <?php echo $class == $classes->id_class ? 'selected' : 'OK' ; ?>  value="<?php echo $classes->id_class; ?>"><?php echo $classes->class_name; ?></option>
                        <?php endforeach; ?>

                      </select>
                     </div>
                </div> 
                
                <div class="form-group">
                    <label for="shift_id" class="col-sm-2 control-label">Shift</label>
                    <div class="col-sm-9">
                      <select onchange="get_roll_no();" class="form-control" name="shift_id" id="shift_id">
                        
                            <option value="1">Morning</option>
                            <option value="2">Afternoon</option>
                            <option value="3">Evening</option>

                      </select>
                     </div>
                </div> 
                
                      
                <div class="form-group">
                    <label for="session" class="col-sm-2 control-label">Session</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="session_id" id="session_id">
                        
                        <?php foreach($session as $session):  ?>
                            <option  value="<?php echo $session->id_session; ?>"><?php echo $session->session; ?></option>
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
                        <input type="text" name="srtattime" class="form-control timepicker" id="stimepicker">

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
                        <input type="text" name="endtime" class="form-control timepicker" id="etimepicker">

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
                            <div class="input-group input-group-sm">
                               
                                <input type="text"  name="nic" id="nic" class="form-control search"  placeholder="CNIC#" data-inputmask="'mask': ['99999-9999999-9']" data-mask>
                              
                                <div class="input-group-btn">
                                    <button type="button" onclick="get_fmc();" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                    </div>
                    </div>
                
                
                
                  <div class="form-group">
                    <label for="student_name" class="col-sm-2 control-label">Student's Name</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" required name="student_name" id="student_name" placeholder="Student's Name" value="<?php  if(!empty($inquiry)){ echo  $inquiry[0]['f_name']; } ?>">
                    </div>
                  </div>
                 
                <div class="form-group">
                    <label for="father_name" class="col-sm-2 control-label">Father's Name</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" required name="father_name" id="father_name" placeholder="Father's Name" value="<?php  if(!empty($inquiry)){ echo  $inquiry[0]['l_name']; } ?>">
                    </div>
                  </div>
                
                  <div class="form-group">
                    <label for=guardian_name" class="col-sm-2 control-label">Guardian Name</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control"  name="guardian_name" id="guardian_name" placeholder="Guardian Name">
                    </div>
                  </div>
                
                
                 <div class="form-group">
                    <label for="mother_name" class="col-sm-2 control-label">Mother's Name</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control"  name="mother_name" id="mother_name" placeholder="Mother's Name">
                    </div>
                  </div>
                
                
                 <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">D.O.B</label>
                    <div class="col-sm-9">
                        <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name='dob' placeholder="Date of Birth" class="form-control pull-right" id="dob">
                          </div>
                    </div>
                  </div>
                

                 <div class="form-group">
                    <label for="Religion" class="col-sm-2 control-label">Religion</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="religion" id="religion">
                        
                            <option value="1">Muslim</option>
                            <option value="1">Non-Muslim</option>
                            
                         </select>
                     </div>
                </div> 
                
                 <div class="form-group">
                    <label for="gender" class="col-sm-2 control-label">Gender</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="sex" id="sex">
                        
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            
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
                                    <input type="text" name='contact1' placeholder="Mobile#" id="contact1" class="form-control" value="<?php  if(!empty($inquiry)){ echo  $inquiry[0]['contact']; } ?>">
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
                                    <input type="text" name='contact2' placeholder="Mobile#"  id="contact2" class="form-control">
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
                                    <input type="text" name='contact3' placeholder="Mobile#"  id="contact3" class="form-control">
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
                                    <input type="text" name='phone' placeholder="PTCL"  id="phone" class="form-control">
                                  </div>
                        </div>
                    </div>
                  
                  
                    
                 <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>
                   
                    <div class="col-sm-9">
                        <input type="email" class="form-control"  name="email" id="email" placeholder="email">
                    </div>
                  </div>
                  
                  
                 
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name='address' id="inputExperience" placeholder="Address"><?php  if(!empty($inquiry)){ echo  $inquiry[0]['address']; } ?></textarea>
                    </div>
                  </div>
                 
                 
                  <div class="form-group">
                    <div class="col-sm-11 ">
                      <?= $this->Form->button(__('<i class="fa fa-floppy-o"></i> Save'), ['onclick'=>'validate_form();', 'class' => 'btn btn-danger pull-right', 'escape' => false]) ?>
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
       get_roll_no();
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
 
 
  ///   get roll_no
    function get_roll_no() {
        var id_class = $("#class_id option:selected").val();
        var id_shift = $("#shift_id option:selected").val();
        var id_campus = $("#campus_id option:selected").val();
        imageOverlay('#roll_no', 'show');
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'Registration', 'action' => 'getrollno']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {class: id_class,shift:id_shift,campus_id:id_campus},
            success: function (data) {
                var rollno = data.roll_no;
                
                    $('#roll_no').val(rollno);
                   
            }
        });
       imageOverlay('#roll_no', 'hide');
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
                    toastr["success"]("Please wait collecting details!");
                    $('#fmc').val(mdata.fmc);
                    //$('#student_name').val(mdata.student_name);
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
    
</script>   