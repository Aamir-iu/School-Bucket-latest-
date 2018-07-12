
<!-- Main content -->
    <section class="content">

      <div class="row">

        <?= $this->Form->create($roomMaster) ?>
 
        <div class="col-md-12">
     
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Room/Hall.</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <div class="form-body form-horizontal form-bordered form-row-stripped">
           
                <fieldset>
                   
               
                <div class="form-group">
                    <label for="class_name" class="col-sm-2 control-label">Room / Hall NAme: </label>

                    <div class="col-sm-10">
                        <input type="text" required class="form-control" id="subject_name" name="room_name" placeholder="Room Name" value="<?php echo $roomMaster->room_name; ?>">
                    </div>
                </div>
                    
                <div class="form-group">
                    <label for="class_name" class="col-sm-2 control-label">Desc.: </label>

                    <div class="col-sm-10">
                        <input type="text" required class="form-control" id="short_name" name="room_desc" placeholder="Desc." value="<?php echo $roomMaster->room_desc; ?>">
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
    
