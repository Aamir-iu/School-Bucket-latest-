<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Import Student's Data</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="panel panel-primary">
                                <div class="panel-heading">Import</div>
                                <div class="panel-body">
                                    <div  class="col-md-12">
                                        
            <?= $this->Form->create('Tool', array('type' => 'file', 'url' => array('controller' => 'Tools', 'action' => 'studentsrecord', 'id' => 'forget-form'))); ?>                                   
                                        
                                        <div class="form-group">
                                            <label>Class and Section</label>
                                            <select class="form-control" id="class_id" name="class_id"  data-placeholder="Select Class">
                                                <?php foreach ($classes as $class): ?>    
                                                    <option value="<?php echo $class->id_class; ?>"><?php echo $class->class_name; ?></option>
                                                <?php endforeach; ?>    
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Shift</label>
                                            <select  class="form-control" name="shift_id" id="shift_id">

                                                    <option value="1">Morning</option>
                                                    <option value="2">Afternoon</option>
                                                    <option value="3">Evening</option>

                                              </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Session</label>
                                            <select class="form-control" name="session_id" id="session_id"  data-placeholder="Select Class">
                                                <?php foreach ($session as $session): ?>    
                                                    <option value="<?php echo $session->id_session; ?>"><?php echo $session->session; ?></option>
                                                <?php endforeach; ?>    
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="exampleInputFile">File input</label>
                                            <input type="file" name="file" required id="exampleInputFile">

                                            <p class="help-block">Please Select Your CSV File.</p>
                                          </div>
                                         
                                        </div>
                                        
                                        <div class="box-footer pull-right">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                       </div>
                                                                            
                                    </div>
  <?= $this->Form->end() ?>
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

<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>          
<script>

   

</script>   