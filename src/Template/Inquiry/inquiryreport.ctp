<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Inquiry Report</h3>
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
                                            <label>Date Range:</label>
                                               <div class="input-group date">
                                                 <div class="input-group-addon">
                                                   <i class="fa fa-calendar"></i>
                                                 </div>
                                                 <input type="date"  class="form-control pull-right" name="from" id="from"  value="">
                                                 <input type="date" class="form-control pull-right" name="to" id="to" value="">
                                               </div>
                                               <!-- /.input group -->
                                          </div>
                                        
                                        
                                        <div class="form-group">
                                            <label>Select Class</label>
                                            <select class="form-control" id="class_id"  data-placeholder="Select Class">
                                                <option>Select</option>
                                                <?php foreach ($class as $class): ?>    
                                                    <option value="<?php echo $class->id_class; ?>"><?php echo $class->class_name; ?></option>
                                                <?php endforeach; ?>    
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label>Select Area</label>
                                            <select class="form-control" id="area_id"  data-placeholder="Select Area">
                                                  <option>Select</option>
                                                <?php foreach ($area as $area): ?>    
                                                    <option value="<?php echo $area->id_area; ?>"><?php echo $area->area_name; ?></option>
                                                <?php endforeach; ?>    
                                            </select>
                                        </div>
                                        <div class="form-group pull-right">
                                           <?= $this->Html->link(__('<i class="fa fa-print"></i> Print'), ['#' => '#'], ['onclick'=>"inquiry_report();",'class' => 'btn btn-icon waves-effect waves-light btn-info m-b-5', 'escape' => false]) ?>
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
  
    
    function inquiry_report(){
        
        if($('#from').val() == ''){
            toastr["error"]("Please select date range");
            return false;
        }
        if($('#to').val() == ''){
            toastr["error"]("Please select date range");
            return false;
        }
        var class_id = $('#class_id option:selected').val();
        var area_id = $('#area_id option:selected').val();
        
        var fdate = $('#from').val();
        fdate = fdate.replace("/", "-"); // value = 9:61
        fdate = fdate.replace("/", "-"); // value = 9:61
        
        var tdate = $('#to').val();
        tdate = tdate.replace("/", "-"); // value = 9:61
        tdate = tdate.replace("/", "-"); // value = 9:61
       
        var flag = '2';
        toastr["info"]("Please wait,Generating Report!");
        window.open("<?php echo $this->Url->build(['controller' => 'Inquiry', 'action' => 'view']); ?>/" +  flag + "/" + fdate + "/" + tdate + "/" + class_id + "/" + area_id );
    
    }  
    
    
    

</script>   