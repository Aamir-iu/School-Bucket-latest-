<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sms Log'), ['action' => 'edit', $smsLog->id_sms_log]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sms Log'), ['action' => 'delete', $smsLog->id_sms_log], ['confirm' => __('Are you sure you want to delete # {0}?', $smsLog->id_sms_log)]) ?> </li>
        <li><?= $this->Html->link(__('List Sms Log'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sms Log'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Campuses'), ['controller' => 'Campuses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Campus'), ['controller' => 'Campuses', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="smsLog view large-9 medium-8 columns content">
    <h3><?= h($smsLog->id_sms_log) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Campus') ?></th>
            <td><?= $smsLog->has('campus') ? $this->Html->link($smsLog->campus->id_campus, ['controller' => 'Campuses', 'action' => 'view', $smsLog->campus->id_campus]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mobile Number') ?></th>
            <td><?= h($smsLog->mobile_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message') ?></th>
            <td><?= h($smsLog->message) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Code') ?></th>
            <td><?= h($smsLog->code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Sms Log') ?></th>
            <td><?= $this->Number->format($smsLog->id_sms_log) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($smsLog->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('No Of Sms') ?></th>
            <td><?= $this->Number->format($smsLog->no_of_sms) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sms Date') ?></th>
            <td><?= h($smsLog->sms_date) ?></td>
        </tr>
    </table>
</div>
