<?= $this->Html->css('../plugins/timepicker/bootstrap-timepicker.min.css') ?> 
<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<!-- Main content -->
    <section class="content">

      <div class="row">

         <?= $this->Form->create($concession) ?>
 
        <div class="col-md-12">
     
            <div class="box box-primary" >
            <div class="box-header with-border">
              <h3 class="box-title" id="result">Edit Existing Record</h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body" id="test">
             <div class="form-body form-horizontal form-bordered form-row-stripped">
           
                <fieldset>
               
                    
                     <div class="form-group hidden">
                      <label for="father_name" class="col-sm-2 control-label">Fee Type: </label>
                      <div class="col-sm-10">
                        <select class="form-control" id="fee_type_id"  name="fee_type_id" data-placeholder="Select Fee Head" style="width: 100%;">
                         <?php  foreach($feetype as $feetypes): ?>    
                            <option <?php echo $concession->fee_type_id == $feetypes->id_fee_type ? 'selected' : 'OK' ; ?> value="<?php  echo $feetypes->id_fee_type; ?>"><?php  echo $feetypes->fee_type_name; ?></option>
                         <?php endforeach; ?>    
                        </select>
                       </div>   
                     </div>
                    
                     <div class="form-group">
                      <label for="father_name" class="col-sm-2 control-label">Concession Type: </label>
                      <div class="col-sm-10">
                        <select class="form-control" onchange="setconcession();" id="concession_type" name="concession_type" data-placeholder="Select Fee Head" style="width: 100%;">
                            <option <?php echo $concession->concession_type == 1 ? 'selected' : 'OK' ; ?> value="1">Half Concession</option>
                            <option <?php echo $concession->concession_type == 2 ? 'selected' : 'OK' ; ?> value="2">Full Concession</option>
                        </select>
                       </div>   
                     </div>
                    
                     <div class="form-group">
                        <label for="concession_amount" class="col-sm-2 control-label">Concession Amount: </label>

                        <div class="col-sm-10">
                            <input type="number" onkeyup="setconcession('a');" required class="form-control" id="concession_amount" name="concession_amount" placeholder="Concession Amount" value="<?= $concession->concession_amount  ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="concession_per"  class="col-sm-2 control-label">Concession %: </label>

                        <div class="col-sm-10">
                            <input type="text" required onkeyup="setconcession('p');" class="form-control" id="concession_per" name="concession_per" placeholder="Concession Amount In Percentage" value="<?= $concession->concession_per  ?>">
                        </div>
                    </div>
                    
                    
                     <div class="form-group">
                        <label for="current_fee" class="col-sm-2 control-label">Current Fee: </label>

                        <div class="col-sm-10">
                            <input type="number" required  class="form-control" readonly  id="current_fee" name="current_fee" placeholder="Cureent" value="<?= $concession->current_fee  ?>">
                        </div>
                    </div>
                    
                    
                    
                    
                    <div class="form-group">
                        <label for="amount" class="col-sm-2 control-label">After Concession: </label>

                        <div class="col-sm-10">
                            <input type="number" required class="form-control" id="amount" name="amount" placeholder="Fee Amount" value="<?= $concession->amount  ?>">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="fine" class="col-sm-2 control-label">Fine Amount: </label>

                        <div class="col-sm-10">
                            <input type="number" required readonly class="form-control" id="fine" name="fine" placeholder="Fine Amount" value="<?= $concession->fine  ?>">
                        </div>
                    </div>
                
                   <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">From Date:</label>
                    <div class="col-sm-10">
                        <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" required  name="from_date" class="form-control pull-right" value="<?= date('m/d/Y', strtotime($concession->from_date));  ?>" id="from">
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
                            <input type="text" required  name="to_date" class="form-control pull-right" value="<?= date('m/d/Y', strtotime($concession->to_date));  ?>" id="to">
                          </div>
                    </div>
                  </div>
                    
                  <div class="form-group">
                    <label for="remarks" class="col-sm-2 control-label">Order By:</label>

                    <div class="col-sm-10">
                        <textarea class="form-control" required name='remarks' id="desc" placeholder="Order BY"><?= $concession->remarks  ?></textarea>
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
    
    
</script>