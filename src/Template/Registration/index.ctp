           
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
                        <div class="row">
                            <div class="col-xs-8">
                                <div class="box-tools">
                                    <div class="input-group">
                                        <form method="post" action="" id="search-form" class="form-horizontal">
                                            <table class="table table-responsive">
                                                <tr>
    <!--                                            	<td>Class</td>
                                                    <td>Shift</td>-->
                                                    <td>Registration ID</td>
                                                    <td>Family Code</td>
                                                    <td>LastName/FirstName</td>
                                                    <td>Mobile#</td>
                                                    <td>Status</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
    <!--                                              <td>
                                                    <select name="class_id" id="class_id1" class="form-control input-sm" style="width: 150px;">
                                                        <option value="">Select</option>    
                                                    <?php // foreach($class_name as $clas):  ?>
                                                                <option  value="<?// echo $clas->id_class; ?>"><?php // echo $clas->class_name;  ?></option>
                                                    <?php // endforeach; ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="shift_id" id="shift_id" class="form-control input-sm" style="width: 130px;">
                                                            <option value="">Select</option>  
                                                            <option value="1">Morning</option>
                                                            <option value="2">Afternoon</option>
                                                            <option value="3">Evening</option>
                                                        </select>
                                                    </td>   
                                                    -->
                                                    <td><input class="form-control input-sm" name="reg_id" id="reg_id" type="text" value="" placeholder="Registration ID" style="width: 100px;" required></td>
                                                    <td><input class="form-control input-sm" name="fmc" id="fmc" type="text" value="" placeholder="Family Code" style="width: 100px;" required></td>

                                                    <td>
                                                        <input type="text" class="form-control input-sm" name="search" id="search" placeholder="LastName/FirstName" style="width: 130px;">
                                                    </td>

                                                    <td>
                                                        <input type="text" class="form-control input-sm" name="mobile" id="mobile" placeholder="Mobile Number" style="width: 130px;">
                                                    </td>

                                                    <td>
                                                        <select name="status" id="status" class="form-control input-sm" style="width: 150px;">
                                                            <option value="Y">Active</option>
                                                            <option value="N">In-Active</option>
                                                        </select>
                                                    </td>


                                                    <td>
                                                        <button class="btn btn-sm btn-primary" name="btnSearch" id="btnSearch" onclick="search_record();" type="button"><i class="fa fa-search"></i> Search </button>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-success" name="btnSearch" id="btnSearch" onclick="loadmodal();" type="button"><i class="fa fa-plus"></i> Add </button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>     
                        </div> 

                    </div>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-container">
                        <table class="table table-striped  table-hover" id="userstable">    
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Image</th>
                                    <th>CC#</th>
                                    <th>Name of Student</th>
                                    <th>Father's Name</th>
                                    <th>Contact</th>
                                    <th>Class</th> 
                                    <th>Shift</th> 
                                    <th style="width:20%;">Action</th>
                                </tr>
                            </thead>
                             <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                            <tbody>
                            </tbody>
                            
                            
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
                    <?php if (!empty($inquiry)) {
                        $class = $inquiry[0]['for_class_id'];
                    } else {
                        $class = 0;
                    } ?>
                    <!-- Main content -->
                    <!-- Main content -->
                    <section class="content" style='padding: 0px 15px;'>
                        <input type="text"  name="inquiry_id" hidden value="<?php if (!empty($inquiry)) {
                        echo $inquiry[0]['id_inquery'];
                    } ?>">   
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
                                        <li class="hidden" id="dues_tab"><a href="#otherdetails" data-toggle="tab">Generate Fee</a></li>


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
                                                            <select onchange="get_roll_no();" class="form-control cl"  name="campus_id" id="campus_id">

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
                                                            <input type="text" class="form-control text-uppercase"  name="student_name" id="student_name" placeholder="Student's Name" value="<?php if (!empty($inquiry)) {
    echo $inquiry[0]['f_name'];
} ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="father_name" class="col-sm-2 control-label">Father's Name</label>

                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control text-uppercase"  name="father_name" id="father_name" placeholder="Father's Name" value="<?php if (!empty($inquiry)) {
    echo $inquiry[0]['l_name'];
} ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for=guardian_name" class="col-sm-2 control-label">Guardian Name</label>

                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control text-uppercase"  name="guardian_name" id="guardian_name" placeholder="Guardian Name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="mother_name" class="col-sm-2 control-label">Mother's Name</label>

                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control text-uppercase"  name="mother_name" id="mother_name" placeholder="Mother's Name">
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
                                                                <input type="text" name='contact1' placeholder="Mobile#" id="contact1" class="form-control" value="<?php if (!empty($inquiry)) {
    echo $inquiry[0]['contact'];
} ?>">
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
                                                            <textarea class="form-control" name='address' id="inputExperience" placeholder="Address"><?php if (!empty($inquiry)) {
    echo $inquiry[0]['address'];
} ?></textarea>
                                                        </div>
                                                    </div>


                                                    <!--                                                    <div class="form-group">
                                                                                                            <div class="col-sm-11 ">
