<!-- BEGIN PAGE LEVEL STYLES -->
<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                   <div class="btn-group pull-right">
                    <div class="row">   
                        <div class="col-xs-12">
                            <div class="box-tools">
                                        <div class="input-group">
                                            <form method="post" action="" id="search-form" class="form-horizontal">
                                            <table class="table table-responsive" cellpadding="3" cellspacing="3" width="100%">
                                             
                                            <tr>
                                                <td>Status</td>
                                            	<td>Payment Mode</td>
                                                <td>From Account</td>
                                                <td>To Account</td>
                                                <td>Search</td>
                                                <td>Action</td>
                                               
                                               
                                            </tr>
                                            <tr>
                                                
                                                <td>
                                                <select name="voucher_status" id="voucher_status" class="form-control">
                                                    <option value='Unposted'>Unposted</option>
                                                    <option value='Posted'>Posted</option>
                                                    <option value='Cancelled'>Cancelled</option>
                                                </select>
                                                </td>
                                                
                                                <td>
                                                <select name="payment_mode" id="payment_mode" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Cheque">Check</option>
                                                    <option value="Pay Order">Pay Order</option>
                                                    <option value="Credit Card">Credit Card</option>
                                                </select>
                                                </td>
                                                
                                                <td>
                                                <select name="sub_account_from" id="sub_account_from"  class="form-control" style="width: 190px;" >
                                                    <option value="">Select</option>
                                                    <?php foreach ($accounts as $account) { ?>
                                                        <option value="<?= $account['id_sub_control_account']; ?>"><?= $account['mainaccountno'] . "-" . $account['controlaccountno'] . "-" . $account['subaccountno'] . " | " . $account['subaccountname']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                </td>
                                                
                                                <td>
                                                <select name="sub_account_to" id="sub_account_to" class="form-control" style="width: 190px;" >
                                                    <option value="">Select</option>
                                                    <?php foreach ($accounts as $account) { ?>
                                                        <option value="<?= $account['id_sub_control_account']; ?>"><?= $account['mainaccountno'] . "-" . $account['controlaccountno'] . "-" . $account['subaccountno'] . " | " . $account['subaccountname']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                </td>
                                                
                                                <td>
                                                    <button class="btn btn-sm btn-primary" name="btnSearch" id="btnSearch" onclick="search_record();" type="button"><i class="fa fa-search"></i> Search </button>
                                                </td>
                                                <td>
                                                   
                                                    <?= $this->Html->link(__('<i class="fa fa-plus"></i> Add'), ['action' => 'add'], ['class' => 'btn btn-sm btn-success', 'escape' => false]) ?>
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
                  <div class="btn-group pull-right">
                    <div class="row">   
                        <div class="col-xs-12">
                            <div class="box-tools">
                                        <div class="input-group">
                                            <form method="post" action="" id="search-form" class="form-horizontal">
                                            <table class="table table-responsive" cellpadding="3" cellspacing="3" width="100%">
                                             
                                            <tr>
                                                <td>Voucher ID</td>
                                            	<td>Voucher #</td>
                                                <td>Instrument&nbsp;Number</td>
                                                <td>From Date</td>
                                                <td>To Date</td>
                                                <td>Cost Center</td>
                                               
                                               
                                            </tr>
                                            <tr>
                                                
                                                <td>
                                                <input type="text" class="form-control form-filter input-sm" name="voucher_id" id="voucher_id" placeholder="Voucher ID"> 
                                                </td>
                                                
                                                <td>
                                                <input type="text" class="form-control form-filter input-sm" name="voucher_id" id="voucher_id" placeholder="Voucher Number">
                                                </td>
                                                
                                                <td>
                                                <input type="text" class="form-control form-filter input-sm" name="instrument_no" id="instrument_no" placeholder="Instrument Number"> 
                                                </td>
                                                
                                                <td>
                                                <input class="form-control input-sm" name="from_date" id="from_date" type="text" value="" placeholder="From Date" style="width: 100px;" required>
                                                </td>
                                                <td>
                                                <input class="form-control input-sm" name="to_date" id="to_date" type="text" value="" placeholder="To Date" style="width: 100px;" required>
                                                </td>
                                                <td>
                                                <input type="text" class="form-control form-filter input-sm" name="cost_center" id="cost_center" placeholder="Cost Center">
                                                </td>
                                                
                                            </tr>
                                            </table>
                                            </form>
                                        </div>
                                    </div>
                        </div>
                    </div>

                </div>
                
                <table class="table table-striped table-bordered table-hover" id="datatable_vouchers">

                <thead>
                    <tr role="row" class="heading">
                        
                        <th width="5%">
                            ID #
                        </th>

                        <th width="5%">
                            Voucher Number
                        </th>

                        <th width="10%">
                            Created&nbsp;Date
                        </th>
        
                        <th width="10%">
                            Voucher&nbsp;Date
                        </th>
                        
                        <th width="10%">
                            Cost Center
                        </th>
                        
                        <th width="4%">
                            Debit
                        </th>
                        <th width="4%">
                            Credit
                        </th>
                       
                        <th width="15%">
                            Action
                        </th>
                        
                        

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
<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>    
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
<?= $this->Html->script('datatable.js') ?> 

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?= $this->Html->script('datatable.js') ?>

<script>

    jQuery(document).ready(function () {
        tabltint();
        
        $('#from_date').datepicker({
         autoclose: true
        });
        $('#to_date').datepicker({
             autoclose: true
        });

    });
    

    function search_record(){
       tabltint();
     
    }
    var tabltint = function () {
        if($.fn.DataTable.isDataTable("#datatable_vouchers")){ 
            $("#datatable_vouchers").dataTable().fnDestroy();
         }
 
        var theTable = $('#datatable_vouchers').DataTable({
           
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
                    url: "<?php echo $this->Url->build(['controller' => 'AccountVoucher', 'action' => 'getvoucherbysearch']); ?>",
                    dataType: 'json',
                    cache: false,
                    async: false,
                    "data": function ( d ) {
                        d.voucher_status = $('#voucher_status option:selected').val();
                        d.payment_mode = $('#payment_mode option:selected').val();
                        d.sub_account_from = $('#sub_account_from option:selected').val();
                        d.sub_account_to = $('#sub_account_to option:selected').val();
                        
                        d.voucher_id = $('#voucher_id').val();
                        d.voucher_id = $('#voucher_id').val();
                        d.instrument_no = $('#instrument_no').val();
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                        d.cost_center = $('#cost_center').val();
                        
                    }
                },
                "oLanguage": {
                 "sProcessing": ''
               },
                "columnDefs": [{ // define columns sorting options(by default all columns are sortable extept the first checkbox column)
                    'orderable': false,
                    'targets': [0]
                    
                }],
                    
                "order": [
                    [1, "asc"]
                ], // set first column as a default sort by asc
                "columns": [
                        {"data": "id_account_voucher"},
                        {"data": "voucher_number"},
                        {"data": "voucher_date_created"},
                        {"data": "voucher_dated"},
                        {"data": "center_name"},
                        {"data": "debit", render: $.fn.dataTable.render.number( ',', '.', 0 )},
                        {"data": "credit", render: $.fn.dataTable.render.number( ',', '.', 0 )},
                        {"data": "actions"}
                    ],
                    "columnDefs": [
                        {
                            "sortable": false,
                            "targets": 5
                        },{
                            "className": 'text-right',
                            "targets": 5
                        },{
                            "className": 'text-right',
                            "targets": 4
                        }
                    ]
                    
        });
        
   } 
   

    function deletevoucher() {

        var desc = $('#desc').val();
        var vid = $('#vid').val();

        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['action' => 'edit']); ?>",
            dataType: 'json',
            data: {desc: desc, voucher_id: vid},
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

    function openvoucer(voucherid) {

        toastr["info"]("Collecting Voucher details", "Opening Voucher")

        window.location.assign("<?php echo $this->Url->build(['controller' => 'AccountVoucher', 'action' => 'openvoucher']); ?>/" + voucherid);

    }


    function loadmodal(id) {

        $('#vid').val(id);
        $('#voucher_mod').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }

    $(document).ready(function() {
  $("#acfrom").select2();
  $("#acto").select2();
});


    function voucher_verify(vid) {
        swal({
            title: "Confirmation!",
            text: "Do you really want to verify voucher?",
            type: "info",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, Change it!",
            closeOnConfirm: false
        },
        function (result) {
            if (result == true) {
               
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'AccountVoucher', 'action' => 'verifyvoucher']); ?>",
                        dataType: 'json',
                        data: {vid: vid},
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
                    //swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });

    }


    function voucher_Verified(vid){

        toastr.success('Already Verified');


    }

    function edit_voucher(voucherid) {

        window.location.assign("<?php echo $this->Url->build(['controller' => 'AccountVoucher', 'action' => 'voucheredit']); ?>/" + voucherid);

    }

</script>
