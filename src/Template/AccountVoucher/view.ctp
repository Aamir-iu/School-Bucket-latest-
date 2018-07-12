<style>
    @media all {
        .page-break{ display: none; }
        .pb{display: none;}
/*        .fontset{font-size: 12px;}*/
    }

    @media print {
        .page-break{ display: block; page-break-before: always; }
        .pb{display: block;}
/*        .fontset{font-size: 12px;}*/
    }
</style>
<?php if(!empty($data)){ $details = $data[0]; } else {$details = 0 ;} ?>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
   
    <div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <div class="portlet light">
            <div class="portlet-title" style="margin-bottom: 0px; border-bottom: 0px">
                <span style="display:block; position:relative; text-align:left; ">
               <?php if($this->request->session()->read('Info.full_logo') === 'No'): ?>
                
                    <?php echo $this->Html->image('logo.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top;width:50px;']); ?>
                     <span style="line-height:32px; font-size:30px; font-weight: bold; color:#EF4836 !important; vertical-align: top"><?php  echo $this->request->session()->read('Info.school'); ?></span>
                     <span style=" display: inline-block;  position: relative;  left: 6px;  top: 0px;  width: 1px;  height: 41px;  background: #00bcd4 !important;"></span>
                     <span style=" position: relative;  display: inline-block;  font: 500 15px/15px 'asap', sans-serif;  letter-spacing: -0.025em;  color: #00bcd4 !important;  left: 6px;  top: -4px; text-align: left"><span style="display:block;">Address : <?php  echo $this->request->session()->read('Info.address'); ?><br/>Phone :<?php  echo $this->request->session()->read('Info.phone'); ?></span></span>
                <?php else: ?>     
               <?php echo $this->Html->image('logo2.png', ['alt' => 'logo-default', 'style'=>'vertical-align:top;width:100%;']); ?>
                     
               <?php endif; ?>       
                     
            </span> 
                <?php $voucher_details = $accountvoucher[0]; ?>
                <?php $voucher_type = $accountvoucher[0]; ?>
                <div class="caption">
                    <i class="font-teal-500"></i>
                    <span class="caption-subject font-teal-500 bold uppercase">
                        <strong><?php echo $voucher_details['vouchertype']; ?></strong>
                    </span>
                    <span class="caption-helper"></span>
                     <div class="tools pull-right">
                    <a href="javascript:window.print()" class="fa fa-print hidden-xs hidden-sm" data-original-title="" title="Print">
                    </a>
                    <a href="javascript:(0);" onclick="goBack()" class="fa fa-reply hidden" data-original-title="" title="Back">
                    </a>
                </div>
                </div>
               
            </div>

            <div class="portlet-body fontset">
                <div class="row <?php if(isset($voucher_details['vouchertype']) && $voucher_details['vouchertype'] === "Payment Voucher"){ ?>payment_voucher<?php } ?>">
                    <!--Voucher Details-->
                    <div class="col-xs-12">
                        <div class="row clearfix">
                            <div class="col-xs-6">
                                <p><b>Voucher Number#</b> : <?php echo $voucher_details['voucher_number']; ?></p>
                                <p><b>Prepared Date</b> : <?php echo date('d-m-Y h:i A', strtotime($voucher_details['voucher_date_created'])); ?></p>
                                <p><b>Voucher Type</b> : <?php echo $voucher_details['vouchertype']; ?></p>
                                <p><b>Voucher Status</b> : <?php echo $voucher_details['voucher_status']; ?></p>
                            </div>
                            <div class="col-xs-6">
                                <p><b>Business Partner</b> : <?php echo $voucher_details['bp_name']; ?></p>
                                <p><b>Description</b> : <?php echo $voucher_details['description']; ?></p>
                                <p><b>Cost Center</b> : <?php echo $accountvoucher[0]['center_name']; ?></p>
                                <p><b>Voucher Date</b> : <?php echo $accountvoucher[0]['voucher_dated']; ?></p>

                            </div>
                        </div>
                    </div>
                    <!--End Voucher Details-->

                    <!--                    <div class="col-xs-12">&nbsp;</div>-->

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="portlet-body">
                            <div class="table-responsive">
                                <table id="transactiontable" class="table table-hover table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="hidden">Details ID</th>
                                            <th scope="col" width="15%">Account Number</th>
                                            <th scope="col" width="15%">Account Title</th>
                                            <th scope="col" width="10%">Payment Mode</th>
                                            <th scope="col" width="10%">Instrument #</th>
                                            <th scope="col" width="20%">Remarks</th>
                                            <th scope="col" width="10%" class="text-primary">Debit</th>
                                            <th scope="col" width="10%" class="text-primary">Credit</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $debit = 0;
                                        $credit = 0;
                                        
                                        $grossamount = 0;
                                        $othertax = 0;
                                        $withholding = 0;
                                        
                                        ?>
                                        <?php foreach ($accountvoucher as $v_details): ?>

                                            <?php if ($v_details['type'] == 'Debit'): ?>
                                                <tr>

                                                    <td><?php echo $v_details['main_account_no'] . "-" . $v_details['control_account_no'] . "-" . $v_details['sub_account_no'] . "-" . $v_details['trans_account_no']; ?> </td>
                                                    <td><?php echo $v_details['trans_account_title']; ?></td>
                                                    <td><?php echo $v_details['paymentmode']; ?></td>
                                                    <td><?php echo $v_details['instrument_no']; ?></td>
                                                    <td style="display:none;"><?php echo $v_details['center_type']; ?></td>
                                                    <td><?php echo $v_details['remakrs']; ?> </td>
                                                    <td  style='text-align:right;'><?php
                                                        if ($v_details['type'] == 'Debit') {
                                                            echo $this->Number->precision($v_details['debit'], 2);
                                                            $debit += $v_details['debit'];
                                                        } else {
                                                            echo "-";
                                                        }
                                                        ?> </td>
                                                    <td style='text-align:right;'><?php
                                                        if ($v_details['type'] == 'Credit') {
                                                            echo $this->Number->precision($v_details['credit'], 2);
                                                            $credit += $v_details['credit'];
                                                            
                                                            if ($v_details['trans_account_no'] == '0017' || $v_details['trans_account_no'] == '0018') {
                                                                $othertax += $v_details['credit'];
                                                            }elseif($v_details['trans_account_no'] == '0036' || $v_details['trans_account_no'] == '0037'){
                                                                $withholding  += $v_details['credit'];
                                                            }
                                                            else{
                                                               $grossamount += $v_details['credit'];
                                                            }
                                                            
                                                        } else {
                                                            echo "-";
                                                        }
                                                        ?> </td>

                                                </tr>

                                            <?php endif; ?>


                                        <?php endforeach; ?>

                                        <?php //$debit = 0; $credit = 0;   ?>
                                        <?php foreach ($accountvoucher as $v_details): ?>

                                            <?php if ($v_details['type'] == 'Credit'): ?>
                                                <tr>

                                                    <td><?php echo $v_details['main_account_no'] . "-" . $v_details['control_account_no'] . "-" . $v_details['sub_account_no'] . "-" . $v_details['trans_account_no']; ?> </td>
                                                    <td><?php echo $v_details['trans_account_title']; ?></td>
                                                    <td><?php echo $v_details['paymentmode']; ?></td>
                                                    <td><?php echo $v_details['instrument_no']; ?></td>
                                                    <td style="display:none;"><?php echo $v_details['center_type']; ?></td>
                                                    <td><?php echo $v_details['remakrs']; ?> </td>
                                                    <td  style='text-align:right;'><?php
                                                        if ($v_details['type'] == 'Debit') {
                                                            echo $this->Number->precision($v_details['debit'], 2);
                                                            $debit += $v_details['debit'];
                                                        } else {
                                                            echo "-";
                                                        }
                                                        ?> </td>
                                                    <td style='text-align:right;'><?php
                                                        if ($v_details['type'] == 'Credit') {
                                                            echo $this->Number->precision($v_details['credit'], 2);
                                                            $credit += $v_details['credit'];
                                                            
                                                            if ($v_details['trans_account_no'] == '0017' || $v_details['trans_account_no'] == '0018') {
                                                                $othertax += $v_details['credit'];
                                                            }elseif($v_details['trans_account_no'] == '0036' || $v_details['trans_account_no'] == '0037'){
                                                                $withholding  += $v_details['credit'];
                                                            }
                                                            else{
                                                               $grossamount += $v_details['credit'];
                                                            }
                                                            
                                                            
                                                        } else {
                                                            echo "-";
                                                        }
                                                        ?> </td>

                                                </tr>

                                            <?php endif; ?>


                                        <?php endforeach; ?>             




                                    </tbody>
                                </table>
                                <table style="margin-top:-20px;" id="tbltotals" class="table table-hover table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <td width='70%' style='text-align:right; text-weight:bold'>Totals:</td>
                                            <td style='text-align:right; font-weight:bold;' class='totaldebit' width='10%'><?php
                                                if (isset($debit)) {
                                                    echo $this->Number->precision($debit, 2);
                                                }
                                                ?></td>
                                            <td style='text-align:right; font-weight: bold;' class='totalcredit' width='10%'><?php
                                                if (isset($credit)) {
                                                    echo $this->Number->precision($credit, 2);
                                                }
                                                ?></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div style="margin-top: -10px; margin-bottom: -10px;">
                                    Amount in words:  <?php echo $this->AmountToWords->convert_number_to_words($debit) . " only"; ?>
                                </div>
                                <!--                                <hr size="10" color="red" width="100%">-->
                                <hr>


                                <div>

                                    <p>Prepared by: <?php echo $voucher_details['full_name']; ?> &nbsp;&nbsp; Verified by:__________ &nbsp; Approved by:__________ &nbsp; Received by:__________</p>

                                </div>



                            </div>
                        </div>
                    </div>

                </div>
                <p ></p>
                <?php if (isset($voucher_details['vouchertype']) && $voucher_details['vouchertype'] === "Payment Voucher") { ?>
                <div class="page-break"></div>
                <div class="pb" >&nbsp;</div>
                <div class="pb" >&nbsp;</div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="portlet-title">
                            <span style="display:block; position:relative; text-align:left; ">
                                <?php echo $this->Html->image('new_logo.png', ['alt' => 'logo-default', 'style' => 'vertical-align:top']); ?>
                            </span>
                            
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="row">
                            <div class="col-lg-5 col-xs-6">
                                <p style="border: 1px solid; padding: 5px;">
                                    B-122 Blue Building, Shahrah-e-Jehangir, Scheme 24? Block H?<br>
                                    Karachi<br>
                                    Sindh<br>
                                </p>
                            </div>
                            <div class="col-lg-4 col-xs-6 pull-right">
                                <div class="clearfix">&nbsp;</div>
                                <div class="clearfix">&nbsp;</div>
                                <div class="clearfix">&nbsp;</div>
                                
                                <div class="row">
                                    <div class="col-lg-12">
                                        Date ______________________________
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h4>Dear Sir/Madam</h4>
                        <p>
                            Please find enclosed cheque/payorder, against settlement of your claim/invoice
                            as per following details. Kindly send us a reciept of the amount.
                        </p>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="portlet-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="4" class="text-center">PAYMENT AMOUNT</th>
                                                <th colspan="2" class="text-center">PAYMENT AMOUNT</th>
                                            </tr>
                                            <tr>
                                                <th>GROSS</th>
                                                <th>OTHER TAX</th>
                                                <th>WITHHOLDING</th>
                                                <th>NET</th>
                                                <th>INVOICE</th>
                                                <th>DATE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $this->Number->precision($grossamount + $othertax + $withholding , 2);  ?></td>
                                               <td><?php echo $this->Number->precision($othertax, 2);  ?></td>
                                               <td><?php echo $this->Number->precision($withholding, 2);  ?></td>
                                               <td><?php echo $this->Number->precision($grossamount, 2);  ?></td>
                                               
                                                <td><?php echo $voucher_details['voucher_number']; ?></td>
                                                <td><?php echo date('d-m-Y h:i A', strtotime($accountvoucher[0]['voucher_dated'])); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr>


                                <div>

                                    <p>Prepared by: <?php echo $voucher_details['full_name']; ?> &nbsp;&nbsp; Verified by:__________ &nbsp; Approved by:__________ &nbsp; Received by:__________</p>

                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
        <!--End Top Section -->

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