<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">

                    <h3 class="box-title">Remarks for students</h3>
                    
                
                  
                        <div class="btn-group pull-right">
                            <div class="actions" style="margin-bottom: 28px;">
                                <a  href="#add-account" onclick="loadmodal();" title="Add Fees" class="btn btn-block btn-success">
                                    <i class="fa fa-plus"></i> Add </a>
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
                                <td><?= $row['dated']; ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['#' => '#'], ['onclick'=>"edit_loadmodal($row->class_id,$row->shift_id);", 'class' => 'btn btn-icon waves-effect waves-light btn-warning m-b-5', 'escape' => false]) ?>
                                    <?= $this->Html->link(__('<i class="fa fa-trash"></i> Delete'), ['#' => '#'], ['onclick'=>"delete_remarks($row->class_id,$row->shift_id);",'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                                   
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
<div class="modal fade " id="add-fee"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:95%!important;">
        <div class="modal-content">


            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <form>
                            <div class="row col-xs-12" id="loadind">

                                <div  class="col-md-3">     
                                    <div class="form-group">
                                  
                                        <select class="form-control" id="class_id"  data-placeholder="Select Class" style="width: 100%;">
                                            <?php foreach ($class as $class): ?>    
                                                <option value="<?php echo $class->id_class; ?>"><?php echo $class->class_name; ?></option>
                                            <?php endforeach; ?>    
                                        </select>
                                    </div>
                                </div>

                                <div  class="col-md-3">   
                                    <div class="form-group">
                                 
                                        <select class="form-control" name="shift_id" id="shift_id">
                                            <option value="1">Morning</option>
                                            <option value="2">Afternoon</option>
                                            <option value="3">Evening</option>
                                        </select>
                                    </div> 
                                </div>    

                                <div  class="col-md-3">   
                                    <div class="form-group">
                                   
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" value="<?= date("m/d/Y");  ?>" id="due_date">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div  class="col-md-3">   
                                    <div class="form-group">  
                                    <div class="pull-right" style="margin-right:0px!important;"> 
                                        <button onclick="getStudents();" readonly type="button" class="btn btn-icon waves-effect waves-light btn-success m-b-5">Search</button>
                                        <button type="button" onclick="javascript:window.reload()" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
                                    </div>  
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
                                        <th width="10%">Reg.ID</th>
                                        <th width="15%">Student's Name</th>
                                        <th width="15%">Student's Name</th>
                                        <th width="10%">Attitude</th>
                                        <th width="10%">Communication Skills</th>
                                        <th width="10%">Interests and Talents</th>
                                        <th width="10%">Participation</th>
                                        <th width="10%">Time Management</th>
                                        <th width="10%">Work Habits</th>
                                      

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
                        <button onclick="add_remarks();" readonly type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Save</button>
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
                        
            <div class="modal-body" id="smsloading">
                <form class="form-horizontal form-bordered form-row-stripped">
                    <div class="form-body">
                       
                        <div class="form-group">
                            <label class="control-label col-md-3">Status:</label>
                            <div class="col-md-9">
                               <select class='form-control'  id='attendace_status' name='attendace_status'>
                                    <option value='A'>Absent</option>
                                   <option value='L'>leave</option>
                                   <option value='P'>Present</option>
                                  
                               </select>
                               
                            </div>
                        </div>
                       
                    <div class="form-group">
                        <label for="inputExperience" class="col-sm-3 control-label">Message</label>

                        <div class="col-sm-9">
                          <textarea class="form-control" name='message' id="message" placeholder="Message">Attention: [name]  is absent from Institute today, please submit the cause of absent at institute office.<?php  echo $this->request->session()->read('Info.school'); ?></textarea>
                        </div>
                    </div>
                        
                        
                        
                    </div>
                </form>
                 
            </div>
            <div class="modal-footer">
                <button onclick="sendsms();" type="button" id="btnsend" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Send</button>
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

    function getStudents() {


        var class_id = $('#class_id option:selected').val();
        var shift_id = $('#shift_id option:selected').val();
      //  var campus_id = $('#campus_id option:selected').val();
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
            url: "<?php echo $this->Url->build(['controller' => 'RemarksForStudents', 'action' => 'loadstudents']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {class: class_id, shift: shift_id},
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
                        mhtml += "<td><input type='text' class='form-control' style='height:25px;' value='0' /></td>";
                        mhtml += "<td><input type='text' class='form-control' style='height:25px;' value='0' /></td>";
                        mhtml += "<td><input type='text' class='form-control' style='height:25px;' value='0' /></td>";
                        mhtml += "<td><input type='text' class='form-control' style='height:25px;' value='0' /></td>";
                        mhtml += "<td><input type='text' class='form-control' style='height:25px;' value='0' /></td>";
                        mhtml += "<td><input type='text' class='form-control' style='height:25px;' value='0' /></td>";
                            
                         
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

  
   
    function loadmodalsms(c,s) {
    
    $('#sms_class_id').val(c);
    $('#sms_shift_id').val(s);
    
    $('#sms').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }
    
    function add_remarks() {
        var class_id = $('#class_id option:selected').val();
        var shift_id = $('#shift_id option:selected').val();
        var date = $('#due_date').val();
        
        var allgood = true;
            var TableData;
            TableData = storeFeeTblValues()
            if (TableData.length > 0) {
               imageOverlay('#attedancetable', 'show');
                toastr["info"]("Please wait..", "Processing");
                $.ajax({
                    type: "POST",
                    url: "<?php echo $this->Url->build(['controller' => 'RemarksForStudents', 'action' => 'add']); ?>",
                    dataType: 'json',
                    data: {remarks_details: TableData,class_id:class_id,shift_id:shift_id,date:date},
                    success: function (data) {
                        var result = data.msg.split("|");
                        if (result[0] === "Success") {
                            imageOverlay('#attedancetable', 'hide');
                            toastr.success(result[0], result[1]);
                          //  $('#add-fee').modal('hide');
                          //  location.reload();
                        } else {
                            toastr.warning(result[0], result[1]);
                        }
                    }
                });
            } else {
                toastr["warning"]("Nothing Added", "Record");
            }

    } 
    
    
  function storeFeeTblValues(){
        var TableData = new Array();

        $('#attedancetable tr').each(function (row, tr) {
            TableData[row] = {
                "regid": $(tr).find('td:eq(0)').text()
                , "val_1": $(tr).find('td:eq(3)>input').val()
                , "val_2": $(tr).find('td:eq(4)>input').val()
                , "val_3": $(tr).find('td:eq(5)>input').val()
                , "val_4": $(tr).find('td:eq(6)>input').val()
                , "val_5": $(tr).find('td:eq(7)>input').val()
                , "val_6": $(tr).find('td:eq(8)>input').val()
                
            }
        });
        TableData.shift();  // first row will be empty - so remove

        return TableData;
    }

    function edit_loadmodal(class_id,shift_id) {
       
        $('#add-fee').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
      
         $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'RemarksForStudents', 'action' => 'getremarks']); ?>/"+class_id+"/"+shift_id,
            dataType: 'json',
            cache: false,
            async: false,
            data: {},
            success: function (data) {
                var result = data.msg.split("|");
                var mdata = data.remarksForStudent;
                var mhtml = "";
                $("#attedancetable tbody").html('');
                if (result[0] === "Success") {
                    for (var x = 0; x < mdata.length; x++) {
                       
                        mhtml += '<tr>';
                        mhtml += "<td>" + mdata[x]['registration_id'] + "</td>";
                        mhtml += "<td>" + mdata[x]['sname'] + "</td>";
                        mhtml += "<td>" + mdata[x]['fname'] + "</td>";
                        mhtml += "<td><input type='text' class='form-control' style='height:25px;' value="+ mdata[x]['Attitude'] +" /></td>";
                        mhtml += "<td><input type='text' class='form-control' style='height:25px;' value="+ mdata[x]['Communicationskills'] +" /></td>";
                        mhtml += "<td><input type='text' class='form-control' style='height:25px;' value="+ mdata[x]['interestsandtalents'] +" /></td>";
                        mhtml += "<td><input type='text' class='form-control' style='height:25px;' value="+ mdata[x]['participation'] +" /></td>";
                        mhtml += "<td><input type='text' class='form-control' style='height:25px;' value="+ mdata[x]['timemanagement'] +" /></td>";
                        mhtml += "<td><input type='text' class='form-control' style='height:25px;' value="+ mdata[x]['workhabits'] +" /></td>";
                           
                        mhtml += '</tr>';
                        $('#class_id').val(mdata[x]['class_id']).change(); 
                        $('#shift_id').val(mdata[x]['shift_id']).change();
                        
                     }
                   
                    $("#attedancetable tbody").append(mhtml);
                } else {
                    toastr.error(result[0], result[1]);
                }

            }
        });
 
    }
    
     function delete_remarks(class_id,shift_id) {

        swal({
            title: 'Are you sure?',
            text: "you want to delete!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then(function (result) {
            if (result == true) {
               
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'RemarksForStudents', 'action' => 'delete']); ?>/"+class_id+"/"+shift_id,
                        dataType: 'json',
                        data: {},
                        success: function (data) {
                            var result = data.msg.split("|");
                            if (result[0] === "Success") {
                                toastr.success(result[0], result[1]);
                                location.reload();
                            } else {
                                toastr.error(result[0], result[1]);
                            }
                        }
                    });
                

            }
                    swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });

    }


</script>