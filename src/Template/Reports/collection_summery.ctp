
<?php //if(!empty($data)){ $details = $data[0]; } ?>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
             <?php $date = date("Y-m-d h:i"); ?>
          <i class="fa fa-globe"></i>Fee Collection Summery : Month :  <?php echo  $month .'-'. date('Y'); ?>  Fee Type :  <?php echo $type_name; ?>
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
             
              <th style="width:30%;">Class Name</th>
              <th style="width:10%;">No of Students</th>
              <th style="width:10%;">Current Class Fee</th>
              <th style="width:10%;">Actual Amount</th>
              <th style="width:10%;">Estimated Amount</th>
              <th style="width:10%;">Difference</th>
              <th style="width:10%;">Received Amount</th>
              <th style="width:10%;">Pending Amount</th>
              
              
              
           </tr>
          </thead>
          <tbody>
              
         <?php $r=0; $d =0; $t =0; $s=0; $cf=0; $af=0; $con=0; foreach($data as $index=>$value): ?> 
             
          
          <tr>
               
               <td><?php echo $index;  ?> </td>
               <td><?php echo $value['total_students']; ?></td>
               <td><?php echo $this->Number->precision($value['fee'],2); ?></td>
               
              
               
               <td><?php echo $this->Number->precision($value['total_students'] * $value['fee'],2); ?></td>
               
               <?php $ac_amount = $value['total_students'] * $value['fee']; ?>
               
               <?php $cur_amount = $value['received'] + $value['dues']; ?>
               
               
              <td><?php echo $this->Number->precision($value['received'] + $value['dues'],2); ?></td>
               
               
               
               <td><?php echo $this->Number->precision($ac_amount - $cur_amount ,2); ?></td>
               
               <td><?php echo $this->Number->precision($value['received'],2); ?></td>
               <td><?php echo $this->Number->precision($value['dues'],2); ?></td>
               
               <?php  $s += $value['total_students']; ?>
               <?php  $cf += $value['fee']; ?>
               <?php  $af += $ac_amount; ?>
               <?php  $t += $value['received'] + $value['dues']; ?>
               <?php  $con += $ac_amount - $cur_amount; ?>
               
               <?php  $r += $value['received']; ?>
               <?php  $d += $value['dues']; ?>
               
              
          </tr>
         
          
         <?php endforeach; ?>
          
          <tfoot>
          <tr>
             
              <th style="width:30%;">Grand Total</th>
              <th style="width:10%;"><?php echo $s; ?></th>
              <th style="width:10%;"><?php echo '-'; //$this->Number->precision($cf,2); ?></th>
              <th style="width:10%;"><?php echo $this->Number->precision($af,2); ?></th>
              <th style="width:10%;"><?php echo $this->Number->precision($t,2); ?></th>
              <th style="width:10%;"><?php echo $this->Number->precision($con ,2); ?></th>
              <th style="width:10%;"><?php echo $this->Number->precision($r,2); ?></th>
              <th style="width:10%;"><?php echo $this->Number->precision($d,2); ?></th>
              
              
              
           </tr>
          </tfoot>
          
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