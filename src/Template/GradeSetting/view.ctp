<style>
    @media screen and (orientation:landscape) {
       }   
   td{


       border: 2px solid black;
       text-align: center;
   }
   tr{
       border: 2px solid black;
   }
   th{
       border: 2px solid black;
       text-align: center;
   }
   .hids{
       width:5%;
   }
   .hnames{
       width:15%;
   }
   .hsub{
       width:10%;
   }
    
</style> 
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i>General Observation : <span id="dis_id"></span> | <?= $shift_name; ?>
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
        <table class="" style="width:100%;">
          <thead>
          <tr>
              
              <th style="width:10%;">CC|Roll|GR</th>
              <th style="width:15%;">Student Name</th>
              <th style="width:15%;">Father Name</th>
              <th style="width:10%;">Home Work</th>
              <th style="width:10%;">Reading</th>
              <th style="width:10%;">Writing</th>
              <th style="width:10%;">Cleanliness</th>
              <th style="width:10%;">S.V Assign.</th>
              
              
           </tr>
          </thead>
          <tbody>
         <?php $m = 0; $f = 0; foreach($registration as $row): ?>   
          <input type="hidden" id="cid" value="<?php  echo $row['class_name']; ?>">
          <tr>
                <td><?php echo $row['registration_id']." | ".$row['roll_no']." | ".$row['grno'];  ?> </td>
                <td><?php echo $row['s_name'];  ?> </td>
                <td><?php echo $row['f_name'];  ?> </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
               
               
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
              <tr>
              <th style="width:80%">Boys</th>
              <td><?php echo $m; ?></td>
            </tr>
            <tr>
              <th style="width:80%">Girls</th>
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