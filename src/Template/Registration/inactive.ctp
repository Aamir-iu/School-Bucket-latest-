           
<?= $this->Html->css('../plugins/timepicker/bootstrap-timepicker.min.css') ?> 
<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?>
<?= $this->Html->css('../plugins/datatables/jquery.dataTables.css') ?>
<?= $this->Html->css('../plugins/datatables/jquery.dataTables.min.css') ?>
<?= $this->Html->css('../plugins/datatables/jquery.dataTables_themeroller.css') ?>



<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">

                    <div class="btn-group pull-right">
                        
                         <div class="actions" style="margin-bottom: 28px;">
                             
                            <a  class="hidden" href="#add-account" onclick="loadmodal();" title="Add Fees" class="btn btn-block btn-success">
                                <i class="fa fa-plus"></i> Add </a>
                        </div>
                        
                    </div>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover" id="userstable">    
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Student CC#</th>
                                    <th>Name of Student</th>
                                    <th>Father's Name</th>
                                    <th>Class|Section</th> 
                                    <th>Shift</th> 
                                    <th style="width:20%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($registration as $registration): ?>
                                    <tr>
                                        <td><?php echo $this->Html->image('students_images/' . $registration['registration']['image'], ['alt' => 'user Picture', 'class' => 'img-circle', 'style' => 'width:20px;']); ?></td>
                                        <td><?= h($registration['registration']['id_registration']) ?></td>
                                        <td><?= h($registration['registration']['student_name']) ?></td>
                                        <td><?= h($registration['registration']['father_name']) ?></td>
                                        <td><?= h($registration['classes_section']['class_name']) ?></td>
                                        <td><?= h($registration['shift']['shift_name']) ?></td> 
                                        <?php $id = $registration['registration']['id_registration']; ?>
                                        <td class="actions">
                                            <?= $this->Html->link(__('<i class="fa fa-lock"></i> Active'), ['#' => '#'], ['onclick' => "inactive_student($id);", 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5','id'=>'inactive', 'escape' => false]) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                                </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
<?php // $this->Form->create('User', array('type' => 'file', 'url' => array('controller' => 'Registration', 'action' => 'add', 'id' => 'forget-form'))); ?>        
<form id="forget-form">
 <input type="hidden" id="filename"  name="filename">      
<!-- BEGIN MODAL NEW ADMISSION --> 
<div class="modal fade " id="add-students"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:90%!important;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add New Student</h4>
            </div>
            <div class="modal-body">
                <?php  if(!empty($inquiry)){ $class  =   $inquiry[0]['for_class_id']; }else{ $class = 0; } ?>
                <!-- Main content -->
                    <!-- Main content -->
                    <section class="content" style='padding: 0px 15px;'>
                        <input type="text"  name="inquiry_id" hidden value="<?php if (!empty($inquiry)) { echo $inquiry[0]['id_inquery']; } ?>">   
                        <div class="row">
                            <div class="col-md-3">

                                <!-- Profile Image -->
                                <div class="box box-primary">
                                    <div class="box-body box-profile">
                                        
                                        <a href="#" id='imgpath'  onclick="document.getElementById('upload').click(); return false"><?php echo $this->Html->image('students_images/avatar-1.jpg', ['alt' => 'user Picture', 'class' => 'profile-user-img img-responsive img-circle', 'id' => 'blah']); ?></a>
                                        <input type="file" id="upload"  onchange="readURL(this);" style="visibility: hidden; width: 1px; height: 1px"  />
                                        
                                        <h3 class="profile-username text-center"></h3>
                                        <ul class="list-group list-group-unbordered">
                                            <li class="list-group-item">
                                                <b>Computer Code : </b> <a class="pull-right"><input type="text" readonly name="cc" id="cc" value="-" style="border:none;text-align:center;width:100px;"></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>GR# :</b> <a class="pull-right"><input type="text"  name="gr" value="" style="border:solid 1px;text-align:center;width:100px;"></a>
                                            </li>
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
                            </div>
                            <!-- /.col -->
                            <div class="col-md-9">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        
                                        <li class="active"><a href="#registration" data-toggle="tab">Registration Details</a></li>
                                        <li><a href="#personal" data-toggle="tab">Personal Details</a></li>
                                        <li><a href="#contact" data-toggle="tab">Contact Details</a></li>
                                        <li class="hidden" id="dues_tab"><a href="#otherdetails" data-toggle="tab">Generate Dues</a></li>
                                        
                                       
                                    </ul>
                                    <div class="form-body form-horizontal form-bordered form-row-stripped" id="add-student-form"> 
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
                                                                <input type="text"  placeholder="Date of Admission" name="doa" class="form-control pull-right" id="datepicker" value="<?php echo date("m/d/Y"); ?>">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="campus" class="col-sm-2 control-label">Campus</label>
                                                        <div class="col-sm-9">
                                                            <select onchange="get_roll_no();" class="form-control" name="campus_id" id="campus_id">

                                                                <?php foreach ($campuses as $campuses): ?>
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
                                                                <?php foreach ($classes as $classes): ?>
                                                                    <option <?php echo $class == $classes->id_class ? 'selected' : 'OK'; ?>  value="<?php echo $classes->id_class; ?>"><?php echo $classes->class_name; ?></option>
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

                                                                <?php foreach ($session as $session): ?>
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
                                                            <input type="text" class="form-control"  name="student_name" id="student_name" placeholder="Student's Name" value="<?php if (!empty($inquiry)) { echo $inquiry[0]['f_name'];} ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="father_name" class="col-sm-2 control-label">Father's Name</label>

                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"  name="father_name" id="father_name" placeholder="Father's Name" value="<?php if (!empty($inquiry)) { echo $inquiry[0]['l_name'];} ?>">
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
                                                                <input type="text" name='contact1' placeholder="Mobile#" id="contact1" class="form-control" value="<?php if (!empty($inquiry)) { echo $inquiry[0]['contact'];} ?>">
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
                                                            <textarea class="form-control" name='address' id="inputExperience" placeholder="Address"><?php if (!empty($inquiry)) { echo $inquiry[0]['address']; } ?></textarea>
                                                        </div>
                                                    </div>


<!--                                                    <div class="form-group">
                                                        <div class="col-sm-11 ">
                                                        <?php // $this->Form->button(__('<i class="fa fa-floppy-o"></i> Save'), ['onclick' => 'validate_form();', 'class' => 'btn btn-danger pull-right', 'escape' => false]) ?>
                                                        </div>
                                                    </div>-->

                                                </div>
                                                <!-- /.tab-pane -->
                                                
                                         <div class="tab-pane" id="otherdetails">
                                          <br />
                                          <div class="form-body form-horizontal form-bordered form-row-stripped" id="add-student-form">        
                                            <div class="form-group">
                                                        <label for="inputName" class="col-sm-2 control-label">Fee Month:</label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group date">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                                <input type="text"  placeholder="Date of Admission" name="feemonth" value="<?php echo date('m').'/10/'.date('Y'); ?>" class="form-control pull-right" id="feemonth" value="<?php echo date("m/d/Y"); ?>">
                                                            </div>
                                                        </div>
                                            </div> 
                                              
                                           <div class="form-group">
                                                <label for="class_id" class="col-sm-2 control-label">Fee Head</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="feehead"  data-placeholder="Select Fee Head" style="width: 100%;">
                                                    <?php  foreach($feetype as $feetypes): ?>    
                                                       <option value="<?php  echo $feetypes->id_fee_type; ?>"><?php  echo $feetypes->fee_type_name; ?></option>
                                                    <?php endforeach; ?>    
                                                   </select>
                                                </div>
                                            </div>    
                                           
                                              
                                              <div class="form-group"> 
                                                <div class="col-sm-11">  
                                                <div class="pull-right" style="margin-right:0px!important;"> 
                                                <button onclick="generate_dues();" id="dg" readonly type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Generate</button>
                                                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
                                                </div>
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
                    <!-- /.content -->
                <div class="modal-footer">
              
                <button onclick="validate_form();" id="fu" type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Save</button>
                <button type="button" onclick="clearform();"  id='referesh' class="btn btn-icon waves-effect waves-light btn-danger m-b-5">Refresh</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
                </div>
            </div>
        
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
 <?php // $this->Form->end() ?>   
</form>

<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/timepicker/bootstrap-timepicker.min.js') ?> 
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?> 
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.js') ?>
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
<?= $this->Html->script('../plugins/input-mask/jquery.inputmask.js') ?>

<?php // $this->Html->script('datatable.js') ?> 
 
<script>

    $(document).ready(function () {
       
    $("#userstable").DataTable();
    $("#class_id").select2();
    get_roll_no();
    
        var table = $('#userstable').DataTable();
 
        $('#userstable tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
              //  $(this).removeClass('selected');
               $(this).addClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );
    
    
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
               imageupload();
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
    function clearform(){
        imageOverlay('#add-student-form', 'show');
        $('#nic').val('');
        $('#student_name').val('');
        $('#father_name').val('');
        $('#guardian_name').val('');
        $('#mother_name').val('');
        $('#dob').val('');
        $('#contact1').val('');
        $('#contact2').val('');
        $('#contact3').val('');
        $('#phone').val('');
        $('#email').val('');
        $('#inputExperience').val('');
        $('#upload').val('');
        $('#imgpath').html('<?php echo $this->Html->image('students_images/avatar-1.jpg', ['alt' => 'user Picture', 'class' => 'profile-user-img img-responsive img-circle', 'id' => 'blah']); ?>');
        get_roll_no();
        $("#dues_tab").addClass("hidden");
        imageOverlay('#add-student-form', 'hide');
    }
    function validate_form(){
        imageOverlay('#add-student-form', 'show');
        if($('#datepicker').val() === ''){
            swal(
                'Required?',
                'Please select registration date!',
                'warning'
            );
            imageOverlay('#add-student-form', 'hide');
           return false;   
        }
        
        if($('#student_name').val() === ''){
            swal(
                'Required?',
                'Please enter student name!',
                'warning'
            );
            imageOverlay('#add-student-form', 'hide');
           return false;   
        }
        
        if($('#father_name').val() === ''){
            swal(
                'Required?',
                'Please enter father name!',
                'warning'
            );
            imageOverlay('#add-student-form', 'hide');
           return false;   
        }
        
           var str = $("#forget-form").serializeArray();
          
           $('#fu').attr('disabled',true);
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'Registration', 'action' => 'add']); ?>",
                dataType: 'json',
                cache: false,
                async: false,
                data: str,//only input,
                success: function (data) {
                    var result = data.msg.split("|");
                    var last_id = data.last_id;
                    var fcode = data.fcode;
                    if (result[0] === "Success") {
                        toastr.success(result[0], result[1]);
                        $('#cc').val(last_id);
                        $('#fmc').val(fcode);
                        updateimage();
                       
                        $("#dues_tab").removeClass("hidden");
                    }else{
                       toastr.error(result[0], result[1]); 
                    }
                }
            });
       $('#fu').attr('disabled',false);      
      imageOverlay('#add-student-form', 'hide');
    } 
    
    function loadmodal() {

        $('#add-students').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }
    function updateimage(){
        
        var fd = new FormData();
        var file_data = $('input[type="file"]')[0].files; // for multiple files
        for(var i = 0;i<file_data.length;i++){
            fd.append("file", file_data[i]);
        }
        var other_data = $('forget-form').serializeArray();
        $.each(other_data,function(key,input){
            fd.append(input.name,input.value);
        });
        var id = $('#cc').val();
        $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'Registration', 'action' => 'updateimage']); ?>/"+id,
                dataType: 'json',
                cache: false,
                async: false,
                data: fd,//only input,
                contentType: false,
                processData: false,
                success: function (data) {
                    
                }
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
                url: "<?php echo $this->Url->build(['controller' => 'Registration', 'action' => 'imageupload']); ?>",
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
    function inactive_student(id) {

       swal({
            title: 'Are you sure?',
            text: "you want to active this student!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Sure!'
          }).then(function (result) {
              
              
            var table = $('#userstable').DataTable();  
            table.row('.selected').remove().draw( false );
    
            if (result) {
                if (id > 0) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'Registration', 'action' => 'delete']); ?>",
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {id: id,status:'Y'},
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
            'Un-Block!',
            'Student  has been active.',
            'success'
           
          )
         //  location.reload();
        });

    }
    
    function del(){
       // var table = $('#userstable').DataTable();
        
       
//        
//        $.ajax({
//            type: "POST",
//            url: "<?php echo $this->Url->build(['controller' => 'Registration', 'action' => 'delete']); ?>",
//            dataType: 'json',
//            cache: false,
//            async: false,
//            data: {id: id},
//            success: function (data) {
//                var result = data.msg.split("|");
//                if (result[0] === "Success") {
//                    toastr.success(result[0], result[1]);
//
//                } else {
//                    toastr.error(result[0], result[1]);
//                }
//            }
//        });
    
    }
    

