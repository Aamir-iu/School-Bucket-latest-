<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
             <!--  <div class="btn-group pull-center">
                <div class="form-group" style="<?php $this->request->session()->read('Auth.User.role_id') ==1 ? 'display:black' : 'display:none'; ?>">
                  <label>Date Range:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date"  class="form-control pull-right" name="from" id="from"  value="<?php echo date("Y-m-d"); ?>">
                    <input type="date" class="form-control pull-right" name="to" id="to" value="<?php echo date("Y-m-d"); ?>">
                  </div>
                </div>
              </div>

              <button onclick="show_attendace();" type="button" id="btnsend" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Go</button>
            </div> -->


            <!-- /.box-header -->
            <div class="box-body">
              <table id="userstable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Reg. ID</th>  
                    <th>Student's Name</th>
                    <th>Father's Name</th>
                    <th>Class</th>
                    
                  
                </tr>
                </thead>
                <tbody>
              <?php foreach ($mdata as $row): ?>
                    <?php if ( $row['percentage'] < 70  ) {
                        # code...
                      ?> 
                <tr>
                    
                    <td><?= h($row['registration_id'])  ?></td>
                    
                    <td><?= $row['s_name'] ?></td>
                     <td><?= $row['f_name'] ?></td>
                    <td><?= $row['class_name'] ?></td>
                 
                </tr>
                   <?php  } ?>
                  <?php endforeach; ?>
                </tfoot>
              </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    
        
    
    
    
  <?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
  <?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
  <?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
    
  <?= $this->Html->script('datatable.js') ?> 

<script>
  //$(document).ready(function() {
  $(function () {
    //$(".classess").reload();

    $("#userstable").DataTable();
    //$("#class_id").html();
    
  });
  
  function show_attendace(){

    var from_date = $('#from').val();
    var to_date = $('#to').val();
    console.log(from_date);
    console.log(to_date);
    $.ajax({
                    type: "POST",
                    url: "<?php echo $this->Url->build(['controller'=> 'ShortAttendance', 'action' => 'index']); ?>",
                    dataType:'json',
                    cache: false,
                    async: false,
                    data: {from:from_date
                           ,to:to_date},
                    success: function(data) {
                      // console.log("HOLA");
                        /*imageOverlay('#attedancetable', 'hide');
                        var result = data.msg.split("|");
                        if (result[0] === "Success") {
                             toastr.success(result[0], result[1]);
                         } else {
                            toastr.warning(result[0], result[1]);                        
                        }*/
                    }
                });
    
      /*window.open("<?php echo $this->Url->build(['controller' => 'ShortAttendance', 'action' => 'view']); ?>/" + from_date + "/" + to_date );*/   
  };
   
  
</script>