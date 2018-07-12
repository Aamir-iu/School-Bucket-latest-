<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Supplier'), ['action' => 'edit', $supplier->id_suppliers]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Supplier'), ['action' => 'delete', $supplier->id_suppliers], ['confirm' => __('Are you sure you want to delete # {0}?', $supplier->id_suppliers)]) ?> </li>
        <li><?= $this->Html->link(__('List Suppliers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Supplier'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="suppliers view large-9 medium-8 columns content">
    <h3><?= h($supplier->id_suppliers) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Supplier Name') ?></th>
            <td><?= h($supplier->supplier_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Supplier Address') ?></th>
            <td><?= h($supplier->supplier_address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Contact Person') ?></th>
            <td><?= h($supplier->contact_person) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone1') ?></th>
            <td><?= h($supplier->phone1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone2') ?></th>
            <td><?= h($supplier->phone2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($supplier->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Website') ?></th>
            <td><?= h($supplier->website) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Suppliers') ?></th>
            <td><?= $this->Number->format($supplier->id_suppliers) ?></td>
        </tr>
    </table>
</div>
