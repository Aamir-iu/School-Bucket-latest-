<!-- BEGIN PAGE LEVEL STYLES -->

<?= $this->Html->css('../plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css') ?>  
<?= $this->Html->css('../plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css') ?>  
<?= $this->Html->css('../plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') ?>  

<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->
<?= $this->Html->css('../plugins/select2/select2.css') ?>  
<?= $this->Html->css('../plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') ?>  

<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PORTLET CONFIGURATION MODAL FORM-->
<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                Widget settings form goes here
            </div>
            <div class="modal-footer">
                <button type="button" class="btn blue">Save changes</button>
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- END PORTLET CONFIGURATION MODAL FORM-->

<div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-basket font-teal-500"></i>
                    <span class="caption-subject font-teal-500 bold uppercase">
                        Order #<?php
                        $po = $purchaseOrder[0];
                        $supplier = $supplier[0];
                        echo $po->purchase_order_number;
                        ?> 
                    </span>
                    <span class="caption-helper"><?php echo $po->po_date; ?></span>
                </div>
                <div class="tools">
                    <a href="#" class="collapse" data-original-title="" title="">
                    </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
                    </a>
                    <a href="#" class="reload" data-original-title="" title="">
                    </a>
                    <a href="#" class="fullscreen" data-original-title="" title="">
                    </a>
                    <a href="#" class="remove" data-original-title="" title="">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="tabbable">
                    <ul class="nav nav-pills nav-tabs-lg">
                        <li class="active">
                            <a href="#tab_1" data-toggle="tab">
                                Detail Information </a>
                        </li>
                        <li>
                            <a href="#tab_2" data-toggle="tab">
                                Goods Received Notes <span class="badge badge-success">
                                    4 </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab_3" data-toggle="tab">
                                Invoices </a>
                        </li>
                        <li>
                            <a href="#tab_5" data-toggle="tab">
                                History </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="row">
                                <!--Order Details-->
                                <div class="col-md-6 col-sm-12">

                                    <div class="portlet light">
                                        <div class="portlet-title cyan">
                                            <div class="caption">
                                                <i class="icon-settings font-teal-500"></i>
                                                <span class="caption-subject font-teal-500 bold uppercase">Order Details</span>
                                            </div>
                                            <div class="actions">
                                                <a href="javascript:;" class="btn teal-500 btn-sm">
                                                    <i class="fa fa-pencil"></i> Edit </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row static-info">
                                                <div class="col-md-5 name">
                                                    Order #:
                                                </div>
                                                <div class="col-md-7 value">
                                                    <?php echo $po->purchase_order_number; ?> 
                                                </div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-5 name">
                                                    Order Date & Time:
                                                </div>
                                                <div class="col-md-7 value">
                                                    <?php echo $po->po_date; ?> 
                                                </div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-5 name">
                                                    Order Status:
                                                </div>
                                                <div class="col-md-7 value">
                                                    <span class="label label-success">
                                                        <?php echo $po->purchase_order_status; ?> 
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-5 name">
                                                    Grand Total:
                                                </div>
                                                <div class="col-md-7 value">
                                                    $14,454.60
                                                </div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-5 name">
                                                    Payment Information:
                                                </div>
                                                <div class="col-md-7 value">
                                                    Debit Card
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--End Order Details-->

                                <!--Supplier Info-->
                                <div class="col-md-6 col-sm-12">
                                    <div class="portlet light">
                                        <div class="portlet-title cyan">
                                            <div class="caption">
                                                <i class="icon-settings font-teal-500"></i>
                                                <span class="caption-subject font-teal-500 bold uppercase">Supplier Address</span>
                                            </div>
                                            <div class="actions">
                                                <a href="javascript:;" class="btn teal-500 btn-sm">
                                                    <i class="fa fa-pencil"></i> Edit </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row static-info">
                                                <div class="col-md-12 value">
                                                    <?php echo $supplier->supplier_name; ?><br>
                                                    <?php echo $supplier->supplier_address; ?><br>
                                                    <?php echo $supplier->contact_person; ?><br>
                                                    <?php echo $supplier->email; ?><br>
                                                    T: <?php echo $supplier->phone1; ?><br>
                                                    F: <?php echo $supplier->phone2; ?><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--End Supplier Info-->
                            </div>
                            <!--End Top Section Tab 1-->
                            <!-- Po Details (Product List)-->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="portlet light">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-basket-loaded font-teal-500"></i>
                                                <span class="caption-subject font-teal-500 bold uppercase">Products List</span>
                                            </div>
                                            <div class="actions">
                                                <a href="javascript:;" class="btn teal-500 btn-sm">
                                                    <i class="fa fa-plus"></i> Add </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">PO Number</th>
                                                            <th scope="col">Product Name</th>
                                                            <th scope="col">Pack Qty</th>
                                                            <th scope="col">Units per pack</th>
                                                            <th scope="col">Pack Price</th>
                                                            <th scope="col">Units Qty</th>
                                                            <th scope="col">Unit Price</th>
                                                            <th scope="col">Total</th>
                                                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($purchaseOrder[0]['po_details'] as $poDetail): ?>
                                                            <tr>
                                                                <td><?= h($poDetail->po_number) ?></td>
                                                                <td><?= h($poDetail->product_name) ?> </td>
                                                                <td><?= $this->Number->format($poDetail->pack_qty) ?></th>
                                                                <td><?= $this->Number->format($poDetail->units_per_pack) ?></th>
                                                                <td><?= $this->Number->format($poDetail->pack_price) ?></th>
                                                                <td><?= $this->Number->format($poDetail->total_units) ?></th>
                                                                <td><?= $this->Number->format($poDetail->unit_price) ?></th>
                                                                <td><?= $this->Number->format($poDetail->total) ?></td>
                                                                <td class="actions">
                                                                    <?= $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'edit', $poDetail->po_details['id_po_details']], ['class' => 'btn btn-icon btn-sm waves-effect waves-light btn-warning m-b-5', 'escape' => false]) ?>
                                                                    <?= $this->Form->postLink(__('<i class="fa fa-trash"></i>'), ['action' => 'delete', $poDetail->po_details['id_po_details']], ['confirm' => __('Are you sure you want to delete # {0}?', $poDetail->po_details['id_po_details']), 'class' => 'btn btn-icon btn-sm waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Products Table End-->
                            <div class="row">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                    <div class="well">
                                        <div class="row static-info align-reverse">
                                            <div class="col-md-8 name">
                                                Sub Total:
                                            </div>
                                            <div class="col-md-3 value">
                                                <input id="txtsubtotal" style="border:none; text-align: right" value="$14,454.584"/>
                                            </div>
                                        </div>
                                        <div class="row static-info align-reverse">
                                            <div class="col-md-8 name">
                                                Tax @ <input id="suppliertaxreate" style="border:none; text-align: right; width: 25px;" value="8" />%:
                                            </div>
                                            <div class="col-md-3 value">
                                                <input id="txtsuppliertax" style="border:none; text-align: right" value="$35.50"/>
                                            </div>
                                        </div>
                                        <div class="row static-info align-reverse">
                                            <div class="col-md-8 name">
                                                Grand Total:
                                            </div>
                                            <div class="col-md-3 value">
                                                <input id="txtgrandtotal" style="border:none; text-align: right" value="$14,490.084"/>
                                            </div>
                                        </div>
                                        <div class="row static-info align-reverse">
                                            <div class="col-md-8 name">
                                                Total Paid:
                                            </div>
                                            <div class="col-md-3 value">
                                                <input id="txttotalpaid" style="border:none; text-align: right" value="$14,500.00"/>
                                            </div>
                                        </div>
                                        <div class="row static-info align-reverse">
                                            <div class="col-md-8 name">
                                                Total Due:
                                            </div>
                                            <div class="col-md-3 value">
                                                <input id="txttotaldue" style="border:none; text-align: right" value="$500.00"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--PO Details End-->
                        </div>
                        <!--Tab PO Details End-->
                        <!-- Tab GRN Start-->

                        <div class="tab-pane" id="tab_2">
                            <div class="table-container">
                                <table class="table table-striped table-bordered table-hover" id="datatable_grn">
                                    <thead>
                                        <tr role="row" class="heading">
                                            <th width="5%">
                                                Credit&nbsp;Memo&nbsp;#
                                            </th>
                                            <th width="15%">
                                                Bill To
                                            </th>
                                            <th width="15%">
                                                Created&nbsp;Date
                                            </th>
                                            <th width="10%">
                                                Status
                                            </th>
                                            <th width="10%">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--TAB GRN End-->
                    </div>
                    <!--Tab Content End-->
                </div>
            </div>
            <!--Portlet Body End-->
        </div>
    </div>
</div>


<!-- END PAGE CONTENT-->





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

        PurchaseOrderView.init();

        toastr.options = {
            closeButton: true,
            debug: false,
            newestOnTop: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            preventDuplicates: false,
            onclick: 'close'
        };
    });
    
    var PurchaseOrderView = function () {
    
        var handleGRN = function () {

        var grid = new Datatable();
        
        grid.init({
            src: $("#datatable_grn"),
            onSuccess: function (grid) {
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            loadingMessage: 'Loading...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
                // So when dropdowns used the scrollable div should be removed. 
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": "<?php echo $this->Url->build(['action' => 'getpogrn']); ?>", // ajax source
                },
                "columnDefs": [{ // define columns sorting options(by default all columns are sortable extept the first checkbox column)
                    'orderable': true,
                    'targets': [0]
                }],
                "order": [
                    [0, "asc"]
                ] // set first column as a default sort by asc
            }
        });

    }

     return {

        //main function to initiate the module
        init: function () {
            //initPickers();
            handleGRN();
        }

    };

}();


</script>