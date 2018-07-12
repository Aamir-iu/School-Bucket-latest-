
<!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

         <?= $this->Form->create('User', array('type' => 'file', 'url' => array('controller' => 'Users', 'action' => 'add', 'id' => 'forget-form'))); ?>      
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <a href="#" onclick="document.getElementById('upload').click(); return false"><?php echo $this->Html->image('users_images/avatar-1.jpg', ['alt' => 'user Picture', 'class' => 'profile-user-img img-responsive img-circle', 'id' => 'blah']); ?></a>
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
                        <input type="text" required="" class="form-control" name="full_name" id="full_name" placeholder="Full Name" value="<?php echo $user->full_name; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                        <input type="email" required=""  class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $user->email; ?>">
                    </div>
                  </div>
                    
                   <div class="form-group">
                    <label for="Password" class="col-sm-2 control-label">Password</label>

                    <div class="col-sm-10">
                        <input type="password" required=""  class="form-control" id="password" name="password" placeholder="Password" value="<?php echo $user->Password; ?>">
                    </div>
                  </div>  
                  
                 <div class="form-group">
                    <label for="address" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-10">
                        <input type="text" required="" class="form-control" name="address" id="address" placeholder="Address" value="<?php echo $user->address; ?>">
                    </div>
                  </div>
                 
                    
                <div class="form-group">
                    <label for="phone1"  class="col-sm-2 control-label">Phone 1</label>

                    <div class="col-sm-10">
                        <input type="text" required class="form-control" id="phonr1" name="phone1" placeholder="Phone 1" value="<?php echo $user->phone1; ?>">
                    </div>
                  </div>
                 
                  <div class="form-group">
                    <label for="phone2" class="col-sm-2 control-label">Phone 2</label>

                    <div class="col-sm-10">
                        <input type="text" required class="form-control" id="phonr2" name="phone2" placeholder="Phone 2" value="<?php echo $user->phone2; ?>">
                      <input type="text" class="form-control hidden"  name="image"  value="<?php echo $user->image; ?>">
                    </div>
                  </div>  
                    
                    
                   <div class="form-group">
                    <label for="role_id" class="col-sm-2 control-label">User Role</label>

                    <div class="col-sm-10">
                      <select class="form-control" name="role_id" id="role_id">
                        <?php foreach($roles as $role):  ?>
                            <option value="<?php echo $role->id_roles; ?>"><?php echo $role->role; ?></option>
                        <?php endforeach; ?>

                      </select>
                     </div>
                  </div>   
                    
                    
                   <div class="form-group">
                    <label for="role_id" class="col-sm-2 control-label">Campus</label>

                    <div class="col-sm-10">
                      <select class="form-control" name="campus_id" id="campus_id">
                        <?php foreach($campuses as $campuses):  ?>
                            <option value="<?php echo $campuses->id_campus; ?>"><?php echo $campuses->campus_name; ?></option>
                        <?php endforeach; ?>

                      </select>
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