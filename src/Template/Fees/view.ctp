<?php if(!empty($data)){ $details = $data[0]; } else {$details = 0 ;} ?>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    
      
      
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
            <span style="display:block; position:relative; text-align:left; ">
                
               <?php if($this->request->session()->read('Info.full_logo') === 'No'): ?>
                
                    <?php echo $this->Html->image('logo.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top;width:50px;']); ?>
                     <span style="line-height:32px; font-size:30px; font-weight: bold; color:#EF4836 !important; vertical-align: top"><?php  echo $this->request->session()->read('Info.school'); ?></span>
                     <span style=" display: inline-block;  position: relative;  left: 6px;  top: 0px;  width: 1px;  height: 41px;  background: #00bcd4 !important;"></span>
                     <span style=" position: relative;  display: inline-block;  font: 500 15px/15px 'asap', sans-serif;  letter-spacing: -0.025em;  color: #00bcd4 !important;  left: 6px;  top: -4px; text-align: left"><span style="display:block;">Address : <?php  echo $this->request->session()->read('Info.address'); ?><br/>Phone :<?php  echo $this->request->session()->read('Info.phone'); ?></span></span>
                <?php else: ?>     
               <?php echo $this->Html->image('logo2.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top;width:100%;']); ?>
                     
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
    
    
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <address>
          <strong>Personal Details</strong><br>
          <?php echo "ID : ". $details['reg_id']; ?><br>
          <?php echo "Student's Name : ". $details['name']; ?><br>
          <?php echo "Father's Name : ". $details['fname']; ?><br>
         <?php echo "Campus : ". $details['campus']; ?>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
          <address>
          <strong>Status</strong><br>
          <?php echo "Class : ". $details['class']; ?><br>
          <?php echo "Shift : ". $details['shift']; ?><br>
          <?php echo "Session : ". $details['session']; ?><br>
        
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Invoice #<?php echo $details['inv_no']; ?></b><br>
        <b>Date:</b> <?php echo $details['fee_date']; ?><br>
        <b>Payment Mode:</b> <?php echo $details['payment_mode']; ?><br>
        <b>Received By :</b> <?php echo $details['user_name']; ?>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
                <th>Fee Month</th>
                <th>Year</th>
                <th>Fee Head</th>
                <th>Sub Total</th>
                <th>Paid Amount</th>
                <th>Balance</th>
          </tr>
          </thead>
          <tbody>
         <?php $g_total = 0; $paid = 0; $balance = 0; foreach($data as $row): ?>     
          <tr>
                <td><?php echo $row['month_id'];  ?> </td>
                <td><?php echo $row['year'];  ?> </td>
                <td><?php echo $row['type_id'];  ?> </td>
                <td><?php echo $this->Number->precision($row['sub_total'],2);  ?> </td>
                <td><?php echo $this->Number->precision($row['amount'],2);  ?> </td>
                <td><?php echo $this->Number->precision($row['sub_total']-$row['amount'],2);  ?> </td>
                
                <?php  $g_total += $row['sub_total'];  ?>
                <?php  $paid += $row['amount'];  ?>
                <?php  $balance += $row['sub_total']-$row['amount'];  ?>
          </tr>
         <?php endforeach; ?>
          
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
          <strong> Amount In words :  <?php echo $this->AmountToWords->convert_number_to_words($paid)." only"; ?></strong>
              
        <p class="lead">Note:</p>
        
        <?php  if($details['status'] == 1): ?>
        
            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
              Thank you for submitting the fee.
            </p>
            
        <?php endif; ?>
            
        <?php  if($details['status'] == 0): ?>
            <?php  $temp = explode(':',$details['remarks']);  ?>
            <p class="text-muted well well-sm no-shadow alert alert-danger" style="margin-top: 10px;">
              This invoice Cancelled by <?php echo $temp[1]; ?> 
            </p>
            <strong>Reason :</strong>
             <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
              <?php echo rtrim($temp[0],'Cancelled By'); ?> 
            </p>
            
        <?php endif; ?>    
            
            
            
        
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
       
        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Grand Total:</th>
              <td><?php  echo $this->Number->precision($g_total,2); ?></td>
            </tr>
            <tr>
              <th>Received Amount</th>
              <td><?php  echo $this->Number->precision($paid,2); ?></td>
            </tr>
            <tr>
              <th>Balance Amount:</th>
              <td><?php echo $this->Number->precision($balance,2); ?></td>
            </tr>
            <tr>
              <th>Returned Amount:</th>
              <td><?php echo $this->Number->precision($details['retruned_amount'],2); ?></td>
            </tr>
            
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    
    <?php if($this->request->session()->read('Info.fee_slip') == 'double'):  ?>
    
    <br >
     <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
            <span style="display:block; position:relative; text-align:left; ">
                
               <?php if($this->request->session()->read('Info.full_logo') === 'No'): ?>
                
                    <?php echo $this->Html->image('logo.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top;width:50px;']); ?>
                     <span style="line-height:32px; font-size:30px; font-weight: bold; color:#EF4836 !important; vertical-align: top"><?php  echo $this->request->session()->read('Info.school'); ?></span>
                     <span style=" display: inline-block;  position: relative;  left: 6px;  top: 0px;  width: 1px;  height: 41px;  background: #00bcd4 !important;"></span>
                     <span style=" position: relative;  display: inline-block;  font: 500 15px/15px 'asap', sans-serif;  letter-spacing: -0.025em;  color: #00bcd4 !important;  left: 6px;  top: -4px; text-align: left"><span style="display:block;">Address : <?php  echo $this->request->session()->read('Info.address'); ?><br/>Phone :<?php  echo $this->request->session()->read('Info.phone'); ?></span></span>
                <?php else: ?>     
               <?php echo $this->Html->image('logo2.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top;width:100%;']); ?>
                     
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
    
    
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <address>
          <strong>Personal Details</strong><br>
          <?php echo "ID : ". $details['reg_id']; ?><br>
          <?php echo "Student's Name : ". $details['name']; ?><br>
          <?php echo "Father's Name : ". $details['fname']; ?><br>
         <?php echo "Campus : ". $details['campus']; ?>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
          <address>
          <strong>Status</strong><br>
          <?php echo "Class : ". $details['class']; ?><br>
          <?php echo "Shift : ". $details['shift']; ?><br>
          <?php echo "Session : ". $details['session']; ?><br>
        
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Invoice #<?php echo $details['inv_no']; ?></b><br>
        <b>Date:</b> <?php echo $details['fee_date']; ?><br>
        <b>Payment Mode:</b> <?php echo $details['payment_mode']; ?><br>
        <b>Received By :</b> <?php echo $details['user_name']; ?>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
                <th>Fee Month</th>
                <th>Year</th>
                <th>Fee Head</th>
                <th>Sub Total</th>
                <th>Paid Amount</th>
                <th>Balance</th>
          </tr>
          </thead>
          <tbody>
         <?php $g_total = 0; $paid = 0; $balance = 0; foreach($data as $row): ?>     
          <tr>
                <td><?php echo $row['month_id'];  ?> </td>
                <td><?php echo $row['year'];  ?> </td>
                <td><?php echo $row['type_id'];  ?> </td>
                <td><?php echo $this->Number->precision($row['sub_total'],2);  ?> </td>
                <td><?php echo $this->Number->precision($row['amount'],2);  ?> </td>
                <td><?php echo $this->Number->precision($row['sub_total']-$row['amount'],2);  ?> </td>
                
                <?php  $g_total += $row['sub_total'];  ?>
                <?php  $paid += $row['amount'];  ?>
                <?php  $balance += $row['sub_total']-$row['amount'];  ?>
          </tr>
         <?php endforeach; ?>
          
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
          <strong> Amount In words :  <?php echo $this->AmountToWords->convert_number_to_words($paid)." only"; ?></strong>
              
        <p class="lead">Note:</p>
        
        <?php  if($details['status'] == 1): ?>
        
            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
              Thank you for submitting the fee.
            </p>
            
        <?php endif; ?>
            
        <?php  if($details['status'] == 0): ?>
            <?php  $temp = explode(':',$details['remarks']);  ?>
            <p class="text-muted well well-sm no-shadow alert alert-danger" style="margin-top: 10px;">
              This invoice Cancelled by <?php echo $temp[1]; ?> 
            </p>
            <strong>Reason :</strong>
             <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
              <?php echo rtrim($temp[0],'Cancelled By'); ?> 
            </p>
            
        <?php endif; ?>    
            
            
            
        
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
       
        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Grand Total:</th>
              <td><?php  echo $this->Number->precision($g_total,2); ?></td>
            </tr>
            <tr>
              <th>Received Amount</th>
              <td><?php  echo $this->Number->precision($paid,2); ?></td>
            </tr>
            <tr>
              <th>Balance Amount:</th>
              <td><?php echo $this->Number->precision($balance,2); ?></td>
            </tr>
            <tr>
              <th>Returned Amount:</th>
              <td><?php echo $this->Number->precision($details['retruned_amount'],2); ?></td>
            </tr>
            
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    
    
    
    <?php endif; ?>
    
    
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<script>
  
   $(document).ready(function(){
     window.print();
    });
   
  function goBack() {
    window.history.back();
  }  
  
   
    
</script>    