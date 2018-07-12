
<!-- Main content -->
    <section class="content">

      <div class="row">

        <?= $this->Form->create($subject) ?>
 
        <div class="col-md-12">
     
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add New Subject.</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <div class="form-body form-horizontal form-bordered form-row-stripped">
           
                <fieldset>
                   
               
                <div class="form-group">
                    <label for="class_name" class="col-sm-2 control-label">Subject: </label>

                    <div class="col-sm-10">
                        <input type="text" required class="form-control" id="subject_name" name="subject_name" placeholder="Subject" value="<?=  $subject->subject_name ?>">
                    </div>
                </div>
                    
                <div class="form-group">
                    <label for="class_name" class="col-sm-2 control-label">Subject Short Desc.: </label>

                    <div class="col-sm-10">
                        <input type="text" required class="form-control" id="short_name" name="short_name" placeholder="Subject Short Desc." value="<?=  $subject->short_name ?>">
                    </div>
                </div>  
                    
               <div class="form-group">
                    <label for="class_name" class="col-sm-2 control-label">Subject Description. : </label>

                    <div class="col-sm-10">
                        <input type="text"  class="form-control" id="subject_desc" name="subject_desc" placeholder="Oral or Writing" value="<?=  $subject->subject_desc ?>">
                    </div>
                </div>       
<!--                <div class="form-group">
                    <label for="class_name" class="col-sm-2 control-label">Subject Order ID: </label>

                    <div class="col-sm-10">
                        <input type="number" required class="form-control" id="order_id" name="order_id" placeholder="Subject Order ID" value="<?=  $subject->order_id ?>">
                    </div>
                </div>        -->
                    
                
                
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
    
