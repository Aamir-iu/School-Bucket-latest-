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
          <i class="fa fa-globe"></i>Top 10 Student's list : <span id="dis_id"></span> | <?= $shift_name; ?>
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
              
              <th style="width:5%;">CC|Roll|GR</th>
              <th style="width:10%;">Student Name</th>
              <th style="width:10%;">Fsther Name</th>
              <th style="width:10%;">Total</th>
              <th style="width:5%;">Avg.</th>
              <th style="width:5%;">Grade</th>
              <th style="width:5%;">Result</th>
              <th style="width:5%;">Rank</th>
              <th style="width:5%;">Att.</th>
              <th style="width:15%;">Remarks</th>
              
              
           </tr>
          </thead>
          <tbody>
         <?php $m = 0; $f = 0; foreach($topstudents as $row): ?>   
          <input type="hidden" id="cid" value="<?php  echo $row['class']; ?>">
          <tr>
                <td><?php echo $row['registration_id']." | ".$row['roll']." | ".$row['gr_no'];  ?> </td>
                <td><?php echo $row['sname'];  ?> </td>
                <td><?php echo $row['fname'];  ?> </td>
                <td><?php echo $row['obtain_marks'];  ?> /<?php echo $row['total_marks'];  ?> </td>
                <td><?php echo $this->Number->precision($row['per'],2);  ?> </td>
                <td><?php echo $row['grade'];  ?> </td>
                <td><?php echo $row['result'];  ?> </td>
                <td><?php echo $row['no_of_rank'];  ?> </td>
                <td><?php echo $row['att'];  ?> /<?php echo $row['out_of'];  ?> </td>
                <td><?php echo $row['remarks'];  ?> </td>
          </tr>
         <?php endforeach; ?>
          
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
 
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