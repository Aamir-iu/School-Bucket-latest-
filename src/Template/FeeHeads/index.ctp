<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
             
<!--           <div class="btn-group pull-right">
                  <a  href="#add-class" data-toggle="modal" data-original-title="Add Fee Head" title="Add Fee Head" class="btn btn-block btn-success">
                    <i class="fa fa-plus"></i> Add </a>
           </div>-->
                
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="userstable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID#</th>   
<!--                  <th>Campus</th>-->
                  <th>Class and Section</th>
                  
                  <th style="width:30%;">Action</th>
                  
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($class as $classa): ?>
                <tr>
                    <td><?= h($classa->id_class) ?></td>
<!--                    <td><?php // h($classa->campus) ?></td>-->
                    <td><?= h($classa->class_name) ?></td>
                   
                    
                     <td class="actions">
                           <?php // $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['action' => 'edit', $this->Number->format($feeHead->id_fee_heads)], ['class' => 'btn btn-icon waves-effect waves-light btn-warning m-b-5', 'escape' => false]) ?>
                           <?php // $this->Form->postLink(__('<i class="fa fa-trash"></i> Delete'), ['action' => 'delete', $this->Number->format($feeHead->id_fee_heads)], ['confirm' => __('Are you sure you want to delete # {0}?', $this->Number->format($feeHead->id_fee_heads)), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
                         
                         <a  href="#" onclick="loadmodal(<?= $this->Number->format($classa->id_class) ?>);"  class="btn btn-icon waves-effect waves-light btn-warning m-b-5"><i class="fa fa-pencil"></i> Set Fee Header </a>
<!--                         <a  href="#" onclick="delete_class(<?= $this->Number->format($classa->id_class) ?>);"  class="btn btn-icon waves-effect waves-light btn-danger m-b-5"><i class="fa fa-trash"></i> Delete </a>-->
                         
                     </td>
                   
                 
                </tr>
                  <?php endforeach; ?>
                </tfoot>
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
                           <select class="form-control" id="class_id"  data-placeholder="Select Fee Head" style="width: 100%;">
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

<!-- BEGIN Fee MODAL FORM-->
<div class="modal fade" id="add-feehead-details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title success" id="headertext">Save Fee Headers</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-3">Fee Type:</label>
                        <div class="col-md-9">
                           <select class="form-control" id="feehead"  data-placeholder="Select Fee Head" style="width: 100%;">
                            <?php  foreach($feetype as $feetypes): ?>    
                               <option value="<?php  echo $feetypes->id_fee_type; ?>"><?php  echo $feetypes->fee_type_name; ?></option>
                            <?php endforeach; ?>    
                           </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-3">Fee Amount<span class="required" aria-required="true">*</span></label>
                        <div class="col-md-9">
                            <input id="amount" type="number" min="" placeholder="Fee Amount" class="form-control numeric" value=""/>
                        </div>
                    </div>
                
                     <div class="form-group">
                        <label class="control-label col-md-3">Fine Amount <span class="required" aria-required="true">*</span></label>
                        <div class="col-md-9">
                            <input id="fine" type="number"   placeholder="Fine Amount" class="form-control" value=""/>
                            <input id="class_id" type="number" class="form-control hidden" value=""/>
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
                                    <th>Head ID</th>
                                    <th>Fee Head</th>
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
                <button onclick="update_details();" type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Save</button>
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
  <?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
  <?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
    
  <?= $this->Html->script('datatable.js') ?>  
<script>
  $(function () {
    $("#userstable").DataTable();
    
  });
  
    function addtolist(){
        if ($("#amount").val() == "" || $("#amount").val() == "0" ) {
            $("#amount").val(0);
             toastr["warning"]("Amount", "Empty Field(s) Found");
             return false;
        }
        if ($("#fine").val() == "") {
            $("#fine").val(0);
        }
        
        var exists = 0;
        if ($("#feehead option:selected").val() > 0) {
            $('#addproducttbl').find("td.id").each(function(index) {
                if ($(this).html() === $("#feehead option:selected").val()) {
                    exists = 1;
                }
            });
            
            var fee_id = $("#feehead option:selected").val();
            var fee_name = $("#feehead option:selected").text();
            
            var amount = $("#amount").val();
            var fine = $("#fine").val();
            var mhtml = "";
            if (exists == 0) {
                    mhtml+="<tr><td class='id'>" + fee_id + "</td><td>" + fee_name + "</td><td>" + amount + "</td><td>" + fine + "</td><td><button onclick='removefromlist(" + fee_id + ");' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button></td></tr>"
                     $("#addproducttbl tbody").append(mhtml);
                } else {
                     toastr["error"]("The fee head is already added. To change it, first remove, then add again!","ALREADY ADDED") ;
                }
            
           
        }
    }
  
    function removefromlist(val){
        $('#addproducttbl').find("td.id").each(function(index) {
            if ($(this).html() == val) {
                $(this).closest('tr').remove();
            }
        });
    }
  
    function loadmodal(id) {
        $('#class_id').val(id);
        
        $('#add-feehead-details').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
        
         $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'FeeHeads', 'action' => 'loadfeeheads']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {class: id},
            success: function (data) {
                var result = data.msg.split("|");
                var mdata = data.feeHeads;
                var mhtml = "";
                $("#addproducttbl tbody").html('');
                if (result[0] === "Success") {
                  //  toastr.success(result[0], result[1]);
                    for (var x = 0; x < mdata.length; x++) {
                       if(mdata[x]['fee_type_id'] > 0) {
                        mhtml += '<tr>';
                        mhtml += "<td class='id'>" + mdata[x]['fee_type_id'] + "</td>";
                        mhtml += "<td>" + mdata[x]['fee_head'] + "</td>";
                        mhtml += "<td>" + mdata[x]['class_fees'] + "</td>";
                        mhtml += "<td>" + mdata[x]['fine'] + "</td>";
                        mhtml += "<td><button onclick='removefromlist(" +  mdata[x]['fee_type_id'] + ");' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button></td>";
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
        var class_id = $('#class_id').val();
        var TableData;
        TableData = storeOTblValues()
        if (TableData.length > 0) {
            imageOverlay('#addproducttbl', 'show');
            toastr["info"]("Updating", "Fee Headers");
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller'=> 'FeeHeads', 'action' => 'adddetails']); ?>",
                dataType:'json',
                data: {details: TableData, class_id: class_id},
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
            toastr["warning"]("Nothing Added", "Fee Headers");
        }
        imageOverlay('#addproducttbl', 'hide');
    }
    
    function storeOTblValues(){
        var TableData = new Array();

        $('#addproducttbl tr').each(function(row, tr) {
            TableData[row] = {
                "fee_type_id": $(tr).find('td:eq(0)').text()
                , "amount": $(tr).find('td:eq(2)').text()
                , "fine": $(tr).find('td:eq(3)').text()
            }
        });
        TableData.shift();  // first row will be empty - so remove
        return TableData;
    }
    
    
    
    function save_class(){
            var class_id = $('#class_id option:selected').val();
            imageOverlay('#saveid', 'show');
            toastr["info"]("Updating", "New Class");
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller'=> 'FeeHeads', 'action' => 'add']); ?>",
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
            if (result == true) {
                if (id > 0) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'FeeHeads', 'action' => 'delete']); ?>",
                        dataType: 'json',
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
                    //swal("Deleted!", "Your imaginary file has been deleted.", "success");
        });

    }
  
  
</script>