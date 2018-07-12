<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<?= $this->Html->css('../plugins/daterangepicker/daterangepicker.css') ?>
<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">View Attendance Report</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">

                            <div class="panel panel-primary">
                                <div class="panel-heading">View Report</div>
                                <div class="panel-body">
                                    <div  class="col-md-12">
                                        
            <?= $this->Form->create('Tool', array('type' => 'file','target'=>'blank','url' => array('controller' => 'StudentAttendance', 'action' => 'view',0, 'id' => 'forget-form'))); ?>                                   
                                        
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
                                            <label>Month</label>
                                            <select class="form-control" id="date_range" name="date_range"  data-placeholder="Select Class">
                                                <?php foreach ($months as $month): ?>    
                                                    <option value="<?php echo $month->id_month; ?>"><?php echo $month->month_name; ?></option>
                                                <?php endforeach; ?>    
                                            </select>
                                        </div>
                                        
                                        
                                        <input type="hidden" name="start" id="start" value="" />
                                        <input type="hidden" name="end" id="end" value="" />
                                      <!-- Date and time range -->
                                        <div class="form-group  hidden">
                                          <label>Date range :</label>

                                          <div class="input-group">
                                            <button type="button" class="btn btn-default pull-right" name="date" id="daterange-btn">
                                              <span>
                                                <i class="fa fa-calendar"></i> Date range picker
                                              </span>
                                              <i class="fa fa-caret-down"></i>
                                            </button>
                                          </div>
                                        </div>
                                        <div class="box-footer pull-right">
                                            <button type="submit" class="btn btn-primary">Print Fill Attendance Sheet</button>
                                            <button type="button" onclick="print_blank();" class="btn btn-warning">Print Bank Attendance Sheet</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>
<?= $this->Html->script('../plugins/daterangepicker/daterangepicker.js') ?>

<script>
  
  $(function () {
   
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
           $('#start').val(start);
           $('#end').val(end);
           
        }
    );

    
  });
  
   function print_blank() {
       var class_id = $('#class_id option:selected').val();
       var shift_id = $('#shift_id option:selected').val();
       
       var class_name = $('#class_id option:selected').text();
       var shift_name = $('#shift_id option:selected').text();
       
       var flag = '1';
       window.open("<?php echo $this->Url->build(['controller' => 'StudentAttendance', 'action' => 'view']); ?>/" + flag + "/" + class_id + "/" + shift_id + "/" + class_name + "/" + shift_name);
   }
  
</script>
   