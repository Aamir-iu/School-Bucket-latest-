<style type="text/css">
    #result
    {
        position:absolute;
        width:600px;
        padding:10px;
        display:none;
        margin-top:30px;
        border-top:0px;
        max-height:320px;
        overflow-y:auto;
        border:1px #CCC solid;
        background-color: white;
        z-index : 1000;





    }
    .show
    {
        padding:10px; 
        border-bottom:1px #999 dashed;
        font-size:15px; 
        height:50px;


    }
    .show:hover
    {
        background:#4c66a4;
        color:#FFF;
        cursor:pointer;
    }


</style>
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
                        <div class="col-xs-12">
                            <div class="box-tools">
                                        <div class="input-group">
                                            <form method="post" action="" id="search-form" class="form-horizontal">
                                            <table class="table table-responsive" cellpadding="3" cellspacing="3" width="100%">
                                             
                                            <tr>
                                                <td>From Date</td>
                                            	<td>To Date</td>
                                                <td class="hidden">Invoice Number</td>
                                                <td>PO Number</td>
                                                <td>Supplier Name</td>
                                                <td>Status</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td><input class="form-control input-sm" name="from" id="from" type="text" value="" placeholder="From Date" style="width: 100px;" required></td>
                                                <td><input class="form-control input-sm" name="to" id="to" type="text" value="" placeholder="To Date" style="width: 100px;" required></td>
                                                <td class="hidden"><input class="form-control input-sm" name="order_number" id="order_number" type="text" value="" placeholder="Order Number" style="width: 80px;" required></td>
                                            	<td><input class="form-control input-sm" name="po_number" id="po_number" type="text" value="" placeholder="PO Number" style="width: 80px;" required></td>
                                                <td>
                                                <input type="text" class="form-control input-sm" name="po_supplier" id="po_supplier" placeholder="Supplier" style="width: 150px;">
                                                </td>
                                                
                                                <td>
                                                <select name="order_status" class="form-control form-filter input-sm">
                                                    <option value="">Select...</option>
                                                    <?php foreach($purchaseorderstatuses as $purchaseorderstatus) { ?>
                                                        <option value="<?= $purchaseorderstatus->id_po_status;?>"><?= $purchaseorderstatus->po_status;?></option>
                                                    <?php } ?>
                                                </select>
                                                </td>
                                                
                                                <td>
                                                <select  name="order_condition"  class="table-group-action-input form-control form-filter input-inline input-small input-sm">
                                                    <?php foreach($purchaseorderconditions as $purchaseordercondition) { ?>
                                                     <option value="<?= $purchaseordercondition->id_po_condition;?>"><?= $purchaseordercondition->po_condition;?></option>
                                                    <?php } ?>

                                                </select>
                                                </td>
                                                
                                                
                                                <td>
                                                    <button class="btn btn-sm btn-primary" name="btnSearch" id="btnSearch" onclick="search_record();" type="button"><i class="fa fa-search"></i> Search </button>
                                                </td>
                                                <td>
                                                    <a href="#add-po" data-toggle="modal" class="btn btn-sm btn-success" class="config" data-original-title="" title=""><i class="fa fa-plus"></i> PO</a>
                                                </td>
                                            </tr>
                                            </table>
                                            </form>
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
                               <th width="2%">
                                    Order&nbspID
                                </th>
                                <th width="3%">
                                    PO&nbspNumber
                                </th>
                                <th width="15%">
                                    PO&nbsp;Dated
                                </th>
                                <th width="15%">
                                    PO&nbsp;For&nbsp;(supplier)
                                </th>
                                <th width="10%">
                                    Status
                                </th>
                                <th width="10%">
                                    Actions
                                </th>
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

