<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Business Partner'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="businessPartners index large-9 medium-8 columns content">
    <h3><?= __('Business Partners') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id_business_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('business_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('related_table') ?></th>
                <th scope="col"><?= $this->Paginator->sort('related_table_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('related_table_field') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($businessPartners as $businessPartner): ?>
            <tr>
                <td><?= $this->Number->format($businessPartner->id_business_type) ?></td>
                <td><?= h($businessPartner->business_type) ?></td>
                <td><?= h($businessPartner->created_on) ?></td>
                <td><?= $this->Number->format($businessPartner->created_by) ?></td>
                <td><?= h($businessPartner->related_table) ?></td>
                <td><?= h($businessPartner->related_table_id) ?></td>
                <td><?= h($businessPartner->related_table_field) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $businessPartner->id_business_type]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $businessPartner->id_business_type]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $businessPartner->id_business_type], ['confirm' => __('Are you sure you want to delete # {0}?', $businessPartner->id_business_type)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
