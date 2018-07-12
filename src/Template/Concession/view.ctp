<style>
 @media screen and (orientation:landscape) {
    }   
</style> 

<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
            <i class="fa fa-globe"></i>Concession Report : <?php  echo $id == 1 ? 'Half Concession' : 'Full Concession';   ?> 
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
        <table class="table table-container table-bordered">
          <thead>
          <tr>
              <th style="width:5%;">ID</th>
              <th style="width:10%;">CC#</th>
              <th style="width:15%;">Student Name</th>
              <th style="width:15%;">Father Name</th>
              <th style="width:15%;">Fee Amount</th>
              <th style="width:15%;">From Date</th>
              <th style="width:15%;">To Date</th>
            
           </tr>
          </thead>
          <tbody>
          
            <?php  foreach($data as $rows): ?>   
                   <tr>
                       
                      <td><?php echo $rows['id_concession'];  ?> </td> 
                      <td><?php echo $rows['registration_id'];  ?> </td>
                      <td><?php echo $rows['sname'];  ?> </td>
                      <td><?php echo $rows['fname'];  ?> </td>
                      <td><?php echo $rows['amount'] === null ? 0 : $rows['amount'] ;  ?> </td>
                      <td><?php echo date('d-M-Y ', strtotime($rows['from_date']));  ?> </td>
                      <td><?php echo date('d-M-Y ', strtotime($rows['to_date']));  ?> </td>
               
                      
                      
                      

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
