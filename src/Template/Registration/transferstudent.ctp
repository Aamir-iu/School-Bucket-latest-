           
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
                <div class="box-body">
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover" id="userstable">    
                            <thead>
                                <tr>
                                    <th>Registration ID</th>
                                    <th>Name of Student</th>
                                    <th>Father's Name</th>
                                    <th style="width:20%;"><input type="checkbox" id="mycheck"  class="minimal-red" unchecked> &nbsp;&nbsp; In-Active All </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                           
                        </table>
                        
                         
                               
                        <div class="pull-right" style="display:none" id="footer_id">
                            <button class="btn btn-sm btn-warning" onclick="loadmodal();" name="btntransfer" id="btntransfer" type="button"><i class="fa fa-angle-double-up" style="height: 18px;"></i> Click here </button>
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
<!-- BEGIN TRANS MODAL FORM-->
<div class="modal fade" id="add-trans"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" style="width:50%!important;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"> Class  | Shift | Session</h4>
            </div>
            <div class="modal-body" id="st_trans">
                <form class="form-horizontal">

                        <div class="col-xs-4">
                            <select name="class_id2" id="class_id2" class="form-control input-sm" style="width: 200px;">
                                <?php foreach($classes2 as $classes):  ?>
                                    <option  value="<?php echo $classes->id_class; ?>"><?php echo $classes->class_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    
                    
                   
                        <div class="col-xs-4">
                             <select name="shift_id2" id="shift_id2" class="form-control input-sm" style="width: 200px;">
                                <option value="1">Morning</option>
                                <option value="2">Afternoon</option>
                                <option value="3">Evening</option>
                            </select>
                        </div>
                    
                        <div class="col-xs-4">
                           <select name="session_id2" id="session_id2" class="form-control input-sm" style="width: 200px;">
                                <?php foreach($session2 as $session):  ?>
                                    <option  value="<?php echo $session->id_session; ?>"><?php echo $session->session; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                </form>
            </div>
            <br />
            <div class="modal-footer">
                <button onclick="trans();" type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Run</button>
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

<?php // $this->Html->script('datatable.js')  ?> 

<script>

    $(document).ready(function () {
        
        $('#mycheck').on('click',function(){
            if(this.checked==true){
               $('.chk option:selected').val('N').change();
               $('.chk option:selected').text('Inactive').change();
               $('.chk').attr('disabled','disabled');
            }else{
               $('.chk option:selected').val('T').change();
               $('.chk option:selected').text('Transfer').change();
               $('.chk').removeAttr("disabled");
            }
        });
        
        
        $("#class_id").select2();
        $("#shift_id").select2();
        $("#session_id").select2();
         $("#class_id2").select2();
        //$("#searchform").DataTable();
        
        $('#searchform').on('submit', function(){
             //  $('#searchform #btnSearch').html('<i class="fa fa-spin fa-spinner"></i> Please wait...');
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
                      $('#userstable tbody').html('');
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
                                mhtml += "<td><select class='form-control chk' style='height:30px;' id='attendace_status' name='attendace_status'><option value='T'>Transfer</option><option value='NO'>Not Transfer</option><option value='N'>Inactive</option></select></td>";
                              mhtml += '</tr>';
                          });
                          $('#userstable tbody').append(mhtml);
                          $('#footer_id').show();
                       }else{
                          toastr.error(result[0], result[1]);
                       }
                       //$('#searchform #btnSearch').html('<i class="fa fa-search"></i>');
                   }
                    
               });
              
           return false;
          });
    
    });

    function loadmodal() {
        $('#add-trans').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }
   
    function trans(){
              
               var shift_id = $('#shift_id2 option:selected').val();
               var session_id = $('#session_id2 option:selected').val();
               var class_id = $('#class_id2 option:selected').val();
               var TableData;
               TableData = storeFeeTblValues()
               
            if (TableData.length > 0) {
                imageOverlay('#st_trans', 'show');
               $.ajax({
                   type: "POST",
                   url: "<?php echo $this->Url->build(['controller' => 'Registration', 'action' => 'transferstudents']); ?>",
                   dataType: 'json',
                   cache: false,
                   async: false,
                   data: {details: TableData,class_id : class_id,
                          shift_id : shift_id,
                          session_id : session_id,
                          },
                   success: function (data) {
                      imageOverlay('#st_trans', 'hide');
                    
                      var result = data.msg.split("|");
                      var data = data.data;  
                      if (result[0] === "Success") {
                          toastr.success(result[0], result[1]);
                          $('#add-trans').modal('hide');
                          location.reload();
                       }else{
                          toastr.error(result[0], result[1]);
                       }
                       //$('#searchform #btnSearch').html('<i class="fa fa-search"></i>');
                   }
                    
               });
            }else{
                toastr["warning"]("Nothing Added");
            }
         }
         
    function storeFeeTblValues(){
        var TableData = new Array();
        $('#userstable tr').each(function (row, tr) {
            TableData[row] = {
                "reg_id": $(tr).find('td:eq(0)').text()
                ,"status": $(tr).find('td:eq(3)>select option:selected').val()
            }
        });
        TableData.shift();  // first row will be empty - so remove
        return TableData;
    }
    
   
   

</script>

