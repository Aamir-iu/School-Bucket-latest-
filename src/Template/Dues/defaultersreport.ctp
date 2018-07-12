<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Defaulters Report</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">

                            <div class="panel panel-primary">
                                <div class="panel-heading">Criteria</div>
                                <div class="panel-body">
                                    <div  class="col-md-12">
                                        
                                        
                                        
                                        <div class="form-group">
                                            <label>Select Class</label>
                                            <select class="form-control" id="class_id"  data-placeholder="Select Class">
                                                 <option value="0">All</option>
                                                <?php foreach ($class as $class): ?>    
                                                    <option value="<?php echo $class->id_class; ?>"><?php echo $class->class_name; ?></option>
                                                <?php endforeach; ?>    
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="shift_id" class="col-sm-2 control-label">Shift</label>
                                                <select  class="form-control" name="shift_id" id="shift_id">
                                                    <option value="0">All</option>
                                                    <option value="1">Morning</option>
                                                    <option value="2">Afternoon</option>
                                                    <option value="3">Evening</option>
                                                </select>
                                        </div> 

                                        <div class="form-group">
                                            <label>No of Months</label>
                                            <select class="form-control" id="nom"  data-placeholder="No of Months">
                                                  
                                                    <option value="1">One Month</option>
                                                    <option value="2">Two Months</option>
                                                    <option value="3">Three Months</option>
                                                    <option value="4">Four Months</option>
                                                    <option value="5">Five Months</option>
                                                    <option value="6">Six Months</option>
                                                    <option value="7">Seven Months</option>
                                                    <option value="8">Eight Months</option>
                                                    <option value="9">Nine Months</option>
                                                    <option value="10">Ten Months</option>
                                                    <option value="11">Eleven Months</option>
                                                    <option value="12">Twelve Months</option>
                                                    
                                                    
                                                       
                                                       
                                              
                                            </select>
                                        </div>
                                        
                                     
                                        
                                        <div class="form-group pull-right">
                                           <?= $this->Html->link(__('<i class="fa fa-building"></i> Class Wise Report'), ['#' => '#'], ['onclick'=>"class_wise();",'class' => 'btn btn-icon waves-effect waves-light btn-info m-b-5', 'escape' => false]) ?>
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

    $(document).ready(function () {
        $("#months").select2();
        $("#nom").select2();
        $("#class_id").select2();
      
    });
    

  $('#from').datepicker({
         autoclose: true
   });
   
  $('#to').datepicker({
         autoclose: true
   }); 
    
    function class_wise(){
        
        var class_id = $('#class_id option:selected').val();
        var shift_id = $('#shift_id option:selected').val();
        
        var class_name = $('#class_id option:selected').text();
        var shift_name = $('#shift_id option:selected').text();
        
        var nom = $('#nom option:selected').val();
        var flag = '1';
        
        toastr["error"]("Please wait,Generating Report!");
        window.open("<?php echo $this->Url->build(['controller' => 'Dues', 'action' => 'view']); ?>/" + flag + "/" + nom + "/" + class_id + "/"+shift_id + "/" +class_name + "/" + shift_name);
    
    }  
    
    
    

</script>   