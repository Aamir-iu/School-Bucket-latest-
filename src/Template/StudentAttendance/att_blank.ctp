<style>
 @media screen and (orientation:landscape) {} 

/*.table { border: 2px solid black; }
.table thead > tr > th { border-bottom: block; }
.table thead > tr > th, .table tbody > tr > th, .table tfoot > tr > th, .table thead > tr > td, .table tbody > tr > td, .table tfoot > tr > td { border: 2px solid black; }
 */
td{
  
  
    border: 2px solid black;
}
tr{
    border: 2px solid black;
}
th{
    border: 2px solid black;
}

</style> 

<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
            <i class="fa fa-globe"></i>Attendance Report :  <?php  echo $data[0]['class'].' | '.$data[0]['shift'].' |  for the month of____________________ '; // date("M-Y"); ?>  
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
          <table width="100%" class="">
          <thead>
          <tr>
              <th style="width:4%;text-align:center;">CC#</th>
              <th style="width:3%;">Roll#</th>
              <th style="width:3%;">GR#</th>
              
              <th style="width:22%;">Student |Father Name</th>
<!--              <th style="width:15%;">Father Name</th>-->
              <?php for($i = 1; $i<=31; $i++): ?>
              <th style="width:2%;"><?php echo $i; ?></th>
              <?php endfor; ?>
              
              <th style="width:2%;">P</th>
              <th style="width:2%;">L</th>
              <th style="width:2%;">T</th>
              
           </tr>
          </thead>
          <tbody>
         <?php  foreach($data as $rows): ?>   
                <tr>
                      <td style="text-align:center;"><?php echo $rows['registration_id'];  ?> </td>
                      <td style="text-align:center;"><?php echo $rows['roll_no'];  ?> </td>
                      <td style="text-align:center;"><?php echo $rows['gr_no'];  ?> </td>
                      
                      <td><?php echo $rows['sname'];  ?> <br /><?php echo $rows['fname'];  ?>  </td>
                      
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      
                      
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
