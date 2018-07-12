<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
             <span class="caption-subject font-teal-500 bold uppercase">
                        <?php  $main_account = $main_account[0]; ?>
                        <?php  $controll_account = $control_account[0]; ?>
                        
                        <span><?php  echo "<span id='cd_id'>".$main_account->main_account_number."-".$controll_account->control_account_number. "</span>"; ?>  |  </span>
                        <span>(<?php  echo "<span>".$main_account->main_account_name.") - (".$controll_account->control_account_name. "</span>"; ?>)  </span>
                        
                        <span id="control_account_id" style="display:none;"><?php  echo $controll_account->id_control_account ?></span>
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
                   <th width="5%">ID</th>
                   <th width="10%">AC.#</th>
                   <th width="45%">Account Name</th>
                    <th width="40%">Actions</th>
                  
                </tr>
                </thead>
                <tbody>
                 <?php foreach ($subControlAccount as $subControlAccount): ?>
                    <tr>
                        <td id="id<?= $this->Number->format($subControlAccount->id_sub_control_account) ?>"><?= $this->Number->format($subControlAccount->id_sub_control_account) ?></td>
                        <td id="acnum<?= $this->Number->format($subControlAccount->id_sub_control_account) ?>"><?= h($subControlAccount->sub_control_account_number) ?></td>
                        <td id="acname<?= $this->Number->format($subControlAccount->id_sub_control_account) ?>"><?= h($subControlAccount->sub_control_account_name) ?></td>


                        <td class="actions">
                            <?= $this->Html->link(__('<i class="fa fa-search"></i>Transaction Account'), ['controller'=> 'TransactionAccount' ,  'action' => 'index', $subControlAccount->id_sub_control_account,'control_account_id'=>$control_account_id,'main_account_id'=>$main_account->id_main_account], ['class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 'escape' => false]) ?>
                            <a  href="#" onclick="loadmodal(<?= $this->Number->format($subControlAccount->id_sub_control_account) ?>);"  class="btn btn-icon waves-effect waves-light btn-warning m-b-5"><i class="fa fa-pencil"></i> Edit </a>
                            <a  href="#" onclick="delete_account(<?= $this->Number->format($subControlAccount->id_sub_control_account) ?>);"  class="btn btn-icon waves-effect waves-light btn-danger m-b-5"><i class="fa fa-trash"></i> Delete </a>
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
                <h4 class="modal-title">Create New Sub Control Account </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    
                  
                    
                    
                
<!--                    <div class="form-group">
                        <label class="control-label col-md-3">Profit and Loss <span class="required" aria-required="true">*</span></label>
                         <div class="col-md-9">
                        <select  name="pnl" id="pnl"   class="table-group-action-input form-control form-filter input-inline input-small input-sm">
                            
                             <option value="0">Select</option>
                            <option value="Revenue">Revenue</option>
                            <option value="Administrative_Expenses">Administrative Expenses</option>
                           <option value="Cost_of_Source">Cost of Source</option>
                            
                        </select>   
                        </div>
                    </div>-->
                    
                    
<!--                     <div class="form-group">
                        <label class="control-label col-md-3">Add / Subtract<span class="required" aria-required="true">*</span></label>
                         <div class="col-md-9">
                        <select  name="add_sub" id="add_sub"   class="table-group-action-input form-control form-filter input-inline input-small input-sm">
                            
                            <option value="0">Select</option>
                            <option value="CorporateRevenue">Corporate Revenue</option>
                            <option value="Cash">Cash</option>
                            <option value="CostofGoods">Cost of Goods</option>
                            <option value="AdminExpenses">Admin Expenses</option>
                            <option value="Financial">Financial</option>
                            
                        </select>   
                        </div>
                    </div>-->
                    
                    
                
                    <div class="form-group">
                        <label class="control-label col-md-3">Sub Account Name <span class="required" aria-required="true">*</span></label>
                        <div class="col-md-9">
                            <input id="subaccountname" type="text" required  placeholder="Account Name" class="form-control" value=""/>
                            
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
                <h4 class="modal-title">Edit Sub Control Account </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    
<!--                    <div class="form-group">
                        <label class="control-label col-md-3">Profit and Loss <span class="required" aria-required="true">*</span></label>
                         <div class="col-md-9">
                        <select  name="pnl" id="pnle"   class="table-group-action-input form-control form-filter input-inline input-small input-sm">
                            
                             <option value="0">Select</option>
                            <option value="CorporateRevenue">Corporate Revenue</option>
                            <option value="Cash">Cash</option>
                            <option value="CostofGoods">Cost of Goods</option>
                            <option value="AdminExpenses">Admin Expenses</option>
                            <option value="Financial">Financial</option>
                            
                        </select>   
                        </div>
                    </div>-->
                    
<!--                     <div class="form-group">
                        <label class="control-label col-md-3">Add / Subtract<span class="required" aria-required="true">*</span></label>
                         <div class="col-md-9">
                        <select  name="add_sub" id="add_sube"   class="table-group-action-input form-control form-filter input-inline input-small input-sm">
                             <option value="0">Select</option>
                            <option value="Add">Add</option>
                            <option value="Subtract">Subtract</option>
                        </select>   
                        </div>
                    </div>-->
                    
                    <div class="form-group">
                        <label class="control-label col-md-3">Sub Account Name <span class="required" aria-required="true">*</span></label>
                        <div class="col-md-9">
                            <input id="subaccountname2" type="text"   required placeholder="Account Number" class="form-control" value=""/>
                            <input id="subid" type="hidden"  class="form-control" value=""/>
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
           
            var CA_ID = $("#control_account_id").html();
            var sub_acc_name = $("#subaccountname").val();
            var addsub = $("#add_sub option:selected").val();
            var pl     = $("#pnl option:selected").val();
            
            
            if(sub_acc_name.length >0){
                toastr["info"]("Inserting", "Sub New Control Account");
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller'=> 'SubControlAccount', 'action' => 'add']); ?>",
                        dataType:'json',
                        data: {controlaccountid:CA_ID,sub_acc_name:sub_acc_name,addsub:addsub,pl:pl},
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
                     toastr.warning('Please Enter Account Name');                        
                   }   
    }
  function editaccount(){
           // var sub_acc_No = $("#subaccountno").val();
            var sub_acc_id = $("#subid").val();
            var sub_acc_name = $("#subaccountname2").val();
            var addsub = $("#add_sube option:selected").val();
            var pl     = $("#pnle option:selected").val();
            
            if(sub_acc_name.length > 0){
                 toastr["info"]("Updating", "Sub Control Account ");
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller'=> 'SubControlAccount', 'action' => 'edit']); ?>",
                        dataType:'json',
                        data: {sub_acc_id: sub_acc_id,sub_acc_name:sub_acc_name,addsub:addsub,pl:pl},
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
     
  function loadmodal(id){
    
    $('#subid').val(id);
    //$('#subaccountno').val($('#acnum'+id).text());
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
            text: "Are you sure you want to delete all related accounts of this !",
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
                        url: "<?php echo $this->Url->build(['controller' => 'SubControlAccount', 'action' => 'delete']); ?>",
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