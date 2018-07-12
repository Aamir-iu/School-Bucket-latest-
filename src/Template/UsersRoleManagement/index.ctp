<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
             
            <div class="table-container">  
            <table class="table table-striped table-bordered table-hover" id="datatable_user">
                <thead>
                    <tr role="row" class="heading">
                        <th width="15%">
                            User_Role_ID
                        </th>
                        <th width="35%">
                            User_Role
                        </th>

                        <th width="50%">Actions</th>

                    </tr>
                </thead>

                <?php foreach ($roles as $usersRoleManagement): ?>
                    <tr>
                        
                        <td><?= $this->Number->format($usersRoleManagement->id_roles) ?></td>
                        <td><?= h($usersRoleManagement->role) ?></td>

                        <td class="actions">
                           <?= $this->Html->link(__('<i class="fa fa-cog"></i> Permission'), ['action' => 'setRoles', $usersRoleManagement->id_roles], ['class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 'escape' => false]) ?>
                        </td>
                        

                    </tr>
                 <?php endforeach; ?>
                <tbody>
               </tbody>
            </table>
        </div>   
                
            </div>
            <!-- /.box-header -->
          
            
          
            
            
            
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    
    
    
    <!--Add type Modal start-->
<div class="modal fade" id="add-roles"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add New Role</h4>
            </div>
            <div class="modal-body">
                
                <form class="form-horizontal">
                    
                    <div class="form-group">
                        <label for="lab_test_type" class="control-label col-md-3">Select Role <span class="required" aria-required="true">*</span></label>
                        <div class="col-md-9">
                            
                            <select class="form-control" name="role_id" id="role_id">
                            <?php foreach($roles as $row){ ?>
                            <option  value="<?php echo $row->id_roles; ?>"><?php echo $row->role; ?></option>
                            <?php } ?>
                            </select>
                            
                        </div>
                    </div>
                    

                </form>
            </div>
            <div class="modal-footer">
                <button onclick="saveUserRoles();" type="button" class="btn blue btn-save">Save</button>
                <button type="button" class="btn blue btn-spin hidden"><i class="fa fa-spin fa-spinner"></i></button>
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--Add type Modal end-->
    
    
    
    
    
  <?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
  <?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
  <?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>

<?= $this->Html->script('datatable.js') ?>

<script>
   $(function () {
    $("#datatable_user").DataTable();
    
  });

    function addRoles() {
        $('#add-roles').modal('show');
    }
    
    function saveUserRoles(){
            var roles = $("#role_id option:selected").val();
            if(roles.length > 0){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller'=> 'UsersRoleManagement', 'action' => 'add']); ?>",
                        dataType:'json',
                        data: {role_id:roles},
                        success: function(data) {
                           var result = data.msg.split("|");
                            if (result[0] === "Success") {
                                toastr.success(result[0], result[1]);
                                $('#add-roles').modal('hide');
                                location.reload();
                            } else {
                                toastr.error(result[0], result[1]);
                            }
                        }
                    });
                }else{
                     toastr.warning('Error');                        
                   }   
    }
    
    

</script>