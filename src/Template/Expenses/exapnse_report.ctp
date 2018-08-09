<?php if(!empty($data)){ $details = $data[0]; } ?>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i>Expense Report  : <?php echo "From " .date("d-M-Y", strtotime($from)) . " to ".date("d-M-Y", strtotime($to)) ." Shift :" .$shift_name; ?>
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
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
              <th style="width:15%;">Transaction Account Number</th>
              <th style="width:15%;">Transaction Account Name</th>
              <?php if($tag==2): ?>
              <th style="width:50%;">Expense Desc.</th>
              <?php endif; ?>
              <th style="width:20%;">Amount</th>
              
           </tr>
          </thead>
          <tbody>
         <?php $g_total = 0; $paid = 0; $balance = 0; foreach($data as $row): ?>     
          <tr>
                <td><?php echo $row['ma']."-".$row['ca']."-".$row['sca']."-".$row['ta_no'];  ?> </td>
                <td><?php echo $row['ta_name'];  ?> </td>
                <?php if($tag==2): ?>
                <td><?php echo $row['expanse_desc'];  ?> </td>
                <?php endif; ?>
                <td><?php echo $this->Number->precision($row['amount'],2);  ?> </td>
                
                <?php  $g_total += $row['amount'];  ?>
              
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
         
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
       
        <div class="table-responsive">
          <table class="table">
              <tr class="success">
              <th style="width:60%">Grand Total:</th>
              <td><?php  echo $this->Number->precision($g_total,2); ?></td>
            </tr>
            
          </table>
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