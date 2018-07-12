<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Collection Summery</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                      
                          <div class="col-md-6 col-md-offset-3">

                            <div class="panel panel-primary">
                                <div class="panel-heading">Action</div>
                                <div class="panel-body">
                                    <div  class="col-md-12">
                                        
                                        <div class="form-group">
                                            <label>Select Fee Head</label>
                                            <select class="form-control" id="feehead"  data-placeholder="Select Fee Head">
                                                <?php foreach ($feetype as $feetypes): ?>    
                                                    <option value="<?php echo $feetypes->id_fee_type; ?>"><?php echo $feetypes->fee_type_name; ?></option>
                                                <?php endforeach; ?>    
                                            </select>
                                        </div>
                                        
                                        
                                      
                                        <div class="form-group">
                                            <label>Select Class</label>
                                            <select class="form-control" id="class_id"  data-placeholder="Select Class">
                                                <option value="select">All</option>
                                                <?php foreach ($class_name as $class_name): ?>    
                                                    <option value="<?php echo $class_name->id_class; ?>"><?php echo $class_name->class_name; ?></option>
                                                <?php endforeach; ?>    
                                            </select>
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Select Fee Month</label>
                                            <select class="form-control" id="month_id"  data-placeholder="Select Month">
                                                <?php foreach ($months as $months): ?>    
                                                    <option value="<?php echo $months->id_month; ?>"><?php echo $months->month_name; ?></option>
                                                <?php endforeach; ?>    
                                            </select>
                                        </div>
                                        
                                         <!-- Date range -->
                                        <div class="form-group pull-right">
                                           <?= $this->Html->link(__('<i class="fa fa-print"></i> Print'), ['#' => '#'], ['onclick'=>"collection_summery();",'class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 'escape' => false]) ?>
                                           
                                        </div>
                                        <!-- /.form group -->
                                       
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

    $(document).ready(function () {
        $("#month_id").select2();
        $("#feehead").select2();
        $("#class_id").select2();
        
    });

    
    function collection_summery(){
        
        var class_id = $('#class_id option:selected').val();
        var feehead = $('#feehead option:selected').val();
        var feehead_name = $('#feehead option:selected').text();
        
        var month_id = $('#month_id option:selected').val();
        
        var month = $('#month_id option:selected').text();
        
        var flag = '3';
        
        
        window.open("<?php echo $this->Url->build(['controller' => 'Reports', 'action' => 'view']); ?>/" +  flag + "/" + class_id + "/" + feehead + "/" + month_id + "/" + feehead_name + "/" + month);
    
    }  
    
    function daily_collection(){
        var shift_id = $('#shift_id').val();
        var shift = $('#shift_id').text();
        var flag = '2';
        window.open("<?php echo $this->Url->build(['controller' => 'Reports', 'action' => 'view']); ?>/" +  flag + "/" + shift_id + "/" + shift );
    
    }  
    

</script>   