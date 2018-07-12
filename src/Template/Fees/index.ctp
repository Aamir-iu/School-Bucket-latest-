<style type="text/css">
    #result
    {
        position:absolute;
        width:600px;
        padding:10px;
        display:none;
        margin-top:30px;
        border-top:0px;
        max-height:320px;
        overflow-y:auto;
        border:1px #CCC solid;
        background-color: white;
        z-index : 1000;





    }
    .show
    {
        padding:10px; 
        border-bottom:1px #999 dashed;
        font-size:15px; 
        height:50px;


    }
    .show:hover
    {
        background:#4c66a4;
        color:#FFF;
        cursor:pointer;
    }


</style>
<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<?= $this->Html->css('../plugins/daterangepicker/daterangepicker.css') ?>  

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">

                    <h3 class="box-title">Fee Collection Record</h3>
                    <div class="btn-group pull-right">
                    <div class="row">   
                        <div class="col-xs-8">
                            <div class="box-tools">
                                        <div class="input-group">
                                            <form method="post" action="" id="search-form" class="form-horizontal">
                                            <table class="table table-responsive" cellpadding="3" cellspacing="3" width="100%">
                                            
                                            <tr>
<!--                                                <td><input class="form-control input-sm" name="from_date" id="from_date" type="text" value="" placeholder="From Date" style="width: 100px;" required></td>
                                                <td><input class="form-control input-sm" name="to_date" id="to_date" type="text" value="" placeholder="To Date" style="width: 100px;" required></td>-->
                                                <td><input class="form-control input-sm" name="inv_no" id="inv_no" type="text" value="" placeholder="Invoice No." style="width: 80px;" required></td>
                                            	<td><input class="form-control input-sm" name="reg_id" id="reg_id" type="text" value="" placeholder="Reg. ID" style="width: 80px;" required></td>
<!--                                                <td><input class="form-control input-sm" name="fmc" id="fmc" type="text" value="" placeholder="Family Code" style="width: 130px;" required></td>-->
                                            	
                                                <td>
                                                <input type="text" class="form-control input-sm" name="search_st" id="search_st" placeholder="LastName" style="width: 100px;">
                                                </td>
                                                
                                                <td>
                                                    <select name="status" id="status" class="form-control input-sm" style="width: 100px;">
                                                        <option value="1">Active</option>
                                                        <option value="0">Cancelled</option>
                                                    </select>
                                                </td>
                                                
                                                
                                                <td>
                                                    <button class="btn btn-sm btn-primary" name="btnSearch" id="btnSearch" onclick="search_record();" type="button" data-toggle="tooltip" title="Filter Records"><i class="fa fa-search"></i> Search </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success" name="btnSearch" id="btnSearch" onclick="loadmodal();" type="button" data-toggle="tooltip" title="Add New Invoice"><i class="fa fa-plus"></i> Add </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-warning" name="btnSearch" id="btnSearch" onclick="cashRegister();" type="button" data-toggle="tooltip" title="Cash Register"><i class="fa fa-dollar"></i> CR </button>
                                                </td>
                                                
                                                <td>
                                                    <button class="btn btn-sm btn-default" name="btnSearch" id="btnSearch" onclick="Add_Multiple();" type="button" data-toggle="tooltip" title="Add Multiple Invoices"><i class="fa fa-plus"></i> Add Multiple</button>
                                                    
                                                </td>
                                            </tr>
                                            </table>
                                            </form>
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
                            <tr role="row" class="heading">
                                <th width="10%">Invoice#</th>
                                <th width="5%">Reg.ID</th>
                                <th width="14%">Student's Name</th>
                                <th width="14%">Father's Name</th>
                                
                                <th width="8%">Month</th>
                                <th width="8%">Fee Type</th>
                                
                                <th width="8%">Amount</th>
                                <th width="8%">Status</th>
                                <th width="10%">User Name</th>
                                <th width="15%">Actions</th
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
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->


