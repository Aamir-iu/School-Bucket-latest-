<?php 

    function generateGrade($per = null){
        if( $per >= 90 ){
                $grade = "A-1";
                //$remarks = $grades['remarks_vii'];
            }
            elseif( $per >= 80 ){

                $grade = "A-1"; 
                //$remarks = $grades['remarks_vi'];  
            }
            elseif( $per >= 70 ){

                $grade = "A"; 
                //$remarks = $grades['remarks_v'];  
            }
            elseif( $per >= 60 ){

                $grade = "B"; 
                //$remarks = $grades['remarks_iv']; 
            }
            elseif( $per >= 50 ){

                $grade = "C"; 
                //$remarks = $grades['remarks_iii']; 
            }
            elseif( $per >= 40 ){

                $grade = "D"; 
                //$remarks = $grades['remarks_ii']; 
            }
            elseif( $per >= 33 ){
                $grade = "E"; 
                //$remarks = $grades['remarks_i']; 
            }
            else{
                $grade = "F"; 
                //$remarks = "Need to work very hard"; 
            }
            
            return $grade;
    }

?>

<style>
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
            <div class="col-xs-3 col-xs-offset-4" style="border-bottom:2px solid black;text-align: center;font-weight: bold;">
               SESSION   <?php echo $shift_name; ?>
            </div>
            <br />
            <br />
            <div>
                <table style='width: 100%;'>

                    <tr style="border: 0px solid black;">
                        <td class="nob" style='text-align: left;width:20%;'>Issue Date :</td>
                        <td class="nob" style='text-align: left;width:50%;font-weight: bold;text-decoration: underline;'><?= date("d-M-Y"); ?></td>
                        <td class="nob" style='text-align:left;width:10%;'>ID # :</td>
                        <td class="nob" style='text-align: center;width:20%;font-weight: bold;text-align: left;'><?= $row['registration_id']; ?></td>
                    </tr>
                    
                    <tr style="border: 0px solid black;">
                        <td class="nob" style='text-align: left;width:20%;'>Name of Student :</td>
                        <td class="nob" style='text-align: left;width:50%;font-weight: bold;text-decoration: underline;'><?= $row['sname']; ?></td>
                        <td class="nob" style='text-align:left;width:10%;'>G.R # :</td>
                        <td class="nob" style='text-align: center;width:20%;font-weight: bold;text-align: left;'><?= $row['gr_no']; ?></td>
                    </tr>
                    
                    <tr style="border: 0px solid black;">
                        <td class="nob" style='text-align: left;width:20%;'>Father's Name :</td>
                        <td class="nob" style='text-align: left;width:50%;font-weight: bold;text-decoration: underline;'><?= $row['fname']; ?></td>
                        <td class="nob" style='text-align:left;width:10%;'>Roll # :</td>
                        <td class="nob" style='text-align: center;width:20%;font-weight: bold;text-align: left;'><?= $row['roll']; ?></td>
                    </tr>
                    
                    <tr style="border: 0px solid black;">
                         <?php   $temp = (explode(":",$row['class']));   ?>
                        <td class="nob" style='text-align: left;width:20%;'>Class :</td>
                        <td class="nob" style='text-align: left;width:50%;font-weight: bold;text-decoration: underline;'><?php  echo $temp[0] ?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Section : <?php echo   $temp[1]; ?> </td>
                        <td class="nob" style='text-align:left;width:10%;'>Shift #: </td>
                        <td class="nob" style='text-align: center;width:20%;font-weight: bold;text-align: left;'><?= $row['shift']; ?></td>
                    </tr>

                </table>

            </div>

            <table style='width: 100%;margin-top:20px'>

                <tr>
                    <th rowspan="2" style="width:25%;">Subject</th>
                    <th rowspan="2">Max Marks</th>
                    <th rowspan="2">Passing Marks</th>
                    <th>Test I</th>
                    <th>Mid Term</th>
                    <th rowspan="2">Mid Term Result</th>
                    <th>Test II</th>
                    <th>Final Term</th>
                    <th rowspan="2">Final Term Result</th>
                    <th colspan="2">Final Result Cumulative</th>
                </tr> 
                <tr>
                    <th>Marks Obt.</th>
                    <th>Marks Obt.</th>
                    <th>Marks Obt.</th>
                    <th>Marks Obt.</th>
                    <th>Marks MM.</th>
                    <th>Marks Obt.</th>
                </tr>
             
            <?php $final_mm_marks=0; $final_om_marks=0; $final_test_marks=0; $final_ob_marks=0; $t=0; $p=0; $tm =0; $om=0; $tom = 0;  $i=0; foreach ($row['exam_details'] as $detail): ?>    
                <tr>
                    <td style="width:20%;text-align: left;margin-left:10px; "> &nbsp;&nbsp;<?= str_replace('|', '', $detail['subject']); ?></td>
                    <td><?= $detail['max_marks']; ?></td>
                        <?php  $t += is_numeric($detail['max_marks']) ? $detail['max_marks'] : 0;    ?>
                    <td><?= $detail['min_marks']; ?></td>
                        <?php  $p += is_numeric($detail['min_marks']) ? $detail['min_marks'] : 0;    ?>
                    <td><?= $detail['test_obtain_marks']; ?></td>
                        <?php  $tm += is_numeric($detail['test_obtain_marks']) ? $detail['test_obtain_marks'] : 0;    ?>
                    <td><?= $detail['obtain_marks']; ?></td>
                        <?php  $om += is_numeric($detail['obtain_marks']) ? $detail['obtain_marks'] : 0;    ?>
                    
                    <?php if(is_numeric($detail['max_marks'])): ?>
                    <td style='<?php echo $p > $tm + $om ? "text-decoration:underline;font-weight: bold;" : "text-decoration:none;";  ?>'><?= $detail['total_obtain_marks']; ?></td>
                    <?php else: ?>
                    <td style='<?php echo $p > $tm + $om ? "text-decoration:underline;font-weight: bold;" : "text-decoration:none;";  ?>'><?= $detail['obtain_marks']; ?></td>
                    <?php endif; ?>
                    
                    <?php  $tom += is_numeric($detail['total_obtain_marks']) ? $detail['total_obtain_marks'] : 0;    ?>
                    


                    <td><?= $row['preResult'][0]['exam_result_detail'][$i]['test_obtain_marks'] ?></td>
                    <td><?= $row['preResult'][0]['exam_result_detail'][$i]['obtain_marks'] ?></td>
                    
                    <?php $final_test_marks += is_numeric($row['preResult'][0]['exam_result_detail'][$i]['test_obtain_marks']) ? $row['preResult'][0]['exam_result_detail'][$i]['test_obtain_marks'] : 0; ?>
                    <?php $final_ob_marks += is_numeric($row['preResult'][0]['exam_result_detail'][$i]['obtain_marks']) ? $row['preResult'][0]['exam_result_detail'][$i]['obtain_marks'] : 0; ?>
                    
                    <?php if(is_numeric($detail['max_marks'])): ?>
                    <td><?= $row['preResult'][0]['exam_result_detail'][$i]['total_obtain_marks'] ?></td>
                    <?php else: ?>
                    <td><?= $row['preResult'][0]['exam_result_detail'][$i]['obtain_marks'] ?></td>
                    <?php endif; ?>
                        

                    <?php  $final_mm = is_numeric($detail['max_marks']) ? $detail['max_marks'] : 0;    ?>

                    <?php if(is_numeric($detail['max_marks'])): ?>
                    <td><?= $final_mm*2; ?></td>
                    <?php  $final_mm_marks += $final_mm*2; ?>
                    <?php else: ?>
                    <td><?= $detail['max_marks'] ?></td>
                    <?php endif; ?>


                    <?php  $Final_tom = is_numeric($detail['total_obtain_marks']) ? $detail['total_obtain_marks'] : 0;    ?>

                    <?php $final_obtain_marks = is_numeric($row['preResult'][0]['exam_result_detail'][$i]['total_obtain_marks']) ? $row['preResult'][0]['exam_result_detail'][$i]['total_obtain_marks'] : 0; ?>

                    <?php if(is_numeric($detail['max_marks'])): ?>
                    <td><?= $Final_tom + $final_obtain_marks; ?></td>
                    <?php  $final_om_marks += $Final_tom + $final_obtain_marks; ?>
                    <?php else: ?>
                    <td><?= $row['preResult'][0]['exam_result_detail'][$i]['obtain_marks'] ?></td>
                    <?php endif; ?>


                </tr>
            <?php $i++; endforeach;?> 
                
                <tfoot>
                    <th span='2'>TOTAL</th>

                    <th><?php echo  $t; ?></th>
                    <th><?php echo  $p; ?></th>
                    <th><?php echo  $tm; ?></th>
                    <th><?php echo  $om; ?></th>
                    <th><?php echo  $tom; ?></th>

                    <th><?= $final_test_marks ?></th>
                    <th><?= $final_ob_marks ?></th>
                    <th><?= $row['preResult'][0]['obtain_marks'] ?></th>

                    <th><?= $final_mm_marks ?></th>
                    <th><?= $final_om_marks ?></th>
                    
                </tfoot>
                
            </table>
        </div>
        <?php 
           $final_grade = generateGrade(round($final_om_marks / $final_mm_marks * 100,2)); 
           if($final_grade === "F"){
               $final_result = "failed";
           }else{
               $final_result = "Passed";
           }
        ?>
        <div style="margin-top: 10px">
            <table style='width: 100%;'>
                <tr>
                    <td rowspan="2" width="20%">Summer Vacation's  Assignment</td>
                    <td width="20%">Result</td>
                    <td style="font-weight:bold;width:20%;"><?= $row['result']; ?></td>
                    <td style="font-weight:bold;width:20%;"><?= $row['preResult'][0]['result'] ?></td>
                    <td style="font-weight:bold;width:20%;"><?= $final_result ?></td>
                </tr>
                <tr>
                    <td width="20%">Percentage</td>
                    <td style="font-weight:bold;width:20%;"><?= $row['grade'] == 'F' ? '0.00' :$row['per']  ?>%</td>
                    <td style="font-weight:bold;width:20%;"><?= $row['preResult'][0]['per'] ?>%</td>
                    <td style="font-weight:bold;width:20%;"><?=  $final_grade == 'F' ? '0.00' : round($final_om_marks / $final_mm_marks * 100,2) ?>%</td>

                </tr>
                <tr>
                    <td rowspan="2" style="font-weight:bold;width:20%;"><?php  if(!empty($row['generalObservation'][0])){ echo $row['generalObservation'][0]['sv']; } ?></td>
                    <td width="20%">Grade</td>
                    <td style="font-weight:bold;width:20%;"><?=  $row['grade'] == 'F' ? '-' : $row['grade'] ?></td>
                    <td style="font-weight:bold;width:20%;"><?= $row['preResult'][0]['grade'] == 'F' ? '-' : $row['preResult'][0]['grade']; ?></td>
                    <td style="font-weight:bold;width:20%;"><?= $final_grade ?></td>
                </tr>
                <tr>
                    <td width="20%">Rank</td>
                    <td style="font-weight:bold;width:20%;"><?= $row['no_of_rank'] === '' ? '-' : $row['no_of_rank']; ?></td>
                    <td style="font-weight:bold;width:20%;"><?= '-'//$row['preResult'][0]['no_of_rank']; ?></td>
                    <td style="font-weight:bold;width:20%;"><?= $row['preResult'][0]['cum_no_of_rank'] === '' ? '-' : $row['preResult'][0]['cum_no_of_rank'] ?></td>

                </tr>
                <tr>
                    <td rowspan="2" width="20%">&nbsp;</td>
                    <td width="20%">Out of</td>
                    <td style="font-weight:bold;width:20%;"><?= $out_of; ?></td>
                    <td style="font-weight:bold;width:20%;"><?= $out_of; ?></td>
                    <td style="font-weight:bold;width:20%;"><?= $out_of; ?></td>
                </tr>
                <tr>
                    <td width="20%">Attendance</td>
                    <td style="font-weight:bold;width:20%;"><?= $row['att']; ?> Out of <?= $row['out_of']; ?></td>
                    <td style="font-weight:bold;width:20%;"><?=  $row['preResult'][0]['att']; ?> Out of <?=  $row['preResult'][0]['out_of']; ?></td>
                    <td style="font-weight:bold;width:20%;"><?=  $row['preResult'][0]['att'] + $row['att']; ?> Out of <?=  $row['preResult'][0]['out_of'] + $row['out_of']; ?></td>

                </tr>
                <tr>
                    <td rowspan="2" width="20%">Class Teacher Signature.</td>

                </tr>
                <tr>
                    <td>Remarks</td>
                <?php if($row['grade'] === 'F' && $row['preResult'][0]['grade'] != 'F' ): ?>
                    <td style="font-weight:bold;text-align: left;" colspan="4">&nbsp;<?= "Passed basis on the final term" ?></td>
                <?php elseif($row['grade'] === 'F' && $row['preResult'][0]['grade'] === 'F' ): ?>
                    <td style="font-weight:bold;text-align: left;" colspan="4">&nbsp;<?= "Need to work very hard"; ?></td>
                <?php else: ?>
                    <td style="font-weight:bold;text-align: left;" colspan="4">&nbsp;<?= $row['remarks']; ?></td>
                <?php endif; ?>    
                </tr>



            </table>
        </div>
        <h4 style="text-align:center;margin-top: 5px;">GENERAL OBSERVATION</h4>
        <div style="margin-top: 10px;">
            <table style='width: 100%;'>
                <tr>
                    <th>TERM</th>
                    <th>HOME WORK</th>
                    <th>READING</th>
                    <th>WRITING</th>
                    <th>CLEANLINESS</th>

                </tr>
                <tr>
                    <td>MID</td>
                    <td><?php  if($row['generalObservation'][0]){ echo $row['generalObservation'][0]['home_work']; } ?></td>
                    <td><?php  if($row['generalObservation'][0]){ echo $row['generalObservation'][0]['reading']; } ?></td>
                    <td><?php  if($row['generalObservation'][0]){ echo $row['generalObservation'][0]['writing']; } ?></td>
                    <td><?php  if($row['generalObservation'][0]){ echo $row['generalObservation'][0]['cleanliiness']; } ?></td>
                </tr>
                <tr>
                    <td>FINAL</td>
                    <td><?php  if($row['generalObservationFinal'][0]){ echo $row['generalObservationFinal'][0]['home_work']; } ?></td>
                    <td><?php  if($row['generalObservationFinal'][0]){ echo $row['generalObservationFinal'][0]['reading']; } ?></td>
                    <td><?php  if($row['generalObservationFinal'][0]){ echo $row['generalObservationFinal'][0]['writing']; } ?></td>
                    <td><?php  if($row['generalObservationFinal'][0]){ echo $row['generalObservationFinal'][0]['cleanliiness']; } ?></td>
                </tr>
            </table>
        </div>
        <br />
         <br />
        <div class="col-xs-3" style="border-top:solid black;text-align: center;">
               Principal Sign. 
        </div>
        <div class="col-xs-3 pull-right" style="border-top:solid black;text-align: center;">
              Guardian Sign. 
        </div>

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