<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
             
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
                   <th width="45%">Main Account Name</th>
                    <th width="40%">Actions</th>
                  
                </tr>
                </thead>
                <tbody>
                <?php foreach ($mainAccount as $mainAccount): ?>
                <tr>
                        <td id="id<?= $this->Number->format($mainAccount->id_main_account) ?>"><?= $this->Number->format($mainAccount->id_main_account) ?></td>
                        <td><?= h($mainAccount->main_account_number) ?></td>
                        <td id="accountname<?= $this->Number->format($mainAccount->id_main_account) ?>"><?= h($mainAccount->main_account_name) ?></td>
                    
                    <td class="actions">
                        
                        <?= $this->Html->link(__('<i class="fa fa-search"></i> Control Account'), ['controller' => 'ControlAccount', 'action' => 'index', $mainAccount->id_main_account], ['class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 'escape' => false]) ?>
                        <a  href="#" onclick="loadmodal(<?= $this->Number->format($mainAccount->id_main_account) ?>);"  class="btn btn-icon waves-effect waves-light btn-warning m-b-5"><i class="fa fa-pencil"></i> Edit </a>
                        <a  href="#" onclick="delete_account(<?= $this->Number->format($mainAccount->id_main_account) ?>);"  class="btn btn-icon waves-effect waves-light btn-danger m-b-5"><i class="fa fa-trash"></i> Delete </a>
                        

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
    
 <!-- BEGIN SUPPLIER PRODUCTS MODAL FORM-->
<div class="modal fade" id="add-account" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Create New Main Control Account </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">

                    <div class="form-group">
                        <label class="control-label col-md-3">Main Account Name <span class="required" aria-required="true">*</span></label>
                        <div class="col-md-9">
                            <input id="account_name" type="text"   required placeholder="Account Name" class="form-control" value=""/>
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
                <h4 class="modal-title">Edit Main Control Account </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">



                    <div class="form-group">
                        <label class="control-label col-md-3">Main Control Account Name <span class="required" aria-required="true">*</span></label>
                        <div class="col-md-9">
                            <input id="mainacccount" type="text"   required placeholder="Account Name" class="form-control" value=""/>
                            <input id="subid" type="hidden"     required placeholder="Account Name" class="form-control" value=""/>
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
  
  
   function createaccount() {

        var ac_name = $("#account_name").val();
        if (ac_name.length > 0) {
            toastr["info"]("Inserting", "New Main Account");
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'MainAccount', 'action' => 'add']); ?>",
                dataType: 'json',
                data: {ac_name: ac_name},
                success: function (data) {
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
        } else {
            toastr.warning('Please Enter Account Name');

        }
    }


    function editaccount() {


        var acc_id = $("#subid").val();
        var ac_name = $("#mainacccount").val();

        if (ac_name.length > 0) {
            toastr["info"]("Updating", "Main Control Account ");
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'MainAccount', 'action' => 'edit']); ?>",
                dataType: 'json',
                data: {acc_id: acc_id, ac_name: ac_name},
                success: function (data) {
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
        } else {
            toastr.warning('Please Enter Account Name');
        }
    }


    function loadmodal(id) {
    
        $('#subid').val(id);
        $('#mainacccount').val($('#accountname' + id).text());

        $('#add-sub_account').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
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
                        url: "<?php echo $this->Url->build(['controller' => 'MainAccount', 'action' => 'delete']); ?>",
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