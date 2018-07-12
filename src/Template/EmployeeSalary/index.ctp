<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
             
          <div class="btn-group pull-right">
                        <div class="row">
                            <div class="col-xs-8">
                                    <div class="box-tools">
                                        <div class="input-group">
                                            <form method="post" action="" id="search-form" class="form-horizontal">
                                                <table class="table table-responsive">
                                            
                                            <tr>
                                                
<!--                                                <td>
                                                 <input type="text" class="form-control input-sm" name="id_search" id="id_search" placeholder="Employee ID" style="width: 130px;">
                                                </td> 
                                                <td>
                                                    <button class="btn btn-sm btn-primary" name="btnSearch" id="btnSearch" onclick="search_record();" type="submit"><i class="fa fa-search"></i> Search </button>
                                                </td>-->
                                                
                                                <td>
                                                    <button class="btn btn-sm btn-success" name="btnSearch" id="btnSearch" onclick="loadmodal();" type="button"><i class="fa fa-plus"></i> Add New Salary </button>
                                                
                                                
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success" name="btnSearch" id="btnSearch" onclick="loadmodal_multiple();" type="button"><i class="fa fa-plus"></i> Add New Multiple Salaries </button>
                                                
                                                
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-info" name="btnSearch" id="btnSearch" onclick="loadmodalPrint();" type="button"><i class="fa fa-print"></i> Print Salary Sheet</button>
                                  
                                                </td>
