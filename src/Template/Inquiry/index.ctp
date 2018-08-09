<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">

                    <h3 class="box-title">Inquiry Details</h3>
                    <div class="btn-group pull-right">
                        <div class="actions" style="margin-bottom: 28px;">
                            <a  href="#add-account" onclick="loadmodal();" title="Add Fees" class="btn btn-sm btn-success">
                                <i class="fa fa-plus"></i> Add </a>
                                
                                <a  href="#add-account" onclick="loadmodalall();" title="Add Fees" class="btn btn-sm btn-info">
                                <i class="fa fa-envelope-o"></i> SMS </a>
                            
                                
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
                                <th width="15%">First Name</th>
                                <th width="15%">Last Name</th>
                                <th width="10%">Class</th>
                                <th width="10%">Status</th>
                                <th width="45%">Actions</th
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($inquiry as $inquiry): ?>
                                <tr>

                                    <td><?= h($inquiry->id_inquery) ?></td>
                                    <td><?= h($inquiry->f_name) ?></td>
                                    <td><?= h($inquiry->l_name) ?></td>
                                    <td><?= h($inquiry->classes_section['class_name']) ?></td>
                                    <td><?= h($inquiry->status) ?></td>
                                    <td class="actions">
                                        <?php if(($inquiry->status)=='Qualified'){
                                            echo $this->Html->link(__('<i class="fa fa-trash"></i> Delete'), ['#' => '#'], ['onclick' => "delete_inquiry($inquiry->id_inquery);", 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ;

                                            echo '&nbsp';
                                            
                                            echo $this->Html->link(__('<i class="fa fa-envelope-o"></i> SMS'), ['#' => '#'], ['onclick'=>"loadmodalsms($inquiry->id_inquery);",'class' => 'btn btn-icon waves-effect waves-light btn-info m-b-5', 'escape' => false]);
                                        }elseif (($inquiry->status)=='Pending'){
                                            echo $this->Html->link(__('<i class="fa fa-user"></i> Admission'), ['controller'=>'Registration','action' => 'add',1,$inquiry->id_inquery], ['class' => 'btn btn-icon waves-effect waves-light btn-success m-b-5', 'escape' => false]);

                                            echo '&nbsp';

                                            echo $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'edit',$inquiry->id_inquery], ['class' => 'btn btn-icon waves-effect waves-light btn-warning m-b-5', 'escape' => false]);

                                            echo '&nbsp';

                                            echo $this->Html->link(__('<i class="fa fa-trash"></i> Delete'), ['#' => '#'], ['onclick' => "delete_inquiry($inquiry->id_inquery);", 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ;

                                            echo '&nbsp';

                                            echo $this->Html->link(__('<i class="fa fa-envelope-o"></i> SMS'), ['#' => '#'], ['onclick'=>"loadmodalsms($inquiry->id_inquery);",'class' => 'btn btn-icon waves-effect waves-light btn-info m-b-5', 'escape' => false]);

                                            echo '&nbsp';

                                            echo $this->Html->link(__('<i class="fa fa-close"></i> Close'), ['#' => '#'], ['onclick' => "close_inquiry($inquiry->id_inquery);", 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ;

                                        }else{
                                            echo $this->Html->link(__('<i class="fa fa-trash"></i> Delete'), ['#' => '#'], ['onclick' => "delete_inquiry($inquiry->id_inquery);", 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ;

                                            echo '&nbsp';
                                            
                                            echo $this->Html->link(__('<i class="fa fa-envelope-o"></i> SMS'), ['#' => '#'], ['onclick'=>"loadmodalsms($inquiry->id_inquery);",'class' => 'btn btn-icon waves-effect waves-light btn-info m-b-5', 'escape' => false]);

                                            echo '&nbsp';

                                            echo $this->Html->link(__('<i class="fa fa-c"></i> Pending'), ['#' => '#'], ['onclick' => "pending_inquiry($inquiry->id_inquery);", 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ;
                                    }?>

                                        
                                  

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
            <div class="modal-header">
                <div class="box-header">
                    <strong>Add New Inquiry</strong>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">


                    <div class="col-md-4">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name">
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Contact No.</label>
                            <input type="text" class="form-control" name="contact" id="contact" placeholder="Contact">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Select Class</label>
                            <select class="form-control" id="class_id"  data-placeholder="Select Class" style="width: 100%;">
                                <?php foreach ($class as $class): ?>    
                                    <option value="<?php echo $class->id_class; ?>"><?php echo $class->class_name; ?></option>
                                <?php endforeach; ?>    
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Father/Guardian Occupation</label>
                            <input type="text" class="form-control" name="occupation" id="occupation" placeholder="Occupation">
                        </div>
                    </div>
                    
                     <div class="col-md-4">
                        <div class="form-group">
                             <label>Select Area</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <a title="Add New Doctor" data-toggle="modal" data-backdrop="static" href="#add_doctor_modal" style="color: #333;"><i class="fa fa-plus"></i></a>
                                </span>
                               
                                 <select class="form-control" id="area_id"  data-placeholder="Select Class" style="width: 100%;">
                                    <?php foreach ($area as $area): ?>    
                                        <option value="<?php echo $area->id_area; ?>"><?php echo $area->area_name; ?></option>
                                    <?php endforeach; ?>    
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    

                    <div class="col-md-4">   
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" name='address' id="address" placeholder="Address"></textarea>
                        </div>
                    </div> 
                    
                    <div class="col-md-4">   
                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea class="form-control" name='remarks' id="remarks" placeholder="Remarks"></textarea>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>No. of Siblings</label>
                            <input type="text" class="form-control" name="sibling" id="sibling" placeholder="1or2, none">
                        </div>
                    </div>
                    


                </div>

            </div>

            <div class="modal-footer">
                <button onclick="save_inquiry();"  readonly type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Save</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- BEGIN SMS MODAL FORM-->
<div class="modal fade" id="sms"  role="sms" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Send SMS</h4>
            </div>
            <input type="text" class="hidden" id="sms_class_id" value=""> 
             <input type="text" class="hidden" id="sms_shift_id" value=""> 
                        
            <div class="modal-body" id="smsloading">
                <form class="form-horizontal form-bordered form-row-stripped">
                    <div class="form-body">
                           <input type="text" class="form-control hidden"  id="reg_id">  
                    <div class="form-group">
                        <label for="inputExperience" class="col-sm-3 control-label">Message</label>

                        <div class="col-sm-9">
                            <textarea class="form-control" rows="4" cols="4" name='message' id="message" placeholder="Message"><?= $msg ?></textarea>
                        </div>
                    </div>
                        
                    </div>
                </form>
                 
            </div>
            <div class="modal-footer">
                <button onclick="sendsms();" type="button" id="btnsend" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Send</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="add_doctor_modal" tabindex="-1" role="add_doctor_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add Area Details</h4>
            </div>
            <div class="modal-body">
                <form id="add_doctor_form" action="" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <input type="text" required class="form-control" name="area" id="area" title="Area Name" placeholder="Area Name">
                                </div>
                            </div>
                        </div>
                       
                      
                        <div class="col-md-12">
                            <div class="form-group clearfix">
                                <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
            <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- BEGIN SMS MODAL FORM-->
<div class="modal fade" id="smsall"  role="sms" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Send SMS</h4>
            </div>
            <input type="text" class="hidden" id="sms_class_id" value=""> 
             <input type="text" class="hidden" id="sms_shift_id" value=""> 
                        
            <div class="modal-body" id="smsloadingall">
                <form class="form-horizontal form-bordered form-row-stripped">
                    <div class="form-body">
                           <input type="text" class="form-control hidden"  id="reg_id">  
                    <div class="form-group">
                        <label for="inputExperience" class="col-sm-3 control-label">Message</label>

                        <div class="col-sm-9">
                            <textarea class="form-control" rows="4" cols="4" name='messageall' id="messageall" placeholder="Message"><?= $msg ?></textarea>
                        </div>
                    </div>
                        
                    </div>
                </form>
                 
            </div>
            <div class="modal-footer">
                <button onclick="sendsmsAll();" type="button" id="btnsend" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Send</button>
                <button onclick="export_number();" type="button" id="btnsend" class="btn btn-icon waves-effect waves-light btn-warning m-b-5">Export</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-danger m-b-5" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>  
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
<?= $this->Html->script('datatable.js') ?>  
    <script>
        $(document).ready(function () {
            $("#class_id").select2();
            $("#area_id").select2();
            
              $('#add_doctor_form').on('submit', function(){
            
            var name = $('#add_doctor_form #area').val();
           

            if(name === ''){
                toastr["error"]("Area name should not be empty!", "Alert!"); return false;
            }
         
            
            $('#add_doctor_form #area').attr('disabled', true);
          //  $('#add_doctor_form #clinic').attr('disabled', true);
            $('#add_doctor_modal button[type=submit]').addClass('disabled');
            $('#add_doctor_modal button[type=submit]').html('<i class="fa fa-spin fa-spinner"></i> Saving...');
         
            $.ajax({
                type: 'POST',
                url: "<?php echo $this->Url->build(['controller' => 'Inquiry', 'action' => 'addarea']); ?>",
                dataType: 'json',
                data: {
                    area : name
                },
                success: function(data) {
                    //console.log(data);
  
                    
                    $('#add_doctor_modal button[type=submit]').removeClass('disabled');
                    $('#add_doctor_modal button[type=submit]').html('<i class="fa fa-save"></i> Save');
                 //   $('#add_doctor_form #name').attr('disabled', false);
                  //  $('#add_doctor_form #clinic').attr('disabled', false);
                    if(data.msg === 'Exist'){
                        toastr["error"]("The area already exist!", "Alert!"); return false;
                    }
                  //  $('#add_doctor_form #name').val('');
                  //  $('#add_doctor_form #cell').val('');
                  //  $('#add_doctor_form #clinic').val('');
                    $('#add_doctor_modal').modal('hide');
                    toastr["success"]("Area has successfully added!", "Success");
                    
                }
            });
            
            return false;
        });
            

        });

        $(function () {
            $("#userstable").DataTable();

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
      
        function save_inquiry() {
            var fname =  $('#fname').val();
            var lname = $('#lname').val();
            var contact = $('#contact').val();
            var class_id = $('#class_id option:selected').val();
            var address = $('#address').val();
            var remarks = $('#remarks').val();
            var occupation = $('#occupation').val();
            var sibling = $('#sibling').val();
            var area_id = $('#area_id option:selected').val();
            if(fname == ''){
                toastr["error"]("Please enter first name.");
                return false;
            }
            
            if(lname == ''){
                toastr["error"]("Please enter last name.");
                return false;
            }
            
            if(contact == ''){
                toastr["error"]("Please enter contact number.");
                return false;
            }
            
            $.ajax({
                    type: "POST",
                    url: "<?php echo $this->Url->build(['controller' => 'Inquiry', 'action' => 'add']); ?>",
                    dataType: 'json',
                    cache: false,
                    async: false,
                    data: {fn: fname
                           ,ln:lname
                           ,class_id:class_id
                           ,address:address
                           ,contact:contact
                           ,area_id:area_id
                           ,remarks:remarks
                           ,occupation:occupation
                           ,sibling:sibling
                          },
                    success: function (data) {
                        var result = data.msg.split("|");
                        if (result[0] === "Success") {
                            toastr.success(result[0], result[1]);
                            $('#add-inqquiry').modal('hide');
                            location.reload();
                        } else {
                            toastr.warning(result[0], result[1]);
                        }
                    }
             });
           
        }
       
        function delete_inquiry(id) {

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
                            url: "<?php echo $this->Url->build(['controller' => 'Inquiry', 'action' => 'delete']); ?>",
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
                                }
                            }
                        });
                    }

                }
                swal(
                        'Deleted!',
                        'Record has been deleted.',
                        'success'
                        )
            });

        }
        // close the inquiry
        function close_inquiry(id) {

            swal({
                title: 'Are you sure?',
                text: "Are sure you want to Close!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Close it!'
            }).then(function (result) {
                if (result) {
                    if (id > 0) {
                        $.ajax({
                            type: "POST",
                            url: "<?php echo $this->Url->build(['controller' => 'Inquiry', 'action' => 'close']); ?>",
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
                                }
                            }
                        });
                    }

                }
                swal(
                        'Closed!',
                        'Record has been closed.',
                        'success'
                        )
            });

        }

        function pending_inquiry(id) {

            swal({
                title: 'Are you sure?',
                text: "Are sure you want to pend!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Pend it!'
            }).then(function (result) {
                if (result) {
                    if (id > 0) {
                        $.ajax({
                            type: "POST",
                            url: "<?php echo $this->Url->build(['controller' => 'Inquiry', 'action' => 'pending']); ?>",
                            dataType: 'json',
                            cache: false,
                            async: false,
                            data: {id: id},
                            success: function (data) {
                                var result = data.msg.split("|");
                                console.log(result);
                                if (result[0] === "Success") {
                                    toastr.success(result[0], result[1]);
                                     location.reload();
                                } else {
                                    toastr.error(result[0], result[1]);
                                }
                            }
                        });
                    }

                }
                swal(
                        'Pending!',
                        'Record has been pended.',
                        'success'
                        )
            });

        }

       
    function loadmodalsms(id) {
    
    
    $('#reg_id').val(id);
    
    $('#sms').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }
 

    function sendsms(){

        var message  = $('#message').val()
        if(message == ''){
            toastr.error('Message can not be blank','Error');
            return false;
        }
        var reg_id = $('#reg_id').val();
        imageOverlay('#smsloading','show');
        $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'Inquiry', 'action' => 'sendsms']); ?>",
                dataType: 'json',
                cache: false,
                async: false,
                data: {reg_id: reg_id,message:message},
                success: function (data) {
                    imageOverlay('#smsloading', 'hide');
                    var result = data.msg.split("|");
                    if (result[0] === "Success") {
                       
                        toastr.success(result[0], result[1]);

                    } else {
                        toastr.error(result[0], result[1]);
                    }
                }
                 
            });
          
    }

    function loadmodalall() {

        $('#smsall').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }
    
    
     function sendsmsAll(){

        var message  = $('#messageall').val()
        if(message == ''){
            toastr.error('Message can not be blank','Error');
            return false;
        }
       // var reg_id = $('#reg_id').val();
        imageOverlay('#smsloadingall','show');
        $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'Inquiry', 'action' => 'sendsmsall']); ?>",
                dataType: 'json',
                cache: false,
                async: false,
                data: {message:message},
                success: function (data) {
                    imageOverlay('#smsloadingall', 'hide');
                    var result = data.msg.split("|");
                    if (result[0] === "Success") {
                       
                        toastr.success(result[0], result[1]);

                    } else {
                        toastr.error(result[0], result[1]);
                    }
                }
                 
            });
          
    }
    
    
     function export_number() {
       
            imageOverlay('#smsloadingall', 'show');
            
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'Inquiry', 'action' => 'exportnumbers']); ?>",
                dataType: 'json',
                cache: false,
                async: false,
                data: {},
                success: function (data) {
                    imageOverlay('#smsloadingall','hide');
                    var result = data.msg.split("|");
                    if (result[0] === "Success") {
                        toastr.success(result[0], result[1]);
                        window.open("<?php echo $link; ?>");
                        //$.fileDownload(<?php echo $link; ?>);
                    } else {
                        toastr.error(result[0], result[1]);
                    }
                }
            });
      
    }
    
</script>
