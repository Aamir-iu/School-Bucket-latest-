<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<?= $this->Html->css('../plugins/daterangepicker/daterangepicker.css') ?>  

<!-- Main content -->
<section class="content">
    
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                
       <div class="row" style="margin-right:10px;margin-top: 20px;text-align: right;">
        <?= $this->Form->create('ClassSchedule',['class'=>'form-inline'], array('type' => 'file', 'url' => array('controller' => 'Fees', 'action' => 'cancelInvoices', 'id' => 'forget-form'))); ?>      
            <div class="form-group">

                    <select class="form-control" id="user_id" name="user_id"  style="width: 100%;">
                        <option  value="all">All Users</option>
                        <?php foreach ($user as $row): ?>
                            <option <?= $id == $row['id'] ? 'selected' : '' ?>  value="<?php echo $row['id']; ?>"><?php echo $row['full_name']; ?></option>
                        <?php endforeach; ?> 
                    </select>
               
            </div>
        <?=  $this->Form->button(__('<i class="fa fa-search"></i> Search'), [ 'class' => 'btn btn-success', 'escape' => false]) ?>
        <?=  $this->Html->link(__('<i class="fa fa-print"></i> Print'), ['#' => '#'], ['onclick'=>"print_log();",'class' => 'btn btn-icon waves-effect waves-light btn-warning m-b-5', 'escape' => false]) ?>
        <?= $this->Form->end() ?>   
      
       
         
     </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="userstable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <tr role="row" class="heading">
                                <th style="width:10%;">Invoice#</th>
                                <th width="10%">Amount</th>
                                <th width="15%">Cancelled By</th>
                                <th width="65%">Remarks</th>
                                
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach($data as $row): ?>
                            <tr>
                                <td><?= $row['inv_no']; ?></td>
                                <td><?= $row['amount']; ?></td>
                                <?php $temp = explode(':',$row['remarks']); ?>
                                <td><?= $temp[1]; ?></td>
                                <td><?= str_replace('Cancelled By','', $temp[0]); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>


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
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>    
 <?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 

<?= $this->Html->script('datatable.js') ?>  
<script>

    
     
    $(function () {
        $("#userstable").DataTable();

    });
   
   
   function print_log() {
       var id = $('#user_id option:selected').val();
        var  flag = 5; 
        window.open("<?php echo $this->Url->build(['controller' => 'Fees', 'action' => 'view']); ?>/" + flag + "/" + id);
    }
    
</script>
