<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $due->id_dues],
                ['confirm' => __('Are you sure you want to delete # {0}?', $due->id_dues)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Dues'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="dues form large-9 medium-8 columns content">
    <?= $this->Form->create($due) ?>
    <fieldset>
        <legend><?= __('Edit Due') ?></legend>
        <?php
            echo $this->Form->input('registration_id');
            echo $this->Form->input('class_id');
            echo $this->Form->input('shift_id');
            echo $this->Form->input('session_id');
            echo $this->Form->input('fee_month');
            echo $this->Form->input('year');
            echo $this->Form->input('fee_type');
            echo $this->Form->input('amount');
            echo $this->Form->input('fine');
            echo $this->Form->input('fee_date', ['empty' => true]);
            echo $this->Form->input('due_date', ['empty' => true]);
            echo $this->Form->input('created_on');
            echo $this->Form->input('created_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
