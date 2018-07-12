<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Stock Report</h3>
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
                                                 <input type="date"  class="form-control pull-right" name="from" id="from"  value="<?php echo date("Y-m-d"); ?>">
                                                 <input type="date" class="form-control pull-right" name="to" id="to" value="<?php echo date("Y-m-d"); ?>">
                                               </div>
                                                /.input group 
                                          </div>-->
                                        
                                        
                                        <div class="form-group">
                                            <label>Product Category</label>
                                            <select class="form-control" onchange="getProducts();" id="product_type_id"  data-placeholder="Select">
                                                <option value="0">All</option>
                                                <?php foreach ($product_types as $row): ?>    
                                                    <option value="<?php echo $row->type_id; ?>"><?php echo $row->type_name; ?></option>
                                                <?php endforeach; ?>    
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label>Select Product</label>
                                            <select class="form-control" id="product_id"  data-placeholder="Selec">
                                                 <option value="0">All</option>
                                                <?php foreach ($feetype as $feetypes): ?>    
                                                    <option value="<?php echo $feetypes->id_fee_type; ?>"><?php echo $feetypes->fee_type_name; ?></option>
                                                <?php endforeach; ?>    
                                            </select>
                                        </div>

                                       <div class="form-group pull-right">
                                           <?= $this->Html->link(__('<i class="fa fa-print"></i> Print'), ['#' => '#'], ['onclick'=>"saleReport();",'class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 'escape' => false]) ?>
                                           
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
    
   
    
    
    function getProducts() {
        
        var type_id = $("#product_type_id option:selected").val();
        
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'Sale', 'action' => 'getProducts']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {type_id: type_id},
            success: function (data) {
                var mdata = data.products;
                if (mdata.length > 0) {
                    var html = '';
                    $('#product_id').html('');
                    html += '<option value="0">All</option>';
                    for (var x = 0; x < mdata.length; x++) {
                        html += '<option  value="' + mdata[x].id_products + '">' + mdata[x].product_name + '</option>';
                    }
                    $('#product_id').html(html);
                } else {
                    html += '<option value="0">All</option>';
                    $('#product_id').html(html);
                }
                
            }
        });
    }
    
    function saleReport(){
        
//        if($('#from').val() == ''){
//            toastr["error"]("Please select date range");
//            return false;
//        }
//        if($('#to').val() == ''){
//            toastr["error"]("Please select date range");
//            return false;
//        }
//        
//        var fdate = $('#from').val();
//        fdate = fdate.replace("/", "-"); // value = 9:61
//        fdate = fdate.replace("/", "-"); // value = 9:61
//        
//        var tdate = $('#to').val();
//        tdate = tdate.replace("/", "-"); // value = 9:61
//        tdate = tdate.replace("/", "-"); // value = 9:61
        
        var product_type_id = $('#product_type_id option:selected').val();
        var product_type = $('#product_type_id option:selected').text();
        
        var product_id = $('#product_id option:selected').val();
        var product = $('#product_id option:selected').text();
        
        //var tital = "Class: "+  class_name + " | Fee Head : "+  feehaed_name + " | Shift : " + shift_name;
        var flag = '2';
        window.open("<?php echo $this->Url->build(['controller' => 'Sale', 'action' => 'view']); ?>/" +  flag + "/" + product_type_id + "/" + product_type +"/"+ product_id + "/"+ product);
    
    }  

</script>   