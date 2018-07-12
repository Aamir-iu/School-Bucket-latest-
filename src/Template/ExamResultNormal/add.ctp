<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Exam Result Normal'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Exam Types'), ['controller' => 'ExamTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Exam Type'), ['controller' => 'ExamTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="examResultNormal form large-9 medium-8 columns content">
    <?= $this->Form->create($examResultNormal) ?>
    <fieldset>
        <legend><?= __('Add Exam Result Normal') ?></legend>
        <?php
            echo $this->Form->input('registration_id');
            echo $this->Form->input('class_id');
            echo $this->Form->input('shift_id');
            echo $this->Form->input('session_id');
            echo $this->Form->input('exam_type_id', ['options' => $examTypes, 'empty' => true]);
            echo $this->Form->input('subject_id', ['options' => $subjects, 'empty' => true]);
            echo $this->Form->input('max_marks');
            echo $this->Form->input('min_marks');
            echo $this->Form->input('obtained_marks');
            echo $this->Form->input('total_marks');
            echo $this->Form->input('total_obtained');
            echo $this->Form->input('per');
            echo $this->Form->input('grade');
            echo $this->Form->input('rank');
            echo $this->Form->input('remarks');
            echo $this->Form->input('total_attetance');
            echo $this->Form->input('marks_attendance');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
