           
<?= $this->Html->css('../plugins/timepicker/bootstrap-timepicker.min.css') ?> 
<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?>
<?= $this->Html->css('../plugins/datatables/jquery.dataTables.css') ?>
<?= $this->Html->css('../plugins/datatables/jquery.dataTables.min.css') ?>
<?= $this->Html->css('../plugins/datatables/jquery.dataTables_themeroller.css') ?>


<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">

                    <div class="btn-group pull-right">
                        <div class="row">
                            <div class="col-xs-8">

                            </div>     
                        </div> 
                      
                    </div>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-container">
                        <table class="table table-striped  table-hover" id="userstable">    
                            <thead>
                                <tr>
                                    
                                    <th style="width:10%;">Class ID</th>
                                    <th>Class Name</th>
                                    <th style="width:30%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach ($class as $classs): ?>
                                <tr>
                                    <td><?= h($classs->id_class) ?></td>
                                    <td><?= h($classs->class_name) ?></td>
                                
                                    <td class="actions">
                                       <a  href="#" onclick="loadmodal(<?= $this->Number->format($classs->id_class) ?>);"  class="btn btn-icon waves-effect waves-light btn-warning m-b-5"><i class="fa fa-pencil"></i> Add Details </a>
<!--                                        <a  href="#" onclick="delete_class(<?= $classs->id_class ?>);"  class="btn btn-icon waves-effect waves-light btn-danger m-b-5"><i class="fa fa-trash"></i> Delete </a>-->
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                
                                
                                
                                
                            </tbody>
                             
                        </table>
                    </div>
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


<!-- BEGIN Fee MODAL FORM-->
<div class="modal fade" id="add-details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:70%!important;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title success" id="headertext">Date Sheet Detail</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    
                    <input type="text" class="hidden" id="class_id_for_store" value="" />
                    
                    <div class="form-group">
                       <label class="control-label col-md-2">Exam Type <span class="required" aria-required="true">*</span></label>
                      <div class="col-sm-3">
                          <select class="form-control"  onchange="loadmodal();"  id="exam_types" name="exam_types" data-placeholder="Select Exam Type" style="width: 100%;">
                         <?php  foreach($exam_types as $exam_types): ?>    
                            <option value="<?php  echo $exam_types->id_exam_types; ?>"><?php  echo $exam_types->exam_type; ?></option>
                         <?php endforeach; ?>    
                        </select>
                       </div> 
                          
                     <label class="control-label col-md-2">Subject <span class="required" aria-required="true">*</span></label>
                      <div class="col-sm-5">
                        <select class="form-control" id="subject" name="subject" data-placeholder="Select Subjec" style="width: 100%;">
                         <?php  foreach($subjects as $subjects): ?>    
                            <option value="<?php  echo $subjects->id_subjects; ?>"><?php  echo $subjects->subject_name; ?>   <?php  echo $subjects->subject_desc; ?></option>
                         <?php endforeach; ?>    
                        </select>
                       </div>     
                          
                          
                     </div>
                    
                    <div class="form-group">
                        
                        <label class="control-label col-md-2">Shift <span class="required" aria-required="true">*</span></label>
                        <div class="col-sm-3">
                        <select class="form-control" id="shift_id" name="shift_id" data-placeholder="Select Shift" style="width: 100%;">
                            <option value="1">Morning</option>
                            <option value="2">Afternoon</option>
                            <option value="3">Evening</option>

                        </select>
                       </div>     
                        
                        <label class="control-label col-md-2">Date <span class="required" aria-required="true">*</span></label>
                        
                        <div class="col-md-3">
                            <input id="passing_marks" type="date"  placeholder="Passing Mark" class="form-control" value=""/>
                        </div>
                        
                        <div class="col-md-2">
                            <input id="order_id" type="time"  placeholder="Order No" class="form-control" value=""/>
                        </div>
                        
                        
                        
                    </div>
                    
                </form>
                
                <div class="row">
                    <div class="col-md-12" style="text-align: right">
                        <button class="btn btn-sm btn-primary" onclick="addtolist();"><i class="fa fa-angle-down"></i> Add</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table id="addproducttbl" class="table table-striped">
                            <thead>
                                <tr>
                                    <th style='width:5%;'>Sub_ID</th>
                                    <th style='width:20%;'>Subject</th>
                                    <th style='width:20%;'>Exam Type</th>
                                    <th style='width:8%;'>Date</th>
                                    <th style='width:8%;'>Day</th>
                                    <th style='width:8%;'>Time</th>
                                    <th style='width:31%;'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea class="form-control" cols="4" rows="8" name='message' id="message" placeholder="Message"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-12">
                        <select  class="form-control" name="temp_id" id="temp_id">
                            <option value="1">Template #1</option>
                            <option value="2">Template #2</option>
                        </select>
                        </div>    
                    </div> 
                    
                    
                </div>
            </div>
            
            <div class="modal-footer">
                <button onclick="update_details();" type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Save</button>
                <button onclick="printAdmitCard();" type="button" class="btn btn-icon waves-effect waves-light btn-success m-b-5">Print</button>
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

