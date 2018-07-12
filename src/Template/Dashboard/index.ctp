<?php  $total_students = array(); ?>
<!-- Main content -->
<section class="content">
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
        <div class="col-md-3 col-sm-6 col-xs-12">
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
    <!-- /.row -->
    <?php  if($this->request->session()->read('Auth.User.role_id')==1): ?>
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo  $this->Number->precision($montlyincome,2); ?></h3>

              <p>This month revenue</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
               <h3><?php echo  $this->Number->precision($monthlyexpanse,2); ?></h3>

              <p>This month expanse</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $this->Number->precision($montlyincome - $monthlyexpanse ,2); ?></h3>

              <p>This month P&L</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
           
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>-</h3>

              <p>Pending</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
           
          </div>
        </div>
        <!-- ./col -->
      </div>
   
    <!-- /.row -->
    <?php endif; ?>
    <div class="row <?php if($this->request->session()->read('Auth.User.role_id')!=1){ echo "hidden"; }  ?>">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Monthly Recap Report</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-wrench"></i></button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                    <strong>Finance Report:  1 Jan, 2018 - 30 Dec, 2019</strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="salesChart" style="height: 180px;"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <p class="text-center">
                    <strong>Other Notifications</strong>
                  </p>

                  <div class="progress-group">
                    <span class="progress-text">This Session Arrears</span>
                    <span class="progress-number"><b>-</b></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: 100%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Last Session Arrears</span>
                    <span class="progress-number"><b>-</b></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" style="width: 100%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Concessions This Week</span>
                    <span class="progress-number"><b>-</b></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: 100%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Inquiries This Week</span>
                    <span class="progress-number"><b>-</b></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-yellow" style="width: 100%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i></span>
                    <?php
                    $amount_income = 0;
                    foreach($month_fee_collection as $row){
                        $amount_income += $row;
                    }
                    
                    ?>
                    
                    <h5 class="description-header"><?php echo $this->Number->precision($amount_income,2); ?></h5>
                    <span class="description-text">TOTAL REVENUE</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i></span>
                     <?php
                    $amount_exp = 0;
                    foreach($month_exp_collection as $row){
                        $amount_exp += $row;
                    }
                    
                    ?>
                    <h5 class="description-header"><?php echo $this->Number->precision($amount_exp,2); ?></h5>
                    <span class="description-text">TOTAL EXPANSE</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i></span>
                    <h5 class="description-header"><?php echo $this->Number->precision($amount_income - $amount_exp,2); ?></h5>
                    <span class="description-text">TOTAL PROFIT</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block">
                    <span class="description-percentage text-red"><i class="fa fa-caret-down"></i></span>
                    <h5 class="description-header">0.00</h5>
                    <span class="description-text">Pending Payments</span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    
     

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-md-8">
           
       <div class="row">
        <div class="col-md-6">
                     <!-- /.col -->
           <div class="box">
            <div class="box-header">
              <h3 class="box-title">Class Wise Strength</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding"   id="did">
              <table class="table table-condensed">
               <thead>
                <tr>
                  <th>Class</th>
                  <th style="width: 40px">Total</th>
                </tr>
               </thead>
               <tbody>
                <?php $i= 0; foreach($class_wise as $row): ?> 
                    <tr>
                      <td><?= $row['class']; ?></td>
                      <td><span class="badge bg-blue-active"><?= $row['total']; ?></span></td>
                      <?php  $total_students[$i] = round($row['total'],2); ?>
                    </tr>
                <?php $i++; endforeach; ?>
               </tbody>
                
              </table>
            </div>
       
          </div>
         </div>
                <!-- /.col -->

            <div class="col-md-6">
                   
            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Yesterday Attendance</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding"  id="atid">
              <table class="table table-condensed">
                <tr>
                  <th>Class</th>
                  <th>Progress</th>
                  <th style="width: 40px">Per</th>
                </tr>
                
                <?php $i = 0; $bar = 0; foreach($class_att as $row): ?>
                  <?php if($row['total']){ $bar =   round($row['present'] / $row['total'] * 100,0) ;}else{ echo 0; } ?>
                    <tr>
                      <td><?php echo $row['class']; ?></td>
                      <td>
                        <div class="progress progress-xs progress-striped active">
                          <div class="<?php if($bar <= 50){ echo 'progress-bar progress-bar-danger';}elseif($bar <= 70){ echo 'progress-bar progress-bar-yellow';}elseif($bar <= 80){ echo 'progress-bar progress-bar-primary';}elseif($bar > 80){ echo 'progress-bar progress-bar-success';} ?>" style="width:<?php if($row['present']){ echo $row['present']/$total_students[$i] * 100 ."%";}else{ echo 0; } ?>"></div>
                        </div>
                      </td>
                      <td><span class="<?php if($bar <= 50){ echo 'badge bg-red';}elseif($bar <= 70){ echo 'badge bg-yellow';}elseif($bar <= 80){ echo 'badge bg-blue';}elseif($bar > 80){ echo 'badge bg-green';} ?>"><?php echo $bar."%"; ?></span></td>
                    </tr>
                <?php $i++; $bar = 0; endforeach; ?>
                
              </table>
            </div>
            <!-- /.box-body -->
            <!-- /.box -->
           
          </div>
         </div>
                <!-- /.col -->
                
         <div class="col-md-6">
                     <!-- /.col -->
           <div class="box">
            <div class="box-header">
              <h3 class="box-title">Outstanding Amount </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding"   id="pid">
              <table class="table table-condensed">
               <thead>
                <tr>
                  <th>Class</th>
                  <th style="width: 40px">Amount</th>
                </tr>
               </thead>
               <tbody>
                <?php  if($this->request->session()->read('Auth.User.role_id')==1): ?>    
                <?php $i= 0; foreach($dues as $row): ?> 
                    <tr>
                      <td><?= $row['class']; ?></td>
                      <td><span class="badge bg-red-active"><?= $this->Number->precision($row['dues'], 2); ?></span></td>
                    
                    </tr>
                <?php $i++; endforeach; ?>
                <?php endif; ?>    
               </tbody>
                
              </table>
            </div>
           </div>
         </div>
                <!-- /.col -->       
                
         <div class="col-md-6">
                     <!-- /.col -->
           <div class="box">
            <div class="box-header">
              <h3 class="box-title">Received Amount</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding"   id="stid">
              <table class="table table-condensed">
               <thead>
                <tr>
                  <th>Class</th>
                  <th style="width: 40px">Amount</th>
                </tr>
               </thead>
               <tbody>
               <?php  if($this->request->session()->read('Auth.User.role_id')==1): ?>    
                <?php $i= 0; foreach($fees as $row): ?> 
                    <tr>
                      <td><?= $row['class']; ?></td>
                      <td><span class="badge bg-green-active"><?= $this->Number->precision($row['fees'], 2); ?></span></td>
                   
                    </tr>
                <?php $i++; endforeach; ?>
                <?php endif; ?>    
               </tbody>
                
              </table>
            </div>      
          </div>
         </div>
                <!-- /.col -->   
                
                
                
        </div>
            <!-- /.row -->

            <!-- TABLE: TEACHER -->
           
            
            <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-md-4">
             <!-- /.info-box -->
            <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Collection</span>
                   
                    <span class="info-box-number"><?php  if($this->request->session()->read('Auth.User.role_id')==1){ echo  $this->Number->precision($income,2); }else { echo '0.00'; } ?></span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 40%"></div>
                    </div>
                    <span class="progress-description">
                         Yesterday
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
             
              <div class="info-box bg-red">
                <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Expanses</span>
                    <span class="info-box-number"><?php  if($this->request->session()->read('Auth.User.role_id')==1){ echo  $this->Number->precision($expanse,2); }else { echo '0.00'; } ?></span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">
                         Yesterday
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
             
             
            <!-- /.info-box -->
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">P&L</span>
                    <span class="info-box-number"><?php  if($this->request->session()->read('Auth.User.role_id')==1){ echo  $this->Number->precision($income - $expanse,2,2); }else { echo '0.00'; } ?></span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 20%"></div>
                    </div>
                    <span class="progress-description">
                        Yesterday
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box    box khali hai-->
           
                <!-- USERS LIST -->
              <div class="box box-danger">
                  <div class="box-header with-border">
                  <h3 class="box-title">Today is their birthday</h3>

                  <div class="box-tools pull-right">
                      <button class="btn btn-danger btn-xs" onclick="sendsms();">Send SMS</button>
                    
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding" id="smsloading" style="height:360px;">
                  <ul class="users-list clearfix">
                <?php  foreach($birthdays as $row): ?>      
                      
                    <li>
                      <?php echo $this->Html->image('students_images/'.$row['image'], ['style'=>'width:100px;height:70px;','alt' => 'User Image']); ?>
                      <a class="users-list-name" href="javascript:void(0)" data-toggle="tooltip" title="<?php echo $row['student_name']; ?>"><?php echo $row['student_name']; ?></a>
                      <span class="users-list-date"><?php echo $row['class']; ?> <?php echo $row['shift']; ?></span>
                    </li>
                    
               <?php endforeach;  ?> 
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="javascript:void(0)" class="uppercase">View All</a>
                </div>
                <!-- /.box-footer -->
              </div>
              <!--/.box -->

         
          
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->


