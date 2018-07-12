<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<?= $this->Html->css('../plugins/daterangepicker/daterangepicker.css') ?> 

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="btn-group pull-right">
                       <div class="row">
                            <div class="col-xs-8">
                                    <div class="box-tools">
                                        <div class="input-group">
                                            <form method="post" action="" id="search-form" class="form-horizontal">
                                                <table class="table table-responsive">
                                            <tr>
                                            	<td>Class</td>
                                                <td>Shift</td>
                                                <td>Registration ID</td>
                                                <td>LastName/FirstName</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <select name="class_id" id="class_id1" class="form-control input-sm" style="width: 150px;">
                                                    <option value="">Select</option>    
                                                    <?php foreach($class_name as $clas):  ?>
                                                            <option  value="<?php echo $clas->id_class; ?>"><?php echo $clas->class_name; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="shift_id" id="shift_id" class="form-control input-sm" style="width: 130px;">
                                                        <option value="">Select</option>  
                                                        <option value="1">Morning</option>
                                                        <option value="2">Afternoon</option>
                                                        <option value="3">Evening</option>
                                                    </select>
                                                </td>   
                                               
                                            	<td><input class="form-control input-sm" name="reg_id" id="reg_id" type="text" value="" placeholder="Registration ID" style="width: 100px;" required></td>
                                               
                                            	
                                                <td>
                                                <input type="text" class="form-control input-sm" name="search" id="search" placeholder="LastName/FirstName" style="width: 130px;">
                                                </td>
                                                
                                               
                                                
                                                <td>
                                                    <button class="btn btn-sm btn-primary" name="btnSearch" id="btnSearch" onclick="search_record();" type="button"><i class="fa fa-search"></i> Search </button>
                                                </td>
                                                
                                                <td>
                                                    <button class="btn btn-sm btn-success" name="btnSearch" id="btnSearch" onclick="loadmodal_generate_dues();" type="button"><i class="fa fa-plus"></i> Add </button>
                                                </td>
                                                
                                                <td>
                                                    <button class="btn btn-sm btn-info" name="btnSearch" id="btnSearch" onclick="loadmodalsms(0);" type="button"><i class="fa fa-envelope"></i> Send SMS </button>
                                                </td>
                                                
                                            </tr>
                                            </table>
                                            </form>
                                        </div>
                                    </div>
                            </div>     
                        </div> 
                    </div>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="userstable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <tr role="row" class="heading">
                                <th width="10%">Image</th>
                                <th width="10%">Reg.ID</th>
                                <th width="20%">Student's Name</th>
                                <th width="20%">Father's Name</th>
                                <th width="10%">No of Records</th>
                                <th width="10%">Amount</th>
                                <th width="20%">Actions</th
                            </tr>
                        </thead>
                        <tbody>
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
<div class="modal fade" id="add-fee"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
           
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <form>
                         <div class="row col-xs-12" id="loadind">

                           <div  class="col-md-4">     
                            <div class="form-group">
                                <label>Select Class(Single)</label>
                                <select class="form-control" id="class_id"  data-placeholder="Select Class" style="width: 100%;">
                                <?php  foreach($class as $class): ?>    
                                    <option value="<?php  echo $class->id_class; ?>"><?php  echo $class->class_name; ?></option>
                                <?php endforeach; ?>    
                                </select>
                             </div>
                            </div>
                             
                             
                           <div  class="col-md-4">      
                            <div class="form-group">
                                <label>Select Month(Multiple)</label>
                                <select class="form-control" id="months" multiple="multiple" data-placeholder="Select Month" style="width: 100%;">
                                <?php  foreach($months as $month): ?>    
                                    <option value="<?php  echo $month->id_month; ?>"><?php  echo $month->month_name; ?></option>
                                <?php endforeach; ?>    
                                </select>
                             </div>
                            </div>
                             
                           <div  class="col-md-4">     
                            <div class="form-group">
                                <label>Select Fee Head(Multiple)</label>
                                <select class="form-control" id="feehead"  data-placeholder="Select Fee Head" style="width: 100%;">
                                 <?php  foreach($feetype as $feetypes): ?>    
                                    <option value="<?php  echo $feetypes->id_fee_type; ?>"><?php  echo $feetypes->fee_type_name; ?></option>
                                 <?php endforeach; ?>    
                                </select>
                             </div>
                            </div>
                             
                        </div>     
                                
                         <div class="row col-xs-12">        
                            <div  class="col-md-4">   
                                <div class="form-group">
                                 <label>Due Date:</label>
                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right" id="due_date">
                                    </div>
                                    <!-- /.input group -->
                               </div>
                           </div>
                             
                           <div  class="col-md-4 hidden">   
                                <div class="form-group">
                                 <label>Registration ID(Multiple)</label>
                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                      </div>
                                        <input type="text" class="form-control pull-right" placeholder="100,101,102" id="st" name="st">
                                    </div>
                                    <!-- /.input group -->
                               </div>
                           </div>
                               
                           
                          <div class="form-group">  
                            <div class="pull-right" style="margin-right:0px!important;"> 
                            <button onclick="generate_dues();" readonly type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Generate</button>
                            <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
                           </div>  
                             
                             
                        </div>  
                            
                            
                       </form>
                    </div>
                </div>
            </div>
           </div>
            
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">

                            <!-- /.box-header -->
                            <div class="box-body table-responsive no-padding">
                                <table id="feetable"  class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="10%">Voucher#</th>
                                            <th width="10%">Reg.ID</th>
                                            <th width="20%">Student's Name</th>
                                            <th width="20%">Father's Name</th>
                                            <th width="15%">Amount</th>
                                            <th width="8%">Fine</th>
                                           

                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>   


                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
            </div>

            
            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
   <!-- BEGIN Fee MODAL FORM-->
