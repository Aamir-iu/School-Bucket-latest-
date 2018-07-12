<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
             
           <div class="btn-group pull-right">
                  <div class="actions" style="margin-bottom: 28px;">
                            <a  href="#add-account" onclick="loadmodal();" title="Add Fees" class="btn btn-block btn-success">
                                <i class="fa fa-plus"></i> Add </a>
                  </div>
           </div>
                
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="userstable" class="table table-bordered table-striped">
                <thead>
                <tr>
                   <th style="width:10%;">Class ID</th>
                  <th>Class and Section Name</th>
                  <th>Created On</th>
                  <th>Created By</th>
                  <th style="width:20%;">Action</th>
                  
                </tr>
                </thead>
                <tbody>
                 <?php foreach ($classesSections as $classesSection): ?>
                <tr>
                        <td><?= $this->Number->format($classesSection->id_class) ?></td>
                        <td><?= h($classesSection->class_name) ?></td>
                        <td><?= h($classesSection->created_on) ?></td>
                        <td><?= h($classesSection->user['full_name']) ?></td>
                    
                     <td class="actions">
                           <?= $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'edit', $this->Number->format($classesSection->id_class)], ['class' => 'btn btn-icon waves-effect waves-light btn-warning m-b-5', 'escape' => false]) ?>
                           <?php // $this->Form->postLink(__('<i class="fa fa-trash"></i> Delete'), ['action' => 'delete', $this->Number->format($classesSection->id_class)], ['confirm' => __('Are you sure you want to delete # {0}?', $this->Number->format($classesSection->id_class)), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                         
                     </td>
                   
                 
                </tr>
                  <?php endforeach; ?>
                </tfoot>
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
 <form id="class_id" action="" method="post" style="display: block;">    
 <fieldset>     
<div class="modal fade" id="add-inqquiry"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <div class="box-header">
                    <strong>Add New Class</strong>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Class Name</label>
                            <input type="text" class="form-control"   id="class_name" placeholder="Class Name">
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Section Name</label>
                            <input type="text" class="form-control"   id="section_name" placeholder="Section Name">
                        </div>
                    </div>

                </div>

            </div>

            <div class="modal-footer">
                <button  readonly type="submit" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Save</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
            </div>
         </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal --> 
 </fieldset>
</form>   
    
    
    
    
    
  <?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
  <?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
  <?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
    
  <?= $this->Html->script('datatable.js') ?>  
<script>
  $(function () {
    $("#userstable").DataTable();
    
  });
  
  function loadmodal() {

            $('#add-inqquiry').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
    }
  
  $('#class_id').on('submit', function(){
            
            var class_name = $('#class_name').val();
            var section_name = $('#section_name').val();
            
            if(class_name === ''){
                toastr["error"]("Please enter class name!", "Error");
                return false;
            }
            if(section_name === ''){
                toastr["error"]("Please enter section name!", "Error");
                return false;
            }
            
            $.ajax({
                type: 'POST',
                url: "<?php echo $this->Url->build(['controller' => 'ClassesSections', 'action' => 'add']); ?>",
                dataType: 'json',
                data: {
                    class_name : class_name,
                    section_name : section_name
                   },
                success: function(data) {
 
                    var result = data.msg.split('|');
                    
                    if(result[0] === 'Success'){
                        toastr.success(result[0], result[1]);
                        $('#add-inqquiry').modal('hide');
                        location.reload();
                    } else{
                       toastr.warning(result[0], result[1]); 
                    }
                }
            });
            
            return false;
        });
  
  
</script>