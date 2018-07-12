<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">View Report Class Wise</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="panel panel-primary">
                                <div class="panel-heading">Criteria</div>
                                <div class="panel-body">
                                    <div  class="col-md-12">
                                        
                                        <div class="form-group">
                                            <label>Select Class</label>
                                            <select class="form-control" id="class_id"  data-placeholder="Select Class">
                                                <?php foreach ($class as $class): ?>    
                                                    <option value="<?php echo $class->id_class; ?>"><?php echo $class->class_name; ?></option>
                                                <?php endforeach; ?>    
                                            </select>
                                        </div>


                                        <div class="form-group">
                                              <label>Select Shift</label>
                                              <select  class="form-control" name="shift_id" id="shift_id">
                                                    <option value="1">Morning</option>
                                                    <option value="2">Afternoon</option>
                                                    <option value="3">Evening</option>
                                              </select>
                                        </div> 
                                        
                                        <div class="form-group">
                                              <label>Select Status</label>
                                              <select  class="form-control" name="status" id="status">
                                                    <option value="Y">Active</option>
                                                    <option value="N">Inactive</option>
                                                   
                                              </select>
                                        </div> 
                                       
                                    </div>

                                </div>
                            </div>
                        </div>
                          <div class="col-md-6">

                            <div class="panel panel-primary">
                                <div class="panel-heading">Action</div>
                                <div class="panel-body">
                                    <div  class="col-md-12">
                                        <br />
                                         <!-- Date range -->
                                        <div class="form-group">
                                           <?= $this->Html->link(__('<i class="fa fa-print"></i> View Report'), ['#' => '#'], ['onclick'=>"view_report();",'class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 'escape' => false]) ?>
                                           <?= $this->Html->link(__('<i class="fa fa-print"></i> View General Report'), ['#' => '#'], ['onclick'=>"view_genral_report();",'class' => 'btn btn-icon waves-effect waves-light btn-warning m-b-5', 'escape' => false]) ?>
                                        </div>
                                         
                                        <div class="form-group">
                                          <?= $this->Html->link(__('<i class="fa fa-users"></i> View New Admission Report'), ['#' => '#'], ['onclick'=>"view_admission_report();",'class' => 'btn btn-icon waves-effect waves-light btn-primary m-b-5', 'escape' => false]) ?>
                                        </div> 
                                        <!-- /.form group -->
                                       
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

<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>          
<script>

    $(document).ready(function () {
        $("#months").select2();
        $("#feehead").select2();
        $("#class_id").select2();
        
    });
//    $('#to').datepicker({
//         autoclose: true
//   }); 
//
//  $('#from').datepicker({
//         autoclose: true
//         
//     });
//   
  
    
    function view_report(){
        
        var class_id = $('#class_id option:selected').val();
        var shift_id = $('#shift_id option:selected').val();
        var status = $('#status option:selected').val();
        var flag = '2';
        window.open("<?php echo $this->Url->build(['controller' => 'Registration', 'action' => 'view']); ?>/" +  flag + "/" + class_id + "/" + shift_id + "/" + status);
    
    }  
    
    
    function view_genral_report(){
        
        var class_id = $('#class_id option:selected').val();
        var shift_id = $('#shift_id option:selected').val();
        var status = $('#status option:selected').val();
        var flag = '3';
        
        swal({
            title: 'How many columns do you need?',
            input: 'number',
            inputPlaceholder: 'Enter number of columns',
            showCancelButton: true,
            inputValidator: function (value) {
              return new Promise(function (resolve, reject) {
                if (value) {
                  resolve()
                  window.open("<?php echo $this->Url->build(['controller' => 'Registration', 'action' => 'view']); ?>/" +  flag + "/" + class_id + "/" + shift_id + "/" + status + "/" + value);
                } else {
                  reject('You need to write number of columns!')
                }
              })
            }
          }).then(function (name) {
//            swal({
//              type: 'success',
//              title: 'Hi, ' + name
//            })
        })
  
    }  
 
    function view_admission_report(){
        
        var class_id = $('#class_id option:selected').val();
        var shift_id = $('#shift_id option:selected').val();
        var status = $('#status option:selected').val();
        var flag = '4';
        var value = '';
        var value1 = '';
        
        swal({
            title: 'Select Date Range',
            html:
              '<input type="date" id="swal-input1" class="swal2-input">' +
              '<input type="date" id="swal-input2" class="swal2-input">',
            focusConfirm: false,
            preConfirm: function () {
              return new Promise(function (resolve) {
                resolve([
                $('#swal-input1').val(),
                $('#swal-input2').val()
                ])
              })
            }
          }).then(function (result) {
            //swal(JSON.stringify(result))
           window.open("<?php echo $this->Url->build(['controller' => 'Registration', 'action' => 'view']); ?>/" +  flag + "/" + class_id + "/" + shift_id + "/" + status + "/" +  result);
        }).catch(swal.noop)
    }  
    
</script>   