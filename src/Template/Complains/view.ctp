<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Complain'), ['action' => 'edit', $complain->id_complain]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Complain'), ['action' => 'delete', $complain->id_complain], ['confirm' => __('Are you sure you want to delete # {0}?', $complain->id_complain)]) ?> </li>
        <li><?= $this->Html->link(__('List Complains'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Complain'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Campuses'), ['controller' => 'Campuses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Campus'), ['controller' => 'Campuses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="complains view large-9 medium-8 columns content">
    <h3><?= h($complain->id_complain) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Campus') ?></th>
            <td><?= $complain->has('campus') ? $this->Html->link($complain->campus->id_campus, ['controller' => 'Campuses', 'action' => 'view', $complain->campus->id_campus]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department') ?></th>
            <td><?= $complain->has('department') ? $this->Html->link($complain->department->department_id, ['controller' => 'Departments', 'action' => 'view', $complain->department->department_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Complain') ?></th>
            <td><?= $this->Number->format($complain->id_complain) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Registration Id') ?></th>
            <td><?= $this->Number->format($complain->registration_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Comp Date') ?></th>
            <td><?= h($complain->comp_date) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Complain') ?></h4>
        <?= $this->Text->autoParagraph(h($complain->complain)); ?>
    </div>
    <div class="row">
        <h4><?= __('Status') ?></h4>
        <?= $this->Text->autoParagraph(h($complain->status)); ?>
    </div>
</div>
