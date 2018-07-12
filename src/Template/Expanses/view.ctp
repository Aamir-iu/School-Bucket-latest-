<?php $details = $data[0]; ?>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> Expanse Voucher
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
    <!-- info row -->
    <div class="row invoice-info">
       <div class="col-sm-4 invoice-col">
        <address>
          <strong>Voucher Details</strong><br>
          <b>Voucher #<?php echo $details['voucher_number']; ?></b><br>
        <b>Voucher Date:</b> <?php echo $details['expanse_date']; ?><br>
        <b>Created By :</b> <?php echo $details['user']['full_name']; ?>
        </address>
      </div>  
        
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
              <th style="width:10%;">Transaction ID</th>
                <th style="width:65%;">Description.</th>
                <th style="width:35%;">Amount</th>
           </tr>
          </thead>
          <tbody>
         <?php $g_total = 0; $paid = 0; $balance = 0; foreach($data as $row): ?>     
          <tr>
                <td><?php echo $row['id_expanses'];  ?> </td>
                <td><?php echo $row['expanse_desc'];  ?> </td>
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
          <strong> Amount In words :  <?php echo $this->AmountToWords->convert_number_to_words($g_total)." only"; ?></strong>
           
           <p class="bold" style="margin-top: 50px;">
           Signature_________________________
           </p>
           
           
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
       
        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Grand Total:</th>
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