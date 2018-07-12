<?php

  function getShortMonthNameByNumber($monthNum){
    switch($monthNum) {
        case 1:
            return "Jan";
        case 2:
            return "Feb";
        case 3:
            return "Mar";
        case 4:
            return "Apr";    
        case 5:
            return "may";
        case 6:
            return "Jun";
        case 7:
            return "July";
        case 8:
            return "Aug";
        case 9:
            return "Sep";
        case 10:
            return "Oct";
        case 11:
            return "Nov";
        case 12:
            return "Dec";    
    }
    
  }

?>
<style>
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
 <?php $page = 1; foreach($mdata as $details):  ?>
    <?php  if($this->Number->precision($details['total'],2) > 0): ?>    
    <div class="row">
      <div class="col-xs-6">
          
          <div class="row">
            <div class="col-xs-12">
              <span style="display:block; position:relative; text-align:left; ">
               <?php if($this->request->session()->read('Info.full_logo') === 'No'): ?>
                
                    <?php //echo $this->Html->image('logo.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top;width:50px;']); ?>
                     <span style="line-height:22px; font-size:20px; font-weight: bold; color:#EF4836 !important; vertical-align: top"><?php  echo $this->request->session()->read('Info.school'); ?></span>
<!--                     <span style=" display: inline-block;  position: relative;  left: 6px;  top: 0px;  width: 1px;  height: 41px;  background: #00bcd4 !important;"></span>-->
<!--                     <span style=" position: relative;  display: inline-block;  font: 500 15px/15px 'asap', sans-serif;  letter-spacing: -0.025em;  color: #00bcd4 !important;  left: 6px;  top: -4px; text-align: left"><span style="display:block;">Address : <?php  //echo $this->request->session()->read('Info.address'); ?><br/>Phone :<?php  //echo $this->request->session()->read('Info.phone'); ?></span></span>-->
                <?php else: ?>     
               <?php echo $this->Html->image('logo2.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top;width:100%;']); ?>
                     
               <?php endif; ?>       
                     
            </span> 
            </div>
            
          </div>
          
          
          <div class="row">
            <div class="col-xs-8">
                <strong>Session: 2018-19</strong> 
            </div>
           
            <div class="col-xs-4">
                <strong class=""><ins>Parent's Copy</ins></strong> 
            </div>  
          </div>
         
          
          <div class="row">
            <div class="col-xs-8">
                <strong>Name : <?php  echo $details['s_name']; ?></strong> 
            </div>
            <div class="col-xs-4">
                <strong class="">Due Date:</strong> 
            </div> 
            
          </div>
          
          <div class="row">
            
            <div class="col-xs-8">
                <strong>F-Name : <?php  echo $details['f_name']; ?></strong> 
            </div>
            <div class="col-xs-4">
                <strong class=""><?php echo $dd; ?></strong> 
            </div>   
              
          </div>
          
             <!-- Table row -->
                    <div class="row">
                      <div class="col-xs-12 table-responsive">
                        <table class="table table-stripe" style="margin-bottom: 0px;">
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
                            <tr class="bg-gray">
                                
                                <th style="width:8%;"><?= getShortMonthNameByNumber($moonths[0])  //jdmonthname(1,0) ?></th>
                                <th style="width:8%;"><?= getShortMonthNameByNumber($moonths[1])  //jdmonthname(1,0) ?></th>
                                <th style="width:8%;"><?= getShortMonthNameByNumber($moonths[2])  //jdmonthname(1,0) ?></th>
                                <th style="width:8%;"><?= getShortMonthNameByNumber($moonths[3])  //jdmonthname(1,0) ?></th>
                                <th style="width:8%;"><?= getShortMonthNameByNumber($moonths[4])  //jdmonthname(1,0) ?></th>
                                <th style="width:8%;"><?= getShortMonthNameByNumber($moonths[5])  //jdmonthname(1,0) ?></th>
                                
                            </tr>
                            
                            <tr>
                                <td style="width:8%;"><?php  if(!empty($details['m1'])){ echo $details['m1']; }else{ echo "-"; } ?></td>
                                <td style="width:8%;"><?php  if(!empty($details['m2'])){ echo $details['m2']; }else{ echo "-"; } ?></td>
                                <td style="width:8%;"><?php  if(!empty($details['m3'])){ echo $details['m3']; }else{ echo "-"; } ?></td>
                                <td style="width:8%;"><?php  if(!empty($details['m4'])){ echo $details['m4']; }else{ echo "-"; } ?></td>
                                <td style="width:8%;"><?php  if(!empty($details['m5'])){ echo $details['m5']; }else{ echo "-"; } ?></td>
                                <td style="width:8%;"><?php  if(!empty($details['m6'])){ echo $details['m6']; }else{ echo "-"; } ?></td>
                                
                            </tr>
                            <tr class="bg-gray">
                               
                                <th style="width:8%;"><?= getShortMonthNameByNumber($moonths[6])  //jdmonthname(1,0) ?></th>
                                <th style="width:8%;"><?= getShortMonthNameByNumber($moonths[7])  //jdmonthname(1,0) ?></th>
                                <th style="width:8%;"><?= getShortMonthNameByNumber($moonths[8])  //jdmonthname(1,0) ?></th>
                                <th style="width:8%;"><?= getShortMonthNameByNumber($moonths[9])  //jdmonthname(1,0) ?></th>
                                <th style="width:8%;"><?= getShortMonthNameByNumber($moonths[10])  //jdmonthname(1,0) ?></th>
                                <th style="width:8%;"><?= getShortMonthNameByNumber($moonths[11])  //jdmonthname(1,0) ?></th>
                                
                                
                            </tr>
                            
                            <tr>
                                <td style="width:8%;"><?php  if(!empty($details['m7'])){ echo $details['m7']; }else{ echo "-"; } ?></td>
                                <td style="width:8%;"><?php  if(!empty($details['m8'])){ echo $details['m8']; }else{ echo "-"; } ?></td>
                                <td style="width:8%;"><?php  if(!empty($details['m9'])){ echo $details['m9']; }else{ echo "-"; } ?></td>
                                <td style="width:8%;"><?php  if(!empty($details['m10'])){ echo $details['m10']; }else{ echo "-"; } ?></td>
                                <td style="width:8%;"><?php  if(!empty($details['m11'])){ echo $details['m11']; }else{ echo "-"; } ?></td>
                                <td style="width:8%;"><?php  if(!empty($details['m12'])){ echo $details['m12']; }else{ echo "-"; } ?></td>
                                
                            </tr>
                            
                            <tr class="bg-gray">
                               
                                <th style="width:8%;">Arrears</th>
                                <th style="width:8%;">LYB</th>
                                <th style="width:8%;">Fine</th>
                                <th style="width:8%;">An-Fee</th>
                                <th style="width:8%;">Exam.</th>
                                <th style="width:8%;">Grand Total</th>
                                
                            </tr>
                            
                            <tr>
                              
                                <td style="width:8%;"><?php  echo $details['arrears_current_session']; ?></td>
                                <td style="width:8%;"><?php  //echo $details['arrears']; ?>0</td>
                                <td style="width:8%;"><?php  echo $details['fine']; ?></td>
                                <td style="width:8%;"><?php  echo $details['annual']; ?></td>
                                <td style="width:8%;"><?php  echo $details['exam']; ?></td>
                                <td style="width:8%;"><?php  echo $this->Number->precision($details['total'] - $details['arrears'],2); ?></td>
                                
                            </tr>
                           
                            
                          </thead>
                        </table>
                          
                      </div>
                      <!-- /.col -->
                    </div>
             <!-- /.row -->
            <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-xs-12">
                      <br />
                    Received By:_____________&nbsp;&nbsp;
                    <?php echo "Issue Date : " . $id; ?>
                  </div>

                </div>
                <!-- /.row -->
        </div>
      <div class="col-xs-6">
          
          <div class="row">
             <div class="col-xs-12">
              <span style="display:block; position:relative; text-align:left; ">
               <?php if($this->request->session()->read('Info.full_logo') === 'No'): ?>
                
                    <?php //echo $this->Html->image('logo.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top;width:50px;']); ?>
                     <span style="line-height:22px; font-size:20px; font-weight: bold; color:#EF4836 !important; vertical-align: top"><?php  echo $this->request->session()->read('Info.school'); ?></span>
