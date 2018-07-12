
<!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <?= $this->Form->create($employee,array('type'=>'file')) ?>

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <a href="#" onclick="document.getElementById('upload').click(); return false"><?php echo $this->Html->image('employees/avatar-1.jpg', ['alt' => 'user Picture', 'class' => 'profile-user-img img-responsive img-circle', 'id' => 'blah']); ?></a>
               <input type="file" id="upload" onchange="readURL(this);" name="file" style="visibility: hidden; width: 1px; height: 1px" multiple />
                
              <h3 class="profile-username text-center"></h3>
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
               <?php //echo  $user->campus['campus_name']; ?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted"> <?php //echo  $user->campus['campus_location']; ?></p>

            
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
                        <label class="control-label col-md-2">Department:</label>
                        <div class="col-md-10">
                             <select class="form-control" id="product_type" name="department_id">
                            <?php foreach($departments as $department):  ?>
                                <option <?php echo $department_id == $department->department_id ? 'selected' : 'OK' ; ?> value="<?php echo $department->department_id; ?>"><?php echo $department->department_name; ?></option>
                            <?php endforeach; ?>
                            
                            </select>

                        </div>
                    </div> 
                        
                        
                        
                    
                    <div class="form-group">
                        <label class="control-label col-md-2">Name:</label>
                        <div class="col-md-10">
                            <input type="text" placeholder="Employee Name" required class="form-control" name='employee_name' value='<?php echo $employee->employee_name; ?>' />
                            <span class="help-block">It's not recommended to use special characters in names </span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-2">Address:</label>
                        <div class="col-md-10">

                            <input type="text"  placeholder="Employee Address" class="form-control" name='employee_address' value='<?php echo $employee->employee_address; ?>' />

                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-2">Mobile No:</label>
                        <div class="col-md-10">

                            <input type="text" required placeholder="Employee Mobile No" class="form-control" name='employee_no' value='<?php echo $employee->employee_no; ?>' />

                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-2">Email:</label>
                        <div class="col-md-10">

                            <input type="email" placeholder="Employee Email" class="form-control" name='employee_email' value='<?php echo $employee->employee_email; ?>' />

                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-2">Phone 1:</label>
                        <div class="col-md-10">

                            <input type="text" placeholder="Employee Phone 1" class="form-control" name='employee_phone1' value='<?php echo $employee->employee_phone1; ?>' />

                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-2">Phone 2:</label>
                        <div class="col-md-10">

                            <input type="text" placeholder="Employee Phone 2" class="form-control" name='employee_phone2' value='<?php echo $employee->employee_phone2; ?>' />

                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-2">Basic Salary:</label>
                        <div class="col-md-10">

                            <input type="text" placeholder="Basic Salary" class="form-control" name='basic_salary' value='<?php echo $employee->basic_salary; ?>' />

                        </div>
                    </div>
                     
                     
                    <div class="form-group">
                        <label class="control-label col-md-2">Status:</label>
                        <div class="col-md-10">                            
                            <select class="form-control" name='status' > 
                                
                                <option value="Active"  <?php if ($employee->status === 'Active') {echo 'selected="selected"';} ?>>Active</option>
                                <option value="Inactive"  <?php if ($employee->status === 'Inactive') {echo 'selected="selected"';} ?>>Inactive</option>

                            </select> 
                        </div>
                    </div>
                     
                    <div class="form-group">
                        <label class="control-label col-md-2">Schedule Status:</label>
                        <div class="col-md-10">                            
                            <select class="form-control" name='scheduler_status' > 
                                
                                <option value="True"  <?php if ($employee->scheduler_status === 'True') {echo 'selected="selected"';} ?>>Yes</option>
                                <option value="False"  <?php if ($employee->scheduler_status === 'False') {echo 'selected="selected"';} ?>>No</option>

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