<?php // $this->Form->button(__('<i class="fa fa-floppy-o"></i> Save'), ['onclick' => 'validate_form();', 'class' => 'btn btn-danger pull-right', 'escape' => false])  ?>
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
                                                                    <input type="text"  placeholder="Date of Admission" name="feemonth" value="<?php echo date('m') . '/10/' . date('Y'); ?>" class="form-control pull-right" id="feemonth" value="<?php echo date("m/d/Y"); ?>">
                                                                </div>
                                                            </div>
                                                        </div> 
                                                        
                                                        
                                                        <div class="form-group">
                                                            <label for="inputName" class="col-sm-2 control-label">Fee Amount:</label>
                                                            <div class="col-sm-9">
                                                                <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-dollar"></i>
                                                                    </div>
                                                                    <input type="text"  placeholder="Fee Amount" name="feeamount" value="" class="form-control pull-right" id="feeamount" value="">
                                                                </div>
                                                            </div>
                                                        </div>  
                                              
                                              
                                                        

                                                        <div class="form-group">
                                                            <label for="class_id" class="col-sm-2 control-label">Fee Head</label>
                                                            <div class="col-sm-9">
                                                                <select class="form-control" id="feehead"  data-placeholder="Select Fee Head" style="width: 100%;">
<?php foreach ($feetype as $feetypes): ?>    
                                                                        <option value="<?php echo $feetypes->id_fee_type; ?>"><?php echo $feetypes->fee_type_name; ?></option>
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
<?php // $this->Form->end()  ?>   
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

<?php // $this->Html->script('datatable.js')  ?> 