<!--                     <span style=" display: inline-block;  position: relative;  left: 6px;  top: 0px;  width: 1px;  height: 41px;  background: #00bcd4 !important;"></span>-->
<!--                     <span style=" position: relative;  display: inline-block;  font: 500 15px/15px 'asap', sans-serif;  letter-spacing: -0.025em;  color: #00bcd4 !important;  left: 6px;  top: -4px; text-align: left"><span style="display:block;">Address : <?php  //echo $this->request->session()->read('Info.address'); ?><br/>Phone :<?php  //echo $this->request->session()->read('Info.phone'); ?></span></span>-->
                <?php else: ?>     
               <?php echo $this->Html->image('logo2.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top;width:100%;']); ?>
                     
               <?php endif; ?>       
                     
            </span> 
            </div>
            
          </div>
          
          
          <div class="row">
            <div class="col-xs-8">
                <strong>Session: 2018-19</strong> 
            </div>
           
            <div class="col-xs-4">
                <strong class=""><ins>School's Copy</ins></strong> 
            </div>  
          </div>
         
          
          <div class="row">
            <div class="col-xs-8">
                <strong>Name : <?php  echo $details['s_name']; ?></strong> 
            </div>
            <div class="col-xs-4">
                <strong class="">Due Date:</strong> 
            </div> 
            
          </div>
          
          <div class="row">
            
            <div class="col-xs-8">
                <strong>F-Name : <?php  echo $details['f_name']; ?></strong> 
            </div>
            <div class="col-xs-4">
                <strong class=""><?php echo $dd; ?></strong> 
            </div>   
              
          </div>
          
             <!-- Table row -->
                    <div class="row">
                      <div class="col-xs-12 table-responsive">
                        <table class="table table-stripe" style="margin-bottom: 0px;">
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
                           <tr class="bg-gray">
                                <th style="width:8%;"><?= getShortMonthNameByNumber($moonths[0])  //jdmonthname(1,0) ?></th>
                                <th style="width:8%;"><?= getShortMonthNameByNumber($moonths[1])  //jdmonthname(1,0) ?></th>
                                <th style="width:8%;"><?= getShortMonthNameByNumber($moonths[2])  //jdmonthname(1,0) ?></th>
                                <th style="width:8%;"><?= getShortMonthNameByNumber($moonths[3])  //jdmonthname(1,0) ?></th>
                                <th style="width:8%;"><?= getShortMonthNameByNumber($moonths[4])  //jdmonthname(1,0) ?></th>
                                <th style="width:8%;"><?= getShortMonthNameByNumber($moonths[5])  //jdmonthname(1,0) ?></th>
                            </tr>
                            
                            <tr>
                                <td style="width:8%;"><?php  if(!empty($details['m1'])){ echo $details['m1']; }else{ echo "-"; } ?></td>
                                <td style="width:8%;"><?php  if(!empty($details['m2'])){ echo $details['m2']; }else{ echo "-"; } ?></td>
                                <td style="width:8%;"><?php  if(!empty($details['m3'])){ echo $details['m3']; }else{ echo "-"; } ?></td>
                                <td style="width:8%;"><?php  if(!empty($details['m4'])){ echo $details['m4']; }else{ echo "-"; } ?></td>
                                <td style="width:8%;"><?php  if(!empty($details['m5'])){ echo $details['m5']; }else{ echo "-"; } ?></td>
                                <td style="width:8%;"><?php  if(!empty($details['m6'])){ echo $details['m6']; }else{ echo "-"; } ?></td>
                                
                            </tr>
                            <tr class="bg-gray">
                                <th style="width:8%;"><?= getShortMonthNameByNumber($moonths[6])  //jdmonthname(1,0) ?></th>
                                <th style="width:8%;"><?= getShortMonthNameByNumber($moonths[7])  //jdmonthname(1,0) ?></th>
                                <th style="width:8%;"><?= getShortMonthNameByNumber($moonths[8])  //jdmonthname(1,0) ?></th>
                                <th style="width:8%;"><?= getShortMonthNameByNumber($moonths[9])  //jdmonthname(1,0) ?></th>
                                <th style="width:8%;"><?= getShortMonthNameByNumber($moonths[10])  //jdmonthname(1,0) ?></th>
                                <th style="width:8%;"><?= getShortMonthNameByNumber($moonths[11])  //jdmonthname(1,0) ?></th>
                                
                            </tr>
                            
                            <tr>
                                <td style="width:8%;"><?php  if(!empty($details['m7'])){ echo $details['m7']; }else{ echo "-"; } ?></td>
                                <td style="width:8%;"><?php  if(!empty($details['m8'])){ echo $details['m8']; }else{ echo "-"; } ?></td>
                                <td style="width:8%;"><?php  if(!empty($details['m9'])){ echo $details['m9']; }else{ echo "-"; } ?></td>
                                <td style="width:8%;"><?php  if(!empty($details['m10'])){ echo $details['m10']; }else{ echo "-"; } ?></td>
                                <td style="width:8%;"><?php  if(!empty($details['m11'])){ echo $details['m11']; }else{ echo "-"; } ?></td>
                                <td style="width:8%;"><?php  if(!empty($details['m12'])){ echo $details['m12']; }else{ echo "-"; } ?></td>
                                
                            </tr>
                            
                            <tr class="bg-gray">
                               
                                <th style="width:8%;">Arrears</th>
                                <th style="width:8%;">LYB</th>
                                <th style="width:8%;">Fine</th>
                                <th style="width:8%;">An-Fee</th>
                                <th style="width:8%;">Exam.</th>
                                <th style="width:8%;">Grand Total</th>
                                
                            </tr>
                            
                            <tr>
                              
                                 <td style="width:8%;"><?php  echo $details['arrears_current_session']; ?></td>
                                <td style="width:8%;"><?php  //echo $details['arrears']; ?>0</td>
                                <td style="width:8%;"><?php  echo $details['fine']; ?></td>
                                <td style="width:8%;"><?php  echo $details['annual']; ?></td>
                                <td style="width:8%;"><?php  echo $details['exam']; ?></td>
                                <td style="width:8%;"><?php  echo $this->Number->precision($details['total'] - $details['arrears'],2); ?></td>
                                
                            </tr>
                           
                            
                          </thead>
                        </table>
                         
                      </div>
                      <!-- /.col -->
                    </div>
             <!-- /.row -->
            <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-xs-12">
                      <br />
                    Received By:_____________&nbsp;&nbsp;
                    <?php echo "Issue Date : " . $id; ?>
                  </div>

                </div>
                <!-- /.row -->
        </div>  
        
    </div>
    <?php endif; ?>   
    <hr style="border-top: dotted 1px;" />
    <?php if($page == 2): ?>
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
       // $(".se-pre-con").fadeOut("slow");;
   });
   
  function goBack() {
    window.history.back();
  }  
  
   
    
</script>    