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
}
   
    
</style> 

<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
            <i class="fa fa-globe"></i>Attendance Report : <?php  echo isset($department) ? $department : ''; ?> 
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
        <table class="" width="100%">
          <thead>
          <tr>
              <th style="width:4%;text-align:center;">CC#</th>
           
              <th style="width:28%;"> &nbsp;Employee Name</th>
<!--              <th style="width:15%;">Father Name</th>-->
              <?php for($i = 1; $i<=31; $i++): ?>
              <th style="width:2%;"><?php echo $i; ?></th>
              <?php endfor; ?>
           </tr>
          </thead>
          <tbody>
          
            <?php  foreach($mdata as $rows): ?>   
                   <tr>
                    <td style="text-align: center;"><?php echo $rows['employee_id'];  ?> </td>
                   
                      
                    <td style="text-align: left;"> &nbsp;<?php echo $rows['name'];  ?> </td>
                  
                    
                    <td><?php if(isset($rows['d1'])){ echo $rows['d1']; }  ?> </td>
                    <td><?php if(isset($rows['d2'])){ echo $rows['d2']; }  ?> </td>
                    <td><?php if(isset($rows['d3'])){ echo $rows['d3']; }  ?> </td>
                    <td><?php if(isset($rows['d4'])){ echo $rows['d4']; }  ?> </td>
                    <td><?php if(isset($rows['d5'])){ echo $rows['d5']; }  ?> </td>
                    
                    
                    <td><?php if(isset($rows['d6'])){ echo $rows['d6']; }  ?> </td>
                    <td><?php if(isset($rows['d7'])){ echo $rows['d7']; }  ?> </td>
                    <td><?php if(isset($rows['d8'])){ echo $rows['d8']; }  ?> </td>
                    <td><?php if(isset($rows['d9'])){ echo $rows['d9']; }  ?> </td>
                    <td><?php if(isset($rows['d10'])){ echo $rows['d10']; }  ?> </td>
                    
                    
                    <td><?php if(isset($rows['d11'])){ echo $rows['d11']; }  ?> </td>
                    <td><?php if(isset($rows['d12'])){ echo $rows['d12']; }  ?> </td>
                    <td><?php if(isset($rows['d13'])){ echo $rows['d13']; }  ?> </td>
                    <td><?php if(isset($rows['d14'])){ echo $rows['d14']; }  ?> </td>
                    <td><?php if(isset($rows['d15'])){ echo $rows['d15']; }  ?> </td>
                    
                    <td><?php if(isset($rows['d16'])){ echo $rows['d16']; }  ?> </td>
                    <td><?php if(isset($rows['d17'])){ echo $rows['d17']; }  ?> </td>
                    <td><?php if(isset($rows['d18'])){ echo $rows['d18']; }  ?> </td>
                    <td><?php if(isset($rows['d19'])){ echo $rows['d19']; }  ?> </td>
                    <td><?php if(isset($rows['d20'])){ echo $rows['d120']; }  ?> </td>
                    
                    <td><?php if(isset($rows['d21'])){ echo $rows['d21']; }  ?> </td>
                    <td><?php if(isset($rows['d22'])){ echo $rows['d22']; }  ?> </td>
                    <td><?php if(isset($rows['d23'])){ echo $rows['d23']; }  ?> </td>
                    <td><?php if(isset($rows['d24'])){ echo $rows['d24']; }  ?> </td>
                    <td><?php if(isset($rows['d25'])){ echo $rows['d25']; }  ?> </td>
                    
                    <td><?php if(isset($rows['d26'])){ echo $rows['d26']; }  ?> </td>
                    <td><?php if(isset($rows['d27'])){ echo $rows['d27']; }  ?> </td>
                    <td><?php if(isset($rows['d28'])){ echo $rows['d28']; }  ?> </td>
                    <td><?php if(isset($rows['d29'])){ echo $rows['d29']; }  ?> </td>
                    <td><?php if(isset($rows['d30'])){ echo $rows['d30']; }  ?> </td>
                    <td><?php if(isset($rows['d31'])){ echo $rows['d31']; }  ?> </td>
                    
                       

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
