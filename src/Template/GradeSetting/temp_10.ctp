<?php

    function url(){
      
        $currentPath = $_SERVER['PHP_SELF']; 
        $pathInfo = pathinfo($currentPath); 
        $hostName = $_SERVER['HTTP_HOST']; 
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
        return $protocol.$hostName.$pathInfo['dirname']."/";
    }

     function generateRemaks($per = null){
        if( $per >= 90 ){
                $remarks = "Excellent";
            }
            elseif( $per >= 80 ){
                
                $remarks = "Excellent";  
            }
            elseif( $per >= 70 ){
               
                $remarks = "Very Good";  
            }
            elseif( $per >= 60 ){
                
                $remarks = "Good"; 
            }
            elseif( $per >= 50 ){
                
                $remarks = "Work hard"; 
            }
            elseif( $per >= 40 ){
                
                $remarks = "Need to improve"; 
            }
            elseif( $per >= 33 ){
                
                $remarks = "Need to work hard"; 
            }
            else{
                $remarks = "Need to work hard"; 
            }
            
            return $remarks;
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
            .page-break	{ display: block; page-break-before: always; }
    }
    @page{
    margin-left: 25px;
    margin-right: 25px;
    margin-top: 150px;
    margin-bottom: 50px;
    }

    td
    {
        
        border:1px solid black;
        
    }
    th
    {
    background:#10437a!important; color:white!important;
    
    }
    table
    {
    width:100%;
    margin-top:2px;
    margin-bottom:2px;
    text-align:center;
    }


</style> 


<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/flot/jquery.flot.min.js') ?>
<?= $this->Html->script('../plugins/flot/jquery.flot.resize.min.js') ?>
<?= $this->Html->script('../plugins/flot/jquery.flot.pie.min.js') ?>
<?= $this->Html->script('../plugins/flot/jquery.flot.categories.min.js') ?>


<div class="wrapper">
   <?php $page = 1; foreach ($data as $row): ?> 
    
    <!-- Main content -->
    <section class="invoice">

        <!-- title row -->
<!--    <div class="row">
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

        </h2>
      </div>
       /.col 
    </div>-->
    <!-- info row -->




        
    <table style="border-collapse: collapse;">
  <tr>
    <th colspan="5" style="background:blue;"><?= $row['exam_type']; ?> Report <?= $shift_name ?></th>
    <td style = "border:0px;">&nbsp;</td>

    <td rowspan="6" style="width:15%;" align="center">
        <div class="">
                <?php  $image = url()."img/students_images/".$row['img']; ?>
                <?php echo $this->Html->image($image, ['alt' => 'student Picture', 'class' => 'rofile-user-img img-responsive','style'=>'width:100%;']); ?>

         </div>       

    </td>
  </tr>
    <tr>
    <td colspan="6" style = "border:0px;">&nbsp;</td>
  </tr>
  <tr>
        <td width="182" scope="col">G.R.NO</td>
        <td width="181" scope="col"><?= $row['gr_no'] == '' ? 0 : $row['gr_no']; ?></td>
        <td width="77" scope="col">Class</td>
        <td width="128" scope="col"><?= $row['class']; ?></td>
        <td width="74" scope="col">Shift</td>
        <td width="154" scope="col"><?= $row['shift']; ?></td>
  </tr>
  <tr>
    <td colspan="6" style = "border:0px;">&nbsp;</td>
  </tr>
  <tr>
    <th>Student Name </th>
    <td style = "border:0px;">&nbsp;</td>
    <td rowspan="2" style = "border:0px;">&nbsp;</td>
    <th colspan="2">Father's Name </th>
    <td style = "border:0px;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><?= $row['sname']; ?></td>
    <td colspan="3"><?= $row['fname']; ?></td>
  </tr>
</table>


<table style ="border-collapse: collapse;">
  <tr style="background-color:#10437a!important; color:white!important;">
    <td rowspan="2" scope="col" style="width:20%;color:white!important;">Main Subject </td>
    <td rowspan="2" scope="col" style="width:20%;color:white!important;">Sub Subject </td>
    <td colspan="3" scope="col" style="color:white!important;">Marks</td>
    <td rowspan="2" scope="col" style="color:white!important;">Per. % </td>
    <td rowspan="2" scope="col" style="color:white!important;"> Sub <br />
    Rank </td>
    <td rowspan="2" scope="col" style="color:white!important;"> Sub- <br />
    Result </td>
    <td rowspan="2" scope="col" style="color:white!important;">Remarks</td>
  </tr>
  <tr style="background-color:#10437a!important; color:white!important;">
    <td scope="col" style="color:white!important;"> Max  <br />
    Marks  </td>
    <td scope="col" style="color:white!important;">Pass</td>
    <td scope="col" style="color:white!important;"> Obtain <br />
    Marks </td>
  </tr>
