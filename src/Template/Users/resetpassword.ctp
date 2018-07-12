
<!-- Main content -->
    <section class="content">

      <div class="row">

         <?= $this->Form->create('User', array('url'   => array( 'controller' => 'Users','action' => 'resetpassword' ), 'id'=>'forget-form')); ?>    
 
        <div class="col-md-12">
            
            
             <div class="form-group">
                <div class="col-md-9">
                            <input type="hidden" required placeholder="Email" class="form-control" name='email' value='<?php if($user->email){echo $user->email;} ?>' />
                            
               </div>
            </div>
            
      
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Change Password</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <div class="form-body form-horizontal form-bordered form-row-stripped">
           
                <fieldset>
                   
               
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">New Password</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="New Password" value="">
                    </div>
                  </div>
                 
                    <div class="form-group">
                    <label for="confirmpassword" class="col-sm-2 control-label">Confirm Password</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder=Confirm Password" value="">
                    </div>
                  </div>
                    
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <?= $this->Form->button(__('<i class="fa fa-floppy-o"></i> Change Password'), [ 'class' => 'btn btn-danger pull-right', 'escape' => false]) ?>
                      
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
    
    
 <script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                        .attr('src', e.target.result)
                        .width(127);
                //.height(200);
            };

                reader.readAsDataURL(input.files[0]);
            }
    } 
 
    
    
</script>   