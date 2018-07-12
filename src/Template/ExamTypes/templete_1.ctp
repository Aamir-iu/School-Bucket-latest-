  
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
    @media print {
    body {-webkit-print-color-adjust: exact;}
    }
    
    @media screen and (orientation:landscape) {
    }   
    td{


        border: 2px solid black;
        text-align: center;
    }
    .nob{
        border: 0px;
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
    .invoice {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        font-weight: bold;
    }
    
    @media print {
            .page-break	{ display: block; page-break-before: always; }
    }
    @page{
    margin-left: 25px;
    margin-right: 25px;
    margin-top: 150px;
    margin-bottom: 50px;
    }
</style> 
<div class="wrapper">
   <?php $page = 1; foreach ($data as $row): ?> 
    
    <!-- Main content -->
    <section class="invoice">
     
            
        
        <div style="margin-top:0px">
          
            <div>
                 <table style='width: 100%;'>
                         <tr style="border: 0px solid black;">
                            <td class="nob" style='text-align: left;width:20%;'>Name of Student :</td>
                            <td class="nob" style='text-align: left;width:40%;font-weight: bold;'><?= $row['sname']; ?></td>
                            <td rowspan="7" style="border: 0px solid black;">
                                <?php  $image = url()."img/students_images/".$row['img']; ?>
                                <?php echo $this->Html->image($image, ['alt' => 'student Picture', 'class' => 'profile-user-img img-responsive','style'=>'width:120px;']); ?>

                                
                            </td>
                        </tr>
                         <tr style="border: 0px solid black;">
                            <td class="nob" style='text-align: left;width:20%;'>Father's Name :</td>
                            <td class="nob" style='text-align: left;width:40%;font-weight: bold;'><?= $row['fname']; ?></td>
                        </tr>
                         <tr style="border: 0px solid black;">
                            <td class="nob" style='text-align: left;width:20%;'>Class :</td>
                            <td class="nob" style='text-align: left;width:40%;font-weight: bold;'><?= $row['class']; ?></td>
                        </tr>
                        <tr style="border: 0px solid black;">
                            <td class="nob" style='text-align: left;width:20%;'>Shift :</td>
                            <td class="nob" style='text-align: left;width:40%;font-weight: bold;'><?= $row['shift']; ?></td>
                        </tr>
                        <tr style="border: 0px solid black;">
                            <td class="nob" style='text-align:left;width:10%;'>ID # :</td>
                            <td class="nob" style='text-align: center;width:30%;font-weight: bold;text-align: left;'><?= $row['registration_id']; ?></td>
                        </tr>
                        
                        <tr style="border: 0px solid black;">
                            <td class="nob" style='text-align:left;width:10%;'>Roll # :</td>
                            <td class="nob" style='text-align: center;width:30%;font-weight: bold;text-align: left;'><?= $row['roll']; ?></td>
                        </tr>
                        <tr style="border: 0px solid black;">
                            <td class="nob" style='text-align:left;width:10%;'>GR # :</td>
                            <td class="nob" style='text-align: center;width:30%;font-weight: bold;text-align: left;'><?= $row['gr_no']; ?></td>
                        </tr>
                        
                    </table>
            </div>
            
             <br />
            <div class="col-xs-6 col-xs-offset-3" style="background-color: darkblue !important;color:white !important;text-align: center;font-size:15px;">
                DETAILS STATEMENT OF MARKS
            </div>
            <br />
            

            <table style='width: 100%;margin-top:10px'>
             
                 <tr style="color:black !important;">
                    <th style="width:30%; color:black!important;">SUBJECTS</th>
                    
                    <th style="color:black!important;">Max. Test Marks</th>
                    <th style="color:black!important;">Test Marks Obtained</th>
                    
                    <th style="color:black!important;">Max. Exam Marks</th>
                    <th style="color:black!important;">Exam Marks Obtained</th>
                    
                    
                    <th style="color:black!important;">Total Max. Marks</th>
                    <th style="color:black!important;">Total Marks Obtained</th>
                    <th style="width:10%;color:black!important;">Remarks</th>
                   
                </tr>
            <?php
            $fmm = 0;
            $fom = 0;
            $smm = 0;
            $som = 0;
            $tmm = 0;
            $tom = 0;
            $remark = '';
            ?>
            <?php $t=0; $p=0; $tm =0; $om=0; $tom = 0; foreach ($row['exam_details'] as $detail): ?>    
                <tr>
                    
                    <td style="width:20%;text-align: left;">&nbsp;&nbsp;<?= $detail['subject']; ?></td>
                    <?php
                    
                    $fmm +=  is_numeric($detail['max_marks']) ? $detail['max_marks'] : 0;
                    $fom +=  is_numeric($detail['obtain_marks']) ? $detail['obtain_marks'] : 0;
                    
                    $smm +=  is_numeric($detail['fmm']) ? $detail['fmm'] : 0;
                    $som +=  is_numeric($detail['fom']) ? $detail['fom'] : 0;
                    
                    $tmm +=  is_numeric($detail['tmm']) ? $detail['tmm'] : 0;
                    $tom +=  is_numeric($detail['total_obtain_marks']) ? $detail['total_obtain_marks'] : 0;
                    
                    ?>
                    
                    <td><?= $detail['fmm']; ?></td>
                    <td><?= $detail['fom']; ?></td>
              
                    <td><?= $detail['max_marks']; ?></td>
                    <td><?= $detail['obtain_marks']; ?></td>
                    
                   
                    <?php  $p = is_numeric($detail['tpm']) ? $detail['tpm'] : 0;    ?>
                    
                    
                    <?php if(is_numeric($detail['max_marks'])): ?>
                    <td><?= $detail['tmm']; ?></td>
                    <?php else: ?>
                    <td><?= $detail['max_marks']; ?></td>
                    <?php endif; ?>
                    
                    
                    
                    <?php if(is_numeric($detail['obtain_marks'])): ?>
                    <td><?= $detail['total_obtain_marks']; ?></td>
                    <?php else: ?>
                    <td><?= $detail['obtain_marks']; ?></td>
                    <?php endif; ?>
                  
                   <?php  $om = is_numeric($detail['total_obtain_marks']) ? $detail['total_obtain_marks'] : 0;    ?> 
                        
                <?php if($p > $om  && $row['remarks'] === 'Promoted'): ?> 

                    <td><?php echo "Promoted";  ?></td>
                 
                <?php elseif ($p > $om): ?>
                    <td><?php echo "Failed";  ?></td>
                    

                <?php else: ?>
                    <td><?php echo "Cleared";  ?></td>
                <?php endif; ?>    
                    
                </tr>
            <?php endforeach;?>     
               <tr style="background-color: lightblue!important;">
                    <th style="width:20%;">TOTAL</th>
                    
                    <th><?= $smm ?></th>
                    <th><?= $som ?></th>
                    
                    
                    <th><?= $fmm ?></th>
                    <th><?= $fom ?></th>
     
                    
                    <th><?= $tmm ?></th>
                    <th><?= $tom ?></th>
                    
                    <th style="width:10%;"></th>
                   
                </tr>
                
            </table>
        
        
       
        <div class="col-xs-6 col-xs-offset-3" style="background-color: darkblue !important;color:white !important;text-align: center;font-size:15px;margin-top: 5px;">
            DETAILS STATEMENT OF RESULT
        </div>
        
        <br /> <br />
       
        <div class="row" style="margin-left:4px;margin-right:4px;margin-top: 5px;">
            
            <div class="col-xs-5" style="border: 2px solid #000000;text-align: center;">
               GRAND TOTAL  <?= $this->Number->precision($row['obtain_marks'],2); ?> OUT OF <?= $row['total_marks']; ?>
            </div>
          
            <div class="col-xs-4" style="border: 2px solid #000000;text-align: center;">
               PERCENTAGE &nbsp;&nbsp;&nbsp; <?= $row['grade'] == 'F' ? '0.00' :$row['per']  ?>%
            </div>
            
            <div class="col-xs-3" style="border: 2px solid #000000;text-align: center;">
               GRADE &nbsp;&nbsp;&nbsp; <?= $row['grade']; ?>
            </div>
            
        </div>
        
        <br />
        <div class="row" style="margin-left:4px;margin-right:4px;">
            
            <div class="col-xs-4" style="border: 2px solid #000000;text-align: center;">
               RESULT &nbsp;&nbsp; <?= $row['result']; ?>
            </div>
          
            <div class="col-xs-8" style="border: 2px solid #000000;text-align: center;">
               ATTENDANCE <?= $row['att']; ?> OUT OF <?= $row['out_of']; ?> PERCENTAGE  <?php if($row['att']){ echo  round($row['att']/$row['out_of'] *100,2); } ?>%
            </div>
            
         
        </div>
        
        <br />
         <div class="row" style="margin-left:4px;margin-right:4px;">
            
            <div class="col-xs-4" style="border: 2px solid #000000;text-align: center;">
               RANK &nbsp;&nbsp; <?= $row['no_of_rank']; ?>
            </div>
          
            <div class="col-xs-8" style="border: 2px solid #000000;text-align: center;">
               HIGHEST PERCENTAGE IN THE CLASS  <?= $HP['per']; ?> %
            </div>
          
        </div>
        
       
        
     
<!--     
         <div class="col-xs-3 col-xs-offset-1" style="border-top:solid black;text-align: center;">
            DATE.
        </div>
        
        <div class="col-xs-3 col-xs-offset-1" style="border-top:solid black;text-align: center;">
             TEACHER SIGN.  
        </div>

        <div class="col-xs-3 pull-right" style="border-top:solid black;text-align: center;">
             PRINCIPAL SIGN.  
        </div>-->


    <br />
    </section>
    <!-- /.content -->
   
    <?php if($page == 1): ?>
    <div class="page-break"></div>
    <?php $page = 0; endif; ?>
    <?php $page++; endforeach; ?>
    
</div>
<!-- ./wrapper -->
<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<script>

    $(document).ready(function () {

        $('#dis_id').html($('#cid').val());


    });

    function goBack() {
        window.history.back();
    }



</script>    