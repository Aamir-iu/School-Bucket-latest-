           
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
<!--                                    <div class="box-tools">
                                        <div class="input-group">
                                            <form method="post" action="" id="search-form" class="form-horizontal">
                                               
                                                    <button class="btn btn-sm btn-success" name="btnSearch" id="btnSearch" onclick="loadmodal_for_class();" type="button"><i class="fa fa-plus"></i> Add </button>
                                               
                                            </form>
                                        </div>
                                    </div>-->
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
    <div class="modal-dialog" style="width:80%!important;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title success" id="headertext">Save Exam Setting</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    
                    <input type="text" class="hidden" id="class_id_for_store" value="" />
                    
                    <div class="form-group">
                       <label class="control-label col-md-2">Exam Type <span class="required" aria-required="true">*</span></label>
                      <div class="col-sm-4">
                          <select class="form-control"  onchange="loadmodal();"  id="exam_types" name="exam_types" data-placeholder="Select Exam Type" style="width: 100%;">
                         <?php  foreach($exam_types as $exam_types): ?>    
                            <option value="<?php  echo $exam_types->id_exam_types; ?>"><?php  echo $exam_types->exam_type; ?></option>
                         <?php endforeach; ?>    
                        </select>
                       </div> 
                          
                     <label class="control-label col-md-2">Subject <span class="required" aria-required="true">*</span></label>
                      <div class="col-sm-4">
                        <select class="form-control" id="subject" name="subject" data-placeholder="Select Subjec" style="width: 100%;">
                         <?php  foreach($subjects as $subjects): ?>    
                            <option value="<?php  echo $subjects->id_subjects; ?>"><?php  echo $subjects->subject_name; ?>   <?php  echo $subjects->subject_desc; ?></option>
                         <?php endforeach; ?>    
                        </select>
                       </div>     
                          
                          
                     </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-2">Total Marks <span class="required" aria-required="true">*</span></label>
                        <div class="col-md-4">
                            <input id="total_marks" type="text"  placeholder="Total Mark" class="form-control" value=""/>
                        </div>
                        
                        <label class="control-label col-md-2">Passing Marks <span class="required" aria-required="true">*</span></label>
                        <div class="col-md-2">
                            <input id="passing_marks" type="text"  placeholder="Passing Mark" class="form-control" value=""/>
                        </div>
                        <div class="col-md-2">
                            <input id="order_id" type="text"  placeholder="Order No" class="form-control" value=""/>
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
                                    <th style='width:5%;'>Subject ID</th>
                                    <th style='width:20%;'>Subject</th>
                                    <th style='width:20%;'>Exam Type</th>
                                    <th style='width:8%;'>Total Marks</th>
                                    <th style='width:8%;'>Passing Marks</th>
                                    <th style='width:8%;'>Subject Order No</th>
                                    <th style='width:31%;'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="update_details();" type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Save</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
-->
<!-- BEGIN Fee MODAL FORM-->
<div class="modal fade" id="add-class" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title success" id="headertext">Add New Class :</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="saveid">
                    <div class="form-group">
                        <label class="control-label col-md-3">Select Class:</label>
                        <div class="col-md-9">
                           <select class="form-control" id="id_class"  data-placeholder="Select Fee Head" style="width: 100%;">
                            <?php  foreach($class as $class): ?>    
                               <option value="<?php  echo $class->id_class; ?>"><?php  echo $class->class_name; ?></option>
                            <?php endforeach; ?>    
                           </select>
                        </div>
                    </div>
                 </form>
             </div>
            <div class="modal-footer">
                <button onclick="save_class();" type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Save</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- END  MODAL FORM-->



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
 
