
<!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

         <?= $this->Form->create('User', array('type' => 'file', 'url' => array('controller' => 'Users', 'action' => 'UpdateUserProfile', 'id' => 'forget-form'))); ?>      
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <a href="#" onclick="document.getElementById('upload').click(); return false"><?php echo $this->Html->image('users_images/'.$this->request->session()->read('Auth.User.image'), ['alt' => 'user Picture', 'class' => 'profile-user-img img-responsive img-circle', 'id' => 'blah']); ?></a>
               <input type="file" id="upload" onchange="readURL(this);" name="file" style="visibility: hidden; width: 1px; height: 1px" multiple />
                
              <h3 class="profile-username text-center"><?php echo $user->full_name; ?></h3>
              <ul class="list-group list-group-unbordered">
            
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Campus</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-building margin-r-5"></i> Campus</strong>

              <p class="text-muted">
               <?php echo  $user->campus['campus_name']; ?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted"> <?php echo  $user->campus['campus_location']; ?></p>

            
             </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
       
        <div class="col-md-9">
      
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Personal Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <div class="form-body form-horizontal form-bordered form-row-stripped">
           
                <fieldset>
                    
                  <div class="form-group">
                    <label for="full_name" class="col-sm-2 control-label">Full Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name" value="<?php echo $user->full_name; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                        <input type="email" readonly="" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $user->email; ?>">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="address" name="address" placeholder="Address"><?php echo $user->address; ?></textarea>
                    </div>
                  </div>
                    
                <div class="form-group">
                    <label for="phone1" class="col-sm-2 control-label">Phone 1</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="phonr1" name="phone1" placeholder="Phone 1" value="<?php echo $user->phone1; ?>">
                    </div>
                  </div>
                 
                  <div class="form-group">
                    <label for="phone2" class="col-sm-2 control-label">Phone 2</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="phonr2" name="phone2" placeholder="Phone 2" value="<?php echo $user->phone2; ?>">
                      <input type="text" class="form-control hidden"  name="image"  value="<?php echo $user->image; ?>">
                    </div>
                  </div>  
                    
                    
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        
                        <?= $this->Form->button(__('<i class="fa fa-floppy-o"></i> Update'), [ 'class' => 'btn btn-danger pull-right', 'escape' => false]) ?>
                        
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="#">
                        <p class="text-aqua pull-right" id="showdiv">Change Password</p>
                        </a>
                        
                    </div>
                  </div>
                    
                    
                 </fieldset>
                </div>
                <?= $this->Form->end() ?>   
               
                <div id="password-changes" style="display: none;">
                    <div class="form-body form-horizontal form-bordered form-row-stripped">
                       <fieldset>
                        <?= $this->Form->create('User', array('url' => array('controller' => 'Users', 'action' => 'resetpassword'), 'id' => 'forget-form')); ?>   

<!--                             <div class="form-group">
                                <label for="oldpassword" class="col-sm-2 control-label hidden">Old Password:</label>

                                <div class="col-sm-10">
                                    <input type="password" required="" class="form-control hidden" id="oldpassword" name="oldpassword" placeholder="Old Password" value="">
                                </div>
                              </div>  -->
                    
                               <div class="form-group">
                                <label for="newpassword" class="col-sm-2 control-label">New Password:</label>

                                <div class="col-sm-10">
                                    <input type="password" required="" class="form-control" id="newpassword" name="newpassword" placeholder="New Password" value="">
                                </div>
                              </div>  
                              
                              <div class="form-group">
                                <label for="confirmpassword" class="col-sm-2 control-label">Confirm Password:</label>

                                <div class="col-sm-10">
                                    <input type="password" required="" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" value="">
                                </div>
                              </div>  
                    
                    
                        <div class="form-group">
                            <div class="col-md-10">

                                <input type="hidden" required placeholder="Confirm Password" class="form-control" name='email' value='<?php echo $user->email; ?>' />

                            </div>
                        </div>   

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                            
                            <?= $this->Form->button(__('<i class="fa fa-floppy-o"></i> Update'), [ 'class' => 'btn btn-danger pull-right', 'escape' => false]) ?>
                    
                         </div>
                        </div>   
                           
                        <div class="form-group">
                         <div class="col-sm-offset-2 col-sm-10">
                         <a href="#">   <p class="text-aqua pull-right" id="hidediv">Cancel</p></a>
                         </div>
                       </div>
                           
                   </div>
                     <?= $this->Form->end() ?>
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
   
   <?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<script>
    $(function () {
        $('#showdiv').click(function (e) {
            $("#password-changes").delay(100).fadeIn(100);
            e.preventDefault();
        });
        $('#hidediv').click(function (e) {
            $("#password-changes").fadeOut(100);
            e.preventDefault();
        });
       

    });
   
</script>
  
    
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