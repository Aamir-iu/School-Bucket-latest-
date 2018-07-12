<?php if(!empty($data)){ $details = $data[0]; } else {$details = 0 ;} ?>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
   
      <div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <div class="portlet light">
            <div class="portlet-title">
                <span style="display:block; position:relative; text-align:left; ">
                    <?php echo $this->Html->image('logo.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top;width:50px;']); ?>
                     <span style="line-height:32px; font-size:30px; font-weight: bold; color:#EF4836 !important; vertical-align: top"><?php  echo $this->request->session()->read('Info.school'); ?></span>
<!--                     <span style=" display: inline-block;  position: relative;  left: 6px;  top: 0px;  width: 1px;  height: 41px;  background: #00bcd4 !important;"></span>
                     <span style=" position: relative;  display: inline-block;  font: 500 15px/15px 'asap', sans-serif;  letter-spacing: -0.025em;  color: #00bcd4 !important;  left: 6px;  top: -4px; text-align: left"><span style="display:block;">Address : <?php // echo $this->request->session()->read('Info.address'); ?><br/>Phone :<?php  //echo $this->request->session()->read('Info.phone'); ?></span></span>-->
             </span> 
                
                <div class="caption">
                    <i class="fa fa-shopping-cart"></i>

                    <span class="caption-subject font-teal-500 bold uppercase">
                        Order #<?php
                        $po = $purchaseOrder[0];
                        ?> 
                        <span id="ponumber" ><?php echo $po->purchase_order_number; ?></span>
                    </span>
                    <span class="caption-helper"><?php echo $po->po_date; ?></span>
                    
                    <div class="tools pull-right">
                        <a href="javascript:window.print()" class="fa fa-print hidden-xs" data-original-title="" title="Print">
                        </a>
                         <a href="<?php echo $this->Url->build(['controller' => 'PoDetails', 'action' => 'openPO', $po->id_purchase_orders]); ?>" class="fa fa-reply hidden" data-original-title="" title="Back">
                    </a>
                    </div>
                    
                </div>

              
            </div>
            
            <div class="portlet-body">
                <div class="row">
                    <!--Order Details-->
                    <div class="col-md-6 col-sm-6 col-xs-6">

                       <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="caption">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="caption-subject font-teal-500 bold uppercase">Order Details </span>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row static-info">
                                    <div class="col-md-5 col-sm-5 col-xs-5 name">
                                        Order #:
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7 value">
                                        <?php echo $po->purchase_order_number; ?> 
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 col-sm-5 col-xs-5 name">
                                        Date:
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7value">
                                        <?php echo date("d-m-Y H:i:s A", strtotime($po->purchase_order_date)); ?> 
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 col-sm-5 col-xs-5 name">
                                        Status:
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7 value">
                                       <?php echo $po->purchase_order_status; ?> 
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 col-sm-5 col-xs-5 name">
                                        Grand Total:
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7 value">
                                        Rs.<?= $this->Number->format($po->subtotal + $po->taxes);?> 
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 col-sm-5 col-xs-5 name">
                                        Total Items:
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7 value">
                                        <?php foreach($purchaseOrder[0]['items'] as $items){echo $items;} ?>
                                    </div>
                                </div>
                                
                                 <div class="row static-info">
                                    <div class="col-md-5 col-sm-5 col-xs-5 name">
                                        Total Items:
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7 value">
                                       <?php echo $po->po_reason; ?> 
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!--End Order Details-->

                    <!--Supplier Info-->
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="caption">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="caption-subject font-teal-500 bold uppercase">Supplier Address</span>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row static-info">
                                    <div class="col-md-12 value">

                                        <?php echo $po->supplier['supplier_name']; ?><br>
                                        <?php echo $po->supplier['supplier_address']; ?><br>
                                        <?php echo $po->supplier['contact_person']; ?><br>
                                        <?php echo $po->supplier['email']; ?><br>
                                        T: <?php echo $po->supplier['phone1']; ?><br>
                                        F: <?php echo $po->supplier['phone2']; ?><br>
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
                                
                            </div>
                            <div class="portlet-body">
                                 
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="table-responsive">
                                            <table id="podetailstbl" class="table table-hover table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">S.No.</th>
                                                        <th scope="col">Product Name</th>
                                                        <th scope="col">Pack Qty</th>
                                                        <th scope="col">Units per pack</th>
                                                        <th scope="col">Pack Price (Rs.)</th>
                                                        <th scope="col">Units Qty</th>
                                                        <th scope="col">Unit Price (Rs.)</th>
                                                        <th scope="col">Subtotal (Rs.)</th>
                                                        <th scope="col">Tax (Rs.)</th>
                                                        <th scope="col">Total (Rs.)</th>

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
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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
                      
            </div>
            <!--Portlet Body End-->
        </div>
    </div>
</div>
      
      
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<script>
  
//   $(document).ready(function(){
//     window.print();
//    });
   
  function goBack() {
    window.history.back();
  }  
  
   
    
</script>    