<!-- BEGIN EDIT SUB ACCOUNT MODAL FORM-->
<div class="modal fade" id="add-fee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:90%!important;">
        <div class="modal-content">
            <div class="modal-header" style="margin-bottom: 10px;height: 70px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <div class="box-header">
                    <form method="post" action="" id="searchstudentbyname">
                        <div class="input-group input-group-sm" style="width: 600px;margin-bottom: 28px;">

                            <input type="text"  class="form-control search numbers"  id="searchid"   placeholder="Search for Students">

                            <div id="result"></div>

                            <div class="input-group-btn">
                                <button type="submit"  class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
     
                    <div class="box-tools">
                        <form method="post" action="" id="searchstudent">
                            <div class="input-group input-group-sm" style="width: 200px;">
                                <input type="text"  name="search" id="search" class="form-control pull-right" placeholder="Search">
                                <div class="input-group-btn">
                                    <button type="submit"  class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>  
                    </div>
                  
                </div>

            </div>

            <!-- Main content -->
            <section class="content" style='padding: 0px 15px;'>
                <input type="text"  name="inquiry_id" hidden value="<?php if (!empty($inquiry)) { echo $inquiry[0]['id_inquery'];} ?>">   
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="box box-primary">
                            <div class="box-body box-profile">
                                <a href="#"><?php echo $this->Html->image('students_images/avatar-1.jpg', ['alt' => 'user Picture', 'class' => 'profile-user-img img-responsive img-circle', 'id' => 'blah']); ?></a>
                               

                                <h3 class="profile-username text-center"></h3>
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b id="sname"></b> <a class="pull-right"></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b id="fname"></b> <a class="pull-right"></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b id="cname"></b> <a class="pull-right"></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b id="shname"></b> <a class="pull-right"></a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#feedetails" data-toggle="tab">Payable Fees Details</a></li>
                                <li><a href="#paiddetails" data-toggle="tab">Paid Fees History</a></li>
                                
                                <li class=""><a href="#otherdetails" data-toggle="tab">Generate Fee</a></li>
                                
                            </ul>
                            <div class="form-body form-horizontal form-bordered form-row-stripped">
                                <fieldset
                                    <div class="tab-content">

                                        <div class="active tab-pane" id="feedetails" style="margin-bottom: 5px;">
                                            <div class="modal-body" style="padding: 0px;">
                                                <div class="row">
                                                    <div class="col-xs-12">

                                                        <form class="form-inline">
                                                           

                                                            <input type="text"  class="form-control hidden" id="cid" value="">
                                                            <input type="text" class="form-control hidden" id="sid" value="">
                                                            <input type="text" class="form-control hidden" id="ssid" value="">
                                                            <input type="text" class="form-control hidden" id="cmid" value="">
                                                            <input type="text" class="form-control hidden" id="sms" value="">
                                                            <input type="text" class="form-control hidden" id="email" value="">
                                                             <input type="text" class="form-control hidden" id="invno" value="">
                                                            
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
                                                                <table id="feetable"  class="table table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Voucher#</th>
                                                                            <th>Month</th>
                                                                            <th>Year</th>
                                                                            <th>Fee Type</th>
                                                                            <th>Due Date</th>
                                                                            <th>Fee Amount</th>
                                                                            <th>Fine Amount</th>
                                                                            <th>Sub Total</th>
                                                                            <th>Paid Now</th>

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

                                                <div class="pull-right" style="margin-right:0px!important;"> 
                                                    <form class="form-inline">


                                                        <div class="form-group">
                                                            <label class="sr-only" for="payable">Amount (in dollars)</label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon" style="width:80px;">Payable</div>
                                                                <input type="text" class="form-control" readonly id="payable" value="" placeholder="payable"  style="width:80px;">
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="sr-only" for="gtotal">Amount (in dollars)</label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon" style="width:130px;">Grand Total</div>
                                                                <input type="text"  class="form-control numbers" readonly id="gtotal" value="250" placeholder="Grand Total" style="width:90px;">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="sr-only" for="receivedamount">Amount (in dollars)</label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon" style="width:160px;">Received</div>
                                                                <input type="text" onkeyup="calculation();" readonly class="form-control" id="receivedamount" required value="500" placeholder="Received" style="width:90px;">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="sr-only" for="returnedamoount">Amount (in dollars)</label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon" style="width:160px;">Returned</div>
                                                                <input type="text" class="form-control" readonly id="returnedamoount" value="250" placeholder="Returned" style="width:110px;">
                                                            </div>
                                                        </div>


                                                    </form>
                                                </div>
                                                <br />
                                                <br />
                                                <div class="form-group">
                                                    <label>
                                                        <input type="checkbox" value="" id="sendsms" class="minimal-red" checked>
                                                    </label>
                                                    Send SMS
                                                    </label>
                                                    <label>
                                                        <input type="checkbox" value class="minimal-red" unchecked>
                                                    </label>
                                                    Send Email
                                                    </label>
                                                </div>
                                                <button id="printbt" style="display:none;" readonly type="button" class="btn btn-icon waves-effect waves-light btn-success m-b-5">Print</button>
                                                <button id="savebd" onclick="add_fees();" readonly type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Save</button>
                                                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
                                            </div>



                                            <div class="post clearfix">
                                            </div>
                                            <!-- /.post -->
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="paiddetails">
                                          <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="box">

                                                            <!-- /.box-header -->
                                                            <div class="box-body table-responsive no-padding">
                                                                <table id="paidhistory"  class="table table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Invoice#</th>
                                                                            <th>Month</th>
                                                                            <th>Year</th>
                                                                            <th>Fee Type</th>
                                                                            <th>Fee Date</th>
                                                                            <th>Paid Amount</th>
                   
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

                                        </div>
                                        <!-- /.tab-pane -->

                                        <div class="tab-pane" id="otherdetails">
                                          <br />
                                          <div class="form-body form-horizontal form-bordered form-row-stripped" id="add-student-form">        
                                            <div class="form-group">
                                                        <label for="inputName" class="col-sm-2 control-label">Fee Month:</label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group date">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                                <input type="text"  placeholder="Date of Admission" name="feemonth" value="<?php echo date('m').'/10/'.date('Y'); ?>" class="form-control pull-right" id="feemonth" value="<?php echo date("m/d/Y"); ?>">
                                                            </div>
                                                        </div>
                                            </div> 
                                              
<!--                                             <div class="form-group">
                                                        <label for="inputName" class="col-sm-2 control-label">Fee Amount:</label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group date">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-dollar"></i>
                                                                </div>
                                                                <input type="text"  placeholder="Fee Amount" name="feeamount" value="" class="form-control pull-right" id="feeamount" value="">
                                                            </div>
                                                        </div>
                                            </div>  
                                              -->
                                              
                                              
                                           <div class="form-group">
                                                <label for="class_id" class="col-sm-2 control-label">Fee Head</label>
                                                <div class="col-sm-9">
                                                    <select onchange="show_box();" class="form-control" id="feehead"  data-placeholder="Select Fee Head" style="width: 100%;">
                                                    <?php  foreach($feetype as $feetypes): ?>    
                                                       <option value="<?php  echo $feetypes->id_fee_type; ?>"><?php  echo $feetypes->fee_type_name; ?></option>
                                                    <?php endforeach; ?>    
                                                   </select>
                                                </div>
                                            </div>
                                              
                                            <div class="form-group" id="penality_amoun" style="display:none;">
                                                <label for="inputName" class="col-sm-2 control-label">Fee Amount:</label>
                                                <div class="col-sm-9">
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-dollar"></i>
                                                        </div>
                                                        <input type="text"  placeholder="Fee Amount" name="feeamount" value="0" class="form-control pull-right" id="feeamount" value="">
                                                    </div>
                                                </div>
                                            </div>
                                              
                                            <div class="form-group"> 
                                                <div class="col-sm-11">  
                                                <div class="pull-right" style="margin-right:0px!important;"> 
                                                <button onclick="generate_dues();" id="dg" readonly type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Generate</button>
                                                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
                                                </div>
                                                </div>   
                   
                                          </div> 
                                        </div>
                                        <!-- /.tab-pane -->
                                </fieldset>
                            </div>

                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
        </div>
            <!-- /.row -->
        <!-- /.content -->


    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- BEGIN INVOICE CANCEL MODAL FORM-->
