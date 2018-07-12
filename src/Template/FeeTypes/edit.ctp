<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $feeType->id_fee_type],
                ['confirm' => __('Are you sure you want to delete # {0}?', $feeType->id_fee_type)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Fee Types'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Concession'), ['controller' => 'Concession', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Concession'), ['controller' => 'Concession', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Dues'), ['controller' => 'Dues', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Due'), ['controller' => 'Dues', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fee Heads'), ['controller' => 'FeeHeads', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fee Head'), ['controller' => 'FeeHeads', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fees'), ['controller' => 'Fees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fee'), ['controller' => 'Fees', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="feeTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($feeType) ?>
    <fieldset>
        <legend><?= __('Edit Fee Type') ?></legend>
        <?php
            echo $this->Form->input('fee_type_name');
            echo $this->Form->input('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
