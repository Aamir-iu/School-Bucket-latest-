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
                        <span>TRIAL BALANCE</span>
                    </span>
                    <span class="caption-helper"></span>
                </div>
                <div class="tools">
                    <a href="javascript:window.print()" class="fa fa-print" data-original-title="" title="Print"></a>
                    <a href="javascript:(0);" onclick="goBack()" class="fa fa-reply hidden" data-original-title="" title="Back">
                    </a>
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
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-body form-horizontal form-bordered form-row-stripped">
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-xs-3">From Date:</label>
                                            <div class="col-md-9 col-xs-9">
                                                <input style="border:none;" class="form-control" type="text" readonly value='<?php echo isset($from) ? str_replace(' 00:00:00', '', $from) : ''; ?>'>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-xs-3">To Date:</label>
                                            <div class="col-md-9 col-xs-9">
                                                <input style="border:none;" class="form-control" type="text" readonly value='<?php echo isset($to) ? str_replace(' 00:00:00', '', $to) : ''; ?>'>
                                            </div>
                                        </div>
                                        <?php
                                        // for from account
                                        $account_id = isset($sub_account_from) ? $sub_account_from : 0;
                                        $key = array_search($account_id, array_column($accounts, 'id_sub_control_account'));
                                        if($key !== FALSE){
                                            $from_account = $accounts[$key]['mainaccountno'].'-'.$accounts[$key]['controlaccountno'].'-'.$accounts[$key]['subaccountno'].' | '.$accounts[$key]['subaccountname'];
                                        } else{
                                            $from_account = 'empty';
                                        }
                                        
                                        // for to account
                                        $account_id = isset($sub_account_to) ? $sub_account_to : 0;
                                        $key = array_search($account_id, array_column($accounts, 'id_sub_control_account'));
                                        if($key !== FALSE){
                                            $to_account = $accounts[$key]['mainaccountno'].'-'.$accounts[$key]['controlaccountno'].'-'.$accounts[$key]['subaccountno'].' | '.$accounts[$key]['subaccountname'];
                                        } else{
                                            $to_account = 'empty';
                                        }
                                        ?>
                                        <div class="form-group <?php echo $from_account === 'empty' ? 'hidden' : ''; ?>">
                                            <label class="control-label col-md-3 col-xs-3">From Acc.:</label>
                                            <div class="col-md-9 col-xs-9">
                                                <input style="border:none;" class="form-control" type="text" readonly value='<?php echo $from_account; ?>'>
                                            </div>
                                        </div>
                                        <div class="form-group <?php echo $to_account === 'empty' ? 'hidden' : ''; ?>">
                                            <label class="control-label col-md-3 col-xs-3">To Acc.:</label>
                                            <div class="col-md-9 col-xs-9">
                                                <input style="border:none;" class="form-control" type="text" readonly value='<?php echo $to_account; ?>'>
                                            </div>
                                        </div>
                                    </fieldset> 
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="table-container">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_mainaccounts">
                                        <thead>
                                            <tr role="row" style="border-bottom: 1px solid #ddd;">
                                                <th>Account #</th>
                                                <th>Title</th>
                                                <th colspan="2" style="text-align: center;">Opening Balance</th>
                                                <th colspan="2" style="text-align: center;">Current Balance</th>
                                                <th colspan="2" style="text-align: center;">Net Balance</th>
                                            </tr>
                                            <tr role="row">
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

<script>
    
    function goBack() {
        window.history.back();
    } 

</script>    

