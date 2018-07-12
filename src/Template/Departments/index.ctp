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
                    <li> <?= $this->Html->link(__('Add New Department'), ['controller' => 'Departments', 'action' => 'add']) ?></li>
                  </ul>
           </div>
                
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="userstable" class="table table-bordered table-striped">
                <thead>
                <tr>
                   
                    <th style="width:30%;">Department Name</th>
                    <th style="width:20%;">Created On</th>
                    <th style="width:20%;">Created By</th>
                    <th class="actions"><?= __('Actions') ?></th>
                  
                </tr>
                </thead>
                <tbody>
               <?php foreach ($departments as $department): ?>
                <tr>
                      
                        <td><?= h($department->department_name) ?></td>
                        <td><?= h($department->department_created_on) ?></td>
                        <td><?= h($department->user['full_name']) ?></td>

                     <td class="actions">
                           <?= $this->Html->link(__('<i class="fa fa-search"></i> Employees'), ['controller'=>'Employees','action' => 'index', $this->Number->format($department->department_id)], ['class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 'escape' => false]) ?>
                           <?= $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'edit', $this->Number->format($department->department_id)], ['class' => 'btn btn-icon waves-effect waves-light btn-warning m-b-5', 'escape' => false]) ?>
                           <?php // $this->Form->postLink(__('<i class="fa fa-trash"></i> Delete'), ['action' => 'delete', $this->Number->format($department->department_id)], ['confirm' => __('Are you sure you want to delete # {0}?', $this->Number->format($department->department_id)), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                         
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
    
  <?= $this->Html->script('datatable.js') ?>  
<script>
  $(function () {
    $("#userstable").DataTable();
    
  });
  
</script>