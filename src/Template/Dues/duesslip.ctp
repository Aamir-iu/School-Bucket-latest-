<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Print Dues Challan</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">

                            <div class="panel panel-primary">
                                <div class="panel-heading">Print Dues Challan</div>
                                <div class="panel-body">
                                    <div  class="col-md-12">
                                        
                                        <div class="form-group">
                                            <label>Select Class</label>
                                            <select class="form-control" id="class_id"  data-placeholder="Select Class">
                                                <?php foreach ($class as $class): ?>    
                                                    <option value="<?php echo $class->id_class; ?>"><?php echo $class->class_name; ?></option>
                                                <?php endforeach; ?>    
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="shift_id"  control-label">Shift</label>
                                           
                                              <select  class="form-control" name="shift_id" id="shift_id">

                                                    <option value="1">Morning</option>
                                                    <option value="2">Afternoon</option>
                                                    <option value="3">Evening</option>

                                              </select>
                                             
                                        </div> 
                                        
                                        
                                        <div class="form-group">
                                            <label for="voucher_type">Voucher Type</label>
                                            <select onchange="showFeeHeads();" class="form-control" name="voucher_type" id="voucher_type">
                                                    <option value="1">Multiple Fee Type</option>
                                                    <option value="2">Single Fee Type</option>
                                              </select>
                                        </div>
                                        
                                        <div class="form-group" id="feehead_type" style="display:none;">
                                            
                                            <select class="form-control" id="feehead"  data-placeholder="Select Fee Head" style="width:100%;">
                                                <?php foreach ($feetype as $feetypes): ?>    
                                                    <option value="<?php echo $feetypes->id_fee_type; ?>"><?php echo $feetypes->fee_type_name; ?></option>
                                                <?php endforeach; ?>    
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Select Fee Month</label>
                                            <select class="form-control" id="month_id"  data-placeholder="Select Month" multiple>
                                                <?php foreach ($months as $months): ?>    
                                                    <option value="<?php echo $months->id_month; ?>"><?php echo $months->month_name; ?></option>
                                                <?php endforeach; ?>    
                                            </select>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label>Due Date:</label>
                                               <div class="input-group date">
                                                 <div class="input-group-addon">
                                                   <i class="fa fa-calendar"></i>
                                                 </div>
                                                 <input type="text" class="form-control pull-right" id="due_date" value="<?php echo date("m/d/Y"); ?>">
                                                  <span class="help-block">It's only for display </span>
                                               </div>
                                               <!-- /.input group -->
                                          </div>
                                        
                                          <div class="form-group">
                                            <label>Issue Date:</label>
                                               <div class="input-group date">
                                                 <div class="input-group-addon">
                                                   <i class="fa fa-calendar"></i>
                                                 </div>
                                                 <input type="text" class="form-control pull-right" id="issue_date" value="<?php echo date("m/d/Y"); ?>">
                                                  <span class="help-block">It's only for display </span>
                                               </div>
                                               <!-- /.input group -->
                                          </div>
                                        
                                        <div class="form-group">
                                            <label for="report_type"  control-label></label>
                                           
                                              <select  class="form-control" name="report_type" id="report_type">

                                                    <option value="1">Template #1</option>
                                                    <option value="2">Template #2</option>
                                                    <option value="3">Template #3</option>
                                                    <option value="4">Template #4</option>

                                              </select>
                                             
                                        </div> 
                                        
                                        
                                        
                                          <!-- Date range -->
                                        <div class="form-group pull-right">
                                           <?php // $this->Html->link(__('<i class="fa fa-calendar"></i> Dues Slip'), ['#' => '#'], ['onclick'=>"print_slip();",'class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 'escape' => false]) ?>
                                           <?php // $this->Html->link(__('<i class="fa fa-calendar"></i> Dues Slip'), ['#' => '#'], ['onclick'=>"print_slip_double();",'class' => 'btn btn-icon waves-effect waves-light btn-warning m-b-5', 'escape' => false]) ?>
                                           <?php // $this->Html->link(__('<i class="fa fa-bank"></i> View Bank Challan'), ['#' => '#'], ['onclick'=>"print_bank_challan();",'class' => 'btn btn-icon waves-effect waves-light btn-info m-b-5', 'escape' => false]) ?>
                                           <?= $this->Html->link(__('<i class="fa fa-print"></i> Print'), ['#' => '#'], ['onclick'=>"reportType();",'class' => 'btn btn-icon waves-effect waves-light btn-info m-b-5', 'escape' => false]) ?>
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
    
    function reportType(){
        
        var type = $('#report_type option:selected').val();
        var v_type = $('#voucher_type option:selected').val();
        
        if(v_type == 2){
             print_single_fee();
        }        
        else if(type == 1){
            print_slip();
        }
        else if(type == 2){
            print_slip_double(4);
        }
        else if(type == 3){
            print_slip_double(5);
        }
        else if(type == 4){
            print_bank_challan();
        }
        
    }

    $(document).ready(function () {
        $("#month_id").select2();
        $("#feehead").select2();
        $("#class_id").select2();
        
        
        $('#feehead option').prop('selected', true);
       
      
    });
    
   function showFeeHeads(){
       
       var type = $('#voucher_type option:selected').val();
       if(type === '2'){
           $('#feehead_type').fadeIn();
       }else{
           $('#feehead_type').fadeOut();
       }
   
   
   } 
    

  $('#due_date').datepicker({
         autoclose: true
   });
   
   $('#issue_date').datepicker({
         autoclose: true
   });
   
  $('#to').datepicker({
         autoclose: true
   }); 
    
    function print_slip(){
        
        var m = []; 
            $('#month_id option:selected').each(function() {
             m.push($(this).val());
        });
        
        var fh = []; 
            $('#feehead option:selected').each(function() {
             fh.push($(this).val());
        }); 
        
        if(fh.length === 0){
            toastr["error"]("Please select fee head first.", "Fee Head Not Selected!");
            return false;
        } 
        
        if(m.length === 0){
            toastr["error"]("Please select fee month.", "Fee Month Not Selected!");
            return false;
        }
        
       var class_id = $('#class_id option:selected').val();
       var shift_id = $('#shift_id option:selected').val(); 
       
       var dd = $('#due_date').val(); 
       var id = $('#issue_date').val(); 
       
       dd = dd.replace("/", "-"); // value = 9:61
       dd = dd.replace("/", "-"); // value = 9:61
        
       id = id.replace("/", "-"); // value = 9:61
       id = id.replace("/", "-"); // value = 9:61
      
        var flag = '2';
        window.open("<?php echo $this->Url->build(['controller' => 'Dues', 'action' => 'view']); ?>/" + flag + "/" + m + "/" + fh + "/" + class_id + "/" + "/"+ shift_id + "/" + dd + "/"+ id);
    
    }  
    
    function print_bank_challan(){
        
        var m = []; 
            $('#month_id option:selected').each(function() {
             m.push($(this).val());
        });
        
        var fh = []; 
            $('#feehead option:selected').each(function() {
             fh.push($(this).val());
        }); 
        
        if(fh.length === 0){
            toastr["error"]("Please select fee head first.", "Fee Head Not Selected!");
            return false;
        } 
        
        if(m.length === 0){
            toastr["error"]("Please select fee month.", "Fee Month Not Selected!");
            return false;
        }
        
       var class_id = $('#class_id option:selected').val();
       var shift_id = $('#shift_id option:selected').val(); 
       
       var dd = $('#due_date').val(); 
       var id = $('#issue_date').val(); 
      
       dd = dd.replace("/", "-"); // value = 9:61
       dd = dd.replace("/", "-"); // value = 9:61
       
       id = id.replace("/", "-"); // value = 9:61
       id = id.replace("/", "-"); // value = 9:61
        
      
        var flag = '3';
        window.open("<?php echo $this->Url->build(['controller' => 'Dues', 'action' => 'view']); ?>/" + flag + "/" + m + "/" + fh + "/" + class_id + "/" + "/"+ shift_id + "/" + dd + "/" + id );
    
    }  
    function print_slip_double(flag){
        
        var m = []; 
            $('#month_id option:selected').each(function() {
             m.push($(this).val());
        });
        
        var fh = []; 
            $('#feehead option:selected').each(function() {
             fh.push($(this).val());
        }); 
        
        if(fh.length === 0){
            toastr["error"]("Please select fee head first.", "Fee Head Not Selected!");
            return false;
        } 
        
        if(m.length === 0){
            toastr["error"]("Please select fee month.", "Fee Month Not Selected!");
            return false;
        }
        
       var class_id = $('#class_id option:selected').val();
       var shift_id = $('#shift_id option:selected').val(); 
       
       var dd = $('#due_date').val(); 
       var id = $('#issue_date').val(); 
      
       dd = dd.replace("/", "-"); // value = 9:61
       dd = dd.replace("/", "-"); // value = 9:61
      
       id = id.replace("/", "-"); // value = 9:61
       id = id.replace("/", "-"); // value = 9:61
 
        window.open("<?php echo $this->Url->build(['controller' => 'Dues', 'action' => 'view']); ?>/" + flag + "/" + m + "/" + fh + "/" + class_id + "/" + "/"+ shift_id + "/" + dd + "/"+id);
    
    }  
    
    function print_single_fee(){
        
        var m = []; 
            $('#month_id option:selected').each(function() {
             m.push($(this).val());
        });

        var fh = $('#feehead option:selected').val();
        if(fh.length === 0){
            toastr["error"]("Please select fee head first.", "Fee Head Not Selected!");
            return false;
        } 
        
        if(m.length === 0){
            toastr["error"]("Please select fee month.", "Fee Month Not Selected!");
            return false;
        }
        
       var class_id = $('#class_id option:selected').val();
       var shift_id = $('#shift_id option:selected').val(); 
       
       var dd = $('#due_date').val(); 
       var id = $('#issue_date').val(); 
       
       dd = dd.replace("/", "-"); // value = 9:61
       dd = dd.replace("/", "-"); // value = 9:61
        
       id = id.replace("/", "-"); // value = 9:61
       id = id.replace("/", "-"); // value = 9:61
      
        var flag = '6';
        window.open("<?php echo $this->Url->build(['controller' => 'Dues', 'action' => 'view']); ?>/" + flag + "/" + m + "/" + fh + "/" + class_id + "/" + "/"+ shift_id + "/" + dd + "/"+ id);
    
    }  

</script>   