<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Campus'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="campuses index large-9 medium-8 columns content">
    <h3><?= __('Campuses') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id_campus') ?></th>
                <th scope="col"><?= $this->Paginator->sort('campus_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('campus_location') ?></th>
                <th scope="col"><?= $this->Paginator->sort('campus_principle') ?></th>
                <th scope="col"><?= $this->Paginator->sort('campus_contact') ?></th>
                <th scope="col"><?= $this->Paginator->sort('campus_contact2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($campuses as $campus): ?>
            <tr>
                <td><?= $this->Number->format($campus->id_campus) ?></td>
                <td><?= h($campus->campus_name) ?></td>
                <td><?= h($campus->campus_location) ?></td>
                <td><?= h($campus->campus_principle) ?></td>
                <td><?= h($campus->campus_contact) ?></td>
                <td><?= h($campus->campus_contact2) ?></td>
                <td><?= $this->Number->format($campus->created_by) ?></td>
                <td><?= h($campus->created_on) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $campus->id_campus]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $campus->id_campus]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $campus->id_campus], ['confirm' => __('Are you sure you want to delete # {0}?', $campus->id_campus)]) ?>
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
