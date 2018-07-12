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
                  
                  <th clas="hids">ID</th>
                  <th class="hnames">Student Name</th>
                  <th class="hsub">Father's Name</th>
                  
                  <?php foreach($subjectDetails as $detail): ?>
                  <th class="hids"><?= $detail['sub'];  ?><br /><?= $detail['sub_desc'];  ?></th>
                  <?php endforeach; ?>
                
                  <th class="hsub">Total Marks</th>
                  <th class="hids">Avg.</th>
                  <th class="hids">Grade.</th>
                  <th class="hids">Rank.</th>
                  <th class="hnames">Att.</th>
                  
              </tr>

              <tr>
                  <td><?= $row['registration_id'] ?></td>
                  <td><?= $row['sname'] ?></td>
                  <td><?= $row['fname'] ?></td>

                  <!-- <?php foreach($row['exam_details'] as $detail): ?>
                  <th class="hids"><?= $detail['obtained_marks'];  ?></th>
                  <?php endforeach; ?> -->
              <?php if($row['exam_details']): ?>    
                 <?php $count = count($subjectDetails)-1; ?> 
                 <?php for($i=0; $i<=$count; $i++): ?>

                  <?php if(isset($row['exam_details'][$i])): ?>
                  <th class="hids"><?= $row['exam_details'][$i]['obtained_marks'];  ?></th>
                  <?php else: ?>
                    <td>-</td>
                  <?php endif; ?>

                <?php endfor; ?>  

                  <td><?= $row['exam_details'][0]['total_obtained'] ?>/<?= $row['exam_details'][0]['total_marks'] ?></td>
                  <td><?= $row['exam_details'][0]['per'] ?></td>
                  <td><?= $row['exam_details'][0]['grade'] ?></td>


                  <?php foreach($row['exam_details'] as $detail): ?>
                  <?php if($detail['no_of_rank'] !== ''): ?>

                <?php
                 $rank =   $detail['no_of_rank'];   
                    if( $rank === '1st' ){
                        $my_rank = $detail['no_of_rank'];   
                    }elseif($rank === '2nd'){
                        $my_rank = $detail['no_of_rank'];   
                    
                    }elseif($rank === '3rd'){
                        $my_rank = $detail['no_of_rank'];   
                    
                    }elseif($rank === '4th'){
                        $my_rank = $detail['no_of_rank'];   
                    }elseif($rank === '5th'){
                        $my_rank = $detail['no_of_rank'];   
                    }elseif($rank === '6th'){
                        $my_rank = $detail['no_of_rank'];   
                    }
                    elseif($rank === '8th'){
                        $my_rank = $detail['no_of_rank'];   
                    }
                    elseif($rank === '9th'){
                        $my_rank = $detail['no_of_rank'];   
                    }
                    elseif($rank === '10th'){
                        $my_rank = $detail['no_of_rank'];   
                    }
                    else{
                        $my_rank = "-";
                    }

                 ?>    


                  <th class="hids" style="<?php if($my_rank == '1st' ){ echo  'background-color:green;color:white;font-weight:bold'; }elseif($my_rank == '2nd'){ echo  'background-color:orange;color:white;font-weight:bold'; }elseif($my_rank =='3rd'){ echo  'background-color:skyblue;color:white;font-weight:bold';}   ?>"><?= $my_rank;  ?></th>
                  <?php break; else: ?>
                    <td>-</td>
                  <?php break; endif; ?>                  
                  <?php endforeach; ?>

                  <td><?= $row['exam_details'][0]['marks_attendance'] ?>/<?= $row['exam_details'][0]['total_attetance'] ?></td>

             <?php else: ?> 
              
              <?php $count = count($subjectDetails)-1; ?> 
              <?php for($i=0; $i<=$count; $i++): ?>
                <td>-</td>
               <?php endfor; ?>    
              <td>-</td>  
              <td>-</td>   
              <td>-</td>
              <td>-</td>
              <td>-</td>

             <?php endif; ?>     

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
