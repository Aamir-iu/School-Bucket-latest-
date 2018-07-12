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
         <div style="border:solid 5px black;padding: 30px;">
           
        <span style="display:block; position:relative; text-align:center; ">
                   <?php if($this->request->session()->read('Info.full_logo') === 'No'): ?>
                
                    <?php echo $this->Html->image('logo.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top;width:50px;']); ?>
                     <span style="line-height:32px; font-size:30px; font-weight: bold; color:#EF4836 !important; vertical-align: top"><?php  echo $this->request->session()->read('Info.school'); ?></span>
                     <span style=" display: inline-block;  position: relative;  left: 6px;  top: 0px;  width: 1px;  height: 41px;  background: #00bcd4 !important;"></span>
                     <span style=" position: relative;  display: inline-block;  font: 500 15px/15px 'asap', sans-serif;  letter-spacing: -0.025em;  color: #00bcd4 !important;  left: 6px;  top: -4px; text-align: left"><span style="display:block;">Address : <?php  echo $this->request->session()->read('Info.address'); ?><br/>Phone :<?php  echo $this->request->session()->read('Info.phone'); ?></span></span>
                <?php else: ?>     
               <?php echo $this->Html->image('logo2.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top;width:100%;']); ?>
                     
               <?php endif; ?>      
         
        </span> 
        
            <div class="row" style="margin-top:0px;text-align: right;">
                
                <div class="col-xs-8">
                    <strong>ANNUAL  EXAMINATION 2017-18</strong>
                </div>    
                
                
                <div class="col-xs-4">
                    <?php  $image = url()."img/students_images/".$row['img']; ?>
                    <?php echo $this->Html->image($image, ['alt' => 'student Picture', 'class' => 'profile-user-img img-responsive']); ?>

                </div>    
   
            </div>
        
    <table style='width: 100%;margin-top:0px;margin-left:20px;'>
        
            <tr style="border: 0px solid black;">
                <td class="nob" style='text-align: left;width:20%;'>Registration ID :</td>
                <td class="nob" style='text-align: left;width:40%;font-weight: bold;'><?= $row['registration_id']; ?></td>
            </tr>

            <tr style="border: 0px solid black;">
                <td class="nob" style='text-align: left;width:20%;'>Name of Student :</td>
                <td class="nob" style='text-align: left;width:40%;font-weight: bold;'><?= $row['name']; ?></td>
            </tr>
            
            <tr style="border: 0px solid black;">
                <td class="nob" style='text-align: left;width:20%;'>Father's Name :</td>
                <td class="nob" style='text-align: left;width:40%;font-weight: bold;'><?= $row['fname']; ?></td>
            </tr>
            
            <tr style="border: 0px solid black;">
                <td class="nob" style='text-align: left;width:20%;'>Class :</td>
                <td class="nob" style='text-align: left;width:40%;font-weight: bold;'><?= $row['class']; ?></td>
                
                <td class="nob" style='text-align:left;width:12%;'>Room/Hall: </td>
                <td class="nob" style='text-align: center;width:28%;font-weight: bold;text-align: left;'><?php if($row['exam_roll']){ echo $row['exam_roll'][0]['room'];  } ?></td>
                
            </tr>
            
            <tr style="border: 0px solid black;">
                <td class="nob" style='text-align: left;width:20%;'>Class Roll # :</td>
                <td class="nob" style='text-align: left;width:30%;font-weight: bold;'><?= $row['roll']; ?></td>
                
                <td class="nob" style='text-align:left;width:12%;'>Exam Roll #: </td>
                <td class="nob" style='text-align: center;width:28%;font-weight: bold;text-align: left;'><?php if($row['exam_roll']){ echo $row['exam_roll'][0]['exam_roll_no'];  } ?></td>
                
            </tr>

     </table> 
        
     <div class="row">
            <div class="col-xs-12">
            <table style='width: 100%;margin-top:10px'>
                <tr style="background-color:lightgray;">
                    <th>Date</th>
                    <th>Day</th>
                    <th>Subject</th>
                    <th>Time</th>
                </tr>
                <?php $message = ''; foreach($row['details'] as $d): ?>
                <tr>
                    
                    <th><?=  date('d-m-Y', strtotime($d['date'])); ?></th>
                    <th><?=  $d['day']; ?></th>
                    <th><?=  $d['subject']; ?></th>
                    <th><?=  date('h:i A', strtotime($d['time'])); ?></th>
                    
                </tr>
                <?php $message = $d['message']; ?>
                <?php endforeach; ?>
                
            </table>
                
                
                
            </div> 
         <div class="col-xs-12">
             
             <?= $message; ?>
             
         </div>
         
         
    </div>  
        
    
<!--    <div class="col-xs-2" style="border-top:solid black;text-align: center;">
              Teacher Sign. 
    </div>
    <div class="col-xs-2 pull-right" style="border-top:solid black;text-align: center;">
         Principal Sign.  
    </div>-->
        
       </div> 
        
        <br />
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