<?php $arr = ""; foreach ($row['exam_details'] as $detail): ?>  
  <tr>
    <?php $sub = explode('|', $detail['subject']) ?>
    <td style="width:20%;text-align: left;">&nbsp;&nbsp;<?= $sub[0] ; ?></td>
    <td style="width:20%;text-align: left;">&nbsp;&nbsp;<?= $detail['sub_type']; ?></td>
    <td><?= $detail['max_marks']; ?></td>
    <td><?= $detail['min_marks']; ?></td>
    <td><?= $detail['obtain_marks']; ?></td>
    <td><?= $this->Number->precision($detail['obtain_marks'] / $detail['max_marks'] * 100,2) ?>%</td>
    <td>0</td>
    <td><?= $detail['obtain_marks'] < $detail['min_marks'] ? 'Failed' : 'Passed' ?></td>
    <td><?= generateRemaks($this->Number->precision($detail['obtain_marks'] / $detail['max_marks'] * 100,2)); ?></td>

    <?php  $arr .= "["."'".$detail['sub_desc']."'".",".$this->Number->precision($detail['obtain_marks'] / $detail['max_marks'] * 100,0)."],";  ?>

    <?php // print_r($arr); ?>

  </tr>

<?php endforeach;?>     
  
</table>
 
<table style ="border-collapse: collapse;">
  <tr>
    <th style="background:blue;color:white;width:20%;">Graphical View </th>
    <td colspan="2" scope="col" style="border:0px;">&nbsp;</td>
    <th colspan="3" style="background:blue;color:white;width:40%;"> RESULT SUMMERY </th>
  </tr>
  <tr>

    <td colspan="3" rowspan="7">
        <div id="bar-chart<?= $row['registration_id'] ?>" class="bar-chart" style="width:60%;height: 200px;"></div>
    </td>

    <script>

        var id = <?php echo $row['registration_id'] ?>;
        var bar_data = {
         // data: [["January", 10], ["February", 8], ["March", 4], ["April", 13], ["May", 17], ["June", 9]],
          data: [<?php echo substr($arr, 0,-1); ?>],
          color: "#3c8dbc"

        };
        $.plot("#bar-chart"+id, [bar_data], {
          grid: {
            borderWidth: 1,
            borderColor: "#f3f3f3",
            tickColor: "#f3f3f3"
          },
          series: {
            bars: {
              show: true,
              barWidth: 0.5,
              align: "center"

            }
          },
          xaxis: {
            mode: "categories",
            tickLength: 0
          }
        });
        /* END BAR CHART */


     </script>
   

    <td style = "background:#2f5071!important;font-size:25px;width:15%;color:white!important;">Rank</td>
    <td width="10%"><?= $row['rank']; ?></td>
    <td  style = "background:#2f5071!important;font-size:30px;width:15%;color:white!important;">Result</td>
  </tr>
  <tr>
    <td>Total Marks</td>
    <td><?= $row['total_marks']; ?></td>
    <td rowspan="2"><?= strtoupper($row['result']); ?></td>
  </tr>
  <tr>
    <td>Obtain Marks </td>
    <td><?= $row['obtain_marks']; ?></td>
  </tr>
  <tr>
    <td>Percentage % </td>
    <td><?= $row['per']; ?></td>
    <td rowspan="2" style = "font-size:25px;width:10%;"><?= $row['rank']; ?></td>
  </tr>
  <tr>
    <td style = "background:#2f5071!important;font-size:25px;width:10%;color:white!important;">Grade</td>
    <td><?= $row['grade']; ?></td>
  </tr>
  <tr>
    <td>Attendance  </td>
    <td colspan="2">[<?= $row['att']; ?>/<?= $row['out_of']; ?>]</td>
  </tr>
  <tr>
    <td colspan="3"  style="background:2f5071!important;color:white!important;">Teacher Remarks </td>
  </tr>
  <tr style ="border:0px;">
    <td style ="border:0px;"></td>
    <td style ="border:0px;"></td>
    <td style ="width:30%;border:0px;""></td>
    <td colspan="3">---</td>
  </tr>
</table>

    <br />
     <br />
    <div class="col-xs-3" style="border-top:solid black;text-align: center;">
           Teacher's Sign. 
    </div>
    <div class="col-xs-3 col-xs-offset-3" style="border-top:solid black;text-align: center;">
          Principal's Sign. 
    </div>



    </section>
    <!-- /.content -->
   
    <?php if($page == 1): ?>
    <div class="page-break"></div>
    <?php $page = 0; endif; ?>
    <?php $page++; endforeach; ?>
    
</div>
<!-- ./wrapper -->

<script>

    $(document).ready(function () {

        $('#dis_id').html($('#cid').val());


    });

    function goBack() {
        window.history.back();
    }

    

</script> 



