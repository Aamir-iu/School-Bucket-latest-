<div class="row">
    <div class="col-md-10">
        <!-- Begin: life time stats -->
        <div class="portlet light">
            <div class="portlet-title">
                <span style="display:block; position:relative; text-align:left; ">
                    <?php echo $this->Html->image('new_logo.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top']); ?>
                </span>
                <div class="caption">
                    <i class="icon-basket font-teal-500"></i>
                    <span class="caption-subject font-teal-500 bold uppercase">Payment Advice Note </span>
                </div>
                <div class="tools">
                    <a href="javascript:window.print()" class="fa fa-print hidden-xs" data-original-title="" title="Print">
                    </a>
                     <a href="javascript:(0);" onclick="goBack()" class="fa fa-reply hidden" data-original-title="" title="Back">
                    </a>
                </div>
            </div>
            
            <?php $DD = $data[0]; ?> 
            
            <div class="portlet-body">
                <div class="row">
                    <!--Dispatch Details-->
                    <div class="col-xs-6">
                        <div class="portlet light">
                            <div class="portlet-body">
                                <div class="row static-info">
                                    <div class="col-md-5 col-sm-5 col-xs-6 name">Payment Advice ID:</div>
                                    <div class="col-md-7 col-sm-7 col-xs-6 value"><?php echo $DD['id_payment_advice']; ?></div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 col-sm-5 col-xs-6 name">GRN ID:</div>
                                    <div class="col-md-7 col-sm-7 col-xs-6 value"><?php echo $DD['grn_id']; ?></div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 col-sm-5 col-xs-6 name">PO #:</div>
                                    <div class="col-md-7 col-sm-7 col-xs-6 value"><?php echo $DD['po_number']; ?></div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 col-sm-5 col-xs-6 name">Date:</div>
                                    <div class="col-md-7 col-sm-7 col-xs-6 value"><?php echo $DD->advice_date; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="portlet light">
                            <div class="portlet-body">
                                <div class="row static-info">
                                    <div class="col-md-5 col-sm-5 col-xs-6 name">Supplier Name:</div>
                                    <div class="col-md-7 col-sm-7 col-xs-6 value"><?php echo $data[0]->supplier['supplier_name']; ?></div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 col-sm-5 col-xs-6 name">Supplier Address:</div>
                                    <div class="col-md-7 col-sm-7 col-xs-6 value"><?php echo $data[0]->supplier['supplier_address']; ?></div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 col-sm-5 col-xs-6 name">Contact Person:</div>
                                    <div class="col-md-7 col-sm-7 col-xs-6 value"><?php echo $data[0]->supplier['contact_person']; ?></div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 col-sm-5 col-xs-6 name">Supplier Phone1:</div>
                                    <div class="col-md-7 col-sm-7 col-xs-6 value"><?php echo $data[0]->supplier['phone1']; ?></div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 col-sm-5 col-xs-6 name">Supplier Phone2:</div>
                                    <div class="col-md-7 col-sm-7 col-xs-6 value"><?php echo $data[0]->supplier['phone2']; ?></div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 col-sm-5 col-xs-6 name">Supplier Email:</div>
                                    <div class="col-md-7 col-sm-7 col-xs-6 value"><?php echo $data[0]->supplier['email']; ?></div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 col-sm-5 col-xs-6 name">Supplier Website:</div>
                                    <div class="col-md-7 col-sm-7 col-xs-6 value"><?php echo $data[0]->supplier['website']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Dispatch Details-->
                </div>
                <!--End Top Section Tab 1-->

                
                <!-- Dispatcjed Details (Product List)-->
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject font-teal-500 bold uppercase">Details</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-responsive">
                                    <table id="podetailstbl" class="table table-hover table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Product ID</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Received Pack Quantity</th>
                                                <th scope="col">Received Pack Price</th>
                                                <th scope="col">Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total_amount=0;  foreach ($data[0]->payment_advice_details as $RDetail): ?>
                                            <tr>
                                                <td><?= h($RDetail->product_id); ?></th>
                                                <td><?= h($RDetail->product_name); ?> </td>
                                                <td><?= h($RDetail->pack_qty); ?></th>
                                                <td style="text-align:right"><?= $this->Number->precision($RDetail->pack_price,2); ?></th>
                                                <td style="text-align:right"><?= $this->Number->precision($RDetail->sub_total,2); ?></th>    
                                            </tr>
                                            <?php $total_amount += $RDetail->sub_total;  endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="text-right" colspan="4"><strong>Total Amount</strong></td>
                                                <td class="text-right"><strong><?php echo $this->Number->precision($total_amount,2); ?></strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    
                                    <div style="margin-top: 60px;">
                                    
                                    <p>Prepared by:_______________ Verified by:__________ &nbsp; Approved by:__________ &nbsp; Received by:__________</p>
                                    
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

<script>
  function goBack() {
    window.history.back();
  }  
    
</script>    
