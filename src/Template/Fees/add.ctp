<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Fees'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Campuses'), ['controller' => 'Campuses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Campus'), ['controller' => 'Campuses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="fees form large-9 medium-8 columns content">
    <?= $this->Form->create($fee) ?>
    <fieldset>
        <legend><?= __('Add Fee') ?></legend>
        <?php
            echo $this->Form->input('inv_no');
            echo $this->Form->input('registration_id');
            echo $this->Form->input('campus_id', ['options' => $campuses, 'empty' => true]);
            echo $this->Form->input('session_id');
            echo $this->Form->input('class_id');
            echo $this->Form->input('shift_id');
            echo $this->Form->input('fee_month');
            echo $this->Form->input('year');
            echo $this->Form->input('amount');
            echo $this->Form->input('fee_type');
            echo $this->Form->input('fee_date', ['empty' => true]);
            echo $this->Form->input('created_on');
            echo $this->Form->input('created_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
