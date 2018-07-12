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
            .page-break	{ display: block; page-break-before: always; }
    }
    @page{
    margin-left: 50px;
    margin-right: 50px;
    margin-top: 25px;
    margin-bottom: 50px;
    }
    
    
    #outer {
    width: 300px;
/*    overflow: hidden;*/
    padding-bottom: 10px;
    }

    #outer > div {
        width: 100%;
        height: 30px;
        background: white;
        text-align: center;
/*        border-bottom:2px solid black;
        border-top:2px solid black;
        border-left:2px solid black;
        border-right:2px solid black;*/
        
        -moz-box-shadow: 0 4px 4px rgba(0, 0, 0, 0.4);
        -webkit-box-shadow: 0 4px 4px rgba(0, 0, 0, 0.4);
        box-shadow: 0 4px 4px rgba(0, 0, 0, 0.4);
    }
    
    tr.spaceUnder>td {
    padding-bottom: 0.3em;
    }
</style> 
<div class="wrapper">
  
   <?php $page = 1; foreach ($data as $row): ?> 
    
    <!-- Main content -->
    <section class="invoice">
        <div style="border:solid 5px black;padding: 30px;">
           
        <span style="display:block; position:relative; text-align:center; ">
                    <?php echo $this->Html->image('logo.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top;width:80px;']); ?>
                   <span style="line-height:40px; font-size:38px; font-weight: bold; color:#EF4836 !important; vertical-align: top"><?php  echo $this->request->session()->read('Info.school'); ?></span>
                  
<!--                   <span style=" display: inline-block;  position: relative;  left: 6px;  top: 0px;  width: 1px;  height: 41px;  background: #00bcd4 !important;"></span>-->
<!--                   <span style=" position: relative;  display: inline-block;  font: 500 15px/15px 'asap', sans-serif;  letter-spacing: -0.025em;  color: #00bcd4 !important;  left: 6px;  top: -4px; text-align: left"><span style="display:block;text-align: center;">Address : <?php  echo $this->request->session()->read('Info.address'); ?><br/>Phone :<?php  echo $this->request->session()->read('Info.phone'); ?></span></span>-->
         
        </span>
        <div class="row" style="text-align:center;">
            
            <span style="font-weight: bold;font-size:20px;"> Project Report </span>
          
        </div>    
        
        <div class="row" style="margin-top:0px">
               
                <div class="col-sm-4 col-sm-offset-8 pull-right">
                    <?php  $image = url()."img/students_images/".$row['img']; ?>
                    <?php echo $this->Html->image($image, ['alt' => 'student Picture', 'class' => 'profile-user-img img-responsive','style'=>'width:70px;']); ?>

                </div>  
              

                <table style='width: 95%;margin-top:0px;margin-left:10px;'>
                   
                        <span style="font-weight: bold;margin-left: 20px;"> Mid-Term Test. &nbsp;&nbsp;&nbsp;&nbsp; Year: <?= $shift_name ?></span>
                   
                    
                    <tr style="border: 0px solid black;" class="spaceUnder">
                        <td class="nob" style='text-align: left;width:15%;'>Student's ID :</td>
                        <td class="nob" style='text-align: left;width:20%;font-weight: bold;'>
                            
                            <table style='width: 30%;margin-top:10px;margin-left:20px;'>
                                <tr>
                                    <?php for($i=0; $i<=14; $i++): ?>
                                    <?php $id =  str_pad($row['registration_id'], 5, '0', STR_PAD_LEFT); ?>
