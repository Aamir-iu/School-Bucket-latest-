<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    
                    <div class="btn-group pull-right">
                        <div class="actions" style="margin-bottom: 28px;">
                            <a  href="#add-account" onclick="loadmodal();" title="Add Fees" class="btn btn-block btn-success">
                                <i class="fa fa-plus"></i> Upload </a>
                        </div>
                    </div>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="userstable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <tr role="row" class="heading">
                                <th width="5%">ID#</th>
                                <th width="5%">student ID#</th>
                                <th width="15%">Student Name</th>
                                <th width="20%">Class</th>
                                <th width="20%">Desc.</th>
                                <th width="10%">Download</th>
                                <th width="10%">Actions</th
                            </tr>
                        </thead>

                        <tbody>
                            <?php  foreach ($downloadSyllabus as $downloadSyllabus): ?>
                                <tr>

                                    <td><?= $downloadSyllabus['id_download_syllabus'] ?></td>
                                    <td><?= h($downloadSyllabus['registration']['id_registration']) ?></td>
                                    <td><?= h($downloadSyllabus['registration']['student_name']) ?></td>
                                    <td><?= h($downloadSyllabus['classes_section']['class_name']) ?></td>
                                    <td><?= h($downloadSyllabus['description']) ?></td>
                                    <td><?php echo $downloadSyllabus['actions']; ?></td>
                                        
                                    <td class="actions">
                                        <?= $this->Form->postLink(__('<i class="fa fa-trash"></i> Delete'), ['action' => 'delete', $this->Number->format($downloadSyllabus['id_download_syllabus'])], ['confirm' => __('Are you sure you want to delete # {0}?', $this->Number->format($downloadSyllabus['id_download_syllabus'])), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                                    </td>


                                </tr>

                            <?php endforeach;  ?>   

                        </tbody>

                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
<!-- BEGIN EDIT SUB ACCOUNT MODAL FORM-->
<div class="modal fade" id="add-fee"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <div class="box-header">
                    <strong>Upload Syllabus </strong>
               </div>
            </div>
            <div class="modal-body">
            
            <?= $this->Form->create('ds', array('type' => 'file', 'url' => array('controller' => 'DownloadSyllabus', 'action' => 'add', 'id' => 'forget-form'))); ?>      
                <div class="row">
                    
                    <div class="form-group">
                    
                    <div class="col-sm-12">
                        <select  class="form-control" name="class_id" id="class_id" style="width:100%;">
                        <?php foreach($class_name as $classes):  ?>
                            <option   value="<?php echo $classes->id_class; ?>"><?php echo $classes->class_name; ?></option>
                        <?php endforeach; ?>

                      </select>
                     </div>
                    </div> 
                <br /><br />
                <div class="form-group">
                    <div class="col-sm-12">
                      <select  class="form-control" name="shift_id" id="shift_id">
                        
                            <option value="1">Morning</option>
                            <option value="2">Afternoon</option>
                            <option value="3">Evening</option>

                      </select>
                     </div>
                </div> 
                <br /><br />
                <div class="form-group">
                    <div class="col-sm-12">
                          <textarea id="compose-textarea" required name="desc" class="form-control" style="height: 100px"></textarea>
                     </div>
                </div> 
                
                <br /><br />
                <div class="form-group">
                    
                 <div class="col-sm-12">   
                    <label for="exampleInputFile">File input</label>
                    <input type="file" name="file" id="exampleInputFile">
                   
                  </div>
                 
                 </div>
                
                 <br /><br />
                <div class="form-group pull-right">
                    
                 <div class="col-sm-12">   
                   
                    <?= $this->Form->button(__('<i class="fa fa-floppy-o"></i> Save'), [ 'class' => 'btn btn-danger', 'escape' => false]) ?>
                    &nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
                    
                     
                  </div>
                 
                 </div>
                
            <?= $this->Form->end() ?>    
              </div>
                    
                    
               </div>
                
            </div>
         
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

<!-- /.modal -->


<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>  
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
<?= $this->Html->script('datatable.js') ?>  
<script>
    
    $(document).ready(function () {
       // $("#transactionaccountid").select2();
        $("#userstable").DataTable();
    });
  
    $('#datepicker').datepicker({
      autoclose: true
    });
    
    function loadmodal() {

        $('#add-fee').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }
    
  
    

</script>
