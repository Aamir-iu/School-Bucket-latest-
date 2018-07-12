<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Producttype'), ['action' => 'edit', $producttype->type_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Producttype'), ['action' => 'delete', $producttype->type_id], ['confirm' => __('Are you sure you want to delete # {0}?', $producttype->type_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Producttypes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Producttype'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="producttypes view large-9 medium-8 columns content">
    <h3><?= h($producttype->type_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Type Name') ?></th>
            <td><?= h($producttype->type_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type Desc') ?></th>
            <td><?= h($producttype->type_desc) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type Id') ?></th>
            <td><?= $this->Number->format($producttype->type_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($producttype->created) ?></td>
        </tr>
    </table>
</div>
