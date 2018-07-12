<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <span class="caption-subject font-teal-500 bold uppercase">
                        <?php $main_account = $main_account[0]; ?>
                        <?php $controll_account = $control_account[0]; ?>
                        <?php $sub_account_info = $sub_control_account[0]; ?>

                        <span><?php echo "<span>" . $main_account->main_account_number . "-" . $controll_account->control_account_number . "</span>"; ?>-<?php echo "<span id='transaction_id'>" . $sub_account_info->sub_control_account_number . "</span>"; ?>  |  </span>
                        <span> <?php echo "<span>(" . $main_account->main_account_name . ") - (" . $controll_account->control_account_name . "</span>"; ?>) - (<?php echo "<span>" . $sub_account_info->sub_control_account_name . "</span>"; ?>)</span>

                        <span id="sub_account_id" style="display:none;"><?php echo $sub_account_info->id_sub_control_account ?></span>
                    </span>
                    <div class="btn-group pull-right">
                        <div class="actions" style="margin-bottom: 28px;">
                            <a  href="#add-account" data-toggle="modal" data-original-title="Add Products" title="Add Products" class="btn btn-block btn-success">
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
                                <th width="5%">
                                    ID
                                </th>
                                <th width="15%">
                                    Transaction AC#
                                </th>
                                <th width="15%">
                                    Account Name
                                </th>                                               
                                <th width="25%">
                                    Created On
                                </th>
                                <th width="15%">
                                    Created By
                                </th>

                                <th width="45%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                              <?php foreach ($transactionAccount as $transactionAccount): ?>
                                <tr>

                                    <td id="id<?= $this->Number->format($transactionAccount->id_transaction_account) ?>"><?= $this->Number->format($transactionAccount->id_transaction_account) ?></td>
                                    <td id="acno<?= $this->Number->format($transactionAccount->id_transaction_account) ?>"><?= h($transactionAccount->transaction_account_number) ?></td>
                                    <td id="acname<?= $this->Number->format($transactionAccount->id_transaction_account) ?>"><?= h($transactionAccount->transaction_account_name) ?></td>
                                    <td><?= h($transactionAccount->transaction_account_date) ?></td>  
                                    <td><?= h($transactionAccount->created_by) ?></td>

                                    <td class="actions">

                                        <a  href="#" onclick="loadmodal(<?= $this->Number->format($transactionAccount->id_transaction_account) ?>);"  class="btn btn-icon waves-effect waves-light btn-warning m-b-5"><i class="fa fa-pencil"></i> Edit </a>
                                        <a  href="#" onclick="delete_account(<?= $this->Number->format($transactionAccount->id_transaction_account) ?>);"  class="btn btn-icon waves-effect waves-light btn-danger m-b-5"><i class="fa fa-trash"></i> Delete </a>
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


<!-- BEGIN ADD SUB ACCOUNT MODAL FORM-->
<div class="modal fade" id="add-account" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Create New Transaction Account </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                   
                
                    <div class="form-group">
                        <label class="control-label col-md-3">Transaction Account Name <span class="required" aria-required="true">*</span></label>
                        <div class="col-md-9">
                            <input id="transaccountname" type="text"   required placeholder="Account Name" class="form-control" value=""/>
                            
                        </div>
                    </div>
                    
                    
                    
                </form>
            </div>
            <div class="modal-footer">
                <button onclick="createaccount();" type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Save</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- BEGIN EDIT SUB ACCOUNT MODAL FORM-->
<div class="modal fade" id="add-sub_account" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Edit  Transaction Account </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    
                     <div class="form-group">
                        
                        <div class="col-md-9">
                            <input id="subaccountno" type="hidden"   required placeholder="Account Number" class="form-control" value=""/>
                            <input id="subid"  type="hidden"/>
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label class="control-label col-md-3">Transaction Account Name <span class="required" aria-required="true">*</span></label>
                        <div class="col-md-9">
                            <input id="subaccountname2" type="text"   required placeholder="Account Number" class="form-control" value=""/>
                            
                        </div>
                    </div>
                    
                
                </form>
            </div>
            <div class="modal-footer">
                <button onclick="editaccount();" type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Save</button>
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

<?= $this->Html->script('datatable.js') ?>  
<script>
    $(function () {
        $("#userstable").DataTable();

    });


   function createaccount(){
           
            var Trans_ID = $("#sub_account_id").html();
            var trans_acc_name = $("#transaccountname").val();
            
            if(trans_acc_name.length > 0){
                toastr["info"]("Inserting", "New Transanction Account");
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller'=> 'TransactionAccount', 'action' => 'add']); ?>",
                        dataType:'json',
                        data: {transaction_ID:Trans_ID,trans_acc_name:trans_acc_name},
                        success: function(data) {
                           var result = data.msg.split("|");
                            if (result[0] === "Success") {
                                toastr.success(result[0], result[1]);
                                $('#add-account').modal('hide');
                                location.reload();
                            } else {
                                toastr.error(result[0], result[1]);
                            }
                        }
                    });
                }else{
                     toastr.warning('Account Name must be Enter');                        
                   }   
    }
  function editaccount(){
            var sub_acc_No = $("#subaccountno").val();
            var sub_acc_id = $("#transaction_id").val();
            var sub_acc_name = $("#subaccountname2").val();
            
            if(sub_acc_No.length == 4){
                toastr["info"]("Updating", "Transanction Account #" + sub_acc_No );
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller'=> 'TransactionAccount', 'action' => 'edit']); ?>",
                        dataType:'json',
                        data: {sub_acc_id: sub_acc_id,controlaccountid:sub_acc_No,sub_acc_name:sub_acc_name},
                        success: function(data) {
                            var result = data.msg.split("|");
                            if (result[0] === "Success") {
                                toastr.success(result[0], result[1]);
                                $('#add-account').modal('hide');
                                location.reload();
                            } else {
                                toastr.error(result[0], result[1]);
                            }
                        }
                    });
                }else{
                     toastr.warning('Account Number must be 3 digits');                        
                   }   
    }
                   
     
  function loadmodal(id){
    console.log(id);
    $('#transaction_id').val(id);
    $('#subaccountno').val($('#acno'+id).text());
    $('#subaccountname2').val($('#acname'+id).text());
  
    $('#add-sub_account').modal({
            backdrop:'static',
            keyboard:false,
            show:true
        });
    } 
  
  
  function goBack() {
    window.history.back();
  }  
  
  function delete_account(id) {

        swal({
            title: "Warning?",
            text: "Are you sure you want to delete this account !",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function (result) {
            if (result == true) {
                if (id > 0) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'TransactionAccount', 'action' => 'delete']); ?>",
                        dataType: 'json',
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
                    //swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });

    }
    




</script>