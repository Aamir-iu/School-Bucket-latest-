<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Exam Marks Details'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="examMarksDetails form large-9 medium-8 columns content">
    <?= $this->Form->create($examMarksDetail) ?>
    <fieldset>
        <legend><?= __('Add Exam Marks Detail') ?></legend>
        <?php
            echo $this->Form->input('class_id');
            echo $this->Form->input('shift_id');
            echo $this->Form->input('session_id');
            echo $this->Form->input('subject_id', ['options' => $subjects, 'empty' => true]);
            echo $this->Form->input('min_marks');
            echo $this->Form->input('max_marks');
            echo $this->Form->input('created_on');
            echo $this->Form->input('created_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
