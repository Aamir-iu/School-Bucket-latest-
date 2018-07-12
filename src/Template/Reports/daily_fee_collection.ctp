<style type="text/css" media="print">
    @page { 
        size: landscape;
    }
/*    body { 
       // writing-mode: tb-rl;
    }*/
</style>
<?php //if(!empty($data)){ $details = $data[0]; } ?>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
             <?php $date = date("Y-m-d h:i"); ?>
           <i class="fa fa-globe"></i> Fee Collection Report :   <?php echo date('d-M-Y', strtotime($from)); ?> To  <?php echo date('d-M-Y', strtotime($to)); ?> Shift : <?php echo $shift_name; ?>
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
              <th style="width:10%;">Invoice#</th>
              <th style="width:10%;">Registration ID</th>
              <th style="width:20%;">Student Name</th>
              <th style="width:20%;">Father Name</th>
               <th style="width:10%;">Fee Type</th>
              <th style="width:10%;">Month</th>
              <th style="width:10%;">Sub Total</th>
              <th style="width:10%;">Received Amount</th>
           </tr>
          </thead>
          <tbody>
         <?php $g_total = 0; $paid = 0; $balance = 0; foreach($data as $index=>$value): ?> 
              <tr>
                  <td colspan="8" style="width:100%;"><strong><?php echo $index; ?></strong></td>
              </tr>
         <?php  foreach($value as $row): ?>    
          <tr>
                <td><?php echo $row['inv_no'];  ?> </td>
                <td><?php  echo $row['reg_id'];  ?> </td>
                <td><?php echo $row['name'];  ?> </td>
                <td><?php echo $row['fname'];  ?> </td>
                <td><?php echo $row['type_id'];  ?> </td>
                <td><?php echo $row['month_id'].'-'.$row['year'];  ?> </td>
               <td><span <?php  if($row['amount'] < $row['sub_total']){ echo "class='badge bg-green-active'"; } ?>><?php echo $this->Number->precision($row['sub_total'],2); ?></span></td>
                <td><span <?php  if($row['amount'] < $row['sub_total']){ echo "class='badge bg-red-active'"; echo "data-toggle='tooltip' title='Something went wrong'"; } ?>><?php echo  $this->Number->precision($row['amount'],2); ?></span></td>
                 
                <?php  $g_total += $row['amount'];  ?>
              
          </tr>
           <?php endforeach; ?>
          
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
              <th style="width:80%">Grand Total:</th>
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