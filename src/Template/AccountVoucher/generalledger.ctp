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
                        <span>General Ledger</span>
                    </span>
                    <span class="caption-helper"></span>
                    
                     <div class="tools pull-right hidden">
                        <a href="#" onclick="generalLedgerPrint();" class="fa fa-print" data-original-title="" title=""></a>
                        <a href="#" class="fullscreen" data-original-title="" title=""></a>
                    </div>
                    
                </div>

               
            </div>
            <div class="panel-body">


                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="row"></div>
                        <!--End Top Section Tab 1-->
                        <!-- Trial Balance Details -->
                        <div class="row" id="glSearch">
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
                                                            <option value="<?= $account['transaction_account_id']; ?>"><?= $account['mainaccountno'] . "-" . $account['controlaccountno'] . "-" . $account['subaccountno'] . " | " . $account['ta_no']. " | " . $account['ta_title']; ?></option>
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
                                                            <option value="<?= $account['transaction_account_id']; ?>"><?= $account['mainaccountno'] . "-" . $account['controlaccountno'] . "-" . $account['subaccountno'] . " | " . $account['ta_no']. " | " . $account['ta_title']; ?></option>
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
                                        <form class="form-horizontal form-body">   
                                            <fieldset>
<!--                                                <div class="form-group">
                                                    <label for="sub_account_to" class="col-sm-4 control-label">Voucher Status.</label>
                                                    <div class="col-sm-8"> 
                                                        <select name="voucher_status" id="voucher_status" class="form-control form-filter input-sm">
                                                            <option value=''>Select</option>
                                                            <option value="Posted">Posted</option>
                                                            <option value="Unposted">Unposted</option>
                                                            <option value="Cancelled">Cancelled</option>
                                                        </select>
                                                    </div>
                                                </div>-->
                                                
                                                 <div class="form-group">
                                                    <label class="control-label col-md-4">Cost Center Type:</label>
                                                    <div class="col-md-8">
                                                        <select  onchange="get_center_type();" id="cost_center_type" name="cost_center_type" class="form-control">
                                                            <option value="">Select</option>
                                                            <?php foreach ($cost_center_type as $cost_center_types): ?>    
                                                                <option value="<?php echo $cost_center_types->id_cost_center_type; ?>"><?php echo $cost_center_types->cost_center_type; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                

                                                <div class="form-group">
                                                    <label for="sub_account_to" class="col-sm-4 control-label">Cost Center.</label>

                                                    <div class="col-sm-8"> 
                                                        <select name="cost_center" id="cost_center" class="form-control form-filter input-sm">
                                                           
                                                        </select>
                                                    </div>

                                                </div>     



                                            </fieldset> 
                                            <div style="text-align: right;">
                                                <button onclick="generalledger();" type="button"  id="search" class="btn btn-sm btn-success margin-bottom right-align"><i class="fa fa-search"></i> Search</button>
                                            </div>  
                                        </form>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="portlet-body">
                        <div class="table-container" id="genledger">
                            <table class="table table-striped table-bordered table-hover" id="datatable_gltble">
                                <thead>
                                    <tr>
                                        <th colspan="2">Account Number: </th>
                                        <th colspan="4">Account Title: </th>
                                    </tr>
                                    <tr role="row" class="heading">
                                        <th>Date</th>
                                        <th>Voucher #</th>
                                        <th>Description</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr style="font-weight: bold;">
                                        <td colspan="3" style="text-align: right;">Summary</td>
                                        <td id="totalDebits"></td>
                                        <td id="totalCredits"></td>
                                        <td id="totalBalance"></td>
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

    var glDataTable = '';
    $(document).ready(function () {

        var initPickers = function () {
            //init date pickers
            $('.date-picker').datepicker({
               
                autoclose: true
            });
        }
        initPickers();
        gldata();
    });

   function search_record(){
       gldata();
     
    }
    var gldata = function () {
        if($.fn.DataTable.isDataTable("#datatable_vouchers")){ 
            $("#datatable_vouchers").dataTable().fnDestroy();
         }
 
        var theTable = $('#datatable_vouchers').DataTable({
           
                //"dom": '<"top"i>rt<"bottom"flp><"clear">',
                'bFilter': false,
                'responsive': true,
                'processing': true,
                'serverSide': true,
                "error": false,
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "stateSave": true,
                "ajax": {
                    type: "POST",
                    url: "<?php echo $this->Url->build(['controller' => 'AccountVoucher', 'action' => 'getvoucherbysearch']); ?>",
                    dataType: 'json',
                    cache: false,
                    async: false,
                    "data": function ( d ) {
                        d.voucher_status = $('#voucher_status option:selected').val();
                        d.payment_mode = $('#payment_mode option:selected').val();
                        d.sub_account_from = $('#sub_account_from option:selected').val();
                        d.sub_account_to = $('#sub_account_to option:selected').val();
                        
                        d.voucher_id = $('#voucher_id').val();
                        d.voucher_id = $('#voucher_id').val();
                        d.instrument_no = $('#instrument_no').val();
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                        d.cost_center = $('#cost_center').val();
                        
                    }
                },
                "oLanguage": {
                 "sProcessing": ''
               },
                "columnDefs": [{ // define columns sorting options(by default all columns are sortable extept the first checkbox column)
                    'orderable': false,
                    'targets': [0]
                    
                }],
                    
                "order": [
                    [1, "asc"]
                ], // set first column as a default sort by asc
                "columns": [
                        {"data": "id_account_voucher"},
                        {"data": "voucher_number"},
                        {"data": "voucher_date_created"},
                        {"data": "voucher_dated"},
                        {"data": "center_name"},
                        {"data": "debit", render: $.fn.dataTable.render.number( ',', '.', 0 )},
                        {"data": "credit", render: $.fn.dataTable.render.number( ',', '.', 0 )},
                        {"data": "actions"}
                    ],
                    "columnDefs": [
                        {
                            "sortable": false,
                            "targets": 5
                        },{
                            "className": 'text-right',
                            "targets": 5
                        },{
                            "className": 'text-right',
                            "targets": 4
                        }
                    ]
                    
        });
        
   } 
    
    function generalLedgerPrint(){
        
        var fdate = $("#fromdate").val();
        var tdate = $("#todate").val();
        //console.log(fdate); return false;
        var faccount = $("#sub_account_from").val();
        var taccount = $("#sub_account_to").val();
        
        //var vstatus = $("#voucher_status option:selected").val();
        
        var cost_center_type = $("#cost_center_type option:selected").text() === 'Select' ? '' : $("#cost_center_type option:selected").text();
        var costcenter = $("#cost_center option:selected").text() === 'Select' ? '' : $("#cost_center option:selected").text();
        
        if(fdate === '' || tdate === ''){
            swal({
                title: "Please select a date range!",
                text: "",
                type: "error",
                confirmButtonText: 'OK!'
            });
            return false;
        }
        
        if(costcenter === ''){
          costcenter = '0';  
          cost_center_type = '0';
        }
          
          
        
//        if(costcenter === ''){
//            swal({
//                title: "Please select a Cost Center!",
//                text: "",
//                type: "error",
//                confirmButtonText: 'OK!'
//            });
//            return false;
//        }
        
        window.open("<?php echo $this->Url->build(['controller' => 'AccountVoucher', 'action' => 'view']); ?>/0/6/"+fdate+"/"+tdate+"/"+cost_center_type+"/"+costcenter+"/"+faccount+"/"+taccount);
        //window.location.href = "<?php echo $this->Url->build(['controller' => 'AccountVoucher', 'action' => 'view']); ?>/0/6/"+fdate+"/"+tdate+"/"+cost_center_type+"/"+costcenter+"/"+faccount+"/"+taccount;
    }

    function generalledger() {
        var fdate = $("#fromdate").val();
        var tdate = $("#todate").val();
        var faccount = $("#sub_account_from").val();
        var taccount = $("#sub_account_to").val();
        //var vstatus = $("#voucher_status option:selected").val();
        var cost_center_type = $("#cost_center_type option:selected").text() === 'Select' ? '' : $("#cost_center_type option:selected").text();
        var costcenter = $("#cost_center option:selected").text() === 'Select' ? '' : $("#cost_center option:selected").text();
        
        if(fdate === '' || tdate === ''){
            swal({
                title: "Please select a date range!",
                text: "",
                type: "error",
                confirmButtonText: 'OK!'
            });
            return false;
        }
        
//        if(costcenter === ''){
//            swal({
//                title: "Please select a Cost Center!",
//                text: "",
//                type: "error",
//                confirmButtonText: 'OK!'
//            });
//            return false;
//        }
      
        //$("#datatable_gltble").dataTable().fnDestroy();
        
        imageOverlay('#glSearch', 'show');
        
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'AccountVoucher', 'action' => 'getgeneralledgerdetails']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {fdate: fdate, tdate: tdate, fac: faccount, tac: taccount, cc: costcenter,cct:cost_center_type},
            success: function (data) {
                var mdata = data.data;
                //var mhtml = "";
                //mhtml += '<tr><td colspan="8" class="text-right">'+ data.opning_balance +'</td></tr>';
                //var openingBalance = 0;
                var table = '';
                
                //console.log(mdata);
                
                $.each(mdata, function(account){
                    
                    $.each(mdata[account], function(account_number){
                    
                        table += '<table class="table table-striped table-bordered table-hover" id="'+ account_number +'">';

                            table += '<thead>';
                                table += '<tr>';
                                    table += '<th colspan="2">Account Number: '+ account_number +'</th>';
                                    table += '<th colspan="4">Account Title: '+ account +'</th>';
                                table += '</tr>';
                                table += '<tr role="row" class="heading">';
                                    table += '<th>Date</th>';
                                    table += '<th>Voucher #</th>';
                                    table += '<th>Description</th>';
                                    table += '<th>Debit</th>';
                                    table += '<th>Credit</th>';
                                    table += '<th>Balance</th>';
                                table += '</tr>';
                            table += '</thead>';

                            table += '<tbody>';
                            
                                $.each(mdata[account][account_number]['opning'], function(ob){
                                    
                                    table += '<tr><td colspan="6" class="text-right">Opening Balance: '+ ob +'</td></tr>';
                                    
                                    var details = mdata[account][account_number]['opning'][ob]['details'];
                                    
                                    if(details.length > 0){
                                        
                                        var openingBalance = 0;
                                        
                                        for (var x = 0; x < details.length; x++) {
                                            
                                            openingBalance += parseFloat(ob) + parseFloat(details[x]['Debit']) - parseFloat(details[x]['Credit']);
                                          
                                            table += '<tr>';
                                            table += "<td>" + details[x]['date'] + "</td>";
                                            table += "<td>" + details[x]['voucher_number'] + "</td>";
                                            table += "<td>" + details[x]['remarks'] + "</td>";
                                            table += "<td class='text-right'>" + Number(details[x]['Debit']).toLocaleString('en') + "</td>";
                                            table += "<td class='text-right'>" + Number(details[x]['Credit']).toLocaleString('en') + "</td>";
                                            table += "<td class='text-right'>"+ Number(openingBalance).toLocaleString('en') +"</td>";
                                            table += '</tr>';
                                            
                                        }
                                        
                                    }
                                    
                                });
                                
                            table += '</tbody>';

                            table += '<tfoot>';
                                table += '<tr style="font-weight: bold;">';
                                    table += '<td colspan="3" style="text-align: right;">Summary</td>';
                                    table += '<td class="text-right" id="totalDebits"></td>';
                                    table += '<td class="text-right" id="totalCredits"></td>';
                                    table += '<td class="text-right" id="totalBalance"></td>';
                                table += '</tr>';
                            table += '</tfoot>';

                        table += '</table>';
                        
                    });
                    
                });

                $("#genledger").html(table);
                
                calculateTotals();
                
                imageOverlay('#glSearch', 'hide');
              
            }
        });
    }

    function calculateTotals() {
    
        $('table').each(function (){
            
            var table_id = $(this).attr('id');
            var tdebit = 0;
            var tcredit = 0;
            var balance = 0;
            
            $('#'+table_id+' tbody tr').each(function (row, tr) {
                
                var td = $(tr).find('td:eq(3)').text() === "" ? 0 : $(tr).find('td:eq(3)').text().replace(/,/g, '');
                var tc = $(tr).find('td:eq(4)').text() === "" ? 0 : $(tr).find('td:eq(4)').text().replace(/,/g, '');
                var blnc = $(tr).find('td:eq(5)').text() === "" ? 0 : $(tr).find('td:eq(5)').text().replace(/,/g, '');
                
                tdebit = tdebit + parseFloat(td);
                tcredit = tcredit + parseFloat(tc);
                balance = balance + parseFloat(blnc);
                
            });
            
            $('#'+table_id+' #totalDebits').html(tdebit.toFixed(2));
            $('#'+table_id+' #totalCredits').html(tcredit.toFixed(2));
            //$('#'+table_id+' #totalBalance').html(balance.toFixed(2));
            
        });

    }
        
        
       



    $(document).ready(function () {
        $("#sub_account_from").select2();
    });

    $(document).ready(function () {
        $("#sub_account_to").select2();
    });


     ///   get center type
    function get_center_type() {
        var centertype = $("#cost_center_type option:selected").val();
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
                        html += '<option value="' + mdata[x].id + '">' + mdata[x].name + '</option>';
                    }
                    $('#cost_center').html(html);
                } else {
                    $('#cost_center').html('');
                }
                $('#loadimage').hide();
            }
        });
    }




</script>    

