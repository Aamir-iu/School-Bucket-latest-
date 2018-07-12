<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $poGrn->id_po_grn],
                ['confirm' => __('Are you sure you want to delete # {0}?', $poGrn->id_po_grn)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Po Grn'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Po Grn Detail'), ['controller' => 'PoGrnDetail', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Po Grn Detail'), ['controller' => 'PoGrnDetail', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="poGrn form large-9 medium-8 columns content">
    <?= $this->Form->create($poGrn) ?>
    <fieldset>
        <legend><?= __('Edit Po Grn') ?></legend>
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
