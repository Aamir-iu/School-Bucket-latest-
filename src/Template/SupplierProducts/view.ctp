<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Supplier Product'), ['action' => 'edit', $supplierProduct->id_supplier_products]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Supplier Product'), ['action' => 'delete', $supplierProduct->id_supplier_products], ['confirm' => __('Are you sure you want to delete # {0}?', $supplierProduct->id_supplier_products)]) ?> </li>
        <li><?= $this->Html->link(__('List Supplier Products'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Supplier Product'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="supplierProducts view large-9 medium-8 columns content">
    <h3><?= h($supplierProduct->id_supplier_products) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= h($supplierProduct->active) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Supplier Products') ?></th>
            <td><?= $this->Number->format($supplierProduct->id_supplier_products) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Suppliers') ?></th>
            <td><?= $this->Number->format($supplierProduct->id_suppliers) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Products') ?></th>
            <td><?= $this->Number->format($supplierProduct->id_products) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Packaging Type') ?></th>
            <td><?= $this->Number->format($supplierProduct->packaging_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Units Per Pack') ?></th>
            <td><?= $this->Number->format($supplierProduct->units_per_pack) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pack Price') ?></th>
            <td><?= $this->Number->format($supplierProduct->pack_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Unit Price') ?></th>
            <td><?= $this->Number->format($supplierProduct->unit_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Foc Id') ?></th>
            <td><?= $this->Number->format($supplierProduct->foc_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($supplierProduct->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($supplierProduct->created_on) ?></td>
        </tr>
    </table>
</div>
