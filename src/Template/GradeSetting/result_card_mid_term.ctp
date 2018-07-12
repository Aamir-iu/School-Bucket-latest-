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
            <div class="col-xs-3 col-xs-offset-4" style="border-bottom:2px solid black;text-align: center;font-weight: bold;">
               SESSION   <?php echo $shift_name; ?>
            </div>
            <br />
            <br />
            <div>
                <table style='width: 100%;'>

                    <tr style="border: 0px solid black;">
                        <td class="nob" style='text-align: left;width:20%;'>Issue Date :</td>
                        <td class="nob" style='text-align: left;width:40%;font-weight: bold;'><?= date("d-M-Y"); ?></td>
                        <td class="nob" style='text-align:left;width:10%;'>ID # :</td>
                        <td class="nob" style='text-align: center;width:30%;font-weight: bold;text-align: left;'><?= $row['registration_id']; ?></td>
                    </tr>
                    
                    <tr style="border: 0px solid black;">
                        <td class="nob" style='text-align: left;width:20%;'>Name of Student :</td>
                        <td class="nob" style='text-align: left;width:40%;font-weight: bold;'><?= $row['sname']; ?></td>
                        <td class="nob" style='text-align:left;width:10%;'>G.R # :</td>
                        <td class="nob" style='text-align: center;width:30%;font-weight: bold;text-align: left;'><?= $row['gr_no']; ?></td>
                    </tr>
                    
                    <tr style="border: 0px solid black;">
                        <td class="nob" style='text-align: left;width:20%;'>Father's Name :</td>
                        <td class="nob" style='text-align: left;width:40%;font-weight: bold;'><?= $row['fname']; ?></td>
                        <td class="nob" style='text-align:left;width:10%;'>Roll # :</td>
                        <td class="nob" style='text-align: center;width:30%;font-weight: bold;text-align: left;'><?= $row['roll']; ?></td>
                    </tr>
                    
                    <tr style="border: 0px solid black;">
                        <td class="nob" style='text-align: left;width:20%;'>Class :</td>
                        <td class="nob" style='text-align: left;width:40%;font-weight: bold;'><?= $row['class']; ?></td>
                        <td class="nob" style='text-align:left;width:10%;'>Shift #: </td>
                        <td class="nob" style='text-align: center;width:30%;font-weight: bold;text-align: left;'><?= $row['shift']; ?></td>
                    </tr>

                </table>

            </div>

            <table style='width: 100%;margin-top:10px'>

                <tr>
                    <th rowspan="2" style="width:30%;">Subjects</th>
                    <th rowspan="2">Max Marks</th>
                    <th rowspan="2">Passing Marks</th>
                    <th>Test II</th>
                    <th>Final Term</th>
                    <th rowspan="2">Final Term Result</th>
<!--                    <th>Test II</th>
                    <th>Final Term</th>
                    <th rowspan="2">Final Term Result</th>
                    <th colspan="2">Final Result Cummulative</th>-->
                </tr> 
                
                    <th>Marks Obt.</th>
                    <th>Marks Obt.</th>
<!--                    <th>Marks Obt.</th>
                    <th>Marks Obt.</th>
                    <th>Marks Obt.</th>
                    <th>Marks Obt.</th>-->
                </tr>
             
            <?php $t=0; $p=0; $tm =0; $om=0; $tom = 0; foreach ($row['exam_details'] as $detail): ?>    
                <tr>
                    <td style="width:20%;text-align: left;"> &nbsp;&nbsp;<?= $detail['subject']; ?></td>
                    <td><?= $detail['max_marks']; ?></td>
                        <?php  $t += is_numeric($detail['max_marks']) ? $detail['max_marks'] : 0;    ?>
                    <td><?= $detail['min_marks']; ?></td>
                        <?php  $p += is_numeric($detail['min_marks']) ? $detail['min_marks'] : 0;    ?>
                    <td><?= $detail['test_obtain_marks']; ?></td>
                        <?php  $tm += is_numeric($detail['test_obtain_marks']) ? $detail['test_obtain_marks'] : 0;    ?>
                    <td><?= $detail['obtain_marks']; ?></td>
                        <?php  $om += is_numeric($detail['obtain_marks']) ? $detail['obtain_marks'] : 0;    ?>
                    <td style='<?php echo $p > $tm + $om ? "text-decoration:underline;font-weight: bold;" : "text-decoration:none;";  ?>'><?= $detail['total_obtain_marks']; ?></td>
                        <?php  $tom += is_numeric($detail['total_obtain_marks']) ? $detail['total_obtain_marks'] : 0;    ?>
