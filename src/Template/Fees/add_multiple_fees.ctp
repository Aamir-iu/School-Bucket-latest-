<style type="text/css" media="print">
    @page { 
        size: landscape;
    }

</style>
<?php
     function url(){
      
        $currentPath = $_SERVER['PHP_SELF']; 
        $pathInfo = pathinfo($currentPath); 
        $hostName = $_SERVER['HTTP_HOST']; 
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
        return $protocol.$hostName.$pathInfo['dirname']."/";
    }
?>
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
<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                
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
       
            <!-- Main content -->
            <section class="content" style='padding: 0px 15px;'>
                <input type="text"  name="inquiry_id" hidden value="<?php if (!empty($inquiry)) { echo $inquiry[0]['id_inquery'];} ?>">   
                <div class="row">
                    <div class="col-md-2">

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
                    <div class="col-md-10">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#feedetails" data-toggle="tab">Payable Fees Details</a></li>
                                <li><a href="#paiddetails" onclick="paid_fee_history();" data-toggle="tab">Paid Fees History</a></li>
                                
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
                                                                            <th>Action</th>

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
                                                        <input type="text"  placeholder="Fee Amount" name="feeamount" value="" class="form-control pull-right" id="feeamount" value="">
                                                    </div>
                                                </div>
                                            </div>  
                                              
                                           
                                              
                                              <div class="form-group"> 
                                                <div class="col-sm-11">  
                                                <div class="pull-right" style="margin-right:0px!important;"> 
                                                <button onclick="generate_dues();" id="dg" readonly type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Generate</button>
                                                
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
                
                    
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">

                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table id="paid_feetable"  class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID#</th>
                                        <th>Name</th>
                                        <th>F/Name</th>
                                        <th>Fee Month</th>
                                        <th>Fee Type</th>
                                        <th>Amount</th>
                                        <th>Action</th>
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
                    
            <div class="modal-footer">

                <div class="pull-right" style="margin-right:0px!important;"> 
                    <form class="form-inline">


