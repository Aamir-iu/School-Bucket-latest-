<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Fee Type'), ['action' => 'edit', $feeType->id_fee_type]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Fee Type'), ['action' => 'delete', $feeType->id_fee_type], ['confirm' => __('Are you sure you want to delete # {0}?', $feeType->id_fee_type)]) ?> </li>
        <li><?= $this->Html->link(__('List Fee Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fee Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Concession'), ['controller' => 'Concession', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Concession'), ['controller' => 'Concession', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Dues'), ['controller' => 'Dues', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Due'), ['controller' => 'Dues', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fee Heads'), ['controller' => 'FeeHeads', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fee Head'), ['controller' => 'FeeHeads', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fees'), ['controller' => 'Fees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fee'), ['controller' => 'Fees', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="feeTypes view large-9 medium-8 columns content">
    <h3><?= h($feeType->id_fee_type) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Fee Type Name') ?></th>
            <td><?= h($feeType->fee_type_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Fee Type') ?></th>
            <td><?= $this->Number->format($feeType->id_fee_type) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Status') ?></h4>
        <?= $this->Text->autoParagraph(h($feeType->status)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Concession') ?></h4>
        <?php if (!empty($feeType->concession)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id Concession') ?></th>
                <th scope="col"><?= __('Registration Id') ?></th>
                <th scope="col"><?= __('Fee Type Id') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Fine') ?></th>
                <th scope="col"><?= __('From Date') ?></th>
                <th scope="col"><?= __('To Date') ?></th>
                <th scope="col"><?= __('Remarks') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($feeType->concession as $concession): ?>
            <tr>
                <td><?= h($concession->id_concession) ?></td>
                <td><?= h($concession->registration_id) ?></td>
                <td><?= h($concession->fee_type_id) ?></td>
                <td><?= h($concession->amount) ?></td>
                <td><?= h($concession->fine) ?></td>
                <td><?= h($concession->from_date) ?></td>
                <td><?= h($concession->to_date) ?></td>
                <td><?= h($concession->remarks) ?></td>
                <td><?= h($concession->status) ?></td>
                <td><?= h($concession->created_on) ?></td>
                <td><?= h($concession->created_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Concession', 'action' => 'view', $concession->id_concession]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Concession', 'action' => 'edit', $concession->id_concession]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Concession', 'action' => 'delete', $concession->id_concession], ['confirm' => __('Are you sure you want to delete # {0}?', $concession->id_concession)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Dues') ?></h4>
        <?php if (!empty($feeType->dues)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id Dues') ?></th>
                <th scope="col"><?= __('Registration Id') ?></th>
                <th scope="col"><?= __('Class Id') ?></th>
                <th scope="col"><?= __('Shift Id') ?></th>
                <th scope="col"><?= __('Session Id') ?></th>
                <th scope="col"><?= __('Campus Id') ?></th>
                <th scope="col"><?= __('Fee Month') ?></th>
                <th scope="col"><?= __('Year') ?></th>
                <th scope="col"><?= __('Fee Type Id') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Fine') ?></th>
                <th scope="col"><?= __('Fee Date') ?></th>
                <th scope="col"><?= __('Due Date') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($feeType->dues as $dues): ?>
            <tr>
                <td><?= h($dues->id_dues) ?></td>
                <td><?= h($dues->registration_id) ?></td>
                <td><?= h($dues->class_id) ?></td>
                <td><?= h($dues->shift_id) ?></td>
                <td><?= h($dues->session_id) ?></td>
                <td><?= h($dues->campus_id) ?></td>
                <td><?= h($dues->fee_month) ?></td>
                <td><?= h($dues->year) ?></td>
                <td><?= h($dues->fee_type_id) ?></td>
                <td><?= h($dues->amount) ?></td>
                <td><?= h($dues->fine) ?></td>
                <td><?= h($dues->fee_date) ?></td>
                <td><?= h($dues->due_date) ?></td>
                <td><?= h($dues->created_on) ?></td>
                <td><?= h($dues->created_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Dues', 'action' => 'view', $dues->id_dues]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Dues', 'action' => 'edit', $dues->id_dues]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Dues', 'action' => 'delete', $dues->id_dues], ['confirm' => __('Are you sure you want to delete # {0}?', $dues->id_dues)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Fee Heads') ?></h4>
        <?php if (!empty($feeType->fee_heads)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id Fee Heads') ?></th>
                <th scope="col"><?= __('Class Id') ?></th>
                <th scope="col"><?= __('Campus Id') ?></th>
                <th scope="col"><?= __('Fee Type Id') ?></th>
                <th scope="col"><?= __('Class Fees') ?></th>
                <th scope="col"><?= __('Fine') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($feeType->fee_heads as $feeHeads): ?>
            <tr>
                <td><?= h($feeHeads->id_fee_heads) ?></td>
                <td><?= h($feeHeads->class_id) ?></td>
                <td><?= h($feeHeads->campus_id) ?></td>
                <td><?= h($feeHeads->fee_type_id) ?></td>
                <td><?= h($feeHeads->class_fees) ?></td>
                <td><?= h($feeHeads->fine) ?></td>
                <td><?= h($feeHeads->created_on) ?></td>
                <td><?= h($feeHeads->created_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'FeeHeads', 'action' => 'view', $feeHeads->id_fee_heads]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'FeeHeads', 'action' => 'edit', $feeHeads->id_fee_heads]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'FeeHeads', 'action' => 'delete', $feeHeads->id_fee_heads], ['confirm' => __('Are you sure you want to delete # {0}?', $feeHeads->id_fee_heads)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Fees') ?></h4>
        <?php if (!empty($feeType->fees)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id Fees') ?></th>
                <th scope="col"><?= __('Inv No') ?></th>
                <th scope="col"><?= __('Registration Id') ?></th>
                <th scope="col"><?= __('Campus Id') ?></th>
                <th scope="col"><?= __('Session Id') ?></th>
                <th scope="col"><?= __('Class Id') ?></th>
                <th scope="col"><?= __('Shift Id') ?></th>
                <th scope="col"><?= __('Fee Month') ?></th>
                <th scope="col"><?= __('Year') ?></th>
                <th scope="col"><?= __('Sub Total') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Retruned Amount') ?></th>
                <th scope="col"><?= __('Fee Type Id') ?></th>
                <th scope="col"><?= __('Fee Date') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Payment Mode') ?></th>
                <th scope="col"><?= __('Remarks') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($feeType->fees as $fees): ?>
            <tr>
                <td><?= h($fees->id_fees) ?></td>
                <td><?= h($fees->inv_no) ?></td>
                <td><?= h($fees->registration_id) ?></td>
                <td><?= h($fees->campus_id) ?></td>
                <td><?= h($fees->session_id) ?></td>
                <td><?= h($fees->class_id) ?></td>
                <td><?= h($fees->shift_id) ?></td>
                <td><?= h($fees->fee_month) ?></td>
                <td><?= h($fees->year) ?></td>
                <td><?= h($fees->sub_total) ?></td>
                <td><?= h($fees->amount) ?></td>
                <td><?= h($fees->retruned_amount) ?></td>
                <td><?= h($fees->fee_type_id) ?></td>
                <td><?= h($fees->fee_date) ?></td>
                <td><?= h($fees->created_on) ?></td>
                <td><?= h($fees->created_by) ?></td>
                <td><?= h($fees->status) ?></td>
                <td><?= h($fees->payment_mode) ?></td>
                <td><?= h($fees->remarks) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Fees', 'action' => 'view', $fees->id_fees]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Fees', 'action' => 'edit', $fees->id_fees]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Fees', 'action' => 'delete', $fees->id_fees], ['confirm' => __('Are you sure you want to delete # {0}?', $fees->id_fees)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
