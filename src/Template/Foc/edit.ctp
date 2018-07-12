
    <div class="portlet light bordered form-fit">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-settings font-teal-500"></i>
                <span class="caption-subject font-teal-500 bold uppercase"><?= __('Add FOC') ?></span>
                <span class="caption-helper">adding a new Products... </span>
            </div>
            <div class="tools">
                
                <a href="#" class="fullscreen" data-original-title="" title="">
                </a>
                
            </div>
        </div>
        <div class="portlet-body ">
            <!-- BEGIN FORM-->
            <div class="form">
             <?= $this->Form->create($foc) ?>
                
            <div class="form-body form-horizontal form-bordered form-row-stripped">
                <fieldset>
                    
                    <input type="text" class="hidden" name='supplier_id' value='<?php  echo $supplier_id; ?>' />
                    <input type="text" class="hidden" name='supplier_product_id' value='<?php echo $supplier_product_id; ?>' />
                    <input type="text" class="hidden" name='foc_for' value='<?php echo $product_id; ?>' />
                    
                    <div class="form-group">
                        <label class="control-label col-md-3">FOC for Qty:</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="FOC for Qty" class="form-control numeric" name='foc_for_qty' value='<?php  echo $foc->foc_for_qty; ?>' />
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label class="control-label col-md-3">Product Name:</label>
                        <div class="col-md-9">
                             <select class="form-control" id="foc_product" name="foc_product">
                            <?php foreach($products as $product):  ?>
                                <option  <?php echo $foc->foc_product === $product->id_products ? 'selected' : '' ; ?> value="<?php echo $product->id_products; ?>"><?php echo $product->product_name; ?></option>
                            <?php endforeach; ?>
                            
                            </select>

                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-3">FOC product qty:</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="FOC product qty" class="form-control numeric" name='foc_product_qty' value='<?php  echo $foc->foc_product_qty; ?>'' />
                        </div>
                    </div>
                    
                    
                     <div class="form-group">
                        <label class="control-label col-md-3">Active:</label>
                        <div class="col-md-9">                            
                            <select class="form-control" name='active' > 
                                
                                 <option value="y"  <?php if ($foc->active === 'y') {echo 'selected="selected"';} ?>>Yes</option>
                                <option value="n"  <?php if ($foc->active === 'n') {echo 'selected="selected"';} ?>>No</option>


                            </select> 
                        </div>
                    </div>
                    
   
                </fieldset>
                            <div class='form-actions right'>
                
                    <?= $this->Form->button(__('<i class="fa fa-floppy-o"></i> Submit'), [ 'class' => 'btn cyan-500', 'escape' => false]) ?>
                
            </div>
            </div>

            <?= $this->Form->end() ?>
            </div>
        </div>
    </div>


<?= $this->Html->script('../plugins/select2/select2.min.js') ?>
<script>
 
$(document).ready(function() {
  $("#product_type").select2();
});
 
</script>       

