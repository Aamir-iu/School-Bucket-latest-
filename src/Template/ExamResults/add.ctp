<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Exam Results'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Exam Types'), ['controller' => 'ExamTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Exam Type'), ['controller' => 'ExamTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="examResults form large-9 medium-8 columns content">
    <?= $this->Form->create($examResult) ?>
    <fieldset>
        <legend><?= __('Add Exam Result') ?></legend>
        <?php
            echo $this->Form->input('class_id');
            echo $this->Form->input('shift_id');
            echo $this->Form->input('exam_type_id', ['options' => $examTypes, 'empty' => true]);
            echo $this->Form->input('subject_id', ['options' => $subjects, 'empty' => true]);
            echo $this->Form->input('subject_name');
            echo $this->Form->input('mm');
            echo $this->Form->input('pm');
            echo $this->Form->input('mo');
            echo $this->Form->input('per');
            echo $this->Form->input('grade');
            echo $this->Form->input('rank');
            echo $this->Form->input('result');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