<!--                        <div class="form-group">
                            <label class="sr-only" for="payable">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon" style="width:80px;">Payable</div>
                                <input type="text" class="form-control" readonly id="payable" value="" placeholder="payable"  style="width:80px;">
                            </div>
                        </div>-->


                        <div class="form-group">
                            <label class="sr-only" for="gtotal">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon" style="width:130px;">Grand Total</div>
                                <input type="text"  class="form-control numbers" readonly id="gtotal" value="" placeholder="Grand Total" style="width:90px;">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="sr-only" for="receivedamount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon" style="width:160px;">Received</div>
                                <input type="text" onkeyup="calculation();" readonly class="form-control" id="receivedamount" required value="" placeholder="Received" style="width:90px;">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="sr-only" for="returnedamoount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon" style="width:160px;">Returned</div>
                                <input type="text" class="form-control" readonly id="returnedamoount" value="" placeholder="Returned" style="width:110px;">
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
                    
            </div>
            <!-- /.row -->
        
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

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
      $("#months").select2();
      $("#feehead").select2();
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
                var img = '<?php echo url()."img/students_images/"; ?>'+sdata[0]['pic'];
               // var img = '/img/students_images/'+sdata[0]['pic'];
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
                    mhtml += "<td id='idDues"+ mdata[x]['id_dues'] +"'>" + mdata[x]['id_dues'] + "</td>";
                    mhtml += "<td id='idMonth"+ mdata[x]['id_dues'] +"' style='display:none;'>" + mdata[x]['m_id'] + "</td>";
                    mhtml += "<td id='monthName"+ mdata[x]['id_dues'] +"'>" + mdata[x]['month_id'] + "</td>";
                    mhtml += "<td id='idYear"+ mdata[x]['id_dues'] +"'>" + mdata[x]['year'] + "</td>";
                    mhtml += "<td id='idFeeType"+ mdata[x]['id_dues'] +"' style='display:none;'>" + mdata[x]['t_id'] + "</td>";
                    mhtml += "<td id='feeTypeNAme"+ mdata[x]['id_dues'] +"'>" + mdata[x]['type_id'] + "</td>";
                    var is_due = mdata[x]['is_due'] == 'Y' ? 'badge bg-red-active' : '';
                    var due = mdata[x]['is_due'] == 'Y' ? 'Due' : '';
                    mhtml += "<td id='dd"+ mdata[x]['id_dues'] +"' class='"+is_due+"'>" + mdata[x]['d_date'] + ' ' + due + "</td>";
                    mhtml += "<td>" + mdata[x]['amount'] + "</td>";
                    mhtml += "<td>" + mdata[x]['fine_amount'] + "</td>";
                    var fine = parseFloat(mdata[x]['fine_amount']) * parseFloat(mdata[x]['days'])
                    mhtml += "<td id='idSubTotal"+ mdata[x]['id_dues'] +"'>" + (parseFloat(mdata[x]['amount']) + fine) + "</td>";
               
                    mhtml += "<td id='totalAmount"+ mdata[x]['id_dues'] +"'><input type='number' class='form-control numeric' value='"+ (parseFloat(mdata[x]['amount']) + fine) +"'   style='width:100px;'></td>";
                    mhtml += "<td><button id='id_addButton' onclick='addtolist("+mdata[x]['id_dues']+");'  type='button' class='btn btn-icon waves-effect waves-light btn-info m-b-5 fa fa-plus'> add</button></td>";
                    mhtml += "<td id='idSession"+ mdata[x]['id_dues'] +"' style='display:none;'>" + mdata[x]['se_id'] + "</td>";
                    mhtml += '</tr>';
                    
                    paybale += (parseFloat(mdata[x]['amount']) + parseFloat(fine));
                }

                $("#feetable tbody").append(mhtml);
                //$('#payable').val(paybale.toFixed(2));
            }
        });
       // paid_fee_history(id);
        return false;
    }

   
    function addtolist(id){
       
        var exists = 0;
        $('#paid_feetable').find("td.id").each(function(index) {
                if ($(this).html() == id) {
                    exists = 1;
                }
        });
        
        var mhtml = "";
        if (exists == 0) {
            mhtml+="<tr><td class='id' style='display:none;'>" + id + "</td>";
            mhtml+="<td>" + $('#search').val() + "</td>";
            mhtml+="<td>" + $('#sname').text() + "</td>";
            mhtml+="<td>" + $('#fname').text() + "</td>";
            
            mhtml+="<td style='display:none;'>" + $('#idMonth'+id).text() + "</td>";
            mhtml+="<td>" +  $('#monthName'+id).text() + '-' + $('#idYear'+id).text()+ "</td>";
            mhtml+="<td style='display:none;'>" + $('#idFeeType'+id).text() + "</td>";
            mhtml+="<td>" +  $('#feeTypeNAme'+id).text() + "</td>";
            mhtml+="<td style='display:none;'>" +  $('#idSubTotal'+id).text() + "</td>";
            mhtml+="<td>" +  $('#totalAmount'+id+ '>input').val() + "</td>"; 
            
            mhtml+="<td style='display:none;'>" +  $('#cid').val() + "</td>"; 
            mhtml+="<td style='display:none;'>" +  $('#sid').val() + "</td>";
            mhtml+="<td style='display:none;'>" +  $('#idSession'+id).text() + "</td>";
            mhtml+="<td style='display:none;'>" +  $('#idYear'+id).text() + "</td>";
            mhtml+="<td style='display:none;'>" +  $('#dd'+id).text() + "</td>";
            
            mhtml+="<td><button onclick='removefromlist(" + id + ");' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button></td>";
            mhtml+="</tr>";
            $("#paid_feetable tbody").append(mhtml);
           
        } else {
            toastr["error"]("The fee is already added. To change Type,Month, first remove, then add again!","ALREADY ADDED") ;
        }
        calculateTotals();
    }
   
    function removefromlist(val){
        $('#paid_feetable').find("td.id").each(function(index) {
            if ($(this).html() == val) {
                $(this).closest('tr').remove();
            }
        });
        calculateTotals();
    }
    
    
    function calculateTotals() {
        var gtotal = 0;
        var received = 0;
        $('#paid_feetable tbody tr').each(function (row, tr) {
            var td = $(tr).find('td:eq(9)').text() === "" ? 0 : $(tr).find('td:eq(9)').text();
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
    
    
     function add_fees() {
        
        var allgood = true;

        var gtotal = parseFloat($('#gtotal').val());
        var received = parseFloat($('#receivedamount').val()) + '.00';

        if (received < gtotal) {
            toastr["error"]("Received amount can not less then grand total.");
            allgood = false;
        }


        $('#paid_feetable tbody tr').each(function (row, tr) {

            var subtotal = $(tr).find('td:eq(8)').text() === "" ? 0 : $(tr).find('td:eq(8)').text();
            var paid = $(tr).find('td:eq(9)').text() === "" ? 0 : $(tr).find('td:eq(9)').text();
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
               imageOverlay('#paid_feetable', 'show');
                toastr["info"]("Generating New Invoice", "Processing");
                $('#savebd').attr('disabled',true);
                $.ajax({
                    type: "POST",
                    url: "<?php echo $this->Url->build(['controller' => 'Fees', 'action' => 'paidMultiple']); ?>",
                    dataType: 'json',
                    data: {fees: TableData, rid: reg_id
                        , gt: gtoal
                        , rca: rcamount
                        , rea: reamount
                        , name: name
                        , campusid: campus_id, cell: cont, sms: sendsms},
                    success: function (data) {
                        var result = data.msg.split("|");
                        var inv = data.invoice_number;
                        if (result[0] === "Success") {
                            imageOverlay('#paid_feetable', 'hide');
                            toastr.success(result[0], result[1]);
                          //  $('#add-fee').modal('hide');
                          //  location.reload();
                           var func = 'print_invoice('+0+','+inv+')';
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

        $('#paid_feetable tr').each(function (row, tr) {
            TableData[row] = {
                "voucher": $(tr).find('td:eq(0)').text()
                , "cc": $(tr).find('td:eq(1)').text()
                , "fee_month": $(tr).find('td:eq(4)').text()
                , "fee_type": $(tr).find('td:eq(6)').text()
                , "subtotal": $(tr).find('td:eq(8)').text()
                , "piadamount": $(tr).find('td:eq(9)').text()
                , "class_id": $(tr).find('td:eq(10)').text()
                , "shift_id": $(tr).find('td:eq(11)').text()
                , "session_id": $(tr).find('td:eq(12)').text()
                , "year": $(tr).find('td:eq(13)').text()
                , "due_date": $(tr).find('td:eq(14)').text()
            }
        });
        TableData.shift();  // first row will be empty - so remove

        return TableData;
    }
    
    function paid_fee_history() {
       var id = $('#search').val(); 
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
                    //var img = 'img/students_images/'+mdata[0]['pic'];
                    var img = '<?php echo url()."img/students_images/"; ?>'+mdata[0]['pic'];
                    $('#blah').attr("src",img);
                    
                } 
                var mhtml = "";
                $("#feetable tbody").html('');
                imageOverlay('#feetable', 'hide');
                for (var x = 0; x < mdata.length; x++) {
                    mhtml += '<tr>';
                    mhtml += "<td id='idDues"+ mdata[x]['id_dues'] +"'>" + mdata[x]['id_dues'] + "</td>";
                    mhtml += "<td id='idMonth"+ mdata[x]['id_dues'] +"' style='display:none;'>" + mdata[x]['m_id'] + "</td>";
                    mhtml += "<td id='monthName"+ mdata[x]['id_dues'] +"'>" + mdata[x]['month_id'] + "</td>";
                    mhtml += "<td id='idYear"+ mdata[x]['id_dues'] +"'>" + mdata[x]['year'] + "</td>";
                    mhtml += "<td id='idFeeType"+ mdata[x]['id_dues'] +"' style='display:none;'>" + mdata[x]['t_id'] + "</td>";
                    mhtml += "<td id='feeTypeNAme"+ mdata[x]['id_dues'] +"'>" + mdata[x]['type_id'] + "</td>";
                    var is_due = mdata[x]['is_due'] == 'Y' ? 'badge bg-red-active' : '';
                    var due = mdata[x]['is_due'] == 'Y' ? 'Due' : '';
                    mhtml += "<td id='dd"+ mdata[x]['id_dues'] +"' class='"+is_due+"'>" + mdata[x]['d_date'] + ' ' + due + "</td>";
                    mhtml += "<td>" + mdata[x]['amount'] + "</td>";
                    mhtml += "<td>" + mdata[x]['fine_amount'] + "</td>";
                    var fine = parseFloat(mdata[x]['fine_amount']) * parseFloat(mdata[x]['days'])
                    mhtml += "<td id='idSubTotal"+ mdata[x]['id_dues'] +"'>" + (parseFloat(mdata[x]['amount']) + fine) + "</td>";
               
                    mhtml += "<td id='totalAmount"+ mdata[x]['id_dues'] +"'><input type='number' class='form-control numeric' value='"+ (parseFloat(mdata[x]['amount']) + fine) +"'   style='width:100px;'></td>";
                    mhtml += "<td><button id='id_addButton' onclick='addtolist("+mdata[x]['id_dues']+");'  type='button' class='btn btn-icon waves-effect waves-light btn-info m-b-5 fa fa-plus'> add</button></td>";
                    mhtml += "<td id='idSession"+ mdata[x]['id_dues'] +"' style='display:none;'>" + mdata[x]['se_id'] + "</td>";
                    mhtml += '</tr>';
                    
                    paybale += (parseFloat(mdata[x]['amount']) + parseFloat(fine));
                }

                $("#feetable tbody").append(mhtml);
                $('#payable').val(paybale.toFixed(2));
                $("#paid_feetable tbody").html('');
            }
        });
       
    } 
     
    function print_invoice(flag, inv) {
        window.open("<?php echo $this->Url->build(['controller' => 'Fees', 'action' => 'view']); ?>/" + flag + "/" + inv);
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