<style>
 @media screen and (orientation:landscape) {
    }   
</style> 

<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
            <i class="fa fa-globe"></i>Session Wise Fee Summary Report : <?php  echo $session_name;   ?> 
          <div class="tools pull-right">
                    <a href="javascript:window.print()" class="fa fa-print" data-original-title="" title="Print">
                    </a>
                    <a href="javascript:(0);" onclick="goBack()" class="fa fa-reply hidden-xs hidden-sm" data-original-title="" title="Back">
                    </a>
          </div>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    
    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12">
        <table class="table table-container table-bordered table-hover">
          <thead>
          <tr>
              <th style="width:4%;">Title</th>
              <?php foreach($moonth_names as $months): ?>
              <th style="width:8%;"><?php echo $months; ?></th>
              <?php endforeach; ?>
           </tr>
          </thead>
          <tbody>
          <?php $mt=0; $m1 =0; $m2 =0; $m3 =0; $m4 =0; $m5 =0; $m6 =0; $m7 =0; $m8 =0; $m9 =0;$m10 =0;$m11 =0;$m12 =0; ?>
            <?php  foreach($mdata as $index=>$rows): ?>   
                   <tr>
                     <td><?php echo $index;  ?> </td>
                      <td><?php echo $rows['m1']; $m1 += $rows['m1']; ?> </td>
                      <td><?php echo $rows['m2']; $m2 += $rows['m2']; ?> </td>
                      <td><?php echo $rows['m3']; $m3 += $rows['m3']; ?> </td>
                      <td><?php echo $rows['m4']; $m4 += $rows['m4']; ?> </td>
                      <td><?php echo $rows['m5']; $m5 += $rows['m5']; ?> </td>
                      <td><?php echo $rows['m6']; $m6 += $rows['m6']; ?> </td>
                      <td><?php echo $rows['m7']; $m7 += $rows['m7']; ?> </td>
                      <td><?php echo $rows['m8']; $m8 += $rows['m8']; ?> </td>
                      <td><?php echo $rows['m9']; $m9 += $rows['m9']; ?> </td>
                      <td><?php echo $rows['m10'];$m10 += $rows['m10'];  ?> </td>
                      <td><?php echo $rows['m11'];$m11 += $rows['m11'];  ?> </td>
                      <td><?php echo $rows['m12'];$m12 += $rows['m12'];  ?> </td>
                    </tr>
            <?php endforeach; ?>
             
            <?php $i = 1; foreach($ddata as $index=>$rows): ?>   
                   <tr>
                      <td><?php echo $index;  ?> </td>
                      <td><?php echo $rows['m1']; $m1 += $rows['m1']; ?> </td>
                      <td><?php echo $rows['m2']; $m2 += $rows['m2']; ?> </td>
                      <td><?php echo $rows['m3']; $m3 += $rows['m3']; ?> </td>
                      <td><?php echo $rows['m4']; $m4 += $rows['m4']; ?> </td>
                      <td><?php echo $rows['m5']; $m5 += $rows['m5']; ?> </td>
                      <td><?php echo $rows['m6']; $m6 += $rows['m6']; ?> </td>
                      <td><?php echo $rows['m7']; $m7 += $rows['m7']; ?> </td>
                      <td><?php echo $rows['m8']; $m8 += $rows['m8']; ?> </td>
                      <td><?php echo $rows['m9']; $m9 += $rows['m9']; ?> </td>
                      <td><?php echo $rows['m10'];$m10 += $rows['m10'];  ?> </td>
                      <td><?php echo $rows['m11'];$m11 += $rows['m11'];  ?> </td>
                      <td><?php echo $rows['m12'];$m12 += $rows['m12'];  ?> </td>
                      <?php $mt += $rows['m1'] + $rows['m2'] + $rows['m3'] + $rows['m4'] + $rows['m5'] + $rows['m6'] + $rows['m7'] + $rows['m8'] + $rows['m9'] + $rows['m10'] + $rows['m11'] + $rows['m12']; ?>
                    </tr>
            <?php $i++; endforeach; ?>
                    
            <?php  foreach($edata as $index=>$rows): ?>   
                   <tr>
                      <td><?php echo $index;  ?> </td>
                      <td><?php echo $rows['m1'];  ?> </td>
                      <td><?php echo $rows['m2'];  ?> </td>
                      <td><?php echo $rows['m3'];  ?> </td>
                      <td><?php echo $rows['m4'];  ?> </td>
                      <td><?php echo $rows['m5'];  ?> </td>
                      <td><?php echo $rows['m6'];  ?> </td>
                      <td><?php echo $rows['m7'];  ?> </td>
                      <td><?php echo $rows['m8'];  ?> </td>
                      <td><?php echo $rows['m9'];  ?> </td>
                      <td><?php echo $rows['m10'];  ?> </td>
                      <td><?php echo $rows['m11'];  ?> </td>
                      <td><?php echo $rows['m12'];  ?> </td>
                    </tr>
            <?php endforeach; ?>   
                    
         
                    <tr style="font-weight:bold;">
                      <td>Total </td>
                      <td><?= $m1; $m1=0;  ?></td>
                      <td><?= $m2; $m2=0;  ?></td>
                      <td><?= $m3; $m3=0;  ?></td>
                      <td><?= $m4; $m4=0;  ?></td>
                      <td><?= $m5; $m5=0;  ?></td>
                      <td><?= $m6; $m6=0;  ?></td>
                      <td><?= $m7; $m7=0;  ?></td>
                      <td><?= $m8; $m8=0;  ?></td>
                      <td><?= $m9; $m9=0;  ?></td>
                      <td><?= $m10; $m10=0;  ?></td>
                      <td><?= $m11; $m11=0;  ?></td>
                      <td><?= $m12; $m12=0;  ?></td>
                    </tr>
    
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    
    
    <div class="row"> 
    <div class="col-xs-4" style="border-bottom:solid black;text-align: left;font-weight:bold;">
        Annual Fee Received : &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<span style="text-align: right;"><?php echo $this->Number->precision($annaul_r,2); ?></span>
    </div>
    </div>
    <br />
    <div class="row">
    <div class="col-xs-4" style="border-bottom:solid black;text-align: left;font-weight:bold;">
        Annual Fee Balance : &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<span style="text-align: right;"><?php echo $this->Number->precision($annaul_b,2); ?></span>
    </div>
    </div>
    <br />
   <span style="text-align: right;font-weight: bold;">Total Annual Fee : &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $this->Number->precision(intval($annaul_r) + intval($annaul_b),2); ?></span>
    <br />
    <br />
   
    
    <div class="row"> 
    <div class="col-xs-4" style="border-bottom:solid black;text-align: left;font-weight:bold;">
        Examination Fee Received : &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<span style="text-align: right;"><?php echo $this->Number->precision($exam_r,2); ?></span>
    </div>
    </div>
    
    <br />
    <div class="row">
    <div class="col-xs-4" style="border-bottom:solid black;text-align: left;font-weight:bold;">
        Examination Fee Balance : &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<span style="text-align: right;"><?php echo $this->Number->precision($exam_b,2); ?></span>
    </div>
    </div>
    <br />
   <span style="text-align:5 right;font-weight: bold;">Total Examination Fee : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $this->Number->precision(intval($exam_r) + intval($exam_b),2); ?></span>
    <br />
    <br />
    
    <div class="row">
    <div class="col-xs-4" style="border-bottom:solid black;text-align: left;font-weight:bold;">
        Current Session Arrears : &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<span style="text-align: right;"><?php echo $this->Number->precision($current_arrears,2); ?></span>
    </div>
    </div>
    <br />
    
    <div class="row">
    <div class="col-xs-4" style="border-bottom:solid black;text-align: left;font-weight:bold;">
        Last Session Arrears : &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;<span style="text-align: right;"><?php echo $this->Number->precision($last_arrears,2); ?></span>
    </div>
    </div>
    <br />
    <span style="text-align:5 right;font-weight: bold;">Total Arrears Fee : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $this->Number->precision(intval($current_arrears) + intval($last_arrears),2); ?></span>
    <br />
   
    <span style="text-align:5 right;font-weight: bold;">Total Monthly Balance  : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $this->Number->precision(intval($mt),2); ?></span>
    <br />
     <br />
    
   
    <span style="text-align:5 right;font-weight: bold;">Total  Balance  : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $this->Number->precision(intval($mt + intval($current_arrears) + intval($last_arrears) + intval($exam_b) + intval($annaul_b)),2); ?></span>
    <br />
   
    
   
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
