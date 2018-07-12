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
        font-family: Times New Roman,arial, sans-serif;
        border-collapse: collapse;
        font-weight: bold;
        font-size:  15px;;
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
   <?php $page = 1;$j=0; foreach ($data as $row): ?> 
    
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
                                <?php echo $this->Html->image($image, ['alt' => 'student Picture', 'class' => 'profile-user-img img-responsive','style'=>'width:100px;height:130px;']); ?>

                                
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
                            <td class="nob" style='text-align: center;width:30%;font-weight: bold;text-align: left;'><?= $row['gr_no'] == '' ? '-' :$row['gr_no']; ?></td>
                        </tr>
                        
                    </table>
            </div>
            <br />

            <table style='width: 100%;margin-top:5px'>
               
                 <tr>
                    <th rowspan="2" style="width:30%;">Subjects</th>
                    
                    <th rowspan="2">Total Marks</th>
                    
                    <th>First Term</th>
                    <th>Mid Term</th>
                    <th>Final Term</th>
                    
                    <th rowspan="2">Final Term Result</th>
                    
                </tr> 
                <tr>
                    <th>Marks Obt.</th>
                    <th>Marks Obt.</th>
                    <th>Marks Obt.</th>
                    <!-- <th>Marks Obt.</th>
                    <th>Marks Obt.</th>
                    <th>Marks Obt.</th> -->
                </tr>
                
              <?php $pr = isset($row['preResult'][0]['exam_result_detail']) ? $row['preResult'][0]['exam_result_detail'] : ''; ?>
              <?php $sec = isset($row['secResult'][0]['exam_result_detail']) ? $row['secResult'][0]['exam_result_detail'] : ''; ?>
               
            <?php $t=0; $p=0; $tm =0; $om=0; $tom = 0;$k=0; foreach ($row['exam_details'] as $detail): ?>    
                <tr>
                    <?php $sub = explode('|', $detail['subject']) ?>
                    <td style="width:30%;text-align: left;">&nbsp;&nbsp;<?= $sub[0] .' '.strtoupper($detail['sub_type']); ?></td>
                   
                    <td><?= $detail['max_marks']; ?></td>

                    <!-- 1st Term -->
                    <?php if(isset($pr[$k])):  ?>
                    <td><?php echo $pr[$k]['obtain_marks'];  ?></td>
                    <?php else:  ?>
                     <td></td>
                    <?php endif;  ?>

                    <!-- 2nd Term -->
                    <?php if(isset($sec[$k])):  ?>
                    <td><?php echo $sec[$k]['obtain_marks'];  ?></td>
                    <?php else:  ?>
                     <td></td>
                    <?php endif;  ?>
                    
                    <!-- Final Term -->
                    <?php  $p = is_numeric($detail['min_marks']) ? $detail['min_marks'] : 0;    ?>
                    <td><?= $detail['obtain_marks']; ?></td>
                    
                    
                    <?php  $tm = is_numeric($detail['test_obtain_marks']) ? $detail['test_obtain_marks'] : 0;    ?>
                    <?php  $om = is_numeric($detail['obtain_marks']) ? $detail['obtain_marks'] : 0;    ?>
                    
                    <?php  if( $detail['obtain_marks'] === 'A' && is_numeric($detail['min_marks'])): ?>
                    <?php else: ?>
                    <td><?php echo $p > $tm + $om ? "Failed" : "Passed";  ?></td>
                    <?php $k++; endif; ?>  
                    
                </tr>
            <?php endforeach;?>     
               
                
            </table>
        </div>
        <div style="margin-top: 0px;">
            <table style='width: 100%;'>
                
                <tr style="height:50px;">
                    
                    <th style='width: 10%;'>EXAM TERMS</th>
                    <th style='width: 10%;'>GRAND TOTAL</th>
                    <th style='width: 10%;'>TOTAL MARKS OBTAINED</th>
                    <th style='width: 10%;'>PERCENTAGE</th>
                    <th style='width: 10%;'>GRADE</th>
                    <th style='width: 10%;'>RESULT</th>
                    <th style='width: 10%;'>RANK IN CLASS</th>
                    <th style='width: 10%;'>ATTENDANCE</th>
                    <th style='width: 20%;'>REMARKS</th>
                     
                </tr>
                <?php if($pr != ''): ?>
                <tr>
                    <td>First Term</td>
                    <td><?= $row['preResult'][0]['total_marks']; ?></td>
                    <td><?= $row['preResult'][0]['obtain_marks']; ?></td>
                    <td><?= $row['preResult'][0]['grade'] == 'F' ? '0.00' :$row['preResult'][0]['per']  ?>%</td>
                    <td><?= $row['preResult'][0]['grade']; ?></td>
                    <td><?= $row['preResult'][0]['result']; ?></td>
                    <td><?= $row['preResult'][0]['no_of_rank']; ?></td>
                    <td><?= $row['preResult'][0]['att']; ?>/<?= $row['preResult'][0]['out_of']; ?></td>
                    <td><?= $row['preResult'][0]['remarks']; ?></td>
                </tr>
                <?php else: ?> 
                    <td>-</td>
                    <td-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                
               <?php endif; ?>


               <?php if($sec != ''): ?>
                <tr>
                    <td>Mid Term</td>
                    <td><?= $row['secResult'][0]['total_marks']; ?></td>
                    <td><?= $row['secResult'][0]['obtain_marks']; ?></td>
                    <td><?= $row['secResult'][0]['grade'] == 'F' ? '0.00' :$row['secResult'][0]['per']  ?>%</td>
                    <td><?= $row['secResult'][0]['grade']; ?></td>
                    <td><?= $row['secResult'][0]['result']; ?></td>
                    <td><?= $row['secResult'][0]['no_of_rank']; ?></td>
                    <td><?= $row['secResult'][0]['att']; ?>/<?= $row['secResult'][0]['out_of']; ?></td>
                    <td><?= $row['secResult'][0]['remarks']; ?></td>
                </tr>
                <?php else: ?> 
                    <td>-</td>
                    <td-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                
               <?php endif; ?>

                <tr>
                    <td>Final Term</td>
                    <td><?= $row['total_marks']; ?></td>
                    <td><?= $row['obtain_marks']; ?></td>
                    <td><?= $row['grade'] == 'F' ? '0.00' :$row['per']  ?>%</td>
                    <td><?= $row['grade']; ?></td>
                    <td><?= $row['result']; ?></td>
                    <td><?= $row['no_of_rank']; ?></td>
                    <td><?= $row['att']; ?>/<?= $row['out_of']; ?></td>
                    <td><?= $row['remarks']; ?></td>
                </tr>

                
                
            </table>
        </div>
        
         <div style="margin-top: 10px;">
            <table style='width: 100%;'>
                
                <tr style="height:20px;">
                    
                    <th style='width: 10%;'>TEST MARKS</th>
                    <th style='width: 10%;'>GRAND TOTAL</th>
                    <th style='width: 10%;'>TOTAL MARKS OBTAINED</th>
                    <th style='width: 10%;'>PERCENTAGE</th>
