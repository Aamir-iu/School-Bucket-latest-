<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Admin Card Datesheet'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="adminCardDatesheet form large-9 medium-8 columns content">
    <?= $this->Form->create($adminCardDatesheet) ?>
    <fieldset>
        <legend><?= __('Add Admin Card Datesheet') ?></legend>
        <?php
            echo $this->Form->input('class_id');
            echo $this->Form->input('shift_id');
            echo $this->Form->input('subject_id', ['options' => $subjects, 'empty' => true]);
            echo $this->Form->input('date', ['empty' => true]);
            echo $this->Form->input('time');
            echo $this->Form->input('day');
            echo $this->Form->input('created_on');
            echo $this->Form->input('created_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
