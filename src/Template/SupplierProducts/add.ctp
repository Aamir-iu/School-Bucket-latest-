
<!-- Main content -->
    <section class="content">

      <div class="row">
       
       
        <div class="col-md-12">
      
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">adding a new supplier products... </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                     <div class="form-body form-horizontal form-bordered form-row-stripped">
           
             <div class="portlet-body ">
            <!-- BEGIN FORM-->
            <div class="portlet light bordered form-fit"> 
        
        <div class="portlet-body ">
            <!-- BEGIN FORM-->
            <div class="form">
              <?= $this->Form->create($supplierProduct) ?>

            <div class="form-body form-horizontal form-bordered form-row-stripped">
                <fieldset>
                    
                    
                     <div class="form-group">
                        <label class="control-label col-md-3">Supplier Name:</label>
                        <div class="col-md-9">
                            
                            <select class="form-control"  id="id_suppliers" name="id_suppliers">
                                 
                            <?php foreach($suppliers as $supplier):  ?>
                                <option <?php echo $supplier_id == $supplier->id_suppliers ? 'selected' : '' ; ?> value="<?php echo $supplier->id_suppliers; ?>"><?php echo $supplier->supplier_name; ?></option>
                            <?php endforeach; ?>
                            
                            </select>

                        </div>
                    </div>
                    
                    
                    
                    
                    <div class="form-group">
                        <label class="control-label col-md-3">Product Name:</label>
                        <div class="col-md-9">
                             <select class="form-control" id="id_products" name="id_products">
                            <?php foreach($products as $product):  ?>
                                <option value="<?php echo $product->id_products; ?>"><?php echo $product->product_name; ?></option>
                            <?php endforeach; ?>
                            
                            </select>

                        </div>
                    </div>
                    
                    
                     <div class="form-group">
                        <label class="control-label col-md-3">Packaging Type:</label>
                        <div class="col-md-9">
                             <select class="form-control" id="packaging_type" name="packaging_type">
                            <?php foreach($packingtypes as $packingtypes):  ?>
                                <option value="<?php echo  $packingtypes->packaging_id; ?>"><?php echo $packingtypes->packaging_desc; ?></option>
                            <?php endforeach; ?>
                            
                            </select>

                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label class="control-label col-md-3">Unit Price:</label>
                        <div class="col-md-9">

                            <input type="text" id="unit_price" placeholder="Unit Price" class="form-control float-number" name='unit_price' value='<?php echo $supplierProduct->unit_price; ?>' />

                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label class="control-label col-md-3">Units Per Pack:</label>
                        <div class="col-md-9">

                            <input type="text" id="units_per_pack" placeholder="Units Per Pack" class="form-control numeric" name='units_per_pack' value='<?php echo $supplierProduct->units_per_pack; ?>' />

                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label class="control-label col-md-3">Pack Price:</label>
                        <div class="col-md-9">

                            <input type="text" id="pack_price" placeholder="Pack Price" class="form-control float-number" name='pack_price' value='<?php echo $supplierProduct->pack_price; ?>' />

                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label class="control-label col-md-3">Sale Price:</label>
                        <div class="col-md-9">

                            <input type="text" id="sale_price" placeholder="Sale Price" class="form-control float-number" name='sale_price' value='<?php echo $supplierProduct->sale_price; ?>' />

                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label class="control-label col-md-3">Discount:</label>
                        <div class="col-md-9">

                            <input type="text" id="discount" placeholder="Discount" class="form-control float-number" name='discount' value='<?php echo $supplierProduct->discount; ?>' />

                        </div>
                    </div>
                    
                    
                    
                   <div class="form-group">
                        <label class="control-label col-md-3">Active:</label>
                        <div class="col-md-9">                            
                            <select class="form-control" name='active' > 
                                
                                <option value="y"  <?php if ($supplierProduct->active === 'y') {echo 'selected="selected"';} ?>>Yes</option>
                                <option value="n"  <?php if ($supplierProduct->active === 'n') {echo 'selected="selected"';} ?>>No</option>

                            </select> 
                        </div>
                    </div>
                    
                    
                  
                </fieldset>
                    <div class='form-actions pull-right'>
                
                    <?= $this->Form->button(__('<i class="fa fa-floppy-o"></i> Save'), [ 'class' => 'btn btn-block btn-success', 'escape' => false]) ?>
                
                    </div>
            </div>

            <?= $this->Form->end() ?>
            </div>
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
   
    
    $(document).ready(function(){
 
    $("#units_per_pack").change(function(){
 
    //   var unit_price = $('#unit_price').val();
    //   var units_per_pack = $('#units_per_pack').val();
    //   $('#pack_price').val(units_per_pack * unit_price);
       
    });
    
    $("#unit_price").change(function(){
 
    //   var unit_price = $('#unit_price').val();
    //   var units_per_pack = $('#units_per_pack').val();
    //   $('#pack_price').val(units_per_pack * unit_price);
       
    });
 
});

$(document).ready(function() {
  $("#id_suppliers").select2();
});
$(document).ready(function() {
  $("#id_products").select2();
});
$(document).ready(function() {
  $("#packaging_type").select2();
});
$(document).ready(function() {
  $("#foc_id").select2();
});
 
 
</script>   