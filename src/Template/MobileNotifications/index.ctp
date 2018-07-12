<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Mobile Notification'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mobileNotifications index large-9 medium-8 columns content">
    <h3><?= __('Mobile Notifications') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id_notifications') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('schedule_on') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mobileNotifications as $mobileNotification): ?>
            <tr>
                <td><?= $this->Number->format($mobileNotification->id_notifications) ?></td>
                <td><?= h($mobileNotification->created_on) ?></td>
                <td><?= h($mobileNotification->schedule_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $mobileNotification->id_notifications]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $mobileNotification->id_notifications]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mobileNotification->id_notifications], ['confirm' => __('Are you sure you want to delete # {0}?', $mobileNotification->id_notifications)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
