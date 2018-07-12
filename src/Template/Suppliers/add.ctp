
<!-- Main content -->
    <section class="content">

      <div class="row">
       
       
        <div class="col-md-12">
      
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Personal Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                     <div class="form-body form-horizontal form-bordered form-row-stripped">
           
             <div class="portlet-body ">
            <!-- BEGIN FORM-->
            <div class="form">
            <?= $this->Form->create($supplier) ?>

            <div class="form-body form-horizontal form-bordered form-row-stripped">
                <fieldset>
                    <div class="form-group">
                        <label class="control-label col-md-3">Supplier Name:</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="Supplier Name" class="form-control" name='supplier_name' value='<?php echo $supplier->supplier_name; ?>' />
                            <span class="help-block">It's not recommended to use special characters in names </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Supplier Category:</label>
                        <div class="col-md-9">
                            <select class="form-control" name="supplier_category_id" id="supplier_category_id">
                            <?php foreach($suppcat as $cat){ ?>
                            <option value="<?php echo $cat['id_supplier_category']; ?>"><?php echo $cat['category_name']; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Supplier Address:</label>
                        <div class="col-md-9">

                            <input type="text" placeholder="Supplier Address" class="form-control" name='supplier_address' value='<?php echo $supplier->supplier_address; ?>' />

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Contact Person:</label>
                        <div class="col-md-9">

                            <input type="text" placeholder="Contact Person" class="form-control" name='contact_person' value='<?php echo $supplier->contact_person; ?>' />

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Phone :</label>
                        <div class="col-md-9">

                            <input type="text" placeholder="Phone" class="form-control" name='phone1' value='<?php echo $supplier->phone1; ?>' />

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Phone :</label>
                        <div class="col-md-9">

                            <input type="text" placeholder="Phone" class="form-control" name='phone2' value='<?php echo $supplier->phone2; ?>' />

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Email:</label>
                        <div class="col-md-9">

                            <input type="text" placeholder="Email" class="form-control" name='email' value='<?php echo $supplier->email; ?>' />

                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label class="control-label col-md-3">Website:</label>
                        <div class="col-md-9">

                            <input type="text" placeholder="Website" class="form-control" name='website' value='<?php echo $supplier->website; ?>' />

                        </div>
                    </div>
                    
                    
                     <div class="form-group">
                        <label class="control-label col-md-3">Taxation:</label>
                        <div class="col-md-9">

                            <input type="text" placeholder="Taxation" class="form-control float-number" name='taxation' value='<?php echo $supplier->taxation; ?>' />

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