<script>

    $(document).ready(function () {
        // theTable.init();
        tabltint();

    });


    function search_record() {
        tabltint();

    }
    var tabltint = function () {
        if ($.fn.DataTable.isDataTable("#userstable")) {
            $("#userstable").dataTable().fnDestroy();
        }

        var theTable = $('#userstable').DataTable({

            //"dom": '<"top"i>rt<"bottom"flp><"clear">',
            'bFilter': false,
            'responsive': true,
            'processing': true,
            'serverSide': true,
            "error": false,
            "lengthMenu": [
                [10, 20, 50, 100, 150, -1],
                [10, 20, 50, 100, 150, "All"] // change per page values here
            ],
            "pageLength": 10, // default record count per page
            "stateSave": true,
            "ajax": {
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'Registration', 'action' => 'getbysearch']); ?>",
                dataType: 'json',
                cache: false,
                async: false,
                "data": function (d) {
                    d.status = $('#status option:selected').val();
                    d.cc = $('#reg_id').val();
                    d.fmc = $('#fmc').val();
                    d.name = $('#search').val();
                    d.class_id = $('#class_id1 option:selected').val();
                    d.shift_id = $('#shift_id option:selected').val();
                    d.contact = $('#mobile').val();
                }
            },
            "oLanguage": {
                "sProcessing": '<img src="https://eschools.cloud/images/loading-spinner-grey.gif">'
            },
            "columnDefs": [{// define columns sorting options(by default all columns are sortable extept the first checkbox column)
                    'orderable': false,
                    'targets': [0]

                }],
            "order": [
                [2, "asc"]
            ], // set first column as a default sort by asc
            "columns": [
                {
                    "className": 'details-control',
                    "searchable": false,
                    "data": null,
                    "defaultContent": ''
                },
                {"render": function (data, type, JsonResultRow, meta) {
                        return '<img class="img-circle" src="' + JsonResultRow.host + '"  style="width:20px;">';
                    }},
                {"data": "id"},
                {"data": "sname"},
                {"data": "fname"},
                {"data": "contact"},
                {"data": "class"},
                {"data": "shift"},
                {"data": "actions"},
            ],
            columnDefs: [{
                className: 'details-control',
                orderable: false,
                targets:   0
            }]
        });
        
        // Add event listener for opening and closing details
            $('#userstable tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            } );

    }
    
    function format ( d ) {
            // `d` is the original data object for the row
            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                '<tr>'+
                    '<td>GR No. :</td>'+
                    '<td>'+d.gr_no+'</td>'+
                '</tr>'+
//                '<tr>'+
//                    '<td>Extension number:</td>'+
//                    '<td>'+d.extn+'</td>'+
//                '</tr>'+
//                '<tr>'+
//                    '<td>Extra info:</td>'+
//                    '<td>And any further details here (images etc)...</td>'+
//                '</tr>'+
            '</table>';
    }

    $(document).ready(function () {


        $("#class_id1").select2();
        $("#class_id").select2();


        get_roll_no();

        var table = $('#userstable').DataTable();

        $('#userstable tbody').on('click', 'tr', function () {
            if ($(this).hasClass('selected')) {
                //  $(this).removeClass('selected');
                $(this).addClass('selected');
            } else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });


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
            data: {class: id_class, shift: id_shift, campus_id: id_campus},
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
    function clearform() {
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
    function validate_form() {

        if ($('#datepicker').val() === '') {
            swal(
                    'Required?',
                    'Please select registration date!',
                    'warning'
                    );
            //   imageOverlay('#add-student-form', 'hide');
            return false;
        }

        if ($('#student_name').val() === '') {
            swal(
                    'Required?',
                    'Please enter student name!',
                    'warning'
                    );
            //  imageOverlay('#add-student-form', 'hide');
            return false;
        }

        if ($('#father_name').val() === '') {
            swal(
                    'Required?',
                    'Please enter father name!',
                    'warning'
                    );
            //   imageOverlay('#add-student-form', 'hide');
            return false;
        }
        imageOverlay('#add-student-form', 'show');
        var str = $("#forget-form").serializeArray();

        $('#fu').attr('disabled', true);
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'Registration', 'action' => 'add']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: str, //only input,
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
                } else {
                    toastr.error(result[0], result[1]);
                }
            }
        });
        $('#fu').attr('disabled', false);
        imageOverlay('#add-student-form', 'hide');
    }

    function loadmodal() {

        $('#add-students').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }
    function updateimage() {

        var fd = new FormData();
        var file_data = $('input[type="file"]')[0].files; // for multiple files
        for (var i = 0; i < file_data.length; i++) {
            fd.append("file", file_data[i]);
        }
        var other_data = $('forget-form').serializeArray();
        $.each(other_data, function (key, input) {
            fd.append(input.name, input.value);
        });
        var id = $('#cc').val();
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'Registration', 'action' => 'updateimage']); ?>/" + id,
            dataType: 'json',
            cache: false,
            async: false,
            data: fd, //only input,
            contentType: false,
            processData: false,
            success: function (data) {

            }
        });


    }
    function imageupload() {
        var fd = new FormData();
        var file_data = $('input[type="file"]')[0].files; // for multiple files
        for (var i = 0; i < file_data.length; i++) {
            fd.append("file", file_data[i]);
        }
        var other_data = $('forget-form').serializeArray();
        $.each(other_data, function (key, input) {
            fd.append(input.name, input.value);
        });

        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'Registration', 'action' => 'imageupload']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: fd, //only input,
            contentType: false,
            processData: false,
            success: function (data) {
                var result = data.msg.split("|");
                var filename = data.fileName;
                $('#filename').val(filename);
                if (result[0] === "Success") {
                    toastr.success(result[0], result[1]);
                } else {
                    $('#upload').val('');
                    $('#imgpath').html('<?php echo $this->Html->image('students_images/avatar-1.jpg', ['alt' => 'user Picture', 'class' => 'profile-user-img img-responsive img-circle', 'id' => 'blah']); ?>');
                    toastr.warning(result[0], result[1]);
                }

            }
        });
    }
    function inactive_student(id, status) {
        var msgg = '';
        var msg = '';
        if (status === 'N') {
            msgg = "Really do you want to inactive this student!";
            msg = "Please enter the valid reason of inactive.";
        } else {
            msgg = "Really do you want to Active this student!";
            msg = "Please enter the valid reason of Active.";
        }
        swal({
            title: msgg,
            input: 'textarea',
            showCancelButton: true,
            confirmButtonText: 'Save',
            showLoaderOnConfirm: true,
            preConfirm: function (reason) {
                return new Promise(function (resolve, reject) {
                    setTimeout(function () {
                        if (reason === '') {
                            reject(msg)
                        } else {
                            resolve()

                            if (id > 0) {
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo $this->Url->build(['controller' => 'Registration', 'action' => 'delete']); ?>",
                                    dataType: 'json',
                                    cache: false,
                                    async: false,
                                    data: {id: id, status: status,reason:reason},
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
                    }, 2000)
                })
            },
            allowOutsideClick: false
        }).then(function (reason) {
            swal({
                type: 'success',
                title: 'Command(s) completed successfully.',
                // html: 'Submitted email: ' + reason
            })
            search_record();
        })

    }


    function del() {
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

    function generate_dues() {
        imageOverlay('#otherdetails', 'show');
        var reg_id = $('#cc').val();
        if (reg_id == '' || reg_id == '-') {
            imageOverlay('#otherdetails', 'hide');
            toastr.error("Please enter Student's ID");
            return false;
        }
        var feemonth = $('#feemonth').val();
        if (feemonth == '') {
            imageOverlay('#otherdetails', 'hide');
            toastr.error("Please select Fee Month");
            return false;
        }
        
        var feeamount = $('#feeamount').val();
        if(feeamount == ''){
            imageOverlay('#otherdetails', 'hide');
            toastr.error("Please select Fee Amount");
            return false;
        }

        var ft = $('#feehead option:selected').val();

        var class_id = $('#cid').val();
        var shift_id = $('#sid').val();
        var session_id = $('#ssid').val();
        var campus_id = $('#cmid').val();
        $('#dg').attr('disabled', true);
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'Registration', 'action' => 'generatedues']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {reg_id: reg_id,
                class_id: class_id,
                shift_id: shift_id,
                session_id: session_id,
                campus_id: campus_id,
                feemonth: feemonth,
                feeamount:feeamount,
                ft: ft},
            success: function (data) {

                var result = data.msg.split("|");

                if (result[0] === "Success") {

                    toastr.success(result[0], result[1]);
                } else {
                    toastr.error(result[0], result[1]);
                }
                $('#dg').attr('disabled', false);
                imageOverlay('#otherdetails', 'hide');
            }
        });
    }

    function edit_record(id) {


        location.assign("<?php echo $this->Url->build(['controller' => 'Registration', 'action' => 'edit']); ?>/" + id);

    }


</script>
