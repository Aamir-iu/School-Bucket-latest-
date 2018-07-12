<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">

                    <h3 class="box-title">Students Daily Attendance</h3>
                    
                
                  
                        <div class="btn-group pull-right">
                            
                            
                            <div class="btn-group" style="margin-bottom: 28px;">
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li>
                                        <!--<?= $this->Html->link(__('sms'), ['action' => 'add']) ?>-->
                                        <a href="javascript:void(0);"  onclick="loadmodal();"><?= __('Mark Attendance') ?></a>
                                    </li>
                                    
                                    <li>
                                        <!--<?= $this->Html->link(__('sms'), ['action' => 'add']) ?>-->
                                        <a href="javascript:void(0);"  onclick="loadmodalsms(1);"><?= __('Send  SMS (All)') ?></a>
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
                                
                                <th width="30%">Class and Section</th>
                                <th width="20%">Shift</th>
                                <th width="20%">Date</th>
                                <th width="30%">Actions</th
                                
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($data as $row): ?>
                            <tr>

                                <td><?= $row['class']; ?> </span> </td>
                                <td><?= $row['shift']; ?></td>
                                <td><?= $row['date']; ?></td>
                                <td class="actions">
                                    <?php // $this->Html->link(__('<i class="fa fa-print"></i> Print'), ['action' => 'view',1, $row->class_id,$row->shift_id,$row['date']], ['class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 'escape' => false,'target'=>'blank']) ?>
                                    <?= $this->Html->link(__('<i class="fa fa-trash"></i> Delete'), ['#' => '#'], ['onclick'=>"delete_attendance($row->class_id,$row->shift_id);",'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                                    <?= $this->Html->link(__('<i class="fa fa-envelope-o"></i> Send SMS'), ['#' => '#'], ['onclick'=>"loadmodalsms(0,$row->class_id,$row->shift_id);",'class' => 'btn btn-icon waves-effect waves-light btn-info m-b-5', 'escape' => false]) ?>
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

                                <div  class="col-md-4">     
                                    <div class="form-group">
                                        <label>Select Class(Single)</label>
                                        <select class="form-control" id="class_id"  data-placeholder="Select Class" style="width: 100%;">
                                            <?php foreach ($class as $class): ?>    
                                                <option value="<?php echo $class->id_class; ?>"><?php echo $class->class_name; ?></option>
                                            <?php endforeach; ?>    
                                        </select>
                                    </div>
                                </div>

                                <div  class="col-md-4">   
                                    <div class="form-group">
                                        <label for="shift_id"  control-label">Shift</label>
                                        <select onchange="get_roll_no();" class="form-control" name="shift_id" id="shift_id">
                                            <option value="1">Morning</option>
                                            <option value="2">Afternoon</option>
                                            <option value="3">Evening</option>
                                        </select>
                                    </div> 
                                </div>    

                                <div  class="col-md-4">   
                                    <div class="form-group">
                                        <label>Due Date:</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" value="<?= date("m/d/Y");  ?>" id="due_date">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>


                            </div>     

                            <div class="row col-xs-12">
                                <div  class="col-md-4">         
                                    <div class="form-group">
                                        <label for="campus" class="control-label">Campus</label>
                                        <select  class="form-control" name="campus_id" id="campus_id">
                                            <?php foreach ($campus as $campuses): ?>
                                                <option  value="<?php echo $campuses->id_campus; ?>"><?php echo $campuses->campus_name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div> 
                                </div>    

                                <div class="form-group">  
                                    <div class="pull-right" style="margin-right:0px!important;"> 
                                        <button onclick="generate_dues();" readonly type="button" class="btn btn-icon waves-effect waves-light btn-success m-b-5">Search</button>
                                        <button type="button" onclick="javascript:window.reload()" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
                                    </div>  
                                </div>  


                        </form>
                    </div>
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
                                        <th width="20%">Registration.ID</th>
                                        <th width="30%">Student's Name</th>
                                        <th width="30%">Father's Name</th>
                                        <th width="20%">Attendance Status</th>

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
<!-- BEGIN ADD PO MODAL FORM-->
<div class="modal fade" id="sms"  role="sms" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Send SMS</h4>
            </div>
            
            <input type="text" class="hidden" id="sms_class_id" value=""> 
            <input type="text" class="hidden" id="sms_shift_id" value="">
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
                                  
                               </select>
                               
                            </div>
                        </div>
                       
                    <div class="form-group">
                        <label for="inputExperience" class="col-sm-3 control-label">Message</label>

                        <div class="col-sm-9">
                          <textarea class="form-control" name='message' id="message" placeholder="Message"><?php  echo $this->request->session()->read('Info.absent_msg') ?></textarea>
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






<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>    
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
<?= $this->Html->script('datatable.js') ?>  
<script>

    $(document).ready(function () {
        $("#class_id").select2();
    });


    $('#due_date').datepicker({
        autoclose: true
    });

    $(function () {
        $("#userstable").DataTable();

    });

    function generate_dues() {


        var class_id = $('#class_id option:selected').val();
        var shift_id = $('#shift_id option:selected').val();
        var campus_id = $('#campus_id option:selected').val();
        var due_date = $('#due_date').val();

        if (due_date === '') {
            toastr["error"]("Please select Due Date.", "Due Date Not Selected!");
            return false;
        }

        if (class_id === '0') {
            toastr["error"]("Please select class first.", "Class Not Selected!");
            return false;
        }

        imageOverlay('#attedancetable', 'show');
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'StudentAttendance', 'action' => 'getstudents']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {class: class_id, shift: shift_id, campus: campus_id},
            success: function (data) {
                var result = data.msg.split("|");
                var mdata = data.data;
                imageOverlay('#attedancetable', 'hide');
                var mhtml = "";
                $("#attedancetable tbody").html('');
                if (result[0] === "Success") {
                    toastr.success(result[0], result[1]);
                    for (var x = 0; x < mdata.length; x++) {
                        mhtml += '<tr>';
                        mhtml += "<td>" + mdata[x]['registration_id'] + "</td>";
                        mhtml += "<td>" + mdata[x]['sname'] + "</td>";
                        mhtml += "<td>" + mdata[x]['fname'] + "</td>";
                        mhtml += "<td><select class='form-control' style='height:30px;' id='attendace_status' name='attendace_status'><option value='"+ mdata[x]['registration_id'] +"|P'>Present</option><option value='"+ mdata[x]['registration_id'] +"|A'>Absent</option><option value='"+ mdata[x]['registration_id'] +"|L'>leave</option></select></td>";
                        mhtml += '</tr>';
                    }
                    $("#attedancetable tbody").append(mhtml);
                } else {
                    toastr.error(result[0], result[1]);
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
        var att = [];
            $('select[name=attendace_status] option:selected').each(function(i, v) {
                att.push($(this).val()) ;
        });
       
       if(att.length === 0){
           toastr["error"]("Nothing added", "Processing");
           return false;
       }
       
//        swal({
//            title: 'Are you sure?',
//            text: "you want to proceed students attendance!",
//            type: 'warning',
//            showCancelButton: true,
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            confirmButtonText: 'Yes, Sure!'
//          }).then(function (result) {
//            if (result) {
           
            var class_id = $('#class_id option:selected').val();
            var shift_id = $('#shift_id option:selected').val();
            var campus_id = $('#campus_id option:selected').val();
            var att_date = $('#due_date').val();
            toastr["info"]("Inserting Attedance", "Processing");
                $.ajax({
                    type: "POST",
                    url: "<?php echo $this->Url->build(['controller'=> 'StudentAttendance', 'action' => 'add']); ?>",
                    dataType:'json',
                    cache: false,
                    async: false,
                    data: {class:class_id
                           ,shift:shift_id
                           ,campus:campus_id
                           ,ad:att_date,att:att},
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
                
        //    }
//           swal(
//            'Success!',
//            'Attendace has been saved.',
//            'success'
//           
//          )
           location.reload();
      //  });    
                
    }
    
    function delete_attendance(class_id,shift_id) {

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
                if (class_id > 0) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'StudentAttendance', 'action' => 'delete']); ?>",
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {class: class_id,shift:shift_id},
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

    function loadmodalsms(f,c,s) {
    
    $('#sms_class_id').val(c);
    $('#sms_shift_id').val(s);
    $('#flag').val(f);
    
    
    
    $('#sms').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }
 

    function sendsms(){
      
        var class_id = $('#sms_class_id').val();
        var shift_id = $('#sms_shift_id').val();
        var status   = $('#attendace_status option:selected').val();
        var message  = $('#message').val()
        var f  = $('#flag').val()
        
        imageOverlay('#smsloading','show');
        $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'StudentAttendance', 'action' => 'sendsms']); ?>/"+f,
                dataType: 'json',
                cache: false,
                async: false,
                data: {class: class_id,shift:shift_id,status:status,message:message},
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

    function change_message(){
    
        var status =  $('#attendace_status option:selected').val();
        if(status  === 'P'){
             $('#message').val('<?php  echo $this->request->session()->read('Info.examcreation_msg') ?>');
        }else if(status  === 'A'){
             $('#message').val('<?php  echo $this->request->session()->read('Info.absent_msg') ?>');
        }else{
            $('#message').val('<?php  echo $this->request->session()->read('Info.absent_msg') ?>');
        }
    
    
    }
    
//Attention: [name]  is absent from Institute today, please submit the cause of absent at institute office.
</script>