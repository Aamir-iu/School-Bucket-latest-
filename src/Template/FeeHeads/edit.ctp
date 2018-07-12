
<!-- Main content -->
    <section class="content">

      <div class="row">

         <?= $this->Form->create($feeHead) ?>
 
        <div class="col-md-12">
     
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Existing Fee Head Here.</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <div class="form-body form-horizontal form-bordered form-row-stripped">
           
                <fieldset>
                   
                  <div class="form-group">
                        <label class="control-label col-md-2">Campus:</label>
                        <div class="col-md-10">
                             <select class="form-control" id="campus_id" name="campus_id">
                            <?php foreach($campus as $campus):  ?>
                                <option <?php echo $feeHead->cmapus_id == $campus->id_campus ? 'selected' : 'OK' ; ?> value="<?php echo $campus->id_campus; ?>"><?php echo $campus->campus_name; ?></option>
                            <?php endforeach; ?>
                            
                            </select>

                        </div>
                    </div> 
                           
                    <div class="form-group">
                    <label for="class_id" class="col-sm-2 control-label">Class</label>
                    <div class="col-sm-10">
                        <select  class="form-control" name="class_id" id="class_id">
                        <?php foreach($class as $class):  ?>
                            <option <?php echo $feeHead->class_id == $class->id_class ? 'selected' : 'OK' ; ?> value="<?php echo $class->id_class; ?>"><?php echo $class->class_name; ?></option>
                        <?php endforeach; ?>

                      </select>
                     </div>
                     </div> 
                
                    
                  <div class="form-group">
                    <label for="class_id" class="col-sm-2 control-label">Fee Head</label>
                    <div class="col-sm-10">
                        <select  class="form-control" name="fee_type_id" id="fee_type_id">
                        <?php foreach($feetype as $feetype):  ?>
                            <option <?php echo $feeHead->fee_type_id == $feetype->id_fee_type ? 'selected' : 'OK' ; ?> value="<?php echo $feetype->id_fee_type; ?>"><?php echo $feetype->fee_type_name; ?></option>
                        <?php endforeach; ?>

                      </select>
                     </div>
                 </div> 
                    
                    
               
                <div class="form-group">
                    <label for="class_name" class="col-sm-2 control-label">Class Fees: </label>

                    <div class="col-sm-10">
                        <input type="number" required class="form-control" id="class_fees" name="class_fees" placeholder="Class Fees" value="<?php echo $feeHead->class_fees; ?>">
                    </div>
                </div>
                    
                 <div class="form-group">
                    <label for="class_name" class="col-sm-2 control-label">Fine: </label>

                    <div class="col-sm-10">
                        <input type="number" required class="form-control" id="fine" name="fine" placeholder="Fine" value="<?php echo $feeHead->fine; ?>">
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
       $("#class_id").select2();
       $("#fee_type_id").select2();
    });
</script>   

