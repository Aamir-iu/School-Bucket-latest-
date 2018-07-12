<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
             
           <div class="btn-group pull-right">
                  <button type="button" class="btn btn-success">Action</button>
                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li> <?= $this->Html->link(__('Add New Concession'), ['controller' => 'Concession', 'action' => 'add']) ?></li>
                    <li> <a href="javascript:void(0);"  onclick="loadmodal();"><?= __('Concession Report') ?></a></li>
                    <li> <a href="javascript:void(0);"  onclick="loadmodal_adjust();"><?= __('Adjust Concessions') ?></a></li>
                    
                  </ul>
           </div>
                
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="userstable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Reg. ID</th>
                    <th>Student's Name</th>
                    <th>Father's Name</th>
                    <th>Fee Amount</th>
                    <th>Fee Fine</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th class="actions"><?= __('Actions') ?></th>
                  
                </tr>
                </thead>
                <tbody>
              <?php foreach ($concession as $concession): ?>
                <tr>
                      
                    
                    <td><?= $concession->registration_id ?></td>
                    <td><?= h($concession->registration['student_name']) ?></td>
                     <td><?= h($concession->registration['father_name']) ?></td>
                    <td><?= $this->Number->format($concession->amount) ?></td>
                    <td><?= $this->Number->format($concession->fine) ?></td>
                    <td><?= h($concession->from_date) ?></td>
                    <td><?= h($concession->to_date) ?></td>
                   
                     <td class="actions">
                           <?= $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'edit', $this->Number->format($concession->id_concession)], ['class' => 'btn btn-icon waves-effect waves-light btn-warning m-b-5', 'escape' => false]) ?>
                           <?= $this->Html->link(__('<i class="fa fa-trash"></i> Delete'), ['#' => '#'], ['onclick'=>"delete_concession($concession->id_concession,$concession->registration_id);",'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                         
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
    
    
<!-- BEGIN INVOICE CANCEL MODAL FORM-->
<div class="modal fade" id="add-report"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Please select subject</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">

                   <div class="form-group">
                      <label for="father_name"   class="col-sm-2 control-label">Concession Type: </label>
                      <div class="col-sm-10">
                        <select class="form-control"  id="concession_type" name="concession_type" data-placeholonchangeder="Select Fee Head" style="width: 100%;">
                            <option value="1">Half Concession</option>
                            <option value="2">Full Concession</option>
                        </select>
                       </div>   
                     </div>
                    

                </form>
            </div>
            <div class="modal-footer">
                <button onclick="Print_report();" type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5"><li class="fa fa-print"></li> Print</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal"><li class="fa fa-close"></li> Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- BEGIN INVOICE CANCEL MODAL FORM-->
<div class="modal fade" id="add-adj"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Click to adjust concessions</h4>
            </div>
            <div class="modal-body">
              
            </div>
            <div class="modal-footer">
                <button onclick="adjust_concession();" type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5"><li class="fa fa-save"></li> OK</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal"><li class="fa fa-close"></li> Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
    
    
    
    
  <?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
  <?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
  <?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
    
  <?= $this->Html->script('datatable.js') ?>  
<script>
  $(function () {
    $("#userstable").DataTable();
    
  });
  
   function delete_concession(id,rid) {

       swal({
            title: 'Are you sure?',
            text: "you want to delete!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then(function (result) {
            if (result) {
                if (id > 0) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'Concession', 'action' => 'delete']); ?>",
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {id:id,rid:rid},
                        success: function (data) {
                            var result = data.msg.split("|");
                            if (result[0] === "Success") {
                                toastr.success(result[0], result[1]);
                               
                            } else {
                                toastr.error(result[0], result[1]);
                            }
                        }
                    });
                }

            }
           swal(
            'Deleted!',
            'Record has been delete.',
            'success'
           
          )
           location.reload();
        });

    }

   
    function loadmodal() {
        $('#add-report').modal('show');
    }
   function loadmodal_adjust() {
        $('#add-adj').modal('show');
    }
  
   function Print_report() {
       var id =  $('#concession_type option:selected').val();

       // toastr["error"]("Please wait,Generating Report!");
        window.open("<?php echo $this->Url->build(['controller' => 'Concession', 'action' => 'view']); ?>/"+id);

    }
  
    function adjust_concession() {

       swal({
            title: 'Are you sure?',
            text: "you want to adjust!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
          }).then(function (result) {
            if (result) {
                $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'Concession', 'action' => 'adjust']); ?>",
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {},
                        success: function (data) {
                            var result = data.msg.split("|");
                            if (result[0] === "Success") {
                                toastr.success(result[0], result[1]);
                               
                            } else {
                                toastr.error(result[0], result[1]);
                            }
                        }
                    });
                }
           swal(
//            'Deleted!',
//            'Record has been delete.',
//            'success'
           
          )
         //  location.reload();
        });

    }
  
</script>