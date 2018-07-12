<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<?= $this->Html->css('../plugins/daterangepicker/daterangepicker.css') ?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
             
                    <div class="btn-group pull-right">
                        <div class='row'>
                            <div class='col-md-5'>
                                    
                                            <select name='i' id='i' class='form-control'>
                                                    <option value='today'>Today</option>
                                                    <option value='yesterday'>Yesterday</option>
                                                    <option value='7days' >Past 7 Days</option>
                                                    <option value='month' >This Month</option>
                                                    <option value='All' >All Time</option>    
                                            </select>
                                           
                                    
                            </div>
                            <div class="col-md-3">
                                <input type='submit' onclick="search_record();" class='btn btn-default' value='Filter'>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="actions" style="margin-bottom: 28px;">
                                    <a  href="#add-account" onclick="loadmodal();" title="Add Fees" class="btn btn-block btn-warning">
                                        <i class="fa fa-envelope"></i> Send SMS  &nbsp;</a>
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
                                <th width="10%">ID</th>
                                <th width="10%">Recipient No</th>
                                <th width="40%">Message</th>
                                <th width="10%">Sender ID</th>
                                <th width="10%">Operator</th>
                                <th width="10%">Length</th>
                                <th width="10%">Status</th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php //foreach($data as $row): ?>
<!--                            <tr>
                                <td><?= $row->messageid ?></td>
                                <td><?= $row->mobile ?></td>
                                <td><?= $row->message ?></td>
                                <td><?= $row->sender ?></td>
                                <td><?= $row->operator ?></td>
                                <td><?= $row->length ?></td>
                                <td><?= $row->datetime ?></td>
                                
                            </tr>-->
                            <?php// endforeach; ?>
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
<div class="modal fade" id="add-inqquiry"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">

                    <div class="col-xs-12">        
                        <!-- quick email widget -->
                        <div class="box box-info">
                            <div class="box-header">
                                <i class="fa fa-envelope"></i>

                                <h3 class="box-title">Quick SMS</h3>
                                <!-- tools box -->
                                <div class="pull-right box-tools">
                                    <button type="button" class="btn btn-info btn-sm"  data-toggle="tooltip" data-dismiss="modal" title="Close">
                                        <i class="fa fa-times"></i></button>
                                </div>
                                <!-- /. tools -->
                            </div>
                            <div class="box-body">
                                <form action="#" method="post" id="form1">


                                    <div class="form-group">
                                        <select onchange="sending_option();" class="form-control" name="option_id" id="option_id">

                                            <option value="1">Class | Shift Wise</option>
                                            <option value="2">All</option>
                                            <option value="3">Selected</option>

                                        </select>
                                    </div> 

                                    <div class="form-group">
                                        <select class="form-control" id="id_class"  data-placeholder="Select Class" style="width: 100%;">
                                            <?php foreach ($class as $class): ?>    
                                                <option value="<?php echo $class->id_class; ?>"><?php echo $class->class_name; ?></option>
                                            <?php endforeach; ?>    
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <select  class="form-control" name="shift_id" id="shift_id">

                                            <option value="1">Morning</option>
                                            <option value="2">Afternoon</option>
                                            <option value="3">Evening</option>

                                        </select>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <select class="form-control" name="session_id" id="session_id">
                                            <?php foreach($session as $session):  ?>
                                                <option  value="<?php echo $session->id_session; ?>"><?php echo $session->session; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <select id="status" name="type" class="form-control">
                                                <option value="Y">Active Students</option>
                                                <option value="N">Inactive Students</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <select id="type" name="type" class="form-control">
                                                <option value="text">English</option>
                                                <option value="unicode">Urdu</option>

                                        </select>
                                    </div>

                                    
                                    
                                    <div class="form-group">
                                        <input type="text" style="display:none;"  class="form-control" name="selected" id="selected" placeholder="100,101,102,104">
                                    </div> 
                                  
                                    <div>
                                        <textarea class="textarea" id="message" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php  echo $this->request->session()->read('Info.events_msg') ?></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="box-footer clearfix">
                                
                                
                                
                                <div class="col-md-4 col-md-offset-4">
                                <button type="button" onclick="sendSMS();" class="pull-right btn btn-default" id="sendEmail" data-toggle="tooltip"  title="Send SMS">Send
                                    <i class="fa fa-arrow-circle-right" ></i></button>
                                </div> 
                                
                                <div class="col-md-4">
                                <button type="button" onclick="export_number();" class="pull-right btn btn-default" id="sendEmail" data-toggle="tooltip"  title="Send SMS">Export
                                    <i class="fa fa-arrow-circle-right" ></i></button>
                                </div> 
                                
                            </div>
                        </div>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>  
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
<?= $this->Html->script('../plugins/daterangepicker/daterangepicker.js') ?>
<?php // $this->Html->script('datatable.js') ?> 

