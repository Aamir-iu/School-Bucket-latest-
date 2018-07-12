
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
            <span style="display:block; position:relative; text-align:left; ">
                
               <?php if($this->request->session()->read('Info.full_logo') === 'No'): ?>
                
                    <?php //echo $this->Html->image('logo.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top;width:50px;']); ?>
                     <span style="line-height:32px; font-size:30px; font-weight: bold; color:#EF4836 !important; vertical-align: top"><?php  echo $this->request->session()->read('Info.school'); ?></span>
                     <span style=" display: inline-block;  position: relative;  left: 6px;  top: 0px;  width: 1px;  height: 41px;  background: #00bcd4 !important;"></span>
                     <span style=" position: relative;  display: inline-block;  font: 500 15px/15px 'asap', sans-serif;  letter-spacing: -0.025em;  color: #00bcd4 !important;  left: 6px;  top: -4px; text-align: left"><span style="display:block;">Address : <?php  echo $this->request->session()->read('Info.address'); ?><br/>Phone :<?php  echo $this->request->session()->read('Info.phone'); ?></span></span>
                <?php else: ?>     
               <?php //echo $this->Html->image('logo2.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top;width:100%;']); ?>
                     
               <?php endif; ?>       
                     
            </span> 
            
            
         
          <div class="tools pull-right">
                    <a href="javascript:window.print()" class="fa fa-print hidden-xs hidden-sm" data-original-title="" title="Print">
                    </a>
                    <a href="javascript:(0);" onclick="goBack()" class="fa fa-reply hidden-xs hidden-sm" data-original-title="" title="Back">
                    </a>
          </div>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
     <?php if($cash_register[0]){ $cash = $cash_register[0]; } ?>
 <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <address>
          <strong>User Details</strong><br>
          <?php echo "User Name : ".$cash['user']; ?><br>
          <?php echo "Date : ". date('d-M-Y', strtotime($cash['cash_register_date'])); ?><br>
          
        </address>
      </div>
     
     
    </div>
    <!-- /.row -->
                
        <div class="row">

            <center><strong>Daily Cash Count</strong></center>

            <br>
           
            <div class="col-xs-6">
                <table class="table table-bordered">
                    <tbody>
<!--                        <tr>
                            <td style="width: 100px;">Yesterday's Till Amount</td>
                            <td colspan="2" style="width: 100px; padding-top: 20px;">
                                Rs. <strong id="yesterday_till">0.00</strong>
                            </td>
                        </tr>-->
                        <tr>
                            <td style="width: 100px;">Rs. 5000</td>
                            <td style="width: 100px;"><input type="text" readonly disabled="disabled" onblur="addZero($(this));" onfocus="removeZero($(this));" onkeyup="updateCashRegister($(this));" id="5000" value="<?php if($cash){ echo $cash['x5000']; }; ?>" class="form-control numeric input-sm"></td>
                            <td>Rs. <span id="x5000">0.00</span></td>
                        </tr>
                        <tr>
                            <td>Rs. 1000</td>
                            <td><input type="text" onblur="addZero($(this));" readonly disabled="disabled" onfocus="removeZero($(this));" onkeyup="updateCashRegister($(this));" id="1000" value="<?php if($cash){ echo $cash['x1000']; }; ?>" class="form-control numeric input-sm"></td>
                            <td>Rs. <span id="x1000">0.00</span></td>
                        </tr>
                        <tr>
                            <td>Rs. 500</td>
                            <td><input type="text" onblur="addZero($(this));" readonly disabled="disabled" onfocus="removeZero($(this));" onkeyup="updateCashRegister($(this));" id="500" value="<?php if($cash){ echo $cash['x500']; }; ?>" class="form-control numeric input-sm"></td>
                            <td>Rs. <span id="x500">0.00</span></td>
                        </tr>
                        <tr>
                            <td>Rs. 100</td>
                            <td><input type="text" onblur="addZero($(this));" readonly disabled="disabled" onfocus="removeZero($(this));" onkeyup="updateCashRegister($(this));" id="100" value="<?php if($cash){ echo $cash['x100']; }; ?>" class="form-control numeric input-sm"></td>
                            <td>Rs. <span id="x100">0.00</span></td>
                        </tr>
                        <tr>
                            <td>Rs. 50</td>
                            <td><input type="text" onblur="addZero($(this));" readonly disabled="disabled" onfocus="removeZero($(this));" onkeyup="updateCashRegister($(this));" id="50" value="<?php if($cash){ echo $cash['x50']; }; ?>" class="form-control numeric input-sm"></td>
                            <td>Rs. <span id="x50">0.00</span></td>
                        </tr>
                        <tr>
                            <td>Rs. 20</td>
                            <td><input type="text" onblur="addZero($(this));" readonly disabled="disabled" onfocus="removeZero($(this));" onkeyup="updateCashRegister($(this));" id="20" value="<?php if($cash){ echo $cash['x20']; }; ?>" class="form-control numeric input-sm"></td>
                            <td>Rs. <span id="x20">0.00</span></td>
                        </tr>
                        <tr>
                            <td>Rs. 10</td>
                            <td><input type="text" onblur="addZero($(this));" readonly disabled="disabled" onfocus="removeZero($(this));" onkeyup="updateCashRegister($(this));" id="10" value="<?php if($cash){ echo $cash['x10']; }; ?>" class="form-control numeric input-sm"></td>
                            <td>Rs. <span id="x10">0.00</span></td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Grand total</b></td>
                            <td>Rs. <strong id="totalGrand">0.00</strong></td>
                        </tr>
