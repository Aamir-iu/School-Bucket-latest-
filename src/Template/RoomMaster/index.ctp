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
                    <li> <?= $this->Html->link(__('Add New'), ['controller' => 'RoomMaster', 'action' => 'add']) ?></li>
                  </ul>
           </div>
                
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="userstable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    
                    <th style="width:10%;">ID #</th>
                    <th style="width:20%;">Room/Hall Name</th>
                    <th style="width:30%;">Desc</th>
                    <th style="width:20%;">Created on</th>
                    <th class="actions"><?= __('Actions') ?></th>
                  
                </tr>
                </thead>
                <tbody>
               <?php foreach ($roomMaster as $roomMaster): ?>
                <tr>
                      
                    <td><?= $this->Number->format($roomMaster->id_room_master) ?></td>
                    <td><?= h($roomMaster->room_name) ?></td>
                    <td><?= h($roomMaster->room_desc) ?></td>
                    <td><?= date('d-m-Y',strtotime($roomMaster->rom_date)); ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'edit', $roomMaster->id_room_master], ['class' => 'btn btn-icon waves-effect waves-light btn-warning m-b-5', 'escape' => false]) ?>
                        <?= $this->Html->link(__('<i class="fa fa-users"></i> Add Students'), ['action' => 'addStudents', $roomMaster->id_room_master], ['class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 'escape' => false]) ?>
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