</script>
<script>
    
    function generate_dues(){
        imageOverlay('#otherdetails', 'show'); 
        var reg_id = $('#cc').val();
        if(reg_id == '' || reg_id == '-'){
            imageOverlay('#otherdetails', 'hide');
            toastr.error("Please enter Student's ID");
            return false;
        }
        var feemonth = $('#feemonth').val();
        if(feemonth == ''){
            imageOverlay('#otherdetails', 'hide');
            toastr.error("Please select Fee Month");
            return false;
        }
        
        var ft = $('#feehead option:selected').val();
        
        var class_id = $('#cid').val();
        var shift_id = $('#sid').val();
        var session_id = $('#ssid').val();
        var campus_id = $('#cmid').val();
        $('#dg').attr('disabled',true);
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'Fees', 'action' => 'generatedues']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {reg_id : reg_id,
                   class_id : class_id,
                   shift_id : shift_id,
                   session_id : session_id,
                   campus_id : campus_id,
                   feemonth : feemonth,
                   ft : ft },
            success: function (data) {
                
                var result = data.msg.split("|");
               
               if (result[0] === "Success") {
                 
                   toastr.success(result[0], result[1]);
                }else{
                   toastr.error(result[0], result[1]);
                }
               $('#dg').attr('disabled',false);  
              imageOverlay('#otherdetails', 'hide');
            }
        });
    }
    
</script>
