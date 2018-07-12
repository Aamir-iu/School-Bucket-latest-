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
          
            <div>
                <table style='width: 100%;'>

                    <tr style="border: 0px solid black;">
                        <td class="nob" style='text-align: left;width:20%;'>Name of Student :</td>
                        <td class="nob" style='text-align: left;width:40%;font-weight: bold;'><?= $row['sname']; ?></td>
                        <td class="nob" style='text-align:left;width:10%;'>ID # :</td>
                        <td class="nob" style='text-align: center;width:30%;font-weight: bold;text-align: left;'><?= $row['registration_id']; ?></td>
                    </tr>
                    
                    <tr style="border: 0px solid black;">
                        <td class="nob" style='text-align: left;width:20%;'>Father's Name :</td>
                        <td class="nob" style='text-align: left;width:40%;font-weight: bold;'><?= $row['fname']; ?></td>
                        <td class="nob" style='text-align:left;width:10%;'>Exam :</td>
                        <td class="nob" style='text-align: center;width:30%;font-weight: bold;text-align: left;'><?= $row['exam_type']; ?></td>
                    </tr>
                    
                    <tr style="border: 0px solid black;">
                        <td class="nob" style='text-align: left;width:20%;'>Class :</td>
                        <td class="nob" style='text-align: left;width:40%;font-weight: bold;'><?= $row['class']; ?></td>
                        <td class="nob" style='text-align:left;width:10%;'>Year :</td>
                        <td class="nob" style='text-align: center;width:30%;font-weight: bold;text-align: left;'><?= $shift_name; ?></td>
                    </tr>
                    
                    <tr style="border: 0px solid black;">
                        <td class="nob" style='text-align: left;width:20%;'>Shift :</td>
                        <td class="nob" style='text-align: left;width:40%;font-weight: bold;'><?= $row['shift']; ?></td>
                        <td class="nob" style='text-align:left;width:10%;'></td>
                        <td class="nob" style='text-align: center;width:30%;font-weight: bold;text-align: left;'></td>
                    </tr> 
                    
                    

                </table>

            </div>

            <table style='width: 100%;margin-top:5px'>
                <tr style="height:30px;">
                    <th colspan="5"><?= $row['exam_type']; ?></th>
                </tr>

                <tr>
                    <th style="width:30%;">SUBJECTS</th>
                    <th>MAXIMUM MARKS</th>
                    <th>PASSING MARKS</th>
                    <th>MARKS OBTAINED</th>
                    <th>REMARKS</th>
                   
                </tr>
             
            <?php $t=0; $p=0; $tm =0; $om=0; $tom = 0; foreach ($row['exam_details'] as $detail): ?>    
                <tr>
                    
                    <td style="width:20%;text-align: left;">&nbsp;&nbsp;<?= $detail['subject']; ?></td>
                   
              
                    <td><?= $detail['max_marks']; ?></td>
                    <td><?= $detail['min_marks']; ?></td>
                        <?php  $p = is_numeric($detail['min_marks']) ? $detail['min_marks'] : 0;    ?>
                    <td><?= $detail['obtain_marks']; ?></td>
                        <?php  $tm = is_numeric($detail['test_obtain_marks']) ? $detail['test_obtain_marks'] : 0;    ?>
                        <?php  $om = is_numeric($detail['obtain_marks']) ? $detail['obtain_marks'] : 0;    ?>
                    <td><?php echo $p > $tm + $om ? "Failed" : "Passed";  ?></td>
                      
                    
                </tr>
            <?php endforeach;?>     
               
                
            </table>
        </div>
        <div style="margin-top: 0px;">
            <table style='width: 100%;'>
                
                <tr style="height:50px;">
                    
                    <th style='width: 10%;'>GRAND TOTAL</th>
                    <th style='width: 10%;'>TOTAL MARKS OBTAINED</th>
                    <th style='width: 10%;'>PERCENTAGE</th>
                    <th style='width: 10%;'>GRADE</th>
                    <th style='width: 10%;'>RESULT</th>
                    <th style='width: 10%;'>RANK</th>
                    <th style='width: 10%;'>ATTENDED</th>
                    <th style='width: 10%;'>OUT OF</th>
                    <th style='width: 20%;'>REMARKS</th>
                     
                </tr>
               
                <tr>
                    <td><?= $row['total_marks']; ?></td>
                    <td><?= $this->Number->precision($row['obtain_marks'],2); ?></td>
                    <td><?= $row['grade'] == 'F' ? '0.00' :$row['per']  ?>%</td>
                    <td><?= $row['grade']; ?></td>
                    <td><?= $row['result']; ?></td>
                    <td><?= $row['no_of_rank']; ?></td>
                    <td><?= $row['att']; ?></td>
                    <td><?= $row['out_of']; ?></td>
                    <td><?= $row['remarks']; ?></td>
                </tr>
            </table>
        </div>
      
        <br />
          <br />
            <br />
       
<!--         <div class="col-xs-12 pull-left">
               <?php //echo $row['created_by']; ?> 
        </div>-->
       
        <div class="col-xs-2" style="border-top:solid black;text-align: center;">
              H.M SIGN.
        </div>
        
         <div class="col-xs-2 col-xs-offset-1" style="border-top:solid black;text-align: center;">
            PARENTS SIGN. 
        </div>
        
        <div class="col-xs-2 col-xs-offset-1" style="border-top:solid black;text-align: center;">
             TEACHER SIGN.  
        </div>

        <div class="col-xs-2 pull-right" style="border-top:solid black;text-align: center;">
             PRINCIPAL SIGN.  
        </div>


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