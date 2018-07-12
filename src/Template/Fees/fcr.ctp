<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Fee Collection</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">

                            <div class="panel panel-primary">
                                <div class="panel-heading">Criteria</div>
                                <div class="panel-body">
                                    <div  class="col-md-12">
                                        
<!--                                          <div class="form-group">
                                            <label>Date Range:</label>
                                               <div class="input-group date">
                                                 <div class="input-group-addon">
                                                   <i class="fa fa-calendar"></i>
                                                 </div>
                                                 <input type="date"  class="form-control pull-right" name="from" id="from"  value="">
                                                 <input type="date" class="form-control pull-right" name="to" id="to" value="">
                                               </div>
                                                /.input group 
                                          </div>-->
                                        
                                        
                                        <div class="form-group">
                                            <label>Select Class</label>
                                            <select class="form-control" id="class_id"  data-placeholder="Select Class">
                                                <?php foreach ($class as $class): ?>    
                                                    <option value="<?php echo $class->id_class; ?>"><?php echo $class->class_name; ?></option>
                                                <?php endforeach; ?>    
                                            </select>
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Select Shift</label>
                                            <select  class="form-control" name="shift_id" id="shift_id">

                                                <option value="1">Morning</option>
                                                <option value="2">Afternoon</option>
                                                <option value="3">Evening</option>

                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label>Select Fee Head</label>
                                            <select class="form-control" id="feehead"  data-placeholder="Select Fee Head">
                                                <?php foreach ($feetype as $feetypes): ?>    
                                                    <option value="<?php echo $feetypes->id_fee_type; ?>"><?php echo $feetypes->fee_type_name; ?></option>
                                                <?php endforeach; ?>    
                                            </select>
                                        </div>

                                         <div class="form-group">
                                            <label for="session" class="col-sm-2 control-label">Session</label>
                                               <select class="form-control" name="session_id" id="session_id">

                                                    <?php foreach ($session as $session): ?>
                                                        <option  value="<?php echo $session->id_session; ?>"><?php echo $session->session; ?></option>
                                                    <?php endforeach; ?>
                                               </select>
                                        </div> 

                                       <div class="form-group pull-right">
                                          
                                            <?= $this->Html->link(__('<i class="fa fa-print"></i> FCR Report'), ['#' => '#'], ['onclick'=>"fcr();",'class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 'escape' => false]) ?>
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
        $("#feehead").select2();
        $("#class_id").select2();
        
    });
//    $('#to').datepicker({
//         autoclose: true
//   }); 
//
//  $('#from').datepicker({
//         autoclose: true
//         
//     });
//   
  
    
    function fcr(){
        
//        if($('#from').val() == ''){
//            toastr["error"]("Please select date range");
//            return false;
//        }
//        if($('#to').val() == ''){
//            toastr["error"]("Please select date range");
//            return false;
//        }
        
//        var fdate = $('#from').val();
//        fdate = fdate.replace("/", "-"); // value = 9:61
//        fdate = fdate.replace("/", "-"); // value = 9:61
//        
//        var tdate = $('#to').val();
//        tdate = tdate.replace("/", "-"); // value = 9:61
//        tdate = tdate.replace("/", "-"); // value = 9:61
//       
        var class_id = $('#class_id option:selected').val();
        var shift_id = $('#shift_id option:selected').val();
        var fee_type_id = $('#feehead option:selected').val();
        var session_id = $('#session_id option:selected').val();
        
        var class_name = $('#class_id option:selected').text();
        var shift_name = $('#shift_id option:selected').text();
        var fee_type_name = $('#feehead option:selected').text();
        
        
        

        var flag = '3';
        toastr["info"]("Please wait,Generating Report!");
        window.open("<?php echo $this->Url->build(['controller' => 'Fees', 'action' => 'view']); ?>/" +  flag + "/" + class_id + "/" + shift_id + "/"+ fee_type_id + "/" + class_name +"/"+ shift_name + "/"+ fee_type_name + "/"+ session_id);
    
    }  
    
    
    

</script>   