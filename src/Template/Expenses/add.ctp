<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Expanses'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="expanses form large-9 medium-8 columns content">
    <?= $this->Form->create($expanse) ?>
    <fieldset>
        <legend><?= __('Add Expanse') ?></legend>
        <?php
            echo $this->Form->input('transaction_account_id');
            echo $this->Form->input('expanse_desc');
            echo $this->Form->input('amount');
            echo $this->Form->input('expanse_date', ['empty' => true]);
            echo $this->Form->input('r_no');
            echo $this->Form->input('created_on');
            echo $this->Form->input('created_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
