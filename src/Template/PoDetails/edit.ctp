<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $poDetail->id_po_details],
                ['confirm' => __('Are you sure you want to delete # {0}?', $poDetail->id_po_details)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Po Details'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="poDetails form large-9 medium-8 columns content">
    <?= $this->Form->create($poDetail) ?>
    <fieldset>
        <legend><?= __('Edit Po Detail') ?></legend>
        <?php
            echo $this->Form->input('po_id');
            echo $this->Form->input('po_number');
            echo $this->Form->input('product_id', ['options' => $products, 'empty' => true]);
            echo $this->Form->input('product_name');
            echo $this->Form->input('qty');
            echo $this->Form->input('price');
            echo $this->Form->input('total');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
