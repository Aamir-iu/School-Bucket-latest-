
<!-- Main content -->
    <section class="content">

      <div class="row">
       
       
        <div class="col-md-12">
      
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">adding a new Category... </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                     <div class="form-body form-horizontal form-bordered form-row-stripped">
           
             <div class="portlet-body ">
           <div class="form">
            <?= $this->Form->create($masterGallery) ?>

            <div class="form-body form-horizontal form-bordered form-row-stripped">
                <fieldset>
                    
                <div class="form-group">
                    <label class="control-label col-md-3">Category Name:</label>
                    <div class="col-md-9">
                        <input type="text" placeholder="Category Name" class="form-control" name='gallery_desc' value='<?php echo $masterGallery->gallery_desc; ?>' />
                        <span class="help-block">It's not recommended to use special characters in names </span>
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