<script>
    
    $(document).ready(function(){
          tabltint(); 
        if($.fn.DataTable.isDataTable("#userstable")){ 
            $("#userstable").dataTable().fnDestroy();
          
         }
       // theTable.init();
      
        
    });
    
     
   function search_record(){
       tabltint();
     
    }
    
    var tabltint = function () {
        if($.fn.DataTable.isDataTable("#userstable")){ 
            $("#userstable").dataTable().fnDestroy();
         }
 
        var theTable = $('#userstable').DataTable({
      
               // 'bFilter': false,
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
                    url: "<?php echo $this->Url->build(['controller' => 'SmsLog', 'action' => 'smsreport']); ?>",
                    dataType: 'json',
                    cache: false,
                    async: false,
                    "data": function ( d ) {
                        d.apivalue = $('#i option:selected').val();
                       
                    }
                },
                "oLanguage": {
                 "sProcessing": '<img src="https://eschools.cloud/images/loading-spinner-grey.gif">'
               }, // set first column as a default sort by asc
                "columns": [
                        {"data": "messageid"},
                        {"data": "mobile"},
                        {"data": "message"},
                        {"data": "sender"},
                        {"data": "operator"},
                        {"data": "length"},
                        {"data": "datetime"},
                    ]
        });
        
   }  
    
    
    $(function () {
        //Date range as a button
        $('#daterange-btn').daterangepicker(
                {
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function (start, end) {
                    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                    $('#start').val(start);
                    $('#end').val(end);
                    
                }
                        
        );
       

    });

    $(document).ready(function () {
        $("#class_id").select2();
   
    });

    $(function () {
        $("#userstable").DataTable( {
        "order": [[ 0, "desc" ]]
    } );
    });
 
    $('#datepicker').datepicker({
        autoclose: true
    });
    
    function loadmodal() {

        $('#add-inqquiry').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }

    function save_inquiry() {
        
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var contact = $('#contact').val();
        var class_id = $('#class_id option:selected').val();
        var address = $('#address').val();
        if (fname == '') {
            toastr["error"]("Please enter first name.");
            return false;
        }

        if (lname == '') {
            toastr["error"]("Please enter last name.");
            return false;
        }

        if (contact == '') {
            toastr["error"]("Please enter contact number.");
            return false;
        }

        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'Inquiry', 'action' => 'add']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {fn: fname
                , ln: lname
                , class_id: class_id
                , address: address
                , contact: contact
            },
            success: function (data) {
                var result = data.msg.split("|");
                if (result[0] === "Success") {
                    toastr.success(result[0], result[1]);
                    $('#add-inqquiry').modal('hide');
                    location.reload();
                } else {
                    toastr.warning(result[0], result[1]);
                }
            }
        });

    }
    function delete_inquiry(id) {

        swal({
            title: 'Are you sure?',
            text: "Are sure you want to delete!",
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
                        url: "<?php echo $this->Url->build(['controller' => 'Inquiry', 'action' => 'delete']); ?>",
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {id: id},
                        success: function (data) {
                            var result = data.msg.split("|");
                            if (result[0] === "Success") {
                                toastr.success(result[0], result[1]);
                                location.reload();
                            } else {
                                toastr.error(result[0], result[1]);
                            }
                        }
                    });
                }

            }
            swal(
                    'Deleted!',
                    'Record has been deleted.',
                    'success'
                    )
        });

    }



    function sending_option(){

        var op = $('#option_id option:selected').val();
        if(op === '1'){
            $('#id_class').fadeIn();
            $('#shift_id').fadeIn();
            $('#selected').hide();
        }else if(op === '2'){
            $('#id_class').hide();
            $('#shift_id').hide();
            $('#selected').hide();
        }
        else if(op === '3'){
            $('#id_class').hide();
            $('#shift_id').hide();
            $('#selected').fadeIn();
           
        }
    }

    function sendSMS() {
        
        var class_id = $('#id_class').val();
        var shift_id = $('#shift_id').val();
        var message =  $('#message').val();
        var option_id =  $('#option_id').val();
        var ids =  $('#selected').val();
        var type =  $('#type option:selected').val();
        var session_id =  $('#session_id option:selected').val();
        var status =  $('#status option:selected').val();
        
        swal({
            title: 'Are you sure?',
            text: "you want to Send!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(function (result) {
            imageOverlay('#form1', 'show');
            if (result) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'SmsLog', 'action' => 'add']); ?>",
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {class_id: class_id,shift_id:shift_id,option_id: option_id
                                ,message:message,ids:ids,type:type,session_id:session_id
                                ,status:status},
                        success: function (data) {
                            imageOverlay('#form1','hide');
                            var result = data.msg.split("|");
                            if (result[0] === "Success") {
                                toastr.success(result[0], result[1]);
                               
                            } else {
                                toastr.error(result[0], result[1]);
                            }
                        }
                    });
           }

        });

    }
    
    function export_number() {
        var class_id = $('#id_class').val();
        var shift_id = $('#shift_id').val();
        var message =  $('#message').val();
        var option_id =  $('#option_id').val();
        var ids =  $('#selected').val();
        swal({
            title: 'Are you sure?',
            text: "you want to export!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(function (result) {
            imageOverlay('#form1', 'show');
            if (result) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'SmsLog', 'action' => 'exportnumbers']); ?>",
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {class_id: class_id,shift_id:shift_id,option_id: option_id,message:message,ids:ids },
                        success: function (data) {
                            imageOverlay('#form1','hide');
                            var result = data.msg.split("|");
                            if (result[0] === "Success") {
                                toastr.success(result[0], result[1]);
                                window.open("<?php echo $link; ?>");
                                //$.fileDownload(<?php echo $link; ?>);
                            } else {
                                toastr.error(result[0], result[1]);
                            }
                        }
                    });
           }

        });

    }
    
   
  
</script>
