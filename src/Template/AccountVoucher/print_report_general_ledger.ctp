<!-- END PAGE LEVEL STYLES -->
<div class="row">
    
    <div class="col-md-10">
        <!-- Begin: life time stats -->
        <div class="portlet light">
            <div class="portlet-title">
                <span style="display:block; position:relative; text-align:left; ">
                    <?php echo $this->Html->image('new_logo.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top']); ?>
                </span>
                <div class="caption">
                    <i class="font-teal-500"></i>
                    <span class="caption-subject font-teal-500 bold uppercase">
                        <span>General Ledger</span>
                    </span>
                    <span class="caption-helper"></span>
                </div>
                <div class="tools">
                    <a href="javascript:window.print()" class="fa fa-print hidden-xs hidden-sm" data-original-title="" title="Print"></a>
                    <a href="javascript:(0);" onclick="goBack()" class="fa fa-reply hidden" data-original-title="" title="Back">
                    </a>
                </div>
            </div>
            
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12">
                        <strong>From Date:</strong> <?php echo isset($from) ? str_replace(' 00:00:00', '', $from) : ''; ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>To Date:</strong> <?php echo isset($to) ? str_replace(' 00:00:00', '', $to) : ''; ?><br>
                        <strong>Cost Center:</strong> <?php echo $cost_center; ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Cost Center Type:</strong> <?php echo $cost_center_type; ?>
                        <br><br>
                    </div>
                    <div class="col-md-12" id="generalLedger">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
    $(document).ready(function () {
        generalledger();
    });
    
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
            
            $('#'+table_id+' #totalDebits').html((Number(tdebit).toLocaleString('en')));
            $('#'+table_id+' #totalCredits').html((Number(tcredit).toLocaleString('en')));
            //$('#'+table_id+' #totalBalance').html(balance.toFixed(2));
            
        });

    }
    
    function generalledger() {
        var fdate = '<?php echo isset($from) ? str_replace(' 00:00:00', '', $from) : ''; ?>';
        var tdate = '<?php echo isset($to) ? str_replace(' 00:00:00', '', $to) : ''; ?>';
        var faccount = '<?php echo isset($sub_account_from) ? $sub_account_from : ''; ?>';
        var taccount = '<?php echo isset($sub_account_to) ? $sub_account_to : ''; ?>';
        //var vstatus = $("#voucher_status option:selected").val();
        var cost_center_type = '<?php echo $cost_center; ?>';
        var costcenter = '<?php echo $cost_center_type; ?>';
        
        //imageOverlay('#glSearch', 'show');
        
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
                                            table += "<td class='text-right'>" + Number(details[x]['Debit']).toLocaleString('en').replace(/,/g, ''); + "</td>";
                                            table += "<td class='text-right'>" + Number(details[x]['Credit']).toLocaleString('en').replace(/,/g, ''); + "</td>";
                                            table += "<td class='text-right'>"+ Number(openingBalance).toLocaleString('en').replace(/,/g, ''); +"</td>";
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

                $("#generalLedger").html(table);
                
                calculateTotals();
                
                //imageOverlay('#glSearch', 'hide');
              
            }
        });
    }
    
</script>    