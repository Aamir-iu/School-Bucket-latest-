<style type="text/css" media="print">
    @page { 
        size: landscape;
    }
/*    body { 
       // writing-mode: tb-rl;
    }*/
</style>
<?php //if(!empty($data)){ $details = $data[0]; } ?>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
             <?php $date = date("Y-m-d h:i"); ?>
            <i class="fa fa-globe"></i>Staff Salary Sheet | Department : <strong id="dep_id"></strong>  for the month of  <strong id="month_id"></strong>
          <div class="tools pull-right">
                    <a href="javascript:window.print()" class="fa fa-print" data-original-title="" title="Print">
                    </a>
                    <a href="javascript:(0);" onclick="goBack()" class="fa fa-reply hidden-xs hidden-sm" data-original-title="" title="Back">
                    </a>
          </div>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    
    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table id="userstable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="20%">Employee Name</th>
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
                    <th width="15%">Employee Signature</th>
                  
                </tr>
                </thead>
                <tbody>
            <?php $t=0; foreach ($employeeSalary as $employeeSalary): ?>
                <tr>
                      
                <td><?= h($employeeSalary->employee_id) ?></td>
                <td><?= h($employeeSalary->employee['employee_name']) ?></td>
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
                <td></td>
                <input type="text" class="hidden" id="did" value="<?= h($employeeSalary->department['department_name']) ?>">
                <input type="text" class="hidden" id="mid" value="<?= h($employeeSalary->month['month_name']) ?>">
                <input type="text" class="hidden" id="yid" value="<?= h($employeeSalary->salary_year) ?>">
              
                </tr>
                <?php $t += $employeeSalary->Net_salary; ?>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="12" style="text-align: right;font-weight: bold;">Grand Total :</td>
                      <td colspan="13" style="font-weight: bold;"><?= $this->Number->format($t) ?></td>
                    </tr>
                  </tfoot>
              </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<script>
  
   $(document).ready(function(){
   //  window.print();
    $('#dep_id').text($('#did').val());
    $('#month_id').text($('#mid').val() + "-"+$('#yid').val());
    
    });
   
  function goBack() {
    window.history.back();
  }  
 
    
</script>    