<div class="modal fade " id="voucher_mod"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Please enter description of  cancelling invoice</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">


                    <div class="form-group">
                        <label class="control-label col-md-3">Description:</label> 
                        <div class="col-md-9">
                            <textarea class="form-control" rows="5" id="desc"></textarea>
                            <input id="inv"  type="hidden"/>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button onclick="deleteinvoice();" type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Save</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--Cash View Model-->
    <div class="modal fade none-border" id="cash_register_modal" tabindex="-1" role="dialog" aria-labelledby="Cash Register" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Cash Register For <span id="cashRegDate"><?php  echo date("d-M-Y"); ?></span></h4>
                
                <input type="hidden" id='dbformatdate'>
                
            </div>
            <div class="modal-body">
                
                <div class="row">
                    
                    <center><strong>Daily Cash Count</strong></center>
                    
                    <br>
                    
                    <div class="col-lg-6">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width: 100px;">Yesterday's Till Amount</td>
                                    <td colspan="2" style="width: 100px; padding-top: 20px;">
                                        Rs. <strong id="yesterday_till">0.00</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 100px;">Rs. 5000</td>
                                    <td style="width: 100px;"><input type="text" onblur="addZero($(this));" onfocus="removeZero($(this));" onkeyup="updateCashRegister($(this));" id="5000" value="0" class="form-control numeric input-sm"></td>
                                    <td>Rs. <span id="x5000">0.00</span></td>
                                </tr>
                                <tr>
                                    <td>Rs. 1000</td>
                                    <td><input type="text" onblur="addZero($(this));" onfocus="removeZero($(this));" onkeyup="updateCashRegister($(this));" id="1000" value="0" class="form-control numeric input-sm"></td>
                                    <td>Rs. <span id="x1000">0.00</span></td>
                                </tr>
                                <tr>
                                    <td>Rs. 500</td>
                                    <td><input type="text" onblur="addZero($(this));" onfocus="removeZero($(this));" onkeyup="updateCashRegister($(this));" id="500" value="0" class="form-control numeric input-sm"></td>
                                    <td>Rs. <span id="x500">0.00</span></td>
                                </tr>
                                <tr>
                                    <td>Rs. 100</td>
                                    <td><input type="text" onblur="addZero($(this));" onfocus="removeZero($(this));" onkeyup="updateCashRegister($(this));" id="100" value="0" class="form-control numeric input-sm"></td>
                                    <td>Rs. <span id="x100">0.00</span></td>
                                </tr>
                                <tr>
                                    <td>Rs. 50</td>
                                    <td><input type="text" onblur="addZero($(this));" onfocus="removeZero($(this));" onkeyup="updateCashRegister($(this));" id="50" value="0" class="form-control numeric input-sm"></td>
                                    <td>Rs. <span id="x50">0.00</span></td>
                                </tr>
                                <tr>
                                    <td>Rs. 20</td>
                                    <td><input type="text" onblur="addZero($(this));" onfocus="removeZero($(this));" onkeyup="updateCashRegister($(this));" id="20" value="0" class="form-control numeric input-sm"></td>
                                    <td>Rs. <span id="x20">0.00</span></td>
                                </tr>
                                <tr>
                                    <td>Rs. 10</td>
                                    <td><input type="text" onblur="addZero($(this));" onfocus="removeZero($(this));" onkeyup="updateCashRegister($(this));" id="10" value="0" class="form-control numeric input-sm"></td>
                                    <td>Rs. <span id="x10">0.00</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>Grand total</b></td>
                                    <td>Rs. <strong id="totalGrand">0.00</strong></td>
                                </tr>
                                <tr>
                                    <td>Tomorrow's Till Amount</td>
                                    <td colspan="2" style="padding-top: 13px;"><input style="width: 50%; font-weight: bold;" type="text" id="today_till" class="form-control numeric input-sm" placeholder="Rs. 0"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="col-lg-6">
                        <table class="table table-bordered" id="cash_register_1">
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="col-lg-12">
                        <div style="text-align: center;">
                            
                           <b>Difference:</b> Rs. <strong id="totalDifference"></strong> &nbsp &nbsp &nbsp &nbsp &nbsp
                           <b>Including Yesterday's Till: Rs. <span id="totalTillDifference"></span></b>
                        </div>
                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea class="form-control" id="cashRemarks"></textarea>
                        </div>
                    </div>
                    
                    <div class="col-lg-12">
                        <div style="text-align: right; margin-top: 10px;">
                            <a target="_blank" id="cashregister" href="javascript:void(0);" onclick="print_cashRegister(4);" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i> Print</a>
                            <button type="button" onclick="saveCashRegister();" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
</div>
 <!--END Cash View Model-->



<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>    
 <?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 

