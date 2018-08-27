<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">

                    <h3 class="box-title">Holidays</h3>
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
                                <th width="10%">ID#</th>
                                <th width="20%">Holiday Date</th>
                                <th width="20%">Off Type</th>
                                <th width="20%">Description</th>
                                
                                <th width="20%">Actions</th
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($holidays as $holiday): ?>
                                <tr>

                                    <td><?= $holiday->holiday_id ?></td>
                                    <td><?= h($holiday->offDate) ?></td>
                                    <td><?= h($holiday->oType) ?></td>
                                    <td><?= h($holiday->description) ?></td>
                                    
                                    <td>
                                    <?= $this->Html->link(__('<i class="fa fa-trash"></i> Delete'), ['#' => '#'], ['onclick' => "delete_holiday($holiday->holiday_id);", 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ; ?>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <div class="box-header">
                    <strong>Holidays </strong>
               </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <strong>Start Date</strong>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text"  placeholder="Date" name="startdate" value="<?= date("m/d/Y");  ?>" class="form-control pull-right" id="datepicker">
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <strong>End Date</strong>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text"  placeholder="Date" name="enddate" value="<?= date("m/d/Y");  ?>" class="form-control pull-right" id="datepicker2">
                                </div>
                        </div>
                    </div>

                    
                    <div class="col-sm-4">
                        <div class="form-group">
                            <strong>Off Type</strong>
                            <select class="form-control" name="off_type" id="off_type">
                        
                            <option value="W">Weekend</option>
                            <option value="EH">Exam Holiday</option>
                            <option value="NH">National Holiday</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <input type="text"  placeholder="Description" class="form-control" id="description">
                        </div>
                    </div>
                    
                    
                    
                    
               </div>
                
            </div>
            
            <div class="modal-footer">
                <button onclick="add_holiday();"  readonly type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5"><i class="fa fa-plus"></i>Add</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>





<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>  
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
<?= $this->Html->script('datatable.js') ?>  
<script>
    $(document).ready(function () {
        //$("#transactionaccountid").select2();

    });

    $(function () {
        $("#userstable").DataTable();

    });
     $('#datepicker').datepicker({
      autoclose: true
    });
     $('#datepicker2').datepicker({
      autoclose: true
    });
    function loadmodal() {

        $('#add-fee').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }
    
        
    function add_holiday(){
      
        var start_date = $('#datepicker').val();
        var end_date = $('#datepicker2').val();
        var off_type = $('#off_type option:selected').val();
        var description = $('#description').val();
        
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller'=> 'Holiday', 'action' => 'add']); ?>",
                dataType:'json',
                data: {start_date:start_date,end_date:end_date,off_type:off_type,description:description},
                success: function(data) {
                    var result = data.msg.split("|");
                    if (result[0] === "Success") {
                        toastr.success(result[0], result[1]);
                        $('#add-po-details').modal('hide');
                        //location.reload();
                    } else {
                        toastr.warning(result[0], result[1]);                        
                    }
                }
            });
        
    } 
        
   
        
   function delete_holiday(id) {

       swal({
            title: 'Are you sure?',
            text: "Are sure you want to delete!",
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
                        url: "<?php echo $this->Url->build(['controller' => 'Holiday', 'action' => 'delete']); ?>",
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {id: id},
                        success: function (data) {
                            var result = data.msg.split("|");
                            if (result[0] === "Success") {
                                toastr.success(result[0], result[1]);
                                remove(id);
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
