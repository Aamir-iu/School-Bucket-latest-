<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Foc'), ['action' => 'edit', $foc->foc_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Foc'), ['action' => 'delete', $foc->foc_id], ['confirm' => __('Are you sure you want to delete # {0}?', $foc->foc_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Foc'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Foc'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Suppliers'), ['controller' => 'Suppliers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Supplier'), ['controller' => 'Suppliers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="foc view large-9 medium-8 columns content">
    <h3><?= h($foc->foc_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Supplier') ?></th>
            <td><?= $foc->has('supplier') ? $this->Html->link($foc->supplier->id_suppliers, ['controller' => 'Suppliers', 'action' => 'view', $foc->supplier->id_suppliers]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product') ?></th>
            <td><?= $foc->has('product') ? $this->Html->link($foc->product->id_products, ['controller' => 'Products', 'action' => 'view', $foc->product->id_products]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= h($foc->active) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Foc') ?></th>
            <td><?= $this->Number->format($foc->id_foc) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Foc For Qty') ?></th>
            <td><?= $this->Number->format($foc->foc_for_qty) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Foc Product') ?></th>
            <td><?= $this->Number->format($foc->foc_product) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Foc Product Qty') ?></th>
            <td><?= $this->Number->format($foc->foc_product_qty) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($foc->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($foc->created_on) ?></td>
        </tr>
    </table>
</div>
