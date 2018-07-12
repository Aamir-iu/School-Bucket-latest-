
<!-- Main content -->
    <section class="content">

      <div class="row">

         <?= $this->Form->create($classesSection) ?>
 
        <div class="col-md-12">
     
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update Existing Classes</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <div class="form-body form-horizontal form-bordered form-row-stripped">
                 <?php   $temp = (explode(":",$classesSection->class_name));   ?>
                <fieldset>
                    
                <div class="form-group">
                    <label for="class_name" class="col-sm-2 control-label">Class and Section Name: </label>

                    <div class="col-sm-10">
                        <input type="text" required class="form-control" id="class_name" name="class_name" placeholder="Class and Section Name" value="<?php if(isset($temp[0])){echo $temp[0];} ?>">
                    </div>
                  </div>
                
                <div class="form-group">
                    <label for="class_name" class="col-sm-2 control-label">Section Name: </label>

                    <div class="col-sm-10">
                        <input type="text" required class="form-control" id="section_name" name="section_name" placeholder="Section Name" value="<?php if(isset($temp[1])){echo $temp[1];} ?>">
                    </div>
                </div>      
               
                    
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <?= $this->Form->button(__('<i class="fa fa-floppy-o"></i> Save'), [ 'class' => 'btn btn-danger pull-right', 'escape' => false]) ?>
                      
                    </div>
                  </div>
                 </fieldset>
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
    