<!--                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>-->
                </tr>
            <?php endforeach;?>     
                <tfoot>
                    <th span='2'>TOTAL</th>
                    <th><?php echo  $this->Number->precision($t,2); ?></th>
                    <th><?php echo  $this->Number->precision($p,2); ?></th>
                    <th><?php echo  $this->Number->precision($tm,2); ?></th>
                    <th><?php echo  $this->Number->precision($om,2); ?></th>
                    <th><?php echo  $this->Number->precision($tom,2); ?></th>
<!--                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>-->
                    
                </tfoot>
                
            </table>
        </div>
        <div style="margin-top: 10px">
            <table style='width: 100%;'>
                <tr>
                    <td rowspan="2" width="20%">Summer Vacation  Assignment</td>
                    <td width="20%">Result</td>
                    <td style="font-weight:bold;width:20%;"><?= $row['result']; ?></td>
<!--                    <td>&nbsp;</td>
                    <td>&nbsp;</td>-->
                </tr>
                <tr>
                    <td width="20%">Percentage</td>
                    <td style="font-weight:bold;width:20%;"><?= $row['grade'] == 'F' ? '0.00' :$row['per']  ?>%</td>
<!--                    <td>&nbsp;</td>
                    <td>&nbsp;</td>-->

                </tr>
                <tr>
                    <td rowspan="2" style="font-weight:bold;width:20%;"><?php  if($row['generalObservation'][0]){ echo $row['generalObservation'][0]['sv']; } ?></td>
                    <td width="20%">Grade</td>
                    <td style="font-weight:bold;width:20%;"><?= $row['grade']; ?></td>
<!--                    <td>&nbsp;</td>
                    <td>&nbsp;</td>-->
                </tr>
                <tr>
                    <td width="20%">Rank</td>
                    <td style="font-weight:bold;width:20%;"><?= $row['no_of_rank']; ?></td>
<!--                    <td>&nbsp;</td>
                    <td>&nbsp;</td>-->

                </tr>
                <tr>
                    <td rowspan="2" width="20%">&nbsp;</td>
                    <td width="20%">Out of</td>
                    <td style="font-weight:bold;width:20%;"><?= $out_of; ?></td>
<!--                    <td>&nbsp;</td>
                    <td>&nbsp;</td>-->
                </tr>
                <tr>
                    <td width="20%">Attendance</td>
                    <td style="font-weight:bold;width:20%;"><?= $row['att']; ?> Out of <?= $row['out_of']; ?></td>
<!--                    <td>&nbsp;</td>
                    <td>&nbsp;</td>-->

                </tr>
                <tr>
                    <td rowspan="2" width="20%">Class Teacher Signature.</td>



                </tr>
                <tr>
                    <td>Remarks</td>
                    <td style="font-weight:bold;text-align: center;" colspan="4">&nbsp;<?= $row['remarks']; ?></td>
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
                    <td>Final Term</td>
                    <td><?php  if($row['generalObservation'][0]){ echo $row['generalObservation'][0]['home_work']; } ?></td>
                    <td><?php  if($row['generalObservation'][0]){ echo $row['generalObservation'][0]['reading']; } ?></td>
                    <td><?php  if($row['generalObservation'][0]){ echo $row['generalObservation'][0]['writing']; } ?></td>
                    <td><?php  if($row['generalObservation'][0]){ echo $row['generalObservation'][0]['cleanliiness']; } ?></td>
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