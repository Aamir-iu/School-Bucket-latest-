<?php if(!empty($data)){ $details = $data[0]; } ?>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i>Attendance Record on : <?php  if(!empty($details['date'])){ echo $details['date']; }?>
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
              <th style="width:15%;">Registration ID</th>
              <th style="width:35%;">Student Name</th>
              <th style="width:35%;">Father Name</th>
              <th style="width:15%;">Status</th>
             
           </tr>
          </thead>
          <tbody>
         <?php $a = 0; $p = 0; $l = 0; $balance = 0; foreach($data as $row): ?>     
          <tr>
                <td><?php echo $row['reg_id'];  ?> </td>
                <td><?php echo $row['s_name'];  ?> </td>
                <td><?php echo $row['f_name'];  ?> </td>
                <td><?php if($row['status']=='P'){ $p += 1; echo "<span style='color:blue;'>Present<span>"; }elseif($row['status']=='A') { $a += 1; echo "<span style='color:red;font-weight:bold;'>Absent<span>"; }elseif($row['status']=='L') { $l += 1; echo "Leave"; }   ?> </td>
                
                
               
              
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
              <th style="width:70%">Total Present:</th>
              <td ><?php  echo $p; ?></td>
            </tr>
            <tr class="danger">
              <th style="width:70%">Total Absent:</th>
              <td><?php  echo $a; ?></td>
            </tr>
            <tr class="info">
              <th style="width:70%">Total Leave:</th>
              <td><?php  echo $l; ?></td>
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