<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                
                <div class="box-header">
    
                    <div class="row">
                    <div class="col-xs-12 pull-right">
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
                                        <select class="form-control" id="session_id"  data-placeholder="Select Class" style="width: 100%;">
                                            <?php foreach ($session as $sess): ?>    
                                                <option value="<?php echo $sess->id_session; ?>"><?php echo $sess->session; ?></option>
                                            <?php endforeach; ?>    
                                        </select>
                                    </div>
                                </div> 

                                <div  class="col-md-3">   
                                    <div class="form-group">  
                                    <div class="pull-right" style="margin-right:0px!important;"> 
                                        <button onclick="getStudents();" readonly type="button" class="btn btn-icon waves-effect waves-light btn-success m-b-5">Search</button>
                                    </div>  
                                </div>  
                                </div>
                                

                            </div>     

                        </form>
                </div>
                </div>


                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table id="attedancetable"  class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="10%">Reg.ID</th>
                                        <th width="20%">Student's Name</th>
                                        <th width="20%">Student's Name</th>
                                        <th width="10%">Roll No</th>
                                        <th width="10%">GR No</th>
                                        <th width="10%">Family Code</th>
                                        
                                      

                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>   
                            </table>
                        </div>
                        <!-- /.box-body -->
                         <div class="modal-footer">
                        <div class="form-group">  
                            <div class="pull-right" style="margin-right:0px!important;"> 
                                <button onclick="add_remarks();" readonly type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Save</button>
                           </div>  
                        </div>   
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



<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>    
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
<?= $this->Html->script('datatable.js') ?>  
<script>


    $(function () {
        $("#userstable").DataTable();

    });

    function getStudents() {


        var class_id = $('#class_id option:selected').val();
        var shift_id = $('#shift_id option:selected').val();
        var session_id = $('#session_id option:selected').val();
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
            data: {class: class_id, shift: shift_id,session_id:session_id},
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
                        mhtml += "<td><input type='text' class='form-control' value='" + mdata[x]['roll_no'] + "' ></td>";
                        mhtml += "<td><input type='text' class='form-control' value='" + mdata[x]['gr_no'] + "' ></td>";
                        mhtml += "<td><input type='text' class='form-control' value='" + mdata[x]['fmc_code'] + "' ></td>";
                       
                         
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
        
        var allgood = true;
            var TableData;
            TableData = storeFeeTblValues()
            if (TableData.length > 0) {
               imageOverlay('#attedancetable', 'show');
                toastr["info"]("Please wait..", "Processing");
                $.ajax({
                    type: "POST",
                    url: "<?php echo $this->Url->build(['controller' => 'RemarksForStudents', 'action' => 'updateRollNumbers']); ?>",
                    dataType: 'json',
                    data: {remarks_details: TableData},
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
                , "roll_no": $(tr).find('td:eq(3)>input').val()
                , "gr_no": $(tr).find('td:eq(4)>input').val()
                , "fmc_code": $(tr).find('td:eq(5)>input').val()
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