<!-- BEGIN ADD PO MODAL FORM-->
<div class="modal fade" id="add-po" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add New Purchase Order</h4>
            </div>
            
            <div class="modal-body">
                <form class="form-horizontal form-bordered form-row-stripped">
                    <div class="form-body">
                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Supplier:</label>
                            <div class="col-md-9">
                                <select  name="supplier_id" id="supplier_id"  class="form-control">
                                    <?php foreach($suppliers as $supplier) { ?>
                                    <option value="<?= $supplier->id_suppliers;?>"><?= $supplier->supplier_name;?></option>
                                    <?php } ?>
                                </select>
                               
                            </div>
                        </div>
                        
                        <input type="hidden" name="supplier_name" id="supplier_name"/>

                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Reason:</label>
                            <div class="col-md-9">
                                <select  name="reasons" id="reason_id"  class="form-control">
                                    <?php foreach($reasons as $reasons) { ?>
                                    <option value="<?= $reasons->id_reasons;?>"><?= $reasons->reasons;?></option>
                                    <?php } ?>
                                </select>
                               
                            </div>
                        </div>
                        
                    </div>
                </form>
                 
            </div>
            <div class="modal-footer">
                <button onclick="addPO();" type="button" class="btn btn-sm btn-success">Save changes</button>
                <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Close</button>
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
       tabltint();
      
       $("#abc").select2({
            placeholder: "Type to search a supplier",
            allowClear: true,
            minimumInputLength: 3,
            ajax: {
                url: "<?php echo $this->Url->build(['controller' => 'suppliers', 'action' => 'getsuppliers']); ?>",
                dataType: 'json',
                delay: 250,
                data: function (term) {
                    return {
                        q: term // search term
                    };
                },
                results: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.supplier_name,
                                id: item.id_suppliers
                            }
                        })
                    };
                },
                cache: true
            }
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
                    url: "<?php echo $this->Url->build(['controller' => 'Purchaseorders', 'action' => 'getpobysearch']); ?>",
                    dataType: 'json',
                    cache: false,
                    async: false,
                    "data": function ( d ) {
                        d.status = $('#status option:selected').val();
                        d.cc = $('#reg_id').val();
                        d.fmc = $('#fmc').val();
                        d.name = $('#search_st').val();
                        d.inv_no = $('#inv_no').val();
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                        
                    }
                },
                "oLanguage": {
                 "sProcessing": ''
               },
                "columnDefs": [{ // define columns sorting options(by default all columns are sortable extept the first checkbox column)
                    'orderable': false,
                    'targets': [0]
                    
                }],
                    
                "order": [
                    [1, "asc"]
                ], // set first column as a default sort by asc
                "columns": [
                        {"data": "id_purchase_orders"},
                        {"data": "purchase_order_number"},
                        {"data": "po_date"},
                        {"data": "supplier_name"},
                        {"data": "purchase_order_status"},
                        {"data": "actions"}
                    ]
                    
        });
        
   }  
    
   function editPO(poid) {
       toastr["info"]("Collecting Purchase order details", "Opening Purchase order # " + poid)
       window.location.assign("<?php echo $this->Url->build(['controller' => 'PoDetails', 'action' => 'openPO']); ?>/" + poid);
    }
    

    function addPO() {
        
       // var ponumber = $("#purchase_order_number").val();
        var supplierid = $("#supplier_id option:selected").val();
        var suppliername = $("#supplier_id option:selected").text();
        var reasons = $("#reason_id option:selected").text();
        
       // if($("#purchase_order_number").val().length >= 4){
            $.ajax({
                type: "post",
                url: "<?php echo $this->Url->build(['controller'=> 'purchaseorders', 'action' => 'addpo']); ?>",
                dataType:'json',
                data: {po_reason:reasons , supplier_id: supplierid, supplier_name: suppliername, purchase_order_condition_id: 1, purchase_order_condition:"Pending"},
                success: function(data) {
                    var result = data.msg.split("|");
                    var id = data.id;
                    if (result[0] === "Success") {
                        toastr.success(result[0], result[1]);
                       // location.reload();
                       editPO(id);
                    } else {
                        toastr.error(result[0], result[1]);
                    }
                }
            });
//        } else {
//            toastr.warning("Please enter a PO number of at least 4 digits!", "info");
//        }
    }
</script>
