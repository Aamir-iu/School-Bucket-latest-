<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i>New Admission report :  From  <?= date("d-m-Y", strtotime($f)) ?> To <?= date("d-m-Y", strtotime($t)) ?>
          
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
      <div class="col-xs-12">
        <table class="table table-striped table-responsive">
          <thead>
          <tr>
              
              <th style="width:10%;">CC|Roll|GR</th>
              <th style="width:13%;">Student Name</th>
              <th style="width:13%;">Father Name</th>
              <th style="width:9%;">Class</th>
              <th style="width:11%;">D.O.A</th>
              <th style="width:5%;">Gender</th>
              <th style="width:8%;">Father's Cell</th>
              <th style="width:8%;">Guardian's Cell</th>
              <th style="width:8%;">Student's Cell</th>
              <th style="width:15%;">Address</th>
              
              
           </tr>
          </thead>
          <tbody>
         <?php $m = 0; $f = 0; foreach($registration as $row): ?>   
          <input type="hidden" id="cid" value="<?php  echo $row['class_name']; ?>">
          <tr>
                <td><?php echo $row['registration_id']." | ".$row['roll_no']." | ".$row['grno'];  ?> </td>
                <td><?php echo $row['s_name'];  ?> </td>
                <td><?php echo $row['f_name'];  ?> </td>
                <td><?php echo $row['class_name'];  ?> </td>
                <td><?php echo $row['reg_date'];  ?> </td>
                <td><?php echo $row['gender'];  ?> </td>
                <td><?php echo $row['contact'];  ?> </td>
                <td><?php echo $row['cont2'];  ?> </td>
                <td><?php echo $row['cont3'];  ?> </td>
                <td><?php echo $row['add'];  ?> </td>
               
                <?php  if($row['gender']=='Male'){ $m++; } ?> 
                <?php  if($row['gender']=='Female'){ $f++; } ?>  
              
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
              <th style="width:80%">Male</th>
              <td><?php echo $m; ?></td>
            </tr>
            <tr class="warning">
              <th style="width:80%">Female</th>
              <td><?php echo $f; ?></td>
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
    
    $('#dis_id').html($('#cid').val());
    
    
    });
   
  function goBack() {
    window.history.back();
  }  
  
   
    
</script>    