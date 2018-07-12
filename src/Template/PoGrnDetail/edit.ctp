<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $poGrnDetail->id_po_grn_detail],
                ['confirm' => __('Are you sure you want to delete # {0}?', $poGrnDetail->id_po_grn_detail)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Po Grn Detail'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="poGrnDetail form large-9 medium-8 columns content">
    <?= $this->Form->create($poGrnDetail) ?>
    <fieldset>
        <legend><?= __('Edit Po Grn Detail') ?></legend>
        <?php
            echo $this->Form->input('po_grn_id');
            echo $this->Form->input('grn_product_id');
            echo $this->Form->input('grn_product_name');
            echo $this->Form->input('received_pack_qty');
            echo $this->Form->input('received_units_per_pack');
            echo $this->Form->input('received_pack_price');
            echo $this->Form->input('received_unit_price');
            echo $this->Form->input('created_on');
            echo $this->Form->input('created_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
