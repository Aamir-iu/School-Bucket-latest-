
<!-- Main content -->
    <section class="content">

      <div class="row">
       
       
        <div class="col-md-12">
      
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">adding a new Products... </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                     <div class="form-body form-horizontal form-bordered form-row-stripped">
           
             <div class="portlet-body ">
           <div class="form">
            <?= $this->Form->create($product) ?>

            <div class="form-body form-horizontal form-bordered form-row-stripped">
                <fieldset>
                    <div class="form-group">
                        <label class="control-label col-md-3">Product Name:</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="Product Name" class="form-control" name='product_name' value='<?php echo $product->product_name; ?>' />
                            <span class="help-block">It's not recommended to use special characters in names </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Product Desc:</label>
                        <div class="col-md-9">

                            <input type="text" placeholder="Product Desc" class="form-control" name='product_desc' value='<?php echo $product->product_desc; ?>' />

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">Stock:</label>
                        <div class="col-md-9">

                            <input type="number" placeholder="Stock" class="form-control numeric" name='stock' value='<?php echo $product->stock; ?>' />

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Min Stock:</label>
                        <div class="col-md-9">

                            <input type="number" placeholder="Min Stock" min="1" class="form-control numeric" name='min_stock' value='<?php echo $product->min_stock; ?>' />

                        </div>
                    </div>



                    <div class="form-group">
                        <label class="control-label col-md-3">Product Type:</label>
                        <div class="col-md-9">
                            <select class="form-control" id="product_type" name="product_type">
                                <?php foreach ($producttypes as $producttype): ?>
                                    <option <?php echo $producttype_id == $producttype->type_id ? 'selected' : 'OK'; ?> value="<?php echo $producttype->type_id; ?>"><?php echo $producttype->type_name; ?></option>
                                <?php endforeach; ?>

                            </select>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Product Status:</label>
                        <div class="col-md-9">                            
                            <select class="form-control" name='product_active' > 

                                <option value="y"  <?php
                                if ($product->product_active === 'y') {
                                    echo 'selected="selected"';
                                }
                                ?>>Yes</option>
                                <option value="n"  <?php
                                if ($product->product_active === 'n') {
                                    echo 'selected="selected"';
                                }
                                ?>>No</option>

                            </select> 
                        </div>
                    </div>
                    <div class="form-group hidden">
                        <label class="control-label col-md-3">Expiry Months:</label>
                        <div class="col-md-9">

                            <input type="number" min="1" max="12" placeholder="Expiry Months" class="form-control numeric" name='expiry_months' value='<?php echo $product->expiry_months; ?>' />

                        </div>
                    </div>
                    <div class="form-group hidden">
                        <label class="control-label col-md-3">SKU:</label>
                        <div class="col-md-9">

                            <input type="Number" placeholder="SKU" class="form-control" name='sku' value='<?php echo $product->sku; ?>' />

                        </div>
                    </div>
                </fieldset>
                <div class='form-actions pull-right'>

                    <?= $this->Form->button(__('<i class="fa fa-floppy-o"></i> Submit'), [ 'class' => 'btn btn-block btn-success', 'escape' => false]) ?>

                </div>
            </div>

            <?= $this->Form->end() ?>
        </div>
                </div>
                    </div>
                </div>
             </div>
            <!-- /.box-body -->
          </div>
       
 
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
   <?= $this->Form->end() ?>   
    
    
 <script>
   
    
    
</script>   