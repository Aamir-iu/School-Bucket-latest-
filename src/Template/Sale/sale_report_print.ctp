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
      <div class="col-sm-4 invoice-col">
        <h4>Summary Details:</h4>
        <address>
          From Date : <?php echo date('d-m-Y', strtotime($from_date)); ?><br>
          To Date : <?php echo date('d-m-Y', strtotime($from_date)); ?><br>
        </address>
      </div>
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
            <th>Unit Qty.</th>
            <th>Unit Price</th>
            <th>Sub Total</th>
            <th>Discount</th>
            <th>Total</th>
          </tr>
          </thead>
          <tbody>
            <?php $sub_total = 0; $grand_total = 0; $discount = 0; ?>    
            <?php foreach($data as $index=>$details): ?>    
                <tr style="background-color:lightblue; ">
                    <td colspan="8"><?php echo $index;  ?></td>
                </tr>     

                <?php $i=1; foreach($details as $row): ?>  
                    <tr>
                      <td><?= $i ?></td>
                      <td><?= $row['p_id'] ?></td>
                      <td><?= $row['p_name'] ?></td>
                      <td><?= $row['uq'] ?></td>
                      <td><?= $row['up'] ?></td>
                      <td><?= $row['subtotal'] ?></td>
                      <td><?= $row['discount'] ?></td>
                      <td><?= $row['total'] ?></td>

                      <?php  $sub_total +=  $row['subtotal']; ?>
                      <?php  $discount +=  $row['discount']; ?>
                      <?php  $grand_total +=  $row['total']; ?>

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