<!--                                                <td>
                                                    <button class="btn btn-sm btn-primary" name="btnSearch" id="btnSearch" onclick="loadmodalSettings();" type="button"><i class="fa fa-gears"></i> Settings </button>
                                  
                                                </td>-->
                                                
                                            </tr>
                                            </table>
                                            </form>
                                        </div>
                                    </div>
                            </div>     
                        </div> 
                      
                    </div>
                
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="userstable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="15%">Employee Name</th>
                    <th width="5%">Basic Salary</th>
                    <th width="5%">WD</th>
                    <th width="5%">PDS</th>
                    <th width="5%">Late</th>
                    <th width="5%">Absentees</th>
                    <th width="5%">DS</th>
                    <th width="5%">Bonus</th>
                  
                    
                    <th width="10%">Net Salary</th>
                    <th width="10%">Salary Month</th>
                    <th width="20%" class="actions"><?= __('Actions') ?></th>
                  
                </tr>
                </thead>
                <tbody>
            <?php foreach ($employeeSalary as $employeeSalary): ?>
                <tr>
                      
                <td><?= h($employeeSalary->employee_id) ?></td>
                <td><?= h($employeeSalary->employee['employee_name']) ?></td>
                <td><?= $this->Number->format($employeeSalary->basic_salary) ?></td>
                <td><?= h($employeeSalary->working_days) ?></td>
                <td><?= h($employeeSalary->per_day_salary) ?></td>
                <td><?= h($employeeSalary->late) ?></td>
                <td><?= h($employeeSalary->absents) ?></td>
                <td><?= $this->Number->format($employeeSalary->detect_salary) ?></td>
                <td><?= $this->Number->format($employeeSalary->extra_amount) ?></td>
                <td><?= $this->Number->format($employeeSalary->Net_salary) ?></td>
                <td><?= h($employeeSalary->salary_month) ?>-<?= h($employeeSalary->salary_year) ?></td>
                     <td class="actions">
                        <?= $this->Html->link(__('<i class="fa fa-print"></i> Print'), ['#' => '#'], ['onclick'=>"PrintSingleSlip($employeeSalary->id_employee_salary);",'class' => 'btn btn-icon waves-effect waves-light btn-info m-b-5', 'escape' => false]) ?>  
                        <?= $this->Html->link(__('<i class="fa fa-trash"></i> Delete'), ['#' => '#'], ['onclick'=>"delete_salary($employeeSalary->id_employee_salary);",'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                        
                     </td>
                   
                 
                </tr>
                  <?php endforeach; ?>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    
    
<!-- BEGIN INVOICE CANCEL MODAL FORM-->
<div class="modal fade" id="add-report"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:80%!important;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h5 class="modal-title">Generate Employee Salary</h5>
                
                <div class="modal-header" style="margin-bottom: 10px;height: 70px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <div class="box-header">
                    <form method="post" action="" id="searchstudentbyname">
                        <div class="input-group input-group-sm" style="width: 600px;margin-bottom: 28px;">

                            <input type="text"  class="form-control search numbers"  id="searchid"   placeholder="Search for staff">

                            <div id="result"></div>

                            <div class="input-group-btn">
                                <button type="submit"  class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
     
                    <div class="box-tools">
                        <form method="post" action="" id="searchstudent">
                            <div class="input-group input-group-sm" style="width: 200px;">
                                <input type="text"   name="search" id="search" class="form-control pull-right" placeholder="Search">
                                <div class="input-group-btn">
                                    <button type="submit"  class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>  
                    </div>
                  
                    </div>
                </div>
                
                
                
                
            </div>
            <div class="modal-body" id="myloading">
                <form class="form-horizontal">

                <div class="col-md-12">
                    <!-- Profile Image -->
                    <div class="box box-primary">
                      <div class="box-body box-profile">
                        <div class="col-md-4">      
                            <a href="#"><?php echo $this->Html->image('students_images/avatar-1.jpg', ['alt' => 'user Picture', 'class' => 'profile-user-img img-responsive img-circle', 'id' => 'blah']); ?></a>
                              <input type="file" id="upload" onchange="readURL(this);" name="file" style="visibility: hidden; width: 1px; height: 1px" multiple />

                             <h3 class="profile-username text-center" id="employee_name"></h3>
                             <ul class="list-group list-group-unbordered">
                               <input type="text" class="hidden"  id="department_id" name="department_id" value="" />  
                               <li class="list-group-item">
                                   <b>Employee Code : </b> <a class="pull-right"><input type="text" readonly id="employee_id" name="employee_id" value="" style="border:none;text-align:center;width:100px;"></a>
                               </li>
<!--                               <li class="list-group-item">
                                   <b>Department : </b> <a class="pull-right"><input type="text" readonly name="deparment_id" value="Admin" style="border:none;text-align:center;width:100px;"></a>
                               </li>-->
                               
                             </ul>
                        </div>
                        <div class="col-md-8">
                            
                            <div class="form-group">
                                <label for="salary_month"   class="col-sm-3 control-label">Salary Month: </label>
                                <div class="col-sm-3">
                                  <select class="form-control"  id="salary_month" name="salary_month" data-placeholonchangeder="Select Payment Type" style="width: 100%;">
                                    <?php foreach($months as $m): ?>  
                                      <?php $m_id = ltrim(date("m"),'0'); ?>
                                      <option <?php echo $m->id_month == $m_id ? "selected" : ""; ?> value="<?= $m->id_month ?>"><?= $m->month_name ?></option>
                                    <?php endforeach; ?> 
                                  </select>
                                 </div> 
                                
                                <label for="salary_year"   class="col-sm-3 control-label">Salary Year: </label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="salary_year" name="salary_year" value="<?= date("Y") ?>" />
                                 </div> 
                                
                            </div>
                            
                            
                          
                            <div class="form-group">
                                <label for="payment_type"   class="col-sm-3 control-label">Payment Type: </label>
                                <div class="col-sm-3">
                                    <select class="form-control" onchange="changepaymenttype();" id="payment_type" name="payment_type" data-placeholonchangeder="Select Payment Type" style="width: 100%;">
                                      <option value="Cash">Cash</option>
                                      <option value="Cheque">Cheque</option>
                                      <option value="Pay Order">Pay Order</option>
                                      <option value="Online Transfer">Online Transfer</option>
                                  </select>
                                 </div> 
                                
                                
                                <label for="payment_type"   class="col-sm-3 control-label">Salary Method: </label>
                                <div class="col-sm-3">
                                    <select onchange="calculteSalary();" class="form-control" onchange="changedaysType();" id="wd_type" name="wd_type" data-placeholonchangeder="Select Payment Type" style="width: 100%;">
                                      
                                      <option value="1">Fixed</option>
                                      <option value="2">Working Days</option>
                                      
                                  </select>
                                 </div>   
                                
                            </div>
                            
                            <div class="form-group" id="ref_id" style="display: none;">
                                <label for="ref_no"   class="col-sm-3 control-label"></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Please Enter Cheque Number or Pay order Number or Transaction ID" id="ref_no" name="ref_no" value="" />
                                 </div>
                            </div>
                            
                            
                          
                            
                            <div class="form-group">
                                <label for="working_days"   class="col-sm-3 control-label">Working Days: </label>
                                <div class="col-sm-3">
                                    <input type="text" onkeyup="calculteSalary();" class="form-control"  id="working_days" name="working_days" value="" />
                                    <input type="text" class="form-control hidden" id="fixed_working_days" name="fixed_working_days" value="30" />
                                 </div>  
                                
                                <label for="basic_salary"   class="col-sm-3 control-label">Basic Salary: </label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" disabled="disabled" id="basic_salary" name="basic_salary" value="" />
                                 </div> 
                                
                            </div>
                            
                            <div class="form-group">
                                
                                <label for="per_day_salary"   class="col-sm-3 control-label">Per Day Salary: </label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" disabled="disabled" id="per_day_salary" name="per_day_salary" value="" />
                                 </div>
                                
                                <label for="late"   class="col-sm-3 control-label">Number of late: </label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="late" name="late" value="" />
                                </div>  
                                
                            </div>
                          
                            
                            <div class="form-group">
                                <label for="absents"   class="col-sm-3 control-label">Number of abs.: </label>
                                <div class="col-sm-3">
                                    <input type="text" onkeyup="calculteSalary();" class="form-control" id="absents" name="absents" value="" />
                                </div> 
                                
                                <label for="detect_salary"   class="col-sm-3 control-label">Detect Salary: </label>
                                <div class="col-sm-3">
                                    <input type="text" disabled="disabled" class="form-control" id="detect_salary" name="detect_salary" value="" />
                                </div> 
                                
                            </div>
                            
                            
                            <div class="form-group">
                                
                                <label for="gross_salary"   class="col-sm-3 control-label">Gross Salary: </label>
                                <div class="col-sm-3">
                                    <input type="text" disabled="disabled" class="form-control" id="gross_salary" name="gross_salary" value="" />
                                 </div>  
                                
                                
                                <label for="extra_amount"   class="col-sm-3 control-label">Bonus/Extra Amount: </label>
                                <div class="col-sm-3">
                                    <input type="text" onkeyup="calculteSalary();" class="form-control" id="extra_amount" name="extra_amount" value="" />
                                 </div>   
                            </div>
                            
                            <div class="form-group">
                                <label for="installment"    class="col-sm-3 control-label">Installment: </label>
                                <div class="col-sm-3">
                                    <input type="text" disabled="disabled" class="form-control" id="installment" name="installment" value="" />
                                 </div>  
                                
                                <label for="Net_salary"   class="col-sm-3 control-label">Net Salary: </label>
                                <div class="col-sm-3">
                                    <input type="text" disabled="disabled" class="form-control" id="Net_salary" name="Net_salary" value="" />
                                 </div>  
                                
                            </div>
                            
                            
                          
                        </div>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
               </div>
                    
                    

                </form>
            </div>
            <div class="modal-footer">
                <button onclick="AddNew();" type="button" class="btn btn-icon waves-effect waves-light btn-success m-b-5"><li class="fa fa-save"></li> Save</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal"><li class="fa fa-close"></li> Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- BEGIN INVOICE CANCEL MODAL FORM-->
<div class="modal fade" id="add-print"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Print Salary Reports</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">

                   <div class="form-group">
                        <label for="depart_id"   class="col-sm-3 control-label">Department: </label>
                        <div class="col-sm-9">
                          <select class="form-control"  id="depart_id" name="depart_id" data-placeholonchangeder="Select Payment Type" style="width: 100%;">
                            <?php foreach($departments as $d): ?>  
                                <option  value="<?= $d->department_id ?>"><?= $d->department_name ?></option>
                            <?php endforeach; ?> 
                          </select>
                         </div> 
                  </div>
                    
                  <div class="form-group">
                        <label for="salary_month"   class="col-sm-3 control-label">Salary Month: </label>
                        <div class="col-sm-3">
                          <select class="form-control"  id="salary_month_id" name="salary_month_id" data-placeholonchangeder="Select Payment Type" style="width: 100%;">
                            <?php foreach($months as $m): ?>  
                              <?php $m_id = ltrim(date("m"),'0'); ?>
                              <option <?php echo $m->id_month == $m_id ? "selected" : ""; ?> value="<?= $m->id_month ?>"><?= $m->month_name ?></option>
                            <?php endforeach; ?> 
                          </select>
                         </div> 

                        <label for="salary_year"   class="col-sm-3 control-label">Salary Year: </label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="salary_year_id" name="salary_year_id" value="<?= date("Y") ?>" />
                         </div> 

                    </div>  
                    <div class="form-group">
                        <label for="report_type"   class="col-sm-3 control-label">Report Type: </label>
                        <div class="col-sm-9">
                            <select class="form-control"  id="report_type" name="report_type" data-placeholonchangeder="Select Payment Type" style="width: 100%;">
                              <option value="detail">Detail Report</option>
                              <option value="slip">Salary Slip</option>
                            </select>
                         </div> 
                                                           
                    </div>
                    

                </form>
            </div>
            <div class="modal-footer">
                <button onclick="Print_report();" type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5"><li class="fa fa-print"></li> Print</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal"><li class="fa fa-close"></li> Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->    
    
<!-- BEGIN EDIT SUB ACCOUNT MODAL FORM-->
<div class="modal fade " id="add-multiple"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:95%!important;">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <form>
                            <div class="row col-xs-12" id="loadind">

                                <div class="col-sm-3">
                                    <select class="form-control"  id="mdepart_id" name="mdepart_id" data-placeholonchangeder="Select Payment Type" style="width: 100%;">
                                      <?php foreach($departments as $d): ?>  
                                          <option  value="<?= $d->department_id ?>"><?= $d->department_name ?></option>
                                      <?php endforeach; ?> 
                                    </select>
                                </div> 

                                <div class="col-sm-3">
                                    <select class="form-control"  id="msalary_month_id" name="msalary_month_id" data-placeholonchangeder="Select Payment Type" style="width: 100%;">
                                      <?php foreach($months as $m): ?>  
                                        <?php $m_id = ltrim(date("m"),'0'); ?>
                                        <option <?php echo $m->id_month == $m_id ? "selected" : ""; ?> value="<?= $m->id_month ?>"><?= $m->month_name ?></option>
                                      <?php endforeach; ?> 
                                    </select>
                                </div> 

                                <div class="col-sm-1">
                                    <input type="text" class="form-control" id="msalary_year_id" name="msalary_year_id" value="<?= date("Y") ?>" />
                                </div> 
                                
                                
                                <div  class="col-md-5">   
                                    <div class="form-group">  
                                    <div class="pull-right" style="margin-right:0px!important;"> 
                                        <button onclick="generateSalary();" readonly type="button" class="btn btn-icon waves-effect waves-light btn-success m-b-5">Generate Salary</button>
                                        <button type="button" onclick="javascript:window.reload()" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
                                    </div>  
                                </div>  
                                </div>
                                

                            </div>     

                        </form>
                </div>
            </div>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">

                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table id="salarytable"  class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="3%">Emp.ID</th>
                                        <th width="12%">Employee Name</th>
                                        <th width="8%">SM</th>
                                        <th width="8%">BS</th>
                                        
                                        <th width="5%">WD</th>
                                        
                                        <th width="8%">PDS</th>
                                        <th width="5%">Late</th>
                                        <th width="5%">Abs.</th>
                                        
                                        <th width="7%">B/E</th>
                                        
                                        <th width="7%">MA</th>
                                        <th width="7%">CA</th>
                                        <th width="7%">PA</th>
                                        <th width="7%">DS</th>
                                        
                                        <th width="10%">Net Salary</th>

                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>   
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </div>
            
            <div class="modal-footer">
                <div class="form-group" id="btn_save" style="display:none;">  
                    <div class="pull-right" style="margin-right:0px!important;"> 
                        <button onclick="add_Salary();" readonly type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Save</button>
                        <button  type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
                   </div>  
                </div>   
            </div>     

    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->    
    
  <?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
  <?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
  <?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
    
  <?= $this->Html->script('datatable.js') ?>  
<script>
    $(function () {
    $("#userstable").DataTable();
    
    $('#searchstudent').on('submit', function(){
        getEmployee();
        return false;
    });  
    
  });
    function delete_salary(id) {

       swal({
            title: 'Are you sure?',
            text: "you want to delete!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then(function (result) {
            if (result) {
                if (id > 0) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'EmployeeSalary', 'action' => 'delete']); ?>",
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {id:id},
                        success: function (data) {
                            var result = data.msg.split("|");
                            if (result[0] === "Success") {
                                toastr.success(result[0], result[1]);
                               
                            } else {
                                toastr.error(result[0], result[1]);
                            }
                        }
                    });
                }

            }
           swal(
            'Deleted!',
            'Record has been delete.',
            'success'
           
          )
           location.reload();
        });

    }
    function changepaymenttype(){
    
        var type = $('#payment_type option:selected').val();
        if (type == 'Cash') {
            $('#ref_id').fadeOut();
        }else{
            $('#ref_id').fadeIn();
        }
        
    }
    function getEmployee() {
        var employee_id = $('#search').val();
        imageOverlay('#myloading', 'show');
        $('#employee_name').text('');
        $('#employee_id').val('');
        $('#basic_salary').val('');
        $('#department_id').val('');
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'EmployeeSalary', 'action' => 'getEnployee']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {employee_id: employee_id},
            success: function (data) {
                var mdata = data.employee;
              
                if (mdata) {
                    $('#employee_name').text(mdata.employee_name);
                    $('#employee_id').val(mdata.employee_id);
                    $('#basic_salary').val(mdata.basic_salary);
                    $('#department_id').val(mdata.department_id);
                    calculteSalary();
                } 
            }
        });
         imageOverlay('#myloading', 'hide');
    }
    function calculteSalary(){
   
        $('#working_days').val(30);
        var fixed_wd = $('#fixed_working_days').val() ? $('#fixed_working_days').val() : '0';
        var wd = $('#working_days').val() ? $('#working_days').val() : '0';
        var basic_salary = $('#basic_salary').val() ? $('#basic_salary').val() : '0';
        var absents = $('#absents').val() ? $('#absents').val() : '0';
        var extra_amount = $('#extra_amount').val() ? $('#extra_amount').val() : '0';
        
        var wd_type = $('#wd_type option:selected').val();
        
        if(wd_type =='1'){
            var per_day_salary = parseFloat(basic_salary) / parseFloat(fixed_wd);
            $('#gross_salary').val(parseFloat(basic_salary).toFixed(2));
        }else{
            if(wd =='0'){
                 toastr.error('Please enter employee working days');
                 return false;
            }else{
                var per_day_salary = parseFloat(basic_salary) / parseFloat(fixed_wd);
                $('#gross_salary').val(parseFloat(per_day_salary * wd).toFixed(2));
            }
        }
        
        
        var dect_salary = parseFloat(absents) * parseFloat(per_day_salary);
        $('#per_day_salary').val(parseFloat(per_day_salary).toFixed(2));
        $('#detect_salary').val(parseFloat(dect_salary).toFixed(2));
        var net_salary = parseFloat($('#gross_salary').val()) - parseFloat(dect_salary) + parseFloat(extra_amount);
        
      //  net_salary = extra_amount + $('#gross_salary').val();
        
        $('#Net_salary').val(parseFloat(net_salary).toFixed(2));
        
   
   }
    function loadmodal() {
        $('#add-report').modal('show');
    }
    function loadmodal_multiple() {
        $('#add-multiple').modal('show');
    }
    function Print_report() {
        var department_id =  $('#depart_id option:selected').val();
        var month_id =  $('#salary_month_id option:selected').val();
        var year =  $('#salary_year_id').val();
        var report_type =  $('#report_type option:selected').val();
        var flag = '1';
        window.open("<?php echo $this->Url->build(['controller' => 'EmployeeSalary', 'action' => 'view']); ?>/"+flag+"/"+department_id+"/"+month_id+"/"+year+"/"+report_type);

    }
    function PrintSingleSlip(id) {
       
        var flag = '0';
        window.open("<?php echo $this->Url->build(['controller' => 'EmployeeSalary', 'action' => 'view']); ?>/"+flag+"/"+id);

    }
    function AddNew() {
        
            var employee_id = $('#search').val();
            var basic_salary = $('#basic_salary').val();
            var payment_type = $('#payment_type option:selected').val();
            var ref_no       = $('#ref_no').val();
            var working_days = $('#working_days').val();
            var per_day_salary = $('#per_day_salary').val();
            var extra_amount = $('#extra_amount').val();
            var late = $('#late').val();
            var absents = $('#absents').val();
            var detect_salary = $('#detect_salary').val();
            var installment = $('#installment').val();
            var gross_salary = $('#gross_salary').val();
            var Net_salary = $('#Net_salary').val();
            var salary_month = $('#salary_month option:selected').val();
            var salary_year = $('#salary_year').val();
            var department_id = $('#department_id').val();
        
        imageOverlay('#myloading', 'show');
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'EmployeeSalary', 'action' => 'add']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {employee_id: employee_id,
                   basic_salary:basic_salary,
                   payment_type:payment_type,
                   ref_no:ref_no,
                   working_days:working_days,
                   per_day_salary:per_day_salary,
                   extra_amount:extra_amount,
                   late:late,
                   absents:absents,
                   detect_salary:detect_salary,
                   installment:installment,
                   gross_salary:gross_salary,
                   Net_salary:Net_salary,
                   salary_month:salary_month,
                   salary_year:salary_year,
                   id_department:department_id
                  },
            success: function (data) {
                    var result = data.msg.split("|");
                    if (result[0] === "Success") {
                        toastr.success(result[0], result[1]);
                    } else if (result[0] === "Warning") {
                        toastr.warning(result[0], result[1]);
                    }else{
                        toastr.error(result[0], result[1]);
                    }
            }
        });
         imageOverlay('#myloading', 'hide');
    }
    function loadmodalPrint() {
        $('#add-print').modal('show');
    }
    function generateSalary() {

        var department_id = $('#mdepart_id option:selected').val();
        var month_id = $('#msalary_month_id option:selected').val();
        var year_id = $('#msalary_year_id').val();
        if (department_id === '') {
            toastr["error"]("Please select department!");
            return false;
        }
        imageOverlay('#salarytable', 'show');
        $('#btn_save').hide();
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'EmployeeSalary', 'action' => 'generateSalary']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {department_id: department_id,month_id:month_id,year_id:year_id},
            success: function (data) {
                var mdata = data.data;
                imageOverlay('#salarytable', 'hide');
                var mhtml = "";
                $("#salarytable tbody").html('');
                if (mdata.length > 0) {
                 //   toastr.success(result[0], result[1]);
                    for (var x = 0; x < mdata.length; x++) {
                        mhtml += '<tr>';
                        mhtml += "<td>" + mdata[x]['employee_id'] + "</td>";
                        mhtml += "<td>" + mdata[x]['employee_name'] + "</td>";
                        mhtml += "<td><select onchange='calculate("+mdata[x]['employee_id']+");' id='sm"+mdata[x]['employee_id']+"' class='form-control' style='height:30px;' name='attendace_status'><option value='1'>Fixed</option><option value='2'>WD</option></select></td>";
                        mhtml += "<td><input id='bs"+mdata[x]['employee_id']+"' type='text' readonly class='form-control' value='"+ Math.floor(mdata[x]['basic_salary']).toFixed(2) +"' /></td>";
                        mhtml += "<td><input onkeyup='calculate("+mdata[x]['employee_id']+");' id='wd"+mdata[x]['employee_id']+"' type='text' class='form-control' value='30' /></td>";
                        mhtml += "<td><input id='pd"+mdata[x]['employee_id']+"' type='text' readonly class='form-control' value='"+ Math.floor(mdata[x]['basic_salary'] / 30).toFixed(2)  +"' /></td>";
                        mhtml += "<td><input id='lt"+mdata[x]['employee_id']+"' type='text' class='form-control' value='"+ mdata[x]['late'] +"' /></td>";
                        mhtml += "<td><input onkeyup='calculate("+mdata[x]['employee_id']+");' id='ab"+mdata[x]['employee_id']+"' type='text' class='form-control' value='"+ mdata[x]['absentees'] +"' /></td>";
                        var pds = Math.floor(mdata[x]['basic_salary'] / 30).toFixed(2)
                       
                        
                        
                      
                        mhtml += "<td><input onkeyup='calculate("+mdata[x]['employee_id']+");' id='es"+mdata[x]['employee_id']+"' type='text' class='form-control' value='0' /></td>";
                        mhtml += "<td><input onkeyup='calculate("+mdata[x]['employee_id']+");' id='ma"+mdata[x]['employee_id']+"' type='text' class='form-control' value='0' /></td>";
                        mhtml += "<td><input onkeyup='calculate("+mdata[x]['employee_id']+");' id='ca"+mdata[x]['employee_id']+"' type='text' class='form-control' value='0' /></td>";
                        mhtml += "<td><input onkeyup='calculate("+mdata[x]['employee_id']+");' id='pa"+mdata[x]['employee_id']+"' type='text' class='form-control' value='0' /></td>";
                        mhtml += "<td><input onkeyup='ds("+mdata[x]['employee_id']+");' id='ds"+mdata[x]['employee_id']+"' type='text'  class='form-control' value='"+ Math.floor(mdata[x]['absentees'] * pds).toFixed(2) +"' /></td>";
                        var ds = Math.floor(mdata[x]['absentees'] * pds).toFixed(2);
                        mhtml += "<td><input id='ns"+mdata[x]['employee_id']+"' type='text' readonly class='form-control' value='"+ Math.floor(mdata[x]['basic_salary'] - ds).toFixed(2) +"' /></td>";
                         
                         
                        mhtml += '</tr>';
                    }
                    $("#salarytable tbody").append(mhtml);
                    $('#btn_save').show();
                } else {
                   // toastr.error(result[0], result[1]);
                }

            }
        });
    }
    function calculate(id){
    
       var sm = $('#sm'+id+' option:selected').val(); 
       if(sm == '1'){
       
        var ab = $('#ab'+id).val() !== '' ? parseInt($('#ab'+id).val()) : 0;
            var pds = $('#pd'+id).val() !== '' ? parseInt($('#pd'+id).val()) : 0;
            var bs = $('#bs'+id).val() !== '' ? parseInt($('#bs'+id).val()) : 0;
            var es = $('#es'+id).val() !== '' ? parseInt($('#es'+id).val()) : 0;
            var ds = (ab * pds);

            var ma = $('#ma'+id).val() !== '' ? parseInt($('#ma'+id).val()) : 0;
            var ca = $('#ca'+id).val() !== '' ? parseInt($('#ca'+id).val()) : 0;
            var pa = $('#pa'+id).val() !== '' ? parseInt($('#pa'+id).val()) : 0;

            $('#ds'+id).val(Math.floor(ds).toFixed(2));
            $('#ns'+id).val(Math.floor(bs - ds + es + ma + ca + pa).toFixed(2));
       
       }else{
           
            var wd = $('#wd'+id).val() !== '' ? parseInt($('#wd'+id).val()) : 0;
            var ab = $('#ab'+id).val() !== '' ? parseInt($('#ab'+id).val()) : 0;
            var pds = $('#pd'+id).val() !== '' ? parseInt($('#pd'+id).val()) : 0;
            var bs = $('#bs'+id).val() !== '' ? parseInt($('#bs'+id).val()) : 0;
            var es = $('#es'+id).val() !== '' ? parseInt($('#es'+id).val()) : 0;
            var ds = (ab * pds);
            
            var ma = $('#ma'+id).val() !== '' ? parseInt($('#ma'+id).val()) : 0;
            var ca = $('#ca'+id).val() !== '' ? parseInt($('#ca'+id).val()) : 0;
            var pa = $('#pa'+id).val() !== '' ? parseInt($('#pa'+id).val()) : 0;
            
            var ns = wd * pds + es + ma + ca + pa;
            
            
            
            $('#ds'+id).val(Math.floor(ds).toFixed(2));
            $('#ns'+id).val(Math.floor(ns - ds).toFixed(2));
       }
    }
    function ds(id){
      // calculate(id);
        var ds = $('#ds'+id).val() !== '' ? parseInt($('#ds'+id).val()) : 0;
        var ns = $('#ns'+id).val() !== '' ? parseInt($('#ns'+id).val()) : 0;
        
        var ma = $('#ma'+id).val() !== '' ? parseInt($('#ma'+id).val()) : 0;
        var ca = $('#ca'+id).val() !== '' ? parseInt($('#ca'+id).val()) : 0;
        var pa = $('#pa'+id).val() !== '' ? parseInt($('#pa'+id).val()) : 0;
        var es = $('#es'+id).val() !== '' ? parseInt($('#es'+id).val()) : 0;
        var bs = $('#bs'+id).val() !== '' ? parseInt($('#bs'+id).val()) : 0;
            
        var ns =  es + ma + ca + pa + bs;
        
        $('#ns'+id).val(Math.floor(ns - ds).toFixed(2));
       
    }
    function add_Salary() {
        
        var department_id = $('#mdepart_id option:selected').val();
        var month_id = $('#msalary_month_id option:selected').val();
        var year_id = $('#msalary_year_id').val();
            var TableData;
            TableData = storeFeeTblValues()
            if (TableData.length > 0) {
               imageOverlay('#salarytable', 'show');
                toastr["info"]("Please wait..", "Processing");
                $.ajax({
                    type: "POST",
                    url: "<?php echo $this->Url->build(['controller' => 'EmployeeSalary', 'action' => 'addSalaries']); ?>",
                    dataType: 'json',
                    data: {salaries: TableData,department_id:department_id,month_id:month_id,year_id:year_id},
                    success: function (data) {
                        imageOverlay('#salarytable', 'hide'); 
                        var result = data.msg.split("|");
                        if (result[0] === "Success") {
                           
                            toastr.success(result[0], result[1]);
                        } else {
                            toastr.warning(result[0], result[1]);
                        }
                    }
                });
            } else {
                toastr["warning"]("Nothing Added", "Record");
            }

    } 
    function storeFeeTblValues(){
        var TableData = new Array();

        $('#salarytable tr').each(function (row, tr) {
            TableData[row] = {
                "emp_id": $(tr).find('td:eq(0)').text()
                , "bs": $(tr).find('td:eq(3)>input').val()
                , "wd": $(tr).find('td:eq(4)>input').val()
                , "pds": $(tr).find('td:eq(5)>input').val()
                , "late": $(tr).find('td:eq(6)>input').val()
                , "ab": $(tr).find('td:eq(7)>input').val()
                , "es": $(tr).find('td:eq(8)>input').val()
                , "ma": $(tr).find('td:eq(9)>input').val()
                , "ca": $(tr).find('td:eq(10)>input').val()
                , "pa": $(tr).find('td:eq(11)>input').val()
                , "ds": $(tr).find('td:eq(12)>input').val()
                , "ns": $(tr).find('td:eq(13)>input').val()
                
            }
        });
        TableData.shift();  // first row will be empty - so remove

        return TableData;
    }

</script>