<style>
    @media screen and (orientation:landscape) {}   
    @media all {
    .page-break	{ display: none; }
    }

    @media print {
            .page-break	{ display: block; page-break-before: always; }
    }
</style>    
<?php //if(!empty($data)){ //$details = $data[0]; } ?>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
 <?php $page = 1; foreach($data as $details):  ?>
    <div class="row">
        
      <div class="col-xs-4">
          
          <div class="row">
            <div class="col-xs-12">
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
            </div>
         </div>
          
        <div class="row">
            <div class="col-xs-12">
                <div style="text-align: center;">
                    <p style="margin: 0 0 0px;"><strong><?php  echo $bank['bank_name']; ?></strong></p>
                    <p style="margin: 0 0 0px;"><?php  echo $bank['branch_name']; ?></p>
                    <p class="text-bold" style="margin: 0 0 0px;">A/C# <?php  echo $bank['account_number']; ?></p>
                    <h5 class="text-bold">Can be deposited in any branch of above bank in karachi</h5>
                </div>
            </div>
         </div>
             
          <div class="row">
            <div class="col-xs-8">
                <strong>Session: 2017-18</strong> 
            </div>
           
            <div class="col-xs-4">
                <strong class=""><ins>School's Copy</ins></strong> 
            </div>  
          </div>
         
          
          <div class="row">
            <div class="col-xs-12">
                <strong>Name : <?php  echo $details['s_name']; ?></strong> 
            </div>
            
          </div>
          
          <div class="row">
            
            <div class="col-xs-12">
                <strong>F-Name : <?php  echo $details['f_name']; ?></strong> 
            </div>  
          </div>
          
             <!-- Table row -->
                    <div class="row">
                      <div class="col-xs-12 table-responsive">
                          <table class="table table-striped" style="margin-bottom: 0px;">
                          <thead>
                              <tr class="bg-blue">
                                <th style="width:10%;">CC#</th>
                                <th style="width:10%;">Roll_No</th>
                                <th style="width:50%;">Class</th>
                                <th style="width:30%;">Shift</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                                <th style="width:10%;"><?php  echo $details['registration_id']; ?></th>
                                <th style="width:10%;"><?php  echo $details['roll_no']; ?></th>
                                <th style="width:50%;"><?php  echo $details['class_name']; ?></th>
                                <th style="width:30%;"><?php  echo $details['shift_name']; ?></th>
                            </tr>

                          </tbody>
                        </table>
                      </div>
                      <!-- /.col -->
                    </div>
             <!-- /.row -->
            
             <!-- Table row -->
                    <div class="row">
                      <div class="col-xs-12 table-responsive">
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                          <thead>
                              <tr>
                                <th style="width:70%;">Fee Description</th>
                                <th style="width:30%;">Amount</th>
                                
                            </tr>
                          </thead>
                          <?php $fine = 0; $total = 0; ?>
                          <tbody>
                            <tr>
                                <td style="width:70%;"><?php echo $ft[0]['fee_type_name']; ?>  &nbsp;<?php  echo $details['Monthly']; ?></td>
                                <td style="width:30%;"><?php $fine += $details['fine']; $total = $details['amount']; echo $this->Number->precision($details['amount'],2); ?></td>
                                
                            </tr>
                            <tr>
                                <?php  if(!empty($details['fee_1'])): ?>
                                    <?php  $fee_1 = explode('|',$details['fee_1']); ?>
                                    <td style="width:70%;"><?php  echo $fee_1[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_1[1]; echo $this->Number->precision($fee_1[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            
                             <tr>
                                <?php  if(!empty($details['fee_2'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_2']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            
                            <tr>
                                <?php  if(!empty($details['fee_3'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_3']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            
                            <tr>
                                <?php  if(!empty($details['fee_4'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_4']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            
                            <tr>
                                <?php  if(!empty($details['fee_5'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_5']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            
                            <tr>
                                <?php  if(!empty($details['fee_6'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_6']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <?php  if(!empty($details['fee_7'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_7']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <?php  if(!empty($details['fee_8'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_8']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            
                             <tr>
                                <?php  if(!empty($details['fee_9'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_9']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                             <tr>
                                <?php  if(!empty($details['fee_10'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_10']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            
                            <tr>
                                <td style="width:70%;">Arrears  <?php  echo $details['pre_month']; ?></td>
                                <td style="width:30%;"><?php  $total += $details['pre_amount']; echo $this->Number->precision($details['pre_amount'],2); ?></td>
                                
                            </tr>

                          </tbody>
                          
                          <tfoot>
                              
                              <tr class="bg-gray-active">
                               
                                <th style="width:70%;">Total Payable Amount</th>
                                <th style="width:30%;"><?php echo $this->Number->precision($total,2); ?></th>
                                
                            </tr>
                              
                          </tfoot>
                          
                          
                        </table>
                      </div>
                      <!-- /.col -->
                    </div>
             <!-- /.row -->
              <!-- /.row -->
                    <div class="row">
                      <!-- accepted payments column -->
                      <div class="col-xs-4">
                          <br />
                        Sign:_____________________<br >
                        <p>Dated: <?php echo $id; ?></p>
                        
                        
                      </div>
                      
                      <!-- /.col -->
                      <div class="col-xs-8">

                        <div class="table-responsive">
                          <table class="table">
                            
                            <tr>
                              <th>Due Date</th>
                              <td><?php echo $dd; ?></td>
                            </tr>
                            <tr>
                              <th>Within Due Date</th>
                              <td><?php echo $this->Number->precision($total,2); ?></td>
                            </tr>
                            <tr>
                              <th>After Due Date:</th>
                              <td><?php echo $this->Number->precision($total + $fine,2); ?></td>
                            </tr>

                          </table>
                        </div>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                     <div class="row">
                        <div class="col-xs-12">
                            <div style="text-align: left;">
                                <p style="margin: 0 0 0px;">All Fees and Payment are Non-Refundable under all Circumstances.</p>
                                
                            </div>
                        </div>
                     </div>
                    <br /><br />
         
    </div>
        
    
    
    <div class="col-xs-4">
          
          <div class="row">
            <div class="col-xs-12">
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
            </div>
         </div>
          
        <div class="row">
            <div class="col-xs-12">
                <div style="text-align: center;">
                    <p style="margin: 0 0 0px;"><strong><?php  echo $bank['bank_name']; ?></strong></p>
                    <p style="margin: 0 0 0px;"><?php  echo $bank['branch_name']; ?></p>
                    <p class="text-bold" style="margin: 0 0 0px;">A/C# <?php  echo $bank['account_number']; ?></p>
                     <h5 class="text-bold">Can be deposited in any branch of above bank in karachi</h5>
                </div>
            </div>
         </div>
             
          <div class="row">
            <div class="col-xs-8">
                <strong>Session: 2017-18</strong> 
            </div>
           
            <div class="col-xs-4">
                <strong class=""><ins>Parent's Copy</ins></strong> 
            </div>  
          </div>
         
          
          <div class="row">
            <div class="col-xs-12">
                <strong>Name : <?php  echo $details['s_name']; ?></strong> 
            </div>
            
          </div>
          
          <div class="row">
            
            <div class="col-xs-12">
                <strong>F-Name : <?php  echo $details['f_name']; ?></strong> 
            </div>  
          </div>
          
             <!-- Table row -->
                    <div class="row">
                      <div class="col-xs-12 table-responsive">
                          <table class="table table-striped" style="margin-bottom: 0px;">
                          <thead>
                              <tr class="bg-blue">
                                <th style="width:10%;">CC#</th>
                                <th style="width:10%;">Roll_No</th>
                                <th style="width:50%;">Class</th>
                                <th style="width:30%;">Shift</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                                <th style="width:10%;"><?php  echo $details['registration_id']; ?></th>
                                <th style="width:10%;"><?php  echo $details['roll_no']; ?></th>
                                <th style="width:50%;"><?php  echo $details['class_name']; ?></th>
                                <th style="width:30%;"><?php  echo $details['shift_name']; ?></th>
                            </tr>

                          </tbody>
                        </table>
                      </div>
                      <!-- /.col -->
                    </div>
             <!-- /.row -->
            
             <!-- Table row -->
                    <div class="row">
                      <div class="col-xs-12 table-responsive">
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                          <thead>
                              <tr>
                                <th style="width:70%;">Fee Description</th>
                                <th style="width:30%;">Amount</th>
                                
                            </tr>
                          </thead>
                          <?php $fine = 0; $total = 0; ?>
                          <tbody>
                            <tr>
                                <td style="width:70%;"><?php echo $ft[0]['fee_type_name']; ?>  &nbsp; <?php  echo $details['Monthly']; ?></td>
                                <td style="width:30%;"><?php $fine += $details['fine']; $total = $details['amount']; echo $this->Number->precision($details['amount'],2); ?></td>
                                
                            </tr>
                            <tr>
                                <?php  if(!empty($details['fee_1'])): ?>
                                    <?php  $fee_1 = explode('|',$details['fee_1']); ?>
                                    <td style="width:70%;"><?php  echo $fee_1[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_1[1]; echo $this->Number->precision($fee_1[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            
                             <tr>
                                <?php  if(!empty($details['fee_2'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_2']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            
                            <tr>
                                <?php  if(!empty($details['fee_3'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_3']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            
                            <tr>
                                <?php  if(!empty($details['fee_4'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_4']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            
                            <tr>
                                <?php  if(!empty($details['fee_5'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_5']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            
                            <tr>
                                <?php  if(!empty($details['fee_6'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_6']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <?php  if(!empty($details['fee_7'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_7']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <?php  if(!empty($details['fee_8'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_8']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            
                             <tr>
                                <?php  if(!empty($details['fee_9'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_9']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                             <tr>
                                <?php  if(!empty($details['fee_10'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_10']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            
                            <tr>
                                <td style="width:70%;">Arrears  <?php  echo $details['pre_month']; ?></td>
                                <td style="width:30%;"><?php  $total += $details['pre_amount']; echo $this->Number->precision($details['pre_amount'],2); ?></td>
                                
                            </tr>

                          </tbody>
                          
                          <tfoot>
                              
                              <tr class="bg-gray-active">
                               
                                <th style="width:70%;">Total Payable Amount</th>
                                <th style="width:30%;"><?php echo $this->Number->precision($total,2); ?></th>
                                
                            </tr>
                              
                          </tfoot>
                          
                          
                        </table>
                      </div>
                      <!-- /.col -->
                    </div>
             <!-- /.row -->
              <!-- /.row -->
                    <div class="row">
                      <!-- accepted payments column -->
                      <div class="col-xs-4">
                          <br />
                        Sign:_____________________<br >
                        <p>Dated: <?php echo $id; ?></p>
                      </div>
                      <!-- /.col -->
                      <div class="col-xs-8">

                        <div class="table-responsive">
                          <table class="table">
                            
                            <tr>
                              <th>Due Date</th>
                              <td><?php echo $dd; ?></td>
                            </tr>
                            <tr>
                              <th>Within Due Date</th>
                              <td><?php echo $this->Number->precision($total,2); ?></td>
                            </tr>
                            <tr>
                              <th>After Due Date:</th>
                              <td><?php echo $this->Number->precision($total + $fine,2); ?></td>
                            </tr>

                          </table>
                        </div>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                     <div class="row">
                        <div class="col-xs-12">
                            <div style="text-align: left;">
                                <p style="margin: 0 0 0px;">All Fees and Payment are Non-Refundable under all Circumstances.</p>
                                
                            </div>
                        </div>
                     </div>
         <br /><br />
        </div>
      <div class="col-xs-4">
          
          <div class="row">
            <div class="col-xs-12">
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
            </div>
         </div>
          
        <div class="row">
            <div class="col-xs-12">
                <div style="text-align: center;">
                    <p style="margin: 0 0 0px;"><strong><?php  echo $bank['bank_name']; ?></strong></p>
                    <p style="margin: 0 0 0px;"><?php  echo $bank['branch_name']; ?></p>
                    <p class="text-bold" style="margin: 0 0 0px;">A/C# <?php  echo $bank['account_number']; ?></p>
                    <h5 class="text-bold">Can be deposited in any branch of above bank in karachi</h5>
                </div>
            </div>
         </div>
             
          <div class="row">
            <div class="col-xs-8">
                <strong>Session: 2017-18</strong> 
            </div>
           
            <div class="col-xs-4">
                <strong class=""><ins>Bank Copy</ins></strong> 
            </div>  
          </div>
         
          
          <div class="row">
            <div class="col-xs-12">
                <strong>Name : <?php  echo $details['s_name']; ?></strong> 
            </div>
            
          </div>
          
          <div class="row">
            
            <div class="col-xs-12">
                <strong>F-Name : <?php  echo $details['f_name']; ?></strong> 
            </div>  
          </div>
          
             <!-- Table row -->
                    <div class="row">
                      <div class="col-xs-12 table-responsive">
                          <table class="table table-striped" style="margin-bottom: 0px;">
                          <thead>
                              <tr class="bg-blue">
                                <th style="width:10%;">CC#</th>
                                <th style="width:10%;">Roll_No</th>
                                <th style="width:50%;">Class</th>
                                <th style="width:30%;">Shift</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                                <th style="width:10%;"><?php  echo $details['registration_id']; ?></th>
                                <th style="width:10%;"><?php  echo $details['roll_no']; ?></th>
                                <th style="width:50%;"><?php  echo $details['class_name']; ?></th>
                                <th style="width:30%;"><?php  echo $details['shift_name']; ?></th>
                            </tr>

                          </tbody>
                        </table>
                      </div>
                      <!-- /.col -->
                    </div>
             <!-- /.row -->
            
             <!-- Table row -->
                    <div class="row">
                      <div class="col-xs-12 table-responsive">
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                          <thead>
                              <tr>
                                <th style="width:70%;">Fee Description</th>
                                <th style="width:30%;">Amount</th>
                                
                            </tr>
                          </thead>
                          <?php $fine = 0; $total = 0; ?>
                          <tbody>
                            <tr>
                                <td style="width:70%;"><?php echo $ft[0]['fee_type_name']; ?>  &nbsp; <?php  echo $details['Monthly']; ?></td>
                                <td style="width:30%;"><?php $fine += $details['fine']; $total = $details['amount']; echo $this->Number->precision($details['amount'],2); ?></td>
                                
                            </tr>
                            <tr>
                                <?php  if(!empty($details['fee_1'])): ?>
                                    <?php  $fee_1 = explode('|',$details['fee_1']); ?>
                                    <td style="width:70%;"><?php  echo $fee_1[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_1[1]; echo $this->Number->precision($fee_1[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            
                             <tr>
                                <?php  if(!empty($details['fee_2'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_2']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            
                            <tr>
                                <?php  if(!empty($details['fee_3'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_3']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            
                            <tr>
                                <?php  if(!empty($details['fee_4'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_4']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            
                            <tr>
                                <?php  if(!empty($details['fee_5'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_5']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            
                            <tr>
                                <?php  if(!empty($details['fee_6'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_6']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <?php  if(!empty($details['fee_7'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_7']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <?php  if(!empty($details['fee_8'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_8']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            
                             <tr>
                                <?php  if(!empty($details['fee_9'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_9']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                             <tr>
                                <?php  if(!empty($details['fee_10'])): ?>
                                    <?php  $fee_2 = explode('|',$details['fee_10']); ?>
                                    <td style="width:70%;"><?php  echo $fee_2[0]; ?></td>
                                    <td style="width:30%;"><?php $total += $fee_2[1]; echo $this->Number->precision($fee_2[1],2); ?></td>
                                <?php endif; ?>
                            </tr>
                            
                            <tr>
                                <td style="width:70%;">Arrears  <?php  echo $details['pre_month']; ?></td>
                                <td style="width:30%;"><?php  $total += $details['pre_amount']; echo $this->Number->precision($details['pre_amount'],2); ?></td>
                                
                            </tr>

                          </tbody>
                          
                          <tfoot>
                              
                              <tr class="bg-gray-active">
                               
                                <th style="width:70%;">Total Payable Amount</th>
                                <th style="width:30%;"><?php echo $this->Number->precision($total,2); ?></th>
                                
                            </tr>
                              
                          </tfoot>
                          
                          
                        </table>
                      </div>
                      <!-- /.col -->
                    </div>
             <!-- /.row -->
              <!-- /.row -->
                    <div class="row">
                      <!-- accepted payments column -->
                      <div class="col-xs-4">
                          <br />
                        Sign:_____________________<br >
                         <p>Dated: <?php echo $id; ?></p>
                      </div>
                      <!-- /.col -->
                      <div class="col-xs-8">

                        <div class="table-responsive">
                          <table class="table">
                            
                            <tr>
                              <th>Due Date</th>
                              <td><?php echo $dd; ?></td>
                            </tr>
                            <tr>
                              <th>Within Due Date</th>
                              <td><?php echo $this->Number->precision($total,2); ?></td>
                            </tr>
                            <tr>
                              <th>After Due Date:</th>
                              <td><?php echo $this->Number->precision($total + $fine,2); ?></td>
                            </tr>

                          </table>
                        </div>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                     <div class="row">
                        <div class="col-xs-12">
                            <div style="text-align: left;">
                                <p style="margin: 0 0 0px;">All Fees and Payment are Non-Refundable under all Circumstances.</p>
                                
                            </div>
                        </div>
                     </div>
         
        </div> 
        
    </div>
    
    <?php if($page == 1): ?>
    <div class="page-break"></div>
    <?php $page = 0; endif; ?>
 <?php $page++; endforeach; ?>
    
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<script>
  
   $(document).ready(function(){
    // window.print();
    });
   
  function goBack() {
    window.history.back();
  }  
  
   
    
</script>    