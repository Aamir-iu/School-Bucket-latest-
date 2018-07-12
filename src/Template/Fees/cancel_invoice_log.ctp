<?php //if(!empty($data)){ $details = $data[0]; } ?>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
             <?php $date = date("Y-m-d h:i"); ?>
          <i class="fa fa-globe"></i>Cancelled Invoices
          <div class="tools pull-right">
                    <a href="javascript:window.print()" class="fa fa-print" data-original-title="" title="Print">
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
              <th style="width:8%;">Invoice#</th>
              <th style="width:8%;">Reg. ID</th>
              <th style="width:12%;">Student Name</th>
              <th style="width:12%;">Father Name</th>
               <th style="width:8%;">Fee Type</th>
              <th style="width:8%;">Month</th>
              <th style="width:8%;">Amount</th>
              <th style="width:34%;">Canclled By</th>
              
           </tr>
          </thead>
          <tbody>
       
         <?php  foreach($data as $row): ?>    
          <tr>
              
                <td><?php echo $row['inv_no'];  ?> </td>
                <td><?php  echo $row['reg_id'];  ?> </td>
                <td><?php echo $row['name'];  ?> </td>
                <td><?php echo $row['fname'];  ?> </td>
                <td><?php echo $row['type_id'];  ?> </td>
                <td><?php echo $row['month_id'];  ?> </td>
                <td><?php echo $row['amount'];  ?> </td>
                <td><?php echo $row['remarks'];  ?> </td>
                
              
          </tr>
           <?php endforeach; ?>
          
          </tbody>
        </table>
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