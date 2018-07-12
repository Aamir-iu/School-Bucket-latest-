<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<?= $this->Html->css('../plugins/daterangepicker/daterangepicker.css') ?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
             
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
                                <th width="10%">ID</th>
                                <th width="50%">Description</th>
                               <th width="20%">Status</th>
                                <th width="20%">Action</th>

                            </tr>
                        </thead>

                        <tbody>
                         <?php foreach ($feeTypes as $feeType): ?>
                            <tr>
                                <td><?= h($feeType->id_fee_type) ?></td>
                                <td><?= h($feeType->fee_type_name) ?></td>
                                 <td><?php  if($feeType->status_active  === 'Y'){ echo  "Yes"; }else{  echo "No"; } ?></td>
                              
                                
                                
                                
                                <td class="actions">
                                    
                              
                                    <?= $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['#' => '#'], ['onclick'=>"delete_dairy($feeType->id_fee_type);",'class' => 'btn btn-icon waves-effect waves-light btn-warning m-b-5', 'escape' => false]) ?>
                                
                                    
                                 
                                </td>
                            </tr>
                            <?php endforeach; ?>

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
<div class="modal fade" id="add-fee"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">

                    <div class="col-xs-12">        
                        <!-- quick email widget -->
                        <div class="box box-info">
                            <div class="box-header">
                                <i class="fa fa-dollar"></i>

                                <h3 class="box-title">Add New Fee Type</h3>
                                <!-- tools box -->
                                <div class="pull-right box-tools">
                                    <button type="button" class="btn btn-info btn-sm"  data-toggle="tooltip" data-dismiss="modal" title="Close">
                                        <i class="fa fa-times"></i></button>
                                </div>
                                <!-- /. tools -->
                            </div>
                            <div class="box-body">
                                <form action="#" method="post" id="form1">
                                
                                     <div class="form-group">
                                        <label class="control-label col-md-2">Fee Type Name:</label>
                                        <div class="col-md-10">
                                            <input type="text" placeholder="Fee Type Name" required class="form-control" id="fee_type_name" name='fee_type_name' value='' />
                                            <span class="help-block">It's not recommended to use special characters in fee type name </span>
                                        </div>
                                    </div>
                                    
                                     <div class="form-group">
                                        <label class="control-label col-md-2">Status:</label>
                                        <div class="col-md-10">
                                             <select class="form-control" id="status" name="status">
                                           
                                             <option value="Y">Yes</option>
                                             <option value="N">No</option>
                                           

                                            </select>

                                        </div>
                                    </div> 
                        
                                    
                                    
                                </form>
                            </div>
                            
                            <div class="box-footer clearfix">
                                <button type="button" onclick="savefee_type();" class="pull-right btn btn-default" id="sendEmail" data-toggle="tooltip"  title="Save">Save
                                    <i class="fa fa-arrow-circle-right" ></i></button>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<!-- BEGIN EDIT SUB ACCOUNT MODAL FORM-->
<div class="modal fade" id="add-edit"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">

                    <div class="col-xs-12">        
                        <!-- quick email widget -->
                        <div class="box box-info">
                            <div class="box-header">
                                <i class="fa fa-dollar"></i>

                                <h3 class="box-title">Edit Fee Type</h3>
                                <!-- tools box -->
                                <div class="pull-right box-tools">
                                    <button type="button" class="btn btn-info btn-sm"  data-toggle="tooltip" data-dismiss="modal" title="Close">
                                        <i class="fa fa-times"></i></button>
                                </div>
                                <!-- /. tools -->
                            </div>
                            <div class="box-body">
                                <form action="#" method="post" id="form1">
                                    <input type="text" class="hidden"  id="id_type" value="" />
                                    
                                     <div class="form-group">
                                        <label class="control-label col-md-2">Fee Type Name:</label>
                                        <div class="col-md-10">
                                            <input type="text" placeholder="Fee Type Name" required class="form-control" id="fee_type_name_edit" name='fee_type_name_edit' value='' />
                                            <span class="help-block">It's not recommended to use special characters in fee type name </span>
                                        </div>
                                    </div>
                                    
                                     <div class="form-group">
                                        <label class="control-label col-md-2">Status:</label>
                                        <div class="col-md-10">
                                             <select class="form-control" id="status_edit" name="status_edit">
                                                 
                                             <option value="N">No</option>
                                             <option value="Y">Yes</option>
                    
                                            </select>

                                        </div>
                                    </div> 
                        
                                    
                                    
                                </form>
                            </div>
                            
                            <div class="box-footer clearfix">
                                <button type="button" onclick="savefee_edit();" class="pull-right btn btn-default" id="sendEmail" data-toggle="tooltip"  title="Save">Save
                                    <i class="fa fa-arrow-circle-right" ></i></button>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>  
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
<?= $this->Html->script('../plugins/daterangepicker/daterangepicker.js') ?>
<?php // $this->Html->script('datatable.js') ?> 

<script>

   
    $(document).ready(function () {
        $("#userstable").DataTable();
   
    });
    
    
    function loadmodal() {

        $('#add-fee').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }

  
    function savefee_type() {

        var fee_type = $('#fee_type_name').val();
        var status = $('#status').val();
        if(fee_type == ''){
           toastr.error('Fee Type Name Must Be Entered'); 
           return false;
        }
      
        swal({
            title: 'Are you sure?',
            text: "you want to save!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(function (result) {
            imageOverlay('#form1', 'show');
            if (result) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'FeeTypes', 'action' => 'add']); ?>",
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {fee_type_name: fee_type,status:status},
                        success: function (data) {
                            imageOverlay('#form1','hide');
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

        });

    }
    
    function savefee_edit() {

        var fee_type = $('#fee_type_name_edit').val();
        var status = $('#status_edit option:selected').val();
        var id = $('#id_type').val();
        if(fee_type == ''){
           toastr.error('Fee Type Name Must Be Entered'); 
           return false;
        }
      
        swal({
            title: 'Are you sure?',
            text: "you want to save!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(function (result) {
            imageOverlay('#form1', 'show');
            if (result) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'FeeTypes', 'action' => 'edit']); ?>/"+id,
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {fee_type_name:fee_type,status_active:status},
                        success: function (data) {
                            imageOverlay('#form1','hide');
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

        });

    }    
    
    function delete_dairy(id) {
        
         $('#add-edit').modal({
             backdrop: 'static',
             keyboard: false,
             show: true
         });
         
                 if (id > 0) {
                     $.ajax({
                         type: "POST",
                         url: "<?php echo $this->Url->build(['controller' => 'FeeTypes', 'action' => 'fetch']); ?>/"+id,
                         dataType: 'json',
                         cache: false,
                         async: false,
                         data: {id: id},
                         success: function (data) {
                             var result = data.msg.split("|");
                             var mdata = data.feeType;
                             if (result[0] === "Success") {
                                 toastr.success(result[0], result[1]);
                                 $('#fee_type_name_edit').val(mdata['fee_type_name']);
                                 $('#id_type').val(mdata['id_fee_type']);
                                 
                                
                             } else {
                                 toastr.error(result[0], result[1]);
                             }
                         }
                     });
                 }
 
      }
   
    
</script>
