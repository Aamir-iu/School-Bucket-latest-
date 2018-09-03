<?php  $total_students = array(); ?>
<!-- Main content -->
<section class="content">
  <?php  if($this->request->session()->read('Auth.User.role_id')==1 || $this->request->session()->read('Auth.User.role_id')==2 || $this->request->session()->read('Auth.User.role_id')==3 ):   ?> 
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa  fa-graduation-cap"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Students</span>
                    <span class="info-box-number"><?= $m+$f; ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa  fa-male"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Male</span>
                    <span class="info-box-number"><?= $m; ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa  fa-female"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Female</span>
                    <span class="info-box-number"><?= $f; ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">New Admissions</span>
                    <small>Yesterday</small>
                    <span class="info-box-number"><?= $ayd; ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        
    </div>
<section class="box-panel">   
    <div class="row">


    <a href="Inquiry">
        <div class="box-mang col">
            <div class="info-box-icon-mg">
                
                    <span class="fa fa-th"></span>
                    <p class="info-box-text">Organization</p>  
                
            </div>
        </div>
    </a>






         <div class="box-mang col ">
            
                <div class="info-box-icon-mg">
                  <a href="Departments" >
                    <span class="fa  fa-user"></span>
                  <p class="info-box-text">Staff Management</p>   
                  </a>
              </div>
        </div>
         <div class="box-mang col ">
            
                <div class="info-box-icon-mg">
                  <a href="ClassesSections" >
                    <span class="fa  fa-building"></span>
                  <p class="info-box-text">Class</p>   
                  </a>
              </div>
        </div>
         <div class="box-mang col ">
            
                <div class="info-box-icon-mg">
                  <a href="Registration" >
                    <span class="fa  fa-group"></span>
                  <p class="info-box-text">Student Management</p>   
                  </a>
              </div>
        </div>
      
  <div class="box-mang col ">
            
                <div class="info-box-icon-mg">
                  <a href="exam-types" >
                    <span class="fa  fa-graduation-cap"></span>
                  <p class="info-box-text">Examination</p>
                  </a>
              </div>
        </div>
        <div class="box-mang col">
            
                <div class="info-box-icon-mg">
                  <a href="fees" >
                    <span class="fa  fa-cart-plus"></span>
                  <p class="info-box-text">Fees Management</p>   
                  </a>
              </div>
        </div>
        <div class="box-mang col">
            
                <div class="info-box-icon-mg">
                  <a href="fees/feecollection" >
                    <span class="fa fa-line-chart"></span>
                  <p class="info-box-text">Finance Management</p>   
                  </a>
              </div>
        </div>
         <div class="box-mang col">
            
                <div class="info-box-icon-mg">
                  <a href="dues" >
                    <span class="fa fa-table"></span>
                  <p class="info-box-text">Dues Management</p>   
                  </a>
              </div>
        </div>

        
         <div class="box-mang col">
            
                <div class="info-box-icon-mg">
                  <a href="reports" >
                    <span class="fa  fa-pie-chart"></span>
                  <p class="info-box-text">Reporting Area</p>   
                  </a>
              </div>
        </div>
         <div class="box-mang col ">
            
                <div class="info-box-icon-mg">
                  <a href="general-setting" >
                    <span class="fa  fa-gears"></span>
                  <p class="info-box-text">General Setting</p>   
                  </a>
              </div>
        </div>
        <!-- <div class="box-mang col">
            
                <div class="info-box-icon-mg">
                  <a href="tools" >
                    <span class="fa fa-toggle-on"></span>
                  <p class="info-box-text">Tools</p>   
                  </a></div>
        </div> -->
        <div class="box-mang col ">
            
                <div class="info-box-icon-mg">
                  <a href="sms-log" >
                    <span class="fa  fa-envelope"></span>
                  <p class="info-box-text">SMS</p>   
                  </a></div>
        </div>

        <!-- <div class="box-mang col">
            
                <div class="info-box-icon-mg">
                  <a href="tools/updateapp" >
                    <span class="fa fa-bell"></span>
                  <p class="info-box-text">Help</p>   
                  </a>
              </div>
        </div> -->
         
</div>
<!-- </section>
    <section style="margin: 5px;">
    <div class="col-md-6">
                   
            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Short Attendance</h3>
            </div>
            
            <div class="box-body no-padding"  id="atid">
              <table class="table table-condensed">
                <tr>
                  <th>Roll</th>
                  <th>Student Name</th>
                  <th style="width: 40px">Class</th>
                </tr>
                
                <?php foreach($mdata as $row): ?>
                  
                    <tr>

                      <?php if ( $row['percentage'] < 70  ) {
                        # code...
                      ?>
                      <td><?php echo $row['registration_id'];  ?></td>
                      <td><?php echo $row['s_name']; ?></td>
                      <td><?php echo $row['class_name']; ?></td>
                    <?php  } ?>
                    </tr>
                <?php endforeach; ?>
                
              </table>
            </div>
            
           
          </div>
    </div>
  </section> -->

             <!-- /.box-header -->
          
            <!-- ./box-body -->
            
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    
     

    <!-- Main row -->
    
    <!-- /.row -->
    <?php endif; ?>
    
</section>

<!-- /.content -->
</div>
<!-- /.content-wrapper -->


</div>




<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/chartjs/Chart.min.js') ?>

<script>
</script>
 
<script>
 
 
  
function sendsms(){
        
        imageOverlay('#smsloading','show');
        $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'Dashboard', 'action' => 'birthdaysms']); ?>",
                dataType: 'json',
                cache: false,
                async: false,
                data: {},
                success: function (data) {
                    imageOverlay('#smsloading', 'hide');
                    var result = data.msg.split("|");
                    if (result[0] === "Success") {
                       
                        toastr.info(result[0], result[1]);
                    } else {
                        toastr.error(result[0], result[1]);
                    }
                }
                 
            });
          
    }
 </script>  
 <style type="text/css">
     .box-panel{
        background: #CCC;
        padding: 12px;
     }
     .box-mang {
        padding:12px;
        margin:0 12px 12px;
        display:inline-block;
        background:#f5f5f5;
        width: 14%;
        border:1px solid #f5f5f5;
     }
     .info-box-icon-mg {
        background:none;
        display:block;
        text-align:center;
        vertical-align:middle;
     }
    .box-mang {
        text-align:center;
        padding:28px 12px;
     }

    .box-mang  span{ 
        font-size:26px;
        display:block;
    }
    .box-mang p{
        display:block;
        margin: 10px 0;
        text-transform: none !important;
    }
    .box-mang:hover{
        background: #1e282c;
        border-color: #1e282c;
    }
    .box-mang:hover span {
        color: #FFF;
    }
    .box-mang:hover p {
        color: #FFF;
    }



 </style>