<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
             
          
                <span class="caption-subject font-teal-500 bold uppercase">
                    <h3>Room / Hall :  <?php echo $RM[0]['room_name']; ?></h3>
                </span>
                
                <div class="btn-group pull-right">
                    <div class="actions" style="margin-bottom: 28px;">
                        <a  href="javascript:void(0);" onclick="loadModal();" data-toggle="modal" data-original-title="Add Students" title="Add Students" class="btn btn-block btn-success">
                            <i class="fa fa-plus"></i> Add </a>
                    </div>
                </div>
          
                
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="userstable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    
                    <th style="width:10%;">Detail ID</th>
                    <th style="width:20%;">Student Name</th>
                    <th style="width:20%;">Father's Name</th>
                    <th style="width:20%;">Calas</th>
                    <th style="width:10%;">Exam Roll #</th>
                    <th class="actions"><?= __('Actions') ?></th>
                  
                </tr>
                </thead>
                <tbody>
               <?php foreach ($data as $row): ?>
                <tr>
                      
                    <td><?= h($row['id_room_details']) ?></td>
                    <td><?= h($row['name']) ?></td>
                    <td><?= h($row['fname']) ?></td>
                    <td><?= h($row['class']) ?></td>
                    <td><?= h($row['exam_roll_no']) ?></td>
                    
                    
                    <td class="actions">
                        <a  href="#" onclick="delete_record(<?= $row['id_room_details'] ?>);"  class="btn btn-icon waves-effect waves-light btn-danger m-b-5"><i class="fa fa-trash"></i> Delete </a>
                        
                     </td>
                 
                </tr>
                  <?php endforeach; ?>
                </tfoot>
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
    
    
    <!-- BEGIN SMS MODAL FORM-->
<div class="modal fade" id="add-students"  role="sms" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add Students</h4>
            </div>
            <input type="text" class="hidden" id='id_room' value='<?php echo $id; ?>' />
            <div class="modal-body">
                  <div class="box">
                <div class="box-header">

                    <div class="btn-group pull-right">

                        <div class="box-tools">
                            <div class="input-group">
                                <form method="post" action="" id='searchform'>
                                    <table cellpadding="3" cellspacing="3" width="100%">
                                        <tbody><tr>
                                                <td>Class</td>
                                                <td>Shift</td>
                                                <td>Session</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                              
                                                <td>
                                                    <select name="class_id" id="class_id" class="form-control input-sm" style="width: 200px;">
                                                        <?php foreach($classes as $classes):  ?>
                                                            <option  value="<?php echo $classes->id_class; ?>"><?php echo $classes->class_name; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="shift_id" id="shift_id" class="form-control input-sm" style="width: 200px;">
                                                        <option value="1">Morning</option>
                                                        <option value="2">Afternoon</option>
                                                        <option value="3">Evening</option>
                                                    </select>
                                                </td>
                                                <td>
                                                      <select name="session_id" id="session_id" class="form-control input-sm" style="width: 200px;">
                                                        <?php foreach($session as $session):  ?>
                                                            <option  value="<?php echo $session->id_session; ?>"><?php echo $session->session; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary" name="btnSearch" id="btnSearch" type="submit"><i class="fa fa-search" style="height: 18px;"></i> Search </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.box-header -->
                <div class="box-body" id='st_trans'>
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover" id="tablestudent">    
                            <thead>
                                <tr>
                                    <th>Registration ID</th>
                                    <th>Name of Student</th>
                                    <th>Father's Name</th>
                                    <th>Add</th>
<!--                                    <th style="width:20%;"><input type="checkbox" id="mycheck"  class="minimal-red" unchecked> &nbsp;&nbsp; Add All </th>-->
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                           
                        </table>
                                
                         
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
                 
            </div>
            
            
            
            <div class="modal-footer">
                <button onclick="addStudent();" type="button" id="btnsend" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Add</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-danger m-b-5" data-dismiss="modal">Close</button>
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
    
  <?= $this->Html->script('datatable.js') ?>  
<script>
  $(function () {
    $("#userstable").DataTable();
    
    
    $('#searchform').on('submit', function(){
             
               var shift_id = $('#shift_id option:selected').val();
               var session_id = $('#session_id option:selected').val();
               var class_id = $('#class_id option:selected').val();
               $.ajax({
                   type: "POST",
                   url: "<?php echo $this->Url->build(['controller' => 'Registration', 'action' => 'tranfer']); ?>",
                   dataType: 'json',
                   cache: false,
                   async: false,
                   data: {class_id : class_id,
                          shift_id : shift_id,
                          session_id : session_id,
                          },
                   success: function (data) {
                      imageOverlay('#searchform', 'hide');
                      $('#tablestudent tbody').html('');
                      var result = data.msg.split("|");
                      var data = data.data;  
                      if (result[0] === "Success") {
                     
                          toastr.success(result[0], result[1]);
                         
                          var mhtml = "";
                          $.each(data, function(index,value){
                              mhtml += '<tr>';
                                mhtml += '<td>'+ value.registration_id +'</td>';
                                mhtml += '<td>'+ value.sname +'</td>';
                                mhtml += '<td>'+ value.fname + '</td>';
                                mhtml += "<td><select class='form-control chk' style='height:30px;' id='status' name='status'><option value='N'>No</option><option value='Y'>Yes</option></select></td>";
                              mhtml += '</tr>';
                          });
                          $('#tablestudent tbody').append(mhtml);
                          $('#footer_id').show();
                       }else{
                          toastr.error(result[0], result[1]);
                       }
                       
                   }
                    
               });
              
           return false;
          });
    
  });
  
    function loadModal(){
        $('#add-students').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }
 
    function addStudent(){
              
               var shift_id = $('#shift_id2 option:selected').val();
               var session_id = $('#session_id2 option:selected').val();
               var class_id = $('#class_id2 option:selected').val();
               var id = $('#id_room').val();
               imageOverlay('#st_trans', 'show');
               var TableData;
               TableData = storeFeeTblValues()
               
            if (TableData.length > 0) {
             
               $.ajax({
                   type: "POST",
                   url: "<?php echo $this->Url->build(['controller' => 'RoomMaster', 'action' => 'addInRoom']); ?>",
                   dataType: 'json',
                   cache: false,
                   async: false,
                   data: {details: TableData,class_id : class_id,
                          shift_id : shift_id,
                          session_id : session_id,
                          id:id
                          },
                   success: function (data) {
                      
                    
                      var result = data.msg.split("|");
                      var data = data.data;  
                      if (result[0] === "Success") {
                          toastr.success(result[0], result[1]);
                          $('#add-trans').modal('hide');
                          location.reload();
                       }else{
                          toastr.error(result[0], result[1]);
                       }
                   }
                    
               });
            }else{
                toastr["warning"]("Nothing Added");
            }
            imageOverlay('#st_trans', 'hide');
    }
 
    function storeFeeTblValues(){
        var TableData = new Array();
        $('#tablestudent tr').each(function (row, tr) {
            TableData[row] = {
                "reg_id": $(tr).find('td:eq(0)').text()
                ,"status": $(tr).find('td:eq(3)>select option:selected').val()
            }
        });
        TableData.shift();  // first row will be empty - so remove
        return TableData;
    }  
    
     function delete_record(id) {
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
                        url: "<?php echo $this->Url->build(['controller' => 'RoomMaster', 'action' => 'delete']); ?>",
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {id: id},
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
            }
           swal(
            'Deleted!',
            'Record has been deleted.',
            'success'
           
          )
        
        });
    }
    
    
 
</script>