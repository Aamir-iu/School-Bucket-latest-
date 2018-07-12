<?php if(!empty($data)){ $details = $inquiry[0]; } ?>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> Inquiry Report from  <?php echo date('d-m-Y h:i', strtotime($from)); ?> To  <?php echo date('d-m-Y h:i', strtotime($to)); ?>
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
              <th style="width:5%;">S.No</th>
                <th style="width:15%;">First Name</th>
                <th style="width:15%;">Last Name</th>
                <th style="width:10%;">Contact</th>
                <th style="width:10%;">Class</th>
                <th style="width:10%;">Area</th>
                <th style="width:20%;">Remarks</th>
                <th style="width:15%;">Address</th>
           </tr>
          </thead>
          <tbody>
         <?php $i=1;  foreach($inquiry as $row): ?>     
          <tr>
                <td><?php echo $i;  ?> </td>
                <td><?php echo $row['f_name'];  ?> </td>
                <td><?php echo $row['l_name'];  ?> </td>
                <td><?php echo $row['contact'];  ?> </td>
                <td><?php echo $row->classes_section['class_name'];  ?> </td>
                <td><?php echo $row->area['area_name'];  ?> </td>
                <td><?php echo $row['remarks'];  ?> </td>
                <td><?php echo $row['address'];  ?> </td>
                
                
                
                
              
          </tr>
         <?php $i++; endforeach; ?>
          
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