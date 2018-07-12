<?php
     function url(){
      
        $currentPath = $_SERVER['PHP_SELF']; 
        $pathInfo = pathinfo($currentPath); 
        $hostName = $_SERVER['HTTP_HOST']; 
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
        return $protocol.$hostName.$pathInfo['dirname']."/";
    }
?>
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
          <i class="fa fa-globe"></i>
          <span style="font-size:15px;">
          General Report : | <?php if($registration){ echo  $registration[0]['class_name']; echo " | Shift : ";  echo  $registration[0]['shift_id'] ==1? 'Morning'  : ''; echo  $registration[0]['shift_id'] ==2? 'afternoon'  : ''; echo  $registration[0]['shift_id'] ==3? 'Evening'  : ''; }    ?>
          
          </span>
          <div class="tools pull-right">
                    <a href="javascript:window.print()" class="fa fa-print hidden-sm hidden-xs" data-original-title="" title="Print">
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
              
              <th style="width:3%;">Reg. ID</th>
              <th style="width:3%;">G.R ID</th>
              <th style="width:3%;">Roll No</th>
              <th style="width:10%;">Student Name</th>
              <th style="width:10%;">Father Name</th>
              <?php for ($i=1; $i<=$cols; $i++):   ?>
              <th style="width:2%;"></th>
              <?php endfor;   ?>
              
              
           </tr>
          </thead>
          <tbody>
         <?php $m = 0; $f = 0; foreach($registration as $row): ?>   
          <input type="hidden" id="cid" value="<?php // echo $row['class_name']; ?>">
          <tr>
                <td><?php echo $row['registration_id'];  ?> </td>
                <td><?php echo $row['grno'];  ?> </td>
                <td><?php echo $row['roll_no'];  ?> </td>
               
                <td><?php echo $row['s_name'];  ?> </td>
                <td><?php echo $row['f_name'];  ?> </td>
                
                <?php for ($i=1; $i<=$cols; $i++):   ?>
                <td></td>
                <?php endfor;   ?>
           
              
          </tr>
         <?php endforeach; ?>
          
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
    
     $('#dis_id').html($('#cid').val());
    
    
    });
   
  function goBack() {
    window.history.back();
  }  
  
   
    
</script>    