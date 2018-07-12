<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $mobileNotification->id_notifications],
                ['confirm' => __('Are you sure you want to delete # {0}?', $mobileNotification->id_notifications)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Mobile Notifications'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="mobileNotifications form large-9 medium-8 columns content">
    <?= $this->Form->create($mobileNotification) ?>
    <fieldset>
        <legend><?= __('Edit Mobile Notification') ?></legend>
        <?php
            echo $this->Form->input('notification');
            echo $this->Form->input('created_on');
            echo $this->Form->input('schedule_on', ['empty' => true]);
            echo $this->Form->input('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
