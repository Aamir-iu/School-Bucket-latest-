<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                <div class="row">
                   <div class="panel panel-default">
                       <div class="panel-heading">
                           <div class="caption">
                                <i class="fa fa-dollar"></i>
                                <span class="caption-subject font-teal-500 bold uppercase">
                                    <?php  $voucher_details = $accountvoucher[0]; ?>
                                    <?php  $voucher_type = $accountvoucher[0]; ?>

                                    <?php 
                                    ?>

                                    Voucher Details
                                </span>
                                 <div class="tools pull-right">
                                    <?= $this->Html->link(__(''), ['controller' => 'AccountVoucher', 'action' => 'view',$voucher_details['id_account_voucher'],1],['class'=>'fa fa-print', 'target' => 'blank']) ?>
                                    <a href="#" class="fullscreen" data-original-title="" title="">
                                    </a>
                                </div>
                            </div>
                        </div>
                       <div class="panel-body">
                        <div class="col-md-12">
        <!-- Begin: life time stats -->
          
            <div class="portlet-body">
                 <div class="row ">
                    <!--Voucher Details-->
                    <div class="form-body form-horizontal form-bordered form-row-stripped">
                        <fieldset>
                            <div class="form-group">
                                <label class="control-label col-md-3">Voucher Number #:</label>

                                <div class="col-md-9">
                                    <input type="text" readonly  placeholder="Voucher Number" class="form-control disabled" name='voucher_number' id='voucher_number' value='<?php  echo $voucher_details['voucher_number']; ?>' />
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="control-label col-md-3">Voucher Date :</label>

                                <div class="col-md-9">
                                    <input type="Text" readonly id="voucher_date" placeholder="Voucher Date" class="form-control disabled" name='voucher_date' value='<?php  echo $voucher_details['voucher_dated']; ?>' />
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3">Prepared Date :</label>

                                <div class="col-md-9">
                                    <input type="Text" readonly id="voucher_date" placeholder="Voucher Date" class="form-control disabled" name='voucher_date' value='<?php  echo $voucher_details['voucher_date_created']; ?>' />
                                </div>
                            </div>

                           <div class="form-group">
                                <label class="control-label col-md-3">Voucher Type :</label>

                                <div class="col-md-9">
                                    <input type="Text" readonly id="voucher_date" placeholder="Voucher type" class="form-control disabled" name='voucher_type' value='<?php echo $voucher_details['vouchertype']; ?>' />
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <label class="control-label col-md-3">Business Partner:</label>

                                <div class="col-md-9">
                                    <input type="text" readonly id="bp_name" placeholder="Business Partner" class="form-control disabled" name='Description' value='<?php  echo $voucher_details['bp_name']; ?>' />
                                </div>
                            </div>    
                            

                            <div class="form-group">
                                <label class="control-label col-md-3">Description:</label>

                                <div class="col-md-9">
                                    <input type="text" readonly id="voucher_desc" placeholder="Description" class="form-control disabled" name='Description' value='<?php  echo $voucher_details['description']; ?>' />
                                </div>
                            </div>  
                            
                             <div class="form-group">
                                <label class="control-label col-md-3">Voucher Status:</label>
                                <div class="col-md-9">
                                    <select  id="voucher_status" name="voucher_status" class="form-control">
                                        <option value='Posted'   <?php if ($voucher_details['voucher_status'] === 'Posted') {echo 'selected="selected"';} ?>   >Posted</option>
                                        <option value='Unposted' <?php if ($voucher_details['voucher_status'] === 'Unposted') {echo 'selected="selected"';} ?>  >Unposted</option>
                                        <option value='Cancelled' <?php if ($voucher_details['voucher_status'] === 'Cancelled') {echo 'selected="selected"';} ?>  >Cancelled</option>
                                    </select>
                                </div>
                            </div>
                            

                            <div class="form-group pull-right">
                                <div class="col-md-6">
                                <button type="button" onclick="voucher_status();" class="btn  waves-effect waves-light btn-success m-b-5 storePLBtn"><i class="fa fa-save"></i> Save</button>
                                 </div>
                            </div> 
                            
                            
                        </fieldset> 
                    </div>
                    <!--End Voucher Details-->
                    
                     <div class="portlet-body">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            
                            <div class="table-responsive">
                                <table id="transactiontable" class="table table-hover table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="hidden">Details ID</th>
                                            <th scope="col" width="15%">Account Number</th>
                                            <th scope="col" width="15%">Account Title</th>
                                            <th scope="col" width="10%">Payment Mode</th>
                                            <th scope="col" width="10%">Instrument #</th>
                                            <th scope="col" width="10%">Cost Center </th>
                                            <th scope="col" width="20%">Remarks</th>
                                            
                                            <th scope="col" width="10%" class="text-primary">Debit</th>
                                            <th scope="col" width="10%" class="text-primary">Credit</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        
                                        <?php $debit = 0; $credit = 0; ?>
                                        <?php  foreach($accountvoucher as $v_details): ?>
                                         <?php  if($v_details['type'] === 'Debit'): ?>
                                        <tr>
                                            <td><?php  echo $v_details['main_account_no']."-".$v_details['control_account_no']."-".$v_details['sub_account_no']."-".$v_details['trans_account_no']; ?> </td>
                                            <td><?php  echo $v_details['trans_account_title']; ?></td>
                                            <td><?php  echo $v_details['paymentmode']; ?></td>
                                            <td><?php  echo $v_details['instrument_no']; ?></td>
                                            <td style="display:none;"><?php  echo $v_details['center_type']; ?></td>
                                            <td><?php  echo $v_details['center_name']; ?></td>
                                            <td><?php  echo $v_details['remakrs']; ?> </td>
                                            <td style='text-align:right;'><?php  if($v_details['type'] === 'Debit'){ echo  $this->Number->precision($v_details['debit'],2);  $debit += $v_details['debit']; }else{echo "-"; } ?> </td>
                                            <td style='text-align:right;'><?php  if($v_details['type'] === 'Credit'){ echo $this->Number->precision($v_details['credit'],2); $credit += $v_details['credit'];}else{echo "-"; } ?> </td>
                                       </tr>
                                        <?php endif; ?>
                                       
                                       <?php  endforeach; ?>
                                        <?php //$debit = 0; $credit = 0; ?>
                                        <?php  foreach($accountvoucher as $v_details): ?>
                                         <?php  if($v_details['type'] === 'Credit'): ?>
                                        <tr>
                                            <td><?php  echo $v_details['main_account_no']."-".$v_details['control_account_no']."-".$v_details['sub_account_no']."-".$v_details['trans_account_no']; ?> </td>
                                            <td><?php  echo $v_details['trans_account_title']; ?></td>
                                            <td><?php  echo $v_details['paymentmode']; ?></td>
                                            <td><?php  echo $v_details['instrument_no']; ?></td>
                                            <td style="display:none;"><?php  echo $v_details['center_type']; ?></td>
                                            <td><?php  echo $v_details['center_name']; ?></td>
                                            <td><?php  echo $v_details['remakrs']; ?> </td>
                                            <td style='text-align:right;'><?php  if($v_details['type'] === 'Debit'){ echo  $this->Number->precision($v_details['debit'],2);  $debit += $v_details['debit']; }else{echo "-"; } ?> </td>
                                            <td style='text-align:right;'><?php  if($v_details['type'] === 'Credit'){ echo $this->Number->precision($v_details['credit'],2); $credit += $v_details['credit'];}else{echo "-"; } ?> </td>
                                       </tr>
                                        <?php endif; ?>
                                       
                                       <?php  endforeach; ?>
                                       
                                       
                                       
                                       
                                    </tbody>
                                </table>
                                <table id="tbltotals" class="table table-hover table-bordered table-striped">
                                    <tbody>
                                     <td width='80%' style='text-align:right; text-weight:bold'>Totals:</td>
                                     <td style='text-align:right; font-weight:bold;' class='totaldebit' width='10%'><?php if(isset($debit)){ echo $this->Number->precision($debit,2); } ?></td>
                                     <td style='text-align:right; font-weight: bold;' class='totalcredit' width='10%'><?php if(isset($credit)){ echo $this->Number->precision($credit,2); } ?></td>
                                </tbody>
                                </table>
                                
                                
                                
                            </div>
                        </div>
                    </div>
 
                </div>
            </div>
            
       
        <!--End details  -->
                    
                    
                    
                        </div>
                    </div>   
                 </div>   
               </div>     
          </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section> 
<script>
      
      
      function voucher_status() {
        
        var vn = $('#voucher_number').val();
        var vs = $('#voucher_status option:selected').val();
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'AccountVoucher', 'action' => 'updatevoucherstatus']); ?>",
                dataType: 'json',
                data: {vn: vn, vs:vs},
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
  
      
 </script>  