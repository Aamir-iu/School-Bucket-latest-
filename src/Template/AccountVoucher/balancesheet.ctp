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
                    <div class="tab-pane active" id="tab_1">
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
                                                        <option <?php echo isset($sub_account_from) && $sub_account_from == $account['transaction_account_id'] ? 'selected' : ''; ?> value="<?= $account['transaction_account_id']; ?>"><?= $account['mainaccountno'] . "-" . $account['controlaccountno'] . "-" . $account['subaccountno'] . " | " . $account['ta_title']; ?></option>
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
                                                            <option <?php echo isset($sub_account_to) && $sub_account_to == $account['transaction_account_id'] ? 'selected' : ''; ?> value="<?= $account['transaction_account_id']; ?>"><?= $account['mainaccountno'] . "-" . $account['controlaccountno'] . "-" . $account['subaccountno'] . " | " . $account['ta_title']; ?></option>
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
                                    <div class="portlet-body">
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
    </div>
    
    <div class="col-md-12">
        <!-- Begin: life time stats -->
       <div class="panel panel-default">
             <div class="panel-heading">

                <div class="caption">
                    <i class="font-teal-500"></i>
                    <span class="caption-subject font-teal-500 bold uppercase">
                        <span>Balance Sheet</span>
                    </span>
                    <span class="caption-helper"></span>
                    
                    <div class="tools pull-right">
                    <?= $this->Html->link(__(''), ['controller' => 'AccountVoucher', 'action' => 'view',0,5,isset($from) ? str_replace(' 00:00:00', '', $from) : '',isset($to) ? str_replace(' 00:00:00', '', $to) : ''],['class'=>'fa fa-print hidden', 'target' => '_blank']) ?>
                    <input class="btn btn-xs btn-info" type="button" onclick="tableToExcel('balanceTable', 'W3C Example Table')" value="Export To Excel">
                    
                    </div>
                    
                </div>

                
                
            </div>
            
             <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="row"></div>
                        
                         <!-- Start Balance Sheet -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet light">
                                    
                                    <table class="table table-bordered" id="balanceTable">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ASSETS</th>
                                                <th class="text-center">EQUITIES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <?php
                                                            $total_assets=0;
                                                            
                                                            if($Assets){
                                                                
                                                                foreach($Assets as $k1 => $v1){
                                                                    echo '<tr><td colspan="3"><strong><i>'.$k1.'</i></strong></td></tr>';
                                                                    
                                                                    $i=1;
                                                                    $total_current_assets=0;
                                                                    $total_fixed_assets=0;
                                                                    
                                                                    foreach($v1 as $k2 => $v2){
                                                                        echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$k2.'</td>';
                                                                        
                                                                        foreach($v2 as $v3){
                                                                            $array = explode('|', $v3);
                                                                            $value = $array[0];
                                                                            //$operator = $array[1] === 'Add' ? '1' : '-1';
                                                                            $operator = 1;
                                                                            if($k1 === 'Current Assets'){
                                                                                $total_current_assets += $operator*$value;
                                                                            }
                                                                            
                                                                            if($k1 === 'Fixed Assets'){
                                                                                $total_fixed_assets += $operator*$value;
                                                                            }
                                                                            
                                                                            echo '<td class="text-right">'.$this->Number->precision($operator*$value, 2).'</td><td>&nbsp;</td></tr>';
                                                                        }
                                                                        
                                                                        if($i === count($v1) && $k1 === 'Current Assets'){
                                                                            echo '<tr><td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Total Current Assets</strong></td><td class="text-right"><strong>'.$this->Number->precision($total_current_assets, 2).'</strong></td></tr>';
                                                                        }
                                                                        
                                                                        if($i === count($v1) && $k1 === 'Fixed Assets'){
                                                                            echo '<tr><td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Total Fixed Assets</strong></td><td class="text-right"><strong>'.$this->Number->precision($total_fixed_assets, 2).'</strong></td></tr>';
                                                                        }
                                                                        
                                                                        $i++;
                                                                    }
                                                                    
                                                                    $total_assets += $total_current_assets;
                                                                    $total_assets += $total_fixed_assets;
                                                                    
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <?php
                                                            if($Equities){
                                                                foreach($Equities as $k1 => $v1){
                                                                    echo '<tr><td colspan="3"><strong><i>'.$k1.'</i></strong></td></tr>';
                                                                    
                                                                    foreach($v1 as $k2 => $v2){
                                                                        echo '<tr><td colspan="3"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$k2.':</strong></td></tr>';
                                                                        
                                                                        $i=1;
                                                                        $total_long_term = 0;
                                                                        $total_short_term = 0;
                                                                        $total_drawing = 0;
                                                                        
                                                                        foreach($v2 as $k3 => $v3){
                                                                            echo '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$k3.'</td>';
                                                                            
                                                                            foreach($v3 as $v4){
                                                                                $array = explode('|', $v4);
                                                                                $value = $array[0];
                                                                               // $operator = $array[1] === 'Add' ? '1' : '-1';
                                                                                 $operator = 1;
                                                                                if($k2 === 'Long Term'){
                                                                                    $total_long_term += $operator*$value;
                                                                                }
                                                                                
                                                                                if($k2 === 'Short Term'){
                                                                                    $total_short_term += $operator*$value;
                                                                                }
                                                                                
                                                                                if($k2 === 'Drawing'){
                                                                                    $total_drawing += $operator*$value;
                                                                                }
                                                                                
                                                                                echo '<td class="text-right">'.$this->Number->precision($operator*$value, 2).'</td><td>&nbsp;</td></tr>';
                                                                            }
                                                                            
                                                                            if($k2 === 'Long Term'){
                                                                                echo '<tr><td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Total Long Term</strong></td><td class="text-right"><strong id="total_long_term">'.$this->Number->precision($total_long_term, 2).'</strong></td></tr>';
                                                                            }
                                                                            
                                                                            if($i === count($v2) && $k2 === 'Short Term'){
                                                                                echo '<tr><td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Total Short Term</strong></td><td class="text-right"><strong id="total_short_term">'.$this->Number->precision($total_short_term, 2).'</strong></td></tr>';
                                                                            }
                                                                            
                                                                            if($i === count($v2) && $k2 === 'Drawing'){
                                                                                echo '<tr><td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Total Drawing</strong></td><td class="text-right"><strong id="total_drawing">'.$this->Number->precision($total_drawing, 2).'</strong></td></tr>';
                                                                            }
                                                                            
                                                                            if($i === count($v2) && $k2 === 'Drawing'){
                                                                                echo '<tr><td colspan="3">&nbsp;</td></tr>';
                                                                                echo '<tr><td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Net Income</strong></td><td class="text-right"><strong id="net_profit">'.$this->Number->precision($net_profit, 2).'</strong></td></tr>';
                                                                            }
                                                                            
                                                                            if($i === count($v2) && $k2 === 'Drawing'){
                                                                                echo '<tr><td colspan="3">&nbsp;</td></tr>';
                                                                                echo '<tr><td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Net Capital</strong></td><td class="text-right"><strong id="net_capital">0</strong></td></tr>';
                                                                            }
                                                                            
                                                                            $i++;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>
                                                    <div class="pull-left">Total Assets</div>
                                                    <div class="pull-right"><?php echo $this->Number->precision($total_assets, 2); ?></div>
                                                </th>
                                                <th>
                                                    <div class="pull-left">Total Equities</div>
                                                    <div class="pull-right" id="total_equities">0</div>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>

       </div>
        <!--Tab Content End-->
    </div>
</div>
<!--Portlet Body End-->
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



<script type="text/javascript">
var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>
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
        
        var total_long_term = parseFloat($('#total_long_term').text());
        var total_short_term = parseFloat($('#total_short_term').text());
        var total_drawing = parseFloat($('#total_drawing').text());
        var net_profit = parseFloat($('#net_profit').text());
        var net_capital = total_drawing + net_profit;
        var total_equities = net_capital + total_long_term + total_short_term;
        $('#net_capital').text(parseFloat(net_capital).toFixed(2));
        $('#total_equities').text(parseFloat(total_equities).toFixed(2));
        
        
        
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
