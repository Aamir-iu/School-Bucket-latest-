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

                    <h3 class="box-title">Employee Daily Attendance</h3>
                    
                
                  
                        <div class="btn-group pull-right">
                            
                            
                            <div class="btn-group" style="margin-bottom: 28px;">
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li>
                                        <a href="javascript:void(0);"  onclick="loadmodal();"><?= __('<i class="fa fa-users"></i> Mark Attendance') ?></a>
                                    </li>
                                    
                                    <li>
                                        <a href="javascript:void(0);" onclick="loadmodalsms(1);"><?= __('<i class="fa fa-send"></i> Send  SMS (All)') ?></a>
                                    </li>
                                    
                                    <li>
                                        <a href="javascript:void(0);" onclick="loadmodalPrint();"><?= __('<i class="fa fa-calendar"></i> View Reports') ?></a>
                                    </li>
                                    
                                    <li>
                                        <a href="javascript:void(0);" onclick="loadmodalSetting();"><?= __('<i class="fa fa-gears"></i> Message Setting') ?></a>
                                    </li>
                                    

                                </ul>
                                <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
                                    <?= __('Actions') ?> <i class="fa fa-angle-down"></i>
                                </button>
                            </div>
                            
                            
                        </div>
                   
                    

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="userstable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <tr role="row" class="heading">
                                
                                <th width="10%">Employee ID</th>
                                <th width="20%">Employee Name</th>
                                <th width="10%">Status</th>
                                <th width="10%">Date</th>
                                <th width="10%">Time</th>
                                <th width="30%">Actions</th
                                
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($employeeAttendance as $row): ?>
                            <tr>
                                <td><?= $row->employee_id ?></td>
                                <td><?= $row->employee['employee_name']; ?></td>
                                <td class="<?= $row->status === 'P' ? 'alert alert-success' : 'alert alert-danger' ?>"><?= $row->status === 'P' ? 'Present' : 'Absent' ?></td>
                                <td><?= $row->attendace_date ?></td>
                                <td><?= $row->attendance_time ?></td>
                                
                                <td class="actions">
                               
                                    <?= $this->Html->link(__('<i class="fa fa-trash"></i> Delete'), ['#' => '#'], ['onclick'=>"delete_attendance($row->id_attendance);",'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                                    <?= $this->Html->link(__('<i class="fa fa-envelope-o"></i> Send SMS'), ['#' => '#'], ['onclick'=>"loadmodalsms(0,$row->employee_id);",'class' => 'btn btn-icon waves-effect waves-light btn-info m-b-5', 'escape' => false]) ?>
                               </td>
                                
                                
                            </tr>

                            <?php  endforeach; ?>   

                        </tbody>



                    </table>
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

<!-- BEGIN EDIT SUB ACCOUNT MODAL FORM-->
<div class="modal fade" id="add-fee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">


            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <form>
                            <div class="row col-xs-12" id="loadind">

                                <div class="col-sm-4">
                                    <select class="form-control"  id="mdepart_id" name="mdepart_id" data-placeholonchangeder="Select Payment Type" style="width: 100%;">
                                      <?php foreach($departments as $d): ?>  
                                          <option  value="<?= $d->department_id ?>"><?= $d->department_name ?></option>
                                      <?php endforeach; ?> 
                                    </select>
                                </div> 


                                <div  class="col-md-4">   
                                  
                                  
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" value="<?= date("m/d/Y");  ?>" id="due_date">
                                        </div>
                                        <!-- /.input group -->
                                   
                                </div>
                                
                                
                                <div  class="col-md-4">   
                                  
                                  
                                    <div class="pull-right" style="margin-right:0px!important;"> 
                                        <button onclick="generate_dues();" readonly type="button" class="btn btn-icon waves-effect waves-light btn-success m-b-5">Search</button>
                                        <button type="button" onclick="javascript:window.reload()" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
                                    </div>  
                               
                                   
                                </div>


                            </div>     
                        </form>
                   
                </div>
            </div>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">

                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table id="attedancetable"  class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="15%">Employee ID</th>
                                        <th width="30%">Employee Name</th>
                                        <th width="20%">Attendance Time</th>
                                        <th width="35%">Attendance Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>   
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </div>
            
            <div class="modal-footer">
                <div class="form-group">  
                    <div class="pull-right" style="margin-right:0px!important;"> 
                        <button onclick="add_attendace();" readonly type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Save</button>
                        <button  type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
                   </div>  
                </div>   
            </div>     

    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- BEGIN SMS MODAL FORM-->
<div class="modal fade" id="sms"  role="sms" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Send SMS</h4>
            </div>
            
            <input type="text" class="hidden" id="staff_id" value=""> 
            <input type="text" class="hidden" id="flag" value="">
                        
            <div class="modal-body" id="smsloading">
                <form class="form-horizontal form-bordered form-row-stripped">
                    <div class="form-body">
                       
                        <div class="form-group">
                            <label class="control-label col-md-3">Status:</label>
                            <div class="col-md-9">
                                <select onchange="change_message();" class='form-control'  id='attendace_status' name='attendace_status'>
                                    <option value='A'>Absent</option>
                                   <option value='L'>leave</option>
                                   <option value='P'>Present</option>
                                   <option value='T'>Late</option>
                                  
                               </select>
                               
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label for="inputExperience" class="col-sm-3 control-label">Message</label>

                            <div class="col-sm-9">
                                <textarea class="form-control"cols="4"  rows="5" name='message' id="message" placeholder="Message"></textarea>
                            </div>
                        </div>
                        
                    </div>
                </form>
                 
            </div>
            <div class="modal-footer">
                <button onclick="sendsms(0);" type="button" id="btnsend" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Send</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- BEGIN REPORT MODAL FORM-->
<div class="modal fade" id="add-print"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Print Attendance Reports</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">

                   <div class="form-group">
                        <label for="depart_id"   class="col-sm-3 control-label">Department: </label>
                        <div class="col-sm-9">
                          <select class="form-control"  id="depart_id" name="depart_id" data-placeholonchangeder="Select Payment Type" style="width: 100%;">
                            <?php foreach($departments as $d): ?>  
                                <option  value="<?= $d->department_id ?>"><?= $d->department_name ?></option>
                            <?php endforeach; ?> 
                          </select>
                         </div> 
                  </div>
                    
                  <div class="form-group">
                        <label for="salary_month"   class="col-sm-3 control-label">Salary Month: </label>
                        <div class="col-sm-3">
                          <select class="form-control"  id="salary_month_id" name="salary_month_id" data-placeholonchangeder="Select Payment Type" style="width: 100%;">
                            <?php foreach($months as $m): ?>  
                              <?php $m_id = ltrim(date("m"),'0'); ?>
                              <option <?php echo $m->id_month == $m_id ? "selected" : ""; ?> value="<?= $m->id_month ?>"><?= $m->month_name ?></option>
                            <?php endforeach; ?> 
                          </select>
                         </div> 

                        <label for="salary_year"   class="col-sm-3 control-label">Salary Year: </label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="salary_year_id" name="salary_year_id" value="<?= date("Y") ?>" />
                         </div> 

                    </div>  

                </form>
            </div>
            <div class="modal-footer">
                <button onclick="Print_report();" type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5"><li class="fa fa-print"></li> Print</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal"><li class="fa fa-close"></li> Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->    

<!-- BEGIN SETTING MODAL FORM-->
<div class="modal fade" id="add-setting"  role="sms" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Message Setting</h4>
            </div>
            
            <input type="text" class="hidden" id="sms_class_id" value=""> 
            <input type="text" class="hidden" id="sms_shift_id" value="">
            <input type="text" class="hidden" id="flag" value="">
                        
            <div class="modal-body" id="settingloading">
                <form class="form-horizontal form-bordered form-row-stripped">
                    <div class="form-body">
                       
                    <div class="form-group">
                        <label for="inputExperience" class="col-sm-3 control-label">Present</label>
                        <div class="col-sm-9">
                            <textarea class="form-control"cols="4"  rows="5" name='present' id="present" placeholder="Message"><?= $messages[0]['staff_present']; ?></textarea>
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label for="inputExperience" class="col-sm-3 control-label">Absent</label>
                        <div class="col-sm-9">
                            <textarea class="form-control"cols="4"  rows="5" name='absent' id="absent" placeholder="Message"><?= $messages[0]['staff_absent']; ?></textarea>
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label for="inputExperience" class="col-sm-3 control-label">Leave</label>
                        <div class="col-sm-9">
                            <textarea class="form-control"cols="4"  rows="5" name='leave' id="leave" placeholder="Message"><?= $messages[0]['staff_leave']; ?></textarea>
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label for="inputExperience" class="col-sm-3 control-label">Late</label>
                        <div class="col-sm-9">
                            <textarea class="form-control"cols="4"  rows="5" name='late' id="late" placeholder="Message"><?= $messages[0]['staff_late']; ?></textarea>
                        </div>
                    </div>      
                        
                        
                        
                    </div>
                </form>
                 
            </div>
            <div class="modal-footer">
                <button onclick="saveSetting();" type="button" id="btnsend" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Save Setting</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/timepicker/bootstrap-timepicker.min.js') ?> 
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?> 
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.js') ?>
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
<?= $this->Html->script('../plugins/input-mask/jquery.inputmask.js') ?>
<script>

    
    $(".mytime").timepicker({
            showInputs: false
    });

    $('#due_date').datepicker({
        autoclose: true
    });

    $(function () {
        $("#userstable").DataTable();

    });

    function generate_dues() {

        var department_id = $('#mdepart_id option:selected').val();

        imageOverlay('#attedancetable', 'show');
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'EmployeeAttendance', 'action' => 'getEmployees']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {department_id: department_id},
            success: function (data) {
               
                var mdata = data.data;
                imageOverlay('#attedancetable', 'hide');
                var mhtml = "";
                $("#attedancetable tbody").html('');
                if (mdata) {
                   
                    for (var x = 0; x < mdata.length; x++) {
                        mhtml += '<tr>';
                        mhtml += "<td>" + mdata[x]['employee_id'] + "</td>";
                        mhtml += "<td>" + mdata[x]['employee_name'] + "</td>";
                        
                        
                        mhtml += "<td>";
                        mhtml += "<div class='input-group'>";
                        mhtml += "<input name='srtattime' id='time"+mdata[x]['employee_id']+"' type='text' class='form-control timepicker mytime' value='' />";
                        
                        mhtml += "<div class='input-group-addon'><i class='fa fa-clock-o'></i></div>";
                        mhtml += "</div>";
                        mhtml += "</td>";
                        
                        
                        
                        /*mhtml += "<td><select class='form-control' style='height:30px;' id='attendace_status' name='attendace_status'><option value='P'>Present</option><option value='A'>Absent</option><option value='L'>leave</option><option value='T'>late</option></select></td>";
                        mhtml += '</tr>';*/
                        mhtml += "<td><form style='height:30px;' id='attendace_status' ><input type='radio' name='attendace_status' checked='checked' value='P'>Present<input type='radio' name='attendace_status' value='A'>Absent<input type='radio' name='attendace_status' value='L'>Leave<input type='radio' name='attendace_status' value='T'>Late</form></td>";
                        /*mhtml += "<td> <input type='radio' name='gender' value='male'  checked='checked'> Male<br> </td> "*/
                        mhtml += '</tr>';
                    }
                    $("#attedancetable tbody").append(mhtml);
                        $(".mytime").timepicker({
                            showInputs: false
                        });
                } else {
                   
                }

            }
        });
    }

    function loadmodal() {

        $("#attedancetable tbody").html('');
        $('#add-fee').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }

  
   function add_attendace(){
        imageOverlay('#attedancetable', 'show');
        var department_id = $('#mdepart_id option:selected').val();

        var att_date = $('#due_date').val();
        console.log(att_date);
        var TableData;
        TableData = storeFeeTblValues()
        if (TableData.length > 0) {
      
            toastr["info"]("Inserting Attedance", "Processing");
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller'=> 'EmployeeAttendance', 'action' => 'add']); ?>",
                dataType:'json',
                cache: false,
                async: false,
                data: {department_id:department_id
                      ,ad:att_date,att:TableData},
                success: function(data) {
                    imageOverlay('#attedancetable', 'hide');
                    var result = data.msg.split("|");
                    if (result[0] === "Success") {
                         toastr.success(result[0], result[1]);
                     } else {
                        toastr.warning(result[0], result[1]);                        
                    }
                }
            });
        
        }
    }
    
    function storeFeeTblValues(){
        var TableData = new Array();

        $('#attedancetable tr').each(function (row, tr) {
            TableData[row] = {
                "emp_id": $(tr).find('td:eq(0)').text()
                , "time": $(tr).find('td:eq(2)>div>input').val()
                , "status": $(tr).find('td:eq(3)>form input:checked').val()
               
                
            }
        });
        TableData.shift();  // first row will be empty - so remove

        return TableData;
    }
    
    function delete_attendance(id) {

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
                if (id > 0) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'EmployeeAttendance', 'action' => 'delete']); ?>",
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {id: id},
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
//           swal(
//            'Deleted!',
//            'Record has been delete.',
//            'success'
//           
//          )
          location.reload();
        });

    }

    function loadmodalsms(f,id) {
        $('#flag').val(f);
        $('#staff_id').val(id);
        $('#message').text($('#absent').val());
        $('#sms').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
    }
    
    function loadmodalPrint() {
       $('#add-print').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }
    
    function loadmodalSetting() {
       
       $('#add-setting').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }

    function sendsms(){
        
        var status   = $('#attendace_status option:selected').val();
        var message  = $('#message').val();
        var f  = $('#flag').val();
        var id  = $('#staff_id').val();
        imageOverlay('#smsloading','show');
        $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'EmployeeAttendance', 'action' => 'sendsms']); ?>/"+f,
                dataType: 'json',
                cache: false,
                async: false,
                data: {id:id,status:status,message:message},
                success: function (data) {
                    imageOverlay('#smsloading', 'hide');
                    var result = data.msg.split("|");
                    if (result[0] === "Success") {
                        toastr.success(result[0], result[1]);
                    } else {
                        toastr.error(result[0], result[1]);
                    }
                }
         });
    }
    
    function saveSetting(){
        
        var present = $('#present').val();
        var absent = $('#absent').val();
        var leave   = $('#leave').val();
        var late  = $('#late').val()

        imageOverlay('#settingloading','show');
        $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'EmployeeAttendance', 'action' => 'setting']); ?>/",
                dataType: 'json',
                cache: false,
                async: false,
                data: {staff_present: present,staff_absent:absent,staff_leave:leave,staff_late:late},
                success: function (data) {
                    imageOverlay('#settingloading', 'hide');
                    var result = data.msg.split("|");
                    if (result[0] === "Success") {
                        toastr.success(result[0], result[1]);
                    } else {
                        toastr.error(result[0], result[1]);
                    }
                }
                 
            });
    
    }
    
    
    
    function change_message(){
    
        var status =  $('#attendace_status option:selected').val();
        if(status  === 'P'){
             $('#message').val($('#present').val());
        }else if(status  === 'A'){
             $('#message').val($('#absent').val());
        }else if(status === 'L'){
            $('#message').val($('#leave').val());
        }else if(status === 'T'){
            $('#message').val($('#late').val());
        }
    
    
    }
    
    function Print_report() {
        var department_id =  $('#depart_id option:selected').val();
        var month_id =  $('#salary_month_id option:selected').val();
        var year =  $('#salary_year_id').val();
       // var report_type =  $('#report_type option:selected').val();
        var flag = '1';
        window.open("<?php echo $this->Url->build(['controller' => 'EmployeeAttendance', 'action' => 'view']); ?>/"+flag+"/"+department_id+"/"+month_id+"/"+year);

    }
    
//Attention: [name]  is absent from Institute today, please submit the cause of absent at institute office.
</script>
<style type="text/css"> 
   input[type="radio"]{margin: 5px 5px};} 
</style>