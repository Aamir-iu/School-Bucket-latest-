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
        <div style="border:solid 5px skyblue;padding: 30px;">
           
        <span style="display:block; position:relative; text-align:left; ">
                
               <?php if($this->request->session()->read('Info.full_logo') === 'No'): ?>
                
                    <?php echo $this->Html->image('logo.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top;width:50px;']); ?>
                     <span style="line-height:32px; font-size:30px; font-weight: bold; color:#EF4836 !important; vertical-align: top"><?php  echo $this->request->session()->read('Info.school'); ?></span>
                   
                <?php else: ?>     
               <?php echo $this->Html->image('logo2.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top;width:100%;']); ?>
                     
               <?php endif; ?>       
                     
        </span> 
            
        <div class="row" style="text-align:center;">
            
            <span style="font-weight: bold;"> Admit Card </span>
            <br />
            <span style="font-weight: bold;"> First Assessment 2017-18 </span>
          
        </div>    
        
        <div class="row" style="margin-top:0px">
               
                <div class="col-sm-4 col-sm-offset-8 pull-right">
                    <?php  $image = url()."img/students_images/".$row['img']; ?>
                    <?php echo $this->Html->image($image, ['alt' => 'student Picture', 'class' => 'profile-user-img img-responsive','style'=>'width:70px;']); ?>

                </div>    
              
                <table style='width: 95%;margin-top:0px;margin-left:10px;'>
                    
                    <tr style="border: 0px solid black;" class="spaceUnder">
                        <td class="nob" style='text-align: left;width:15%;'>Student's ID :</td>
                        <td class="nob" style='text-align: left;width:20%;font-weight: bold;'>
                            
                            <table style='width: 30%;margin-top:10px;margin-left:20px;'>
                                <tr>
                                    <?php for($i=0; $i<=4; $i++): ?>
                                    <?php $id =  str_pad($row['registration_id'], 5, '0', STR_PAD_LEFT); ?>
                                    <td style="width:15px;"><?php if(isset($id[$i])){ echo strtoupper($id[$i]); }else{ echo ""; } ?></td>
<!--                                     <td style="width:25px;">&nbsp;&nbsp;&nbsp;</td>-->
                                    <?php endfor; ?>
                                    <td style="width:15px;">-</td>
                                    <?php for($i=0; $i<=2; $i++): ?>
                                    <?php $id =  str_pad($row['roll_no'], 3, '0', STR_PAD_LEFT); ?>
                                    <td style="width:15px;"><?php if(isset($id[$i])){ echo strtoupper($id[$i]); }else{ echo ""; } ?></td>
<!--                                     <td style="width:25px;">&nbsp;&nbsp;&nbsp;</td>-->
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
       
       
<!--        <div class="col-xs-12 pull-left">
               <?php //echo $row['created_by']; ?> 
        </div>
       
        <div class="col-xs-3" style="border-top:solid black;text-align: center;">
              Teacher Sign. 
        </div>
      
        
        <div class="col-xs-3 pull-right" style="border-top:solid black;text-align: center;">
             Principal Sign.  
        </div>-->
        <br />
        <br />
        <br />
        <br />
<!--        <div class="col-xs-12" style="border-top:solid black;text-align: center;">
            <span style=" position: relative;  display: inline-block;  font: 500 13px/13px 'asap', sans-serif;  letter-spacing: -0.025em;  color: #00bcd4 !important;  left: 6px;  top: 4px; text-align: left"><span style="display:block;text-align: center;">Address : <?php  //echo $this->request->session()->read('Info.address'); ?>. Phone :<?php  //echo $this->request->session()->read('Info.phone'); ?></span></span>
        </div>
        -->
<!--        <div class="col-xs-12" style="border-top:solid black;text-align: center;margin-top: 10px;">
             Project of PGC.  
        </div>-->
        
        <br />
        <br />
        
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