<?= $this->Html->script('datatable.js') ?>  
<script>
    
    function show_box(){
        var id = $('#feehead option:selected').val();
        if(id == '22'){
            $('#penality_amoun').fadeIn();
        }else{
            $('#penality_amoun').fadeOut();
        }
        
    }
    
    $(document).ready(function () {
       tabltint();
       $("#months").select2();
      //$("#feehead").select2();
      $("#class_id").select2();

    });
    $('#feemonth').datepicker({
         autoclose: true
    });
    $('#from_date').datepicker({
         autoclose: true
    });
    $('#to_date').datepicker({
         autoclose: true
    });
     
   
     
     
    $(function () {
        $("#userstable").DataTable();

    });
    function search_record(){
       tabltint();
     
    }
    var tabltint = function () {
        if($.fn.DataTable.isDataTable("#userstable")){ 
            $("#userstable").dataTable().fnDestroy();
         }
 
        var theTable = $('#userstable').DataTable({
           
                //"dom": '<"top"i>rt<"bottom"flp><"clear">',
                'bFilter': false,
                'responsive': true,
                'processing': true,
                'serverSide': true,
                "error": false,
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "stateSave": true,
                "ajax": {
                    type: "POST",
                    url: "<?php echo $this->Url->build(['controller' => 'Fees', 'action' => 'gtbysearch']); ?>",
                    dataType: 'json',
                    cache: false,
                    async: false,
                    "data": function ( d ) {
                        d.status = $('#status option:selected').val();
                        d.cc = $('#reg_id').val();
                        d.fmc = $('#fmc').val();
                        d.name = $('#search_st').val();
                        d.inv_no = $('#inv_no').val();
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                        
                    }
                },
                "oLanguage": {
                 "sProcessing": 'https://eschools.cloud/images/loading-spinner-grey.gif'
               },
                "columnDefs": [{ // define columns sorting options(by default all columns are sortable extept the first checkbox column)
                    'orderable': false,
                    'targets': [0]
                    
                }],
                    columnDefs : [
                        { targets : [7],
                          render : function (data, type, row) {
                             return data == '1' ? 'Active' : 'Cancelled'
                          }
                        }
                   ],
                "order": [
                    [1, "asc"]
                ], // set first column as a default sort by asc
                "columns": [
                        {"data": "inv_no"},
                        {"data": "reg_id"},
                        {"data": "name"},
                        {"data": "fname"},
                        {"data": "month_id"},
                        {"data": "type_id"},
                        {"data": "amount"},
                        {"data": "status"},
                        {"data": "user"},
                        {"data": "actions"},
                    ]
                    
        });
        
   }  
    
    function get_todays_fee() {

        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'Fees', 'action' => 'index']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {id: 0},
            success: function (data) {
                var mdata = data.data;
                var mhtml = "";
                $("#userstable tbody").html('');
                for (var x = 0; x < mdata.length; x++) {
                    mhtml += '<tr>';
                    mhtml += "<td>" + mdata[x]['id_fees'] + "</td>";
                    mhtml += "<td>" + mdata[x]['reg_id'] + "</td>";
                    mhtml += "<td>" + mdata[x]['name'] + "</td>";
                    mhtml += "<td>" + mdata[x]['fname'] + "</td>";
                    mhtml += "<td>" + mdata[x]['amount'] + "</td>";
                    mhtml += "<td>" + mdata[x]['actions'] + "</td>";
                    mhtml += '</tr>';
                }

                $("#userstable tbody").append(mhtml);
            }
        });
    }
    function loadmodal() {

        $("#stname").val('');
        $("#fname").val('');
        $("#class_name").val('');
        $("#search").val('');
        $("#payable").val('');
        $("#gtotal").val('');
        $("#receivedamount").val('');
        $("#returnedamoount").val('');

        $("#cid").val('');
        $("#sid").val('');
        $("#ssid").val('');
        $("#cmid").val('');

        $("#feetable tbody").html('');

        $('#add-fee').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }
    function add_fees() {
        
        var allgood = true;

        var gtotal = parseFloat($('#gtotal').val());
        var received = parseFloat($('#receivedamount').val()) + '.00';

        if (received < gtotal) {
            toastr["error"]("Received amount can not less then grand total.");
            allgood = false;
        }



        var flag = 0;
        $('#feetable tbody tr').each(function (row, tr) {
            var paid = $(tr).find('td:eq(10)>input').val() === "" ? 0 : $(tr).find('td:eq(10)>input').val();
            if (paid > 0) {
                flag = 1;
            }
        });

        if (flag == 0) {
            toastr["error"]("Please enter the amount in inputbox.");
            allgood = false;
        }

        $('#feetable tbody tr').each(function (row, tr) {

            var subtotal = $(tr).find('td:eq(9)').text() === "" ? 0 : $(tr).find('td:eq(9)').text();
            var paid = $(tr).find('td:eq(10)>input').val() === "" ? 0 : $(tr).find('td:eq(10)>input').val();
            if (parseFloat(paid) > parseFloat(subtotal)) {
                toastr["error"]("Sorry! Record could not saved,Please check entered data.");
                allgood = false;
            }
        });


        if (allgood == true) {
            var TableData;
            TableData = storeFeeTblValues()
            var reg_id = $('#search').val();
            var gtoal = $('#gtotal').val();
            var rcamount = $('#receivedamount').val();
            var reamount = $('#returnedamoount').val();
            var class_id = $('#cid').val();
            var shift_id = $('#sid').val();
            var session_id = $('#ssid').val();
            var campus_id = $('#cmid').val();
            var name = $('#sname').val();
            var cont = $('#sms').val();
            var sendsms = "No";
            if ($("#sendsms").prop('checked')) {
                sendsms = "Yes";
            }

            if (TableData.length > 0) {
               imageOverlay('#feetable', 'show');
                toastr["info"]("Generating New Invoice", "Processing");
                $('#savebd').attr('disabled',true);
                $.ajax({
                    type: "POST",
                    url: "<?php echo $this->Url->build(['controller' => 'Fees', 'action' => 'paidfees']); ?>",
                    dataType: 'json',
                    data: {fees: TableData, rid: reg_id
                        , gt: gtoal
                        , rca: rcamount
                        , rea: reamount
                        , name: name
                        , classid: class_id, shiftid: shift_id, sessionid: session_id, campusid: campus_id, cell: cont, sms: sendsms},
                    success: function (data) {
                        var result = data.msg.split("|");
                        var inv = data.invoice_number;
                        if (result[0] === "Success") {
                            imageOverlay('#feetable', 'hide');
                            toastr.success(result[0], result[1]);
                          //  $('#add-fee').modal('hide');
                          //  location.reload();
                           var func = 'print_invoice('+1+','+inv+')';
                           $('#printbt').attr('onClick',func);
                            
                            $('#printbt').fadeIn();
                            $('#savebd').hide();
                            $('#payable').val('0.00');
                            $('#gtotal').val('0.00');
                            $('#receivedamount').val('0.00');
                            $('#returnedamoount').val('0.00');
                            
                            
                            get_student_fees_record_after_fee_submit();
                            
                        } else {
                            toastr.warning(result[0], result[1]);
                        }
                    }
                });
            } else {
                toastr["warning"]("Nothing Added", "Fee Record");
            }
        } else {
            //toastr["warning"]("Sorry! Record could not saved,Please check entered data.");

        }
      
    }
    function storeFeeTblValues(){
        var TableData = new Array();

        $('#feetable tr').each(function (row, tr) {
            TableData[row] = {
                "voucher": $(tr).find('td:eq(0)').text()
                , "month": $(tr).find('td:eq(1)').text()
                , "year": $(tr).find('td:eq(3)').text()
                , "fee_type": $(tr).find('td:eq(4)').text()
                , "due_date": $(tr).find('td:eq(7)').text()
                , "subtotal": $(tr).find('td:eq(9)').text()
                , "piadamount": $(tr).find('td:eq(10)>input').val()
                , "se_id": $(tr).find('td:eq(11)').text()
            }
        });
        TableData.shift();  // first row will be empty - so remove

        return TableData;
    }
   
    
    function paid_fee_history(id) {
       imageOverlay('#paidhistory', 'show');
       $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'Fees', 'action' => 'piadfeehistory']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {reg_id: id},
            success: function (data) {
                var mdata = data.ph;
                var mhtml = "";
                $("#paidhistory tbody").html('');
                if(mdata.length > 0){
                
                for (var x = 0; x < mdata.length; x++) {
                    mhtml += '<tr>';
                    mhtml += "<td>" + mdata[x]['inv_no'] + "</td>";
                    mhtml += "<td>" + mdata[x]['month'] + "</td>";
                    mhtml += "<td>" + mdata[x]['year'] + "</td>";
                    mhtml += "<td>" + mdata[x]['fee_type'] + "</td>";
                    mhtml += "<td>" + mdata[x]['f_date'] + "</td>";
                    mhtml += "<td>" + mdata[x]['amount'] + "</td>";
                   
                    mhtml += '</tr>';
                    
                }

                $("#paidhistory tbody").append(mhtml);
                }
            }
        });
        imageOverlay('#paidhistory', 'hide');
     }  
    function get_student_fees_record_after_fee_submit() {
        var id = $('#search').val();
        imageOverlay('#feetable', 'show');
        var paybale = 0;
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'Fees', 'action' => 'getstudentfee']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {reg_id: id},
            success: function (data) {
                var mdata = data.data;

                if (mdata.length > 0) {
                    $("#sname").text(mdata[0]['name']);
                    $("#fname").text(mdata[0]['fname']);
                    $("#cname").text(mdata[0]['class_name'] + ' | ' + mdata[0]['shift']);
                    $("#shname").text(mdata[0]['shift']);
                    $("#cid").val(mdata[0]['c_id']);
                    $("#sid").val(mdata[0]['s_id']);
                    $("#ssid").val(mdata[0]['se_id']);
                    $("#cmid").val(mdata[0]['campus']);
                    $("#sms").val(mdata[0]['num']);
                    $("#email").val(mdata[0]['email']);
                    var img = 'img/students_images/'+mdata[0]['pic'];
                    $('#blah').attr("src",img);
                    
                } 
                var mhtml = "";
                $("#feetable tbody").html('');
                imageOverlay('#feetable', 'hide');
                for (var x = 0; x < mdata.length; x++) {
                    mhtml += '<tr>';
                    mhtml += "<td>" + mdata[x]['id_dues'] + "</td>";
                    mhtml += "<td style='display:none;'>" + mdata[x]['m_id'] + "</td>";
                    mhtml += "<td>" + mdata[x]['month_id'] + "</td>";
                    mhtml += "<td>" + mdata[x]['year'] + "</td>";
                    mhtml += "<td style='display:none;'>" + mdata[x]['t_id'] + "</td>";
                    mhtml += "<td>" + mdata[x]['type_id'] + "</td>";
                    mhtml += "<td>" + mdata[x]['d_date'] + "</td>";
                    mhtml += "<td>" + mdata[x]['amount'] + "</td>";
                    mhtml += "<td>" + mdata[x]['fine_amount'] + "</td>";
                    var fine = parseFloat(mdata[x]['fine_amount']) * parseFloat(mdata[x]['days'])
                    mhtml += "<td>" + (parseFloat(mdata[x]['amount']) + fine) + "</td>";
                    mhtml += "<td><input type='number' class='form-control numbers' id='paid' onkeyup='calculateTotals();'  style='width:100px;'></td>";
                    mhtml += "<td style='display:none;'>" + mdata[x]['se_id'] + "</td>";
                    mhtml += '</tr>';
                    paybale += (parseFloat(mdata[x]['amount']) + parseFloat(mdata[x]['fine']));
                }

                $("#feetable tbody").append(mhtml);
                $('#payable').val(paybale.toFixed(2));
            }
        });
        paid_fee_history(id);
     } 
    function calculateTotals() {
        var gtotal = 0;
        var received = 0;
        $('#feetable tbody tr').each(function (row, tr) {
            var td = $(tr).find('td:eq(10)>input').val() === "" ? 0 : $(tr).find('td:eq(10)>input').val();
            gtotal = gtotal + parseFloat(td);
            received = received + parseFloat(td);
        });

        $('#gtotal').val(gtotal.toFixed(2));
        $('#receivedamount').val(received.toFixed(2));
        $('#printbt').hide();
        $('#savebd').fadeIn();
        $('#savebd').attr('disabled',false);
    }
    function calculation() {
        var returnned = 0;
        var gtotal = parseFloat($('#gtotal').val());
        var received = parseFloat($('#receivedamount').val());

        if (received > gtotal) {
            returnned = received - gtotal;
            $('#returnedamoount').val(parseFloat(returnned));
        } else {
            $('#returnedamoount').val(0);
        }

    }
    function print_invoice(flag, inv) {
      // toastr["error"]("Please wait,Generating Report!");
        window.open("<?php echo $this->Url->build(['controller' => 'Fees', 'action' => 'view']); ?>/" + flag + "/" + inv);
    }
    
    function print_cashRegister(flag) {

       // toastr["error"]("Please wait,Generating Report!");
        window.open("<?php echo $this->Url->build(['controller' => 'Fees', 'action' => 'view']); ?>/" + flag);

    }
    
    function Add_Multiple() {
      
        location.assign("<?php echo $this->Url->build(['controller' => 'Fees', 'action' => 'addMultipleFees']); ?>");

    }
    
    
    
    function generate_dues(){
        
        imageOverlay('#otherdetails', 'show'); 
        var reg_id = $('#search').val();
        if(reg_id == ''){
            imageOverlay('#otherdetails', 'hide');
            toastr.error("Please enter Student's ID");
            return false;
        }
        var feemonth = $('#feemonth').val();
        if(feemonth == ''){
            imageOverlay('#otherdetails', 'hide');
            toastr.error("Please select Fee Month");
            return false;
        }
        var ft = $('#feehead option:selected').val();
        
        
        var feeamount = $('#feeamount').val();
        if(ft != 22){
            if(feeamount == ''){
                imageOverlay('#otherdetails', 'hide');
                toastr.error("Please enter Fee Amount");
                return false;
            }
        }
        
        
        
        var class_id = $('#cid').val();
        var shift_id = $('#sid').val();
        var session_id = $('#ssid').val();
        var campus_id = $('#cmid').val();
        $('#dg').attr('disabled',true);
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'Fees', 'action' => 'generatedues']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {reg_id : reg_id,
                   class_id : class_id,
                   shift_id : shift_id,
                   session_id : session_id,
                   campus_id : campus_id,
                   feemonth : feemonth,
                   feeamount:feeamount,
                   ft : ft },
            success: function (data) {
                
                var result = data.msg.split("|");
               
               if (result[0] === "Success") {
                 ///  get_student_fees_record();
                 
                 get_student_fees_record_after_fee_submit();
                   toastr.success(result[0], result[1]);
                }else{
                   toastr.error(result[0], result[1]);
                }
               $('#dg').attr('disabled',false);  
              imageOverlay('#otherdetails', 'hide');
            }
        });
    }
    
    

