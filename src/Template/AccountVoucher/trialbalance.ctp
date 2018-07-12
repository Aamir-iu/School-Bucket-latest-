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
                            <span>Trial Balance</span>
                        </span>
                        <span class="caption-helper"></span>
                        <?php 

                    if(isset($sub_account_from)){
                        $fdate = $sub_account_from;
                    }else{
                        $fdate = 0;
                    }

                    if(isset($sub_account_to)){
                        $tdate = $sub_account_to;
                    }else{
                        $tdate = 0;
                    }

                    ?>

                    <div class="tools pull-right">
                        <?= $this->Html->link(__(''), ['controller' => 'AccountVoucher', 'action' => 'view',0,3,isset($from) ? str_replace(' 00:00:00', '', $from) : '',isset($to) ? str_replace(' 00:00:00', '', $to) : '',$fdate,$tdate],['class' => 'fa fa-print hidden', 'target' => '_blank']) ?>
                        <input class="btn btn-xs btn-info" type="button" onclick="tableToExcel('datatable_mainaccounts', 'W3C Example Table')" value="Export To Excel">
                       
                        </a>

                    </div>
                    </div>
                    
                </div>
                <div class="portlet-body">


                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="row">

                            </div>
                            <!--End Top Section Tab 1-->
                            <!-- Trial Balance Details -->
                        </div>

                        <div class="portlet-body">
                            <div class="table-container">

                                <table class="table table-striped table-bordered table-hover" id="datatable_mainaccounts">
                                    <thead>
                                        <tr role="row" class="heading" style="border-bottom: 1px solid #ddd;">
                                            <th>Account #</th>
                                            <th>Title</th>
                                            <th colspan="2" style="text-align: center;">Opening Balance</th>
                                            <th colspan="2" style="text-align: center;">Current Balance</th>
                                            <th colspan="2" style="text-align: center;">Net Balance</th>
                                        </tr>
                                        <tr role="row" class="heading">
                                            <th colspan="2"></th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php

                                        $odebit = 0;
                                        $ocredit = 0;
                                        $cdebit = 0;
                                        $ccredit = 0;
                                        $ndebit = 0;
                                        $ncredit = 0;

                                        if($data){
                                            foreach($data as $key=>$row){
                                                //if((intval($row['odebit']) <> 0 || intval($row['ocredit']) <> 0) || (intval($row['cdebit']) <> 0 || intval($row['ccredit']) <> 0)){
                                        ?>
                                                <?php    foreach($row as $kesy2=>$value): ?>  
                                                <?php if((intval($value['ODEBIT']) <> 0 || intval($value['OCREDIT']) <> 0) || (intval($value['CDEBIT']) <> 0 || intval($value['CCREDIT']) <> 0)):  ?>
                                                    <tr>
                                                        <td><?php echo $kesy2; ?></td>
                                                        <td><?php echo $key; ?></td>
                                                        <td class="text-right"><?php echo $this->Number->precision($value['ODEBIT'], 2); ?></td>
                                                        <td class="text-right"><?php echo $this->Number->precision($value['OCREDIT'], 2); ?></td>
                                                        <td class="text-right"><?php echo $this->Number->precision($value['CDEBIT'], 2); ?></td>
                                                        <td class="text-right"><?php echo $this->Number->precision($value['CCREDIT'], 2); ?></td>
                                                        <td class="text-right"><?php echo $this->Number->precision($value['ODEBIT'] + $value['CDEBIT'], 2); ?></td>
                                                        <td class="text-right"><?php echo $this->Number->precision($value['OCREDIT'] + $value['CCREDIT'], 2); ?></td>
                                                    </tr>
                                                    <?php    
                                                        $odebit += $value['ODEBIT'];
                                                        $ocredit += $value['OCREDIT'];
                                                        $cdebit += $value['CDEBIT'];
                                                        $ccredit += $value['CCREDIT'];
                                                        $ndebit += $value['ODEBIT'] + $value['CDEBIT'];
                                                        $ncredit += $value['OCREDIT'] +  $value['CCREDIT'];

                                                    ?>
                                                <?php endif; ?> 
                                            <?php  endforeach; ?>        

                                        <?php
                                            }       
                                        } ?>

                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <th class="text-right"><?php echo $this->Number->precision($odebit, 2); ?></th>
                                            <th class="text-right"><?php echo $this->Number->precision($ocredit, 2); ?></th>
                                            <th class="text-right"><?php echo $this->Number->precision($cdebit, 2); ?></th>
                                            <th class="text-right"><?php echo $this->Number->precision($ccredit, 2); ?></th>
                                            <th class="text-right"><?php echo $this->Number->precision($ndebit, 2); ?></th>
                                            <th class="text-right"><?php echo $this->Number->precision($ncredit, 2); ?></th>
                                        </tr>
                                    </tfoot>

                                </table>
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

    function get_trialbalance() {
        var fdate = $("#fromdate").val();
        var tdate = $("#todate").val();
        var faccount = $("#sub_account_from").val();
        var taccount = $("#sub_account_to").val();
        $("#datatable_mainaccounts").dataTable().fnDestroy();
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'AccountVoucher', 'action' => 'gettrialblance']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {fdate: fdate, tdate: tdate, fac: faccount, tac: taccount},
            success: function (data) {
                var mdata = data.data;
                var mhtml = "";
                $("#datatable_mainaccounts tbody").html('');
                
                for (var x = 0; x < mdata.length; x++) {
                    mhtml += '<tr>';
                        mhtml += "<td>" + mdata[x]['account'] + "</td>";
                        mhtml += "<td>" + mdata[x]['sub_control_account_name'] + "</td>";
                        mhtml += "<td>" + mdata[x]['odebit'] + "</td>";
                        mhtml += "<td>" + mdata[x]['ocredit'] + "</td>";
                        mhtml += "<td>" + mdata[x]['cdebit'] + "</td>";
                        mhtml += "<td>" + mdata[x]['ccredit'] + "</td>";
                        mhtml += "<td>" + (parseFloat(mdata[x]['cdebit'])+parseFloat(mdata[x]['odebit'])) + "</td>";
                        mhtml += "<td>" + (parseFloat(mdata[x]['ccredit'])+parseFloat(mdata[x]['ocredit'])) + "</td>";
                    mhtml += '</tr>';
                }
                
                $("#datatable_mainaccounts tbody").append(mhtml);
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
   
    function calculateTotals() {
    
        $('table').each(function (){
            
            var table_id = $(this).attr('id');
            var tdebit = 0;
            var tcredit = 0;
            var balance = 0;
            
            $('#'+table_id+' tbody tr').each(function (row, tr) {
                
                var td = $(tr).find('td:eq(3)').text() === "" ? 0 : $(tr).find('td:eq(3)').text();
                var tc = $(tr).find('td:eq(4)').text() === "" ? 0 : $(tr).find('td:eq(4)').text();
                var blnc = $(tr).find('td:eq(5)').text() === "" ? 0 : $(tr).find('td:eq(5)').text();
                
                tdebit = tdebit + parseFloat(td);
                tcredit = tcredit + parseFloat(tc);
                balance = balance + parseFloat(blnc);
                
            });
            
            $('#'+table_id+' #totalDebits').html(tdebit.toFixed(2));
            $('#'+table_id+' #totalCredits').html(tcredit.toFixed(2));
            //$('#'+table_id+' #totalBalance').html(balance.toFixed(2));
            
        });

    }

</script>    

