<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $smsLog->id_sms_log],
                ['confirm' => __('Are you sure you want to delete # {0}?', $smsLog->id_sms_log)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Sms Log'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Campuses'), ['controller' => 'Campuses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Campus'), ['controller' => 'Campuses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="smsLog form large-9 medium-8 columns content">
    <?= $this->Form->create($smsLog) ?>
    <fieldset>
        <legend><?= __('Edit Sms Log') ?></legend>
        <?php
            echo $this->Form->input('campus_id', ['options' => $campuses, 'empty' => true]);
            echo $this->Form->input('mobile_number');
            echo $this->Form->input('message');
            echo $this->Form->input('code');
            echo $this->Form->input('status');
            echo $this->Form->input('no_of_sms');
            echo $this->Form->input('sms_date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