<div class="modal fade" id="add-dues-details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title success" id="headertext"></h4>
            </div>
            <div class="modal-body">
              
                <div class="row">
                    <div class="col-md-12">
                        <table id="addproducttbl" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID#</th>
                                    <th>Fee Type</th>
                                    <th>Fee Month</th>
                                    <th>Fee Amount</th>
                                    <th>Fine Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="#" type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5 hidden">Print</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- END  MODAL FORM-->
<!-- BEGIN SMS MODAL FORM-->
<div class="modal fade" id="sms"  role="sms" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <div class="alert alert-warning success">
                        <!--<span class="icon-warning icon-2x" style="color:orange"></span>-->
                        If you want to incorporate student information from the database in the message, then you have to include certain codes in the place of student information.                        <br>
                        The codes are:
                        <br>
                        Code for student's name #B#
                        <br>
                        Code for student's father name #C#
                        <br>
                        Code for fee amount #D#
                    
                    </div>
            </div>
            
                        
            <div class="modal-body" id="smsloading">
                <form class="form-horizontal form-bordered form-row-stripped">
                    <div class="form-body">
                    <input type="text" class='hidden' id='cc' value='' />
                    <input type="text" class='hidden' id='f' value='' />
                                           
                    <div class="form-group class_sms">
                        <div class="col-sm-12">
                            <select name="class_sms_id" id="class_sms_id" class="form-control input-sm sms_id"  style="width:100%;">
                            <option value="0">All</option>    
                            <?php foreach($class_name as $clas):  ?>
                                    <option  value="<?php echo $clas->id_class; ?>"><?php echo $clas->class_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                         </div>    
                    </div>
                   <div class="form-group class_sms">
                       <div class="col-sm-12">
                        <select name="shiftsmsid" id="shiftsmsid" class="form-control input-sm">
                            <option value="0">All</option>
                            <option value="1">Morning</option>
                            <option value="2">Afternoon</option>
                            <option value="3">Evening</option>
                        </select>
                        </div>   
                    </div>
                        
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea class="form-control" cols="4" rows="8" name='message' id="message" placeholder="Message"></textarea>
                        </div>
                    </div>
                        
                    </div>
                </form>
                 
            </div>
            <div class="modal-footer">
                <button onclick="send_sms();" type="button" id="btnsend" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Send</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/timepicker/bootstrap-timepicker.min.js') ?> 
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?> 
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.js') ?>
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
<?= $this->Html->script('../plugins/input-mask/jquery.inputmask.js') ?>
 



