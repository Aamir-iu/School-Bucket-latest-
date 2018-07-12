<?= $this->Html->css('../plugins/datepicker/datepicker3.css') ?> 
<?= $this->Html->css('../plugins/datatables/dataTables.bootstrap.css') ?> 
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">

                    <h3 class="box-title">Suppliers List</h3>
                        <div class="btn-group pull-right">
                            
                            <div class="btn-group" style="margin-bottom: 28px;">
                                 <div class="tools">
                                    <div class="btn-group" style="margin-bottom: 28px;">
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            <li><?= $this->Html->link(__('Add New Suppliers Products'), ['action' => 'add','supplier_id'=>$supplier_id]) ?></li>

                                        </ul>
                                        <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
                                            <?= __('Actions') ?> <i class="fa fa-angle-down"></i>
                                        </button>
                                    </div>
                                    <a href="#" class="fullscreen" data-original-title="" title="">
                                    </a>
                                </div>
                            </div>
                            
                            
                        </div>
                   
                    

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-striped table-bordered table-hover" id="userstable">
                <thead>
                    <tr role="row" class="heading">
                        <th width="20%">
                            Supplier Name
                        </th>
                        <th width="10%">
                            Prodcut Name
                        </th>
                        <th width="10%">
                          Packaging
                        </th>
                        <th width="10%">
                            Units
                        </th>
                        <th width="10%">
                            Pack Price
                        </th>
                        <th width="10%">
                            Unit Price
                        </th>
                          <th width="10%">
                            FOC
                        </th>
                            
                        <th width="20%">Actions</th>

                    </tr>
                </thead>

                 <?php foreach ($supplierProducts as $supplierProduct): ?>
                    <tr>
                        <td><?= h($supplierProduct->supplier['supplier_name']) ?></td>
                        <td><?= h($supplierProduct->product['product_name']) ?></td>
                        <td><?= h($supplierProduct->packing_type['packaging_desc']) ?></td>
                        <td><?= $this->Number->precision($supplierProduct->units_per_pack,2) ?></td>
                        <td><?= $this->Number->format($supplierProduct->pack_price) ?></td>
                        <td><?= $this->Number->precision($supplierProduct->unit_price,2) ?></td>
                        <td><?= $this->Number->format($supplierProduct->foc) ?></td>
                        

                        <td class="actions">
                         <?= $this->Html->link(__('FOC'), ['controller'=>'Foc','action' => 'index',$supplier_id,$supplierProduct->id_supplier_products,$supplierProduct->product['id_products']], ['class' => 'btn btn-small btn-info', 'escape' => false]) ?>
                            <?= $this->Html->link(__('<i class="fa fa-pencil"></i>'), ['action' => 'edit', $supplierProduct->id_supplier_products,'supplier_id'=>$supplierProduct->supplier['id_suppliers']], ['class' => 'btn btn-icon waves-effect waves-light btn-warning m-b-5', 'escape' => false]) ?>
                            <?= $this->Form->postLink(__('<i class="fa fa-trash"></i>'), ['action' => 'delete', $supplierProduct->id_supplier_products], ['confirm' => __('Are you sure you want to delete # {0}?', $supplierProduct->id_supplier_products) , 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
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




<?= $this->Html->script('../plugins/jQuery/jquery-2.2.3.min.js') ?>
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min.js') ?>
<?= $this->Html->script('../plugins/datatables/dataTables.bootstrap.min.js') ?>
<?= $this->Html->script('../plugins/datepicker/bootstrap-datepicker.js') ?>    
<?= $this->Html->script('../plugins/select2/select2.full.min.js') ?> 
<?= $this->Html->script('datatable.js') ?>  
<script>

    $(function () {
        $("#userstable").DataTable();

    });

  
</script>