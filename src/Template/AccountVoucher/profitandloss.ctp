
<style>
    .customBorder{ }
    #total_expenses{
        border-bottom: 5px double #333;
    }
    #gross_profit{
        border-bottom: 5px double #333;
    }
    #net_profit{
        border-bottom: 5px double #333;
    }
</style>

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
                        <span>FINANCIAL STATEMENTS</span>
                    </span>
                    <span class="caption-helper"></span>
                </div>
                
                <div class="tools">
                    
                    <a href="#" class="fullscreen" data-original-title="" title=""></a>
                </div>
                
            </div>
            
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_0">
                        <div class="row"></div>
                        
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
                                                        <input type="text" id="fromdate" class="form-control form-filter input-sm" value="<?php echo isset($from) ? str_replace(' 00:00:00', '', $from) : ''; ?>" readonly name="fromdate" placeholder="From">
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
                                                        <input type="text" id="todate" class="form-control form-filter input-sm" value="<?php echo isset($to) ? str_replace(' 00:00:00', '', $to) : ''; ?>" readonly name="date_to" placeholder="To">
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
                                                        <option <?php echo isset($sub_account_from) && $sub_account_from == $account['id_sub_control_account'] ? 'selected' : ''; ?> value="<?= $account['id_sub_control_account']; ?>"><?= $account['mainaccountno'] . "-" . $account['controlaccountno'] . "-" . $account['subaccountno'] . " | " . $account['subaccountname']; ?></option>
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
                                                            <option <?php echo isset($sub_account_to) && $sub_account_to == $account['id_sub_control_account'] ? 'selected' : ''; ?> value="<?= $account['id_sub_control_account']; ?>"><?= $account['mainaccountno'] . "-" . $account['controlaccountno'] . "-" . $account['subaccountno'] . " | " . $account['subaccountname']; ?></option>
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
        </div>
    </div>
    
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <div class="panel panel-default">
            <div class="panel-heading">

                <div class="caption">
                    <i class="font-teal-500"></i>
                    <span class="caption-subject font-teal-500 bold uppercase">
                        <span>PROFIT & LOSS STATEMENT</span>
                    </span>
                    <span class="caption-helper"></span>
                    <div class="tools pull-right">
                    <?= $this->Html->link(__(''), ['controller' => 'AccountVoucher', 'action' => 'view',0,4,isset($from) ? str_replace(' 00:00:00', '', $from) : '',isset($to) ? str_replace(' 00:00:00', '', $to) : ''],['class'=>'fa fa-print hidden', 'target' => '_blank']) ?>
                    <input class="btn btn-xs btn-info" type="button" onclick="tableToExcel('tab_1', 'Profitandloss');" value="Export To Excel">
                    
                    </div>
                </div>

                
            </div>
           <div class="panel-body">


                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="row">

                        </div>
                         <!-- Start PnL  statement -->
                        <style>
                            table tr td, table tr th{
                                border-top: 0px !important;
                                padding: 0px !important;
                                border-spacing: 0px !important;
                                border-bottom: 0px !important;
                            }
                            @media only screen and (min-width: 500px) {
                                table tr .td2{
                                    padding-left: 85px !important;
                                }
                                table tr .td3{
                                    padding-left: 160px !important;
                                }
                                table tr .td4{
                                    padding-right: 80px !important;
                                }
                            }
                            @media print
                            {
                               .no-print {display: none;}
                            }
                            table{
/*                                padding: 10px !important;*/
                            }
                        </style>
                         <div class="row">
                             <div class="col-md-12">
                                 <div class="portlet light">
                                    <table class="table">
                                        <thead class="hidden">
                                        <th colspan="7"><h4>PROFIT & LOSS STATEMENT</h4></th>
                                        </thead>
                                        <tbody>
                                            <?php if($data): foreach($data as $k1 => $v1): ?>
                                            <tr>
                                                <td style="width: 10%"><h3><?php echo $k1; ?></h3></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <?php
                                                $sum = 0;
                                                $cash_rev = 0;
                                                $revenueSum = 0;
                                                $admin_expenses_sum = 0;

                                                foreach($v1 as $k2 => $v2): 
                                            ?>
                                            <tr>
                                                <td></td>
                                                <td style="width: 15%"><h4><?php echo $k2; ?></h4></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <?php 
                                                $array1 = array(); $array2 = array();

                                                foreach($v2 as $k3 => $v3):
                                                    if($k3 === 'Branches' || $k3 === 'Collection' || $k3 === 'Discount' || $k3 === 'Dues'){
                                                        $array1[$k3] = $v3;
                                                    } else{
                                                        $array2[$k3] = $v3;
                                                    }
                                                    $array3 = array_merge($array1, $array2);
                                                endforeach; 
                                            ?>
                                            <?php $i=1; foreach($array3 as $k3 => $v3): ?>
                                            <?php
                                                if($i <= 4 && $k2 === 'Cash'){
                                                    foreach($v3 as $v){
                                                        $arr = explode('|', $v);
                                                        //$operator = $arr[1] === 'Add' ? '1' : '-1';
                                                        $operator = 1;
                                                        $sum += $operator*$arr[0];
                                                    }
                                                }
                                            ?>

                                            <?php
                                            if($i < count($v2) && $i > 4 && $k2 === 'Cash'){
                                                foreach($v3 as $v){
                                                    $arr = explode('|', $v);
                                                    //$operator = $arr[1] === 'Add' ? '1' : '-1';
                                                    $operator = 1;
                                                    $cash_rev += $operator*$arr[0];
                                                }
                                            }
                                            ?>

                                            <?php
                                            if($k2 === 'Billing Income' || $k2 === 'Laboratory Income'){
                                                foreach($v3 as $v){
                                                    $arr = explode('|', $v);
                                                    //$operator = $arr[1] === 'Add' ? '1' : '-1';
                                                    $operator = 1;
                                                    $revenueSum += $operator*$arr[0];
                                                }
                                            }
                                            ?>

                                            <?php
                                            if($i < count($v2) && $k2 === 'Admin. Expenses'){
                                                foreach($v3 as $v){
                                                    $arr = explode('|', $v);
                                                    //$operator = $arr[1] === 'Add' ? '1' : '-1';
                                                    $operator = 1;
                                                    $admin_expenses_sum += $operator*$arr[0];
                                                }
                                            }
                                            ?>
                                                
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td >
                                                    <h5><?php echo $k3; ?></h5>
                                                    <?php if($i === 1 && $k2 === 'Cost of Goods'){ ?>
                                                        <br><strong>Gross Profit</strong><br><br>
                                                    <?php } ?>
                                                    <?php if($i === count($v2) && $k2 === 'Admin. Expenses'){ ?>
                                                        <br><strong>Total Admin Expenses</strong><br><br>
                                                        <strong>Net Profit/(Loss)</strong><br><br>
                                                    <?php } ?>
                                                </td>

                                                <td class="text-right">
                                                    <?php foreach($v3 as $v4): ?>
                                                    <?php
                                                    $array = explode('|', $v4);
                                                    //$operator = $arr[1] === 'Add' ? '1' : '-1';
                                                    $operator = 1;
                                                    ?>
                                                    <h5<?php echo $k3 === 'Vendors' ? ' id="vendors"' : ''; ?>><span><?php echo $this->Number->precision($operator * $array['0'], 2); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>

                                                    <?php if($i === 3 && $k2 === 'Laboratory Income'){ ?>
                                                    <span id="total_revenue" style="font-size: 18px; display: none;"><?php echo $this->Number->precision($revenueSum, 2); ?></span>
                                                    <?php } ?>

                                                    <?php if($i === 1 && $k2 === 'Cost of Goods'){ ?>
                                                    <br><strong id="gross_profit">0</strong><br>
                                                    <?php } ?>

                                                    <?php if($i === count($v2) && $k2 === 'Admin. Expenses'){ ?>
                                                    <br><strong id="total_expenses"><?php echo $this->Number->precision($admin_expenses_sum, 2); ?></strong><br><br>
                                                    <strong id="net_profit">0</strong>
                                                    <?php } ?>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td style="width:2%"></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                                
                                            <?php $i++; endforeach; ?>
                                            <?php endforeach; ?>
                                            <?php endforeach; endif; ?>
                                        </tbody>
                                    </table>
                                 </div>
                             </div>
                         </div>
                        
                        
                    </div>
                    
                </div>
            </div>
            <!-- end statement -->

       </div>
        <!--Tab Content End-->
    </div>