</div>




<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/chartjs/Chart.min.js') ?>

<script>
    $(function(){
        
        $('#stid').slimScroll({
            height: '330px',
            size: '5px',
            color: '#808080',
            alwaysVisible: false
        });
        
        $('#did').slimScroll({
            height: '330px',
            size: '5px',
            color: '#808080'
        });
         $('#atid').slimScroll({
            height: '330px',
            size: '5px',
            color: '#808080'
        });
         $('#pid').slimScroll({
            height: '330px',
            size: '5px',
            color: '#808080'
        });
      
    });
    
    function loadmodaldues(id) {
        imageOverlay('#loading', 'show');
        var paybale = 0;
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'Dues', 'action' => 'getdues']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {class: id},
            success: function (data) {
                var mdata = data.data;
                $("#feetable tbody").html('');
                var mhtml = "";
                for (var x = 0; x < mdata.length; x++) {
                mhtml += '<tr>';
                    mhtml += "<td>" + mdata[x]['class'] + "</td>";
                    mhtml += "<td>" + mdata[x]['shift'] + "</td>";
                    mhtml += "<td>" + (parseFloat(mdata[x]['amount'])) + "</td>";
                mhtml += '</tr>';
                paybale += (parseFloat(mdata[x]['amount']));     
                }
                $("#feetable tbody").append(mhtml);
                $('#total').val(paybale.toFixed(2));
            }
        });
       
        $('#show_dues').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
       imageOverlay('#loading', 'hide');
    }
 
 </script>
 
 <script>
 $(function () {
  'use strict';
  /* ChartJS
   * -------
   * Here we will create a few charts using ChartJS
   */
  //-----------------------
  //- MONTHLY SALES CHART -
  //-----------------------
  // Get context with jQuery - using jQuery's .get() method.
  var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
  // This will get the first returned node in the jQuery collection.
  var salesChart = new Chart(salesChartCanvas);
  var salesChartData = {
    labels: ["Jan", "Feb", "March", "Apr", "May", "June", "July","Aug","Sep","Oct","Nov","Dec"],
    datasets: [
      {
        label: "Expanse",
        fillColor: "rgb(210, 214, 222)",
        strokeColor: "rgb(210, 214, 222)",
        pointColor: "rgb(210, 214, 222)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgb(220,220,220)",
        data: [<?php  foreach($month_exp_collection as $row){ echo $row.','; } ?>]
      },
      {
        label: "Revenue",
        fillColor: "rgba(60,141,188,0.9)",
        strokeColor: "rgba(60,141,188,0.8)",
        pointColor: "#3b8bba",
        pointStrokeColor: "rgba(60,141,188,1)",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(60,141,188,1)",
        data: [<?php  foreach($month_fee_collection as $row){ echo $row.','; } ?>]
      }
    ]
  };
  var salesChartOptions = {
    //Boolean - If we should show the scale at all
    showScale: true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines: false,
    //String - Colour of the grid lines
    scaleGridLineColor: "rgba(0,0,0,.05)",
    //Number - Width of the grid lines
    scaleGridLineWidth: 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines: true,
    //Boolean - Whether the line is curved between points
    bezierCurve: true,
    //Number - Tension of the bezier curve between points
    bezierCurveTension: 0.3,
    //Boolean - Whether to show a dot for each point
    pointDot: false,
    //Number - Radius of each point dot in pixels
    pointDotRadius: 4,
    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth: 1,
    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius: 20,
    //Boolean - Whether to show a stroke for datasets
    datasetStroke: true,
    //Number - Pixel width of dataset stroke
    datasetStrokeWidth: 2,
    //Boolean - Whether to fill the dataset with a color
    datasetFill: true,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: true,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true
  };
  //Create the line chart
  salesChart.Line(salesChartData, salesChartOptions);
  //---------------------------
  //- END MONTHLY SALES CHART -
  //---------------------------
 
 
  
});
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
 