<script>
    
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
             toastr["warning"]("Passing Marks", "Empty Field(s) Found");
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
            
            var total = $("#total_marks").val();
            var passing = $("#passing_marks").val();
            var order_id = $("#order_id").val();
            
            
            var mhtml = "";
            if (exists == 0) {
                    mhtml+="<tr><td class='id'>" + subject_id + "</td><td>" + subject_name + "</td><td style='display:none;'>" + exam_type_id + "</td><td>" + exam_type + "</td><td><input type='text' style='text-align:center' value=" + total + "></td><td><input type='text' style='text-align:center' value=" + passing + "></td><td><input type='text' style='text-align:center' value=" + order_id + "></td><td><button onclick='removefromlist(" + subject_id + ");' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button> <button onclick='addMarks("+ class_id + ',' + subject_id + ',' + exam_type_id +");' class='btn btn-success btn-sm'><i class='fa fa-print'></i></button>  <button onclick='addMarks("+ class_id + ',' + subject_id + ',' + exam_type_id +");' class='btn btn-info btn-sm'><i class='fa fa-plus'></i></button> </td></tr>"
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
    
    
    function loadmodal_for_class(){
        
        $('#add-class').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
        
    }
    
    function save_class(){
            var class_id = $('#id_class option:selected').val();
            
            imageOverlay('#saveid', 'show');
            toastr["info"]("Updating", "New Class");
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller'=> 'ExamMarksDetails', 'action' => 'add']); ?>",
                dataType:'json',
                data: {class_id: class_id},
                success: function(data) {
                    var result = data.msg.split("|");
                    if (result[0] === "Success") {
                        toastr.success(result[0], result[1]);
                        location.reload();
                       } else {
                        toastr.warning(result[0], result[1]);                        
                    }
                }
            });
      
        imageOverlay('#saveid', 'hide');
    }
      
    function loadmodal(id) {
   
        $('#class_id_for_store').val(id);
        
        var func = 'loadmodal('+id+')';
        $('#exam_types').attr('onchange',func);
        
        var exam_types = $('#exam_types option:selected').val();
       
        $('#add-details').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
        
         $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'ExamMarksDetails', 'action' => 'loadfeeheads']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {class: id,exam_types:exam_types},
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
                        mhtml += "<td><input type='text' style='text-align:center;width:80px;' id='t"+mdata[x]['id_marks_detail']+"' value=" + mdata[x]['max_marks'] + "></td>";
                        mhtml += "<td><input type='text' style='text-align:center;width:80px;' id='p"+mdata[x]['id_marks_detail']+"' value=" + mdata[x]['min_marks'] + "></td>";
                        mhtml += "<td><input type='text' style='text-align:center;width:50px;' id='o"+mdata[x]['id_marks_detail']+"' value=" + mdata[x]['order_id'] + "></td>";
                        mhtml += "<td><button onclick='removefromlist(" +  mdata[x]['subject_id'] + ");' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button> <button onclick='editdetail(" +  mdata[x]['id_marks_detail'] + ");' class='btn btn-warning btn-sm'><i class='fa fa-pencil'></i></button> <button onclick='printAwardList("+ id +',' + mdata[x]['subject_id'] + ',' + mdata[x]['exam_type_id'] +");' class='btn btn-success btn-sm'><i class='fa fa-print'></i></button>  </button> <button onclick='printAwardListFill("+ id +',' + mdata[x]['subject_id'] + ',' + mdata[x]['exam_type_id'] +");' class='btn btn-success btn-sm'><i class='fa fa-print'></i></button> <button onclick='addMarks("+ id +',' + mdata[x]['subject_id'] + ',' + mdata[x]['exam_type_id'] +");' class='btn btn-info btn-sm'><i class='fa fa-plus'></i></button> </td>";
                        mhtml += '</tr>';
                        $('#add-feehead-details #headertext').text('Class  | Sectionv: ' + mdata[x]['class']);
                        }
                        
                    }
                    $("#addproducttbl tbody").append(mhtml);
                } else {
                    toastr.error(result[0], result[1]);
                }

            }
        });
 
    }
    
    function update_details(){
       
        var class_id = $('#class_id_for_store').val();
        var exam_types = $('#exam_types option:selected').val();
        
        var TableData;
        TableData = storeOTblValues()
        if (TableData.length > 0) {
            imageOverlay('#addproducttbl', 'show');
            toastr["info"]("Updating", "Exam Header");
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller'=> 'ExamMarksDetails', 'action' => 'adddetails']); ?>",
                dataType:'json',
                data: {details: TableData, class_id: class_id,exam_types:exam_types},
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
                , "total": $(tr).find('td:eq(4)>input').val()
                , "passing": $(tr).find('td:eq(5)>input').val()
                , "order_id": $(tr).find('td:eq(6)>input').val()
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
    
    function printAwardList(class_id,subject_id,exam_type_id) {
        var f = 1;
        swal({
            title: 'Select Shift',
            input: 'select',
            inputOptions: {
              '1': 'Morning',
              '2': 'Afternoon',
              '3': 'Evening'
            },
           // inputPlaceholder: 'Select country',
            showCancelButton: true,
            inputValidator: function (value) {
              return new Promise(function (resolve, reject) {

                resolve()
                window.open("<?php echo $this->Url->build(['controller' => 'ExamMarksDetails', 'action' => 'view']); ?>/"+ f + "/" + class_id + "/" + subject_id + "/" + exam_type_id + "/" +value);

              })
            }
          }).then(function (result) {
//            swal({
//              type: 'success',
//              html: 'You selected: ' + result
//            })
        })
 
    }
    function printAwardListFill(class_id,subject_id,exam_type_id) {
        var f = 2;
        swal({
            title: 'Select Shift',
            input: 'select',
            inputOptions: {
              '1': 'Morning',
              '2': 'Afternoon',
              '3': 'Evening'
            },
           // inputPlaceholder: 'Select country',
            showCancelButton: true,
            inputValidator: function (value) {
              return new Promise(function (resolve, reject) {

                resolve()
                window.open("<?php echo $this->Url->build(['controller' => 'ExamMarksDetails', 'action' => 'view']); ?>/"+ f + "/" + class_id + "/" + subject_id + "/" + exam_type_id + "/" +value);

              })
            }
          }).then(function (result) {
//            swal({
//              type: 'success',
//              html: 'You selected: ' + result
//            })
        })
 
    }
    function addMarks(class_id,subject_id,exam_type_id) {
        var f = 2;
        swal({
            title: 'Select Shift',
            input: 'select',
            inputOptions: {
              '1': 'Morning',
              '2': 'Afternoon',
              '3': 'Evening'
            },
           // inputPlaceholder: 'Select country',
            showCancelButton: true,
            inputValidator: function (value) {
              return new Promise(function (resolve, reject) {

                resolve()
                window.open("<?php echo $this->Url->build(['controller' => 'ExamMarksDetails', 'action' => 'addMarks']); ?>/"+ f + "/" + class_id + "/" + subject_id + "/" + exam_type_id + "/" +value);

              })
            }
          }).then(function (result) {
//            swal({
//              type: 'success',
//              html: 'You selected: ' + result
//            })
        })
 
    }
    
    
</script>

