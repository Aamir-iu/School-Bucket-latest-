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
              <h3 class="box-title">Read Message</h3>

             
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                  <h5>From: <?php echo $complain['registration_id']; ?> - <?php echo $complain->registration['student_name']; ?>
                  <span class="mailbox-read-time pull-right"><?php echo date('D-d-M-Y h:i A', strtotime($complain['comp_date'])); ?></span></h5>
              </div>
             
              <div class="mailbox-read-message">
                <strong>Respected sir/madam,</strong>
                
                <p>
                    <?php echo $complain['complain']; ?>.
                    
                </p>

               
               

                
              </div>
              <!-- /.mailbox-read-message -->
            </div>
           
            <div class="box-footer">
              <div class="pull-right">
                <?= $this->Html->link(__('<i class="fa fa-reply"></i> Reply'), ['action' => 'add', $complain['registration_id']], ['class' => 'btn btn-icon waves-effect waves-light btn-default m-b-5', 'escape' => false]) ?>
              </div>
                <button type="button" onclick='deleteMessage("<?php echo $complain['id_complain']; ?>")' class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button>
              
            </div>
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
    
 
 
    function deleteMessage(id) {
        
    swal({
        title: 'Are you sure?',
        text: "you want to delete!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then(function (result) {
       if (result) {   
       
        window.location.assign("<?php echo $this->Url->build(['controller' => 'Complains','action' => 'delete']); ?>/" + id);
        
        }
        swal(
         'Deleted!',
         'Message has been deleted.',
         'success'

       )
        
       });  
        
    }
 
</script>