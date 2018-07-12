<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Import Student's Data</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="panel panel-primary">
                                <div class="panel-heading">Import</div>
                                <div class="panel-body">
                                    <div  class="col-md-12">
                                        
          

                                 
                                        
                                        <div class="box-footer">
                                            <?= $this->Html->link(__('<i class="fa fa-database"></i> Import Students Record File'), ['Controller'=>'Tools','action' => 'studentsrecord'], ['class' => 'btn btn-icon waves-effect waves-light btn-warning m-b-5', 'escape' => false]) ?>
                                            <?= $this->Html->link(__('<i class="fa fa-database"></i> Import Students Paid Fees Record File'), ['action' => 'feerecord'], ['class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 'escape' => false]) ?>
                                            <?= $this->Html->link(__('<i class="fa fa-database"></i> Import Students Dues Record File'), ['action' => 'adddues'], ['class' => 'btn btn-icon waves-effect waves-light btn-info m-b-5', 'escape' => false]) ?>
                                            <?= $this->Html->link(__('<i class="fa fa-database"></i> Import Students Attendance Record File'), ['action' => 'attendance'], ['class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                                       </div>
                                                                            
                                    </div>
 
                                </div>
                            </div>
                        </div>
                         
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

</section>
<!-- /.content -->

<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>          
<script>
 
    
</script>   