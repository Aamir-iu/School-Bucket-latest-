<!-- BEGIN PAGE LEVEL STYLES -->
<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="row">
                        
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" > 
                <!-- Begin: life time stats -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row ">
                            <!--Voucher Details-->
                            <div class="form-body form-horizontal form-bordered form-row-stripped">
                                <fieldset>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Voucher Date:</label>
                                        <div class="col-md-8">
                                            <input type="Date" id="voucher_date" placeholder="Voucher Date" class="form-control disabled" name='voucher_date' value='<?php echo date("Y-m-d"); ?>' />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Account Voucher Type:</label>
                                        <div class="col-md-8">
                                            <select onchange="changetype();" id="voucher_type"  <?php if($flag===2){ echo "disabled"; } ?> name="account_voucher_type_id" class="form-control">
                                                <?php foreach ($accountvouchertype as $accountvouchertypes): ?>    
                                                    <option <?php  if($flag===2){echo 5 === $accountvouchertypes->id_account_voucher_type ? 'selected' : '' ; } ?>   value="<?php echo $accountvouchertypes->id_account_voucher_type; ?>"><?php echo $accountvouchertypes->account_voucher_type; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Description:</label>

                                        <div class="col-md-8">
                                            <input type="text" id="voucher_desc" placeholder="Description" class="form-control disabled" name='Description' value='' />
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Voucher Status:</label>
                                        <div class="col-md-8">
                                            <select  id="voucher_status" name="voucher_status" class="form-control">
                                                <option value='Unposted'>Unposted</option>
<!--                                                <option value='Posted'>Posted</option>
                                                <option value='Cancelled'>Cancelled</option>-->
                                            </select>
                                        </div>
                                    </div>
                  
                                </fieldset> 
                            </div>
                            <!--End Voucher Details-->

                        </div>
                    </div>
                </div>
            </div>
                   
                    <div class="col-md-6">
                <!-- Begin: life time stats -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row ">
                            <!--Voucher Details-->
                            <div class="form-body form-bordered form-row-stripped">
