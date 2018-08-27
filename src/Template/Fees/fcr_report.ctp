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
            <i class="fa fa-globe"></i>FCR Report : <?php  echo $class.' | '.$shift . ' | '.$fee_type;   ?> 
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
        <table class="ttable table-container table-bordered table-hover">
          <thead>
          <tr>
              <th style="width:10%;">CC# | Roll# | GR#</th>
              <th style="width:15%;">Student Name</th>
              <th style="width:15%;">Father Name</th>
              <?php foreach($moonth_names as $months): ?>
              <th style="width:5%;"><?php echo $months; ?></th>
              <?php endforeach; ?>
           </tr>
          </thead>
          <tbody>
        <?php 
          $m1 = 0;
          $m2 = 0;
          $m3 = 0;
          $m4 = 0;
          $m5 = 0;
          $m6 = 0;
          $m7 = 0;
          $m8 = 0;
          $m9 = 0;
          $m10 = 0;
          $m11 = 0;
          $m12 = 0;
              
        ?>    <?php  foreach($mdata as $rows): ?>   
                   <tr>
                      <td><?php echo $rows['registration_id']." | ".$rows['roll_no']." | ".$rows['gr_no'];  ?> </td>
                      <td><?php echo $rows['s_name'];  ?> </td>
                      <td><?php echo $rows['f_name'];  ?> </td>
                      
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
          
          </tbody>
          
          <tfoot>
              <tr class="alert alert-info" style="font-weight: bold;"> 
                  <td colspan="3">Grand Total</td>
                <td><?= $m1 ?></td>
                <td><?= $m2 ?></td>
                <td><?= $m3 ?></td>
                <td><?= $m4 ?></td>
                <td><?= $m5 ?></td>
                <td><?= $m6 ?></td>
                <td><?= $m7 ?></td>
                <td><?= $m8 ?></td>
                <td><?= $m9 ?></td>
                <td><?= $m10 ?></td>
                <td><?= $m11 ?></td>
                <td><?= $m12 ?></td>
              </tr>  
              
          </tfoot>
          
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
         
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
       
        <div class="table-responsive">
         
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
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
