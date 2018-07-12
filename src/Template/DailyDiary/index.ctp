<?php
     function url(){
      
        $currentPath = $_SERVER['PHP_SELF']; 
        $pathInfo = pathinfo($currentPath); 
        $hostName = $_SERVER['HTTP_HOST']; 
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
        return $protocol.$hostName.$pathInfo['dirname']."/";
    }
?>
<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<?= $this->Html->css('../plugins/daterangepicker/daterangepicker.css') ?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
             
                    <div class="btn-group pull-right">
                  
                        <div class="actions" style="margin-bottom: 28px;">
                            <a  href="#add-account" onclick="loadmodal();" title="Add Fees" class="btn btn-block btn-success">
                                <i class="fa fa-plus"></i> Add </a>
                        </div>
                    </div>
                  
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="userstable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <tr role="row" class="heading">
                                <th width="5%">ID</th>
                                <th width="15%">Image</th>
                                <th width="35%">Description</th>
                                <th width="15%">Class</th>
                                <th width="5%">Shift</th>
                                <th width="15%">Date</th>
                                <th width="10%">Action</th>

                            </tr>
                        </thead>

                        <tbody>
                           <?php foreach ($dailyDiary as $dailyDiary): ?>
                            <tr>
                                <td><?= $this->Number->format($dailyDiary->id_daily_diary) ?></td>

                                <td>
                                    
                                <?php  $image = url()."img/homework/".$dailyDiary->image; ?>
                <?php echo $this->Html->image($image, ['alt' => 'student Picture', 'class' => 'profile-user-img img-responsive','style'=>'width:50px;']); ?>


                                </td>

                                <td><?= h($dailyDiary->addiotion) ?></td>
                                <td><?= h($dailyDiary->classes_section['class_name']) ?></td>
                                <td><?= h($dailyDiary->shift['shift_name']) ?></td>
                                <td><?= h(date('d-m-Y h:i A', strtotime($dailyDiary->date))) ?></td>
                              
                                
                                
                                
                                <td class="actions">
                                    
                              
                                    <?= $this->Html->link(__('<i class="fa fa-trash"></i> Delete'), ['#' => '#'], ['onclick'=>"delete_dairy($dailyDiary->id_daily_diary);",'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                                
                                    
                                 
                                </td>
                            </tr>
                            <?php endforeach; ?>

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
<!-- BEGIN EDIT SUB ACCOUNT MODAL FORM-->
<div class="modal fade" id="add-inqquiry"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">
                  <?= $this->Form->create('User', array('type' => 'file', 'url' => array('controller' => 'DailyDiary', 'action' => 'add', 'id' => 'forget-form'))); ?>          
                    <div class="col-xs-12">        
                        <!-- quick email widget -->
                        <div class="box box-info">
                            <div class="box-header">
                                <i class="fa fa-envelope"></i>

                                <h3 class="box-title">Daily diary entry form</h3>
                                <!-- tools box -->
                                <div class="pull-right box-tools">
                                    <button type="button" class="btn btn-info btn-sm"  data-toggle="tooltip" data-dismiss="modal" title="Close">
                                        <i class="fa fa-times"></i></button>
                                </div>
                                <!-- /. tools -->
                            </div>
                            <div class="box-body">
                                <form action="#" method="post" id="form1">
                                    
                                    <div class="form-group">
                                  
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" required  name="date" class="form-control pull-right" id="from" value="<?php  echo date("m/d/Y"); ?>">
                                          </div>
                             
                                   </div>
                                   <div class="form-group">
                                        <select class="form-control" id="id_class"  name="class_id" data-placeholder="Select Class" style="width: 100%;">
                                            <?php foreach ($class as $class): ?>    
                                                <option value="<?php echo $class->id_class; ?>"><?php echo $class->class_name; ?></option>
                                            <?php endforeach; ?>    
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <select  class="form-control" name="shift_id" id="shift_id">

                                            <option value="1">Morning</option>
                                            <option value="2">Afternoon</option>
                                            <option value="3">Evening</option>

                                        </select>
                                    </div> 
                                    
                                    <div class="form-group">
                                       <div>
                                        <input type="text" class="form-control" name="addiotion" id="additional" value="Class Homework of the <?php echo date("D-d-m-Y"); ?>" />
                                        </div>
                                    </div>
                                    
                                    
                                    <div>
                                        <textarea class="textarea" name="description" id="message" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                    </div>
                                    <br />
                                    <div class="form-group">
                    
                                        
                                        <input type="file" name='file'>
                                       
                                     
                                     
                                     </div>

                                    
                                </form>
                            </div>
                            <div class="box-footer clearfix">
                                <!-- <button type="button" onclick="saveDiary();" class="pull-right btn btn-default" id="sendEmail" data-toggle="tooltip"  title="Save">Save
                                    <i class="fa fa-arrow-circle-right" ></i></button> -->

                                    <?= $this->Form->button(__('<i class="fa fa-floppy-o"></i> Save'), [ 'class' => 'btn btn-success pull-right', 'escape' => false]) ?>
                            </div>
                        </div>

                    </div>
                <?= $this->Form->end() ?>       
                </div>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>  
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
<?= $this->Html->script('../plugins/daterangepicker/daterangepicker.js') ?>
<?php // $this->Html->script('datatable.js') ?> 
 <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>

<script>

    CKEDITOR.replace( 'message' );
   
    $(document).ready(function () {
        $("#id_class").select2();
   
    });
    $('#from').datepicker({
      autoclose: true
    });
    $(function () {
        $("#userstable").DataTable( {
        "order": [[ 0, "desc" ]]
    } );
    });
 
    $('#datepicker').datepicker({
        autoclose: true
    });
    
    function loadmodal() {

        $('#add-inqquiry').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }

   
    function delete_dairy(id) {

        swal({
            title: 'Are you sure?',
            text: "Are sure you want to delete!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function (result) {
            if (result) {
                if (id > 0) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'DailyDiary', 'action' => 'delete']); ?>/"+id,
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {id: id},
                        success: function (data) {
                            var result = data.msg.split("|");
                            if (result[0] === "Success") {
                                toastr.success(result[0], result[1]);
                                location.reload();
                            } else {
                                toastr.error(result[0], result[1]);
                                location.reload();
                            }
                        }
                    });
                }

            }
            
        });
         
    }
    function saveDiary() {

        var class_id = $('#id_class').val();
        var shift_id = $('#shift_id').val();
        var additional = $('#additional').val();
        var message = CKEDITOR.instances['message'].getData();  //$('#message').html();
     
        var from =  $('#from').val();
        swal({
            title: 'Are you sure?',
            text: "you want to save!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then(function (result) {
            imageOverlay('#form1', 'show');
            if (result) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'DailyDiary', 'action' => 'add']); ?>",
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {class_id: class_id,shift_id:shift_id,description:message,date:from,addiotion:additional},
                        success: function (data) {
                            imageOverlay('#form1','hide');
                            var result = data.msg.split("|");
                            if (result[0] === "Success") {
                               toastr.success(result[0], result[1]);
                               location.reload();
                            } else {
                                toastr.error(result[0], result[1]);
                            }
                        }
                    });
           }

        });

    }
    
</script>
