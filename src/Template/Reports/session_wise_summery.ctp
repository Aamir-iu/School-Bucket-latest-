<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<!-- Main content -->
<section class="content">
    <div class="row">

        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Session Wise Collection Summery</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                      
                          <div class="col-md-6 col-md-offset-3">

                            <div class="panel panel-primary">
                                <div class="panel-heading">Action</div>
                                <div class="panel-body">
                                    <div  class="col-md-12">
                                        
                                        <div class="form-group">
                                            <label>Select Session</label>
                                            <select class="form-control" id="session_id"  data-placeholder="Session">
                                                <?php foreach ($session as $session): ?>    
                                                    <option value="<?php echo $session->id_session; ?>"><?php echo $session->session; ?></option>
                                                <?php endforeach; ?>    
                                            </select>
                                        </div>
                                   
                                         <!-- Date range -->
                                        <div class="form-group pull-right">
                                           <?= $this->Html->link(__('<i class="fa fa-print"></i> Print'), ['#' => '#'], ['onclick'=>"collection_summery();",'class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 'escape' => false]) ?>
                                           
                                        </div>
                                        <!-- /.form group -->
                                       
                                    </div>

                                </div>
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

<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>          
<script>

    $(document).ready(function () {
        $("#month_id").select2();
        $("#feehead").select2();
        $("#class_id").select2();
        
    });

    
    function collection_summery(){
        
     
        var session_id = $('#session_id option:selected').val();
        var session_name = $('#session_id option:selected').text();
     
        var flag = '4';

        window.open("<?php echo $this->Url->build(['controller' => 'Reports', 'action' => 'view']); ?>/" +  flag + "/" + session_id + "/" + session_name);
    
    }  
    
    function daily_collection(){
        var shift_id = $('#shift_id').val();
        var shift = $('#shift_id').text();
        var flag = '2';
        window.open("<?php echo $this->Url->build(['controller' => 'Reports', 'action' => 'view']); ?>/" +  flag + "/" + shift_id + "/" + shift );
    
    }  
    

</script>   