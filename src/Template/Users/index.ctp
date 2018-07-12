<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
             
           <div class="btn-group pull-right">
                  <button type="button" class="btn btn-success">Action</button>
                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li> <?= $this->Html->link(__('Create New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
                  </ul>
           </div>
                
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="userstable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="width:10%;">Image</th>
                  <th>Full Name</th>
                  <th>Phone</th>
                  <th>Address</th>
                   <th style="width:30%;">Action</th>
                  
                </tr>
                </thead>
                <tbody>
                     <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $this->Html->image('users_images/'.$user->image, ['alt' => 'user Picture', 'class' => 'img-circle','style'=>'width:20px;']); ?></td>
                    <td><?= h($user->full_name) ?></td>
                    <td><?= h($user->phone1) ?></td>
                    <td><?= h($user->address) ?></td>
                    
                     <td class="actions">
                           <?= $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'edit', $user->id], ['class' => 'btn btn-icon waves-effect waves-light btn-warning m-b-5', 'escape' => false]) ?>
                           <?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                           <?= $this->Html->link(__('<i class="fa fa-cog"></i> Change Password'), ['action' => 'resetpassword', $user->id], ['class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 'escape' => false]) ?>
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
  <?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
  <?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
  <?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
<script>
  $(function () {
    $("#userstable").DataTable();
    
  });
</script>