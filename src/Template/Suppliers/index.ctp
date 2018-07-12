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
                                            <li><?= $this->Html->link(__('Add New Supplier'), ['action' => 'add']) ?></li>

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
                        <th width="3%">
                            Supplier&nbsp;ID
                        </th>
                        <th width="15%">
                            Supplier&nbsp;Name
                        </th>
                        <th width="15%">
                            Address
                        </th>
                        <th width="8%">
                            Contact&nbsp;Person
                        </th>
                        <th width="8%">
                            Phone
                        </th>
                        <th width="8%">
                            Phone 2
                        </th>
                        <th width="10%">
                            Email
                        </th>
                        <th width="45%">Actions</th>

                    </tr>
                </thead>

                <?php foreach ($suppliers as $supplier): ?>
                    <tr>
                        <td><?= $this->Number->format($supplier->id_suppliers) ?></td>
                        <td><?= h($supplier->supplier_name) ?></td>
                        <td><?= h($supplier->supplier_address) ?></td>
                        <td><?= h($supplier->contact_person) ?></td>
                        <td><?= h($supplier->phone1) ?></td>
                        <td><?= h($supplier->phone2) ?></td>
                        <td><?= h($supplier->email) ?></td>

                        <td class="actions">
                            <?= $this->Html->link(__('Prodcuts'), ['controller'=>'SupplierProducts','action' => 'index',$supplier->id_suppliers], ['class' => 'btn btn-small btn-info', 'escape' => false]) ?>
                            <?= $this->Html->link(__('<i class="fa fa-pencil"></i>'), ['action' => 'edit', $supplier->id_suppliers], ['class' => 'btn btn-icon waves-effect waves-light btn-warning m-b-5', 'escape' => false]) ?>
                            <?php // $this->Form->postLink(__('<i class="fa fa-trash"></i>'), ['action' => 'delete', $supplier->id_suppliers], ['confirm' => __('Are you sure you want to delete # {0}?', $supplier->id_suppliers), 'class' => 'btn btn-icon waves-effect waves-light btn-danger m-b-5', 'escape' => false]) ?>
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