<!--                    <th style='width: 10%;'>GRADE</th>
                    <th style='width: 10%;'>RESULT</th>
                    <th style='width: 10%;'>RANK IN CLASS</th>
                    <th style='width: 20%;'>REMARKS</th>-->
                     
                </tr>
                
                <tr>
                    <td>First Term Test</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    
                </tr>

                <tr>
                    <td>Mid Term Test</td>
                    <td><?= $row['secResult'][0]['test_mm']; ?></td>
                    <td><?= $row['secResult'][0]['test_om']; ?></td>
                    <?php if($row['secResult'][0]['test_mm'] > 0 ): ?>
                    <td><?= round($row['secResult'][0]['test_om'] / $row['secResult'][0]['test_mm'] * 100,2) ?>%</td>
                    <?php else: ?>
                      <td>0</td>  
                    <?php endif; ?>    
                </tr>

               
                <tr>
                    <td>Final Term Test</td>
                    <td><?= $row['test_mm']; ?></td>
                    <td><?= $row['test_om']; ?></td>
                    <?php if($row['test_mm'] > 0 ): ?>
                    <td><?= round($row['test_om'] / $row['test_mm'] * 100,2) ?>%</td>
                    <?php else: ?>
                      <td>0</td>  
                    <?php endif; ?>    
                   
                </tr>
<!--                <tr>
                   <td>Final Term Test</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                   
                </tr>
                -->
                
            </table>
        </div>
      
       <br />
        <br />
         <br />
        <div class="col-xs-12 pull-left">
               <?php echo $row['created_by']; ?> 
        </div>
       
        <div class="col-xs-2" style="border-top:solid black;text-align: left;">
              Prepared By. 
        </div>
        
         <div class="col-xs-2 col-xs-offset-3" style="border-top:solid black;text-align: center;">
            Checked By.  
        </div>
        
        <div class="col-xs-2 pull-right" style="border-top:solid black;text-align: center;">
             Principal Sign.  
        </div>

        <br/>
         <br/>
        <div class="col-xs-12">
              <p>This is computer generated result error and omission are expected.</p>
        </div> 
    </section>
    <!-- /.content -->
   
    <?php if($page == 1): ?>
    <div class="page-break"></div>
    <?php $page = 0; endif; ?>
    <?php $page++; $j++; endforeach; ?>
       
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