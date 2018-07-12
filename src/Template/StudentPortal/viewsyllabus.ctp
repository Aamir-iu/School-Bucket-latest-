
 <!-- Main content -->
    <section class="content">
        
     
        
      <div class="row">
        <div class="col-md-12">
           <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Download Syllabus</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th style="width: 15%;">Date</th>
                    <th style="width: 75%;">Description</th>
                    <th style="width: 10%;">Download</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($data as $row): ?>    
                  <tr>
                    <td><?php echo date('d-m-Y h:i A', strtotime($row['date'])); ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['actions']; ?></td>
   
                  </tr>
                 <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
            
             
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


</div>




<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>



<script>
 
 
 
 
 
 
</script>
 
 