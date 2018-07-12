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
                    <strong> Goods Received Note </strong>
                </div>

                <div class="tools">
                    <a href="javascript:window.print()" class="fa fa-print hidden-sm hidden-xs" data-original-title="" title="Print">
                    </a>
                    <a href="<?php echo $this->Url->build(['controller' => 'PoDetails', 'action' => 'openPO', $poGrn->po_id]); ?>" class="fa fa-reply hidden" data-original-title="" title="Back">
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
                                                <?= $poGrn->id_po_grn ?> 
                                            </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 col-sm-6 col-xs-4 name">
                                                PO #:
                                            </div>
                                            <div class="col-md-7 col-sm-6 col-xs-8 value">
                                                <?= $poGrn->po_number ?> 
                                            </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 col-sm-6 col-xs-4 name">
                                                Supplier:
                                            </div>
                                            <div class="col-md-7 col-sm-6 col-xs-8 value">
                                                <?= $poGrn->supplier['supplier_name'] ?>
                                            </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 col-sm-6 col-xs-4 name">
                                                Address:
                                            </div>
                                            <div class="col-md-7 col-sm-6 col-xs-8 value">
                                                <?= $poGrn->supplier['supplier_address'] ?>
                                            </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 col-sm-6 col-xs-4 name">
                                                Reason:
                                            </div>
                                            <div class="col-md-7 col-sm-6 col-xs-8 value">
                                                <?= $poGrn->purchase_order['po_reason']; ?>
                                            </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 col-sm-6 col-xs-4 name">
                                                Inv#:
                                            </div>
                                            <div class="col-md-7 col-sm-6 col-xs-8 value">
                                                <?= $poGrn->inv_no ?>
                                            </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 col-sm-6 col-xs-4 name">
                                                Remarks:
                                            </div>
                                            <div class="col-md-7 col-sm-6 col-xs-8 value">
                                                <?= $poGrn->remarks ?>
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
                                                <?= $poGrn->supplier['phone1'] ?>
                                            </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 col-sm-6 col-xs-4 name">
                                                Email:
                                            </div>
                                            <div class="col-md-7 col-sm-6 col-xs-4 value">
                                                <?= $poGrn->supplier['email'] ?>
                                            </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 col-sm-6 col-xs-4 name">
                                                DC#:
                                            </div>
                                            <div class="col-md-7 col-sm-6 col-xs-8 value">
                                                <?= $poGrn->dc_no ?> 
                                            </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 col-sm-6 col-xs-4 name">
                                                Date:
                                            </div>
                                            <div class="col-md-7 col-sm-6 col-xs-8 value">
                                                <?php echo date('d-m-Y h:i A', strtotime($poGrn->grn_date)); ?>
                                            </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 col-sm-6 col-xs-4 name">
                                                Bill Date:
                                            </div>
                                            <div class="col-md-7 col-sm-6 col-xs-8 value">
                                                <?php echo date('d-m-Y h:i A', strtotime($poGrn->bill_date)); ?>
                                            </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 col-sm-6 col-xs-4 name">
                                                DC Date:
                                            </div>
                                            <div class="col-md-7 col-sm-6 col-xs-8 value">
                                                <?php echo date('d-m-Y h:i A', strtotime($poGrn->dc_date)); ?>
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
                                            <th>Product Name</th>
                                            <th>Pack Quantity</th>
                                            <th>Pack Price</th>
                                            <th>Bonus</th>
                                            <th>Gst</th>
                                            <th>Disc%</th>
                                            <th>Amount</th>
              
                                        </tr>
                                    </thead>
                                    <?php $x=1; $total_amount = 0; foreach ($poGrn->po_grn_detail as $poGrnDetail): ?>
                                        <tr>
                                            <td><?= $x ?></td>
                                            <td><?= h($poGrnDetail->grn_product_name) ?></td>
                                            <td><?= h($poGrnDetail->received_pack_qty) ?></td>
                                            <td style="text-align:right;"><?= $this->Number->precision($poGrnDetail->received_pack_price, 2) ?></td>
                                            <td><?= h($poGrnDetail->bonus) ?></td>
                                            <td><?= h($poGrnDetail->gst) ?></td>
                                            <td style="text-align:right;"><?= h($poGrnDetail->disc)."%" ?></td>
                                            <td style="text-align:right;"><?= $this->Number->precision($poGrnDetail->sub_total, 2); ?></td>
                                            <?php  $total_amount += $poGrnDetail->sub_total; ?>
          
                                        </tr>
                                    <?php $x++; endforeach; ?>
                                </table>
                                
                                <table id="podetailstbl" class="table  table-responsive">
                                    <tr  style="text-align: right;">
                                        <td>Total Amount</td>
                                        <td><?php if(!empty($total_amount)){ echo $this->Number->precision($total_amount,2); } ?></td>
                                    </tr>
                                    
                                    
                                </table>
                                
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
