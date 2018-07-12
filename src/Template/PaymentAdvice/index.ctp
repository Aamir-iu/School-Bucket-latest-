<!-- BEGIN PAGE LEVEL STYLES -->

<?= $this->Html->css('../plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') ?>  

<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->

<?= $this->Html->css('../plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css') ?>  
<?= $this->Html->css('../plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css') ?>  
<?= $this->Html->css('../plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') ?>  

<!-- END PAGE LEVEL STYLES -->




<!-- BEGIN PURCHASE ORDERS TABLE PORTLET-->
<div class="portlet light">
    <div class="portlet-title light-blue">
        <div class="caption">
            <i class="fa fa-bar-chart-o font-black-500"></i>
            <span class="caption-subject font-black-500"> <?= __('Payment Advice') ?></span>
            <span class="caption-helper">manage your payment advice ...</span>
        </div>
        <div class="tools">
            <a href="#" class="fullscreen" data-original-title="" title="">
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-container">
            <div class="table-actions-wrapper">
                <span>
                </span>
                
                <select  name="statsus" id="status"   class="table-group-action-input form-control form-filter input-inline input-small input-sm">
                      
                    <option>Status</option>
                    <option value="Active">Active</option>
                    <option value="Cancelled">Cancelled</option>
                      
                </select>
                

            </div>

            <table class="table table-striped table-bordered table-hover" id="datatable_advice">

                <thead>
                    <tr role="row" class="heading">
                        <th width="2%">
                            PaymentAdvice&nbspID
                        </th>
                        <th width="3%">
                            PO_Number.
                        </th>
                       
                        <th width="15%">
                            Date Range: 
                        </th>
                        <th width="10%">
                            Invoice No.
                        </th>
                        <th width="15%">
                            Actions
                        </th>
                    </tr>
                    <tr role="row" class="filter">
                        <td>
                            <input type="text" class="form-control form-filter input-sm" name="paymentadvice_id">
                        </td>
                        <td>
                            <input type="text" class="form-control form-filter input-sm" name="po_id">
                        </td>

                        <td>
                            <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy/mm/dd">
                                <input type="text" class="form-control form-filter input-sm" readonly name="date_from" placeholder="From">
                                <span class="input-group-btn">
                                    <button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
                                </span>
                            </div>

                            <div class="input-group date date-picker" data-date-format="yyyy/mm/dd">
                                <input type="text" class="form-control form-filter input-sm" readonly name="date_to" placeholder="To">
                                <span class="input-group-btn">
                                    <button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
                                </span>
                            </div>

                        </td>
                        
                        
                        
                        <td>
                          <input type="text" class="form-control form-filter input-sm" name="invoice_no">
                        </td>
                        <td>
                            <div class="margin-bottom-5">
                                <button class="btn btn-sm teal-500 filter-submit margin-bottom"><i class="icon-magnifier"></i> Search</button>
                            </div>
                            <button class="btn btn-sm orange-500 filter-cancel"><i class="icon-refresh"></i> Reset</button>
                        </td>
                    </tr>


                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>





<!-- BEGIN PAGE LEVEL PLUGINS -->
<?= $this->Html->script('../plugins/select2/select2.min.js') ?>
<?= $this->Html->script('../plugins/datatables/media/js/jquery.dataTables.min.js') ?>
<?= $this->Html->script('../plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') ?>
<?= $this->Html->script('../plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?= $this->Html->script('datatable.js') ?>

<script>


    jQuery(document).ready(function () {

       paymentadvice.init();

        $("#draggable").draggable({
            handle: ".modal-header"
        });
       
        
    });



    var paymentadvice = function () {

        var initPickers = function () {
            //init date pickers
            $('.date-picker').datepicker({
                rtl: Backbones.isRTL(),
                autoclose: true
            });
        }

        var handlepaymentadvice = function () {

            var grid = new Datatable();

            grid.init({
                src: $("#datatable_advice"),
                onSuccess: function (grid) {
                    // execute some code after table records loaded

                },
                onError: function (grid) {
                    // execute some code on network or other general error  
                },
                loadingMessage: 'Loading...',
                dataTable: {// here you can define a typical datatable settings from http://datatables.net/usage/options 
                    // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                    // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: js/datatable.js). 
                    // So when dropdowns used the scrollable div should be removed. 
                    "dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                    "lengthMenu": [
                        [10, 20, 50, 100, 150, -1],
                        [10, 20, 50, 100, 150, "All"] // change per page values here
                    ],
                    "pageLength": 10, // default record count per page
                    "ajax": {
                        "url": "<?php echo $this->Url->build(['action' => 'getpaymentadvicebysearch']); ?>", // ajax source

                    },
                    "order": [
                        [0, "desc"]
                    ], // set first column as a default sort by asc
                    "columns": [
                        {"data": "id_payment_advice"},
                        {"data": "po_number"},
                        {"data": "date"},
                        {"data": "invoice_number"},
                        {"data": "actions"}

                    ],
                    "columnDefs": [{"sortable": false, "targets": 4}]

                }
            });


            // handle group actionsubmit button click
            grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
                e.preventDefault();
                var action = $(".table-group-action-input", grid.getTableWrapper());
                if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                    grid.setAjaxParam("customActionType", "group_action");
                    grid.setAjaxParam("customActionName", action.val());
                  //  grid.setAjaxParam("id", grid.getSelectedRows());
                    grid.getDataTable().ajax.reload();
                    grid.clearAjaxParams();
                } else if (action.val() == "") {
                    Backbones.alert({
                        type: 'danger',
                        icon: 'warning',
                        message: 'Please select an action',
                        container: grid.getTableWrapper(),
                        place: 'prepend'
                    });
                } else if (grid.getSelectedRowsCount() === 0) {
                    Backbones.alert({
                        type: 'danger',
                        icon: 'warning',
                        message: 'No record selected',
                        container: grid.getTableWrapper(),
                        place: 'prepend'
                    });
                }
            });

        }

        return {
            //main function to initiate the module
            init: function () {

                initPickers();
                handlepaymentadvice();
            }

        };

    }();


    function openadvice(id){
        
        window.open("<?php echo $this->Url->build(['controller' => 'PaymentAdvice', 'action' => 'view']); ?>/0/" + id);
    
    }


function deleteAdvice(id) {
        swal({
            title: "Confirmation!",
            text: "Do you really want to delete payment advice?",
            type: "info",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function (result) {
            if (result == true) {
                       $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'PaymentAdvice', 'action' => 'edit']); ?>",
                        dataType: 'json',
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
                    //swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });

    }

    function createvoucher(id){
    
     window.location.assign("<?php echo $this->Url->build(['controller' => 'AccountVoucher', 'action' => 'add']); ?>/" + id);
    
    }

    function alreadycreated(id){
        
        toastr.error('The voucher already created.');
        
    }
    
    


</script>