</div>


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

    $(document).ready(function(){
        
        $("#sub_account_from").select2();
        $("#sub_account_to").select2();

        var initPickers = function () {
            //init date pickers
            $('.date-picker').datepicker({
               // rtl: Backbones.isRTL(),
                autoclose: true
            });
        }
        initPickers();
        
        var total_expenses = parseFloat($('#total_expenses').text().replace(/,/g, ''));
        var total_revenue = parseFloat($('#total_revenue').text().replace(/,/g, ''));
        var vendors = parseFloat($('#vendors').text().replace(/,/g, ''));
        var gross_profit = total_revenue - vendors;
        
        console.log(total_revenue);
        console.log(vendors);
        console.log(gross_profit);
        
        $('#gross_profit').text(Number(gross_profit).toLocaleString('en', {minimumFractionDigits: 2}));
        var net_profit = gross_profit - total_expenses;
        $('#net_profit').text(Number(net_profit).toLocaleString('en', {minimumFractionDigits: 2}));
        
        $('#total_revenue').html('');
        
    });
    
    function storePL(){
        var fdate = $("#fromdate").val();
        var tdate = $("#todate").val();
        var net_profit = $("#net_profit").text();
        imageOverlay('.storePLBtn', 'show');
        
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'AccountVoucher', 'action' => 'storepl']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {
                fdate : fdate,
                tdate : tdate,
                net_profit : net_profit
            },
            success: function (data) {
                imageOverlay('.storePLBtn', 'hide');
                if(data.msg === 'success'){
                    toastr["success"]("Record has been successfully saved.", "Success!");
                } else{
                    toastr["error"]("Record has not been saved.", "Error!");
                }
            }
        });
    }
    
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

<script type="text/javascript">
    
        var tableToExcel = (function () {
          //  application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
            var uri = 'data:application/vnd.ms-excel;base64,'
              , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
              , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
              , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
            return function (table, name) {
                if (!table.nodeType) table = document.getElementById(table)
                var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }
                var link = document.createElement("a");
                
                var d = new Date();
                var datestring = ("0" + d.getDate()).slice(-2) + "-" + ("0"+(d.getMonth()+1)).slice(-2) + "-" +
    d.getFullYear() + " " + ("0" + d.getHours()).slice(-2) + ":" + ("0" + d.getMinutes()).slice(-2);
    
                link.download = "Profitandloss - " + datestring;
                link.href = uri + base64(format(template, ctx));
                link.click();
            }
        })()
        
</script>