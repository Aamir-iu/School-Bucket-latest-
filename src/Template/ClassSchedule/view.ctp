<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Class Schedule'), ['action' => 'edit', $classSchedule->id_class_schedule]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Class Schedule'), ['action' => 'delete', $classSchedule->id_class_schedule], ['confirm' => __('Are you sure you want to delete # {0}?', $classSchedule->id_class_schedule)]) ?> </li>
        <li><?= $this->Html->link(__('List Class Schedule'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Class Schedule'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Days'), ['controller' => 'Days', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Day'), ['controller' => 'Days', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="classSchedule view large-9 medium-8 columns content">
    <h3><?= h($classSchedule->id_class_schedule) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Day') ?></th>
            <td><?= $classSchedule->has('day') ? $this->Html->link($classSchedule->day->id_days, ['controller' => 'Days', 'action' => 'view', $classSchedule->day->id_days]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subject') ?></th>
            <td><?= $classSchedule->has('subject') ? $this->Html->link($classSchedule->subject->id_subjects, ['controller' => 'Subjects', 'action' => 'view', $classSchedule->subject->id_subjects]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Desc') ?></th>
            <td><?= h($classSchedule->desc) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Class Schedule') ?></th>
            <td><?= $this->Number->format($classSchedule->id_class_schedule) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Class Id') ?></th>
            <td><?= $this->Number->format($classSchedule->class_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shift Id') ?></th>
            <td><?= $this->Number->format($classSchedule->shift_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start Time') ?></th>
            <td><?= h($classSchedule->start_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End Time') ?></th>
            <td><?= h($classSchedule->end_time) ?></td>
        </tr>
    </table>
</div>
