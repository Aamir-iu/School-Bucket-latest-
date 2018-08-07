<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <?php $date = date("Y-m-d h:i"); ?>
          <i class="fa fa-globe"></i> Financial Statement :   <?php echo date('d-M-Y', strtotime($from)); ?> To  <?php echo date('d-M-Y', strtotime($to)); ?> Shift : <?php echo $shift_name; ?>
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
              
              <th style="width:40%;">Income</th>
              <th style="width:40%;text-align: left;">Fee Types</th>
              <th style="width:20%;text-align: center;">Amount</th>
            
              
           </tr>
          </thead>
          <tbody>
         <?php $revenue = 0; foreach($income as $row): ?>   
            <tr>
              
                <td><?php echo "-";  ?> </td>
                <td style="width:40%;text-align: left;"><?php echo $row['fee_type'];  ?> </td>
                <td style="width:40%;text-align: center;"><?php echo $this->Number->precision($row['income'],2);  ?> </td>
               
                <?php $revenue += $row['income'];  ?>
               
                  
              
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
              <th style="width:76%">Income</th>
              <td><?php echo $this->Number->precision($revenue,2); ?></td>
            </tr>
           </table>
        </div>
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
              
              <th style="width:10%;">Expanse</th>
              <th style="width:20%;text-align: left;">Account Head</th>
              <th style="width:50%;text-align: left;">Description</th>
              <th style="width:20%;text-align: center;">Amount</th>
            
              
           </tr>
          </thead>
          <tbody>
         <?php $exp = 0; foreach($expanse as $row): ?>   
            <tr>
              
                <td><?php echo "-";  ?> </td>
                <td style="width:20%;text-align: left;"><?php echo $row['ma'].'-'.$row['ca'].'-'.$row['sca'].'-'.$row['ta'].'-'.$row['ta_name'];  ?> </td>
                <td style="width:50%;text-align: left;"><?php echo $row['expanse_desc']  ?> </td>
                <td style="width:20%;text-align: center;"><?php echo $this->Number->precision($row['amount'],2);  ?> </td>
               
                <?php $exp += $row['amount'];  ?>
               
                  
              
          </tr>
         <?php endforeach; ?>
          
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
     
    <?php $sal = 0; foreach($salary as $row): ?>   
            
              
                <?php $this->Number->precision($row['empsalary'],2);  ?>
               
                <?php $sal += $row['empsalary'];  ?>
               
    <?php endforeach; ?>

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
         
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
       
        <div class="table-responsive">
          <table class="table">
              <tr class="danger">
              <th style="width:76%">Expanse</th>
              <td><?php echo $this->Number->precision($exp,2); ?></td>
            </tr>
           </table>
        </div>
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
              <tr class="danger">
              <th style="width:76%">Salary Expanse</th>
              <td><?php echo $this->Number->precision($sal,2); ?></td>
            </tr>
           </table>
        </div>
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
              <tr class="warning">
              <th style="width:76%">Cash In Hand</th>
              <td><?php echo $this->Number->precision($revenue - $exp - $sal,2); ?></td>
            </tr>
           </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    
    
  </section>
  <!-- /.content -->
  <div>
                                    
<p>Prepared by:__________________&nbsp; Received by:_________________________</p>

</div>
</div>

<!-- ./wrapper -->
<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<script>
  
   $(document).ready(function(){
    
    $('#dis_id').html($('#cid').val());
    
    
    });
   
  function goBack() {
    window.history.back();
  }  
  
   
    
</script>    