<?php
     function url(){
      
        $currentPath = $_SERVER['PHP_SELF']; 
        $pathInfo = pathinfo($currentPath); 
        $hostName = $_SERVER['HTTP_HOST']; 
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
        return $protocol.$hostName.$pathInfo['dirname']."/";
    }
?>
<?php if(!empty($data)){ $details = $data[0]; } ?>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> Class : <?php if(!empty($class_name)){ echo $class_name  ."|  Shift : ".$shift_name ; } ?>
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
        <table class="table table-striped table-bordered">
          <thead>
          <tr>
              <th style="width:5%;">Photo</th>
              <th style="width:8%;">CC#|Roll#|GR#</th>
                <th style="width:12%;">Student Name</th>
                <th style="width:12%;">Father Name</th>
                <th style="width:10%;">Class</th>
                <th style="width:10%;">Contact</th>
                <th style="width:25%;">Monthly Fee</th>
                <th style="width:20%;">Other Fee</th>
                <th style="width:10%;text-align: right;">Amount</th>
           </tr>
          </thead>
          <tbody>
         <?php $g_total = 0; foreach($mdata as $row): ?> 
           <?php  if($this->Number->precision($row['amount'],2) > 0): ?>   
          <tr>
                <?php  $image = url()."img/students_images/".$row['pic']; ?>
                <td><?php echo $this->Html->image($image, ['alt' => 'student Picture', 'class' => 'profile-user-img img-responsive','style'=>'width:30px;']); ?></td>
                <td><?php echo $row['registration_id'].'|'.$row['roll_no'].'|'.$row['gr_no'];  ?> </td>
                <td><?php echo $row['s_name'];  ?> </td>
                <td><?php echo $row['f_name'];  ?> </td>
                <td><?php echo $row['class'];  ?> </td>
                <td><?php echo $row['contact'];  ?> </td>
                <td><?php echo $row['dues'];  ?> </td>
                <td><?php echo $row['other'];  ?> </td>
                <td style="text-align: right;"><?php echo $this->Number->precision($row['amount'],2);  ?> </td>
                <?php  $g_total += $row['amount'];  ?>
              
          </tr>
          <?php endif; ?>
          
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
            <tr>
              <th style="width:70%">Grand Total:</th>
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