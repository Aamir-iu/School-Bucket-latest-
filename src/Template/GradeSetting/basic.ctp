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
    margin-left: 50px;
    margin-right: 50px;
    margin-top: 25px;
    margin-bottom: 50px;
    }
</style> 
<div class="wrapper">
   <?php $page = 1; foreach ($data as $row): ?> 
    
    <!-- Main content -->
    <section class="invoice">
        
           
        <span style="display:block; position:relative; text-align:center; ">
                    <?php echo $this->Html->image('logo.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top;width:50px;']); ?>
                   <span style="line-height:26px; font-size:24px; font-weight: bold; color:#EF4836 !important; vertical-align: top"><?php  echo $this->request->session()->read('Info.school'); ?></span>
                  
<!--                   <span style=" display: inline-block;  position: relative;  left: 6px;  top: 0px;  width: 1px;  height: 41px;  background: #00bcd4 !important;"></span>-->
                   <span style=" position: relative;  display: inline-block;  font: 500 15px/15px 'asap', sans-serif;  letter-spacing: -0.025em;  color: #00bcd4 !important;  left: 6px;  top: -4px; text-align: left"><span style="display:block;text-align: center;">Address : <?php  echo $this->request->session()->read('Info.address'); ?><br/>Phone :<?php  echo $this->request->session()->read('Info.phone'); ?></span></span>
         <span style=" display: inline-block;  position: relative;  left: 6px;  top: 0px;  width: 100%;  height: 5px;  background: #00bcd4 !important;"></span>
        </span> 
        
           <div class="col-xs-3 col-xs-offset-4" style="border-bottom:2px solid black;text-align: center;font-weight: bold;">
              Statement of Marks
            </div> 
        <div style="margin-top:50px">
            
            
         
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
                    
                    

                </table>

            </div>

            <table style='width: 100%;margin-top:5px'>
                <tr style="height:30px;">
                    <th colspan="5"><?= $row['exam_type']; ?></th>
                </tr>

                <tr>
                    <th>SUBJECTS</th>
                    <th>DESCRIPTION</th>
                    <th>MAXIMUM MARKS</th>
                    <th>MARKS OBTAINED</th>
                    <th>REMARKS</th>
                   
                </tr>
             
            <?php $t=0; $p=0; $tm =0; $om=0; $tom = 0; foreach ($row['exam_details'] as $detail): ?>    
                <tr>
                    
                    <td style="width:20%;text-align: left;">&nbsp;&nbsp;<?= $detail['subject']; ?></td>
                    <td style="text-align: left;">&nbsp;&nbsp;<?= $detail['sub_type']; ?></td>
              
                    <td><?= $detail['max_marks']; ?></td>
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
                    
                    <th style='width: 13%;'>GRAND TOTAL</th>
                    <th style='width: 13%;'>TOTAL MARKS OBTAINED</th>
                    <th style='width: 13%;'>PERCENTAGE</th>
                    <th style='width: 13%;'>GRADE</th>
                    <th style='width: 13%;'>RESULT</th>
                    <th style='width: 13%;'>RANK IN CLASS</th>
                    <th style='width: 22%;'>REMARKS</th>
                     
                </tr>
               
                <tr>
                    <td><?= $row['total_marks']; ?></td>
                    <td><?= $this->Number->precision($row['obtain_marks'],2); ?></td>
                    <td><?= $row['grade'] == 'F' ? '0.00' :$row['per']  ?>%</td>
                    <td><?= $row['grade']; ?></td>
                    <td><?= $row['result']; ?></td>
                    <td><?= $row['no_of_rank']; ?></td>
                    <td><?= $row['remarks']; ?></td>
                </tr>
            </table>
        </div>
      
        <br />
       <br />

        <div class="col-xs-12 pull-left" style="border-top:solid black;text-align: center;">
               <?php echo $row['created_by']; ?> 
        </div>
       
        <div class="col-xs-2" style="border-top:solid black;text-align: center;">
              Prepared By. 
        </div>
        
         <div class="col-xs-2 col-xs-offset-3" style="border-top:solid black;text-align: center;">
            Checked By.  
        </div>
        
        <div class="col-xs-2 pull-right" style="border-top:solid black;text-align: center;">
              Principal Sign. 
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