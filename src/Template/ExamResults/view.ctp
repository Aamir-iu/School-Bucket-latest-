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
          <i class="fa fa-globe"></i>Tabulation Report :  <?php  if($data){ echo $data[0]['class'] ." | " .$data[0]['shift']; } ?><span id="dis_id"></span>
          <div class="tools pull-right">
                    <a href="javascript:window.print()" class="fa fa-print hidden-sm" data-original-title="" title="Print">
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
    <?php foreach($data as $row): ?>
    
          <table class="" style="width:100%;">
               
          <tbody>
                       
              <tr>
                  
                  <th clas="hids">IDs</th>
                  <th class="hnames">Student Name</th>
                  <th class="hsub">Subjects</th>
                  
                  <?php foreach($row['exam_details'] as $detail): ?>
                  <th class="hids"><?= $detail['sub_desc'];  ?></th>
                  <?php endforeach; ?>
                
                  <th class="hsub">Total Marks</th>
                  <th class="hids">Avg.</th>
                  <th class="hids">Grade.</th>
                  <th class="hids">Rank.</th>
                  <th class="hnames">Att.</th>
                  
              </tr>
              
              <tr>
                  <td class="hids"><?= $row['registration_id'];  ?></td>
                  <td class="hnames"><?= $row['sname'];  ?> </td>
                  <td class="hsub">Test-I</td>
                  
                  <?php foreach($row['exam_details'] as $detail): ?>
                  <?php $condition = $detail['test_obtain_marks']; ?>
                  <td class="hids" style="<?php echo $condition == 'Abs' || $condition == 'Abs.' || $condition == 'abs' || $condition == 'abs.' || $condition == 'Absent.' || $condition == 'Absent' ? 'background-color:red;color:white;font-weight:bold' : '';   ?>"><?= $detail['test_obtain_marks'];  ?></td>
                  <?php endforeach; ?>
                  <td class="hsub">-</td>
                  <td class="hids">-</td>
                  <td class="hids">-</td>
                  <td class="hids">-</td>
                  <th class="hnames">-</th>
              </tr>
              
              <tr>
                  <td class="hids"><?= $row['roll'];  ?></td>
                  <td class="hnames"><?= $row['fname'];  ?> </td>
                  <td class="hsub">Mid Term</td>
                  
                  <?php foreach($row['exam_details'] as $detail): ?>
                  <?php $condition = $detail['obtain_marks']; ?>
                  <td class="hids" style="<?php echo $condition == 'Abs' || $condition == 'Abs.' || $condition == 'abs' || $condition == 'abs.' || $condition == 'Absent.' || $condition == 'Absent' ? 'background-color:red;color:white;font-weight:bold' : '';   ?>"><?= $detail['obtain_marks'];  ?></td>
                  <?php endforeach; ?>
                  <td class="hsub">-</td>
                  <td class="hids">-</td>
                  <td class="hids">-</td>
                  <td class="hids">-</td>
                  <th class="hnames">-</th>
              </tr>
              
              <tr>
                  <td class="hids"><?= $row['gr_no'];  ?></td>
                  <td class="hnames">-</td>
                  <td class="hsub">Total</td>
                  
                  <?php foreach($row['exam_details'] as $detail): ?>
                  <td class="hids"><?= $detail['total_obtain_marks'];  ?></td>
                  <?php endforeach; ?>
                  
                  <td class="hsub"><?= $this->Number->precision($row['obtain_marks'],2);  ?>/<?= $this->Number->precision($row['total_marks'],0);  ?></td>
                  <td class="hids"><?= $this->Number->precision($row['per'],2);  ?></td>
                  <td class="hids" style="<?php echo $row['grade'] == 'F'  ? 'background-color:red;color:white;font-weight:bold' : '';   ?>"><?= $row['grade'];  ?></td>
                  <td class="hids" style="<?php if($row['rank'] == '1st' ){ echo  'background-color:green;color:white;font-weight:bold'; }elseif($row['rank'] == '2nd'){ echo  'background-color:orange;color:white;font-weight:bold'; }elseif($row['rank'] =='3rd'){ echo  'background-color:skyblue;color:white;font-weight:bold';}   ?>"><?= $row['rank'];  ?></td>
                  <td class="hnames"><?= $row['att'];  ?>/<?= $row['out_of'];  ?></td>
                   
              </tr>
             
              
          </tbody>

        </table>
          <br />
    <?php endforeach; ?>      
          
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
  
   
  function goBack() {
    window.history.back();
  }  
  
   
    
</script>    