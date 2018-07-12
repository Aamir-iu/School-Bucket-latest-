<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $sale->id_sale],
                ['confirm' => __('Are you sure you want to delete # {0}?', $sale->id_sale)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Sale'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="sale form large-9 medium-8 columns content">
    <?= $this->Form->create($sale) ?>
    <fieldset>
        <legend><?= __('Edit Sale') ?></legend>
        <?php
            echo $this->Form->input('customer_id');
            echo $this->Form->input('customer_type');
            echo $this->Form->input('payment_type');
            echo $this->Form->input('created_on');
            echo $this->Form->input('created_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
