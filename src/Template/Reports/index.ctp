<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Reporting Area</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                      
                          <div class="col-md-6 col-md-offset-3">

                            <div class="panel panel-primary">
                                <div class="panel-heading">Action</div>
                                <div class="panel-body">
                                    <div  class="col-md-12">
                                   
                                        
                                        <div class="form-group" style="<?php $this->request->session()->read('Auth.User.role_id') ==1 ? 'display:black' : 'display:none'; ?>">
                                            <label>Date Range:</label>
                                               <div class="input-group date">
                                                 <div class="input-group-addon">
                                                   <i class="fa fa-calendar"></i>
                                                 </div>
                                                 <input type="date"  class="form-control pull-right" name="from" id="from"  value="<?php echo date("Y-m-d"); ?>">
                                                 <input type="date" class="form-control pull-right" name="to" id="to" value="<?php echo date("Y-m-d"); ?>">
                                               </div>
                                               <!-- /.input group -->
                                        </div>   
                                        
                                   
                                      
                                          <div class="form-group">
                                           
                                            
                                              <select class="form-control" name="shift_id" id="shift_id">
                                                    <option value="0">All</option>
                                                    <option value="1">Morning</option>
                                                    <option value="2">Afternoon</option>
                                                    <option value="3">Evening</option>

                                              </select>
                                             
                                        </div> 
                                        
                                         <!-- Date range -->
                                        <div class="form-group">
                                           <?= $this->Html->link(__('<i class="fa fa-print"></i> Todays Financial Statement'), ['#' => '#'], ['onclick'=>"current_collection();",'class' => 'btn btn-icon waves-effect waves-light btn-warning m-b-5', 'escape' => false]) ?>
                                            <?= $this->Html->link(__('<i class="fa fa-print"></i> Fee Collection Class Wise'), ['#' => '#'], ['onclick'=>"daily_collection();",'class' => 'btn btn-icon waves-effect waves-light btn-info m-b-5', 'escape' => false]) ?>
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
        $("#months").select2();
        $("#feehead").select2();
        $("#class_id").select2();
        
    });

    
    function current_collection(){
        
      //  var class_id = $('#class_id option:selected').val();
        var shift_id = $('#shift_id option:selected').val();
        var shift_name = $('#shift_id option:selected').text();
        var from_date = $('#from').val();
        var to_date = $('#to').val();
        
        
        var flag = '1';
        toastr["info"]("Please wait,Generating Report!");
        window.open("<?php echo $this->Url->build(['controller' => 'Reports', 'action' => 'view']); ?>/" +  flag + "/" + shift_id + "/" + from_date + "/" + to_date + "/"+shift_name);
    
    }  
    
    function daily_collection(){
        
        
        var shift_id = $('#shift_id option:selected').val();
        var shift_name = $('#shift_id option:selected').text();
        var from_date = $('#from').val();
        var to_date = $('#to').val();
        
        
        var flag = '2';
        window.open("<?php echo $this->Url->build(['controller' => 'Reports', 'action' => 'view']); ?>/" +  flag + "/" + shift_id + "/" + from_date + "/" + to_date + "/"+shift_name);
    
    }  
    

</script>   