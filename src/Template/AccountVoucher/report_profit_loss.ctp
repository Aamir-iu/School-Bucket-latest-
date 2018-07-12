<style>
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
                        <span>PROFIT & LOSS STATEMENT</span>
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
                                    </fieldset> 
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="portlet light">
                                    <?php if($data): foreach($data as $k1 => $v1): ?>
                                    
                                    <div class="row">
                                        <div class="col-xs-12 customBorder">
                                            <h3><?php echo $k1; ?></h3>
                                            
                                            <?php
                                            $sum = 0;
                                            $cash_rev = 0;
                                            $revenueSum = 0;
                                            $admin_expenses_sum = 0;
                                            
                                            foreach($v1 as $k2 => $v2): ?>
                                                
                                                <div class="row">
                                                    <div class="col-xs-11 col-xs-offset-1  customBorder">
                                                        <h4><?php echo $k2; ?></h4>
                                                        
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
                                                            
                                                            <div class="row">
                                                                <div class="col-xs-10 col-xs-offset-1 customBorder">
                                                                    <div class="row">
                                                                        <div class="col-xs-6">
                                                                            <h5><?php echo $k3; ?></h5>
                                                                            <?php if($i === 4 && $k2 === 'Cash'){ ?>
                                                                                <br><strong>Net Branches Collection</strong><br><br>
                                                                            <?php } ?>
                                                                            <?php if($i === count($v2) && $k2 === 'Cash'){ ?>
                                                                                <br><strong>Total Cash Revenue</strong>
                                                                            <?php } ?>
                                                                            <?php if($i === 2 && $k2 === 'Corporate'){ ?>
                                                                                <br><strong>Total Corporate Revenue</strong><br><br>
                                                                                <strong style="font-size: 18px;">Total Revenue</strong>
                                                                            <?php } ?>
                                                                            <?php if($i === 1 && $k2 === 'Cost of Goods'){ ?>
                                                                                <br><strong>Gross Profit</strong><br><br>
                                                                            <?php } ?>
                                                                            <?php if($i === count($v2) && $k2 === 'Admin. Expenses'){ ?>
                                                                                <br><strong>Total Admin Expenses</strong><br><br>
                                                                                <strong>Net Profit/(Loss)</strong><br><br>
                                                                            <?php } ?>
                                                                        </div>
                                                                    
                                                                        <?php foreach($v3 as $v4): ?> 
                                                                            <?php
                                                                            $array = explode('|', $v4);
                                                                            //$operator = $arr[1] === 'Add' ? '1' : '-1';
                                                                            $operator = 1;
                                                                            ?>
                                                                            <div class="col-xs-6 text-right">
                                                                                
                                                                                <h5<?php echo $k3 === 'Vendors' ? ' id="vendors"' : ''; ?>><?php echo $this->Number->precision($operator * $array['0'], 2); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                                                                                    
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
                                                                                
                                                                            </div>
                                                                        <?php endforeach; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        <?php $i++; endforeach; ?>
                                                    </div>
                                                </div>
                                                
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    
                                    <?php endforeach; endif; ?>
                                
                                    <div class="hidden" style="margin-top: 60px;">
                                        <p>Prepared by:__________ &nbsp; Verified by:__________ &nbsp; Approved by:__________ &nbsp; Received by:__________</p>
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

<script>
    
    $(document).ready(function(){
        
        var total_expenses = parseFloat($('#total_expenses').text().replace(/,/g, ''));
        var total_revenue = parseFloat($('#total_revenue').text().replace(/,/g, ''));
        var vendors = parseFloat($('#vendors').text().replace(/,/g, ''));
        var gross_profit = total_revenue - vendors;
        $('#gross_profit').text(Number(gross_profit).toLocaleString('en', {minimumFractionDigits: 2}));
        var net_profit = gross_profit - total_expenses;
        $('#net_profit').text(Number(net_profit).toLocaleString('en', {minimumFractionDigits: 2}));
        
    });
    
    function goBack() {
        window.history.back();
    } 

</script>    