<!--                                <fieldset>-->

                                <div class="row">
                                    
                                    <div class="col-md-12">
                                        <div class="form-group clearfix">
                                            <label class="control-label col-md-4">Business Partners :</label>
                                            <div onchange="get_business_type();" class="col-md-8">
                                                <select id="business_type" name="business_type" <?php if($flag===2){ echo "disabled"; } ?> class="form-control">
                                                    <option  value="selected">Select</option>
                                                    <?php foreach ($business_partners as $business_partners): ?>
                                                        <option <?php echo $flag === $business_partners->id_business_type ? 'selected' : '' ; ?>  value="<?php echo $business_partners->id_business_type; ?>"><?php echo $business_partners->business_type; ?></option>
                                                    <?php endforeach; ?>
                                                        <option value="0">Walk in Customer</option>
                                                        <option value="100">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group clearfix">
                                            <label class="control-label col-md-4">Partner Name:</label>
                                            <div class="col-md-8">
                                                <select id="business_name" name="business_name" <?php if($flag===2){ echo "disabled"; } ?> class="form-control">
                                                   <?php if(!empty($paymentadvice)): ?> 
                                                   <option value="<?php echo $paymentadvice[0]['sup_id'];  ?>" tax="<?php echo $paymentadvice[0]['tax'];  ?>"><?php  echo $paymentadvice[0]['sup_name']; ?><option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12" id="cash_bank" style="display:none;">
                                        <div class="form-group clearfix">
                                            <div class="col-md-4"></div>
                                            
                                            <div class="col-md-3">  
                                                <label class="">
                                                    <input type="radio" onclick="show_hide_banks(1);" id="cash" name="mode" value="">Cash
                                                </label>
                                           </div>

                                            <div class="col-md-3">  
                                                <label class="">
                                                    <input type="radio" onclick="show_hide_banks(2);" id="bank" name="mode" value="">Bank
                                                </label>
                                            </div> 
                                        </div>
                                    </div>   
                                    
                                    <div class="col-md-12" id="banks" style="display:none;">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Select Bank:</label>
                                            <div class="col-md-8">
                                                <select id="transactionacid" name="transactionacid" class="form-control">

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
<!--                                </fieldset> -->
                            </div>
                            <!--End Voucher Details-->

                        </div>
                    </div>
                </div>
            </div>        
                
                        
             <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="caption">
                                <i class="fa fa-folder"></i>
                                <span class="caption-subject font-teal-500 bold uppercase">VOUCHER ENTRIES: </span>
                            </div>
                        </div>
                        <div class="panel-body">
                            <!--voucher detials section-->
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" > 
                                <div class="panel panel-default">

                                    <div class="panel-body"> 
                                        <div class="form-body form-horizontal form-bordered form-row-stripped">
                                            <fieldset>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Transaction Type:</label>
                                                    <div class="col-md-8">
                                                        <select id="transactiontypeid" name="transactiontypeid" class="form-control">
                                                            
                                                        <option value="Credit">Credit</option> 
                                                        <option value="Debit">Debit</option>
                                                     
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Transaction Account:</label>
                                                    <div class="col-md-8">
                                                        <select id="transactionaccountid" name="account_voucher_type_id" class="form-control">
                                                            <?php foreach ($transaction_account as $transaction_accounts): ?>    
                                                                <option <?php if($flag === 2){ echo 25 === $transaction_accounts->id_transaction_account ? 'selected' : '' ;} ?>  value="<?php echo $transaction_accounts->id_transaction_account; ?>"><?php echo $transaction_accounts->ma."-".$transaction_accounts->ca."-".$transaction_accounts->sca."-".$transaction_accounts->transaction_account_number . "|" . $transaction_accounts->transaction_account_name; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Cost Center Type:</label>
                                                    <div class="col-md-8">
                                                        <select  onchange="get_center_type();" id="cost_center_type" name="cost_center_type" class="form-control">
                                                            <option value="select">Select </option>
                                                            <?php foreach ($cost_center_type as $cost_center_types): ?>    
                                                                <option <?php  if( $flag === 2 ){ echo 1 === $cost_center_types->id_cost_center_type ? 'selected' : '' ; } ?>   value="<?php echo $cost_center_types->id_cost_center_type; ?>"><?php echo $cost_center_types->cost_center_type; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Cost Center:</label>
                                                    <div class="col-md-8">
                                                        <select id="cost_center" name="cost_center" class="form-control">
                                                        </select>
                                                    </div>
                                                </div>

                                                <br/>
                                            </fieldset> 

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" > 
                                <div class="panel panel-default">

                                    <div class="panel-body"> 
                                        <div class="form-body form-horizontal form-bordered form-row-stripped">
                                            <fieldset>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Payment Mode</label>
                                                    <div class="col-md-8">
                                                        <select id="paymentmode" name="account_voucher_type_id" class="form-control">

                                                            <option value="Cash">Cash</option>
                                                            <option value="Cheque">Cheque</option>
                                                            <option value="Pay Order">Pay Order</option>
                                                            <option value="Credit Card">Credit Card</option>
<!--                                                            <option value="Bank to Cash">Bank to Cash</option>-->
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Instrument #</label>
                                                    <div class="col-md-8">
                                                        <input type="txt" placeholder="Instrument #" id="instumentno" class="form-control disabled" name='instrument' value='<?php echo $this->request->session()->read('instrument_number'); ?>' />
                                                    </div>
                                                </div> 

                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Amount:</label>
                                                    <div class="col-md-8">
                                                        <input type="text" placeholder="Amount" id="amount" class="form-control float-number disabled" name='Amount' value='<?php  if(!empty($paymentadvice)){ echo $paymentadvice[0]['amount'];  } ?>' />
                                                    </div>
                                                </div> 

                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Remarks:</label>
                                                    <div class="col-md-8">
                                                        <input type="text" placeholder="Remarks" id="remarks" class="form-control disabled" name='remarks' value='' />
                                                    </div>
                                                </div>   
                                                <div class="form-group">
                                                    <div class="col-md-11 " style="text-align: right">
                                                        <a onclick="addtolist();" counter="1"  class="btn btn-icon  waves-effect waves-light btn-success m-b-5">Add <i class="fa fa-arrow-down "></i> </a>
                                                    </div>
                                                </div>
                                            </fieldset> 

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end details-->

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                <div class="table-responsive">
                                    <table id="transactiontable" class="table table-hover table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="hidden">Trans. Account ID</th>
                                                <th scope="col" width="12%">Account Number</th>
                                                <th scope="col" width="20%">Account Title</th>
                                                <th scope="col" width="12%">Payment Mode</th>
                                                <th scope="col" width="12%"> Instrument #</th>
                                                <th scope="col" class="hidden"> Cost Center Type</th>
                                                <th scope="col" width="12%"> Cost Center</th>
                                                <th scope="col" class="hidden">Cost Center ID</th>
                                                <th scope="col" width="10%">Amount</th>
                                                <th scope="col" width="20%">Remarks</th>

                                                <th scope="col" width="20%" class="text-primary">Debit</th>
                                                <th scope="col" width="20%" class="text-primary">Credit</th>
                                                <th scope="col" width="10%" class="actions"><?= __('Actions') ?></th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <table id="tbltotals" class="table table-hover table-bordered table-striped">
                                        <tbody></tbody>
                                    </table>
                                    <div class="actions"  style="text-align:right; ">
                                        <button onclick="add_transaction();" type="button"  id="save_button" class="btn btn-icon  waves-effect waves-light btn-success m-b-5">Save</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
                        </div>   
                    </div>
                </div>
      
                </div>  
            </div>
         <!-- /.row -->
