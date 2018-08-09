<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">

                    <h3 class="box-title">Daily Expense</h3>
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
                                <th width="10%">Voucher#</th>
                                <th width="20%">Expense Desc.</th>
                                <th width="10%">Amount</th>
                                <th width="20%">Created_By</th>
                                <th width="20%">Created_On</th>
                                <th width="20%">Actions</th
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($expanses as $expanse): ?>
                                <tr>

                                    <td><?= $expanse->voucher_number ?></td>
                                    <td><?= h($expanse->expanse_desc) ?></td>
                                    <td><?= $this->Number->format($expanse->amount) ?></td>
                                    <td><?= h($expanse->user_name) ?></td>
                                    <td><?= h($expanse->exp_date) ?></td>
                                    <td class="actions">
                                        
                                        <?= $this->Html->link(__('<i class="fa fa-print"></i> Print'), ['action' => 'view',1,$expanse->voucher_number], ['class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'target'=>'blank','escape' => false]) ?>
                                        <?= $this->Html->link(__('<i class="fa fa-pencil"></i> Edit'), ['#' => '#'], ['onclick'=>"edit_expaneses($expanse->voucher_number);",'class' => 'btn btn-icon waves-effect waves-light btn-warning m-b-5', 'escape' => false]) ?>
                                       

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
<div class="modal fade" id="add-fee"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <div class="box-header">
                    <strong>Daily Expense </strong>
               </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    
                    <div class="col-md-8">
                     <div class="form-group">
                           <select id="transactionaccountid" name="account_voucher_type_id" class="form-control" style="width:100%;">
                                <?php foreach ($transaction_account as $transaction_accounts): ?>    
                                    <option value="<?php echo $transaction_accounts->id_transaction_account; ?>"><?php echo $transaction_accounts->ma . "-" . $transaction_accounts->ca . "-" . $transaction_accounts->sca . "-" . $transaction_accounts->transaction_account_number . "|" . $transaction_accounts->transaction_account_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text"  placeholder="Date" name="expansedate" value="<?php echo date("m/d/Y"); ?>" class="form-control pull-right" id="datepicker">
                                </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="form-group">
                        <input type="text"  placeholder="Remarks" class="form-control" id="remarks">
                        </div>
                    </div>
                    
                    <div class="col-sm-2">
                            <div class="form-group">
                            <input type="number"  placeholder="Amount" class="form-control" id="amount">
                            <input type="text" class="hidden" id="removeid" value="">
                            </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <div class="form-group">
                            <select class="form-control" name="shift_id" id="shift_id">
                        
                            <option value="1">Morning</option>
                            <option value="2">Afternoon</option>
                            <option value="3">Evening</option>

                            </select>
                        </div>
                    </div>
                    
                    
               </div>
                <div class="row">
                    <div class="col-md-2 pull-right">
                        <button class="btn btn-block btn-success" onclick="addtolist();" counter="1" ><i class="fa fa-plus"></i> Add</button>
                    </div>
            </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                           <!-- /.box-header -->
                            <div class="box-body table-responsive no-padding">
                                <table id="exptable"  class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Account#</th>
                                            <th>Title</th>
                                            <th>Remarks</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Action</th>
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
            <div class="modal-footer">
                <button onclick="save_expanses();"  readonly type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Save</button>
                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- BEGIN EDIT SUB ACCOUNT MODAL FORM-->
<div class="modal fade" id="edit-expanses"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <div class="box-header">
                    <strong>Edit Daily Expense </strong>
               </div>
            </div>
            <div class="modal-body">
             <div class="row">
             
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                           <!-- /.box-header -->
                            <div class="box-body table-responsive no-padding">
                                <table id="editexptable"  class="table table-hover">
                                    <thead>
                                        <tr>
                                            
                                            <th>ID#</th>
                                            <th>Voucher#</th>
                                            <th>Remarks</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                            
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
            <div class="modal-footer">
               <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
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
        $("#transactionaccountid").select2();

    });

    $(function () {
        $("#userstable").DataTable();

    });
     $('#datepicker').datepicker({
      autoclose: true
    });
    function loadmodal() {

        $('#add-fee').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    }
    
    

    function addtolist(){
       
            var temp_record = $("#transactionaccountid option:selected").text().split("|");
            var account = temp_record[0];
            var title = temp_record[1];
            var id    = $("#transactionaccountid option:selected").val();
            var remarks        = $("#remarks").val();
            var amount        = $("#amount").val();
            var date        = $("#datepicker").val();
            
            if(remarks===''){
                 toastr["error"]("Please Enter The  Remarks Of Expenses.");
                 return false;
            }
            
            if(amount===''){
                 toastr["error"]("Please Enter The  Amount Of Expenses.");
                 return false;
            }
            
            if(date===''){
                 toastr["error"]("Please Enter The  Date Of Expenses.");
                 return false;
            }
          
            var shift_id = $('#shift_id option:selected').val();
          
            var mhtml = "";
            mhtml+="<tr><td class='id' style='display:none;'>" + id + "</td><td class='id'>" + account + "</td><td>" + title + "</td><td>" + remarks + "</td><td>" + amount + "</td><td>" + date + "</td>  <td class='id' style='display:none;'>" + shift_id + "</td> <td><button onclick='removefromlist(" + id + ");' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button></td></tr>"
            $("#exptable tbody").append(mhtml);
         
        }

        function removefromlist(val){
            $('#exptable').find("td.id").each(function(index) {
                if ($(this).html() == val) {
                    $(this).closest('tr').remove();
                }
            });
        }
        
     function storeOTblValues()
        {
            var TableData = new Array();

            $('#exptable tr').each(function(row, tr) {
                TableData[row] = {
                    "tca": $(tr).find('td:eq(0)').text()
                    , "expanse_desc": $(tr).find('td:eq(3)').text()
                    , "amount": $(tr).find('td:eq(4)').text()
                    , "expanse_date": $(tr).find('td:eq(5)').text()
                    , "shift_id": $(tr).find('td:eq(6)').text()
                }
            });
            TableData.shift();  // first row will be empty - so remove
            return TableData;
        }
        
    function save_expanses(){
      
        var TableData;
        TableData = storeOTblValues()
        if (TableData.length > 0) {
            toastr["info"]("Updating", "Transactions");
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller'=> 'Expanses', 'action' => 'add']); ?>",
                dataType:'json',
                data: {data: TableData},
                success: function(data) {
                    var result = data.msg.split("|");
                    if (result[0] === "Success") {
                        toastr.success(result[0], result[1]);
                        $('#add-po-details').modal('hide');
                        location.reload();
                    } else {
                        toastr.warning(result[0], result[1]);                        
                    }
                }
            });
        } else {
            toastr["warning"]("Nothing Added", "Transaction Details");
        }
    } 
        
   
   function edit_expaneses(id){
   
    $('#edit-expanses').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
    });
        
      $.ajax({
            type: "POST",
            url: "<?php echo $this->Url->build(['controller' => 'Expanses', 'action' => 'getdetails']); ?>",
            dataType: 'json',
            cache: false,
            async: false,
            data: {vo: id},
            success: function (data) {
                var mdata = data.data;
                var mhtml = "";
                $("#editexptable tbody").html('');
                
                for (var x = 0; x < mdata.length; x++) {
                    mhtml += '<tr>';
                        mhtml += "<td class='id' style='display:none;'>" + mdata[x]['id_expanses'] + "</td>";
                        mhtml += "<td>" + mdata[x]['id_expanses'] + "</td>";
                        mhtml += "<td>" + mdata[x]['voucher_number'] + "</td>";
                        mhtml += "<td>" + mdata[x]['expanse_desc'] + "</td>";
                        mhtml += "<td>" + mdata[x]['amount'] + "</td>";
                        mhtml += "<td><button onclick='delete_voucher(" + mdata[x]['id_expanses'] + ");' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button></td>";
                        
                    mhtml += '</tr>';
                }
                
                $("#editexptable tbody").append(mhtml);
            }
        });    
        
   
   
   }
   
        
   function delete_voucher(id) {

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
                        url: "<?php echo $this->Url->build(['controller' => 'Expanses', 'action' => 'delete']); ?>",
                        dataType: 'json',
                        cache: false,
                        async: false,
                        data: {id: id},
                        success: function (data) {
                            var result = data.msg.split("|");
                            if (result[0] === "Success") {
                                toastr.success(result[0], result[1]);
                                remove(id);
                                
                                
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
    
    function remove(val){
       
        $('#editexptable').find("td.id").each(function(index) {
            if ($(this).html() == val) {
                $(this).closest('tr').remove();
            }
        });
    } 
    
    

</script>
