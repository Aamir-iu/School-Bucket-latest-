
<!-- Main content -->
    <section class="content">

      <div class="row">

         <?= $this->Form->create($department) ?>
 
        <div class="col-md-12">
     
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add New Department.</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <div class="form-body form-horizontal form-bordered form-row-stripped">
           
                <fieldset>
                   
               
                <div class="form-group">
                    <label for="class_name" class="col-sm-2 control-label">Department Name: </label>

                    <div class="col-sm-10">
                        <input type="text" required class="form-control" id="department_name" name="department_name" placeholder="Department Name" value="">
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
    
