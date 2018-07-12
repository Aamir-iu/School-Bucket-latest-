<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Mobile Notification'), ['action' => 'edit', $mobileNotification->id_notifications]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Mobile Notification'), ['action' => 'delete', $mobileNotification->id_notifications], ['confirm' => __('Are you sure you want to delete # {0}?', $mobileNotification->id_notifications)]) ?> </li>
        <li><?= $this->Html->link(__('List Mobile Notifications'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Mobile Notification'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="mobileNotifications view large-9 medium-8 columns content">
    <h3><?= h($mobileNotification->id_notifications) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id Notifications') ?></th>
            <td><?= $this->Number->format($mobileNotification->id_notifications) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($mobileNotification->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Schedule On') ?></th>
            <td><?= h($mobileNotification->schedule_on) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Notification') ?></h4>
        <?= $this->Text->autoParagraph(h($mobileNotification->notification)); ?>
    </div>
    <div class="row">
        <h4><?= __('Status') ?></h4>
        <?= $this->Text->autoParagraph(h($mobileNotification->status)); ?>
    </div>
</div>
