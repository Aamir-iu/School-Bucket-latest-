<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <?php //echo "<pre>"; print_r($sale); ?>
   
    <div class="row">
    
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong><?= $this->request->session()->read('Info.school'); ?></strong><br>
          Address :<?= $this->request->session()->read('Info.address'); ?><br>
          Phone:  <?= $this->request->session()->read('Info.phone'); ?><br>
          Date: <?php echo date('d-m-Y h:i A', strtotime($sale['created_on'])); ?><br>
          -
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong><?= strtoupper($sale['customer_name']) ?></strong><br>
          Invoice #<?= $sale['id_sale'] ?><br>
          Payment Mode: <?= $sale['payment_type'] ?><br>
          Customer Type: <?= $sale['customer_type'] ?><br>
          User Name: <?= $sale['user']['full_name'] ?>
        </address>
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
            <th>Serial #</th>  
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Unit Qty.</th>
            <th>Unit Price</th>
            <th>Sub Total</th>
            <th>Discount</th>
            <th>Total</th>
          </tr>
          </thead>
          <tbody>
            <?php $sub_total = 0; $grand_total = 0; $discount = 0; ?>  
            <?php $i=1; foreach($sale['sale_details'] as $row): ?>  
                <tr>
                  <td><?= $i ?></td>
                  <td><?= $row->product_id ?></td>
                  <td><?= $row->product_name ?></td>
                  <td><?= $row->unit_qty ?></td>
                  <td><?= $row->unit_price ?></td>
                  <td><?= $row->sub_total ?></td>
                  <td><?= $row->discount_amount ?></td>
                  <td><?= $row->grand_total ?></td>
                  
                  <?php  $sub_total +=  $row->sub_total; ?>
                  <?php  $discount +=  $row->discount_amount; ?>
                  <?php  $grand_total +=  $row->grand_total; ?>
                  
                  
                  
                </tr>
            <?php $i++; endforeach; ?>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
        <p class="lead">Note:</p>
        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
         <?= $sale['message'] ?>
        </p>
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
       

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td><?php echo $this->Number->precision($sub_total,2); ?></td>
            </tr>
            <tr>
              <th>Discount</th>
              <td><?php echo $this->Number->precision($discount,2); ?></td>
            </tr>
           
            <tr>
              <th>Grand Total:</th>
              <td><?php echo $this->Number->precision($grand_total,2); ?></td>
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
         window.print();
    });  
    
</script>