<script>
    
    $(document).ready(function () {
      $("#userstable").DataTable();
      $("#months").select2();
      $("#feehead").select2();
      $("#class_id").select2();
      $("#class_id1").select2();
      $("#class_sms_id").select2();
      
      tabltint();
       var table = $('#userstable').DataTable();
 
        $('#userstable tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
              //  $(this).removeClass('selected');
               $(this).addClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );
      
       $('#due_date').datepicker({
         autoclose: true
        });
   
     });
    function search_record(){
       tabltint();
     
    }
    var tabltint = function () {
        if($.fn.DataTable.isDataTable("#userstable")){ 
            $("#userstable").dataTable().fnDestroy();
         }
 
        var theTable = $('#userstable').DataTable({
           
                //"dom": '<"top"i>rt<"bottom"flp><"clear">',
                'bFilter': false,
                'responsive': true,
                'processing': true,
                'serverSide': true,
                "error": false,
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "stateSave": true,
                "ajax": {
                    type: "POST",
                    url: "<?php echo $this->Url->build(['controller' => 'Dues', 'action' => 'getbysearch']); ?>",
                    dataType: 'json',
                    cache: false,
                    async: false,
                    "data": function ( d ) {
                        d.cc = $('#reg_id').val();
                        d.name = $('#search').val();
                        d.class_id = $('#class_id1 option:selected').val();
                        d.shift_id = $('#shift_id option:selected').val();
                    }
                },
                "oLanguage": {
                 "sProcessing": '<img src="https://eschools.cloud/images/loading-spinner-grey.gif">'
               },
                "columnDefs": [{ // define columns sorting options(by default all columns are sortable extept the first checkbox column)
                    'orderable': false,
                    'targets': [0]
                    
                }],
                "order": [
                    [1, "asc"]
                ], // set first column as a default sort by asc
                "columns": [
                        {"render": function (data, type, JsonResultRow, meta) {
                            return '<img class="img-circle" src="'+JsonResultRow.host+'"  style="width:20px;">';
                        }},
                        {"data": "reg_id"},
                        {"data": "name"},
                        {"data": "fname"},
                        {"data": "nom"},
                        {"data": "amount"},
                        {"data": "actions"},
                    ]
        });
        
   }  
   
    function generate_dues() {
        var m = []; 
            $('#months option:selected').each(function() {
             m.push($(this).val());
        });
        
         var fh = []; 
            $('#feehead option:selected').each(function() {
             fh.push($(this).val());
        }); 
        
        var class_id = $('#class_id option:selected').val();
        var due_date = $('#due_date').val();
        var ids = $('#st').val();
       
        if(due_date === ''){
            toastr["error"]("Please select Due Date.", "Due Date Not Selected!");
            return false;
        }
        if(m.length === 0){
            toastr["error"]("Please select fee month.", "Fee Month Not Selected!");
            return false;
        }
        
        if(fh.length === 0){
            toastr["error"]("Please select fee head first.", "Fee Head Not Selected!");
            return false;
        } 
       
        if(fh.length === 0){
            toastr["error"]("Please select fee head first.", "Fee Head Not Selected!");
            return false;
        }
        
        if(class_id === '0'){
            toastr["error"]("Please select class first.", "Class Not Selected!");
            return false;
        }
       
         
        imageOverlay('#feetable', 'show'); 
        $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'Dues', 'action' => 'generatedues']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {class:class_id ,months:m ,feehead:fh,dd:due_date,st:ids},
            success: function (data) {
                imageOverlay('#feetable', 'hide');
                var result = data.msg.split("|");
                var mdata = data.data;
                var mhtml = "";
                    $("#feetable tbody").html('');
                    if (result[0] === "Success") {
                        toastr.success(result[0], result[1]);
                        
                         for (var x = 0; x < mdata.length; x++) {
                            mhtml += '<tr>';
                                mhtml += "<td>" + mdata[x]['id_dues'] + "</td>";
                                mhtml += "<td>" + mdata[x]['reg_id'] + "</td>";
                                mhtml += "<td>" + mdata[x]['name'] + "</td>";
                                mhtml += "<td>" + mdata[x]['fname'] + "</td>";
                                mhtml += "<td>" + mdata[x]['amount'] + "</td>";
                                mhtml += "<td>" + mdata[x]['fine'] + "</td>";
                            mhtml += '</tr>';
                        }
                        $("#feetable tbody").append(mhtml);
                    } else {
                        toastr.error(result[0], result[1]);
                    }
                 
            }
        });
    }
    function loadmodal_generate_dues() {
        
        $("#feetable tbody").html('');
        $('#add-fee').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }
    function delete_record(id) {
       swal({
            title: 'Are you sure?',
            text: "you want to delete!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then(function (result) {
              
            var table = $('#userstable').DataTable();  
            table.row('.selected').remove().draw( false );
         
            if (result) {
                if (id > 0) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'Dues', 'action' => 'delete']); ?>",
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {id: id},
                        success: function (data) {
                            var result = data.msg.split("|");
                            if (result[0] === "Success") {
                                toastr.success(result[0], result[1]);
                               
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
    function loadmodal(id) {
        var user_role = '<?php echo $this->request->session()->read('Auth.User.role_id'); ?>';
        var ids = "#id"+id;
        $('#add-dues-details').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
         $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'Dues', 'action' => 'getduesdetails']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {id: id},
            beforeSend: function(){
                imageOverlay(ids, 'show');
            },
            success: function (data) {
                imageOverlay(ids, 'hide');
                var result = data.msg.split("|");
                var mdata = data.data;
                var mhtml = "";
                $("#addproducttbl tbody").html('');
                $('#headertext').text('');
                if (result[0] === "Success") {
                  //  toastr.success(result[0], result[1]);
                    for (var x = 0; x < mdata.length; x++) {
                     
                        mhtml += '<tr>';
                        mhtml += "<td class='id'>" + mdata[x]['id_dues'] + "</td>";
                        mhtml += "<td>" + mdata[x]['type_id'] + "</td>";
                        mhtml += "<td>" + mdata[x]['month_id'] + "</td>";
                        
                        mhtml += "<td><input class='form-control' type='number' id='d"+ mdata[x]['id_dues'] +"' value="+ mdata[x]['amount'] +" style='width:100px;'></td>";
                        mhtml += "<td><input class='form-control' type='number' id='f"+ mdata[x]['id_dues'] +"' value="+ mdata[x]['fine'] +" style='width:80px;'></td>";
                        if(user_role == 1){
                            mhtml += "<td><button onclick='removefromlist(" +  mdata[x]['id_dues'] + ");' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button> <button onclick='editfee(" +  mdata[x]['id_dues'] + ");' class='btn btn-warning btn-sm'><i class='fa fa-pencil'></i></button></td>";
                        }else{
                            mhtml += "<td></td>";
                        }
                        mhtml += '</tr>';
                        $('#add-feehead-details #headertext').text('Class  | Sectionv: ' + mdata[x]['class']);
                        $('#headertext').text('CC# : '+ mdata[x]['reg_id'] + ' | Name : ' +  mdata[x]['name'] );
                        
                    }
                    $("#addproducttbl tbody").append(mhtml);
                    
                    
                } else {
                    toastr.error(result[0], result[1]);
                }

            }
        });
 
    }
    function removefromlist(val){
        $('#addproducttbl').find("td.id").each(function(index) {
            if ($(this).html() == val) {
                $(this).closest('tr').remove();
            }
        });
        if (val > 0) {
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'Dues', 'action' => 'delete']); ?>",
                dataType: 'json',
                cache: false,
                async: false,
                data: {id: val},
                beforeSend: function(){
                    imageOverlay('#addproducttbl', 'show');
                },
                success: function (data) {
                    imageOverlay('#addproducttbl', 'hide');
                    var result = data.msg.split("|");
                    if (result[0] === "Success") {
                        toastr.success(result[0], result[1]);

                    } else {
                        toastr.error(result[0], result[1]);
                    }
                }
            });
        }
        
    }
    
    function loadmodalsms(id) {
        if(id == 0 ){
            $('.class_sms').removeClass('hidden');
            $('#f').val(0);
        }else{
            $('.class_sms').addClass('hidden');
             $('#f').val(1);
        }
    
        $('#cc').val(id);
        
        $('#sms').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }
    
    function send_sms(val){
       
       
        var id =  $('#cc').val();
        var  class_id = $('#class_sms_id option:selected').val();
        var  shift_id = $('#shiftsmsid option:selected').val();
        var flag = $('#f').val(); 
       
        var message  = $('#message').val()
        if(message == ''){
            toastr.error('Message can not be blank','Error');
            return false;
        }
     
       
        $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'dues', 'action' => 'sendsms']); ?>/"+flag,
                dataType: 'json',
                cache: false,
                async: false,
                data: {reg_id: id,message:message,class_id:class_id,shift_id:shift_id},
                beforeSend: function(){
                   imageOverlay('#smsloading','show');
                },
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
    
    function editfee(val){
        var amount = $('#d'+val).val();
        var fine = $('#f'+val).val();
        if (val > 0) {
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'Dues', 'action' => 'edit']); ?>",
                dataType: 'json',
                cache: false,
                async: false,
                data: {id: val,amount:amount,fine:fine},
                beforeSend: function(){
                    imageOverlay('#addproducttbl', 'show');
                },
                success: function (data) {
                    imageOverlay('#addproducttbl', 'hide');
                    var result = data.msg.split("|");
                    if (result[0] === "Success") {
                        toastr.success(result[0], result[1]);

                    } else {
                        toastr.error(result[0], result[1]);
                    }
                }
            });
        }
        
    }
      
</script>