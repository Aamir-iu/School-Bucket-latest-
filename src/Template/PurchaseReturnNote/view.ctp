
<div class="row">
    <div class="col-md-10">
        <!-- Begin: life time stats -->
        <div class="portlet light">
            <div class="portlet-title">
                <span style="display:block; position:relative; text-align:left; ">
                    <?php echo $this->Html->image('new_logo.png', ['alt' => 'logo-default', 'style' => 'vertical-align:top']); ?>
<!--                    <span style="line-height:42px; font-size:41px; font-weight: bold; color:#EF4836 !important; vertical-align: top">Dr. Essa</span>
                    <span style=" display: inline-block;  position: relative;  left: 6px;  top: 0px;  width: 1px;  height: 41px;  background: #00bcd4 !important;"></span>
                    <span style=" position: relative;  display: inline-block;  font: 700 17px/17px 'asap', sans-serif;  letter-spacing: -0.025em;  color: #00bcd4 !important;  left: 6px;  top: -4px; text-align: left"><span style="display:block;">Laboratory<br/>& Diagnostic</span></span>-->
                </span>

                <div class="caption">
                    <strong> Purchase Return Note </strong>
                </div>

                <div class="tools">
                    <a href="javascript:window.print()" class="fa fa-print hidden-sm hidden-xs" data-original-title="" title="Print">
                    </a>
                    <a href="<?php echo $this->Url->build(['controller' => 'PoDetails', 'action' => 'openPO', $purchaseReturnNote->po_id]); ?>" class="fa fa-reply hidden" data-original-title="" title="Back">
                    </a>

                </div>
            </div>
           
            <div class="row">
                   <!--Voucher Details-->
                    <div class="col-md-12">
                        <div class="row">
                            <!--Order Details-->
                            <div class="col-xs-6 col-sm-6">
                                <div class="portlet light">
                                    <div class="portlet-title cyan">
                                        <div class="caption">
                                            <span class="caption-subject font-teal-500 bold uppercase">Details</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="row static-info">
                                            <div class="col-md-5 col-sm-6 col-xs-4 name">
                                                GRN #:
                                            </div>
                                            <div class="col-md-7 col-sm-6 col-xs-8 value">
                                                <?= $purchaseReturnNote->grn_id ?> 
                                            </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 col-sm-6 col-xs-4 name">
                                                PO #:
                                            </div>
                                            <div class="col-md-7 col-sm-6 col-xs-8 value">
                                                <?= $purchaseReturnNote->po_number ?> 
                                            </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 col-sm-6 col-xs-4 name">
                                                Supplier:
                                            </div>
                                            <div class="col-md-7 col-sm-6 col-xs-8 value">
                                                <?= $purchaseReturnNote->supplier['supplier_name'] ?>
                                            </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 col-sm-6 col-xs-4 name">
                                                Address:
                                            </div>
                                            <div class="col-md-7 col-sm-6 col-xs-8 value">
                                                <?= $purchaseReturnNote->supplier['supplier_address'] ?>
                                            </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 col-sm-6 col-xs-4 name">
                                                Reason:
                                            </div>
                                            <div class="col-md-7 col-sm-6 col-xs-8 value">
                                                <?= $purchaseReturnNote->remarks; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Order Details-->

                            <!--Supplier Info-->
                            <div class="col-xs-6 col-sm-6">
                                <div class="portlet light">
                                    <div class="portlet-title cyan">
                                        <div class="caption">
                                            <span class="caption-subject font-teal-500 bold uppercase">Details</span>
                                        </div>

                                    </div>
                                    <div class="portlet-body">
                                        <div class="row static-info">
                                            <div class="col-md-5 col-sm-6 col-xs-4 name">
                                                Phone:
                                            </div>
                                            <div class="col-md-7 col-sm-6 col-xs-8 value">
                                                <?= $purchaseReturnNote->supplier['phone1'] ?>
                                            </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 col-sm-6 col-xs-4 name">
                                                Email:
                                            </div>
                                            <div class="col-md-7 col-sm-6 col-xs-8 value">
                                                <?= $purchaseReturnNote->supplier['email'] ?>
                                            </div>
                                        </div>
                                        
                                        <div class="row static-info">
                                            <div class="col-md-5 col-sm-6 col-xs-4 name">
                                                Date:
                                            </div>
                                            <div class="col-md-7 col-sm-6 col-xs-8 value">
                                                <?php echo date('d-m-Y h:i A', strtotime($purchaseReturnNote->date)); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Supplier Info-->
                        </div>
                    </div>
                    <!--End Voucher Details-->
                
                
                <div class="col-md-12">
                    <div class="portlet light">
                        <div class="portlet-body">
                            <div class="table-responsive">
                                <table id="podetailstbl" class="table table-hover table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Product Id</th>
                                            <th>Product Name</th>
                                            <th>Returned Qty</th>
                                            <th>Batch No</th>
              
                                        </tr>
                                    </thead>
                                  
                                    <?php //echo "<pre>"; print_r($purchaseReturnNote['purchase_return_note_detail'][0]->product_id); ?>
                                    
                                    <?php $x=1; foreach ($purchaseReturnNote['purchase_return_note_detail'] as $poGrnDetail): ?>
                                        <tr>
                                            <td><?= $x; ?></td>
                                            <td><?= h($poGrnDetail->product_id) ?></td>
                                            <td><?= h($poGrnDetail->product_name) ?></td>
                                            <td><?= h($poGrnDetail->qty_returned) ?></td>
                                            <td><?= h($poGrnDetail->grn_batch_no); ?></td>
          
                                        </tr>
                                    <?php $x++; endforeach; ?>
                                </table>
                                
                                <br>
                                
                                 <div>
                                    
                                    <p>Prepared by:_______________ Verified by:__________ &nbsp; Approved by:__________ &nbsp; Received by:__________</p>
                                    
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          
        </div>
    </div>
</div>
