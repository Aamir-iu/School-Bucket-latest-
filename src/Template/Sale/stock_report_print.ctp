<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <?php //echo "<pre>"; print_r($data);exit; ?>
   
    <div class="row">
    
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <h4>Institution Details:</h4>
        <address>
          <strong><?= $this->request->session()->read('Info.school'); ?></strong><br>
          Address :<?= $this->request->session()->read('Info.address'); ?><br>
          Phone:  <?= $this->request->session()->read('Info.phone'); ?><br>
          
        </address>
      </div>
      <!-- /.col -->
     
      <!-- /.col -->

    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table">
          <thead>
          <tr>
            <th>Serial #</th>  
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Unit Price</th>
            <th>Units Per Pack </th>
            <th>Pack Price</th>
            <th>Sale Price</th>
            <th>Stock in Hand</th>
            
            <th>Total</th>
          </tr>
          </thead>
          <tbody>
            <?php $sub_total = 0; $grand_total = 0; $discount = 0; ?>    
            <?php foreach($data as $index=>$details): ?>    
                <tr style="background-color:lightgoldenrodyellow; ">
                    <td colspan="9"><?php echo $index;  ?></td>
                </tr>     

                <?php $i=1; foreach($details as $row): ?>  
                    <tr>
                      <td><?= $i ?></td>
                      <td><?= $row['id_products'] ?></td>
                      <td><?= $row['product_name'] ?></td>
                      <td><?= $row['unit_price'] ?></td>
                      <td><?= intval($row['unit_per_pack']) ?></td>
                      <td><?= $row['pack_price'] ?></td>
                      <td><?= intval($row['stock']) ?></td>
                      <td><?= $row['sale_price'] ?></td>
                      <td><?= $row['stock'] * $row['sale_price'] ?></td>

                      <?php  $grand_total +=  $row['stock'] * $row['sale_price']; ?>

                    </tr>
                <?php $i++; endforeach; ?>
                
            <?php $i++; endforeach; ?>
    
                
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      
      
      <!-- /.col -->
      <div class="col-xs-6">
       

        <div class="table-responsive">
          <table class="table">
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