</section>
<!-- /.content -->

    <div class="modal fade" id="cost_center_modal" role="cost_center_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Change Cost Center</h4>
            </div>
            <div class="modal-body">
                <form id="refund_form" action="" method="post">
                    <input type="hidden" name="cc_obj" id="cc_obj">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-4">Cost Center Type:</label>
                                <div class="col-md-8">
                                    <select  onchange="cget_center_type();" id="ccost_center_type" name="ccost_center_type" class="form-control">
                                        <option value="select">Select </option>
                                        <?php foreach ($cost_center_type as $cost_center_types): ?>    
                                            <option <?php  if( $flag === 2 ){ echo 1 === $cost_center_types->id_cost_center_type ? 'selected' : '' ; } ?>   value="<?php echo $cost_center_types->id_cost_center_type; ?>"><?php echo $cost_center_types->cost_center_type; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Cost Center:</label>
                                    <div class="col-md-8">
                                        <select id="ccost_center" name="ccost_center" class="form-control"></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group clearfix">
                                <br><br>
                                <button type="button" onclick="changeCostCenterDetails();" class="btn btn-sm btn-primary pull-right">Change</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
            <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>  

<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>    
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
<?= $this->Html->script('datatable.js') ?>  



<script>

    $(document).ready(function () {
        
        $("#transactionaccountid").select2();
        $("#cost_center").select2();
        $("#ccost_center").select2();
        $("#business_name").select2();
      
        $('#cash').on('change', function(){
            //$('#paymentmode option').prop('disabled', true);
            //$('#paymentmode option[value="Cash"]').prop('disabled', false);
           
        });
        $('#bank').on('change', function(){
            //$('#paymentmode option').prop('disabled', false);
            //$('#paymentmode option[value="Cash"]').prop('disabled', true);
            
        });
     
     //   $('.cost_center_edit').on('click', function(){
     //   alert('test');
     //   });
        
        
        
    });
    
    $(document).ready(function () {
        
        changetype();
        var flag = '<?php echo $flag; ?>';
        if(flag === '2'){
            get_center_type();
            cget_center_type();
            addtolist();
        }
    });
    
    function changeCostCenterDetails(){
        var cct = $('#ccost_center_type option:selected').text();
        var ccid = $('#ccost_center option:selected').val();
        var cc = $('#ccost_center option:selected').text();
        var obj = $('a[obj="current"]');
        obj.parent().siblings('.cctype').text(cct);
        obj.parent().siblings('.ccid').text(ccid);
        obj.text(cc);
        $('a[obj="current"]').removeAttr('obj');
        $('#cost_center_modal').modal('hide');
    }
    
    function loadCostCenterModal(obj){
        $('#ccost_center_type').val('select').change();
        $('#ccost_center').html('');
        $('#cost_center_modal').modal({
            show : true,
            backdrop : 'static'
        });
        $('a[obj="current"]').removeAttr('obj');
        obj.attr('obj', 'current');
    }

    function changetype(){ 
            var vt = $("#voucher_type option:selected").text();
            
            if(vt === 'Receipt Voucher'){
                $('#transactiontypeid').val('Credit').change();
                $('#transactiontypeid').prop("disabled", true);
                $('#cash_bank').show();
            }else if(vt === 'Payment Voucher'){
                 $('#transactiontypeid').val('Debit').change();
                 $('#transactiontypeid').prop("disabled", true);
                 $('#cash_bank').show();
            }else{
                var flag = '<?php  echo $flag; ?>';
                if(flag === '2'){
                 $('#transactiontypeid').val('Credit').change();
                }else{
                 $('#transactiontypeid').val('Debit').change();
                }
                $('#transactiontypeid').prop("disabled", false);
                $('#cash_bank').hide();
            }
        }
        
     function show_hide_banks(id){ 
            if(id==2){
                 $('#paymentmode').val('Cheque').change();
                 $('#banks').show();
            }else{
                 $('#banks').hide();
                 $('#paymentmode').val('Cash').change();
            }
            
                $.ajax({
                    type: "POST",
                    url: "<?php echo $this->Url->build(['controller' => 'AccountVoucher', 'action' => 'getbanks']); ?>",
                    dataType: 'json',
                    cache: false,
                    async: false,
                    data: {tid: id},
                    success: function (data) {
                        var mdata = data.data;
                        if (mdata.length > 0) {
                            var html = '';
                            $('#transactionacid').html('');
                            for (var x = 0; x < mdata.length; x++) {
                                html += '<option value="' + mdata[x].id_transaction_account + '">' + mdata[x].transaction_account_number + '|'+ mdata[x].transaction_account_name + '</option>';
                            }
                            $('#transactionacid').html(html);
                        } else {
                            $('#transactionacid').html('');
                        }
                    }
                });
        }    
        

    function addtolist() {
        var counter = 0;
        var totalamount = 0;
        var tdebit = 0;
        var tcredit = 0;
        counter = parseInt(counter);
        var transactiontypeid = $("#transactiontypeid option:selected").val();
        var temp = $("#transactionaccountid option:selected").text().split("|");
        var transactionaccount_number = temp[0];
        var transactionaccount_name = temp[1];
        var transactionaccount_id = $("#transactionaccountid option:selected").val();
        var paymentmode = $("#paymentmode").val();
        var instumentno = $("#instumentno").val();
        var cost_center_type = $("#cost_center_type option:selected").text();
        var cost_center = $("#cost_center option:selected").text();
        var cost_center_id = $("#cost_center option:selected").val();
        var amount = parseFloat($("#amount").val() == '' ? 0 : $("#amount").val());
        var remarks = $("#remarks").val();
        var auto_ac_id = $("#transactionacid option:selected").val();
        var temp_record = $("#transactionacid option:selected").text().split("|");
        var auto_ac_no = temp_record[0];
        var auto_ac_title = temp_record[1];
        
        var voucher_type = $('#voucher_type option:selected').val();
        var business_type = $('#business_type option:selected').val();
        var business_name = $('#business_name option:selected').val();
        
        if(business_type == 'selected'){
            toastr["warning"]("Business Partner", "Empty Field(s) Found");
            return false;
        }
        if(business_name == 'select'){
            toastr["warning"]("Partner Name", "Empty Field(s) Found");
            return false;
        }
        if(voucher_type == '3' || voucher_type == '4'){
            if($("input[type='radio'][name='mode']:checked").length == 0){ 
                toastr["warning"]("Cash / Bank", "Choose Payment Mode");
                return false;
            }
        }
        if($("#cost_center_type option:selected").val() === ""){
            toastr["warning"]("Cost Center Type", "Empty Field(s) Found");
            return false;
        }
        if(cost_center_id == 'select' || cost_center_id == undefined){
            toastr["warning"]("Cost Center", "Empty Field(s) Found");
            return false;
        }
        
        if(transactionaccount_name.indexOf("Tax") > -1){}else{
            if(amount == '0'){
                toastr["warning"]("Amount", "Empty Field(s) Found");
                return false;
            }
        }
        
        if(transactionaccount_name.indexOf("Tax") > -1){
            var tbody = $("#transactiontable tbody");
            if(tbody.children().length == 0){
                toastr["warning"]("Please select a Valid Account before adding taxes!", "Alert");
                return false;
            }
        }

        toastr["info"]("Adding New Entry");
        
        $('#voucher_type').attr('disabled', true);
        $('#bank').attr('disabled', true);
        $('#cash').attr('disabled', true);
        $('#transactionacid').attr('disabled', true);
        
        var mhtml = "";
        ///get counter value
        $('#transactiontable').find("tr.id").each(function (index) {
            counter = index + 1;
        });
        
        if(transactionaccount_name.indexOf("Tax") > -1){} else{
            if (transactiontypeid === "Debit") {
                mhtml += "<tr class='id " + counter + "'><td class='hidden'>" + transactionaccount_id + "</td><td>" + transactionaccount_number + "</td><td>" + transactionaccount_name + "</td><td>" + paymentmode + "</td><td>" + instumentno + "</td><td class='hidden cctype'>" + cost_center_type + "</td><td><a href='javascript:void(0);' onclick='loadCostCenterModal($(this));' id='cost_id' data-type='select' data-pk='1' data-value='' data-original-title='Select Cost Center'>" + cost_center + "</a></td><td class='hidden ccid'>" + cost_center_id + "</td><td>" + amount + "</td><td>" + remarks + "</td><td style='text-align:right;' class='debit'>" + amount + "</td><td></td><td><button onclick='removefromlist(" + counter + ");' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button></td></tr>";
                totalamount = totalamount +  amount; 
                
            } else {
                mhtml += "<tr class='id " + counter + "'><td class='hidden'>" + transactionaccount_id + "</td><td>" + transactionaccount_number + "</td><td>" + transactionaccount_name + "</td><td>" + paymentmode + "</td><td>" + instumentno + "</td><td class='hidden cctype'>" + cost_center_type + "</td><td><a href='javascript:void(0);' onclick='loadCostCenterModal($(this));' id='cost_id' data-type='select' data-pk='1' data-value='' data-original-title='Select Cost Center'>" + cost_center + "</a></td><td class='hidden ccid'>" + cost_center_id + "</td><td>" + amount + "</td><td>" + remarks + "</td><td></td><td style='text-align:right;' class='credit'>" + amount + "</td><td><button onclick='removefromlist(" + counter + ");' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button></td></tr>";
                totalamount = totalamount + amount; 
            }
        }
        
        $("#transactiontable tbody").append(mhtml);
        $('.counter').attr('counter', counter + 1);
       
        autoremovefromlist(auto_ac_id);
       
        if ($("#cash").is(":checked") || $("#bank").is(":checked")) {
            $('#transactiontable tr').each(function (row, tr) {
                var td = $(tr).find('td:eq(10)').text();
                var tc = $(tr).find('td:eq(11)').text();
                if (td != '' && td != "Debit") {
                    tdebit = tdebit + parseFloat(td);
                } else if (tc != '' && tc != "Credit") {
                    tcredit = tcredit + parseFloat(tc);
                }
            });
            
            if (transactiontypeid === "Debit") {
                totalamount = tdebit - tcredit;
            } else{
                totalamount = tcredit - tdebit;
            }
            
            
         
            mhtml = '';
            
            if (transactiontypeid === "Debit") {
                if(transactionaccount_name.indexOf("Tax") > -1){
                    
                    if(business_type === '1' || business_type === '2'){
                    
                    var tax_per = $('#business_name option:selected').attr('tax');
                    var tax_amount =  (tax_per / 100) * totalamount;
                    amount = tax_amount;
                    
                    }
                    
                    mhtml += "<tr class='id " + auto_ac_id + "'><td class='hidden'>" + auto_ac_id + "</td><td>" + auto_ac_no + "</td><td>" + auto_ac_title + "</td><td>" + paymentmode + "</td><td>" + instumentno + "</td><td class='hidden cctype'>" + cost_center_type + "</td><td><a href='javascript:void(0);' onclick='loadCostCenterModal($(this));' id='cost_id' data-type='select' data-pk='1' data-value='' data-original-title='Select Cost Center'>" + cost_center + "</a></td><td class='hidden ccid'>" + cost_center_id + "</td><td>" + totalamount + "</td><td>" + remarks + "</td><td></td><td style='text-align:right;' class='credit'>" + (totalamount - amount) + "</td><td><button onclick='errormessage(" + auto_ac_id + ");' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button></td></tr>";
                    mhtml += "<tr class='id " + counter + "'><td class='hidden'>" + transactionaccount_id + "</td><td>" + transactionaccount_number + "</td><td>" + transactionaccount_name + "</td><td>" + paymentmode + "</td><td>" + instumentno + "</td><td class='hidden cctype'>" + cost_center_type + "</td><td><a href='javascript:void(0);' onclick='loadCostCenterModal($(this));' id='cost_id' data-type='select' data-pk='1' data-value='' data-original-title='Select Cost Center'>" + cost_center + "</a></td><td class='hidden ccid'>" + cost_center_id + "</td><td>" + amount + "</td><td>" + remarks + "</td><td></td><td style='text-align:right;' class='credit'>" + amount + "</td><td><button onclick='removefromlist(" + counter + ");' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button></td></tr>";
                }else{
                    mhtml += "<tr class='id " + auto_ac_id + "'><td class='hidden'>" + auto_ac_id + "</td><td>" + auto_ac_no + "</td><td>" + auto_ac_title + "</td><td>" + paymentmode + "</td><td>" + instumentno + "</td><td class='hidden cctype'>" + cost_center_type + "</td><td><a href='javascript:void(0);' onclick='loadCostCenterModal($(this));' id='cost_id' data-type='select' data-pk='1' data-value='' data-original-title='Select Cost Center'>" + cost_center + "</a></td><td class='hidden ccid'>" + cost_center_id + "</td><td>" + totalamount + "</td><td>" + remarks + "</td><td></td><td style='text-align:right;' class='credit'>" + totalamount + "</td><td><button onclick='errormessage(" + auto_ac_id + ");' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button></td></tr>";
                }
            } else {
                if(transactionaccount_name.indexOf("Tax") > -1){
                    
                    if(business_type === '1' || business_type === '2'){
                    
                    var tax_per = $('#business_name option:selected').attr('tax');
                    var tax_amount =  (tax_per / 100) * totalamount;
                    amount = tax_amount;
                    
                    }
                    
                    mhtml += "<tr class='id " + auto_ac_id + "'><td class='hidden'>" + auto_ac_id + "</td><td>" + auto_ac_no + "</td><td>" + auto_ac_title + "</td><td>" + paymentmode + "</td><td>" + instumentno + "</td><td class='hidden cctype'>" + cost_center_type + "</td><td><a href='javascript:void(0);' onclick='loadCostCenterModal($(this));' id='cost_id' data-type='select' data-pk='1' data-value='' data-original-title='Select Cost Center'>" + cost_center + "</a></td><td class='hidden ccid'>" + cost_center_id + "</td><td>" + totalamount + "</td><td>" + remarks + "</td><td style='text-align:right;' class='debit'>" + (totalamount - amount) + "</td><td></td><td><button onclick='errormessage(" + auto_ac_id + ");' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button></td></tr>";
                    mhtml += "<tr class='id " + counter + "'><td class='hidden'>" + transactionaccount_id + "</td><td>" + transactionaccount_number + "</td><td>" + transactionaccount_name + "</td><td>" + paymentmode + "</td><td>" + instumentno + "</td><td class='hidden'>" + cost_center_type + "</td><td><a href='javascript:void(0);' onclick='loadCostCenterModal($(this));' id='cost_id' data-type='select' data-pk='1' data-value='' data-original-title='Select Cost Center'>" + cost_center + "</a></td><td class='hidden ccid'>" + cost_center_id + "</td><td>" + amount + "</td><td>" + remarks + "</td><td style='text-align:right;' class='debit'>" + amount + "</td><td></td><td><button onclick='removefromlist(" + counter + ");' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button></td></tr>";
                }else{
                    mhtml += "<tr class='id " + auto_ac_id + "'><td class='hidden'>" + auto_ac_id + "</td><td>" + auto_ac_no + "</td><td>" + auto_ac_title + "</td><td>" + paymentmode + "</td><td>" + instumentno + "</td><td class='hidden cctype'>" + cost_center_type + "</td><td><a href='javascript:void(0);' onclick='loadCostCenterModal($(this));' id='cost_id' data-type='select' data-pk='1' data-value='' data-original-title='Select Cost Center'>" + cost_center + "</a></td><td class='hidden ccid'>" + cost_center_id + "</td><td>" + totalamount + "</td><td>" + remarks + "</td><td style='text-align:right;' class='debit'>" + totalamount + "</td><td></td><td><button onclick='errormessage(" + auto_ac_id + ");' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button></td></tr>";
                }
            }
            
            $("#transactiontable tbody").append(mhtml);
        }
        
        calculateTotals();
    }

    function calculateTotals() {

        $('#tbltotals tbody').html('');
        var tdebit = 0;
        var tcredit = 0;
        //var totalamount;
        var mhtml = "";
        $('#transactiontable tr').each(function (row, tr) {
            var td = $(tr).find('td:eq(10)').text();
            var tc = $(tr).find('td:eq(11)').text();

            if (td != '' && td != "Debit") {
                tdebit = tdebit + parseFloat(td);
            } 
            if (tc != '' && tc != "Credit") {
                tcredit = tcredit + parseFloat(tc);
            }
        });
        //totalamount = tdebit + tcredit;
        var txtcolor = '';
        if (tcredit > tdebit || tdebit > tcredit) {
            txtcolor = 'text-danger';
        }
        mhtml += "<tr><td width='81%' style='text-align:right; text-weight:bold'>Totals:</td><td style='text-align:right; font-weight:bold;' class='totaldebit " + txtcolor + "' width='6%'>" + tdebit + "</td><td style='text-align:right; font-weight: bold;' class='totalcredit " + txtcolor + "' width='6%'>" + tcredit + "</td><td width='7%'></td></tr>";
        $("#tbltotals tbody").append(mhtml);
        
      
    }

    function removefromlist(val) {

        toastr["warning"]("Removing Transaction From Voucher.");
        $('#transactiontable').find("tr.id").each(function (index) {
            if ($(this).hasClass(val)) {
                $(this).remove();
            }
        });
        
        calculateTotals();
        
        var transactiontypeid = $("#transactiontypeid option:selected").val();
        if(transactiontypeid === "Debit"){
            var tdebit = 0;
            $('#transactiontable tr').each(function (row, tr) {
                var td = $(tr).find('td:eq(10)').text();
                if (td != '' && td != "Debit") {
                    tdebit = tdebit + parseFloat(td);
                }
            });
          //  $('.credit').html(tdebit);
        } else{
            var tcredit = 0;
            $('#transactiontable tr').each(function (row, tr) {
                var tc = $(tr).find('td:eq(11)').text();
                if (tc != '' && tc != "Credit") {
                    tcredit = tcredit + parseFloat(tc);
                }
            });
          //  $('.debit').html(tcredit);
        }

        calculateTotals();
              
    }
    
    function autoremovefromlist(val) {
        
        $('#transactiontable').find("tr.id").each(function (index) {
            if ($(this).hasClass(val)) {
                $(this).remove();
            }
        });


    }
    function errormessage(val) {
        toastr["warning"]("Sorry! You can not remove..");
    }
    

    function add_transaction() {

        var tDebit = $('#tbltotals').find("td.totaldebit").html();
        var tCredit = $('#tbltotals').find("td.totalcredit").html();
       
        if(tDebit==0 || tCredit==0){
            
            toastr["error"]("Sorry! Transaction can not saved,Please check again.");
            return false;
        }
        
          var payment_method = '';
          if($("#cash").prop("checked", true)){
              payment_method = 'Cash';
          }
          if($("#bank").prop("checked", true)){
              payment_method = 'Bank';
          }
      
       
        if (tDebit == tCredit) {

            var voucher_date = $("#voucher_date").val();
            var voucher_type = $("#voucher_type option:selected").val();
            var voucher_desc = $("#voucher_desc").val();
            var instrument_no_for_session = $('#instumentno').val();


            var business_name_id = $("#business_name option:selected").val();
            var business_name = $("#business_name option:selected").text();
            var business_type = $("#business_type option:selected").text();
            var vstatus = $("#voucher_status option:selected").val();

            var TableData;
            TableData = storeOTblValues();
            if (TableData.length > 0) {
                toastr["warning"]("Processing New Transaction.", "Please wait..")
                $('#save_button').attr('disabled',true);
                TableData = TableData;
                $.ajax({
                    type: "POST",
                    url: "<?php echo $this->Url->build(['action' => 'add',0,$flag === 2 ? $paymentadvice[0]['id_payment_advice'] :0]); ?>",
                    dataType: 'json',
                    data: {
                        transactions : TableData,
                        voucher_date : voucher_date,
                        voucher_type : voucher_type,
                        voucher_desc : voucher_desc,
                        bn_name : business_name,
                        bn_id : business_name_id,
                        bn_type : business_type,
                        vs : vstatus,
                        instrument_no_for_session : instrument_no_for_session,
                        payment_method:payment_method
                    },
                    success: function (data) {
                        var result = data.msg.split("|");
                        if (result[0] === "Success") {
                            toastr.success(result[0], result[1]);
                            window.location.assign("<?php echo $this->Url->build(['controller' => 'AccountVoucher', 'action' => 'index']); ?>");
                            window.open("<?php echo $this->Url->build(['controller' => 'AccountVoucher', 'action' => 'view']); ?>/"+data.acount_voucher_id+"/1");
                        } else {
                            toastr.warning(result[0], result[1]);
                        }
                    }
                });
            } else {
                toastr["warning"]("Nothing Added", "Transaction");
            }
        } else {
            toastr["error"]("Voucher is not Balanced!", "Account Voucher Alert");
            swal({
                title: "Voucher Alert",
                text: "Voucher is not Balanced",
                type: "error",
                confirmButtonText: 'OK!'
            });
        }

    }

    function storeOTblValues()
    {
        var TableData = new Array();

        $('#transactiontable tr').each(function (row, tr) {
            TableData[row] = {
                "account_id": $(tr).find('td:eq(0)').text()
                , "account_no": $(tr).find('td:eq(1)').text()
                , "account_name": $(tr).find('td:eq(2)').text()
                , "paymentmode": $(tr).find('td:eq(3)').text()
                , "instrumentno": $(tr).find('td:eq(4)').text()
                , "costcentertype": $(tr).find('td:eq(5)').text()
                , "costcenter": $(tr).find('td:eq(6)').text()
                , "costcentertid": $(tr).find('td:eq(7)').text()
                , "amount": $(tr).find('td:eq(8)').text()
                , "remarks": $(tr).find('td:eq(9)').text()
                , "debit": $(tr).find('td:eq(10)').text()
                , "credit": $(tr).find('td:eq(11)').text()

            }
        });
        TableData.shift();  // first row will be empty - so remove
        return TableData;
    }
    ///   get center type
    function get_center_type() {
        var centertype = $("#cost_center_type option:selected").val();
        
        if($("#cost_center_type option:selected").text() == "Select"){
            $('#cost_center').html('');
            return false;
        }
        if(centertype === 'select'){
             return false;
        }
        
        $('#loadimage').show();
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'AccountVoucher', 'action' => 'getcentertype']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {ctype: centertype},
            success: function (data) {
                var mdata = data.data;
                if (mdata.length > 0) {
                    var html = '';
                    $('#cost_center').html('');
                    html += '<option value="select">Select</option>';
                    for (var x = 0; x < mdata.length; x++) {
                        
                        html += '<option  value="' + mdata[x].id + '">' + mdata[x].name + '</option>';
                    }
                    $('#cost_center').html(html);
                    var flag = '<?php  echo $flag; ?>';
                    if(flag === '2'){
                    $('#cost_center option:selected').val(17);
                    $('#cost_center option:selected').text('Head Office');
                    }
                } else {
                    $('#cost_center').html('');
                }
                $('#loadimage').hide();
            }
        });
    }
    
    function cget_center_type() {
        var centertype = $("#ccost_center_type option:selected").val();
        
        if($("#ccost_center_type option:selected").text() == "Select"){
            $('#ccost_center').html('');
            return false;
        }
        if(centertype === 'select'){
             return false;
        }
        
        $('#loadimage').show();
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'AccountVoucher', 'action' => 'getcentertype']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {ctype: centertype},
            success: function (data) {
                var mdata = data.data;
                if (mdata.length > 0) {
                    var html = '';
                    $('#ccost_center').html('');
                    html += '<option value="select">Select</option>';
                    for (var x = 0; x < mdata.length; x++) {
                        
                        html += '<option  value="' + mdata[x].id + '">' + mdata[x].name + '</option>';
                    }
                    $('#ccost_center').html(html);
                    var flag = '<?php  echo $flag; ?>';
                    if(flag === '2'){
                    $('#ccost_center option:selected').val(17);
                    $('#ccost_center option:selected').text('Head Office');
                    }
                } else {
                    $('#ccost_center').html('');
                }
                $('#loadimage').hide();
            }
        });
    }

    ///   get business type
    function get_business_type() {
        var bustype = $("#business_type option:selected").val();
        
        if(bustype == '0'){
            $('#business_name').html('<option value="0">Walk in Customer</option>');
            return false;
        }
        
        if(bustype == '100'){
            $('#business_name').html('<option value="100">Others</option>');
            return false;
        }

        
        if(bustype === 'select'){
             return false;
        }
        
        var tax_for = '';
        if(bustype === '1'){
            tax_for = 1;
        }else if(bustype === '2'){
             tax_for = 1;
        }
        
  
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'AccountVoucher', 'action' => 'getbusinesstype']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {bt: bustype, tax_id : tax_for},
            success: function (data) {
                var mdata = data.data;
                if (mdata.length > 0) {
                    var html = '';
                    $('#business_name').html('');
                    html += '<option value="select">Select</option>';
                    for (var x = 0; x < mdata.length; x++) {
                        html += '<option value="' + mdata[x].id + '" tax="'+ mdata[x].tax +'">' + mdata[x].name + ' ( Tax applied :  '+ mdata[x].tax +'% )</option>';
                    }
                    $('#business_name').html(html);
                } else {
                    $('#business_name').html('');
                }

            }
        });
    }


</script>
