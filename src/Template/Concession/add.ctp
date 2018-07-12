<?= $this->Html->css('../plugins/timepicker/bootstrap-timepicker.min.css') ?> 
<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<!-- Main content -->
    <section class="content">

      <div class="row">

         <?= $this->Form->create($concession) ?>
 
        <div class="col-md-12">
     
            <div class="box box-primary" >
            <div class="box-header with-border">
              <h3 class="box-title" id="result"></h3>
              
                 <div class="input-group input-group-sm pull-right" style="width: 200px;">
                     <input type="text" required onchange="get_student_info();" name="registration_id" id="search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="button"  class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                 </div>
              
              
            </div>
            
            <!-- /.box-header -->
            <div class="box-body" id="test">
             <div class="form-body form-horizontal form-bordered form-row-stripped">
           
                <fieldset>
                   
                    <input type="text"  class="form-control hidden" id="class_id_hidden" value="" />
                    <div class="form-group">
                        <label for="student_name" class="col-sm-2 control-label">Student Name: </label>

                        <div class="col-sm-10">
                            <input type="text" required readonly class="form-control" id="student_name" name="student_name" placeholder="Student Name" value="">
                        </div>
                    </div>
                    
                    
                     <div class="form-group">
                        <label for="father_name" class="col-sm-2 control-label">Father Name: </label>

                        <div class="col-sm-10">
                            <input type="text" required readonly class="form-control" id="father_name" name="father_name" placeholder="Father Name" value="">
                        </div>
                    </div>
                    
                          
                    <div class="form-group">
                      <label for="father_name" class="col-sm-2 control-label">Fee Type: </label>
                      <div class="col-sm-10">
                        <select class="form-control" onchange="get_student_fee();" id="feehead" name="fee_type_id" data-placeholder="Select Fee Head" style="width: 100%;">
                         <?php  foreach($feetype as $feetypes): ?>    
                            <option value="<?php  echo $feetypes->id_fee_type; ?>"><?php  echo $feetypes->fee_type_name; ?></option>
                         <?php endforeach; ?>    
                        </select>
                       </div>   
                     </div>
                    
                    <div class="form-group">
                      <label for="father_name"   class="col-sm-2 control-label">Concession Type: </label>
                      <div class="col-sm-10">
                        <select class="form-control" onchange="setconcession();" id="concession_type" name="concession_type" data-placeholder="Select Fee Head" style="width: 100%;">
                            <option value="1">Half Concession</option>
                            <option value="2">Full Concession</option>
                        </select>
                       </div>   
                     </div>
                    
                    <div class="form-group">
                        <label for="concession_amount" class="col-sm-2 control-label">Concession Amount: </label>

                        <div class="col-sm-10">
                            <input type="number" onkeyup="setconcession('a');" required class="form-control" id="concession_amount" name="concession_amount" placeholder="Concession Amount" value="">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="concession_per"  class="col-sm-2 control-label">Concession %: </label>

                        <div class="col-sm-10">
                            <input type="text" required onkeyup="setconcession('p');" class="form-control" id="concession_per" name="concession_per" placeholder="Concession Amount In Percentage" value="">
                        </div>
                    </div>
                    
                    
                     <div class="form-group">
                        <label for="current_fee" class="col-sm-2 control-label">Current Fee: </label>

                        <div class="col-sm-10">
                            <input type="number" required  class="form-control" readonly  id="current_fee" name="current_fee" placeholder="Cureent" value="">
                        </div>
                    </div>
                    
                    
                    
                    <div class="form-group">
                        <label for="amount" class="col-sm-2 control-label">After Concession: </label>
                        <div class="col-sm-10">
                            <input type="number" required readonly  class="form-control" id="amount" name="amount" placeholder="Fee Amount" value="">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="fine" class="col-sm-2 control-label">Fine Amount: </label>

                        <div class="col-sm-10">
                            <input type="number" required class="form-control" id="fine" name="fine" placeholder="Fine Amount" value="">
                        </div>
                    </div>
                
                   <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">From Date:</label>
                    <div class="col-sm-10">
                        <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" required  name="from_date" class="form-control pull-right" id="from">
                          </div>
                    </div>
                  </div>
                    
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">To Date:</label>
                    <div class="col-sm-10">
                        <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" required  name="to_date" class="form-control pull-right" id="to">
                          </div>
                    </div>
                  </div>
                    
                 <div class="form-group">
                    <label for="remarks" class="col-sm-2 control-label">Order By:</label>

                    <div class="col-sm-10">
                        <textarea class="form-control" required name='remarks' id="desc" placeholder="Order BY"></textarea>
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
<?= $this->Html->script('../plugins/timepicker/bootstrap-timepicker.min.js') ?> 
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>    
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 


<script>
    
      $(document).ready(function () {
        $("#feehead").select2();
      });
    
 $('#from').datepicker({
      autoclose: true
    });
    $('#to').datepicker({
      autoclose: true
    });
    
    function get_student_info() {
        imageOverlay('#test', 'show');
        var fee_type = $('#feehead option:selected').val();
        var id = $("#search").val();
        $('#student_name').val('');
        $('#father_name').val('');
        $('#current_fee').val('');
        
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'Concession', 'action' => 'studentinfo']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {id: id,fee_type:fee_type},
            success: function (data) {
                var mdata = data.data;
                if(mdata.length > 0){
                    $('#student_name').val(mdata[0].student_name);
                    $('#father_name').val(mdata[0].father_name);
                    $('#current_fee').val(mdata[0].current_fee);
                    $('#class_id_hidden').val(mdata[0].class_id);
                    
                    $('#result').html('Record Found Successfully');
            }else{
                $('#result').html('Sorry! No Record Found.');
            }
        
            }
             
        });
        imageOverlay('#test', 'hide');
    }  
    
    function setconcession(id){
    
        var ct = $('#concession_type option:selected').val()
        var current_fee = $('#current_fee').val();
        var concession_per = $('#concession_per').val();
        var concession_amount = $('#concession_amount').val();
        
        if(ct === '1'){
           
           if(id === 'p'){
                var amount =  (current_fee / 100) * concession_per;
                $('#concession_amount').val(amount);
                $('#amount').val(current_fee - amount);
            }
            else if(id === 'a'){
                var per =  (concession_amount / current_fee) * 100;
                $('#concession_per').val(per);
                $('#amount').val(current_fee - concession_amount);
            }else{
                $('#amount').val(0);
                $('#concession_amount').val(0);
                $('#concession_per').val(0);
            }
            
            
        }else{
            $('#amount').val(0);
            $('#concession_amount').val(0);
            $('#concession_per').val(0);
            
        }
        
        
    }
    
    function get_student_fee() {
        
        imageOverlay('#test', 'show');
        var id = $('#feehead option:selected').val();
        var class_id = $('#class_id_hidden').val();
        $('#current_fee').val('');
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'FeeHeads', 'action' => 'view']); ?>/"+id+"/"+class_id,
            dataType: 'json',
            cache: false,
            async: false,
            data: {id: id},
            success: function (data) {
                var mdata = data.fee;
                if(mdata.length > 0){
                   
                    $('#current_fee').val(mdata[0].class_fees);
                    
                    $('#result').html('Record Found Successfully');
            }else{
                $('#result').html('Sorry! No Record Found.');
            }
        
            }
             
        });
        imageOverlay('#test', 'hide');
    }  
    
    
</script>
