<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Generate Expense Report</h3>
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
                                                 <input type="date" class="form-control pull-right"  id="from" value="">
                                                 <input type="date" class="form-control pull-right" id="to" value="">
                                               </div>
                                               <!-- /.input group -->
                                          </div>
                                        
                                        
                                        <div class="form-group hidden">
                                            <label>Select Acount</label>
                                             <select id="transactionaccountid" name="account_voucher_type_id" class="form-control" style="width:100%;">
                                               <option>Select</option>
                                                <?php foreach ($transaction_account as $transaction_accounts): ?>    
                                                    <option value="<?php echo $transaction_accounts->id_transaction_account; ?>"><?php echo $transaction_accounts->ma . "-" . $transaction_accounts->ca . "-" . $transaction_accounts->sca . "-" . $transaction_accounts->transaction_account_number . "|" . $transaction_accounts->transaction_account_name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                             <label>Shift</label>
                                            <select class="form-control" name="shift_id" id="shift_id">
                                                <option value="0">All</option>
                                                <option value="1">Morning</option>
                                                <option value="2">Afternoon</option>
                                                <option value="3">Evening</option>

                                            </select>
                                        </div>

                                         
<!--                                      <div class="form-group">
                                           <?php // $this->Html->link(__('<i class="fa fa-calendar"></i> Click To View Report'), ['#' => '#'], ['onclick'=>"expanse_report(1);",'class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 'escape' => false]) ?>
                                        </div>
                                         /.form group -->
                                        
                                        
                                         <!-- Date range -->
                                        <div class="form-group pull-right">
                                           <?= $this->Html->link(__('<i class="fa fa-calendar"></i> View Report'), ['#' => '#'], ['onclick'=>"expanse_report(2);",'class' => 'btn btn-icon waves-effect waves-light btn-info m-b-5', 'escape' => false]) ?>
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

//  $('#from').datepicker({
//         autoclose: true
//         
//     });
//   
//  $('#to').datepicker({
//         autoclose: true
//   }); 
//    
    function expanse_report(id){
        
        if($('#from').val() == ''){
            toastr["error"]("Please select date range");
            return false;
        }
        if($('#to').val() == ''){
            toastr["error"]("Please select date range");
            return false;
        }
        
        var shift_id = $('#shift_id option:selected').val();
        var shift_name = $('#shift_id option:selected').text();
        
        var fdate = $('#from').val();
        fdate = fdate.replace("/", "-"); // value = 9:61
        fdate = fdate.replace("/", "-"); // value = 9:61
        var tdate = $('#to').val();
        tdate = tdate.replace("/", "-"); // value = 9:61
        tdate = tdate.replace("/", "-"); // value = 9:61
        var ac = $('#transactionaccountid option:selected').val();
        var tag = id;
 
        var flag = '2';
        toastr["error"]("Please wait,Generating Report!");
        window.open("<?php echo $this->Url->build(['controller' => 'Expenses', 'action' => 'view']); ?>/" +  flag + "/" + fdate + "/" + tdate + "/" + ac + "/" + tag + "/"+shift_id + "/"+shift_name);
    
    }  
    
    
    

</script>   