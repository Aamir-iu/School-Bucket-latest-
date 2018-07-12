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
        border-bottom:2px solid black;
        border-top:2px solid black;
        border-left:2px solid black;
        border-right:2px solid black;
        
        -moz-box-shadow: 0 4px 4px rgba(0, 0, 0, 0.4);
        -webkit-box-shadow: 0 4px 4px rgba(0, 0, 0, 0.4);
        box-shadow: 0 4px 4px rgba(0, 0, 0, 0.4);
    }
    
    
</style> 
<div class="wrapper">
  
   <?php $page = 1; foreach ($data as $row): ?> 
    
    <!-- Main content -->
    <section class="invoice">
        
           
        <span style="display:block; position:relative; text-align:center; ">
                    <?php echo $this->Html->image('logo.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top;width:80px;']); ?>
                   <span style="line-height:40px; font-size:38px; font-weight: bold; color:#EF4836 !important; vertical-align: top"><?php  echo $this->request->session()->read('Info.school'); ?></span>
                  
<!--                   <span style=" display: inline-block;  position: relative;  left: 6px;  top: 0px;  width: 1px;  height: 41px;  background: #00bcd4 !important;"></span>-->
                   <span style=" position: relative;  display: inline-block;  font: 500 15px/15px 'asap', sans-serif;  letter-spacing: -0.025em;  color: #00bcd4 !important;  left: 6px;  top: -4px; text-align: left"><span style="display:block;text-align: center;">Address : <?php  echo $this->request->session()->read('Info.address'); ?><br/>Phone :<?php  echo $this->request->session()->read('Info.phone'); ?></span></span>
         
        </span> 
        
           <div class="col-xs-6 col-xs-offset-3" id="outer" style="margin-top:20px">
               <div>
             <?= $row['exam_type']; ?> REPORT
              </div>
            </div> 
        
            <div class="row" style="margin-top:20px">
                <div class="col-sm-4 col-sm-offset-8">
                    <?php  $image = url()."img/students_images/".$row['img']; ?>
                    <?php echo $this->Html->image($image, ['alt' => 'student Picture', 'class' => 'profile-user-img img-responsive']); ?>

            </div>    
   
                <table style='width: 100%;margin-top:10px;margin-left:20px;'>

                    <tr style="border: 0px solid black;">
                        <td class="nob" style='text-align: left;width:20%;'>Name of Student :</td>
                        <td class="nob" style='text-align: left;width:40%;font-weight: bold;'><?= $row['sname']; ?></td>
                        <td class="nob" style='text-align:left;width:10%;'>CC # :</td>
                        <td class="nob" style='text-align: center;width:30%;font-weight: bold;text-align: left;'><?= $row['registration_id']; ?></td>
                    </tr>
                    
                    <tr style="border: 0px solid black;">
                        <td class="nob" style='text-align: left;width:20%;'>Father's Name :</td>
                        <td class="nob" style='text-align: left;width:40%;font-weight: bold;'><?= $row['fname']; ?></td>
                        <td class="nob" style='text-align:left;width:10%;'>G.R # :</td>
                        <td class="nob" style='text-align: center;width:30%;font-weight: bold;text-align: left;'><?= $row['gr_no']; ?></td>
                    </tr>
                    
                    <tr style="border: 0px solid black;">
                        <td class="nob" style='text-align: left;width:20%;'>Class :</td>
                        <td class="nob" style='text-align: left;width:40%;font-weight: bold;'><?= $row['class']; ?></td>
                        <td class="nob" style='text-align:left;width:10%;'>Roll # :</td>
                        <td class="nob" style='text-align: center;width:30%;font-weight: bold;text-align: left;'><?= $row['roll']; ?></td>
                    </tr>
                    
                     <tr style="border: 0px solid black;">
                        <td class="nob" style='text-align: left;width:20%;'>Shift :</td>
                        <td class="nob" style='text-align: left;width:40%;font-weight: bold;'><?= $row['shift']; ?></td>
                        <td class="nob" style='text-align:left;width:10%;'>D.O.B :</td>
                        <td class="nob" style='text-align: center;width:30%;font-weight: bold;text-align: left;'><?php echo date('D-d-M-Y', strtotime($row['dob'])); ?></td>
                    </tr>
                    

                </table>

            </div>

            <table style='width: 100%;margin-top:20px'>
                 <tr>
                     <th style="width:40%;">SUBJECTS</th>
                    <th>MAXIMUM MARKS</th>
                    <th>PASSING MARKS</th>
                    <th>OBTAINED MARKS</th>
                  
                   
                </tr>
             
            <?php $t=0; $p=0; $tm =0; $om=0; $tom = 0; foreach ($row['exam_details'] as $detail): ?>    
                <tr>
                    
                    <td style="width:20%;text-align: left;">&nbsp;&nbsp;<?= $detail['subject']; ?></td>
                    <td><?= $detail['max_marks']; ?></td>
                        <?php  $p += is_numeric($detail['min_marks']) ? $detail['min_marks'] : 0;    ?>
                  
                    <td><?= $detail['min_marks']; ?></td>
                    <td><?= $detail['obtain_marks']; ?></td>
                    
                        <?php  $t += is_numeric($detail['max_marks']) ? $detail['max_marks'] : 0;    ?>
                        <?php  $om += is_numeric($detail['obtain_marks']) ? $detail['obtain_marks'] : 0;    ?>
                   
                      
                    
                </tr>
            <?php endforeach;?>     
                <tfoot>
                <tr>
                    <td>TOTAL MARKS</td>
                    <td><?php echo $t; ?></td>
                    <td><?php echo $p; ?></td>
                    <td><?php echo $om; ?></td>
                  
                   
                </tr>
                <tfoot>
            </table>
            
        </div>
      
      
        <br />
       <br />
         <div class="col-xs-12 pull-left">
               <?php //echo $row['created_by']; ?> 
        </div>
       
        <div class="col-xs-2" style="border-top:solid black;text-align: center;">
              Prepared By. 
        </div>
        
         <div class="col-xs-2 col-xs-offset-3" style="border-top:solid black;text-align: center;">
            Teacher Sign.  
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