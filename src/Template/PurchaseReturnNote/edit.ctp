<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $purchaseReturnNote->id_prn_note],
                ['confirm' => __('Are you sure you want to delete # {0}?', $purchaseReturnNote->id_prn_note)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Purchase Return Note'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="purchaseReturnNote form large-9 medium-8 columns content">
    <?= $this->Form->create($purchaseReturnNote) ?>
    <fieldset>
        <legend><?= __('Edit Purchase Return Note') ?></legend>
        <?php
            echo $this->Form->input('po_id');
            echo $this->Form->input('po_number');
            echo $this->Form->input('date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
