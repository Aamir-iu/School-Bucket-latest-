
<!-- Main content -->
    <section class="content">

      <div class="row">

         <?= $this->Form->create($inquiry) ?>
 
        <div class="col-md-12">
     
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update Existing Inquiry</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <div class="form-body form-horizontal form-bordered form-row-stripped">
                
                <fieldset>
                    
                <div class="form-group">
                    <label for="class_name" class="col-sm-2 control-label">First Name </label>

                    <div class="col-sm-10">
                        <input type="text" required class="form-control" id="lname" name="f_name" placeholder="First Name" value="<?php echo $inquiry->f_name; ?>">
                    </div>
                  </div>
                
                <div class="form-group">
                    <label for="class_name" class="col-sm-2 control-label">Last Name</label>

                    <div class="col-sm-10">
                        <input type="text" required class="form-control" id="lname" name="l_name" placeholder="Last Name" value="<?php echo $inquiry->l_name; ?>">
                    </div>
                </div>      
               
                <div class="form-group">
                    <label for="class_name" class="col-sm-2 control-label">Contact</label>

                    <div class="col-sm-10">
                        <input type="text" required class="form-control" id="contact" name="contact" placeholder="Last Name" value="<?php echo $inquiry->contact; ?>">
                    </div>
                </div>         
                    
                 <div class="form-group">
                    <label for="class_name" class="col-sm-2 control-label">Class</label>

                    <div class="col-sm-10">
                        
                        <select class="form-control" id="class_id" name="for_class_id"  data-placeholder="Select Class" style="width: 100%;">
                           <?php foreach ($class as $class): ?>    
                               <option  <?php echo $inquiry->for_class_id == $class->id_class ? 'selected' : 'OK' ; ?> value="<?php echo $class->id_class; ?>"><?php echo $class->class_name; ?></option>
                           <?php endforeach; ?>    
                        </select>
                        
                    </div>
                </div>
                 <div class="form-group">
                    <label for="class_name" class="col-sm-2 control-label">Father/Guardian Occupation</label>

                    <div class="col-sm-10">
                        <input type="text" required class="form-control" id="occupation" name="occupation" placeholder="Occupation" value="<?php echo $inquiry->occupation; ?>">
                    </div>
                </div>          
                <div class="form-group">
                    <label for="class_name" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-10">
                        <input type="text" required class="form-control" id="address" name="address" placeholder="address" value="<?php echo $inquiry->address; ?>">
                    </div>
                </div>
                    
                <div class="form-group">
                    <label for="class_name" class="col-sm-2 control-label">Remarks</label>

                    <div class="col-sm-10">
                        <input type="text" required class="form-control" id="remarks" name="remarks" placeholder="Remarks" value="<?php echo $inquiry->remarks; ?>">
                    </div>
                </div>      
                <div class="form-group">
                    <label for="class_name" class="col-sm-2 control-label">No. of Siblings</label>

                    <div class="col-sm-10">
                        <input type="text" required class="form-control" id="sibling" name="sibling" placeholder="1 or 2" value="<?php echo $inquiry->sibling; ?>">
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
    
<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
    
<script>
    $(document).ready(function () {
      //  $("#class_id").select2();

    });
</script>