</script>

<script type="text/javascript">
    $(document).ready(function () {
        
        
    $('#searchstudent').on('submit', function(){
         get_fee();
        return false;
    });    
        
    $('#searchstudentbyname').on('submit', function() {
        $("#result").html('').show();
        var searchid = $('.search').val();
        if (searchid != '')
        {
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'Fees', 'action' => 'livesearchstudent']); ?>",
                dataType: 'json',
                cache: false,
                async: false,
                data: {search: searchid},
                success: function (data) {
                    var mdata = data.data;
                    if (mdata.length > 0) {
                        $("#result").fadeIn();
                        for (var x = 0; x < mdata.length; x++) {
                            $("#result").append(mdata[x]).show();
                        }
                    }
                }
            });
        }
       return false;
     });
      
    });  

    function getID(id) {

        var id = $('#s' + id).text();
        $('#search').val(id);
        $("#result").fadeOut();
        get_fee();
      
    }

    $(document).mouseup(function (e) {

        var con = $("#result");
        if (!con.is(e.target)) {
            con.fadeOut();
        }
        if (con.is(e.target)) {
            con.fadeIn();
        }

    });

    function Cancel_Invoice(id) {

        $('#inv').val(id);
        $('#voucher_mod').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }


    function deleteinvoice() {

        var desc = $('#desc').val();
        var id = $('#inv').val();
        if (desc == '') {
            toastr["error"]("Please enter the descirption of cancelling the invoice.");
            return false;

        }


        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['action' => 'edit']); ?>",
            dataType: 'json',
            data: {desc: desc, inv_no: id},
            success: function (data) {
                var result = data.msg.split("|");

                if (result[0] === "Success") {
                    toastr.success(result[0], result[1]);
                    location.reload();
                } else {
                    toastr.warning(result[0], result[1]);
                }
            }
        });
    }

    function get_fee(){
      
        imageOverlay('#feetable', 'show'); 
        var id = $('#search').val();
        $('#printbt').hide();
        $('#savebd').fadeIn();
        $('#savebd').attr('disabled',false);
       
        var paybale = 0;
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'Fees', 'action' => 'getstudentfee']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {reg_id: id},
            success: function (data) {
                var mdata = data.data;
                var sdata = data.rs;
               if(sdata.length > 0){ 
                
                $("#sname").text(sdata[0]['name']);
                $("#fname").text(sdata[0]['fname']);
                $("#cname").text(sdata[0]['class_name']);
                $("#shname").text(sdata[0]['shift']);
                
                var img = 'img/students_images/'+sdata[0]['pic'];
                $('#blah').attr("src",img);
                 }
                if (mdata.length > 0) {
                    $("#sms").val(mdata[0]['num']);
                    $("#email").val(mdata[0]['email']);
                    $("#cid").val(mdata[0]['c_id']);
                    $("#sid").val(mdata[0]['s_id']);
                    $("#ssid").val(mdata[0]['se_id']);
                    $("#cmid").val(mdata[0]['campus']);

                } else {
                    $("#cid").val('');
                    $("#sid").val('');
                    $("#ssid").val('');
                    $("#cmid").val('');
                    $("#cmid").val('');
                    toastr["error"]("Sorry no records found!");
                }
                var mhtml = "";
                $("#feetable tbody").html('');
                imageOverlay('#feetable', 'hide');
                for (var x = 0; x < mdata.length; x++) {
                    mhtml += '<tr>';
                    mhtml += "<td>" + mdata[x]['id_dues'] + "</td>";
                    mhtml += "<td style='display:none;'>" + mdata[x]['m_id'] + "</td>";
                    mhtml += "<td>" + mdata[x]['month_id'] + "</td>";
                    mhtml += "<td>" + mdata[x]['year'] + "</td>";
                    mhtml += "<td style='display:none;'>" + mdata[x]['t_id'] + "</td>";
                    mhtml += "<td>" + mdata[x]['type_id'] + "</td>";
                    var is_due = mdata[x]['is_due'] == 'Y' ? 'badge bg-red-active' : '';
                    var due = mdata[x]['is_due'] == 'Y' ? 'Due' : '';
                    mhtml += "<td class='"+is_due+"'>" + mdata[x]['d_date'] + ' ' + due + "</td>";
                    mhtml += "<td>" + mdata[x]['amount'] + "</td>";
                    mhtml += "<td>" + mdata[x]['fine_amount'] + "</td>";
                    var fine = parseFloat(mdata[x]['fine_amount']) * parseFloat(mdata[x]['days'])
                    mhtml += "<td>" + (parseFloat(mdata[x]['amount']) + fine) + "</td>";
                    //mhtml += "<td>" + (parseFloat(mdata[x]['amount']) + parseFloat(mdata[x]['fine_amount'])) + "</td>";
                    mhtml += "<td><input type='number' class='form-control numeric'  id='paid' onkeyup='calculateTotals();'  style='width:100px;'></td>";
                    mhtml += "<td style='display:none;'>" + mdata[x]['se_id'] + "</td>";
                    mhtml += '</tr>';
                    paybale += (parseFloat(mdata[x]['amount']) + parseFloat(mdata[x]['fine_amount']));
                }

                $("#feetable tbody").append(mhtml);
                $('#payable').val(paybale.toFixed(2));
            }
        });
        paid_fee_history(id);
        return false;
    }

    function cashRegister(){
    
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'Fees', 'action' => 'cashregister']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {id: 0},
            success: function (data) {
                var mdata = data.data;
                var exp = data.expanse;
                var CR = data.cash_register;
                
                
                if(CR.lenght > 0){
                
                $('#yesterday_till').html(CR[0].till_amounts);
                $('#5000').val(CR[0].x5000);
                $('1000').val(CR[0].x1000);
                $('#500').val(CR[0].x500);
                $('#100').val(CR[0].x100);
                $('#50').val(CR[0].x50);
                $('#20').val(CR[0].x20);
                $('#10').val(CR[0].x10);
                
                }
                
                var mhtml = "";
                $("#cash_register_1 tbody").html('');
                var payments = 0;
                $.each(mdata, function(index,value){
                 //   console.log(value);
                    mhtml += '<tr>';
                    mhtml += "<td>" + index + "</td>";
                    mhtml += "<td>Rs." + value + "</td>";
                    mhtml += '</tr>';
                    payments = payments + value;
                    
               });
               mhtml += '<tr>';
               mhtml += "<td><b>Received Payments</b></td>"
               mhtml += "<td><b>Rs."+ payments +"</b></td>"
               mhtml += '</tr>';
               var expanse = 0;
               $.each(exp, function(index,value){
                  //  console.log(value);
                    mhtml += '<tr>';
                    mhtml += "<td>" + value.ta_name + "</td>";
                    mhtml += "<td>Rs." + value.amount + "</td>";
                    mhtml += '</tr>';
                    expanse = expanse + value.amount
                    
               });
             
               mhtml += '<tr>';
               mhtml += "<td><b>Expanse Payments</b></td>"
               mhtml += "<td><b>Rs."+ expanse +"</b></td>"
               mhtml += '</tr>';
               
               var amount = parseFloat(payments - expanse);
                 
               mhtml +=  '<tr>';
               mhtml +=  '<td class="text-success"><b>Cash In Hand</b> <small>(after Expenses)</small></td>';
               mhtml +=  "<td class='text-success'><b>Rs. <strong id='totalCash'>"+ amount +"</strong></b></td>";
               mhtml +=  '</tr>';

                $("#cash_register_1 tbody").append(mhtml);
                
                updateCashRegister();
                
            }
        });
    
    
        $('#cash_register_modal').modal({
            backdrop:'static',
            keyboard:false,
            show:true
        });
    }
    
    
    function updateCashRegister(click){
        
        if(click.val() === ""){
            return false;
        }
        
        var x5000 = parseInt($('#5000').val()) * parseInt($('#5000').attr('id'));
        $('#x5000').html(parseFloat(x5000).toFixed(2));
        var x1000 = parseInt($('#1000').val()) * parseInt($('#1000').attr('id'));
        $('#x1000').html(parseFloat(x1000).toFixed(2));
        var x500 = parseInt($('#500').val()) * parseInt($('#500').attr('id'));
        $('#x500').html(parseFloat(x500).toFixed(2));
        var x100 = parseInt($('#100').val()) * parseInt($('#100').attr('id'));
        $('#x100').html(parseFloat(x100).toFixed(2));
        var x50 = parseInt($('#50').val()) * parseInt($('#50').attr('id'));
        $('#x50').html(parseFloat(x50).toFixed(2));
        var x20 = parseInt($('#20').val()) * parseInt($('#20').attr('id'));
        $('#x20').html(parseFloat(x20).toFixed(2));
        var x10 = parseInt($('#10').val()) * parseInt($('#10').attr('id'));
        $('#x10').html(parseFloat(x10).toFixed(2));
        
//        var total_sum = x5000 + x1000 + x500 + x100 + x50 + x20 + x10 + parseInt($('#yesterday_till').text());
        var total_sum = x5000 + x1000 + x500 + x100 + x50 + x20 + x10;
        
        $('#totalGrand').html(parseFloat(total_sum).toFixed(2));
        
        var totalGrand = parseInt($('#totalGrand').html());
        var totalCash = parseInt($('#totalCash').html());
        var totalDifference = totalGrand - totalCash;
        var totalTillDifference = totalGrand - (totalCash + parseInt($('#yesterday_till').text()));
        
        if(totalDifference === 0){
            $('#totalDifference').css('color', '#797979');
            $('#totalDifference').html(parseFloat(totalDifference).toFixed(2));
            
        } else if(totalDifference > 0){
            $('#totalDifference').css('color', 'green');
            $('#totalDifference').html(parseFloat(totalDifference).toFixed(2));
        } else{
            $('#totalDifference').css('color', 'red');
            $('#totalDifference').html(parseFloat(totalDifference).toFixed(2));
        }
        
        if(totalTillDifference === 0){
            $('#totalTillDifference').css('color', '#797979');
            $('#totalTillDifference').html(parseFloat(totalTillDifference).toFixed(2));
            
        } else if(totalTillDifference > 0){
            $('#totalTillDifference').css('color', 'green');
            $('#totalTillDifference').html(parseFloat(totalTillDifference).toFixed(2));
        } else{
            $('#totalTillDifference').css('color', 'red');
            $('#totalTillDifference').html(parseFloat(totalTillDifference).toFixed(2));
        }
        
        
    }

    function removeZero(click){
        if(click.val() === "0"){
            click.val('');
        }
    }
    
    function addZero(click){
        if(click.val() === ""){
            click.val('0');
        }
    }
    
    
    function saveCashRegister(){
        
       // var moment = $('#calendar').fullCalendar('getDate');
      //  var calendar_date = moment.format('YYYY-MM-DD');
        
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'Fees', 'action' => 'updateCashRegister']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {
                x5000 : $('#5000').val(),
                x1000 : $('#1000').val(),
                x500 : $('#500').val(),
                x100 : $('#100').val(),
                x50 : $('#50').val(),
                x20 : $('#20').val(),
                x10 : $('#10').val(),
                totalDifference: $('#totalDifference').html(),
                daily_expense: $('#totalExpenses').html(),
                remarks : $('#cashRemarks').val(),
                till: $('#today_till').val(),
               // calendar_date: calendar_date
            },
            success: function(data){
                var result = data.msg.split("|");
                if (result[0] === "Success") {
                    toastr.success('Cash register saved!', 'Done!');
                   // $('#cashregister').attr('href', 'https://www.mexyon.net/salonspk/cashregister/'+calendar_date);
                  //  $('#cashregister').fadeIn();
                } else{
                    swal({
                        title: "Not Allowed!",
                        text: 'You CANNOT UPDATE A PREVIOUS DAY CASH REGISTER ENTRY!',
                        type: "error",
                        confirmButtonText: 'OK!'
                    });
                  //  $('#cashregister').attr('href', 'javascript:void(0);');
                }
            }
        });
        
    }
    
    function updateCashRegister(click){
        
        if(click.val() === ""){
            return false;
        }
        
        var x5000 = parseInt($('#5000').val()) * parseInt($('#5000').attr('id'));
        $('#x5000').html(parseFloat(x5000).toFixed(2));
        var x1000 = parseInt($('#1000').val()) * parseInt($('#1000').attr('id'));
        $('#x1000').html(parseFloat(x1000).toFixed(2));
        var x500 = parseInt($('#500').val()) * parseInt($('#500').attr('id'));
        $('#x500').html(parseFloat(x500).toFixed(2));
        var x100 = parseInt($('#100').val()) * parseInt($('#100').attr('id'));
        $('#x100').html(parseFloat(x100).toFixed(2));
        var x50 = parseInt($('#50').val()) * parseInt($('#50').attr('id'));
        $('#x50').html(parseFloat(x50).toFixed(2));
        var x20 = parseInt($('#20').val()) * parseInt($('#20').attr('id'));
        $('#x20').html(parseFloat(x20).toFixed(2));
        var x10 = parseInt($('#10').val()) * parseInt($('#10').attr('id'));
        $('#x10').html(parseFloat(x10).toFixed(2));
        
//        var total_sum = x5000 + x1000 + x500 + x100 + x50 + x20 + x10 + parseInt($('#yesterday_till').text());
        var total_sum = x5000 + x1000 + x500 + x100 + x50 + x20 + x10;
        
        $('#totalGrand').html(parseFloat(total_sum).toFixed(2));
        
        var totalGrand = parseInt($('#totalGrand').html());
        var totalCash = parseInt($('#totalCash').html());
        var totalDifference = totalGrand - totalCash;
        var totalTillDifference = totalGrand - (totalCash + parseInt($('#yesterday_till').text()));
        
        if(totalDifference === 0){
            $('#totalDifference').css('color', '#797979');
            $('#totalDifference').html(parseFloat(totalDifference).toFixed(2));
            
        } else if(totalDifference > 0){
            $('#totalDifference').css('color', 'green');
            $('#totalDifference').html(parseFloat(totalDifference).toFixed(2));
        } else{
            $('#totalDifference').css('color', 'red');
            $('#totalDifference').html(parseFloat(totalDifference).toFixed(2));
        }
        
        if(totalTillDifference === 0){
            $('#totalTillDifference').css('color', '#797979');
            $('#totalTillDifference').html(parseFloat(totalTillDifference).toFixed(2));
            
        } else if(totalTillDifference > 0){
            $('#totalTillDifference').css('color', 'green');
            $('#totalTillDifference').html(parseFloat(totalTillDifference).toFixed(2));
        } else{
            $('#totalTillDifference').css('color', 'red');
            $('#totalTillDifference').html(parseFloat(totalTillDifference).toFixed(2));
        }
        
        
    }

    
    
</script>
