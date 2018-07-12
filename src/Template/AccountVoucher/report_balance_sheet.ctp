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
                        <span>Balance Sheet</span>
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
                <div class="row">
                    <div class="col-md-12">
                        <strong>From Date:</strong> <?php echo isset($from) ? str_replace(' 00:00:00', '', $from) : ''; ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>To Date:</strong> <?php echo isset($to) ? str_replace(' 00:00:00', '', $to) : ''; ?>
                        <br><br>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-bordered table-condensed">
                            <thead>
                                <tr>
                                    <th class="text-center">ASSETS</th>
                                    <th class="text-center">EQUITIES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <table class="table table-bordered table-condensed">
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
                                                                $operator = $array[1] === 'Add' ? '1' : '-1';

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
                                        <table class="table table-bordered table-condensed">
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
                                                                    $operator = $array[1] === 'Add' ? '1' : '-1';

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
<script>
    
    $(document).ready(function(){
        
        var total_long_term = parseFloat($('#total_long_term').text());
        var total_short_term = parseFloat($('#total_short_term').text());
        var total_drawing = parseFloat($('#total_drawing').text());
        var net_profit = parseFloat($('#net_profit').text());
        var net_capital = total_drawing + net_profit;
        var total_equities = net_capital + total_long_term + total_short_term;
        $('#net_capital').text(parseFloat(net_capital).toFixed(2));
        $('#total_equities').text(parseFloat(total_equities).toFixed(2));
        
    });
    
    function goBack() {
        window.history.back();
    } 

</script>    

