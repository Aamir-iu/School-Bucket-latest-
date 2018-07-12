<!-- BEGIN PAGE LEVEL STYLES -->
<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">



<div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
       <div class="panel panel-default">
            <div class="panel-heading">

                <div class="caption">
                    <i class="font-teal-500"></i>
                    <span class="caption-subject font-teal-500 bold uppercase">
                        <span>Financial Statements</span>
                    </span>
                    <span class="caption-helper"></span>
                </div>

                <div class="tools">
                    <a href="#" class="fullscreen" data-original-title="" title="">
                    </a>

                </div>
            </div>
           <div class="panel-body">


                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="row">

                        </div>
                        <!--End Top Section Tab 1-->
                        <!-- Trial Balance Details -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="portlet light">
                                    <form class="form-horizontal form-body">   
                                        <fieldset>

                                            <div class="form-group">
                                                <label for="fromdate" class="col-sm-4 control-label">From Date</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                                        <input type="text" id="fromdate" class="form-control form-filter input-sm" readonly name="fromdate" placeholder="From">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>    

                                            <div class="form-group">
                                                <label for="todate" class="col-sm-4 control-label">To Date</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                                        <input type="text" id="todate" class="form-control form-filter input-sm" readonly name="date_to" placeholder="To">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>       
                                            <div class="form-group">
                                                <label for="sub_account_from" class="col-sm-4 control-label">From Acc.</label>
                                                <div class="col-sm-8">    
                                                    <select name="sub_account_from" id="sub_account_from" class="form-control form-filter input-sm">
                                                        <option value="">Select</option>
                                                        <?php foreach ($accounts as $account) { ?>
                                                            <option value="<?= $account['transaction_account_id']; ?>"><?= $account['mainaccountno'] . "-" . $account['controlaccountno'] . "-" . $account['subaccountno'] . " | " . $account['ta_title']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>   
                                            </div>
                                            <div class="form-group">
                                                <label for="sub_account_to" class="col-sm-4 control-label">To Acc.</label>
                                                <div class="col-sm-8"> 
                                                    <select name="sub_account_to" id="sub_account_to" class="form-control form-filter input-sm">
                                                        <option value="">Select</option>
                                                        <?php foreach ($accounts as $account) { ?>
                                                            <option value="<?= $account['transaction_account_id']; ?>"><?= $account['mainaccountno'] . "-" . $account['controlaccountno'] . "-" . $account['subaccountno'] . " | " . $account['ta_title']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>        

                                        </fieldset> 
                                    </form>      

                                </div>  
                            </div>


                            <div class="col-md-6">
                                <div class="portlet light">
                                    <div style="text-align:left;">
                                        <button  type="button"  onclick="trialbalance();"  id="search" class="btn btn-sm btn-success margin-bottom right-align"><i class="icon-magnifier"></i> Trial Balance</button>
                                        
                                        <button  type="button"   onclick="profitloss();" id="search" class="btn btn-sm btn-info margin-bottom right-align"><i class="icon-magnifier"></i> Profit & Loss Statement</button>
                                       
                                        <button  type="button"  onclick="balance_sheet();"  id="search" class="btn btn-sm btn-warning margin-bottom right-align"><i class="icon-magnifier"></i> Balance Sheet</button>
                                    </div>   
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
            <!-- end Trial Balance Details -->

            <!--Tab PO Details End-->

        </div>
        <!--Tab Content End-->
    </div>
</div>
<!--Portlet Body End-->
</div>
<!--</div>
</div>-->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>    
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
<?= $this->Html->script('datatable.js') ?> 

<script>

    $(document).ready(function () {
        
        $("#sub_account_from").select2();
        $("#sub_account_to").select2();

        var initPickers = function () {
            //init date pickers
            $('.date-picker').datepicker({
                autoclose: true
            });
        }
        
        initPickers();

    });

    function trialbalance() {

        var fdate = $("#fromdate").val();
        var tdate = $("#todate").val();
        var fac = $("#sub_account_from option:selected").val();
        var tac = $("#sub_account_to option:selected").val();
        
        if(fdate === '' || tdate === ''){
            toastr["error"]("Please select from date & to date first.", "Date range not selected!");
            return false;
        }
        
        if(fac !== '' && tac === ''){
            toastr["error"]("Please select from account & to account first.", "Accounts not selected!");
            return false;
        }
        
        if(fac === '' && tac !== ''){
            toastr["error"]("Please select from account & to account first.", "Accounts not selected!");
            return false;
        }
        
        toastr["info"]("Please wait", "Collecting Trial Balance");
        
        if(fdate !== "" && tac !== ""){
            window.location.assign("<?php echo $this->Url->build(['controller' => 'AccountVoucher', 'action' => 'gettrialblance']); ?>/" + fdate + "/" + tdate + "/" + fac + "/" + tac);
            return false;
        }
        
        if(fdate !== "" && tac === ""){
            window.location.assign("<?php echo $this->Url->build(['controller' => 'AccountVoucher', 'action' => 'gettrialblance']); ?>/" + fdate + "/" + tdate);
        }
        
    }
   
    function profitloss(){
         var fdate = $("#fromdate").val();
         var tdate = $("#todate").val();

         if(fdate === '' || tdate === ''){
             toastr["error"]("Please select from date & to date first.", "Date range not selected!");
             return false;
         }

          window.location.assign("<?php echo $this->Url->build(['controller' => 'AccountVoucher', 'action' => 'profitandloss']); ?>/" + fdate + "/" + tdate);

     }
    
    function balance_sheet(){
       var fdate = $("#fromdate").val();
       var tdate = $("#todate").val();

       if(fdate === '' || tdate === ''){
           toastr["error"]("Please select from date & to date first.", "Date range not selected!");
           return false;
       }

        window.location.assign("<?php echo $this->Url->build(['controller' => 'AccountVoucher', 'action' => 'balancesheet']); ?>/" + fdate + "/" + tdate);

   }
   
</script>    

