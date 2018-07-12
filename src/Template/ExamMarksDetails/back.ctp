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
    padding-bottom: 0.1em;
    }
</style> 
<div class="wrapper">
  
    
    
    <!-- Main content -->
    <section class="invoice">
    
        <div class="row" style="margin-top:0px">
        
              
            <table class="table" style='width: 95%;margin-top:0px;margin-left:20px;border: 2px;'>
                <tr style="border: 2px solid black;" class="spaceUnder">
                    <th>Subjects</th>
                    <th>Date</th>
                    <th>Signature.</th>
                </tr>
                <?php $page = 1; foreach ($data as $row): ?>    
                    <tr style="border: 2px solid black;" class="spaceUnder">
                        
                        <td class="nob" style='text-align: left;width:40%;border: 2px solid black;'><?php echo $row['subject']; ?></td>
                        <td class="nob" style='text-align: left;width:20%;font-weight: bold;border: 2px solid black;'></td>
                        <td class="nob" style='text-align: left;width:20%;font-weight: bold;border: 2px solid black;'></td>
         
                    </tr>
                <?php $page++; endforeach; ?>    
               </table>

            </div>
 
       
        <br />
        <div class="col-xs-12" style="border-top:solid black;text-align: center;">
            <span style=" position: relative;  display: inline-block;  font: 500 13px/13px 'asap', sans-serif;  letter-spacing: -0.025em;  color: #00bcd4 !important;  left: 6px;  top: 4px; text-align: left"><span style="display:block;text-align: center;font-weight: bold;">Note : Without admit card you are not allowed to seat in exam.</span></span>
        </div>
         <br />
      
    </section>
    <!-- /.content -->
  
    
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