<!--                                    <td style="width:15px;"><?php if(isset($id[$i])){ echo strtoupper($id[$i]); }else{ echo ""; } ?></td>-->
                                     <td style="width:25px;">&nbsp;&nbsp;&nbsp;</td>
                                    <?php endfor; ?>
                                </tr>    
                            </table>
                        </td>
         
                    </tr>
                   <tr style="border: 0px solid black;" class="spaceUnder">
                        <td class="nob" style='text-align: left;width:15%;'>Name of Student :</td>
                        <td class="nob" style='text-align: left;width:40%;font-weight: bold;'>
                            
                            <table style='width: 100%;margin-top:10px;margin-left:20px;'>
                                <tr>
                                    <?php for($i=0; $i<=30; $i++): ?>
                                    <td style="width:15px;"><?php if(isset($row['sname'][$i])){ echo strtoupper($row['sname'][$i]); }else{ echo ""; } ?></td>
                                    <?php endfor; ?>
                                </tr>    
                            </table> 
                        </td>
                    </tr>
                   
                    <tr style="border: 0px solid black;" class="spaceUnder">
                        <td class="nob" style='text-align: left;width:15%;'>Father's Name :</td>
                        <td class="nob" style='text-align: left;width:40%;font-weight: bold;'>
                            
                            <table style='width: 100%;margin-top:10px;margin-left:20px;'>
                                <tr>
                                    <?php for($i=0; $i<=30; $i++): ?>
                                    <td style="width:15px;"><?php if(isset($row['fname'][$i])){ echo strtoupper($row['fname'][$i]); }else{ echo ""; } ?></td>
                                    <?php endfor; ?>
                                </tr>    
                            </table> 
                        </td>
                    </tr>
                  
                    <tr style="border: 0px solid black;">
                        <td class="nob" style='text-align: left;width:15%;'>Class :</td>
                        <td class="nob" style='text-align: left;width:40%;font-weight: bold;'>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo strtoupper($row['class']); ?>
                        </td>
                    </tr>
                    
                    

                </table>

            </div>
      
            
        <table style='width: 100%;margin-top:5px'>
               
                <tr style="height:50px;">
                    <th style="width:30%;">Subject</th>
                  
                    <th>Total Marks</th>
                    <th>Marks obt.</th>
                    <th>% age</th>
                   
                </tr>
             
            <?php $t=0; $p=0; $tm =0; $om=0; $tom = 0; foreach ($row['exam_details'] as $detail): ?>    
                <tr>
                    
                  <td style="width:20%;text-align: left;">&nbsp;&nbsp;<?= $detail['subject']; ?></td>
                   
              
                    <td><?= $detail['max_marks']; ?></td>
                        <?php  $p = is_numeric($detail['min_marks']) ? $detail['min_marks'] : 0;    ?>
                        <?php  $t = is_numeric($detail['max_marks']) ? $detail['max_marks'] : 0;    ?>
                   
                        <?php  $tm = is_numeric($detail['test_obtain_marks']) ? $detail['test_obtain_marks'] : 0;    ?>
                        <?php  $om = is_numeric($detail['obtain_marks']) ? $detail['obtain_marks'] : 0;    ?>
                   <td><?= $tm + $om ?></td>
                  
                   <td><?= $t > 0 ?  $this->Number->precision($tm + $om / $t * 100 ,2) : '' ?></td>   
                    
                </tr>
            <?php endforeach;?>     
               
                
            </table>
            <br />
             <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="panel-body">
                        <div class="row static-info">
                            <div class="col-md-5 col-xs-5">
                               Total Marks : 
                            </div>
                            <div class="col-md-7 col-xs-7" style="border-bottom: solid black;text-align: center;">
                                <?= $row['total_marks']; ?>
                            </div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-5 col-xs-5">
                                % age : 
                            </div>
                            <div class="col-md-7 col-xs-7" style="border-bottom: solid black;text-align: center;">
                               <?= $row['per']; ?>
                            </div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-5 col-xs-5">
                               Grade :
                            </div>
                         
                            <span class="col-md-7 col-xs-7" style="border-bottom: solid black;text-align: center;">
                               <?= $row['grade']  ?>
                            </span>
                            
                        </div>
                        <div class="row static-info">
                            <div class="col-md-5 col-xs-5">
                                Class Teacher:
                            </div>
                            <div class="col-md-7 col-xs-7" style="border-bottom: solid black;text-align: left;">
                              -
                            </div>
                        </div>

                        <div class="row static-info">
                            <div class="col-md-5 col-xs-5">
                               Date :
                            </div>
                            <div class="col-md-7 col-xs-7" style="border-bottom: solid black;text-align: center;">
                               2017-10-10
                            </div>
                        </div>

                    </div>
                </div>    
                 
                <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="panel-body">
                        <div class="row static-info">
                            <div class="col-md-5 col-xs-5">
                               Working Days
                            </div>
                            <div class="col-md-7 col-xs-7" style="border-bottom: solid black;text-align: center;">
                                <?= $row['out_of']; ?>
                            </div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-5 col-xs-5">
                                Day Attended : 
                            </div>
                            <div class="col-md-7 col-xs-7" style="border-bottom: solid black;text-align: center;">
                               <?= $row['att']; ?>
                            </div>
                        </div>
                      

                    </div>
                </div>     
     
            </div>
            
         <br />   
        <div class="col-xs-4" style="border-top:solid black;text-align: center;">
             Head Teacher's Signature. 
        </div>
        
         <div class="col-xs-4 col-xs-offset-4" style="border-top:solid black;text-align: center;">
           Principal's Signature. 
        </div>
            
            <br /><br />
       <br /><br />
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