<!--                        <tr>
                            <td>Tomorrow's Till Amount</td>
                            <td colspan="2" style="padding-top: 13px;"><input style="width: 50%; font-weight: bold;" type="text" id="today_till" class="form-control numeric input-sm" placeholder="Rs. 0"></td>
                        </tr>-->
                    </tbody>
                </table>
            </div>

            <div class="col-xs-6">
                <table class="table table-bordered" id="cash_register_1">
                    <tbody>
                        <?php $payments=0; foreach($data as $index=>$value): ?>
                        <tr>
                          <?php if($value): ?>  
                            <td><?= $index; ?></td>
                            <td>Rs.<?= $value; ?></td
                            <?php $payments +=$value;  ?>
                           <?php endif; ?>    
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                           <td><b>Received Payments</b></td>
                           <td><b>Rs.<?= $payments ?></b></td>
                        </tr>
                        
                        
                        <?php $exp =0; foreach($expanse  as $row): ?>
                        <tr>
                            <td><?= $row['ta_name']; ?> : <?= $row['expanse_desc']; ?></td>
                            <td>Rs.<?= $row['amount']; ?></td
                            <?php $exp +=$row['amount'];  ?>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                           <td><b>Expanse Payments</b></td>
                           <td><b>Rs.<?= $exp ?></b></td>
                        </tr>
                        
                        <tr>
                            <td class="text-success"><b>Cash In Hand</b> <small>(after Expenses)</small></td>
                            <td class='text-success'><b>Rs. <strong id='totalCash'><?= $payments-$exp; ?></strong></b></td>
                        </tr>
                        
                        
                    </tbody>
                </table>
            </div>

            <div class="col-lg-12">
                <div style="text-align: center;">

                   <b>Difference:</b> Rs. <strong id="totalDifference"></strong> 
<!--                   <b>Including Yesterday's Till: Rs. <span id="totalTillDifference"></span></b>-->
                </div>
               
            </div>

            

        </div>
                
     
   
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<script>
  
   $(document).ready(function(){
     var x5000 = parseInt($('#5000').val()) * parseInt($('#5000').attr('id'));
        $('#x5000').html(parseFloat(x5000).toFixed(2));
        var x1000 = parseInt($('#1000').val()) * parseInt($('#1000').attr('id'));
        $('#x1000').html(parseFloat(x1000).toFixed(2));
        var x500 = parseInt($('#500').val()) * parseInt($('#500').attr('id'));
        $('#x500').html(parseFloat(x500).toFixed(2));
        var x100 = parseInt($('#100').val()) * parseInt($('#100').attr('id'));
        $('#x100').html(parseFloat(x100).toFixed(2));
        var x50 = parseInt($('#50').val()) * parseInt($('#50').attr('id'));
        $('#x50').html(parseFloat(x50).toFixed(2));
        var x20 = parseInt($('#20').val()) * parseInt($('#20').attr('id'));
        $('#x20').html(parseFloat(x20).toFixed(2));
        var x10 = parseInt($('#10').val()) * parseInt($('#10').attr('id'));
        $('#x10').html(parseFloat(x10).toFixed(2));
        
//        var total_sum = x5000 + x1000 + x500 + x100 + x50 + x20 + x10 + parseInt($('#yesterday_till').text());
        var total_sum = x5000 + x1000 + x500 + x100 + x50 + x20 + x10;
        
        $('#totalGrand').html(parseFloat(total_sum).toFixed(2));
        
        var totalGrand = parseInt($('#totalGrand').html());
        var totalCash = parseInt($('#totalCash').html());
        var totalDifference = totalGrand - totalCash;
        var totalTillDifference = totalGrand - (totalCash);  // + parseInt($('#yesterday_till').text())
        //console.log(totalCash);
        if(totalDifference === 0){
            $('#totalDifference').css('color', '#797979');
            $('#totalDifference').html(parseFloat(totalDifference).toFixed(2));
           
        } else if(totalDifference > 0){
            $('#totalDifference').css('color', 'green');
            $('#totalDifference').html(parseFloat(totalDifference).toFixed(2));
        } else{
            $('#totalDifference').css('color', 'red');
            $('#totalDifference').html(parseFloat(totalDifference).toFixed(2));
        }
        
        if(totalTillDifference === 0){
            $('#totalTillDifference').css('color', '#797979');
            $('#totalTillDifference').html(parseFloat(totalTillDifference).toFixed(2));
            
        } else if(totalTillDifference > 0){
            $('#totalTillDifference').css('color', 'green');
            $('#totalTillDifference').html(parseFloat(totalTillDifference).toFixed(2));
        } else{
            $('#totalTillDifference').css('color', 'red');
            $('#totalTillDifference').html(parseFloat(totalTillDifference).toFixed(2));
        }
    });
   
  function goBack() {
    window.history.back();
  }  
  
   
    
</script>    