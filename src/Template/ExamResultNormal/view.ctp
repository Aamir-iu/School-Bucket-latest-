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
        font-family: arial, sans-serif;
        border-collapse: collapse;
        font-weight: bold;
    }
    
    @media print {
            .page-break { display: block; page-break-before: always; }
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
        
  <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
            <span style="display:block; position:relative; text-align:left; ">
                
               <?php if($this->request->session()->read('Info.full_logo') === 'No'): ?>
                
                    <?php echo $this->Html->image('logo.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top;width:50px;']); ?>
                     <span style="line-height:32px; font-size:30px; font-weight: bold; color:#EF4836 !important; vertical-align: top"><?php  echo $this->request->session()->read('Info.school'); ?></span>
                     <span style=" display: inline-block;  position: relative;  left: 6px;  top: 0px;  width: 1px;  height: 41px;  background: #00bcd4 !important;"></span>
                     <span style=" position: relative;  display: inline-block;  font: 500 15px/15px 'asap', sans-serif;  letter-spacing: -0.025em;  color: #00bcd4 !important;  left: 6px;  top: -4px; text-align: left"><span style="display:block;">Address : <?php  echo $this->request->session()->read('Info.address'); ?><br/>Phone :<?php  echo $this->request->session()->read('Info.phone'); ?></span></span>
                <?php else: ?>     
               <?php echo $this->Html->image('logo2.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top;width:100%;']); ?>
                     
               <?php endif; ?>       
            </span> 
         
          <div class="tools pull-right">
                    <a href="javascript:window.print()" class="fa fa-print hidden-xs hidden-sm" data-original-title="" title="Print">
                    </a>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
        
        
        <div style="margin-top:0px">
            <div class="col-xs-3 col-xs-offset-4" style="border-bottom:2px solid black;text-align: center;font-weight: bold;">
               SESSION   <?php echo "2017-18"; ?>
            </div>

            <br/>
            <br/>

            <div>
                <table style='width: 90%;'>

                    <tr style="border: 0px solid black;">
                        <td class="nob" style='text-align: left;width:20%;'>Issue Date :</td>
                        <td class="nob" style='text-align: left;width:40%;font-weight: bold;'><?= date("d-M-Y"); ?></td>
                        <td class="nob" style='text-align:left;width:10%;'>ID # :</td>
                        <td class="nob" style='text-align: center;width:30%;font-weight: bold;text-align: left;'><?= $row['registration_id']; ?></td>
                    </tr>
                    
                    <tr style="border: 0px solid black;">
                        <td class="nob" style='text-align: left;width:20%;'>Name of Student :</td>
                        <td class="nob" style='text-align: left;width:40%;font-weight: bold;'><?= $row['s_name']; ?></td>
                        <td class="nob" style='text-align:left;width:10%;'>G.R # :</td>
                        <td class="nob" style='text-align: center;width:30%;font-weight: bold;text-align: left;'><?= $row['grno']; ?></td>
                    </tr>
                    
                    <tr style="border: 0px solid black;">
                        <td class="nob" style='text-align: left;width:20%;'>Father's Name :</td>
                        <td class="nob" style='text-align: left;width:40%;font-weight: bold;'><?= $row['f_name']; ?></td>
                        <td class="nob" style='text-align:left;width:10%;'>Roll # :</td>
                        <td class="nob" style='text-align: center;width:30%;font-weight: bold;text-align: left;'>-<?php // $row['roll_no']; ?></td>
                    </tr>
                    
                    <tr style="border: 0px solid black;">
                        <td class="nob" style='text-align: left;width:20%;'>Class :</td>
                        <td class="nob" style='text-align: left;width:40%;font-weight: bold;'><?= $row['class_name']; ?></td>
                        <td class="nob" style='text-align:left;width:10%;'>Shift #: </td>
                        <td class="nob" style='text-align: center;width:30%;font-weight: bold;text-align: left;'><?= $row['shift']; ?></td>
                    </tr>

                </table>

                <div class="col-sm-4 col-sm-offset-4 pull-right" style="z-index: 1000;margin-top: -100px;position:relative;">
                <?php  $image = url()."img/students_images/".$row['img']; ?>
                <?php echo $this->Html->image($image, ['alt' => 'student Picture', 'class' => 'profile-user-img img-responsive','style'=>'width:90px;']); ?>

                </div>  


            </div>

            <table style='width: 100%;margin-top:30px'>

                <tr>
                    <th rowspan="2" style="width:30%;">Subjects</th>
                    <th rowspan="2">Max Marks</th>
                    <th rowspan="2">Passing Marks</th>
                    <th>Final Term</th>
                    
                </tr> 
                    <th>Marks Obt.</th>

                </tr>
             
            <?php $t=0; $p=0; $tm =0; $om=0; $tom = 0; foreach ($row['details'] as $detail): ?> 

                <tr>
                    <td style="width:20%;text-align: left;"> &nbsp;&nbsp;<?= $detail['subject']; ?> (<?= $detail['sub_desc']; ?>)</td>
                    <td><?= $detail['max_marks']; ?></td>
                        <?php  $t += is_numeric($detail['max_marks']) ? $detail['max_marks'] : 0;    ?>
                    <td><?= $detail['min_marks']; ?></td>
                        <?php  $p += is_numeric($detail['min_marks']) ? $detail['min_marks'] : 0;    ?>

                        <?php  $om += is_numeric($detail['obtained_marks']) ? $detail['obtained_marks'] : 0;    ?>
                    
                        
                    <td><?php echo  $detail['obtained_marks']; ?></td>
                    
                </tr>
            <?php endforeach;?>     
                <tfoot>

                    <th span='2'>TOTAL</th>
                    <th><?php echo  $this->Number->precision($t,2); ?></th>
                    <th><?php echo  $this->Number->precision($p,2); ?></th>
                    <th><?php echo  $this->Number->precision($om,2); ?></th>
                    

                </tfoot>
                
            </table>
        </div>

        <div style="margin-top: 10px">
            <table style='width: 100%;'>
                <tr>
                    <td rowspan="2" width="20%">Summer Vacation  Assignment</td>
                    <td width="20%">Result</td>
                    <td style="font-weight:bold;width:20%;"><?php echo  $row['details'][0]['grade'] == 'F' ? 'Failed' : 'Passed'  ?></td>

                </tr>
                <tr>
                    <td width="20%">Percentage</td>
                    <td style="font-weight:bold;width:20%;"><?php echo $row['details'][0]['grade'] == 'F' ? '0.00' :$row['details'][0]['per']  ?></td>

                </tr>

                <tr>
                    <td rowspan="2" style="font-weight:bold;width:20%;">-<?php // if($row['generalObservation'][0]){ echo $row['generalObservation'][0]['sv']; } ?></td>
                    <td width="20%">Grade</td>
                    <td style="font-weight:bold;width:20%;"><?php echo $row['details'][0]['grade']; ?></td>
                </tr>
                <tr>

                <?php  
                $rank =   $row['details'][0]['no_of_rank'] == '' ? '-' :$row['details'][0]['no_of_rank'] ;  
                if( $rank === '1st' ){
                    $my_rank = $row['details'][0]['no_of_rank'];
                }elseif($rank === '2nd'){
                    $my_rank = $row['details'][0]['no_of_rank'];
                
                }elseif($rank === '3rd'){
                    $my_rank = $row['details'][0]['no_of_rank'];
                
                }elseif($rank === '4th'){
                    $my_rank = $row['details'][0]['no_of_rank'];
                }elseif($rank === '5th'){
                    $my_rank = $row['details'][0]['no_of_rank'];
                }elseif($rank === '6th'){
                    $my_rank = $row['details'][0]['no_of_rank'];
                }
                elseif($rank === '8th'){
                    $my_rank = $row['details'][0]['no_of_rank'];
                }
                elseif($rank === '9th'){
                    $my_rank = $row['details'][0]['no_of_rank'];
                }
                elseif($rank === '10th'){
                    $my_rank = $row['details'][0]['no_of_rank'];
                }
                else{
                    $my_rank = "-";
                }


                ?>

                    <td width="20%">Rank</td>
                    <td style="font-weight:bold;width:20%;"><?php echo  $my_rank ; ?></td>

                    <!-- td style="font-weight:bold;width:20%;"><?php echo $row['details'][0]['no_of_rank'] == '' ? '-' :$row['details'][0]['no_of_rank'] ; ?></td> -->


                </tr>
                <tr>
                    <td rowspan="2" width="20%">&nbsp;</td>
                    <td width="20%">Out of</td>
                    <td style="font-weight:bold;width:20%;"><?php echo  $out_of; ?></td>
                </tr>
                <tr>
                    <td width="20%">Attendance</td>
                    <td style="font-weight:bold;width:20%;"><?php  if(!empty($row['generalObservationFinal'][0])){ echo $row['generalObservationFinal'][0]['att'] ."/" . $row['generalObservationFinal'][0]['out_of']; } ?></td>

                </tr>
                <tr>
                    <td rowspan="2" width="20%">Class Teacher Signature.</td>
                </tr>
                <tr>
                    <td>Remarks</td>
                    <td style="font-weight:bold;text-align: center;" colspan="4">&nbsp;<?php echo  $row['details'][0]['remarks']; ?></td>
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
                    <td>-<?php // if($row['generalObservation'][0]){ echo $row['generalObservation'][0]['home_work']; } ?></td>
                    <td>-<?php // if($row['generalObservation'][0]){ echo $row['generalObservation'][0]['reading']; } ?></td>
                    <td>-<?php // if($row['generalObservation'][0]){ echo $row['generalObservation'][0]['writing']; } ?></td>
                    <td>-<?php // if($row['generalObservation'][0]){ echo $row['generalObservation'][0]['cleanliiness']; } ?></td>
                </tr>
                <tr>
                    <td>FINAL</td>
                    <td><?php  if(!empty($row['generalObservationFinal'][0])){ echo $row['generalObservationFinal'][0]['home_work']; } ?></td>
                    <td><?php  if(!empty($row['generalObservationFinal'][0])){ echo $row['generalObservationFinal'][0]['reading']; } ?></td>
                    <td><?php  if(!empty($row['generalObservationFinal'][0])){ echo $row['generalObservationFinal'][0]['writing']; } ?></td>
                    <td><?php  if(!empty($row['generalObservationFinal'][0])){ echo $row['generalObservationFinal'][0]['cleanliiness']; } ?></td>
                </tr>
            </table>
        </div>

       
        <br />
        <br />
        <?php echo $this->Html->image('sing.jpg', ['alt' => 'logo-default', 'style'=>'vertical-align:top;width:100px;margin-left:50px;']); ?>
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