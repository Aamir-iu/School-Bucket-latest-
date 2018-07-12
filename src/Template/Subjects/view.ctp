<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Subject'), ['action' => 'edit', $subject->id_subjects]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Subject'), ['action' => 'delete', $subject->id_subjects], ['confirm' => __('Are you sure you want to delete # {0}?', $subject->id_subjects)]) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Scheduler'), ['controller' => 'Scheduler', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Scheduler'), ['controller' => 'Scheduler', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="subjects view large-9 medium-8 columns content">
    <h3><?= h($subject->id_subjects) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Subject Name') ?></th>
            <td><?= h($subject->subject_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Short Name') ?></th>
            <td><?= h($subject->short_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Subjects') ?></th>
            <td><?= $this->Number->format($subject->id_subjects) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Order Id') ?></th>
            <td><?= $this->Number->format($subject->order_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($subject->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Creatd On') ?></th>
            <td><?= h($subject->creatd_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Scheduler') ?></h4>
        <?php if (!empty($subject->scheduler)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id Scheduler') ?></th>
                <th scope="col"><?= __('Staff Id') ?></th>
                <th scope="col"><?= __('Subject Id') ?></th>
                <th scope="col"><?= __('Class Id') ?></th>
                <th scope="col"><?= __('Start Time') ?></th>
                <th scope="col"><?= __('End Time') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($subject->scheduler as $scheduler): ?>
            <tr>
                <td><?= h($scheduler->id_scheduler) ?></td>
                <td><?= h($scheduler->staff_id) ?></td>
                <td><?= h($scheduler->subject_id) ?></td>
                <td><?= h($scheduler->class_id) ?></td>
                <td><?= h($scheduler->start_time) ?></td>
                <td><?= h($scheduler->end_time) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Scheduler', 'action' => 'view', $scheduler->id_scheduler]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Scheduler', 'action' => 'edit', $scheduler->id_scheduler]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Scheduler', 'action' => 'delete', $scheduler->id_scheduler], ['confirm' => __('Are you sure you want to delete # {0}?', $scheduler->id_scheduler)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
