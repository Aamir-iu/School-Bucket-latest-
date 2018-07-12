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
  
   <?php $page = 1; foreach ($employeeSalary as $employeeSalary): ?> 
    
    <!-- Main content -->
    <section class="invoice">
        
           
        <span style="display:block; position:relative; text-align:center; ">
            
            <?php if($this->request->session()->read('Info.full_logo') === 'No'): ?>
                <?php echo $this->Html->image('logo.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top;width:50px;']); ?>
                   <span style="line-height:40px; font-size:38px; font-weight: bold; color:#EF4836 !important; vertical-align: top"><?php  echo $this->request->session()->read('Info.school'); ?></span>
                  
<!--                   <span style=" display: inline-block;  position: relative;  left: 6px;  top: 0px;  width: 1px;  height: 41px;  background: #00bcd4 !important;"></span>-->
                   <span style=" position: relative;  display: inline-block;  font: 500 15px/15px 'asap', sans-serif;  letter-spacing: -0.025em;  color: #00bcd4 !important;  left: 6px;  top: -4px; text-align: left"><span style="display:block;text-align: center;">Address : <?php  echo $this->request->session()->read('Info.address'); ?><br/>Phone :<?php  echo $this->request->session()->read('Info.phone'); ?></span></span>
         
              <?php else: ?>     
             <?php echo $this->Html->image('logo2.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top;width:100%;']); ?>

            <?php endif; ?>       
            
            
                   
        </span> 
            <center>
                <div id="outer" style="margin-top:10px;border-top:0px solid black;">
                Salary Slip
                </div> 
            </center>
            
            <div class="row" style="margin-top:20px">
                <div class="user-block" style="margin-left:20px;">
                    <?php  $image = url()."img/employees/".$employeeSalary->employee['employee_pic']; ?>
                    <?php echo $this->Html->image($image, ['alt' => 'employee Picture', 'class' => 'profile-user-img img-responsive','style'=>'width:100px;height:100px;']); ?>
                        <span class="username">
                            <a href="#"><?= strtoupper(h($employeeSalary->employee['employee_name'])) ?></a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                   <?php $id =  str_pad($employeeSalary->employee_id, 5, '0', STR_PAD_LEFT); ?> 
                    <span class="description">Emp ID #: <?= $id; ?></span>
                </div>
            </div>
        <hr> 
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table id="userstable" style="width:100%;" class="table">
                <thead>
                <tr>
                   
                    <th width="50%">Department :  <?= h($employeeSalary->department['department_name']) ?></th>
                    <th width="30%">Month : <?= h($employeeSalary->month['month_name']) ?></th>
                    <th width="20%">Year : <?= h($employeeSalary->salary_year) ?></th>
                  
                </tr>
                </thead>
               
              </table>
            </div>
        </div>    
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table id="userstable" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                   
                    <th width="5%">Basic Salary</th>
                    <th width="5%">Working Days</th>
                    <th width="5%">Per Day Salary</th>
                    <th width="5%">Late</th>
                    <th width="5%">Absentees.</th>
                    <th width="5%">Medical Allowance</th>
                    <th width="5%">Conveyance  Allowance</th>
                    <th width="5%">Punctuality Allowance</th>
                    <th width="5%">Bonus</th>
                    <th width="5%">Detect Salary</th>
                    <th width="10%">Net Salary</th>
                    
                  
                </tr>
                </thead>
                <tbody>
            
                <tr>
                      
               
                <td><?= $this->Number->format($employeeSalary->basic_salary) ?></td>
                <td><?= h($employeeSalary->working_days) ?></td>
                <td><?= h($employeeSalary->per_day_salary) ?></td>
                <td><?= h($employeeSalary->late) ?></td>
                <td><?= h($employeeSalary->absents) ?></td>
                <td><?= h($employeeSalary->ma) ?></td>
                <td><?= h($employeeSalary->ca) ?></td>
                <td><?= h($employeeSalary->pa) ?></td>
                <td><?= $this->Number->format($employeeSalary->extra_amount) ?></td>
                <td><?= $this->Number->format($employeeSalary->detect_salary) ?></td>
                <td><?= $this->Number->format($employeeSalary->Net_salary) ?></td>
              
              
                </tr>
               
                </tfoot>
              </table>
            </div>
        </div>    
        <br />
         <br />
          <br />
   
       
        <div class="col-xs-2" style="border-top:solid black;text-align: center;">
              Employee Sign. 
        </div>
      
        
        <div class="col-xs-2 pull-right" style="border-top:solid black;text-align: center;">
             HR Manager Sign.  
        </div>
         <br />
        <br />
        <br />
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
       // window.print();
        $('#dis_id').html($('#cid').val());


    });

    function goBack() {
        window.history.back();
    }



</script>    