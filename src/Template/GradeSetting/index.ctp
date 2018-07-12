
<!-- Main content -->
    <section class="content">

      <div class="row">
    <?php  $details = $gradeSetting[0]; ?>
     <?= $this->Form->create('GradeSetting', array('url'   => array( 'controller' => 'GradeSetting','action' => 'edit',$details['id_grades'] ), 'id'=>'forget-form')); ?>
        
          
        <div class="col-md-12">
     
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Grade Settings Area.</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <div class="form-body">
                <div class="form-horizontal"> 
                <div class="col-sm-4">
                    
                    <div class="form-group">
                        <label for="class_name" class="col-sm-3 control-label">Avg >= </label>
                        <div class="col-sm-6">
                            <input type="text" required class="form-control" id="per_i" name="per_i" placeholder="" value="<?= $details['per_i']; ?>">
                        </div>
                    </div>
                    
                   <div class="form-group">
                        <label for="class_name" class="col-sm-3 control-label">Avg >= </label>
                        <div class="col-sm-6">
                            <input type="text" required class="form-control" id="per_ii" name="per_ii" placeholder="" value="<?= $details['per_ii']; ?>">
                        </div>
                    </div> 
                   
                    <div class="form-group">
                        <label for="class_name" class="col-sm-3 control-label">Avg >= </label>
                        <div class="col-sm-6">
                            <input type="text" required class="form-control" id="per_iii" name="per_iii" placeholder="" value="<?= $details['per_iii']; ?>">
                        </div>
                    </div>
                    
                    
                     <div class="form-group">
                        <label for="class_name" class="col-sm-3 control-label">Avg >= </label>
                        <div class="col-sm-6">
                            <input type="text" required class="form-control" id="per_iv" name="per_iv" placeholder="" value="<?= $details['per_iv']; ?>">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="class_name" class="col-sm-3 control-label">Avg >= </label>
                        <div class="col-sm-6">
                            <input type="text" required class="form-control" id="per_v" name="per_v" placeholder="" value="<?= $details['per_v']; ?>">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="class_name" class="col-sm-3 control-label">Avg >= </label>
                        <div class="col-sm-6">
                            <input type="text" required class="form-control" id="per_vi" name="per_vi" placeholder="" value="<?= $details['per_vi']; ?>">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="class_name" class="col-sm-3 control-label">Avg  >= </label>
                        <div class="col-sm-6">
                            <input type="text" required class="form-control" id="per_vii" name="per_vii" placeholder="" value="<?= $details['per_vii']; ?>">
                        </div>
                    </div>
                    
                   
                </div>
               
                <div class="col-sm-4">
                    
                    <div class="form-group">
                        <label for="class_name" class="col-sm-3 control-label">Grade : </label>
                        <div class="col-sm-6">
                            <input type="text" required class="form-control" id="grade_i" name="grade_i" placeholder="" value="<?= $details['grade_i']; ?>">
                        </div>
                    </div>
                    
                   <div class="form-group">
                        <label for="class_name" class="col-sm-3 control-label">Grade : </label>
                        <div class="col-sm-6">
                            <input type="text" required class="form-control" id="grade_ii" name="grade_ii" placeholder="" value="<?= $details['grade_ii']; ?>">
                        </div>
                    </div> 
                   
                    <div class="form-group">
                        <label for="class_name" class="col-sm-3 control-label">Grade : </label>
                        <div class="col-sm-6">
                            <input type="text" required class="form-control" id="grade_iii" name="grade_iii" placeholder="" value="<?= $details['grade_iii']; ?>">
                        </div>
                    </div>
                    
                    
                     <div class="form-group">
                        <label for="class_name" class="col-sm-3 control-label">Grade : </label>
                        <div class="col-sm-6">
                            <input type="text" required class="form-control" id="grade_iv" name="grade_iv" placeholder="" value="<?= $details['grade_iv']; ?>">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="class_name" class="col-sm-3 control-label">Grade : </label>
                        <div class="col-sm-6">
                            <input type="text" required class="form-control" id="grade_v" name="grade_v" placeholder="" value="<?= $details['grade_v']; ?>">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="class_name" class="col-sm-3 control-label">Grade : </label>
                        <div class="col-sm-6">
                            <input type="text" required class="form-control" id="per_vi" name="grade_vi" placeholder="" value="<?= $details['grade_vi']; ?>">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="class_name" class="col-sm-3 control-label">Grade : </label>
                        <div class="col-sm-6">
                            <input type="text" required class="form-control" id="grade_vii" name="grade_vii" placeholder="" value="<?= $details['grade_vii']; ?>">
                        </div>
                    </div>
                    
                   
                </div>
                     
                 
                     
                <div class="col-sm-4">
                    
                    <div class="form-group">
                        <label for="class_name" class="col-sm-2 control-label">Remarks</label>
                        <div class="col-sm-7">
                            <input type="text" required class="form-control" id="remarks_i" name="remarks_i" placeholder="" value="<?= $details['remarks_i']; ?>">
                        </div>
                    </div>
                    
                   <div class="form-group">
                        <label for="class_name" class="col-sm-2 control-label">Remarks</label>
                        <div class="col-sm-7">
                            <input type="text" required class="form-control" id="remarks_ii" name="remarks_ii" placeholder="" value="<?= $details['remarks_ii']; ?>">
                        </div>
                    </div> 
                   
                    <div class="form-group">
                        <label for="class_name" class="col-sm-2 control-label">Remarks</label>
                        <div class="col-sm-7">
                            <input type="text" required class="form-control" id="remarks_iii" name="remarks_iii" placeholder="" value="<?= $details['remarks_iii']; ?>">
                        </div>
                    </div>
                    
                    
                     <div class="form-group">
                        <label for="class_name" class="col-sm-2 control-label">Remarks</label>
                        <div class="col-sm-7">
                            <input type="text" required class="form-control" id="remarks_iv" name="remarks_iv" placeholder="" value="<?= $details['remarks_iv']; ?>">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="class_name" class="col-sm-2 control-label">Remarks</label>
                        <div class="col-sm-7">
                            <input type="text" required class="form-control" id="remarks_v" name="remarks_v" placeholder="" value="<?= $details['remarks_v']; ?>">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="class_name" class="col-sm-2 control-label">Remarks</label>
                        <div class="col-sm-7">
                            <input type="text" required class="form-control" id="remarks_vi" name="remarks_vi" placeholder="" value="<?= $details['remarks_vi']; ?>">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="class_name" class="col-sm-2 control-label">Remarks</label>
                        <div class="col-sm-7">
                            <input type="text" required class="form-control" id="remarks_vii" name="remarks_vii" placeholder="" value="<?= $details['remarks_vii']; ?>">
                        </div>
                    </div>
                    
                   
                </div>
                     
                     
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <?= $this->Form->button(__('<i class="fa fa-floppy-o"></i> Save'), [ 'class' => 'btn btn-danger pull-right', 'escape' => false]) ?>
                      
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
    
