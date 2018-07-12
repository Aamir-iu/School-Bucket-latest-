<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Po Grn'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Po Grn Detail'), ['controller' => 'PoGrnDetail', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Po Grn Detail'), ['controller' => 'PoGrnDetail', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="poGrn form large-9 medium-8 columns content">
    <?= $this->Form->create($poGrn) ?>
    <fieldset>
        <legend><?= __('Add Po Grn') ?></legend>
        <?php
            echo $this->Form->input('po_id');
            echo $this->Form->input('po_number');
            echo $this->Form->input('grn_date', ['empty' => true]);
            echo $this->Form->input('grn_created_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
