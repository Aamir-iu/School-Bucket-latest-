<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Po Grn'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Po Grn Detail'), ['controller' => 'PoGrnDetail', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Po Grn Detail'), ['controller' => 'PoGrnDetail', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="poGrn index large-9 medium-8 columns content">
    <h3><?= __('Po Grn') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id_po_grn') ?></th>
                <th scope="col"><?= $this->Paginator->sort('po_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('po_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('grn_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('grn_created_by') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($poGrn as $poGrn): ?>
            <tr>
                <td><?= $this->Number->format($poGrn->id_po_grn) ?></td>
                <td><?= $this->Number->format($poGrn->po_id) ?></td>
                <td><?= h($poGrn->po_number) ?></td>
                <td><?= h($poGrn->grn_date) ?></td>
                <td><?= $this->Number->format($poGrn->grn_created_by) ?></td>
                <td class="actions">
                   
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $poGrn->id_po_grn]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $poGrn->id_po_grn], ['confirm' => __('Are you sure you want to delete # {0}?', $poGrn->id_po_grn)]) ?>
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