<?php // $this->Html->script('datatable.js') ?> 
  <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
<script>
    
    CKEDITOR.replace( 'message' );
    
    $(document).ready(function(){
       $('#userstable').DataTable();
        
    });
 
    $(document).ready(function () {
       
  
    $("#id_class").select2();
    $("#class_id").select2();
    $("#subject").select2();
 
    
    });
    
    function addtolist(){
          
        if ($("#total_marks").val() == "" || $("#total_marks").val() == "0" ) {
            $("#total_marks").val(0);
             toastr["warning"]("Total Marks", "Empty Field(s) Found");
             return false;
        }
       
        if ($("#passing_marks").val() == "" || $("#passing_marks").val() == "0" ) {
            $("#passing_marks").val(0);
             toastr["warning"]("Date", "Empty Field(s) Found");
             return false;
        }
        
        var exists = 0;
        if ($("#subject option:selected").val() > 0) {
            $('#addproducttbl').find("td.id").each(function(index) {
                if ($(this).html() === $("#subject option:selected").val()) {
                    exists = 1;
                }
            });
            
            var subject_id = $("#subject option:selected").val();
            var subject_name = $("#subject option:selected").text();
            
            
            var exam_type_id = $("#exam_types option:selected").val();
            var exam_type = $("#exam_types option:selected").text();
            
            var class_id = $("#class_id_for_store").val();
            
            var date = $("#passing_marks").val();
            var time = $("#order_id").val();
            
            
            var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
            var a = new Date(date);
            var day = weekday[a.getDay()];

            
            
            var mhtml = "";
            if (exists == 0) {
                    mhtml+="<tr><td class='id'>" + subject_id + "</td><td>" + subject_name + "</td><td style='display:none;'>" + exam_type_id + "</td><td>" + exam_type + "</td><td><input type='text' style='text-align:center;width:120px;' value=" + date + "></td><td><input type='text' style='text-align:center;width:120px;' value=" + day + "></td><td><input type='text' style='text-align:center;width:120px;' value=" + time + "></td><td><button onclick='removefromlist(" + subject_id + ");' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button> </td></tr>"
                     $("#addproducttbl tbody").append(mhtml);
                } else {
                     toastr["error"]("Sorry the subject is already added. To change it, first remove, then add again!","ALREADY ADDED") ;
                }
            
           
        }
    }
    
    function removefromlist(val){
        $('#addproducttbl').find("td.id").each(function(index) {
            if ($(this).html() == val) {
                $(this).closest('tr').remove();
                toastr.success("Subject has been removed!","Success") ;
            }
        });
    }
    
      
    function loadmodal(id) {
   
        $('#class_id_for_store').val(id);
        
        var func = 'loadmodal('+id+')';
        $('#exam_types').attr('onchange',func);
        $('#shift_id').attr('onchange',func);
        
        var exam_types = $('#exam_types option:selected').val();
        var shift_id = $('#shift_id option:selected').val();
       
       
        $('#add-details').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
        imageOverlay('#addproducttbl', 'show');
         $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'AdminCardDatesheet', 'action' => 'loadrecords']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {class: id,exam_types:exam_types,shift_id:shift_id},
            success: function (data) {
                var result = data.msg.split("|");
                var mdata = data.examType;
                var mhtml = "";
                $("#addproducttbl tbody").html('');
                if (result[0] === "Success") {
                  //  toastr.success(result[0], result[1]);
                    for (var x = 0; x < mdata.length; x++) {
                       if(mdata[x]['subject_id'] > 0) {
                        mhtml += '<tr>';
                        mhtml += "<td class='id'>" + mdata[x]['subject_id'] + "</td>";
                        mhtml += "<td>" + mdata[x]['subject'] + " " +  mdata[x]['sub_desc'] + "</td>";
                        mhtml += "<td style='display:none;'>" + mdata[x]['exam_type_id'] + "</td>";
                        mhtml += "<td>" + mdata[x]['et'] + "</td>";
                        mhtml += "<td><input type='text' style='text-align:center;width:120px;' id='t"+mdata[x]['id_marks_detail']+"' value=" + mdata[x]['dated'] + "></td>";
                        mhtml += "<td><input type='text' style='text-align:center;width:120px;' id='p"+mdata[x]['id_marks_detail']+"' value=" + mdata[x]['day'] + "></td>";
                        mhtml += "<td><input type='text' style='text-align:center;width:120px;' id='o"+mdata[x]['id_marks_detail']+"' value=" + mdata[x]['time'] + "></td>";
                        mhtml += "<td><button onclick='removefromlist(" +  mdata[x]['subject_id'] + ");' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button> </td>";
                        mhtml += '</tr>';
                        $('#add-feehead-details #headertext').text('Class  | Sectionv: ' + mdata[x]['class']);
                        }
                        //CKEDITOR.instances['message'].setData('');  
                        CKEDITOR.instances['message'].setData(mdata[x]['message']);  //$('#message').html();
                    }
                    $("#addproducttbl tbody").append(mhtml);
                } else {
                    toastr.error(result[0], result[1]);
                }

            }
        });
        imageOverlay('#addproducttbl', 'hide');
    }
    
    function update_details(){
       
        var class_id = $('#class_id_for_store').val();
        var exam_types = $('#exam_types option:selected').val();
        var shift_id = $('#shift_id option:selected').val();
        var message = CKEDITOR.instances['message'].getData();  //$('#message').html();
        var TableData;
        TableData = storeOTblValues()
        if (TableData.length > 0) {
            imageOverlay('#addproducttbl', 'show');
            toastr["info"]("Updating", "Date Sheet");
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller'=> 'AdminCardDatesheet', 'action' => 'adddetails']); ?>",
                dataType:'json',
                data: {details: TableData, class_id: class_id,exam_types:exam_types,shift_id:shift_id,message:message},
                success: function(data) {
                    var result = data.msg.split("|");
                    if (result[0] === "Success") {
                        toastr.success(result[0], result[1]);
                       } else {
                        toastr.warning(result[0], result[1]);                        
                    }
                }
            });
        } else {
            toastr["warning"]("Nothing Added", "Exam Header");
        }
        imageOverlay('#addproducttbl', 'hide');
    }
    
    function storeOTblValues(){
        var TableData = new Array();

        $('#addproducttbl tr').each(function(row, tr) {
            TableData[row] = {
                "subject_id": $(tr).find('td:eq(0)').text()
                , "exam_type_id": $(tr).find('td:eq(2)').text()
                , "date": $(tr).find('td:eq(4)>input').val()
                , "day": $(tr).find('td:eq(5)>input').val()
                , "time": $(tr).find('td:eq(6)>input').val()
            }
        });
        TableData.shift();  // first row will be empty - so remove
        return TableData;
    }
     
     function delete_class(id) {
       swal({
            title: 'Are you sure?',
            text: "you want to delete!",
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
                        url: "<?php echo $this->Url->build(['controller' => 'ExamMarksDetails', 'action' => 'delete']); ?>",
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
    
    function editdetail(val){
    
        var total = $('#t'+val).val();
        var passing = $('#p'+val).val();
        var order_id = $('#o'+val).val();
        
        if (val > 0) {
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller' => 'ExamMarksDetails', 'action' => 'edit']); ?>",
                dataType: 'json',
                cache: false,
                async: false,
                data: {id: val,min_marks:passing,max_marks:total,order_id:order_id},
                beforeSend: function(){
                   // imageOverlay('#addproducttbl', 'show');
                },
                success: function (data) {
                   // imageOverlay('#addproducttbl', 'hide');
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
    
    function printAdmitCard() {
    
    var class_id = $('#class_id_for_store').val();
    var shift_id= $('#shift_id option:selected').val();
    var exam_type_id= $('#exam_types option:selected').val();
    var temp_id = $('#temp_id option:selected').val();
    
        window.open("<?php echo $this->Url->build(['controller' => 'AdminCardDatesheet', 'action' => 'view']); ?>/" + class_id + "/" + shift_id + "/"+exam_type_id + "/"+temp_id);
        
    }
   
    
    
</script>

