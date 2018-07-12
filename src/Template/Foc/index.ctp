<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 



<div class="portlet light">
    <div class="portlet-title light-blue">
        <?php
        if (!empty($foc_product)) {
            $product = $foc_product[0];
        }
        ?>
        <?php
        if (!empty($suppliers)) {
            $supplier = $suppliers[0];
        }
        ?>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">



                            <div class="col-md-6">
                                <div class="portlet light">
                                    <div class="portlet-body">
                                        <div class="row ">
                                            <div class="form-body form-bordered form-row-stripped">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group clearfix">
                                                            <div class="caption">
                                                                Supplier Name : <?php echo $supplier['supplier_name']; ?>  <br /><br />
                                                                Product Name : <?php echo $product['product_name']; ?>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="btn-group pull-right">

                                <div class="btn-group" style="margin-bottom: 28px;">
                                    <div class="tools">
                                        <div class="actions" style="margin-bottom: 28px;">
                                            <a  href="#"  title="Add New FOC" onclick="load_modal_foc_add();" class="btn btn-block btn-success">
                                                <i class="fa fa-plus"></i> Add New FOC</a>
                                        </div>

                                        <a href="#" class="fullscreen" data-original-title="" title="">
                                        </a>
                                    </div>
                                </div>


                            </div>



                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-striped table-bordered table-hover" id="datatable_foc">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width="5%">
                                            FOC&nbsp;ID
                                        </th>

                                        <th width="15%">
                                            FOC&nbsp;For&nbsp;Qty
                                        </th>
                                        <th width="15%">
                                            FOC Product
                                        </th>
                                        <th width="15%">
                                            FOC&nbsp;Product&nbsp;Qty
                                        </th>
                                        <th width="15%">
                                            FOC Active
                                        </th>

                                        <th width="20%">Actions</th>

                                    </tr>
                                </thead>

                                    <?php foreach ($foc as $foc): ?>
                                    <tr>
                                        <td><?= $this->Number->format($foc->id_foc) ?></td>

                                        <td><?= $this->Number->format($foc->foc_for_qty) ?></td>
                                        <td><?= h($foc->product['product_name']) ?></td>
                                        <td><?= $this->Number->format($foc->foc_product_qty) ?></td>
                                        <td><?= h($foc->active) ?></td>

                                        <td class="actions">
 
                                            <a  href="#" onclick="edit_foc(<?= $this->Number->format($foc->id_foc) ?>);"  class="btn btn-icon waves-effect waves-light btn-warning m-b-5"><i class="fa fa-pencil"></i> Edit </a>
                                            <a  href="#" onclick="delete_foc(<?= $this->Number->format($foc->id_foc) ?>);"  class="btn btn-icon waves-effect waves-light btn-danger m-b-5"><i class="fa fa-trash"></i> Delete </a>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
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
        <!-- BEGIN FOC ADD MODAL FORM-->
        <div class="modal bs-modal-lg fade" id="add-foc" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Add New FOC</h4>
                    </div>
                    <form class="form-horizontal" id="add_foc_form">

                        <div class="modal-body" id="idfoc">


                            <input type="text" class="hidden" name='supplier_id' id="supplier_id"   value='<?php echo $supplier_id; ?>' />
                            <input type="text" class="hidden" name='supplier_product_id' id="supplier_product_id" value='<?php echo $supplier_product_id; ?>' />
                            <input type="text" class="hidden" name='foc_for' id="foc_for" value='<?php echo $product_id; ?>' />

                            <div class="form-group">
                                <label class="control-label col-md-3">FOC for Qty:</label>
                                <div class="col-md-9">
                                    <input type="text" placeholder="FOC for Qty" class="form-control numeric" name='foc_for_qty' id="foc_for_qty" value='' />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Product Name:</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="foc_product" name="foc_product">
                                    <?php foreach ($products as $product): ?>
                                            <option value="<?php echo ($product['id_products']); ?>"><?php echo ($product['product_name']); ?></option>
                                    <?php endforeach; ?>

                                    </select>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">FOC product qty:</label>
                                <div class="col-md-9">
                                    <input type="text" placeholder="FOC product qty" class="form-control numeric" name='foc_product_qty' id="foc_product_qty" value='' />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Active:</label>
                                <div class="col-md-9">                            
                                    <select class="form-control" name='active' id="active" > 

                                        <option value="y">Yes</option>
                                        <option value="n">No</option>

                                    </select> 
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button  type="submit" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Save</button>
                            <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
                        </div>
                    </form>       

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <!-- BEGIN FOC EDIT MODAL FORM-->
        <div class="modal bs-modal-lg fade" id="edit-foc" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Edit FOC</h4>
                    </div>
                    <form class="form-horizontal" id="edit_foc_form">

                        <div class="modal-body" id="idfoc">

                            <input type="text" class="hidden" name='id_foc' id="id_foc"   value='' />
                            <input type="text" class="hidden" name='supplier_id' id="supplier_id"   value='' />
                            <input type="text" class="hidden" name='supplier_product_id' id="supplier_product_id" value='' />
                            <input type="text" class="hidden" name='foc_for' id="foc_for" value='' />

                            <div class="form-group">
                                <label class="control-label col-md-3">FOC for Qty:</label>
                                <div class="col-md-9">
                                    <input type="text" placeholder="FOC for Qty" class="form-control numeric" name='foc_for_qty' id="foc_for_qty" value='' />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Product Name:</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="foc_product" name="foc_product">
                                    <?php foreach ($products as $product): ?>
                                            <option value="<?php echo $product['id_products']; ?>"><?php echo $product['product_name']; ?></option>
                                    <?php endforeach; ?>

                                    </select>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">FOC product qty:</label>
                                <div class="col-md-9">
                                    <input type="text" placeholder="FOC product qty" class="form-control numeric" name='foc_product_qty' id="foc_product_qty" value='' />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Active:</label>
                                <div class="col-md-9">                            
                                    <select class="form-control" name='active' id="active" > 

                                        <option value="y">Yes</option>
                                        <option value="n">No</option>

                                    </select> 
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button  type="submit" class="btn btn-icon waves-effect waves-light btn-info m-b-5">Save</button>
                            <button type="button" class="btn btn-icon waves-effect waves-light btn-warning m-b-5" data-dismiss="modal">Close</button>
                        </div>
                    </form>       

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

            $(function () {
                $("#datatable_foc").DataTable();

            });

            // loading modal for new FOC   work by AQS
            function load_modal_foc_add() {

                $('#add-foc').modal({
                    backdrop: 'static',
                    keyboard: false,
                    show: true
                });

            }
            // save FOC in db though ajax  work by AQS
            $('#add_foc_form').on('submit', function () {

                var supplier_id = $('#add_foc_form #supplier_id').val();
                var product_id = $('#add_foc_form #foc_for').val();
                var supplier_product_id = $('#add_foc_form #supplier_product_id').val();
                var foc_for_qty = $('#add_foc_form #foc_for_qty').val();
                var foc_product = $('#add_foc_form #foc_product option:selected').val();
                var foc_product_qty = $('#add_foc_form #foc_product_qty').val();
                var active = $('#add_foc_form #active option:selected').val();

                if (foc_for_qty === '' || foc_for_qty === '0') {
                    toastr["error"]("Please enter FOC for quantity");
                    return false;
                }

                if (foc_product_qty === '' || foc_product_qty === '0') {
                    toastr["error"]("Please enter FOC product quantity");
                    return false;
                }


                imageOverlay('#idfoc', 'show');
                toastr["info"]("Proccessing", "Adding New FOC");
                $.ajax({
                    type: "POST",
                    url: "<?php echo $this->Url->build(['controller' => 'Foc', 'action' => 'add']); ?>",
                    dataType: 'json',
                    data: {supplier_id: supplier_id,
                        foc_for: product_id,
                        supplier_product_id: supplier_product_id,
                        foc_for_qty: foc_for_qty,
                        foc_product: foc_product,
                        foc_product_qty: foc_product_qty,
                        active: active},
                    success: function (data) {
                        var result = data.msg.split("|");
                        if (result[0] === "Success") {
                            toastr.success(result[0], result[1]);
                            $('#add-foc').modal('hide');
                            location.reload();
                        } else {
                            toastr.warning(result[0], result[1]);
                        }
                    }
                });
                imageOverlay('#idfoc', 'hide');
            });
            ///  Delete FOC from DB AQS
            function delete_foc(id) {

                if (id > 0) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo $this->Url->build(['controller' => 'Foc', 'action' => 'delete']); ?>",
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
            ///  Editing FOC from DB AQS
            function edit_foc(id) {

                $('#edit-foc').modal({
                    backdrop: 'static',
                    keyboard: false,
                    show: true
                });

                $.ajax({
                    type: "POST",
                    url: "<?php echo $this->Url->build(['controller' => 'Foc', 'action' => 'getfocdetails']); ?>",
                    dataType: 'json',
                    data: {id: id},
                    success: function (data) {
                        var result = data.foc

                        $('#edit_foc_form #id_foc').val(result.id_foc);
                        $('#edit_foc_form #supplier_id').val(result.supplier_id);
                        $('#edit_foc_form #foc_for').val(result.foc_for);
                        $('#edit_foc_form #supplier_product_id').val(result.supplier_product_id);

                        $('#edit_foc_form #foc_for_qty').val(result.foc_for_qty);
                        $('#edit_foc_form #foc_product').val(result.foc_product).change();
                        $('#edit_foc_form #foc_product_qty').val(result.foc_product_qty);
                        $('#edit_foc_form #active').val(result.active).change();


                    }
                });


            }
            ///  save FOC from DB AQS
            $('#edit_foc_form').on('submit', function () {
                var id_foc = $('#edit_foc_form #id_foc').val();
                var supplier_id = $('#edit_foc_form #supplier_id').val();
                var product_id = $('#edit_foc_form #foc_for').val();
                var supplier_product_id = $('#edit_foc_form #supplier_product_id').val();
                var foc_for_qty = $('#edit_foc_form #foc_for_qty').val();
                var foc_product = $('#edit_foc_form #foc_product option:selected').val();
                var foc_product_qty = $('#edit_foc_form #foc_product_qty').val();
                var active = $('#edit_foc_form #active option:selected').val();

                if (foc_for_qty === '' || foc_for_qty === '0') {
                    toastr["error"]("Please enter FOC for quantity");
                    return false;
                }

                if (foc_product_qty === '' || foc_product_qty === '0') {
                    toastr["error"]("Please enter FOC product quantity");
                    return false;
                }


                imageOverlay('#edit_foc_form #idfoc', 'show');
                toastr["info"]("Proccessing", "Adding New FOC");
                $.ajax({
                    type: "POST",
                    url: "<?php echo $this->Url->build(['controller' => 'Foc', 'action' => 'edit']); ?>",
                    dataType: 'json',
                    data: {supplier_id: supplier_id,
                        foc_for: product_id,
                        supplier_product_id: supplier_product_id,
                        foc_for_qty: foc_for_qty,
                        foc_product: foc_product,
                        foc_product_qty: foc_product_qty,
                        active: active,
                        id_foc: id_foc},
                    success: function (data) {
                        var result = data.msg.split("|");
                        if (result[0] === "Success") {
                            toastr.success(result[0], result[1]);
                            $('#edit_foc_form #add-foc').modal('hide');
                            location.reload();
                        } else {
                            toastr.warning(result[0], result[1]);
                        }
                    }
                });
                imageOverlay('#edit_foc_form #idfoc', 'hide');
            });



        </script>