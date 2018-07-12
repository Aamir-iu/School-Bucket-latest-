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
                                            	<td>Status</td>
                                                <td>Invoice No</td>
                                                <td>Customer Name</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                              
                                                <td>
                                                    <select name="status" id="status" class="form-control input-sm" style="width: 130px;">
                                                        <option value="Active">Active</option>  
                                                        <option value="Cancelled">Cancelled</option>
                                                    </select>
                                                </td>   
                                               
                                            	<td><input class="form-control input-sm" name="inv_no" id="inv_no" type="text" value="" placeholder="Inv Number" style="width: 100px;" required></td>
                                               
                                            	
                                                <td>
                                                <input type="text" class="form-control input-sm" name="search" id="search" placeholder="Customer Name" style="width: 130px;">
                                                </td>
                                                
                                               
                                                
                                                <td>
                                                    <button class="btn btn-sm btn-primary" name="btnSearch" id="btnSearch" onclick="search_record();" type="button"><i class="fa fa-search"></i> Search </button>
                                                </td>
                                                
                                                <td>
                                                    <button class="btn btn-sm btn-success" name="btnSearch" id="btnSearch" onclick="loadmodal();" type="button"><i class="fa fa-plus"></i> Add </button>
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
                               
                                <th width="10%">Invoice No</th>
                                <th width="20%">Customer Name</th>
                                <th width="20%">Created on</th>
                                <th width="10%">Status</th>
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
<div class="modal fade" id="add-product"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:80%!important;">
        <div class="modal-content">
            
           
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <form>
                         <div class="row col-xs-12" id="loadind">

                            <div  class="col-md-4">     
                                <div class="form-group">
                                    <label>Customer Type</label>
                                    <select class="form-control" id="user_type"  name="user_type" data-placeholder="Select User" style="width: 100%;">
                                        <option value="Student">Student</option>
                                        <option value="Staff">Staff</option>
                                        <option value="Other">Other</option>
                                    </select>
                                 </div>
                            </div>
                             
                             
                           <div  class="col-md-8">      
                            <div class="form-group">
                                <label>Customer Name</label>
                                <input type="text" class="form-control text-uppercase" name="user_name" id="user_name">
                             </div>
                            </div>
                             
                         
                        </div>     
                                
                        <div class="row col-xs-12">
      
                            <div  class="col-md-4">     
                                 <div class="form-group">
                                     <label>Products</label>
                                     <select id="supplierproduct"  onchange="get_prudcts_rate();" class="form-control" style="width:100%;">
                                            <option>Select</option>>
                                        <?php foreach ($supplierproducts as $product){ ?>
                                            <?php  if($product->product['id_products']): ?>
                                            <option  sup_id="<?php echo $product->id_suppliers; ?>" type_id="<?php echo $product->product['product_type']; ?>" value ="<?php echo $product->product['id_products'] ?>"><?php echo $product->product['product_name']; ?></option>
                                            <?php  endif; ?>
                                            <?php } ?>
                                        </select>
                                </div>
                            </div>
                            
                            <div  class="col-md-2">     
                                <div class="form-group">
                                    <label>Rate <span class="required" aria-required="true">*</span></label>
                                        <input id="rate" type="number" readonly  placeholder="Product Rate" class="form-control" value=""/>
                                    </div>
                            </div>
                            
                            <div  class="col-md-2">     
                                <div class="form-group">
                                    <label>Unit Quantity <span class="required" aria-required="true">*</span></label>
                                    <input id="pack_qty" onkeyup="calculation();" type="number" min="1" placeholder="Quantity" class="form-control numeric" value="0"/>
                                    </div>
                            </div>
                            
                            <div  class="col-md-2">     
                                <div class="form-group">
                                    <label>Sub Total </label>
                                    <input id="sub_total" readonly type="number"  placeholder="Sub Total" class="form-control numeric" value="0"/>
                                    </div>
                            </div>
                            <div  class="col-md-2">     
                                <div class="form-group">
                                    <label>Discount </label>
                                        <input id="discount_amount" onkeyup="calculation();" type="number"  placeholder="Discount" class="form-control numeric" value="0"/>
                                    </div>
                            </div>
                            
                            
                            
                            
                    
                            
                        </div>
                            
                        <div class="row col-xs-12">
                            
                            <div  class="col-md-2">     
                                <div class="form-group">
                                    <label>Total Amount </label>
                                    <input id="total_amount" readonly type="number"  placeholder="Total Amount" class="form-control numeric" value="0"/>
                                    </div>
                            </div>
                            
                            <div  class="col-md-2">     
                                <div class="form-group">
                                    <label>Remaining Stock </label>
                                    <input id="stock" readonly type="number"  placeholder="stock" class="form-control numeric" value="0"/>
                                    </div>
                            </div>
                            
                            <div  class="col-md-6">     
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea class="form-control" cols="2"  rows="2"id="message"></textarea>
                                    </div>
                            </div>
                            
                            <div class="form-group">  
                                <div class="pull-right" style="margin-right:0px!important;"> 
                                <button onclick="addtolist();" readonly type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Add</button>
                                <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
                               </div>  
                             
                             
                            </div>  
                            
                            
                        </div>    
                            
                    </form>
                </div>
            </div>
           </div>
            
            
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">

                            <!-- /.box-header -->
                            <div class="box-body table-responsive no-padding">
                                <table id="productTble"  class="table table-hover">
                                    <thead>
                                        <tr>
                                            
                                            <th width="10%">Product ID</th>
                                            <th width="20%">Product Name</th>
                                            <th width="10%">Unit Price</th>
                                            <th width="10%">Unit Qty</th>
                                            <th width="10%">Sub Total</th>
                                            <th width="10%">Disc Amount</th>
                                            <th width="15%">Total Amount</th>
                                            <th width="10%">Action</th>
                                           
                                           

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
                    
                    <div class="modal-footer">
                        <button  id="btn_print" style="display:none;" type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5"><i class="fa fa-print"> </i> Print</button>
                        <button onclick="update_details();" id="btn_save" type="button" class="btn btn-icon waves-effect waves-light btn-success m-b-5"><i class="fa fa-save"> </i> Save</button>
                    </div>
                    
                    
                    
                </div>
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
      $("#supplierproduct").select2();
      
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
                    url: "<?php echo $this->Url->build(['controller' => 'Sale', 'action' => 'getbysearch']); ?>",
                    dataType: 'json',
                    cache: false,
                    async: false,
                    "data": function ( d ) {
                        d.inv_no = $('#inv_no').val();
                        d.name = $('#search').val();
                        d.status = $('#status option:selected').val();
                        
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
                        {"data": "id_sale"},
                        {"data": "customer_name"},
                        {"data": "date"},
                        {"data": "status"},
                        {"data": "actions"},
                    ]
        });
        
   }  

    function addtolist(){
    
        $('#btn_save').fadeIn();
        $('#btn_print').hide();
        var exists = 0;
        if ($("#supplierproduct option:selected").val() > 0) {
            $('#productTble').find("td.id").each(function(index) {
                if ($(this).html() === $("#supplierproduct option:selected").val()) {
                    exists = 1;
                }
            });
            
            var product_id = $("#supplierproduct option:selected").val();
            var product_name = $("#supplierproduct option:selected").text();
            var product_type_id = $("#supplierproduct option:selected").attr('type_id');
           
            var stock = $('#stock').val();
            var qty = $('#pack_qty').val();
            var rate = $('#rate').val();
            var sub_total = $('#sub_total').val();
            var discount_amount = $('#discount_amount').val();
            var total_amount = $('#total_amount').val();
            
            
            if ( parseInt(qty) > parseInt(stock) ){
                toastr["error"]("Sale quantity must be less then or equal to remaining quantities, try again!","Warning") ;
                exists = 1;
                return false;
            }
            
            if(parseInt(qty) < 1){
                toastr["error"]("Sale quantity must be greater then 0, try again!","Warning") ;
                exists = 1;
                return false;
            }
            
            
            
            var mhtml = "";
            if (exists == 0) {
                    mhtml+="<tr><td class='id'>" + product_id + "</td><td>" + product_name + "</td><td>" + rate + "</td><td>" + qty + "</td><td>" + sub_total + "</td><td>" + discount_amount + "</td><td>" + total_amount + "</td><td style='display:none;'>" + product_type_id + "</td><td><button onclick='removefromlist(" + product_id + ");' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button> </td></tr>"
                     $("#productTble tbody").append(mhtml);
                } else {
                     toastr["error"]("Sorry the subject is already added. To change it, first remove, then add again!","ALREADY ADDED") ;
                }
            
           
        }
    }
    
    function removefromlist(val){
        $('#productTble').find("td.id").each(function(index) {
            if ($(this).html() == val) {
                $(this).closest('tr').remove();
                toastr.success("Subject has been removed!","Success") ;
            }
        });
    }
    
    function loadmodal(){
        $('#add-product').modal({
              backdrop:'static',
              keyboard:false,
              show:true
        });
    }
   
    function get_prudcts_rate(){
     
        var product_id = $('#supplierproduct option:selected').val();
        var seelcted_product = $('#supplierproduct option:selected').text();
        if(seelcted_product == 'Select'){
            return false;
        }
        var s_id = $('#supplierproduct option:selected').attr('sup_id');
         $('#rate').val('');
        
         $.ajax({
             type: "POST",
             url: "<?php echo $this->Url->build(['controller' => 'Sale', 'action' => 'getproductrate']); ?>",
             dataType: 'json',
             cache: false,
             async: false,
             data: {product_id:product_id,s_id:s_id},
             success: function (data) {
                var mdata = data.product_rates;
                $('#rate').val(mdata[0]['sale_price']);
                $('#stock').val(mdata[0]['stock']);
             }   

         });
         calculation();
    }
    
    function calculation(){
       
        var rate = $('#rate').val();
        var qty = $('#pack_qty').val();
        var discount = $('#discount_amount').val();
        
        var subTotal =  parseFloat(rate * qty);
        $('#sub_total').val(subTotal);
        
        var gtotal = $('#sub_total').val();
        
        var total = parseFloat(gtotal - discount);
        $('#total_amount').val(total);
    
    }
    
    function update_details(){
       
        var user_name = $('#user_name').val();
        if(user_name == '' || user_name == null){
            toastr["error"]("Please enter the customer name","Warning") ;
            return false;
        }
       
       
        var user_name = $('#user_name').val();
        var user_type = $('#user_type option:selected').val();
        var message = $('#message').val();
        var TableData;
        TableData = storeOTblValues()
        if (TableData.length > 0) {
            imageOverlay('#productTble', 'show');
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Url->build(['controller'=> 'Sale', 'action' => 'add']); ?>",
                dataType:'json',
                data: {details: TableData, customer_name: user_name,customer_type:user_type,message:message},
                success: function(data) {
                    var result = data.msg.split("|");
                    var inv = data.inv_no;
                    if (result[0] === "Success") {
                        toastr.success(result[0], result[1]);
                        var func = 'print_invoice('+0+','+inv+')';
                        $('#btn_print').attr('onClick',func);
                        $('#btn_print').fadeIn();
                        $('#btn_save').hide();
                        $('#productTble tbody').html('');
                        
                       } else {
                        toastr.warning(result[0], result[1]);                        
                    }
                }
            });
        } else {
            toastr["warning"]("Nothing Added", "Exam Header");
        }
        imageOverlay('#productTble', 'hide');
    }
    
    function storeOTblValues(){
        var TableData = new Array();

        $('#productTble tr').each(function(row, tr) {
            TableData[row] = {
                "product_id": $(tr).find('td:eq(0)').text()
                , "product_name": $(tr).find('td:eq(1)').text()
                , "unit_price": $(tr).find('td:eq(2)').text()
                , "unit_qty": $(tr).find('td:eq(3)').text()
                , "sub_total": $(tr).find('td:eq(4)').text()
                , "discount": $(tr).find('td:eq(5)').text()
                , "grand_total": $(tr).find('td:eq(6)').text()
                , "type_id": $(tr).find('td:eq(7)').text()
            }
        });
        TableData.shift();  // first row will be empty - so remove
        return TableData;
    }
    
    function print_invoice(flag, inv) {
        window.open("<?php echo $this->Url->build(['controller' => 'Sale', 'action' => 'view']); ?>/" + flag + "/" + inv);
    }
    
    
    function delete_invoice(id) {

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
                        url: "<?php echo $this->Url->build(['controller' => 'Sale', 'action' => 'delete']); ?>",
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
    
    
    
</script>