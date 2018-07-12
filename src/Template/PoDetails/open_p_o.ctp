<!-- BEGIN PAGE LEVEL STYLES -->
<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">

                <div class="row">
                    <div class="col-md-12">
                        <!-- Begin: life time stats -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="caption">
                                    <i class="icon-basket font-teal-500"></i>
                                    <span class="caption-subject font-teal-500 bold uppercase">
                                        Order #<?php
                                        $po = $purchaseOrder[0];
                                        $supplier = $supplierproducts[0];

                                        ?> 
                                        <span id="ponumber" ><?php echo $po->purchase_order_number; ?> </span> <span>| Order ID : <?= $po->id_purchase_orders;?> </span>
                                    </span>
                                    <span class="caption-helper"><?php echo $po->po_date; ?></span>

                                    <div class="tools pull-right">
                                        <?= $this->Html->link(__(''), ['controller' => 'PoDetails', 'action' => 'view', $po->id_purchase_orders],['class'=>'fa fa-print','target'=>'blank']) ?>
                                        <a href="javascript:getpodetails();" class="reload" data-original-title="" title="">
                                        </a>
                                        <a href="#" class="fullscreen" data-original-title="" title="">
                                        </a>
                                    </div>

                                </div>

                            </div>
                            <div class="panel-body">
                                <div class="tabbable">
                                    <ul class="nav nav-pills nav-tabs-lg">
                                        <li class="active">
                                            <a href="#tab_1" data-toggle="tab">
                                                Detail Information </a>
                                        </li>
                                        <li>
                                            <a href="#tab_2" onclick="getpogrn();" data-toggle="tab">
                                                Goods Received Notes 
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#tab_5" onclick="getprnnote();" data-toggle="tab">
                                                Purchase Return Note 
                <!--                                <span class="badge badge-success">
                                                    4 </span>-->
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#tab_3" onclick="getdeliverystatus();" data-toggle="tab">
                                            Delivery Status</a>
                                        </li>
                                        <li>
                                            <a href="#tab_4" onclick="getpaymentadvice();" data-toggle="tab">
                                                Payment Advice</a>
                                        </li>

                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">
                                            <div class="row">
                                                <!--Order Details-->
                                                <div class="col-md-6 col-sm-12">

                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <div class="caption">
                                                                <i class="fa fa-shopping-cart"></i>
                                                                <span class="caption-subject font-teal-500 bold uppercase">Order Details (id=<span id="po_id"><?=$po->id_purchase_orders;?></span>)</span>

                                                                <div class="actions pull-right">
                                                                <a  href="#po_status" data-toggle="modal" data-original-title="Update Status" title="Update Status" class="btn btn-icon btn-xs waves-effect waves-light btn-success m-b-5">
                                                                    <i class="fa fa-pencil"></i> Edit </a>
                                                                 </div>

                                                            </div>

                                                        </div>
                                                        <div class="panel-body">
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
                                                                    Rs.<?= $this->Number->format($po->subtotal + $po->taxes);?> 
                                                                </div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name">
                                                                    Total Items:
                                                                </div>
                                                                <div class="col-md-7 value">
                                                                    <?php foreach($purchaseOrder[0]['items'] as $items){echo $items;} ?>
                                                                </div>
                                                            </div>

                                                            <div class="row static-info">
                                                                <div class="col-md-5 name">
                                                                    PO Reason:
                                                                </div>
                                                                <div class="col-md-7 value">
                                                                    <?php echo $po->po_reason; ?> 
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                                <!--End Order Details-->

                                                <!--Supplier Info-->
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <div class="caption">
                                                                <i class="fa fa-map-pin"></i>
                                                                <span class="caption-subject font-teal-500 bold uppercase">Supplier Address</span>
                                                            </div>

                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="row static-info">
                                                                <div class="col-md-12 value">

                                                                    <?php echo $supplier->supplier['supplier_name']; ?><br>
                                                                    <?php echo $supplier->supplier['supplier_address']; ?><br>
                                                                    <?php echo $supplier->supplier['contact_person']; ?><br>
                                                                    <?php echo $supplier->supplier['email']; ?><br>
                                                                    T: <?php echo $supplier->supplier['phone1']; ?><br>
                                                                    F: <?php echo $supplier->supplier['phone2']; ?><br>
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
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <div class="caption">
                                                                <i class="fa fa-shopping-cart"></i>
                                                                <span class="caption-subject font-teal-500 bold uppercase">Products List</span>
                                                                <div class="actions pull-right">
                                                                    <a  href="#" onclick="loadmodal_add_po_product(<?php echo $po->id_purchase_orders; ?>);" data-original-title="Add Products" id="add_p" title="Add Products" class="btn btn-icon btn-xs waves-effect waves-light btn-success m-b-5">
                                                                    <i class="fa fa-plus"></i> Add </a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="table-responsive">
                                                                <table id="podetailstbl" class="table table-hover table-bordered table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">PO Number</th>
                                                                            <th scope="col">Product Name</th>
                                                                            <th scope="col">Pack Qty</th>
                                                                            <th scope="col">Units per pack</th>
                                                                            <th scope="col">Pack Price (Rs.)</th>
                                                                            <th scope="col">Units Qty</th>
                                                                            <th scope="col">Unit Price (Rs.)</th>
                                                                            <th scope="col">Subtotal (Rs.)</th>
                                                                            <th scope="col">Tax (Rs.)</th>
                                                                            <th scope="col">Total (Rs.)</th>
                                                                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php foreach ($purchaseOrder[0]['po_details'] as $poDetail): ?>
                                                                            <tr>
                                                                                <td><?= h($poDetail->po_number); ?></td>
                                                                                <td><?= h($poDetail->product_name); ?> </td>
                                                                                <td><?= h($poDetail->pack_qty); ?></th>
                                                                                <td><?= h($poDetail->units_per_pack); ?></th>
                                                                                <td><?= $this->Number->precision($poDetail->pack_price, 2); ?></th>
                                                                                <td><?= h($poDetail->total_units); ?></th>
                                                                                <td><?= $this->Number->precision($poDetail->unit_price, 2); ?></th>
                                                                                <td><?= $this->Number->precision($poDetail->total, 2); ?></td>
                                                                                <td><?= $this->Number->precision($poDetail->tax, 2); ?></td>
                                                                                <td class="total"><?= $this->Number->precision($poDetail->total + $poDetail->tax, 2); ?></td>
                                                                                <td class="actions">
                                                                                    <button onclick='delete_pod(<?= $poDetail->id_po_details.','.$poDetail->product_id.','.$po->id_purchase_orders; ?>)' class='btn btn-icon btn-sm waves-effect waves-light btn-danger m-b-5'><i class="fa fa-trash"></i></button>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <div class="row">
                                                                        <div class="col-xs-9 text-right">Sub Total:</div>
                                                                        <div class="col-xs-3 text-right">
                                                                            <input id="txtsubtotal" style="border:none; text-align: right; font-weight: bold; margin-bottom: 10px;" value="Rs.<?= $this->Number->precision($po->subtotal,2); ?>"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-xs-9 text-right">Taxes:</div>
                                                                        <div class="col-xs-3 text-right">
                                                                            <input id="txtsuppliertax" style="border:none; text-align: right; font-weight: bold; margin-bottom: 10px;" value="Rs.<?= $this->Number->precision($po->taxes,2);?>"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-xs-9 text-right">Grand Total:</div>
                                                                        <div class="col-xs-3 text-right">
                                                                            <input id="txtgrandtotal" style="border:none; text-align: right; font-weight: bold; margin-bottom: 10px;" value="Rs.<?= $this->Number->precision($po->subtotal + $po->taxes,2);?>"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Products Table End-->

                                            <!--PO Details End-->
                                        </div>
                                        <!--Tab PO Details End-->
                                        <!-- Tab GRN Start-->
                                        <div class="tab-pane" id="tab_2">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <div class="caption">
                                                        <i class="icon-basket-loaded font-teal-500"></i>
                                                        <span class="caption-subject font-teal-500 bold uppercase">Goods Received Notes</span>
                                                        <div class="actions pull-right">
                                                        <a  href="#" onclick="loadmodal_add_grn();" title="Add GRN" class="btn btn-xs waves-effect waves-light btn-success m-b-5">
                                                        <i class="fa fa-plus"></i> Add </a>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="panel-body">
                                                    <div class="table-container">

                                                        <table class="table table-striped table-bordered table-hover" id="datatable_grn">
                                                            <thead>
                                                                <tr role="row" class="heading">
                                                                    <th width="10%">
                                                                        GRN ID
                                                                    </th>
                                                                    <th width="30%">
                                                                        PO Number
                                                                    </th>
                                                                    <th width="30%">
                                                                        Created&nbsp;Date
                                                                    </th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <!--TAB GRN End-->
                                    <!--Purchase Return Note Tab start-->
                                        <div class="tab-pane" id="tab_5">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <div class="caption">
                                                        <i class="icon-basket-loaded font-teal-500"></i>
                                                        <span class="caption-subject font-teal-500 bold uppercase">Purchase Return Notes</span>
                                                         <div class="actions pull-right">
                <!--                                        <a  href="#add-prn-note" data-toggle="modal" data-original-title="Add PRN" title="Add PRN" class="btn teal-500 btn-sm">
                                                            <i class="fa fa-plus"></i> Add </a>-->
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="panel-body">
                                                    <div class="table-container">

                                                        <table class="table table-striped table-bordered table-hover" id="datatable_prn">
                                                            <thead>
                                                                <tr role="row" class="heading">
                                                                    <th width="5%">
                                                                        PRN ID
                                                                    </th>
                                                                    <th width="5%">
                                                                        GRN ID
                                                                    </th>
                                                                    <th width="25%">
                                                                        PO Number
                                                                    </th>
                                                                    <th width="25%">
                                                                        Remarks
                                                                    </th>
                                                                    <th width="25%">
                                                                        Created&nbsp;Date
                                                                    </th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Purchase Return Note Tab end-->
                                    <!--TAB Delivery Start-->
                                    <div class="tab-pane" id="tab_3">
                                        <div class="portlet light">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-basket-loaded font-teal-500"></i>
                                                    <span class="caption-subject font-teal-500 bold uppercase">Delivery Status</span>
                                                </div>

                                            </div>
                                            <div class="panel-body">
                                                <div class="table-container">
                                                    <table class="table table-striped table-bordered table-hover" id="datatable_delivery">
                                                        <thead>
                                                            <tr role="row" class="heading">
                                                                <th width="20%">
                                                                    Batch No.
                                                                </th>
                                                                <th width="30%">
                                                                    Product 
                                                                </th>
                                                                <th width="20%">
                                                                    Total Cost
                                                                </th >
                                                                <th width="10%">
                                                                    Received Qty
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--TAB Delviery End-->


                                     <!--TAB payment advice Start-->
                                    <div class="tab-pane" id="tab_4">
                                        <div class="portlet light">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-basket-loaded font-teal-500"></i>
                                                    <span class="caption-subject font-teal-500 bold uppercase">Delivery Status</span>
                                                </div>



                                            </div>
                                            <div class="panel-body">
                                                <div class="table-container">
                                                    <table class="table table-striped table-bordered table-hover" id="datatable_advice">
                                                        <thead>
                                                            <tr role="row" class="heading">
                                                                <th width="20%">
                                                                    Payment Advice No.
                                                                </th>
                                                                <th width="20%">
                                                                    Invoice No. 
                                                                </th>
                                                                <th width="20%">
                                                                    Payment Advice Date:
                                                                </th >
                                                                <th width="20%">
                                                                    Created By
                                                                </th>
                                                                <th width="20%">
                                                                    Action
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--TAB advice End-->


                                    <!--Tab Content End-->
                                </div>
                            </div>
                            <!--Portlet Body End-->
                        </div>
                    </div>
                </div>    
    
                 </div>
            </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->


