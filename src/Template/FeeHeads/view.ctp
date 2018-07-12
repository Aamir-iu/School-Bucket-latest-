<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Fee Head'), ['action' => 'edit', $feeHead->id_fee_heads]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Fee Head'), ['action' => 'delete', $feeHead->id_fee_heads], ['confirm' => __('Are you sure you want to delete # {0}?', $feeHead->id_fee_heads)]) ?> </li>
        <li><?= $this->Html->link(__('List Fee Heads'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fee Head'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="feeHeads view large-9 medium-8 columns content">
    <h3><?= h($feeHead->id_fee_heads) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id Fee Heads') ?></th>
            <td><?= $this->Number->format($feeHead->id_fee_heads) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Class Id') ?></th>
            <td><?= $this->Number->format($feeHead->class_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shift') ?></th>
            <td><?= $this->Number->format($feeHead->shift) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Class Fees') ?></th>
            <td><?= $this->Number->format($feeHead->class_fees) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fine') ?></th>
            <td><?= $this->Number->format($feeHead->fine) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($feeHead->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($feeHead->created_on) ?></td>
        </tr>
    </table>
</div>
