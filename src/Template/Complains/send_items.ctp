<?php
    
    function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

?>
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
            
<!--          <a href="compose.html" class="btn btn-primary btn-block margin-bottom">Compose</a>-->
          <?= $this->Html->link(__('Compose'), ['action' => 'add'], ['class' => 'btn btn-primary btn-block margin-bottom', 'escape' => false]) ?>
          

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
<!--                <span class="label label-primary pull-right"><?php //if($unread){ //echo $unread; } ?></span></li>-->
               <li class="active"><?= $this->Html->link(__('<i class="fa fa-envelope-o"></i> Sent '), ['action' => 'sendItems'], ['class' => '', 'escape' => false]) ?>
                
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
              <h3 class="box-title">Inbox</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Search Mail">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  10/10
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped" id="inbextable">
                  <tbody>
                <?php foreach ($sentitems as $sentitems): ?>      
                  <tr>
                    <td><input type="checkbox"></td>
                  
                    <td class="mailbox-star"><a href="#"><i class="fa fa-send text-yellow"></i></a></td>
                    <td class="mailbox-name"><?= $this->Html->link(__(h($sentitems->registration_id ).' - '.h($sentitems->registration['student_name'])), ['#' => '#']) ?></td>
                    
                    <td class="mailbox-subject"><?= h($sentitems->mobile_notification['notification']) ?></td>
                    <td class="mailbox-attachment"></td>
                    <td class="mailbox-date"><?= time_elapsed_string($sentitems->mobile_notification['created_on']) ?></td>
                  </tr>
                  
                <?php endforeach; ?> 
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  10/10
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
            </div>
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