<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
          
                
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             
                 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'btn btn-primary btn-block margin-bottom', 'escape' => false]) ?>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><?= $this->Html->link(__('<i class="fa fa-inbox"></i> Inbox <span class="label label-danger pull-right">'. $unread .'</span>'), ['action' => 'index'], ['class' => '', 'escape' => false],'<span class="label label-primary pull-right">12</span>') ?>
<!--                <span class="label label-primary pull-right">12</span></a></li>-->
               <li><?= $this->Html->link(__('<i class="fa fa-envelope-o"></i> Sent '), ['action' => 'sendItems'], ['class' => '', 'escape' => false]) ?>
                
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
         
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Compose New Message</h3>
            </div>
            <!-- /.box-header -->
            <?= $this->Form->create($complain,array('type'=>'file')) ?>
            <div class="box-body">
              <div class="form-group">
                  <input type="text" class="form-control" required name="to" placeholder="To:  Like 100,101,102" value="<?php echo $id === 0 ? '' : $id; ?>">
              </div>
              <div class="form-group">
                  <input class="form-control" required name="subject" placeholder="Subject:">
              </div>
              <div class="form-group">
                  <textarea id="compose-textarea" required name="notification" class="form-control" style="height: 200px"></textarea>
              </div>
             
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                
                <?= $this->Form->button(__('<i class="fa fa-envelope"></i> Send'), [ 'class' => 'btn btn-success pull-right', 'escape' => false]) ?>
              </div>
              
            </div>
        <?= $this->Form->end() ?>       
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
                
                
                
                
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
    
 
 
</script>