<!-- BEGIN SUPPLIER PRODUCTS MODAL FORM-->
<div class="modal fade" id="add-po-details" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Select Products</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-3">Product:</label>
                        <div class="col-md-9">
                            <select id="supplierproduct"  onchange="get_prudcts_rate();" class="form-control">
                                <option>Select</option>>
                            <?php foreach ($supplierproducts as $product){ ?>
                                <?php  if($product->product['id_products']): ?>
                                <option value ="<?php echo $product->product['id_products']; ?>"><?php echo $product->product['product_name']; ?></option>
                                <?php  endif; ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-3">Pack Quantity <span class="required" aria-required="true">*</span></label>
                        <div class="col-md-9">
                            <input id="pack_qty" type="number" min="1" placeholder="Quantity" class="form-control numeric" value="1"/>
                        </div>
                    </div>
                
                     <div class="form-group">
                        <label class="control-label col-md-3">Rate <span class="required" aria-required="true">*</span></label>
                        <div class="col-md-9">
                            <input id="rate" type="number" readonly  placeholder="Product Rate" class="form-control" value=""/>
                        </div>
                    </div>
                    
                    
                    
                </form>
                <div class="row">
                    <div class="col-md-12" style="text-align: right">
                        <button class="btn btn-sm btn-primary" onclick="addtolist('N');"><i class="fa fa-angle-down"></i> Add</button>
                    </div>
                </div>
                <input id="for_foc_qty" type="number"  class="form-control hidden" value=""/>
                
                <input id="foc_product_name" type="text"  class="form-control hidden" value=""/>
                <input id="foc_product_id" type="number"  class="form-control hidden" value=""/>
                <input id="foc_product_qty" type="number"  class="form-control hidden" value=""/>
                
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="foc_msg" style="display:none;margin-top: 10px;">
                            <p class="alert alert-info"></p>
                            <button class="btn btn-sm btn-primary pull-right" onclick="addtolist('Y');"><i class="fa fa-angle-down"></i> Add FOC</button>
                        </div>
                            

                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <table id="addproducttbl" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Pack Qty</th>
                                    <th>FOC Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="update_podetails();" type="button" class="btn btn-icon waves-effect waves-light btn-success m-b-5">Save to PO</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-danger m-b-5" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- BEGIN PURCHASE ORDER STATUS MODAL FORM-->
<div class="modal fade" id="po_status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php //echo $this->form->create(null, ['url' => ['controller'=>'Purchaseorders', 'action' => 'updatestatus', $po->id_purchase_orders]]);?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Select Status</h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-md-3">Status:</label>
                            <div class="col-md-9">
                                <select name="purchase_order_status_id" id="purchase_order_status_id"  class="form-control">
                                    <?php foreach($purchaseorderstatuses as $purchaseorderstatus) { ?>
                                        <option value="<?= $purchaseorderstatus->id_po_status;?>" <?php if($purchaseorderstatus->id_po_status==$po->purchase_order_status_id){ echo "selected='selected'"; }?>><?= $purchaseorderstatus->po_status;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <input type ="hidden" name="purchase_order_status" id="purchase_order_status" value="<?= $po->purchase_order_status; ?>"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Condition:</label>
                            <div class="col-md-9">
                                <select name="purchase_order_condition_id" id="purchase_order_condition_id" class="form-control">
                                    <?php foreach($purchaseorderconditions as $purchaseordercondition) { ?>
                                        <option value="<?= $purchaseordercondition->id_po_condition;?>" <?php if($purchaseordercondition->id_po_condition==$po->purchase_order_condition_id){ echo "selected='selected'"; }?>><?= $purchaseordercondition->po_condition;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <input type ="hidden" name="purchase_order_condition" id="purchase_order_condition" value="<?= $po->purchase_order_condition; ?>"/>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" onclick="loadmodal_update_status('<?php echo $po->id_purchase_orders; ?>');" class="btn btn-icon waves-effect waves-light btn-success m-b-5">Update</button>
                    <button type="button" class="btn btn-icon waves-effect waves-light btn-danger m-b-5" data-dismiss="modal">Close</button>
                </div>
        
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- BEGIN GRN ADD MODAL FORM-->
<div class="modal bs-modal-lg fade" id="add-grn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:1100px!important;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add New GRN</h4>
            </div>
            
            <div class="model-body">
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="col-md-3">
                           <div class="form-group">
                               <label class="control-label">Invoice No</label>
                               <input type="text" class="form-control" id="inv_number"   name="inv_no" placeholder="Invoice Number"  value="" />
                               </div>
                        </div> 
                        
                        
                        <div class="col-md-3">
                           <div class="form-group">
                               <label class="control-label">DC Number</label>
                                <input type="text" class="form-control" id="dc_number"  name="dc_no" placeholder="DC Number"  value=""/>

                               </div>
                        </div>
                        
                        <div class="col-md-3">
                           <div class="form-group">
                               <label class="control-label">DC Date</label>
                                 <input type="date" class="form-control" id="dc_date"  name="dc_date" placeholder="DC Date"  value="<?php echo date("m-d-Y"); ?>"/>
                               </div>
                        </div>
                        
                        
                        <div class="col-md-3">
                           <div class="form-group">
                               <label class="control-label">Bill Date</label>
                                 <input type="date" class="form-control" id="bill_date"  name="bill_date" placeholder="Bill Date"  value="<?php echo date("m-d-Y"); ?>"/>
                               </div>
                        </div>
                       
                     </div>
                    
                    <div class="col-md-12">
                         <div class="col-md-12">
                           <div class="form-group">
                                <input type="text" class="form-control" id="remarks"  name="remarks" placeholder="remarks"  value=""/>   
                               </div>
                        </div>
                    </div>
                    
                    
                    <input type="text" class="form-control hidden" name="suppliers_id" id="suppliers_id" value="<?php  echo $supplier->id_suppliers; ?>"/>   
                    
                 </div>   
            </div>
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="addgrntbl" class="table table-responsive">
                            <thead>
                                <tr>
                                    
                                    <th style="width:5%;">P.ID</th>
                                    <th style="width:10%;">Product Name</th>
                                    <th style="width:5%;">PO Qty</th>
                                                                      
                                    <th style="width:10%;">Units/Pack</th>
                                    <th style="width:10%;">Pack Price</th>
                                    <th style="width:10%;">Unit Price</th>
                                    
                                    <th style="width:8%;">Bonus</th>
                                    <th style="width:8%;">GST</th>
                                    <th style="width:8%;">Disc%</th>
                                    <th style="width:15%;">Sub Total</th>
                                    
                                    <th style="width:5%;">Expiry(Months)</th>
                                    <th style="width:5%;">Batch No<span class="required">*</span></th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($purchaseOrder[0]['po_details'] as $poDetail): ?>
                                <tr <?php  if($poDetail->foc_status === 'Y'){ echo 'class="warning" title="Its FOC product"'; } ?>>
                                    
                                    <td><?= h($poDetail->product_id); ?></td>
                                    <td><?= h($poDetail->product_name); ?> </td>
                                    <td><?= $poDetail->pack_qty; ?></td>
                                    
                                    <td><input type="number" min="0" id="rq<?= h($poDetail->product_id); ?>" onkeyup='calculate(<?= h($poDetail->product_id); ?>);' class='form-control numeric unit_qty' /></td>
                                    
                                    <td><input id="pp<?= h($poDetail->product_id); ?>" class='form-control numeric pack_price' readonly value="<?= $poDetail->pack_price; ?>" /></td>
                                    
                                    <td><input id="up<?= h($poDetail->product_id); ?>" class='form-control numeric unit_price' readonly value="<?= $poDetail->unit_price; ?>" /></td>
                                    
                                    <td><input id="bn<?= h($poDetail->product_id); ?>" onkeyup='calculate(<?= h($poDetail->product_id); ?>);' value="0" class='form-control numeric bonus' /></td>
                                               
                                    <td><input id="gst<?= h($poDetail->product_id); ?>" onkeyup='calculate_gst(<?= h($poDetail->product_id); ?>);' value="0" class='form-control float-number gst' /></td>
                                    
                                    <td><input id="dc<?= h($poDetail->product_id); ?>" value="0"  onkeyup='calculate_disc(<?= h($poDetail->product_id); ?>);' class='form-control float-number disc' /></td>
                                  
                                    <td><input id="tp<?= h($poDetail->product_id); ?>" class='form-control subtotal' /></td>
                                    
                                    <td><input value="<?php echo date("d-m-Y"); ?>" class='form-control numeric expiry' /></td>
                                    <td><input class='form-control batch' /></td>
                                    
                                </tr>
                                <?php endforeach; ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="add_po_grn();" type="button" class="btn btn-icon waves-effect waves-light btn-success m-b-5">Save GRN</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-danger m-b-5" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

    <div class="modal bs-modal-lg fade" id="add-prn-note" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width:1100px!important;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Add New PRN</h4>
                </div>

                <div class="model-body">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">GRN#</label>
                                    <input readonly type="text" class="form-control" id="grnnumber"  name="grnnumber" placeholder="GRN#"  value=""/>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">PURCHASE ORDER#</label>
                                    <input readonly type="text" class="form-control" id="pnumber"  name="pnumber" placeholder="PURCHASE ORDER#"  value=""/>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">PRN Date</label>
                                    <input type="date" class="form-control" id="prndate"  name="prndate" placeholder="PRN Date"  value="<?php echo date("m-d-Y"); ?>"/>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Remarks</label>
                                    <input type="text" class="form-control" id="prn_remarks"  name="prn_remarks" placeholder="remarks"  value=""/>   
                                </div>
                            </div>

                        </div>

                        <input type="text" class="form-control hidden" name="prn_suppliers_id" id="prn_suppliers_id" value="<?php echo $supplier->id_suppliers; ?>"/>   

                    </div>   
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="addprntbl" class="table table-responsive">
                                <thead>
                                    <tr>

                                        <th style="width:5%;">P.ID</th>
                                        <th style="width:10%;">Product Name</th>
                                        <th style="width:5%;">GRN Received Qty</th>
                                        <th style="width:2%;">Qty Return</th>
                                        <th style="display: none;"></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="addPRN();" type="button" class="btn btn-icon waves-effect waves-light btn-success m-b-5">Save PRN</button>
                    <button type="button" class="btn btn-icon waves-effect waves-light btn-danger m-b-5" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<!-- BEGIN ADVICE ADD MODAL FORM-->
<div class="modal bs-modal-lg fade" id="add-advice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add New Payment Advice</h4>
            </div>
            
            <div class="modal-body">
                
                <div class="row">
                    <input type="hidden" id="hidden_po_id" name="hidden_po_id">
                    <input type="hidden" id="hidden_id" name="hidden_id">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">PO Number</label>
                            <input type="text" class="form-control" id="po_number"  readonly name="po_number" placeholder="Invoice Number"  value="" />
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Supplier's Invoice Number</label>
                            <input type="text" class="form-control" id="invoice_number"  readonly name="invoice_number" placeholder="Invoice Number"  value=""/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label class="control-label">Select Date</label>
                        <div class="input-group date date-picker margin-bottom-5" data-date-format="dd-mm-yyyy">
                            <input type="text" id="paymentadvice_date" class="form-control form-filter" readonly name="paymentadvice_date" placeholder="Date">
                            <span class="input-group-btn">
                                <button class="btn" type="button"><i class="fa fa-calendar"></i></button>
                            </span>
                        </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <table id="addadvicetbl" class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width:12%">Product ID</th>
                                    <th style="width:15%">Product Name</th>
                                    <th style="width:10%">Received Pack Quantity</th>
                                    <th style="width:15%">Received Pack Price</th>
                                    <th style="width:15%">Sub Total</th>
                                    
                                </tr>
                            </thead>
                            
                            <tbody>
                              
                                
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="add_payment_advice();" type="button" class="btn btn-icon waves-effect waves-light btn-success m-b-5">Save Advice</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-danger m-b-5" data-dismiss="modal">Close</button>
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
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>    
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
<?= $this->Html->script('datatable.js') ?>  

<script>
  
    jQuery(document).ready(function () {
        
        $('.date-picker').datepicker({
            autoclose: true
        });
        
        $("#supplierproduct").select2();
        toastr.options = {
            closeButton: true,
            debug: false,
            newestOnTop: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            preventDuplicates: false,
            onclick: 'close'
        };

        
        $("#purchase_order_status_id").on("change", function(){
            $("#purchase_order_status").val($("#purchase_order_status_id option:selected").text());
        });
        
        $("#purchase_order_condition_id").on("change", function(){
            $("#purchase_order_condition").val($("#purchase_order_condition_id option:selected").text());
        });
        $("#purchase_order_condition").val($("#purchase_order_condition_id option:selected").text());
        
        $("#purchase_order_status").val($("#purchase_order_status_id option:selected").text());
        
    });
    
    function getpodetails(){
        $("#podetailstbl tbody").html('');
        po_id=$("#po_id").html();
        //save in table using ajax
        $.ajax({
        method: "POST",
        url: "<?php echo $this->Url->build(['controller'=> 'PoDetails', 'action' => 'getpodetails']); ?>",
        data: { 
            po_id: po_id
            },
        dataType: "json",
        cache: false,
        async: false,
        success: function(data) { 
            var mdata = data.podetails;
            var subtotal=0;
            var mhtml = "";
            for (x = 0; x < mdata.length; x++) {
                
                mhtml += '<tr>';
                mhtml += "<td>"+ mdata[x]['po_number'] +"</td>";
                mhtml += "<td>"+ mdata[x]['product_name'] +"</td>";
                mhtml += "<td>"+ mdata[x]['pack_qty'] +"</td>";
                mhtml += "<td>"+ mdata[x]['units_per_pack'] +"</td>";
                mhtml += "<td>"+ mdata[x]['pack_price'] +"</td>";
                mhtml += "<td>"+ mdata[x]['total_units'] +"</td>";
                mhtml += "<td>"+ mdata[x]['unit_price'] +"</td>";
                mhtml += "<td>"+ mdata[x]['total'] +"</td>";
                mhtml += "<td class='actions'><button onclick='delete_pod("+ mdata[x]['id_po_details'] +")' class='btn btn-icon btn-sm waves-effect waves-light btn-danger m-b-5'><i class='fa fa-trash'></i></button></td>"
                mhtml += '</tr>';
                subtotal= subtotal + mdata[x]['total'];
            }
           
            $("#podetailstbl tbody").append(mhtml);
            $("#txtsubtotal").val('Rs.'+subtotal);
        }
        });

    }
    
    function delete_pod(podid,p_id,po_id){
            if(podid > 0){
                $.ajax({
                    type: "POST",
                    url: "<?php echo $this->Url->build(['controller'=> 'PoDetails', 'action' => 'ajaxdelete']); ?>",
                    dataType:'json',
                    data: {podid: podid,p_id: p_id,po_id: po_id},
                    success: function(data) {
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
    
    function addtolist(id){
        if ($("#pack_qty").val() == "") {
            $("#pack_qty").val(0);
             return false;
        }
      
        var foc_product_qty =  $('#for_foc_qty').val();
        var qty = $('#pack_qty').val();
        if(id === 'Y'){
            if(qty >= foc_product_qty){
              var pid = $('#foc_product_id').val();
              var pname = $('#foc_product_name').val();
              var foc_qty = $('#foc_product_qty').val();  
              
            }else{
                toastr["error"]("Selected  product's quantity must be greater then or equal to FOC offer quanity.") ;
                return false;
            }
        }
         
        var exists = 0;
        if ($("#supplierproduct option:selected").val() > 0) {
            $('#addproducttbl').find("td.id").each(function(index) {
                if ($(this).html() === $("#supplierproduct option:selected").val()) {
                    exists = 1;
                }
            });
            var product_name = $("#supplierproduct option:selected").text();
            var product_id = $("#supplierproduct option:selected").val();
            var pack_qty = $("#pack_qty").val();
            var mhtml = "";
            if (exists == 0) {
                    mhtml+="<tr><td class='id'>" + product_id + "</td><td>" + product_name + "</td><td>" + pack_qty + "</td><td>" + 'N' + "</td><td><button onclick='removefromlist(" + product_id + ");' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button></td></tr>"
                    $("#addproducttbl tbody").append(mhtml);
                     
                     if(id === 'Y'){
                        mhtml = ""; 
                        mhtml+="<tr><td class='id'>" + pid + "</td><td>" + pname + "</td><td>" + foc_qty + "</td><td>" + 'Y' + "</td><td><button onclick='removefromlist(" + pid + ");' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button></td></tr>"
                        $("#addproducttbl tbody").append(mhtml);
                        console.log('ok');
                      }
                     
                } else {
                     toastr["error"]("Product is already added. To change Qty, first remove, then add again!","ALREADY ADDED") ;
                }
            
           
        }
    }
    
    function removefromlist(val){
        $('#addproducttbl').find("td.id").each(function(index) {
            if ($(this).html() == val) {
                $(this).closest('tr').remove();
            }
        });
    }
    
    function update_podetails(){
        
        var po_number = $("#ponumber").html();
        var po_id = $("#po_id").html();
                       
        var TableData;
        TableData = storeOTblValues()
        TableData = TableData; //$.toJSON(TableData);
        
        if (TableData.length > 0) {
            toastr["info"]("Updating", "Purchase order #" + po_number);
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller'=> 'PoDetails', 'action' => 'addpodetailproducts']); ?>",
                dataType:'json',
                data: {podetails: TableData, po_id: po_id, po_number:po_number,sp_id: <?php  echo $supplier->id_suppliers; ?>},
                success: function(data) {
                    var result = data.msg.split("|");
                    if (result[0] === "Success") {
                        toastr.success(result[0], result[1]);
                        $('#add-po-details').modal('hide');
                        location.reload();
                    } else {
                        toastr.warning(result[0], result[1]);                        
                    }
                }
            });
        } else {
            toastr["warning"]("Nothing Added", "Purchase order #" + po_number);
        }
    }
    
    function storeOTblValues(){
        var TableData = new Array();

        $('#addproducttbl tr').each(function(row, tr) {
            TableData[row] = {
                "product_id": $(tr).find('td:eq(0)').text()
                , "product_name": $(tr).find('td:eq(1)').text()
                , "pack_qty": $(tr).find('td:eq(2)').text()
                , "foc_status": $(tr).find('td:eq(3)').text()
            }
        });
        TableData.shift();  // first row will be empty - so remove
        return TableData;
    }
    
    //Purchase Return Note Function start....
       

        function deletePRN(id) {
           
                    if (id > 0) {
                        $.ajax({
                            type: "POST",
                            url: "<?php echo $this->Url->build(['controller' => 'PurchaseReturnNote', 'action' => 'ajaxdeleteprn']); ?>",
                            //dataType: 'json',
                            data: {prnid: id},
                            success: function (data) {
                                //var result = data.msg.split("|");
                               
                                if (data === 'Success') {
                                    //toastr.success(result[0], result[1]);
                                    toastr["success"]('The PRN detail has been deleted');
                                    getprnnote();
                                    location.reload();
                                } else {
                                    toastr["warning"]('The PRN detail has not been deleted');
                                    //toastr.warning(result[0], result[1]);
                                }
                            }
                        });
                    }
       
        }
        
        function printPRN(prnid) {
            toastr["info"]("Collecting PRN details", "Opening GRN")
            window.open("<?php echo $this->Url->build(['controller' => 'PurchaseReturnNote', 'action' => 'view']); ?>/" + prnid);
        }
        
        function set_prn(grn_id,po_id,supplier_id){
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->Url->build(['controller' => 'PurchaseReturnNote', 'action' => 'setPrnForSelectedGrn']); ?>',
                data: {grn_id: grn_id, po_id: po_id, supplier_id: supplier_id},
                dataType: "json",
                cache: false,
                async: true,
                success: function(data) {
                    var mhtml = "";
                    for (x = 0; x < data.length; x++) {
                        mhtml += '<tr>';
                        mhtml += '<td>' + data[x]['product_id'] + '</td>';
                        mhtml += '<td>' + data[x]['product_name'] + '</td>';
                        mhtml += '<td id="packid-'+ data[x]['product_id'] +'">' + data[x]['pack_qty'] + '</td>';
                        mhtml += '<td><input type="number" min="0" id="rqt' + data[x]['product_id'] + '" onkeyup="set_return_qty(' + grn_id + ', ' + po_id + ', ' + supplier_id + ',  ' + data[x]['product_id'] + ')" class="form-control numeric return_qty" /></td>';
                        mhtml += '<td style="display: none;">' + data[x]['GrnBatchNo'] + '</td>';
                        //mhtml += '<td><button type="button" product_id="' + data[x]['product_id'] + '" unit="' + data[x]['product_unit'] + '" total_qty="' + data[x]['total_qty'] + '" container_type="' + data[x]['Container Type'] + '" units_used="' + parseFloat(data[x]['Container Used']).toFixed(2) + '" service_count="' + data[x]['product_count'] + '" class="btn btn-sm btn-info usage_details_btn">View Details</button></td>';
                        mhtml += '</tr>';
                    }
                    $('#grnnumber').val(grn_id);
                    $('#pnumber').val(data[0]['po_number']);
                    $('#pnumber').attr('poid' ,po_id);
                    $('#addprntbl tbody').html('');
                    $('#addprntbl tbody').append(mhtml);//pnumber
                }
            });
            $('#add-prn-note').modal('show');
        }
        
        function set_return_qty(grn_id, po_id, supplier_id, productid){
            if(productid){
                var rqt = parseInt($('#rqt'+productid).val());//return qty..
                var pack_qty = parseInt($('#packid-'+productid).text());//current pack qty is showing..
                
                if(rqt > pack_qty){
                    //alert("Return qty can't be greater than current qty!");
                    toastr.warning("Return qty can't be greater than current qty!");
                    $('#rqt'+productid).val('');
                }else if(rqt === 0 || rqt < 0){
                    //alert("Return qty can't be less than OR equal to zero!");
                    toastr.warning("Return qty can't be less than OR equal to zero!");
                    $('#rqt'+productid).val('');
                }
            }
        }
        
        function addPRN() {
            if($('#prndate').val() !== "" || $('#prn_remarks').val() !== ""){
                var po_number = $('#pnumber').val();
                var po_id = $('#pnumber').attr('poid');
                var grn_id = $('#grnnumber').val();
                var date = $('#prndate').val();
                var remarks = $('#prn_remarks').val();
                var supplier_id = $('#prn_suppliers_id').val();

                var TableData;
                TableData = storeOTblValuesPrn()
               // TableData = $.toJSON(TableData);

                if (TableData.length > 0) {
                    toastr["info"]("Adding", "Purchase order #" + po_number);
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'PurchaseReturnNote', 'action' => 'addPrn']); ?>",
                        dataType: 'json',
                        data: {prndetails: TableData, po_id: po_id, po_number: po_number, grn_id: grn_id, date: date, remarks: remarks, supplier_id: supplier_id},
                        success: function (data) {
                            var result = data.msg.split("|");

                            if (result[0] === "Success") {
                                toastr.success(result[0], result[1]);
                                $('#add-prn-note').modal('hide');
                                location.reload();
                            } else {
                                toastr.warning(result[0], result[1]);
                            }
                        }
                    });
                } else {
                    toastr["warning"]("Nothing Added", "Purchase order #" + po_number);
                }
            }else{
                toastr["warning"]("Please Provide Date|Remarks|Qty");
            }
            
        }
        
        function storeOTblValuesPrn() {
            var TableData = new Array();

            $('#addprntbl tr').each(function (row, tr) {
                TableData[row] = {
                    "product_id": $(tr).find('td:eq(0)').text()
                    , "product_name": $(tr).find('td:eq(1)').text()
                    , "return_qty": $(tr).find('td:eq(3)').find('input').val()
                    , "grn_batch_no": $(tr).find('td:eq(4)').text()
                }
            });
            TableData.shift();  // first row will be empty - so remove
            return TableData;
        }
        //Purchase Return Note Function end......
    
    function getpogrn(){
           
           if($.fn.DataTable.isDataTable("#datatable_grn")){ 
               $("#datatable_grn").dataTable().fnDestroy();
            }
           //$('#myTable').dataTable().fnDestroy();
           
           var grnDataTable = $("#datatable_grn").dataTable({
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "stateSave": true,
                "ajax": {
                    "url": "<?php echo $this->Url->build(['controller'=>'PoGrn', 'action' => 'getpogrndatatable']); ?>", // ajax source
                    "type":"Post",
                    "data":{po_id:<?php echo $po->id_purchase_orders; ?>},
                    dataType: 'json'
                },
                "columnDefs": [{ // define columns sorting options(by default all columns are sortable extept the first checkbox column)
                    'orderable': true,
                    'targets': [0]
                }],
                "order": [
                    [0, "desc"]
                ], // set first column as a default sort by asc
                "columns": [
                        {"data": "id_po_grn"},
                        {"data": "po_number"},
                        {"data": "grn_dat"},
                        {"data": "actions"},
                    ]
            });
      
    }
    
    function add_po_grn(){
        var allgood=true;
        $('.rec_qty').each(function(){
            if($(this).val()==""){
                allgood=false;
            } 
        });
        
        $('.unit_qty').each(function(){
            if($(this).val()==""){
                allgood=false;
            } 
        });
        
        $('.pack_price').each(function(){
            if($(this).val()==""){
                allgood=false;
            } 
        });
        
        $('.expiry').each(function(){
            if($(this).val()==""){
                allgood=false;
            } 
        });
        
//        $('.batch').each(function(){
//            if($(this).val()==""){
//                allgood=false;
//            } 
//        });
        
        if($('#inv_number').val() == ''){
            allgood=false;
        }
        if($('#dc_number').val() == ''){
            allgood=false;
        }
        if($('#dc_date').val() == ''){
            allgood=false;
        }
        if($('#bill_date').val() == ''){
            allgood=false;
        }
        
       
        
        if(allgood==true){
            
            var po_number = $("#ponumber").html();
            var po_id = $("#po_id").html();
            var inv_no = $('#inv_number').val();
            var dc_no = $('#dc_number').val();
            var dc_date = $('#dc_date').val();
            var bill_date = $('#bill_date').val();
            var remarks = $('#remarks').val();
            var supp_id = $('#suppliers_id').val();
          
            var TableData;
            TableData = storeGRNTblValues()
            //TableData = $.toJSON(TableData);

            if (TableData.length > 0) {
                toastr["info"]("Adding New GRN", "Processing");
                $.ajax({
                    type: "POST",
                    url: "<?php echo $this->Url->build(['controller'=> 'PoGrnDetail', 'action' => 'addgrndetail']); ?>",
                    dataType:'json',
                    data: {grndetails: TableData, po_id: po_id, po_number:po_number,
                           inv_no:inv_no,
                           dc_no:dc_no,
                           dc_date:dc_date,
                           bill_date:bill_date,
                           remarks:remarks,
                           suppliers_id:supp_id },
                    success: function(data) {
                        var result = data.msg.split("|");

                        if (result[0] === "Success") {
                            toastr.success(result[0], result[1]);
                            $('#add-grn').modal('hide');
                            getpogrn();
                            
                        } else {
                            toastr.warning(result[0], result[1]);                        
                        }
                    }
                });
            } else {
                toastr["warning"]("Nothing Added", "Purchase order #" + po_number);
            }
        } else {
            swal({
                title: "Please enter all required fields for each item!",
                text: "",
                type: "error",
                confirmButtonText: 'OK!'
            });

        }
    }
    
    function storeGRNTblValues(){
        var TableData = new Array();

        $('#addgrntbl tr').each(function(row, tr) {
            TableData[row] = {
                "product_id": $(tr).find('td:eq(0)').text()
                , "product_name": $(tr).find('td:eq(1)').text()
                , "po_qty": $(tr).find('td:eq(2)').text()
                , "received_pack_qty": $(tr).find('td:eq(3)>input').val()
                , "received_pack_price": $(tr).find('td:eq(4)>input').val()
                , "received_unit_price": $(tr).find('td:eq(5)>input').val()
                
                , "bonus": $(tr).find('td:eq(6)>input').val()
                , "gst": $(tr).find('td:eq(7)>input').val()
                , "disc": $(tr).find('td:eq(8)>input').val()
                , "sub_total": $(tr).find('td:eq(9)>input').val()
                , "grn_item_expiry": $(tr).find('td:eq(10)>input').val()
                , "grn_batch_no": $(tr).find('td:eq(11)>input').val()
                
            }
        });
        TableData.shift();  // first row will be empty - so remove
       
        return TableData;
    }
    
    function deleteGRN(id){
      
                if(id > 0){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller'=> 'PoGrn', 'action' => 'ajaxdeletegrn']); ?>",
                        dataType:'json',
                        data: {grnid: id},
                        success: function(data) {
                            var result = data.msg.split("|");

                            if (result[0] === "Success") {
                                toastr.success(result[0], result[1]);
                                getpogrn();
                            } else {
                                toastr.warning(result[0], result[1]);                        
                            }
                        }
                    });
                }
     
    }
    
    function printGRN(grnid){
        toastr["info"]("Collecting GRN details", "Opening GRN")
        window.open("<?php echo $this->Url->build(['controller' => 'PoGrn', 'action' => 'view']); ?>/" + grnid);
    }
    
    function getdeliverystatus(){
           
           if($.fn.DataTable.isDataTable("#datatable_delivery")){ 
               $("#datatable_delivery").dataTable().fnDestroy();
            }
           
           var deliveryDataTable = $("#datatable_delivery").dataTable({
              
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "stateSave": true,
                "ajax": {
                    "url": "<?php echo $this->Url->build(['controller'=>'PoGrn', 'action' => 'getdeliverystatus']); ?>", // ajax source
                    "type":"Post",
                    "data":{po_id:<?php echo $po->id_purchase_orders; ?>},
                    dataType: 'json'
                },
                "columnDefs": [{ // define columns sorting options(by default all columns are sortable extept the first checkbox column)
                    'orderable': true,
                    'targets': [0]
                }],
                "order": [
                    [0, "desc"]
                ], // set first column as a default sort by asc
                "columns": [
                        {"data": "grn_batch_no"},
                        {"data": "grn_product_name"},
                        {"data": "Price"},
                        {"data": "Received"}
                    ]
            });
            var tableWrapper = $('#datatable_delivery_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
    }
    
    // save payment advice
    
    function add_payment_advice(){

       var po_id = $('#hidden_po_id').val();
       var id = $('#hidden_id').val();
       var invoice_number = $('#invoice_number').val();
       var po_number = $('#po_number').val();
       var paymentadvice_date = $('#paymentadvice_date').val();
       var supp_id = $('#suppliers_id').val();
       
       if(invoice_number === ''){
           toastr["error"]("Please enter supplier invoice.");
           return false;
       }

       if(paymentadvice_date === ''){
           toastr["error"]("Please enter date.");
           return false;
       }
       
      
       var TableData;
       TableData = storeAdviceTblValues();
       
       if (TableData.length > 0) {
           toastr["info"]("Adding New Payment Advice", "Processing");
           $.ajax({
               type: "POST",
               url: "<?php echo $this->Url->build(['controller'=> 'PaymentAdvice', 'action' => 'addadvicedetail']); ?>",
               dataType:'json',
               data: {
                   advicedetails : TableData,
                   invoice_number : invoice_number,
                   po_number : po_number,
                   po_id : po_id,
                   pa_date : paymentadvice_date,
                   supp_id : supp_id,
                   id : id
               },
               success: function(data) {
                   var result = data.msg.split("|");
                   if (result[0] === "Success") {
                       toastr.success(result[0], result[1]);
                       $('#add-advice').modal('hide');
                       location.reload();
                   } else {
                       toastr.warning(result[0], result[1]);
                       location.reload();
                   }
               }
           });
       } else {
           toastr["warning"]("Nothing Added", "Payment advice");
       }
   }
   
    function storeAdviceTblValues(){
        var TableData = new Array();
        $('#addadvicetbl tr').each(function(row, tr) {
            TableData[row] = {
                "product_id": $(tr).find('td:eq(0)').text()
                , "product_name": $(tr).find('td:eq(1)').text()
                , "received_pack_qty": $(tr).find('td:eq(2)').text()
                , "received_pack_price": parseInt($(tr).find('td:eq(3)').text().replace(',',''))
                , "st_price": parseInt($(tr).find('td:eq(4)').text().replace(',',''))
            }
           
        });
        TableData.shift();  // first row will be empty - so remove
        return TableData;
    }
    
    function getpaymentadvice(){

            if($.fn.DataTable.isDataTable("#datatable_advice")){ 
                $("#datatable_advice").dataTable().fnDestroy();
             }

            var adviceDataTable = $("#datatable_advice").dataTable({
                 "lengthMenu": [
                     [10, 20, 50, 100, 150, -1],
                     [10, 20, 50, 100, 150, "All"] // change per page values here
                 ],
                 "pageLength": 10, // default record count per page
                 "stateSave": true,
                 "ajax": {
                     "url": "<?php echo $this->Url->build(['controller'=>'PaymentAdvice', 'action' => 'getadvice']); ?>", // ajax source
                     "type":"Post",
                     "data":{po_id:<?php echo $po->id_purchase_orders; ?>},
                     dataType: 'json'
                 },
                 "columnDefs": [{ // define columns sorting options(by default all columns are sortable extept the first checkbox column)
                     'orderable': true,
                     'targets': [0]
                 }],
                 "order": [
                     [0, "desc"]
                 ], // set first column as a default sort by asc
                 "columns": [
                         {"data": "id_payment_advice"},
                         {"data": "invoice_number"},
                         {"data": "ad_date"},
                         {"data": "user"},
                         {"data": "actions"},
                     ]
             });

     }
//   
    function calc_details(id){
        var qty = $('#qty'+id).val() !== '' ? parseInt($('#qty'+id).val()) : 0;
        var u_price = parseFloat($('#u_price'+id).text());
        var t_price = u_price * qty;
        $('#t_price'+id).val(parseFloat(t_price).toFixed(2));
    }
   
    function get_prudcts_rate(foc){
        
         var product_id = $('#supplierproduct option:selected').val();
         var seelcted_product = $('#supplierproduct option:selected').text();
         if(seelcted_product == 'Select'){
             return false;
         }
         
         $('#rate').val('');
        
         $.ajax({
             type: "POST",
             url: "<?php echo $this->Url->build(['controller' => 'PoDetails', 'action' => 'getproductrate']); ?>",
             dataType: 'json',
             cache: false,
             async: false,
             data: {product_id:product_id, s_id:<?php  echo $supplier['id_suppliers']; ?>},
             success: function (data) {
                var mdata = data.product_rates;
                var focmsg = data.for_foc;
                $('#rate').val(mdata[0]['pack_price']);
                if(focmsg.length > 0){
                    
                $('#for_foc_qty').val(focmsg[0]['foc_for_qty']);    
                $('#foc_product_name').val(focmsg[0]['pname']);
                $('#foc_product_id').val(focmsg[0]['pid']);
                $('#foc_product_qty').val(focmsg[0]['foc_product_qty']);    
                    
                $('.foc_msg p').text('The selected product '+ seelcted_product +' is on offer. the offer is to purchase '+ focmsg[0]['foc_for_qty'] +' and get  '+ focmsg[0]['foc_product_qty'] +' '+ focmsg[0]['pname'] +' for free.');
                $('.foc_msg').fadeIn();
                
                }else{
                    $('#for_foc_qty').val('');    
                    $('#foc_product_name').val('');
                    $('#foc_product_id').val('');
                    $('#foc_product_qty').val('');    
                }
             }   

         });

     }

    function calculate(id){
       var qty = $('#rq'+id).val() !== '' ? parseInt($('#rq'+id).val()) : 0;
       var bonus = $('#bn'+id).val() !== '' ? parseInt($('#bn'+id).val()) : 0;
       var u_price = parseFloat($('#pp'+id).val());
       var total = qty + bonus;
       var t_price = total * u_price;
       
        $('#tp'+id).val(parseFloat(t_price).toFixed(2));
    }
    
//    function calculate_bonus(id){
//        
//       var qty  = $('#rq'+id).val() !== '' ? parseInt($('#rq'+id).val()) : 0;
//       var bonus = parseFloat($('#bn'+id).val());
//       var u_price = parseFloat($('#up'+id).val());
//       var totalqty = qty + bonus ;
//       
//       if(u_price == ''){
//          $('#bn'+id).val(0);
//       }else{
//        var t_price = u_price * totalqty;
//        $('#tp'+id).val(parseFloat(t_price).toFixed(2));
//       }
//              
//    }

    function calculate_disc(id){
      
       var qty = $('#rq'+id).val() !== '' ? parseInt($('#rq'+id).val()) : 0;
       var u_price = parseFloat($('#pp'+id).val());
       var t_price = u_price * qty;
       $('#tp'+id).val(parseFloat(t_price).toFixed(2)); 
      
      
       var amount = parseFloat($('#tp'+id).val());
       var gst  =  $('#dc'+id).val();
       var sub_total = parseFloat($('#tp'+id).val());
       var per =  (gst / 100) * amount;
       var totalamount = sub_total - per;
       
       if(per == '' || per == 0){
            var qty = $('#rq'+id).val() !== '' ? parseInt($('#rq'+id).val()) : 0;
            var u_price = parseFloat($('#pp'+id).val());
            var t_price = u_price * qty;
            $('#tp'+id).val(parseFloat(t_price).toFixed(2));
        } else{
            $('#tp'+id).val(parseFloat(totalamount).toFixed(2));
        }
    }
    
    function calculate_gst(id){
      
       var qty = $('#rq'+id).val() !== '' ? parseInt($('#rq'+id).val()) : 0;
       var u_price = parseFloat($('#pp'+id).val());
       var t_price = u_price * qty;
       $('#tp'+id).val(parseFloat(t_price).toFixed(2)); 
      
      
       var amount = parseFloat($('#tp'+id).val());
       var gst  =  $('#gst'+id).val();
       var sub_total = parseFloat($('#tp'+id).val());
       var per =  (gst / 100) * amount;
       var totalamount = sub_total + per;
       
       if(per == '' || per == 0){
            var qty = $('#rq'+id).val() !== '' ? parseInt($('#rq'+id).val()) : 0;
            var u_price = parseFloat($('#pp'+id).val());
            var t_price = u_price * qty;
            $('#tp'+id).val(parseFloat(t_price).toFixed(2));
        } else{
            $('#tp'+id).val(parseFloat(totalamount).toFixed(2));
        }
    }
    

    function adviveNOTE(id){
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'PoGrn', 'action' => 'getadvicedetails']); ?>",
            dataType: 'json',
            cache: false,
            async: false, 
            data: {id: id},
            success: function (data) {
                var mdata = data.poGrn;
                var mhtml = "";
                for (var x = 0; x < mdata['po_grn_detail'].length; x++) {
                    mhtml += '<tr>';
                    mhtml += "<td>"+ mdata['po_grn_detail'][x]['grn_product_id'] +"</td>";
                    mhtml += "<td>"+ mdata['po_grn_detail'][x]['grn_product_name'] +"</td>";
                    mhtml += "<td>"+ mdata['po_grn_detail'][x]['received_pack_qty'] +"</td>";
                    mhtml += "<td>"+ Number(mdata['po_grn_detail'][x]['received_pack_price']).toLocaleString('en') +"</td>";
                    mhtml += "<td>"+ Number(mdata['po_grn_detail'][x]['sub_total']).toLocaleString('en') +"</td>";
                    mhtml += '</tr>';
                }
                $("#addadvicetbl tbody").html(mhtml);
                
                $('#po_number').val(mdata['po_number'])
                $('#hidden_po_id').val(mdata['po_id'])
                $('#hidden_id').val(id)
                $('#invoice_number').val(mdata['inv_no'])
                $('#add-advice').modal('show');
                $("#paymentadvice_date").val($.datepicker.formatDate('dd-m-yy', new Date(mdata['bill_date'])));
                
            }   
        });          
    }
    
    function printAdvice(id){
        toastr["info"]("Collecting GRN details", "Opening GRN")
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

    function adviveOK(){
     toastr["error"]("Advice note already submitted.");
    
    }

  function loadmodal_add_grn(){
      
    var purchase_status_id = '<?php echo $po->purchase_order_status_id; ?>'; 
    if(purchase_status_id === '3'){
        $('#add-grn').modal({
              backdrop:'static',
              keyboard:false,
              show:true
        });
        
    } else{ 
        toastr["error"]('Sorry you can not create GRN, Untill PO status is "Recieved Pending Payment" ');
      } 
   }
      function getprnnote() {

            if ($.fn.DataTable.isDataTable("#datatable_prn")) {
                $("#datatable_prn").dataTable().fnDestroy();
            }
            //$('#myTable').dataTable().fnDestroy();

            var grnDataTable = $("#datatable_prn").dataTable({
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "stateSave": true,
                "ajax": {
                    "url": "<?php echo $this->Url->build(['controller' => 'PurchaseReturnNote', 'action' => 'getprnnotetable']); ?>", // ajax source
                    "type": "Post",
                    "data": {po_id:<?php echo $po->id_purchase_orders; ?>},
                    dataType: 'json'
                },
                "columnDefs": [{// define columns sorting options(by default all columns are sortable extept the first checkbox column)
                        'orderable': true,
                        'targets': [0]
                    }],
                "order": [
                    [0, "desc"]
                ], // set first column as a default sort by asc
                "columns": [
                    {"data": "id_prn_note"},
                    {"data": "grn_id"},
                    {"data": "po_number"},
                    {"data": "remarks"},
                    {"data": "created_date"},
                    {"data": "actions"},
                ]
            });

        }
    function loadmodal_add_po_product(id){
       
        imageOverlay('#add_p', 'show');
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'PoDetails', 'action' => 'checkexistinggrn']); ?>",
            dataType: 'json',
            data: {id: id},
            success: function (data) {
                var result = data.msg;
                if (result === "Yes") {
                    toastr.error("Sorry You can not add product,this PO's  GRN has been created.");
                } else {
                     $('#add-po-details').modal({
                        backdrop:'static',
                        keyboard:false,
                        show:true
                      });
                }
            }
        }); 
        imageOverlay('#add_p', 'hide');
   }
   
    function loadmodal_update_status(id){
        var purchase_order_status_id  = $('#purchase_order_status_id option:selected').val();
        var purchase_order_status  = $('#purchase_order_status_id option:selected').text();
        
        var purchase_order_condition  = $('#purchase_order_status_id option:selected').text();
        var purchase_order_condition_id  = $('#purchase_order_status_id option:selected').val();
        
        
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'Purchaseorders', 'action' => 'updatestatus']); ?>",
            dataType: 'json',
            data: {id: id,purchase_order_status_id:purchase_order_status_id,
                   purchase_order_status:purchase_order_status,
                   purchase_order_condition:purchase_order_condition,
                   purchase_order_condition_id:purchase_order_condition_id },
            success: function (data) {
                var result = data.msg;
                if (result === "Success") {
                    toastr.success("PO Status has been changed");
                    location.reload();
                } else {
                   // toastr.error("Sorry You can not add product,this PO's  GRN has been created.");
                }
            }
        }); 
      
   }
   
   
    
</script>
